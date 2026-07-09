<?php
$entry_type = isset($_GET["type"]) ? trim((string)$_GET["type"]) : 'blog';
if ($entry_type !== 'works' && $entry_type !== 'column') {
  $entry_type = 'blog';
}

if ($entry_type === 'works') {
  $page_title = "制作実績";
  $page_title_eng = "Portfolio";
} elseif ($entry_type === 'column') {
  $page_title = "コラム";
  $page_title_eng = "Column";
} else {
  $page_title = "新着情報";
  $page_title_eng = "News";
}
$page_description = "";
$page_style = "";
$page_script = '';
?>
<?php include_once './header.php'; ?>

<?php
// Get article ID from URL parameter
$eid = isset($_GET["eid"]) ? trim($_GET["eid"]) : '';
$entry_endpoint = ($entry_type === 'works') ? "/works" : (($entry_type === 'column') ? "/column" : "/blog");
$list_back_link = "entry_list.php?type=" . urlencode($entry_type);
if ($entry_type === 'works') {
  $list_back_text = "制作実績一覧へ戻る";
  $related_heading = "関連制作実績";
} elseif ($entry_type === 'column') {
  $list_back_text = "コラム一覧へ戻る";
  $related_heading = "関連コラム";
} else {
  $list_back_text = "記事一覧へ戻る";
  $related_heading = "関連記事";
}
$post = !empty($eid) ? microcms_get($entry_endpoint . "/" . rawurlencode($eid)) : null;
?>

