<?php require_once './common.php'; ?>
<?php require_once __DIR__ . '/site-navigation.php'; ?>
<?php $dr_navigation_items = dneko_navigation_items(isset($line) ? $line : 'contact.php'); ?>
<?php
$is_dnk_lp_home = !empty($top_lp);
$is_home_renewal = !empty($home_renewal);
?>
<!DOCTYPE html>
<html lang="ja">

<head prefix="og:http://ogp.me/ns#">
  <meta charset="UTF-8">
  <?php
  $site_name = !empty($company) ? $company : 'デザネコ';
  $is_home_page = ($url === 'index.php');
  $is_entry_page = preg_match('/^entry\d{0,2}\.php$/', $url);
  if (!empty($requested_draft_key)) {
    $page_noindex = true;
  }
  $head_prefix = !empty($page_seo_title)
    ? $page_seo_title
    : (!empty($page_title) ? $page_title : $title);
  if ($is_entry_page && !empty($entry_title)) {
    $head_prefix = $entry_title;
  }
  $head_title = $head_prefix;
  $title_has_site_name = function_exists('mb_strpos')
    ? mb_strpos($head_title, $site_name) !== false
    : strpos($head_title, $site_name) !== false;
  if (empty($page_title_exact) && !$is_home_page && !$title_has_site_name) {
    $head_title .= '｜' . $site_name;
  }

  $head_meta_description = !empty($page_description) ? $page_description : $description;
  if ($is_entry_page && !empty($entry_description)) {
    $head_meta_description = $entry_description;
  }

  $canonical_path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
  $canonical_path = is_string($canonical_path) && $canonical_path !== '' ? $canonical_path : '/';
  if (preg_match('#/index\.(?:php|html)$#i', $canonical_path)) {
    $canonical_path = preg_replace('#index\.(?:php|html)$#i', '', $canonical_path);
  }
  $canonical_params = [];
  if ($is_entry_page) {
    if (!empty($requested_entry_type)) {
      $canonical_params['type'] = $requested_entry_type;
    }
    if (!empty($requested_eid)) {
      $canonical_params['eid'] = $requested_eid;
    }
  } elseif ($url === 'entry_list.php' && !empty($page_canonical_params) && is_array($page_canonical_params)) {
    $canonical_params = $page_canonical_params;
  }
  $canonical_url = 'https://d-neko.com' . $canonical_path;
  if ($canonical_params !== []) {
    $canonical_url .= '?' . http_build_query($canonical_params, '', '&', PHP_QUERY_RFC3986);
  }
  if (!empty($page_canonical)) {
    $canonical_url = $page_canonical;
  }

  $default_og_image = 'https://d-neko.com/' . ltrim($img, '/') . '/ogp_image.jpg';
  $head_og_type = ($is_entry_page && !empty($entry_title)) ? 'article' : 'website';
  $head_og_title = $head_title;
  $head_og_description = $head_meta_description;
  // ページ独自OGP画像対応（個別ページで $page_og_image を設定すると差し替えられる）
  $head_og_image = ($is_entry_page && !empty($entry_og_image))
    ? $entry_og_image
    : (!empty($page_og_image) ? $page_og_image : $default_og_image);
  ?>
  <link rel="canonical" href="<?php echo htmlspecialchars($canonical_url, ENT_QUOTES, 'UTF-8'); ?>">
  <title><?php echo htmlspecialchars($head_title, ENT_QUOTES, 'UTF-8'); ?></title>
  <?php if (!empty($page_noindex)): ?><meta name="robots" content="noindex, follow">
  <?php endif; ?><meta name="description" content="<?php echo htmlspecialchars($head_meta_description, ENT_QUOTES, 'UTF-8'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <meta name="format-detection" content="telephone=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preconnect" href="https://use.fontawesome.com" crossorigin>
  <link href="css/reset.css?v=<?= filemtime(__DIR__ . '/css/reset.css') ?>" rel="stylesheet">
  <link href="css/setting.css?v=<?= filemtime(__DIR__ . '/css/setting.css') ?>" rel="stylesheet">
  <link href="css/style.css?v=<?= filemtime(__DIR__ . '/css/style.css') ?>" rel="stylesheet">
  <link href="css/animation_scroll.css?v=<?= filemtime(__DIR__ . '/css/animation_scroll.css') ?>" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v6.1.2/css/all.css" rel="stylesheet">
  <link href="css/site-common-renewal.css?v=<?= filemtime(__DIR__ . '/css/site-common-renewal.css') ?>" rel="stylesheet">
  <?php echo $page_style ?? ''; ?>
  <?php echo $page_head ?? ''; ?>
  <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru&family=Courgette&display=swap" rel="stylesheet">

  <!-- OGP -->
  <meta property="og:url" content="<?php echo htmlspecialchars($canonical_url, ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:type" content="<?php echo htmlspecialchars($head_og_type, ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:title" content="<?php echo htmlspecialchars($head_og_title, ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($head_og_description, ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:site_name" content="<?php echo htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:image" content="<?php echo htmlspecialchars($head_og_image, ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:locale" content="ja_JP">

  <!-- Twitter / X -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo htmlspecialchars($head_og_title, ENT_QUOTES, 'UTF-8'); ?>">
  <meta name="twitter:description" content="<?php echo htmlspecialchars($head_og_description, ENT_QUOTES, 'UTF-8'); ?>">
  <meta name="twitter:image" content="<?php echo htmlspecialchars($head_og_image, ENT_QUOTES, 'UTF-8'); ?>">

  <!-- Favicon: multi-device support -->
  <link href="<?php echo $img; ?>/favicon.png" rel="icon" type="image/png" sizes="16x16">
  <link href="<?php echo $img; ?>/favicon.png" rel="icon" type="image/png" sizes="32x32">
  <link href="<?php echo $img; ?>/favicon.png" rel="icon" type="image/png" sizes="192x192">
  <link href="<?php echo $img; ?>/favicon.png" rel="apple-touch-icon" sizes="180x180">
  <link rel="manifest" href="manifest.json">
  <meta name="theme-color" content="#ffffff">
  <meta name="msapplication-TileImage" content="<?php echo $img; ?>/favicon.png">
  <meta name="msapplication-TileColor" content="#ffffff">

  <!-- Structured Data JSON-LD -->
  <?php
  $jsonld_local = [
    "@context" => "https://schema.org",
    "@type" => "LocalBusiness",
    "name" => $company,
    "description" => $description,
    "url" => "https://d-neko.com/",
    "telephone" => $telNo,
    "image" => "https://d-neko.com/" . ltrim($img, '/') . "/ogp_image.jpg",
    "logo" => "https://d-neko.com/" . ltrim($img, '/') . "/logo.png",
    "address" => [
      "@type" => "PostalAddress",
      "postalCode" => str_replace('〒', '', $postalCode),
      "addressRegion" => $addressRegion,
      "addressLocality" => $addressLocality,
      "streetAddress" => $streetAddress,
      "addressCountry" => "JP"
    ]
  ];
  if (!empty($faxNo)) {
    $jsonld_local["faxNumber"] = $faxNo;
  }
  if (!empty($maplink)) {
    $jsonld_local["hasMap"] = $maplink;
  }
  ?>
  <script type="application/ld+json">
    <?php echo json_encode($jsonld_local, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
  </script>
  <?php if ($is_entry_page && !empty($entry_title)) : ?>
    <!-- Structured Data: Article -->
    <script type="application/ld+json">
      {
        "@context": "https://schema.org",
        "@type": "BlogPosting",
        "headline": "<?php echo htmlspecialchars($entry_title, ENT_QUOTES, 'UTF-8'); ?>",
        "description": "<?php echo htmlspecialchars(!empty($entry_description) ? $entry_description : $description, ENT_QUOTES, 'UTF-8'); ?>",
        "image": "<?php echo htmlspecialchars($head_og_image, ENT_QUOTES, 'UTF-8'); ?>",
        "url": "<?php echo htmlspecialchars($canonical_url, ENT_QUOTES, 'UTF-8'); ?>",
        "author": {
          "@type": "Organization",
          "name": "<?php echo htmlspecialchars($company, ENT_QUOTES, 'UTF-8'); ?>",
          "url": "https://d-neko.com/"
        },
        "publisher": {
          "@type": "Organization",
          "name": "<?php echo htmlspecialchars($company, ENT_QUOTES, 'UTF-8'); ?>",
          "logo": {
            "@type": "ImageObject",
            "url": "https://d-neko.com/<?php echo ltrim($img, '/'); ?>/logo.png"
          }
        }
        <?php if (!empty($microcms_blog_entry->publishedAt)) : ?>,
          "datePublished": "<?php echo htmlspecialchars($microcms_blog_entry->publishedAt, ENT_QUOTES, 'UTF-8'); ?>"
        <?php endif; ?>
        <?php if (!empty($microcms_blog_entry->updatedAt)) : ?>,
          "dateModified": "<?php echo htmlspecialchars($microcms_blog_entry->updatedAt, ENT_QUOTES, 'UTF-8'); ?>"
        <?php endif; ?>
      }
    </script>
  <?php endif; ?>

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-T46Y45V5X6"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-T46Y45V5X6');
  </script>
  <script src="/js/visitor_tracker.js" defer></script>

  <?php
    // Microsoft Clarity（ヒートマップ・セッション録画／無料）
    // https://clarity.microsoft.com でプロジェクトを作成し、発行されたIDを設定すると有効になります
    $clarity_id = 'xn9icqs3q4';
  ?>
  <script>
    <?php if ($clarity_id !== ''): ?>
    window.clarity = window.clarity || function() {
      (window.clarity.q = window.clarity.q || []).push(arguments);
    };
    <?php endif; ?>

    window.addEventListener('load', function() {
      var loadAnalytics = function() {
        <?php if ($clarity_id !== ''): ?>
        var clarityScript = document.createElement('script');
        clarityScript.async = true;
        clarityScript.src = 'https://www.clarity.ms/tag/<?php echo htmlspecialchars($clarity_id, ENT_QUOTES, 'UTF-8'); ?>';
        document.head.appendChild(clarityScript);
        <?php endif; ?>

        var juicerScript = document.createElement('script');
        juicerScript.async = true;
        juicerScript.src = 'https://kitchen.juicer.cc/?color=ND+ngZfbDgU=';
        document.head.appendChild(juicerScript);
      };

      if ('requestIdleCallback' in window) {
        window.requestIdleCallback(loadAnalytics, { timeout: 3000 });
      } else {
        window.setTimeout(loadAnalytics, 1500);
      }
    }, { once: true });
  </script>
</head>

<body id="top" class="<?php echo trim(($is_dnk_lp_home ? 'dnk_lp_body ' : '') . ($is_home_renewal ? 'dneko_home_body' : '')); ?>">
  <header class="dr_header">
    <div class="dr_header_inner">
      <div class="dr_header_top">
        <a class="dr_logo" href="./" aria-label="デザネコ ホーム">
          <img src="<?php echo $img; ?>/logo.png" alt="<?php echo htmlspecialchars($site_name, ENT_QUOTES, 'UTF-8'); ?>" width="424" height="160" decoding="async">
        </a>

        <div class="dr_header_sns" aria-label="ソーシャルメディアとお問い合わせ">
          <a href="<?php echo htmlspecialchars($instagram, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" aria-label="Instagramを開く">
            <i class="fa-brands fa-instagram" aria-hidden="true"></i><span>Instagram</span>
          </a>
          <a href="<?php echo htmlspecialchars($youtube, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" aria-label="YouTubeを開く">
            <i class="fa-brands fa-youtube" aria-hidden="true"></i><span>YouTube</span>
          </a>
          <a href="contact.php" aria-label="お問い合わせページを開く">
            <i class="fa-solid fa-envelope" aria-hidden="true"></i><span>お問い合わせ</span>
          </a>
        </div>

        <button class="dr_menu_button" type="button" aria-expanded="false" aria-controls="dr-global-nav" aria-label="メニューを開く">
          <span></span><span></span><span></span><b>MENU</b>
        </button>
      </div>

      <nav id="dr-global-nav" class="dr_global_nav" aria-label="メインナビゲーション">
        <?php dneko_render_navigation($dr_navigation_items, 'dr_global_nav_list commonnav'); ?>
      </nav>
    </div>
  </header>
