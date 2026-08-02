<?php
$home_renewal = true;
$page_title = "デザネコ｜沖縄のデザイン・Web制作・AI活用相談";
$page_description = "沖縄のチラシ・ホームページ制作・AI活用相談ならデザネコへ。看板猫もじゃ・くるると一緒に、撮影からデザイン、公開後の改善まで伴走します。";
$page_og_image = "https://d-neko.com/images/home-renewal/ogp-home.jpg";
$page_style = '<link href="css/index-renewal.css?v=' . filemtime(__DIR__ . '/css/index-renewal.css') . '" rel="stylesheet">';
$page_head = '<link rel="preload" as="image" href="images/home-renewal/hero-flyer-mobile.webp" type="image/webp" media="(max-width: 600px)" fetchpriority="high">'
  . '<link rel="preload" as="image" href="images/home-renewal/hero-flyer.webp" type="image/webp" media="(min-width: 601px)" fetchpriority="high">';
$page_script = '<script src="js/index-renewal.js?v=' . filemtime(__DIR__ . '/js/index-renewal.js') . '" defer></script>';
include_once './header.php';

$portfolio_response = microcms_get_list("/works", "limit=8&orders=-publishedAt");
$portfolio_posts = ($portfolio_response && !empty($portfolio_response->contents)) ? $portfolio_response->contents : [];
$blog_response = microcms_get_list("/blog", "limit=8&orders=-publishedAt");
$blog_posts = ($blog_response && !empty($blog_response->contents)) ? $blog_response->contents : [];
$column_response = microcms_get_list("/column", "limit=8&orders=-publishedAt");
$column_posts = ($column_response && !empty($column_response->contents)) ? $column_response->contents : [];
$home_notices = [
  [
    'date' => '2026-07-30',
    'label' => '2026/07/30',
    'title' => '沖縄のご家庭向け「デジタルのネコの手」を開始しました',
    'href' => 'service_digital.php',
  ],
  [
    'date' => '2026-07-23',
    'label' => '2026/07/23',
    'title' => 'デザネコのホームページをリニューアルしました',
    'href' => 'entry_list.php?type=blog',
  ],
];

if (!function_exists('dneko_home_escape')) {
  function dneko_home_escape($value)
  {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
  }
}

if (!function_exists('dneko_home_thumbnail')) {
  function dneko_home_thumbnail($post, $width = 640)
  {
    if (isset($post->thumbnail->url) && $post->thumbnail->url !== '') {
      return dneko_home_escape($post->thumbnail->url) . '?w=' . (int)$width;
    }
    return 'images/no-img.webp';
  }
}

if (!function_exists('dneko_home_category')) {
  function dneko_home_category($post)
  {
    if (isset($post->category)) {
      return microcms_extract_category_name($post->category);
    }
    return '';
  }
}
?>

