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
  $is_entry_page = preg_match('/^entry\d{0,2}\.php$/', $url);
  $head_prefix = !empty($page_title) ? $page_title : $title;
  if ($is_entry_page && !empty($entry_title)) {
    $head_prefix = $entry_title;
  }
  $head_title_suffix = (!empty($page_title_exact) || $url === "index.php" || ($is_entry_page && !empty($entry_title))) ? '' : '｜' . $title;
  $head_description_suffix = ($url === "index.php") ? '' : '｜' . $description;
  $head_meta_description = $head_prefix . $head_description_suffix;
  if (!empty($page_description)) {
    $head_meta_description = $page_description;
  }
  if ($is_entry_page && !empty($entry_description)) {
    $head_meta_description = $entry_description;
  }
  $default_og_image = ((strpos($img, 'http://') === 0) || (strpos($img, 'https://') === 0))
    ? $img . '/ogp_image.jpg'
    : ((isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . ltrim($img, '/') . '/ogp_image.jpg');
  $head_og_type = ($is_entry_page && !empty($entry_title)) ? 'article' : 'website';
  $head_og_title = ($is_entry_page && !empty($entry_title))
    ? $entry_title
    : (!empty($page_title) ? $page_title : $title);
  $head_og_description = ($is_entry_page && !empty($entry_description))
    ? $entry_description
    : (!empty($page_description) ? $page_description : $description);
  // ページ独自OGP画像対応（個別ページで $page_og_image を設定すると差し替えられる）
  $head_og_image = ($is_entry_page && !empty($entry_og_image))
    ? $entry_og_image
    : (!empty($page_og_image) ? $page_og_image : $default_og_image);
  ?>
  <link rel="canonical" href="<?php echo htmlspecialchars(nowUrl(), ENT_QUOTES, 'UTF-8'); ?>">
  <title><?php echo htmlspecialchars($head_prefix . $head_title_suffix, ENT_QUOTES, 'UTF-8'); ?></title>
  <?php if (!empty($page_noindex)): ?><meta name="robots" content="noindex, nofollow">
  <?php endif; ?><meta name="Description" content="<?php echo htmlspecialchars($head_meta_description, ENT_QUOTES, 'UTF-8'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <meta name="format-detection" content="telephone=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="css/reset.css" rel="stylesheet">
  <link href="css/setting.css" rel="stylesheet">
  <link href="css/style.css?v=<?= filemtime(__DIR__ . '/css/style.css') ?>" rel="stylesheet">
  <link href="css/animation_scroll.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v6.1.2/css/all.css" rel="stylesheet">
  <link href="css/site-common-renewal.css?v=<?= filemtime(__DIR__ . '/css/site-common-renewal.css') ?>" rel="stylesheet">
  <?php echo $page_style ?? ''; ?>
  <?php echo $page_head ?? ''; ?>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kiwi+Maru&family=Courgette&display=swap" rel="stylesheet">

  <!-- OGP -->
  <meta property="og:url" content="<?php echo htmlspecialchars(nowUrl(), ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:type" content="<?php echo htmlspecialchars($head_og_type, ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:title" content="<?php echo htmlspecialchars($head_og_title, ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($head_og_description, ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:site_name" content="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>">
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
    "url" => nowUrl(),
    "telephone" => $telNo,
    "image" => ((strpos($img, 'http') === 0) ? $img : ((isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . ltrim($img, '/'))) . '/ogp_image.jpg',
    "logo" => ((strpos($img, 'http') === 0) ? $img : ((isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . ltrim($img, '/'))) . '/logo.png',
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
        "url": "<?php echo htmlspecialchars(nowUrl(), ENT_QUOTES, 'UTF-8'); ?>",
        "author": {
          "@type": "Organization",
          "name": "<?php echo htmlspecialchars($company, ENT_QUOTES, 'UTF-8'); ?>",
          "url": "<?php echo (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/'; ?>"
        },
        "publisher": {
          "@type": "Organization",
          "name": "<?php echo htmlspecialchars($company, ENT_QUOTES, 'UTF-8'); ?>",
          "logo": {
            "@type": "ImageObject",
            "url": "<?php echo (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . $img . '/logo.png'; ?>"
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
  <script src="//kitchen.juicer.cc/?color=ND+ngZfbDgU=" async></script>
  <script src="/js/visitor_tracker.js" defer></script>

  <?php
    // Microsoft Clarity（ヒートマップ・セッション録画／無料）
    // https://clarity.microsoft.com でプロジェクトを作成し、発行されたIDを設定すると有効になります
    $clarity_id = 'xn9icqs3q4';
  ?>
  <?php if ($clarity_id !== ''): ?>
  <script>
    (function(c,l,a,r,i,t,y){
        c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
        t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
        y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
    })(window, document, "clarity", "script", "<?php echo htmlspecialchars($clarity_id, ENT_QUOTES, 'UTF-8'); ?>");
  </script>
  <?php endif; ?>
</head>

<body id="top" class="<?php echo trim(($is_dnk_lp_home ? 'dnk_lp_body ' : '') . ($is_home_renewal ? 'dneko_home_body' : '')); ?>">
  <header class="dr_header">
    <div class="dr_header_inner">
      <div class="dr_header_top">
        <a class="dr_logo" href="./" aria-label="デザネコ ホーム">
          <img src="<?php echo $img; ?>/logo.png" alt="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>">
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
