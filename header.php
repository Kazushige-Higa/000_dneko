<?php require_once './common.php'; ?>
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
  $head_title_suffix = ($url === "index.php" || ($is_entry_page && !empty($entry_title))) ? '' : '｜' . $title;
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
  $head_og_title = ($is_entry_page && !empty($entry_title)) ? $entry_title : $title;
  $head_og_description = ($is_entry_page && !empty($entry_description)) ? $entry_description : $description;
  $head_og_image = ($is_entry_page && !empty($entry_og_image)) ? $entry_og_image : $default_og_image;
  ?>
  <link rel="canonical" href="<?php echo htmlspecialchars(nowUrl(), ENT_QUOTES, 'UTF-8'); ?>">
  <title><?php echo htmlspecialchars($head_prefix . $head_title_suffix, ENT_QUOTES, 'UTF-8'); ?></title>
  <meta name="Description" content="<?php echo htmlspecialchars($head_meta_description, ENT_QUOTES, 'UTF-8'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <meta name="format-detection" content="telephone=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link href="css/reset.css" rel="stylesheet">
  <link href="css/setting.css" rel="stylesheet">
  <link href="css/style.css?v=<?= filemtime(__DIR__ . '/css/style.css') ?>" rel="stylesheet">
  <link href="css/animation_scroll.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v6.1.2/css/all.css" rel="stylesheet">
  <?php echo $page_style; ?>
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
</head>

<body id="top">
  <header>
    <div class="fixed bg_white z_index_10 width_10 width_sp10 t0">
      <div class="width_10 bg_white">
        <div class='space_1 space_sp1'></div>
        <div class='flex gap0 a_center j_center'>
          <div class='width_2 width_sp3'>
            <h1>
              <a href="./">
                <img src='<?php echo $img; ?>/logo.png' alt='<?php echo $title; ?>' loading='lazy'>
              </a>
            </h1>
          </div>
          <div class="width_4 b_m0 pconly">
            <nav class="nav_main set5 tcenter pconly bold center" aria-label="メインナビゲーション">
              <ul class="commonnav" ontouchstart="">
                <li>
                  <a href="./">
                    <span>Home</span>
                    ホーム
                  </a>
                </li>
                <li>
                  <a href="about.php">
                    <span>About Us</span>
                    デザネコについて
                  </a>
                  <ul>
                    <li><a href="service_blog.php">ブログ制作サービス・料金</a></li>
                    <li><a href="service_design.php">印刷デザインサービス・料金</a></li>
                  </ul>
                </li>
                <li>
                  <a href="moja-cat.php">
                    <span>Moja cat</span>
                    もじゃネコについて
                  </a>
                </li>
                <li>
                  <a href="voice.php">
                    <span>Voice</span>
                    お客様の声
                  </a>
                </li>
                <li>
                  <a href="faq.php">
                    <span>FAQ</span>
                    よくあるご質問
                  </a>
                </li>
              </ul>
            </nav>
          </div>
          <div class="width_2 pconly">
            <button class='btn_normal bg_line radius center font_ja'>
              <a href='<?php echo $line; ?>' target='_blank' rel='noopener'
                onclick="gtag('event','line_click',{'event_category':'contact','event_label':'header_pc'})">
                <i class="fa-brands fa-line fs_20" aria-hidden="true" style="margin-right:6px;"></i>
                LINEで無料相談
              </a>
            </button>
          </div>
        </div>
        <div class='space_1 space_sp1'></div>
      </div>
    </div>
    <!-- nav_slide_toggle -->
    <div id="nav_slide_toggle" class="nav_slide_toggle sponly">
      <div class="hamburger_icon">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <span class="menu_text">MENU</span>
    </div>

    <div id="nav_slide_right" class="nav_slide_right">
      <div class="nav_overlay"></div>
      <div class="nav_slide_container">
        <!--  <div class="nav_bg_image">
            <img src="<?php echo $img; ?>/01.webp" alt="イメージ画像">
            <div class="bg_overlay"></div>
        </div> -->
        <div class="nav_menu_area">
          <div class="nav_close_btn">
            <span>×</span>
          </div>

          <nav class="nav_menu_content clone_nav">
          </nav>
          <div class='space_3 space_sp1'></div>
          <div>
            <button class='btn_normal bg_line radius center font_ja'>
              <a href='<?php echo $line; ?>' target='_blank' rel='noopener'
                onclick="gtag('event','line_click',{'event_category':'contact','event_label':'header_sp'})">
                <i class="fa-brands fa-line fs_20" aria-hidden="true" style="margin-right:6px;"></i>
                LINEで無料相談
              </a>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- nav_slide_toggle -->
  </header>