<div class="dr_page">
  <main>
    <section class="dr_hero" aria-label="デザネコのサービス">
      <div class="dr_slider dr_slider_hero" data-renewal-slider data-autoplay="6500">
        <button class="dr_slider_arrow dr_slider_prev" type="button" aria-label="前のスライド">
          <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
        </button>
        <div class="dr_slider_viewport">
          <div class="dr_slider_track">
            <article class="dr_hero_slide dr_hero_slide_orange">
              <picture class="dr_hero_media">
                <source media="(max-width: 600px)" srcset="images/home-renewal/hero-flyer-mobile.webp" width="1024" height="1536">
                <img src="images/home-renewal/hero-flyer.webp" alt="" width="1672" height="941" loading="eager" fetchpriority="high" decoding="async">
              </picture>
              <div class="dr_hero_copy">
                <p>沖縄のデザインを、もっと身近に。</p>
                <h1>沖縄の<br><strong>チラシデザイン</strong>なら<br>デザネコへ</h1>
                <a href="flyer-design.php">サービスを見る <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
              </div>
            </article>
            <article class="dr_hero_slide dr_hero_slide_green">
              <picture class="dr_hero_media">
                <source media="(max-width: 600px)" srcset="images/home-renewal/hero-ai-mobile.webp" width="1024" height="1536">
                <img src="images/home-renewal/hero-ai.webp" alt="" width="1672" height="941" loading="lazy" fetchpriority="low" decoding="async">
              </picture>
              <div class="dr_hero_copy">
                <p>やさしく始める、仕事のAI活用。</p>
                <h2><strong>AI</strong>コンサルティング</h2>
                <span>あなたの仕事に合う使い方から一緒に考えます。</span>
                <a href="ai-consulting.php">サービスを見る <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
              </div>
            </article>
            <article class="dr_hero_slide dr_hero_slide_mix">
              <picture class="dr_hero_media">
                <source media="(max-width: 600px)" srcset="images/home-renewal/hero-web-mobile.webp" width="1024" height="1536">
                <img src="images/home-renewal/hero-web.webp" alt="" width="1672" height="941" loading="lazy" fetchpriority="low" decoding="async">
              </picture>
              <div class="dr_hero_copy">
                <p>想いが伝わる、育てていける。</p>
                <h2>ホームページ<br><strong>制作サービス</strong></h2>
                <span>写真・文章・デザインから公開後まで伴走します。</span>
                <a href="service_blog.php">サービスを見る <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
              </div>
            </article>
            <article class="dr_hero_slide dr_hero_slide_digital">
              <picture class="dr_hero_media">
                <source media="(max-width: 600px)" srcset="images/home-renewal/hero-digital-support-mobile.webp" width="1024" height="1536">
                <img src="images/home-renewal/hero-digital-support.webp" alt="" width="1672" height="941" loading="lazy" fetchpriority="low" decoding="async">
              </picture>
              <div class="dr_hero_copy">
                <p>沖縄のご家庭のデジタルサポート</p>
                <h2>沖縄のご家庭に、<br><strong>デジタルのネコの手。</strong></h2>
                <span>
                  スマホ、パソコン、Wi-Fi、LINE、AIまで。<br>
                  「誰に聞けばいいか分からない」を、月額聞き放題でぜんぶ引き受ける<br>
                  <b>おうち専属のデジタル担当サービス</b>です。
                </span>
                <a href="service_digital.php">サービスを見る <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
              </div>
            </article>
          </div>
        </div>
        <button class="dr_slider_arrow dr_slider_next" type="button" aria-label="次のスライド">
          <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
        </button>
        <div class="dr_slider_dots" data-slider-dots aria-label="スライド位置"></div>
      </div>
    </section>

    <aside class="dr_notice" aria-labelledby="dr-notice-title">
      <div class="dr_notice_inner">
        <div class="dr_notice_heading">
          <h2 id="dr-notice-title">重要なお知らせ</h2>
          <a href="entry_list.php?type=blog">もっと見る <i class="fa-solid fa-circle-arrow-right" aria-hidden="true"></i></a>
        </div>
        <ul class="dr_notice_list">
          <?php foreach ($home_notices as $notice): ?>
            <li>
              <a href="<?php echo dneko_home_escape($notice['href']); ?>">
                <time datetime="<?php echo dneko_home_escape($notice['date']); ?>"><?php echo dneko_home_escape($notice['label']); ?></time>
                <span><?php echo dneko_home_escape($notice['title']); ?></span>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </aside>

    <section id="service-banner" class="dr_service_banner">
      <div class="dr_service_banner_inner">
        <div class="dr_service_text">
          <p class="dr_kicker">想いを、伝わるデザインへ。</p>
          <h2><span>沖縄のチラシデザイン</span>なら<br>デザネコへ</h2>
          <p>
            チラシ・フライヤーはもちろん、名刺・ショップカード・パンフレットまで。<br>
            撮影からデザイン、印刷・納品までトータルでサポートします。<br>
            ふんわりしたご相談から、あなたのお店やサービスを形にします。
          </p>
          <ul>
            <li><i class="fa-solid fa-file-image" aria-hidden="true"></i>チラシ</li>
            <li><i class="fa-solid fa-address-card" aria-hidden="true"></i>名刺</li>
            <li><i class="fa-solid fa-book-open" aria-hidden="true"></i>パンフレット</li>
            <li><i class="fa-solid fa-camera" aria-hidden="true"></i>一眼レフ撮影</li>
            <li><i class="fa-solid fa-print" aria-hidden="true"></i>印刷・納品</li>
          </ul>
          <a href="flyer-design.php">詳しく見る <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        <div class="dr_service_visual" aria-hidden="true">
          <img src="images/home-renewal/hero-flyer.webp" alt="" width="1672" height="941" loading="lazy" decoding="async">
        </div>
      </div>
    </section>

    <section class="dr_section dr_portfolio">
      <div class="dr_section_heading dr_heading_green">
        <h2>Portfolio</h2>
        <p>制作実績</p>
      </div>

      <div class="dr_slider dr_post_slider" data-renewal-slider>
        <button class="dr_slider_arrow dr_slider_prev" type="button" aria-label="前の制作実績">
          <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
        </button>
        <div class="dr_slider_viewport">
          <div class="dr_slider_track">
            <?php if (!empty($portfolio_posts)): ?>
              <?php foreach ($portfolio_posts as $post): ?>
                <article class="dr_post_card">
                  <a href="entry.php?type=works&amp;eid=<?php echo urlencode($post->id); ?>">
                    <img src="<?php echo dneko_home_thumbnail($post); ?>" alt="<?php echo dneko_home_escape($post->title); ?>" loading="lazy">
                    <?php $category_name = dneko_home_category($post); ?>
                    <?php if ($category_name !== ''): ?><span><?php echo dneko_home_escape($category_name); ?></span><?php endif; ?>
                    <h3><?php echo dneko_home_escape($post->title); ?></h3>
                  </a>
                </article>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="dr_empty">制作実績を準備中です。</p>
            <?php endif; ?>
          </div>
        </div>
        <button class="dr_slider_arrow dr_slider_next" type="button" aria-label="次の制作実績">
          <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
        </button>
      </div>
      <a class="dr_more_button dr_more_green" href="entry_list.php?type=works">
        制作実績を見る <i class="fa-solid fa-paw" aria-hidden="true"></i>
      </a>
    </section>

    <section class="dr_creator">
      <div class="dr_creator_inner">
        <div class="dr_creator_copy">
          <p class="dr_kicker">製作者について</p>
          <h2>制作するのは、<br class="sponly">こんな人</h2>
          <p>はじめまして、デザネコの比嘉一茂です。沖縄でデザイン・Web制作の現場に20年、約1,000件の制作に携わってきました。</p>
          <p>大きな会社のような分業ではなく、あなたの想い・写真・文章・デザイン・公開後の改善まで、最初から最後まで同じ人間が責任を持ちます。</p>
          <p>相棒の看板猫「もじゃ」と「くるる」とともに、あなたの商売のネコの手になれたら嬉しいです。</p>
          <a href="about.php">デザネコについて <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        <div class="dr_creator_visual">
          <img class="dr_creator_profile" src="images/profile.jpg" alt="デザネコ代表 比嘉一茂" loading="lazy">
          <img class="dr_creator_moja" src="images/sticker/42.webp" alt="看板猫もじゃ" loading="lazy">
          <img class="dr_creator_kururu" src="images/sticker/01.webp" alt="看板猫くるる" loading="lazy">
        </div>
      </div>
    </section>

    <section class="dr_section dr_blog">
      <div class="dr_section_heading dr_heading_green">
        <h2>Blog</h2>
        <p>ブログ</p>
      </div>

      <div class="dr_slider dr_post_slider" data-renewal-slider>
        <button class="dr_slider_arrow dr_slider_prev" type="button" aria-label="前のブログ">
          <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
        </button>
        <div class="dr_slider_viewport">
          <div class="dr_slider_track">
            <?php if (!empty($blog_posts)): ?>
              <?php foreach ($blog_posts as $post): ?>
                <article class="dr_post_card">
                  <a href="entry.php?type=blog&amp;eid=<?php echo urlencode($post->id); ?>">
                    <img src="<?php echo dneko_home_thumbnail($post); ?>" alt="<?php echo dneko_home_escape($post->title); ?>" loading="lazy">
                    <?php $category_name = dneko_home_category($post); ?>
                    <?php if ($category_name !== ''): ?><span><?php echo dneko_home_escape($category_name); ?></span><?php endif; ?>
                    <h3><?php echo dneko_home_escape($post->title); ?></h3>
                  </a>
                </article>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="dr_empty">ブログ記事を準備中です。</p>
            <?php endif; ?>
          </div>
        </div>
        <button class="dr_slider_arrow dr_slider_next" type="button" aria-label="次のブログ">
          <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
        </button>
      </div>
      <a class="dr_more_button dr_more_green" href="entry_list.php?type=blog">
        ブログを見る <i class="fa-solid fa-paw" aria-hidden="true"></i>
      </a>
    </section>

    <section class="dr_creator dr_story dr_story_digital">
      <div class="dr_creator_inner">
        <div class="dr_creator_copy">
          <p class="dr_kicker">ご家庭向けデジタルサポート</p>
          <h2>沖縄のご家庭に、<br>デジタルのネコの手。</h2>
          <p>スマホの設定、パソコンの困りごと、Wi-Fiの不調、LINEの使い方、AIへのちょっとした疑問まで。ご家族に代わって、同じ担当者が何度でもやさしくお答えします。</p>
          <p>難しい言葉は使いません。「こんなことを聞いてもいいのかな？」という内容こそ、気兼ねなくご相談ください。</p>
          <ul class="dr_story_points" aria-label="サポート内容">
            <li><i class="fa-solid fa-mobile-screen-button" aria-hidden="true"></i>スマホ</li>
            <li><i class="fa-solid fa-laptop" aria-hidden="true"></i>パソコン</li>
            <li><i class="fa-solid fa-wifi" aria-hidden="true"></i>Wi-Fi</li>
            <li><i class="fa-brands fa-line" aria-hidden="true"></i>LINE・AI</li>
          </ul>
          <a href="service_digital.php">サービスについて <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        <div class="dr_story_visual">
          <img src="images/home-renewal/home-digital-support-section.webp" alt="もじゃとくるるが沖縄のご夫婦のスマホとパソコンをサポートする様子" width="1100" height="825" loading="lazy" decoding="async">
        </div>
      </div>
    </section>

    <section class="dr_section dr_column">
      <img class="dr_section_mascots dr_section_mascots_column" src="images/home-renewal/deco-column.webp" alt="" width="1600" height="533" loading="lazy" decoding="async">
      <div class="dr_section_heading dr_heading_orange">
        <h2>Column</h2>
        <p>お役立ちコラム</p>
      </div>
      <p class="dr_section_lead">デザインやAIについて、お役立ちコラムを配信中です。</p>

      <div class="dr_slider dr_post_slider" data-renewal-slider>
        <button class="dr_slider_arrow dr_slider_prev" type="button" aria-label="前のコラム">
          <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
        </button>
        <div class="dr_slider_viewport">
          <div class="dr_slider_track">
            <?php if (!empty($column_posts)): ?>
              <?php foreach ($column_posts as $post): ?>
                <article class="dr_post_card">
                  <a href="entry.php?type=column&amp;eid=<?php echo urlencode($post->id); ?>">
                    <img src="<?php echo dneko_home_thumbnail($post); ?>" alt="<?php echo dneko_home_escape($post->title); ?>" loading="lazy">
                    <?php $category_name = dneko_home_category($post); ?>
                    <?php if ($category_name !== ''): ?><span><?php echo dneko_home_escape($category_name); ?></span><?php endif; ?>
                    <h3><?php echo dneko_home_escape($post->title); ?></h3>
                  </a>
                </article>
              <?php endforeach; ?>
            <?php else: ?>
              <p class="dr_empty">コラムを準備中です。</p>
            <?php endif; ?>
          </div>
        </div>
        <button class="dr_slider_arrow dr_slider_next" type="button" aria-label="次のコラム">
          <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
        </button>
      </div>
      <a class="dr_more_button dr_more_orange" href="entry_list.php?type=column">
        コラムを見る <i class="fa-solid fa-paw" aria-hidden="true"></i>
      </a>
    </section>

    <section class="dr_creator dr_story dr_story_mascots">
      <div class="dr_creator_inner">
        <div class="dr_story_visual">
          <img src="images/home-renewal/home-mascot-introduction.webp" alt="デザインスタジオで仲良く制作する公式キャラクターのもじゃとくるる" width="1100" height="825" loading="lazy" decoding="async">
        </div>
        <div class="dr_creator_copy">
          <p class="dr_kicker">デザネコ公式キャラクター</p>
          <h2>「もじゃ」と<br>「くるる」</h2>
          <p>くるくるの前髪と金色の瞳がチャームポイントの黒猫「もじゃ」と、白い巻き毛にピンクのリボンが似合う「くるる」。</p>
          <p>性格はちょっぴり違うけれど、デザインと人を笑顔にすることが大好きな仲良しコンビです。制作のお手伝いや音楽、グッズなど、いろいろな場所で活躍しています。</p>
          <a href="moja-cat.php">もじゃとくるるについて <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
      </div>
    </section>

    <section class="dr_section dr_movies">
      <img class="dr_section_mascots dr_section_mascots_youtube" src="images/home-renewal/deco-youtube.webp" alt="" width="1600" height="533" loading="lazy" decoding="async">
      <div class="dr_section_heading dr_heading_pink">
        <h2>YouTube</h2>
        <p>ムービー</p>
      </div>

      <div class="dr_slider dr_movie_slider" data-renewal-slider>
        <button class="dr_slider_arrow dr_slider_prev" type="button" aria-label="前のムービー">
          <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
        </button>
        <div class="dr_slider_viewport">
          <div class="dr_slider_track">
            <article class="dr_movie_card">
              <button class="dr_movie_trigger" type="button" data-youtube-id="SzaEuEhwsgY" aria-haspopup="dialog" aria-label="「酔いどれニャンコの夜」を再生">
                <figure>
                  <img src="images/home-renewal/youtube-halloween.webp" alt="【MV】酔いどれニャンコの夜" loading="lazy">
                  <i class="fa-solid fa-play" aria-hidden="true"></i>
                </figure>
                <h3>【MV】酔いどれニャンコの夜</h3>
              </button>
            </article>
            <article class="dr_movie_card">
              <button class="dr_movie_trigger" type="button" data-youtube-id="ywfFxf84tIA" aria-haspopup="dialog" aria-label="「にゃん！にゃん！ハロウィンニャイト」を再生">
                <figure>
                  <img src="images/home-renewal/youtube-yoi.webp" alt="【MV】にゃん！にゃん！ハロウィンニャイト" loading="lazy">
                  <i class="fa-solid fa-play" aria-hidden="true"></i>
                </figure>
                <h3>【MV】にゃん！にゃん！ハロウィンニャイト🐈️</h3>
              </button>
            </article>
            <article class="dr_movie_card">
              <button class="dr_movie_trigger" type="button" data-youtube-id="bDvGTUucj78" aria-haspopup="dialog" aria-label="「ありがとう僕の小さなネコ」を再生">
                <figure>
                  <img src="images/home-renewal/youtube-thanks.webp" alt="【MV】ありがとう僕の小さなネコ" loading="lazy">
                  <i class="fa-solid fa-play" aria-hidden="true"></i>
                </figure>
                <h3>【MV】ありがとう僕の小さなネコ</h3>
              </button>
            </article>
          </div>
        </div>
        <button class="dr_slider_arrow dr_slider_next" type="button" aria-label="次のムービー">
          <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
        </button>
      </div>

      <a class="dr_more_button dr_more_pink" href="https://www.youtube.com/@design-cat" target="_blank" rel="noopener">
        もっと見る <i class="fa-solid fa-circle-play" aria-hidden="true"></i>
      </a>
    </section>

    <section class="dr_section dr_goods">
      <div class="dr_section_heading dr_heading_orange">
        <h2>Goods</h2>
        <p>もじゃねこグッズ 人気ランキング</p>
      </div>

      <div class="dr_slider dr_card_slider" data-renewal-slider>
        <button class="dr_slider_arrow dr_slider_prev" type="button" aria-label="前のグッズ">
          <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
        </button>
        <div class="dr_slider_viewport">
          <ol class="dr_slider_track dr_goods_track">
            <li class="dr_goods_card">
              <span class="dr_rank dr_rank_1">No.<b>1</b></span>
              <a href="https://suzuri.jp/design_cat" target="_blank" rel="noopener">
                <img src="images/goods01.webp" alt="もじゃねこTシャツ" loading="lazy">
                <h3>もじゃねこTシャツ</h3>
                <p>もじゃ＆くるるの仲良しデザイン</p>
              </a>
            </li>
            <li class="dr_goods_card">
              <span class="dr_rank dr_rank_2">No.<b>2</b></span>
              <a href="https://suzuri.jp/design_cat" target="_blank" rel="noopener">
                <img src="images/goods02.webp" alt="もじゃねこトートバッグ" loading="lazy">
                <h3>トートバッグ</h3>
                <p>毎日使えるナチュラルカラー</p>
              </a>
            </li>
            <li class="dr_goods_card">
              <span class="dr_rank dr_rank_3">No.<b>3</b></span>
              <a href="https://suzuri.jp/design_cat" target="_blank" rel="noopener">
                <img src="images/goods03.webp" alt="スマホケースとマグカップ" loading="lazy">
                <h3>スマホケース＆マグカップ</h3>
                <p>いつでも一緒の定番アイテム</p>
              </a>
            </li>
            <li class="dr_goods_card">
              <a href="https://suzuri.jp/design_cat" target="_blank" rel="noopener">
                <img src="images/goods04.webp" alt="ソックスとアクリルキーホルダー" loading="lazy">
                <h3>小物コレクション</h3>
                <p>ソックス＆アクリルキーホルダー</p>
              </a>
            </li>
            <li class="dr_goods_card dr_goods_card_sticker">
              <a href="https://store.line.me/stickershop/author/5708453/ja" target="_blank" rel="noopener">
                <img src="images/sticker/42.webp" alt="もじゃねこLINEスタンプ" loading="lazy">
                <h3>LINEスタンプ</h3>
                <p>会話がふわっと楽しくなるスタンプ</p>
              </a>
            </li>
          </ol>
        </div>
        <button class="dr_slider_arrow dr_slider_next" type="button" aria-label="次のグッズ">
          <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
        </button>
      </div>

      <a class="dr_more_button dr_more_orange" href="https://suzuri.jp/design_cat" target="_blank" rel="noopener">
        グッズを見る <i class="fa-solid fa-paw" aria-hidden="true"></i>
      </a>
    </section>

  </main>

</div>

<div class="dr_video_modal" data-video-modal hidden>
  <div class="dr_video_modal_backdrop" data-video-close></div>
  <div class="dr_video_dialog" role="dialog" aria-modal="true" aria-labelledby="dr-video-title" tabindex="-1">
    <div class="dr_video_dialog_header">
      <h2 id="dr-video-title">YouTubeムービー</h2>
      <button class="dr_video_close" type="button" data-video-close aria-label="動画を閉じる">
        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
      </button>
    </div>
    <div class="dr_video_frame">
      <iframe title="デザネコ YouTube動画" src="" allow="autoplay; encrypted-media; picture-in-picture" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
  </div>
</div>

<?php include_once './footer.php'; ?>
