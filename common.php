<?php

$title = "デザネコ｜ネコの手、借りませんか？ デザインを通して、周りとのつながりを築きます。";
$description = "ネコの手、借りませんか？ デザインを通して、周りとのつながりを築きます。 デザネコは魅力を引き出し、伝わりやすく心に届くデザインで お客さまの満足度が高まるよう努めます。 私たちの制作物が、皆さまの幸せに繋がりますように。";
$abbreviation = "当社";

$company = "デザネコ";
$copyright = "Dezaneko";
$name = "比嘉 一茂";
$product_name = "";
$telNo = "090-2964-1664";
$mobile = "";
$faxNo = "";
$postalCode = "〒901-2226";
$address = "沖縄県宜野湾市嘉数2-8-2";
$addressRegion = "沖縄県";// 都道府県
$addressLocality = "宜野湾市";// 市区町村
$streetAddress = "嘉数2-8-2";// 番地
$maplink = "";
$gmap = '';

$cms = "";
$cmsID = "";
$categoryID01 = "";
$categoryID02 = "";
$categoryID03 = "";
$categoryID04 = "";
$categoryID05 = "";
$categoryID06 = "";
$page_images = "images/06.webp"; //../images/images.jpg
$img = "images"; ///images

$weblink = "";
$instagram = "https://www.instagram.com/dezaneko/";
$instagram02 = "https://www.instagram.com/kazushige_higa/";
$line = "https://line.me/R/ti/p/@quy1014b";
$mail = "info@d-neko.com";
$youtube = "https://www.youtube.com/@design-cat";
$tiktok = "";
$facebook = "";
$x = "";

ini_set('display_errors', "Off");

// blog CMS (ros-cp.com)
$requested_eid = isset($_GET["eid"]) ? trim((string)$_GET["eid"]) : '';
$requested_entry_type = isset($_GET["type"]) ? trim((string)$_GET["type"]) : 'blog';
if ($requested_entry_type !== 'works' && $requested_entry_type !== 'column') {
    $requested_entry_type = 'blog';
}
// microCMS プレビュー用 draftKey
$requested_draft_key = isset($_GET["draftKey"]) ? trim((string)$_GET["draftKey"]) : '';
$blog_title = '';
if ($requested_eid !== '' && !empty($cmsID)) {
    $ros_blog_title = @file_get_contents(
        "https://admin.ros-cp.com/output/output_blog_entry_detail.php?user_id=" . $cmsID . "&eid=" . urlencode($requested_eid) . "&c=entry_title"
    );
    if ($ros_blog_title !== false) {
        $blog_title = trim((string)$ros_blog_title);
    }
}
if ($blog_title === '記事が見当たりません') {
    $blog_title = '';
}

// microCMS Settings
$microcms_service_id = "d-neko";
$microcms_api_key    = "ZpPs1Ptb4m0XWpW5dbrx2V4k4sSNU6NlIKHl";
$microcms_base_url   = "https://" . $microcms_service_id . ".microcms.io/api/v1";

/**
 * microCMS API fetch function
 *
 * @param string $endpoint  API endpoint (e.g. "/blog", "/blog/article-id", "/news?limit=5")
 * @return object|null      Decoded JSON response or null on failure
 */
function microcms_get($endpoint)
{
    global $microcms_base_url, $microcms_api_key;

    $url = $microcms_base_url . $endpoint;
    $options = [
        'http' => [
            'header'  => "X-MICROCMS-API-KEY: " . $microcms_api_key,
            'method'  => 'GET',
            'timeout' => 10,
        ],
    ];
    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);

    if ($response === false) {
        return null;
    }
    return json_decode($response);
}

/**
 * Get microCMS blog entry by Content ID.
 *
 * @param string $eid  Content ID from URL parameter
 * @return object|null Blog entry object or null
 */
function microcms_get_entry($eid, $entry_type = 'blog', $draft_key = '')
{
    $eid = trim((string)$eid);
    if ($eid === '') return null;
    if ($entry_type === 'works') {
        $endpoint = '/works';
    } elseif ($entry_type === 'column') {
        $endpoint = '/column';
    } else {
        $endpoint = '/blog';
    }
    $path = $endpoint . "/" . rawurlencode($eid);
    if ($draft_key !== '') {
        $path .= "?draftKey=" . rawurlencode($draft_key);
    }
    $entry = microcms_get($path);

    // draftKey が指定されていない場合、下書き記事（publishedAt が Null）は
    // 一般公開対象から除外する。APIキーを持つ HP バックエンドでは下書きも
    // 取得できてしまうため、ここで明示的にブロックする。
    if ($draft_key === '' && $entry !== null) {
        $is_published = isset($entry->publishedAt)
            && $entry->publishedAt !== null
            && trim((string)$entry->publishedAt) !== '';
        if (!$is_published) {
            return null;
        }
    }
    return $entry;
}

/**
 * microCMS リスト取得（公開済みのみ）
 * 記事一覧など、一般公開ページで下書き記事を混入させないためのヘルパー。
 *
 * @param string $endpoint  '/column' | '/blog' | '/works'
 * @param string $extra     追加クエリ（先頭 & 不要、例: 'limit=10&orders=-publishedAt'）
 * @return object|null      レスポンス
 */