<div class='space_10 space_sp8'></div>
<div class="blog_wrap">
  <div class="column">
    <main class="mainwrap">

      <?php if ($post): ?>
        <?php
        if ($entry_type === 'works') {
          $category_name = '制作実績';
          $category_link = 'entry_list.php?type=works';
        } elseif ($entry_type === 'column') {
          $category_name = 'コラム';
          $category_link = 'entry_list.php?type=column';
        } else {
          $primary_tag = (isset($post->tags) && !empty($post->tags)) ? $post->tags[0] : null;
          $category_name = ($primary_tag && isset($primary_tag->name)) ? $primary_tag->name : 'カテゴリーなし';
          $category_link = ($primary_tag && isset($primary_tag->id))
            ? 'entry_list.php?type=blog&tag=' . urlencode($primary_tag->id)
            : 'entry_list.php?type=blog';
        }

        $writer_name = isset($post->writer->name) ? $post->writer->name : 'ライター';
        $writer_image = isset($post->writer->image->url) ? $post->writer->image->url : '';
        $writer_profile = '';
        if (isset($post->writer)) {
          foreach (['profile', 'description', 'text', 'body', 'content'] as $writer_profile_key) {
            if (isset($post->writer->{$writer_profile_key})) {
              $writer_profile_candidate = trim((string)$post->writer->{$writer_profile_key});
              if ($writer_profile_candidate !== '') {
                $writer_profile = $writer_profile_candidate;
                break;
              }
            }
          }
        }
        if ($writer_profile === '') {
          $writer_profile = 'プロフィール情報は準備中です。';
        }
        $writer_profile_has_html = preg_match('/<[^>]+>/', $writer_profile) === 1;

        $published_timestamp = isset($post->publishedAt) ? strtotime($post->publishedAt) : (isset($post->createdAt) ? strtotime($post->createdAt) : false);
        $updated_timestamp = isset($post->updatedAt) ? strtotime($post->updatedAt) : $published_timestamp;
        $published_date_display = $published_timestamp ? date('Y.m.d', $published_timestamp) : '-';
        $updated_date_display = $updated_timestamp ? date('Y.m.d', $updated_timestamp) : '-';
        $published_date_attr = $published_timestamp ? date('Y-m-d', $published_timestamp) : '';
        $updated_date_attr = $updated_timestamp ? date('Y-m-d', $updated_timestamp) : '';

        $summary = '';
        foreach (['description', 'summary', 'excerpt'] as $summary_key) {
          if (isset($post->{$summary_key}) && trim(strip_tags((string)$post->{$summary_key})) !== '') {
            $summary = trim(strip_tags((string)$post->{$summary_key}));
            break;
          }
        }
        if ($summary === '') {
          $plain_content = trim(preg_replace('/\s+/u', ' ', strip_tags((string)($post->content ?? ''))));
          if (function_exists('mb_substr') && function_exists('mb_strlen')) {
            $summary = mb_substr($plain_content, 0, 120, 'UTF-8');
            if (mb_strlen($plain_content, 'UTF-8') > 120) {
              $summary .= '...';
            }
          } else {
            $summary = substr($plain_content, 0, 120);
            if (strlen($plain_content) > 120) {
              $summary .= '...';
            }
          }
        }

        $navigation_date_field = !empty($post->publishedAt) ? 'publishedAt' : 'createdAt';
        $current_navigation_date = isset($post->{$navigation_date_field}) ? trim((string)$post->{$navigation_date_field}) : '';
        $prev_post = null;
        $next_post = null;

        if ($current_navigation_date !== '') {
          $prev_result = microcms_get(
            $entry_endpoint
              . '?limit=1'
              . '&orders=-' . $navigation_date_field
              . '&filters=' . $navigation_date_field . '[less_than]' . rawurlencode($current_navigation_date)
          );
          if ($prev_result && !empty($prev_result->contents) && isset($prev_result->contents[0])) {
            $prev_post = $prev_result->contents[0];
          }

          $next_result = microcms_get(
            $entry_endpoint
              . '?limit=1'
              . '&orders=' . $navigation_date_field
              . '&filters=' . $navigation_date_field . '[greater_than]' . rawurlencode($current_navigation_date)
          );
          if ($next_result && !empty($next_result->contents) && isset($next_result->contents[0])) {
            $next_post = $next_result->contents[0];
          }
        }
        ?>

        <article class="blog_article">
          <header>
            <div class="blog_category">
              <a href="<?php echo htmlspecialchars($category_link, ENT_QUOTES, 'UTF-8'); ?>" rel="category tag"><?php echo htmlspecialchars($category_name, ENT_QUOTES, 'UTF-8'); ?></a>
            </div>
            <div>
              <ul class="breadcrumb">
                <li><a href="./"><i class="fa-solid fa-house"></i></a></li>
                <li><a href="entry.php?type=<?php echo urlencode($entry_type); ?>&eid=<?php echo urlencode($post->id); ?>"><?php echo htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8'); ?></a></li>
              </ul>
            </div>
            <h1>
              <?php echo htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8'); ?>
            </h1>
            <address>
              <div class="author-box">
                <div class="author-img">
                  <?php if ($writer_image !== ''): ?>
                    <img src="<?php echo htmlspecialchars($writer_image, ENT_QUOTES, 'UTF-8'); ?>?w=96" alt="<?php echo htmlspecialchars($writer_name, ENT_QUOTES, 'UTF-8'); ?>の画像" loading="lazy">
                  <?php else: ?>
                    <img src="<?php echo $img; ?>/no-img.webp" alt="ライターの画像" loading="lazy">
                  <?php endif; ?>
                </div>
                <div class="author-name">
                  <a href="/profile" rel="author">
                    <?php echo htmlspecialchars($writer_name, ENT_QUOTES, 'UTF-8'); ?>
                  </a>
                </div>
              </div>
            </address>
            <div>
              <button id="like-button" class="like-button" data-post-id="<?php echo htmlspecialchars($post->id, ENT_QUOTES, 'UTF-8'); ?>">
                <i class="fa-solid fa-heart"></i><span id="like-count">0</span><span id="like-text"></span>
              </button>
              <div class="access-count">
                <i class="fa-solid fa-eye"></i><span id="access-count">-</span>
              </div>
              <time class="date-article" itemprop="datePublished" datetime="<?php echo $published_date_attr; ?>"><i class="far fa-clock"></i><?php echo htmlspecialchars($published_date_display, ENT_QUOTES, 'UTF-8'); ?></time>
              <time class="date-updated" itemprop="dateModified" datetime="<?php echo $updated_date_attr; ?>"><i class="fa-solid fa-rotate-left"></i><?php echo htmlspecialchars($updated_date_display, ENT_QUOTES, 'UTF-8'); ?></time>
            </div>

            <div class="thumbnail">
              <?php if (isset($post->thumbnail->url)): ?>
                <img src="<?php echo htmlspecialchars($post->thumbnail->url, ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($post->title, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
              <?php else: ?>
                <img src="<?php echo $img; ?>/no-img.webp" alt="イメージ画像" loading="lazy">
              <?php endif; ?>
            </div>

            <div class="description">
              <p>
                <?php echo htmlspecialchars($summary, ENT_QUOTES, 'UTF-8'); ?>
              </p>
            </div>
          </header>

          <div data-anchors='h2,h3,h4,h5,h6' data-collapsable='true'>
            <div class="table_of_contents">
              <div class="table_of_contents_header">
                <div class="table_of_contents_title">目次</div>
                <div class="table_of_contents_icon">
                  <span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true" focusable="false">
                      <path d="M10 15c-.3 0-.5-.1-.7-.3L3.3 8.7a1 1 0 1 1 1.4-1.4L10 12.59l5.3-5.3a1 1 0 0 1 1.4 1.42l-6 6A1 1 0 0 1 10 15z" />
                    </svg>
                  </span>
                </div>
              </div>
              <div class="table_of_contents_body">
                <ol class="table_of_contents_list"></ol>
              </div>
            </div>
          </div>

          <?php
          // ==========================================
          //  吹き出し（リード文）
          //  blog APIの繰り返しフィールド「speech」から取得
          //  データがない記事では何も表示されない
          // ==========================================
          if (isset($post->speech) && is_array($post->speech) && count($post->speech) > 0):
          ?>
          <div class="speech-lead-section">
            <?php foreach ($post->speech as $speech_item):
              // microCMSのセレクトフィールドは文字列・配列・オブジェクトで返る場合がある
              $sp_direction_raw = isset($speech_item->direction) ? $speech_item->direction : 'left';
              if (is_array($sp_direction_raw)) {
                $sp_direction_raw = !empty($sp_direction_raw) ? $sp_direction_raw[0] : 'left';
              } elseif (is_object($sp_direction_raw)) {
                // オブジェクト形式の場合（例: {value: "right"} など）
                $sp_direction_raw = isset($sp_direction_raw->value) ? $sp_direction_raw->value : (string)$sp_direction_raw;
              }
              $sp_direction_str = strtolower(trim((string)$sp_direction_raw));
              $sp_direction = ($sp_direction_str === 'right') ? 'right' : 'left';
              $sp_name = isset($speech_item->name) ? trim((string)$speech_item->name) : '';
              $sp_text = isset($speech_item->text) ? trim((string)$speech_item->text) : '';
              $sp_has_icon = isset($speech_item->icon->url) && $speech_item->icon->url !== '';
            ?>
            <div class="speech_bubble <?php echo $sp_direction; ?>">
              <div class="speaker_avatar">
                <div class="speaker_icon">
                  <?php if ($sp_has_icon): ?>
                    <img src="<?php echo htmlspecialchars($speech_item->icon->url, ENT_QUOTES, 'UTF-8'); ?>?w=160" alt="<?php echo htmlspecialchars($sp_name, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                  <?php else: ?>
                    <span class="speaker_icon__initial"><?php echo mb_substr($sp_name, 0, 1, 'UTF-8'); ?></span>
                  <?php endif; ?>
                </div>
                <?php if ($sp_name !== ''): ?>
                <div class="speaker_name"><?php echo htmlspecialchars($sp_name, ENT_QUOTES, 'UTF-8'); ?></div>
                <?php endif; ?>
              </div>
              <div class="bubble_content">
                <p><?php echo nl2br(htmlspecialchars($sp_text, ENT_QUOTES, 'UTF-8')); ?></p>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <div class="space_2 space_sp1"></div>
          <?php endif; ?>

          <div id="countPost">
            <?php echo $post->content; ?>
          </div>

          <?php
          // ==========================================
          //  FAQ（よくあるご質問）アコーディオン
          //  blog APIの繰り返しフィールド「faq」から取得
          //  データがない記事では何も表示されない
          // ==========================================
          if (isset($post->faq) && is_array($post->faq) && count($post->faq) > 0):
          ?>
          <div class="space_5 space_sp2"></div>
          <div class="sbox">
            <h2 class="line_height_14 tcenter b_m3">
              <span class="fs_30 fs_sp25 font_kiwi">よくあるご質問</span>
            </h2>
            <dl class="accordion">
              <?php foreach ($post->faq as $faq_item): ?>
              <dt class="open"><?php echo htmlspecialchars($faq_item->question, ENT_QUOTES, 'UTF-8'); ?></dt>
              <dd class="panel">
                <div class="inner">
                  <p><?php echo nl2br(htmlspecialchars($faq_item->answer, ENT_QUOTES, 'UTF-8')); ?></p>
                </div>
              </dd>
              <?php endforeach; ?>
            </dl>
          </div>
          <?php endif; ?>

          <?php
          // ==========================================
          //  CTA / アフィリエイトボックス（ランキング対応）
          //  blog APIの繰り返しフィールド「cta」から取得
          //  データがない記事では何も表示されない
          // ==========================================
          if (isset($post->cta) && is_array($post->cta) && count($post->cta) > 0):
          ?>
          <div class="space_5 space_sp2"></div>
          <div class="cta-box-section">
            <?php foreach ($post->cta as $cta_index => $cta_item):
              $rank_num = $cta_index + 1;
              $rank_class = ($rank_num <= 3) ? 'rank-' . $rank_num : 'rank-other';
              $has_image = isset($cta_item->image->url) && $cta_item->image->url !== '';
              $has_price = isset($cta_item->price) && trim((string)$cta_item->price) !== '';
              $has_amazon = isset($cta_item->url_amazon) && trim((string)$cta_item->url_amazon) !== '';
              $has_rakuten = isset($cta_item->url_rakuten) && trim((string)$cta_item->url_rakuten) !== '';
              $has_other = isset($cta_item->url_other) && trim((string)$cta_item->url_other) !== '';
              $other_label = isset($cta_item->url_other_label) && trim((string)$cta_item->url_other_label) !== '' ? trim((string)$cta_item->url_other_label) : '詳細はこちら';
              $rating = isset($cta_item->rating) ? floatval($cta_item->rating) : 0;
              $recommend = isset($cta_item->recommend) && trim((string)$cta_item->recommend) !== '' ? trim((string)$cta_item->recommend) : '';
            ?>
            <div class="cta-box">
              <span class="cta-rank <?php echo $rank_class; ?>"><?php echo $rank_num; ?></span>

              <?php if ($has_image): ?>
              <div class="cta-image">
                <img src="<?php echo htmlspecialchars($cta_item->image->url, ENT_QUOTES, 'UTF-8'); ?>?w=360" alt="<?php echo htmlspecialchars($cta_item->name ?? '', ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
              </div>
              <?php endif; ?>

              <div class="cta-content">
                <?php if ($recommend !== ''): ?>
                  <span class="cta-recommend"><?php echo htmlspecialchars($recommend, ENT_QUOTES, 'UTF-8'); ?></span>
                <?php endif; ?>

                <div class="cta-name"><?php echo htmlspecialchars($cta_item->name ?? '', ENT_QUOTES, 'UTF-8'); ?></div>

                <?php if ($rating > 0): ?>
                <div class="cta-rating">
                  <span class="cta-stars"><?php
                    $full = floor($rating);
                    $half = ($rating - $full >= 0.5) ? 1 : 0;
                    $empty = 5 - $full - $half;
                    for ($s = 0; $s < $full; $s++) echo '&#9733;';
                    if ($half) echo '&#9733;';
                    for ($s = 0; $s < $empty; $s++) echo '&#9734;';
                  ?></span>
                  <span class="cta-rating-num"><?php echo number_format($rating, 1); ?></span>
                </div>
                <?php endif; ?>

                <?php if (isset($cta_item->description) && trim((string)$cta_item->description) !== ''): ?>
                <div class="cta-description"><?php echo nl2br(htmlspecialchars($cta_item->description, ENT_QUOTES, 'UTF-8')); ?></div>
                <?php endif; ?>

                <?php if ($has_price): ?>
                <div class="cta-price">
                  <span class="cta-price-label">価格</span><?php echo htmlspecialchars($cta_item->price, ENT_QUOTES, 'UTF-8'); ?>
                </div>
                <?php endif; ?>

                <div class="cta-buttons">
                  <?php if ($has_amazon): ?>
                  <a href="<?php echo htmlspecialchars($cta_item->url_amazon, ENT_QUOTES, 'UTF-8'); ?>" class="cta-btn cta-btn-amazon" target="_blank" rel="nofollow noopener">Amazon</a>
                  <?php endif; ?>
                  <?php if ($has_rakuten): ?>
                  <a href="<?php echo htmlspecialchars($cta_item->url_rakuten, ENT_QUOTES, 'UTF-8'); ?>" class="cta-btn cta-btn-rakuten" target="_blank" rel="nofollow noopener">楽天市場</a>
                  <?php endif; ?>
                  <?php if ($has_other): ?>
                  <a href="<?php echo htmlspecialchars($cta_item->url_other, ENT_QUOTES, 'UTF-8'); ?>" class="cta-btn cta-btn-other" target="_blank" rel="nofollow noopener"><?php echo htmlspecialchars($other_label, ENT_QUOTES, 'UTF-8'); ?></a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>

          <?php
          // ==========================================
          //  クライアント様のご紹介
          //  繰り返しフィールド「clients」から取得
          //  データがない記事では何も表示されない
          // ==========================================
          if (isset($post->clients) && is_array($post->clients) && count($post->clients) > 0):
          ?>
          <div class="space_5 space_sp2"></div>
          <div class="client-intro-section">
            <h2 class="client-intro-heading">
              <span class="client-intro-heading__text">クライアント様のご紹介</span>
            </h2>

            <?php foreach ($post->clients as $client_item):
              $cl_name      = isset($client_item->name) ? trim((string)$client_item->name) : '';
              $cl_address   = isset($client_item->address) ? trim((string)$client_item->address) : '';
              $cl_image_url = (isset($client_item->image->url) && $client_item->image->url !== '') ? $client_item->image->url : '';
              $cl_desc      = isset($client_item->description) ? trim((string)$client_item->description) : '';
              $cl_freetext  = isset($client_item->freetext) ? trim((string)$client_item->freetext) : '';

              // 詳しくみるボタン（自由URL）
              $cl_detail_url   = isset($client_item->detail_url) ? trim((string)$client_item->detail_url) : '';
              $cl_detail_label = isset($client_item->detail_label) ? trim((string)$client_item->detail_label) : '詳しくみる';

              // 各種URL
              $cl_website   = isset($client_item->url_website) ? trim((string)$client_item->url_website) : '';
              $cl_instagram = isset($client_item->url_instagram) ? trim((string)$client_item->url_instagram) : '';
              $cl_line      = isset($client_item->url_line) ? trim((string)$client_item->url_line) : '';
              $cl_x         = isset($client_item->url_x) ? trim((string)$client_item->url_x) : '';
              $cl_facebook  = isset($client_item->url_facebook) ? trim((string)$client_item->url_facebook) : '';
              $cl_youtube   = isset($client_item->url_youtube) ? trim((string)$client_item->url_youtube) : '';
              $cl_tiktok    = isset($client_item->url_tiktok) ? trim((string)$client_item->url_tiktok) : '';
              $cl_other_url = isset($client_item->url_other) ? trim((string)$client_item->url_other) : '';
              $cl_other_lbl = isset($client_item->url_other_label) ? trim((string)$client_item->url_other_label) : 'その他リンク';

              $has_sns = ($cl_website !== '' || $cl_instagram !== '' || $cl_line !== '' || $cl_x !== '' || $cl_facebook !== '' || $cl_youtube !== '' || $cl_tiktok !== '' || $cl_other_url !== '');
            ?>
            <div class="client-card">
              <?php if ($cl_image_url !== ''): ?>
              <div class="client-card__image">
                <img src="<?php echo htmlspecialchars($cl_image_url, ENT_QUOTES, 'UTF-8'); ?>?w=400" alt="<?php echo htmlspecialchars($cl_name, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
              </div>
              <?php endif; ?>

              <div class="client-card__body">
                <?php if ($cl_name !== ''): ?>
                <h3 class="client-card__name"><?php echo htmlspecialchars($cl_name, ENT_QUOTES, 'UTF-8'); ?></h3>
                <?php endif; ?>

                <?php if ($cl_address !== ''): ?>
                <p class="client-card__address">
                  <i class="fa-solid fa-location-dot"></i>
                  <?php echo htmlspecialchars($cl_address, ENT_QUOTES, 'UTF-8'); ?>
                </p>
                <?php endif; ?>

                <?php if ($cl_desc !== ''): ?>
                <p class="client-card__desc"><?php echo nl2br(htmlspecialchars($cl_desc, ENT_QUOTES, 'UTF-8')); ?></p>
                <?php endif; ?>

                <?php if ($cl_freetext !== ''): ?>
                <div class="client-card__freetext"><?php echo nl2br(htmlspecialchars($cl_freetext, ENT_QUOTES, 'UTF-8')); ?></div>
                <?php endif; ?>

                <?php if ($has_sns): ?>
                <ul class="client-card__links">
                  <?php if ($cl_website !== ''): ?>
                  <li><a href="<?php echo htmlspecialchars($cl_website, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" title="Webサイト"><i class="fa-solid fa-globe"></i></a></li>
                  <?php endif; ?>
                  <?php if ($cl_instagram !== ''): ?>
                  <li><a href="<?php echo htmlspecialchars($cl_instagram, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" title="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                  <?php endif; ?>
                  <?php if ($cl_line !== ''): ?>
                  <li><a href="<?php echo htmlspecialchars($cl_line, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" title="LINE"><i class="fa-brands fa-line"></i></a></li>
                  <?php endif; ?>
                  <?php if ($cl_x !== ''): ?>
                  <li><a href="<?php echo htmlspecialchars($cl_x, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" title="X (Twitter)"><i class="fa-brands fa-twitter"></i></a></li>
                  <?php endif; ?>
                  <?php if ($cl_facebook !== ''): ?>
                  <li><a href="<?php echo htmlspecialchars($cl_facebook, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" title="Facebook"><i class="fa-brands fa-facebook"></i></a></li>
                  <?php endif; ?>
                  <?php if ($cl_youtube !== ''): ?>
                  <li><a href="<?php echo htmlspecialchars($cl_youtube, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" title="YouTube"><i class="fa-brands fa-youtube"></i></a></li>
                  <?php endif; ?>
                  <?php if ($cl_tiktok !== ''): ?>
                  <li><a href="<?php echo htmlspecialchars($cl_tiktok, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" title="TikTok"><i class="fa-brands fa-tiktok"></i></a></li>
                  <?php endif; ?>
                  <?php if ($cl_other_url !== ''): ?>
                  <li><a href="<?php echo htmlspecialchars($cl_other_url, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" title="<?php echo htmlspecialchars($cl_other_lbl, ENT_QUOTES, 'UTF-8'); ?>"><i class="fa-solid fa-up-right-from-square"></i></a></li>
                  <?php endif; ?>
                </ul>
                <?php endif; ?>

                <?php if ($cl_detail_url !== ''): ?>
                <a href="<?php echo htmlspecialchars($cl_detail_url, ENT_QUOTES, 'UTF-8'); ?>" class="client-card__detail-btn" target="_blank" rel="noopener">
                  <i class="fa-solid fa-arrow-right"></i> <?php echo htmlspecialchars($cl_detail_label, ENT_QUOTES, 'UTF-8'); ?>
                </a>
                <?php endif; ?>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>

          <div class='space_5 space_sp2'></div>

          <footer>
            <div class="article_writer_card">
              <div class="writer_side">
                <div class="writer_label">この記事を書いた人</div>
                <figure class="writer_avatar">
                  <?php if ($writer_image !== ''): ?>
                    <img src="<?php echo htmlspecialchars($writer_image, ENT_QUOTES, 'UTF-8'); ?>?w=160" alt="<?php echo htmlspecialchars($writer_name, ENT_QUOTES, 'UTF-8'); ?>の画像" loading="lazy">
                  <?php else: ?>
                    <img src="<?php echo $img; ?>/no-img.webp" alt="ライターの画像" loading="lazy">
                  <?php endif; ?>
                </figure>
                <p class="writer_name"><?php echo htmlspecialchars($writer_name, ENT_QUOTES, 'UTF-8'); ?></p>
              </div>
              <div class="writer_profile">
                <?php if ($writer_profile_has_html): ?>
                  <?php echo $writer_profile; ?>
                <?php else: ?>
                  <p><?php echo nl2br(htmlspecialchars($writer_profile, ENT_QUOTES, 'UTF-8')); ?></p>
                <?php endif; ?>
              </div>
            </div>
          </footer>
        </article>

        <?php if (($prev_post && isset($prev_post->id, $prev_post->title)) || ($next_post && isset($next_post->id, $next_post->title))): ?>
          <nav class="prevnext-nav" aria-label="前後の記事ナビゲーション">
            <?php if ($prev_post && isset($prev_post->id, $prev_post->title)):
              $prev_thumb = isset($prev_post->thumbnail->url) ? $prev_post->thumbnail->url : '';
            ?>
              <a href="entry.php?type=<?php echo urlencode($entry_type); ?>&eid=<?php echo urlencode($prev_post->id); ?>" class="prevnext-card prevnext-card--prev">
                <span class="prevnext-label">&lsaquo; 前の記事</span>
                <span class="prevnext-body">
                  <span class="prevnext-thumb">
                    <?php if ($prev_thumb !== ''): ?>
                    <img src="<?php echo htmlspecialchars($prev_thumb, ENT_QUOTES, 'UTF-8'); ?>?w=200" alt="<?php echo htmlspecialchars((string)$prev_post->title, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                    <?php else: ?>
                    <img src="<?php echo $img; ?>/no-img.webp" alt="<?php echo htmlspecialchars((string)$prev_post->title, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                    <?php endif; ?>
                  </span>
                  <span class="prevnext-title"><?php echo htmlspecialchars((string)$prev_post->title, ENT_QUOTES, 'UTF-8'); ?></span>
                </span>
              </a>
            <?php else: ?>
              <span class="prevnext-card prevnext-card--empty"></span>
            <?php endif; ?>

            <?php if ($next_post && isset($next_post->id, $next_post->title)):
              $next_thumb = isset($next_post->thumbnail->url) ? $next_post->thumbnail->url : '';
            ?>
              <a href="entry.php?type=<?php echo urlencode($entry_type); ?>&eid=<?php echo urlencode($next_post->id); ?>" class="prevnext-card prevnext-card--next">
                <span class="prevnext-label">次の記事 &rsaquo;</span>
                <span class="prevnext-body">
                  <span class="prevnext-title"><?php echo htmlspecialchars((string)$next_post->title, ENT_QUOTES, 'UTF-8'); ?></span>
                  <span class="prevnext-thumb">
                    <?php if ($next_thumb !== ''): ?>
                    <img src="<?php echo htmlspecialchars($next_thumb, ENT_QUOTES, 'UTF-8'); ?>?w=200" alt="<?php echo htmlspecialchars((string)$next_post->title, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                    <?php else: ?>
                    <img src="<?php echo $img; ?>/no-img.webp" alt="<?php echo htmlspecialchars((string)$next_post->title, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
                    <?php endif; ?>
                  </span>
                </span>
              </a>
            <?php else: ?>
              <span class="prevnext-card prevnext-card--empty"></span>
            <?php endif; ?>
          </nav>
        <?php endif; ?>

        <div class='flex a_center base_color line_height_12 p5 bg_white j_center b_m10'>
          <span class='r_m5'>
            <img width='40px' src='<?php echo $img; ?>/favicon.png' alt='favicon' loading='lazy'>
          </span>
          <span class='fs_30 fs_sp25'>
            <?php echo htmlspecialchars($related_heading, ENT_QUOTES, 'UTF-8'); ?>
          </span>
        </div>

        <?php
        // Fetch latest 3 posts from selected microCMS endpoint
        $sidebar_posts = microcms_get($entry_endpoint . "?limit=3&orders=-publishedAt");
        ?>

        <?php
        $loop_posts = ($sidebar_posts && !empty($sidebar_posts->contents)) ? $sidebar_posts->contents : [];
        $loop_type = $entry_type;
        $loop_ul_class = 'post_list_card grid set2 sp2 gap1';
        $loop_show_desc = false;
        $loop_empty_message = '';
        include 'loop_post.php';
        ?>

      <?php else: ?>
        <article class="blog_article">
          <p class="tcenter"><?php echo ($entry_type === 'works') ? '制作実績が見つかりませんでした。' : '記事が見つかりませんでした。'; ?></p>
          <div class='space_3 space_sp1'></div>
          <button class='btn_mini radius center'><a href='<?php echo htmlspecialchars($list_back_link, ENT_QUOTES, 'UTF-8'); ?>'><?php echo htmlspecialchars($list_back_text, ENT_QUOTES, 'UTF-8'); ?></a></button>
        </article>
      <?php endif; ?>

    </main>

    <!-- side -->
    <?php include 'entry_sidebar.php'; ?>
  </div>