function microcms_get_list($endpoint, $extra = '')
{
    $endpoint = '/' . ltrim(trim((string)$endpoint), '/');
    // publishedAt が存在する（＝公開済み）のみを取得
    $query = 'filters=publishedAt[exists]';
    if ($extra !== '') {
        $query .= '&' . ltrim($extra, '&?');
    }
    return microcms_get($endpoint . '?' . $query);
}

/**
 * Extract a readable category name from a microCMS field.
 *
 * microCMS category-like fields may be returned as a string, array, or object
 * depending on field type/settings. This keeps tabs from showing "Array".
 *
 * @param mixed  $category_value  microCMS category field value
 * @param string $fallback        Label to use when category is empty
 * @return string
 */
function microcms_extract_category_name($category_value, $fallback = 'その他')
{
    if (is_string($category_value) || is_numeric($category_value)) {
        $category_name = trim((string)$category_value);
        return ($category_name !== '') ? $category_name : $fallback;
    }

    if (is_array($category_value)) {
        foreach ($category_value as $item) {
            $category_name = microcms_extract_category_name($item, '');
            if ($category_name !== '') {
                return $category_name;
            }
        }
        return $fallback;
    }

    if (is_object($category_value)) {
        foreach (['name', 'title', 'label', 'value', 'id'] as $key) {
            if (isset($category_value->{$key})) {
                $category_name = microcms_extract_category_name($category_value->{$key}, '');
                if ($category_name !== '') {
                    return $category_name;
                }
            }
        }
    }

    return $fallback;
}

/**
 * Extract blog title from microCMS entry object.
 *
 * @param object|null $entry  microCMS blog entry
 * @return string             Blog title or empty string
 */
function microcms_extract_blog_title($entry)
{
    if (!$entry) return '';

    foreach (['ogTitle', 'ogpTitle', 'metaTitle', 'seoTitle', 'title'] as $title_key) {
        if (isset($entry->{$title_key})) {
            $entry_title = trim((string)$entry->{$title_key});
            if ($entry_title !== '') {
                return $entry_title;
            }
        }
    }

    return '';
}

/**
 * Extract blog summary for meta description.
 *
 * @param object|null $entry  microCMS blog entry
 * @return string             Summary text or empty string
 */
function microcms_extract_blog_description($entry)
{
    if (!$entry) return '';

    foreach (['ogDescription', 'ogpDescription', 'metaDescription', 'seoDescription', 'description', 'summary', 'excerpt'] as $summary_key) {
        if (isset($entry->{$summary_key})) {
            $summary = trim(strip_tags((string)$entry->{$summary_key}));
            if ($summary !== '') {
                return $summary;
            }
        }
    }

    $content = isset($entry->content) ? (string)$entry->content : '';
    $plain_content = trim(preg_replace('/\s+/u', ' ', strip_tags($content)));
    if ($plain_content === '') {
        return '';
    }

    if (function_exists('mb_substr') && function_exists('mb_strlen')) {
        $summary = mb_substr($plain_content, 0, 120, 'UTF-8');
        if (mb_strlen($plain_content, 'UTF-8') > 120) {
            $summary .= '...';
        }
        return $summary;
    }

    $summary = substr($plain_content, 0, 120);
    if (strlen($plain_content) > 120) {
        $summary .= '...';
    }
    return $summary;
}

/**
 * Extract OGP image URL from microCMS entry object.
 *
 * @param object|null $entry  microCMS blog entry
 * @return string             Image URL or empty string
 */
function microcms_extract_blog_image($entry)
{
    if (!$entry) return '';

    foreach (['ogImage', 'ogpImage', 'seoImage', 'thumbnail', 'image', 'eyecatch'] as $image_key) {
        if (!isset($entry->{$image_key})) {
            continue;
        }
        $image_value = $entry->{$image_key};
        if (is_object($image_value) && isset($image_value->url)) {
            $image_url = trim((string)$image_value->url);
            if ($image_url !== '') {
                return $image_url;
            }
        }
        if (is_string($image_value)) {
            $image_url = trim($image_value);
            if ($image_url !== '') {
                return $image_url;
            }
        }
    }

    return '';
}

// microCMS blog meta (used for entry pages)
$microcms_blog_entry = microcms_get_entry($requested_eid, $requested_entry_type, $requested_draft_key);
$microcms_blog_title = microcms_extract_blog_title($microcms_blog_entry);
$microcms_blog_description = microcms_extract_blog_description($microcms_blog_entry);
$microcms_blog_image = microcms_extract_blog_image($microcms_blog_entry);

$entry_title = $microcms_blog_title !== '' ? $microcms_blog_title : $blog_title;
$entry_description = $microcms_blog_description;
$entry_og_image = $microcms_blog_image;

$url = basename($_SERVER['SCRIPT_NAME']);
function nowUrl()
{
    $url = '';
    if (isset($_SERVER['HTTPS'])) {
        $url .= 'https://';
    } else {
        $url .= 'http://';
    }
    $url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    return $url;
}

function breadcrumbs()
{
    $file_path = $_SERVER['SCRIPT_NAME'];
    $dirs = explode("/", $file_path);
    $dirs = array_values(array_filter($dirs, "strlen"));
    $html = '<li><a href="./"><i class="fas fa-home"></i></a></li>';;
    $url = "";
    foreach ($dirs as $dir) {
        $url .= "/" . $dir;
        if (strtolower($dir) !== 'index.php') {
            $html .= "<li><a href=" . $url . ">" . strtoupper($dir) . "</a></li>";
        }
    }
    echo $html;
}