</div>

<script src="js/blog_cms.js" defer></script>

<?php if ($post): ?>
<script>
(function () {
  var eid = <?php echo json_encode($post->id, JSON_HEX_TAG | JSON_HEX_AMP); ?>;
  var el  = document.getElementById('access-count');
  if (!eid || !el) return;

  // セッション内で同じ記事を重複カウントしない
  var storageKey = 'pv_counted_' + eid;
  var alreadyCounted = false;
  try { alreadyCounted = !!sessionStorage.getItem(storageKey); } catch (e) {}

  if (alreadyCounted) {
    // 既にカウント済み → 現在値だけ取得
    fetch('pv_counter.php?action=get&eid=' + encodeURIComponent(eid))
      .then(function (r) { return r.json(); })
      .then(function (d) { el.textContent = d.count; })
      .catch(function () {});
  } else {
    // 初回アクセス → カウントアップ
    fetch('pv_counter.php?action=count&eid=' + encodeURIComponent(eid), { method: 'POST' })
      .then(function (r) { return r.json(); })
      .then(function (d) {
        el.textContent = d.count;
        try { sessionStorage.setItem(storageKey, '1'); } catch (e) {}
      })
      .catch(function () {});
  }
})();

// いいねボタン
(function () {
  var eid    = <?php echo json_encode($post->id, JSON_HEX_TAG | JSON_HEX_AMP); ?>;
  var btn    = document.getElementById('like-button');
  var countEl = document.getElementById('like-count');
  if (!eid || !btn || !countEl) return;

  var likeKey = 'liked_' + eid;
  var liked   = false;
  try { liked = localStorage.getItem(likeKey) === '1'; } catch (e) {}

  // 現在のいいね数を取得して表示
  fetch('like_counter.php?action=get&eid=' + encodeURIComponent(eid))
    .then(function (r) { return r.json(); })
    .then(function (d) { countEl.textContent = d.count; })
    .catch(function () {});

  // 既にいいね済みなら押せない状態にする
  if (liked) {
    btn.classList.add('liked');
    btn.disabled = true;
  }

  btn.addEventListener('click', function () {
    if (btn.classList.contains('liked')) return;

    btn.disabled = true;
    btn.classList.add('liked');

    fetch('like_counter.php?action=like&eid=' + encodeURIComponent(eid), { method: 'POST' })
      .then(function (r) { return r.json(); })
      .then(function (d) {
        countEl.textContent = d.count;
        try { localStorage.setItem(likeKey, '1'); } catch (e) {}
      })
      .catch(function () {
        // 失敗時は元に戻す
        btn.classList.remove('liked');
        btn.disabled = false;
      });
  });
})();
</script>
<?php endif; ?>

<?php include_once './footer.php'; ?>
