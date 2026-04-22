<?php
$requested_list_type = isset($_GET['type']) ? trim((string)$_GET['type']) : '';
$archive_month = isset($_GET['archive']) ? trim((string)$_GET['archive']) : '';
if (!preg_match('/^\d{4}-\d{2}$/', $archive_month)) {
  $archive_month = '';
}

// ページネーション設定
$per_page = 12;
$current_page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

if ($requested_list_type === 'blog' || $requested_list_type === 'works' || $requested_list_type === 'column' || $requested_list_type === 'all') {
  $list_type = $requested_list_type;
} elseif ($archive_month !== '') {
  $list_type = 'all';
} else {
  $list_type = 'blog';
}

if ($list_type === 'works') {
  $page_title = "制作実績";
  $page_title_eng = "Portfolio";
} elseif ($list_type === 'column') {
  $page_title = "コラム";
  $page_title_eng = "Column";
} elseif ($list_type === 'all') {
  $page_title = "アーカイブ";
  $page_title_eng = "Archive";
} else {
  $page_title = "新着情報";
  $page_title_eng = "News";
}
$page_description = "";
$page_style = "";
$page_script = '';
?>
<?php include_once './header.php'; ?>
<?php include_once './page_title.php'; ?>

<div class="blog_wrap">
  <div class="column">

    <!-- main -->
    <main class="mainwrap">

      <section>
        <?php
        if ($archive_month !== '') {
          $archive_timestamp = strtotime($archive_month . '-01');
          if ($archive_timestamp !== false) {
            if ($list_type === 'works') {
              $archive_title = date('Y年n月', $archive_timestamp) . 'の制作実績一覧';
            } elseif ($list_type === 'column') {
              $archive_title = date('Y年n月', $archive_timestamp) . 'のコラム一覧';
            } elseif ($list_type === 'all') {
              $archive_title = date('Y年n月', $archive_timestamp) . 'のアーカイブ一覧';
            } else {
              $archive_title = date('Y年n月', $archive_timestamp) . 'の記事一覧';
            }
          } else {
            $archive_title = ($list_type === 'works') ? '制作実績一覧' : (($list_type === 'column') ? 'コラム一覧' : (($list_type === 'all') ? 'アーカイブ一覧' : '記事一覧'));
          }
        } else {
          $archive_title = ($list_type === 'works') ? '制作実績一覧' : (($list_type === 'column') ? 'コラム一覧' : (($list_type === 'all') ? 'アーカイブ一覧' : '記事一覧'));
        }
        ?>

        <div class='flex a_center base_color line_height_12 p5 bg_f2 j_center'>
          <span class='fs_30 fs_sp25'>
            <?php echo htmlspecialchars($archive_title, ENT_QUOTES, 'UTF-8'); ?>
          </span>
        </div>
        <div class='space_3 space_sp1'></div>

        <?php
        // Fetch list from microCMS endpoint (archive filter is applied in PHP)
        $sidebar_posts = [];
        $list_limit = 100;
        $list_targets = ($list_type === 'all')
          ? ['blog' => '/blog', 'works' => '/works', 'column' => '/column']
          : [$list_type => (($list_type === 'works') ? '/works' : (($list_type === 'column') ? '/column' : '/blog'))];

        foreach ($list_targets as $entry_type_key => $list_endpoint) {
          $list_offset = 0;
          $list_total = 0;

          do {
            $list_response = microcms_get($list_endpoint . "?limit=" . $list_limit . "&offset=" . $list_offset . "&orders=-publishedAt");
            if (!$list_response || empty($list_response->contents)) {
              break;
            }

            foreach ($list_response->contents as $list_post) {
              $list_date_source = '';
              if (!empty($list_post->publishedAt)) {
                $list_date_source = $list_post->publishedAt;
              } elseif (!empty($list_post->createdAt)) {
                $list_date_source = $list_post->createdAt;
              }

              if ($archive_month !== '' && strpos($list_date_source, $archive_month) !== 0) {
                continue;
              }

              $list_post->_entry_type = $entry_type_key;
              $list_post->_sort_timestamp = ($list_date_source !== '' && strtotime($list_date_source) !== false) ? strtotime($list_date_source) : 0;
              $sidebar_posts[] = $list_post;
            }

            $list_offset += $list_limit;
            $list_total = isset($list_response->totalCount) ? (int)$list_response->totalCount : $list_offset;
          } while ($list_offset < $list_total);
        }

        if ($list_type === 'all' && !empty($sidebar_posts)) {
          usort($sidebar_posts, function ($a, $b) {
            $a_sort = isset($a->_sort_timestamp) ? (int)$a->_sort_timestamp : 0;
            $b_sort = isset($b->_sort_timestamp) ? (int)$b->_sort_timestamp : 0;
            if ($a_sort === $b_sort) {
              return 0;
            }
            return ($a_sort > $b_sort) ? -1 : 1;
          });
        }

        // ページネーション計算（全件）
        $total_posts = count($sidebar_posts);
        $total_pages = ($total_posts > 0) ? (int)ceil($total_posts / $per_page) : 1;
        if ($current_page > $total_pages) {
          $current_page = $total_pages;
        }
        $paged_offset = ($current_page - 1) * $per_page;

        // 現在ページ分だけスライス
        $all_posts_backup = $sidebar_posts;
        $sidebar_posts = array_slice($sidebar_posts, $paged_offset, $per_page);
        ?>

        <?php if ($list_type === 'works' && !empty($sidebar_posts)):
          // カテゴリ別にグループ化
          $works_categories = [];
          $works_by_category = [];
          foreach ($sidebar_posts as $wp) {
            $cat = (isset($wp->category) && trim((string)$wp->category) !== '') ? trim((string)$wp->category) : 'その他';
            if (!in_array($cat, $works_categories)) {
              $works_categories[] = $cat;
            }
            $works_by_category[$cat][] = $wp;
          }
        ?>
        <!-- カテゴリタブ -->
        <ul class="works-tab-nav" id="worksTabNav">
          <li><button class="works-tab-btn active" data-works-tab="all">すべて</button></li>
          <?php foreach ($works_categories as $wcat): ?>
          <li><button class="works-tab-btn" data-works-tab="<?php echo htmlspecialchars($wcat, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($wcat, ENT_QUOTES, 'UTF-8'); ?></button></li>
          <?php endforeach; ?>
        </ul>

        <!-- すべて -->
        <div class="works-tab-content active" data-works-panel="all">
          <?php
          $loop_posts = $sidebar_posts;
          $loop_type = 'works';
          $loop_ul_class = 'post_list';
          $loop_show_desc = true;
          $loop_empty_message = '';
          include 'loop_post.php';
          ?>
        </div>

        <!-- カテゴリ別 -->
        <?php foreach ($works_categories as $wcat): ?>
        <div class="works-tab-content" data-works-panel="<?php echo htmlspecialchars($wcat, ENT_QUOTES, 'UTF-8'); ?>">
          <?php
          $loop_posts = $works_by_category[$wcat];
          $loop_type = 'works';
          $loop_ul_class = 'post_list';
          $loop_show_desc = true;
          $loop_empty_message = '';
          include 'loop_post.php';
          ?>
        </div>
        <?php endforeach; ?>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
          var nav = document.getElementById('worksTabNav');
          if (!nav) return;
          nav.addEventListener('click', function(e) {
            var btn = e.target.closest('.works-tab-btn');
            if (!btn) return;
            var target = btn.getAttribute('data-works-tab');
            // ボタン切り替え
            nav.querySelectorAll('.works-tab-btn').forEach(function(b) { b.classList.remove('active'); });
            btn.classList.add('active');
            // パネル切り替え
            document.querySelectorAll('.works-tab-content').forEach(function(p) { p.classList.remove('active'); });
            var panel = document.querySelector('[data-works-panel="' + target + '"]');
            if (panel) panel.classList.add('active');
          });
        });
        </script>

        <?php elseif ($list_type === 'blog' && !empty($sidebar_posts)):
          // ブログ：カテゴリ別にグループ化
          $blog_categories = [];
          $blog_by_category = [];
          foreach ($sidebar_posts as $bp) {
            $bcat = (isset($bp->category) && trim((string)$bp->category) !== '') ? trim((string)$bp->category) : 'その他';
            if (!in_array($bcat, $blog_categories)) {
              $blog_categories[] = $bcat;
            }
            $blog_by_category[$bcat][] = $bp;
          }
        ?>

        <?php if (count($blog_categories) > 1): ?>
        <!-- ブログ カテゴリタブ -->
        <ul class="works-tab-nav" id="blogTabNav">
          <li><button class="works-tab-btn active" data-blog-tab="all">すべて</button></li>
          <?php foreach ($blog_categories as $bcat): ?>
          <li><button class="works-tab-btn" data-blog-tab="<?php echo htmlspecialchars($bcat, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($bcat, ENT_QUOTES, 'UTF-8'); ?></button></li>
          <?php endforeach; ?>
        </ul>

        <!-- すべて -->
        <div class="works-tab-content active" data-blog-panel="all">
          <?php
          $loop_posts = $sidebar_posts;
          $loop_type = 'blog';
          $loop_ul_class = 'post_list';
          $loop_show_desc = true;
          $loop_empty_message = '';
          include 'loop_post.php';
          ?>
        </div>

        <!-- カテゴリ別 -->
        <?php foreach ($blog_categories as $bcat): ?>
        <div class="works-tab-content" data-blog-panel="<?php echo htmlspecialchars($bcat, ENT_QUOTES, 'UTF-8'); ?>">
          <?php
          $loop_posts = $blog_by_category[$bcat];
          $loop_type = 'blog';
          $loop_ul_class = 'post_list';
          $loop_show_desc = true;
          $loop_empty_message = '';
          include 'loop_post.php';
          ?>
        </div>
        <?php endforeach; ?>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
          var nav = document.getElementById('blogTabNav');
          if (!nav) return;
          nav.addEventListener('click', function(e) {
            var btn = e.target.closest('.works-tab-btn');
            if (!btn) return;
            var target = btn.getAttribute('data-blog-tab');
            nav.querySelectorAll('.works-tab-btn').forEach(function(b) { b.classList.remove('active'); });
            btn.classList.add('active');
            document.querySelectorAll('[data-blog-panel]').forEach(function(p) { p.classList.remove('active'); });
            var panel = document.querySelector('[data-blog-panel="' + target + '"]');
            if (panel) panel.classList.add('active');
          });
        });
        </script>

        <?php else: ?>
        <?php
        $loop_posts = $sidebar_posts;
        $loop_type = 'blog';
        $loop_ul_class = 'post_list';
        $loop_show_desc = true;
        $loop_empty_message = '該当する記事がありません。';
        include 'loop_post.php';
        ?>
        <?php endif; ?>

        <?php elseif ($list_type === 'column' && !empty($sidebar_posts)):
          // コラム：カテゴリ別にグループ化
          $column_categories = [];
          $column_by_category = [];
          foreach ($sidebar_posts as $cp) {
            $ccat = (isset($cp->category) && trim((string)$cp->category) !== '') ? trim((string)$cp->category) : 'その他';
            if (!in_array($ccat, $column_categories)) {
              $column_categories[] = $ccat;
            }
            $column_by_category[$ccat][] = $cp;
          }
        ?>

        <?php if (count($column_categories) > 1): ?>
        <!-- コラム カテゴリタブ -->
        <ul class="works-tab-nav" id="columnTabNav">
          <li><button class="works-tab-btn active" data-column-tab="all">すべて</button></li>
          <?php foreach ($column_categories as $ccat): ?>
          <li><button class="works-tab-btn" data-column-tab="<?php echo htmlspecialchars($ccat, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($ccat, ENT_QUOTES, 'UTF-8'); ?></button></li>
          <?php endforeach; ?>
        </ul>

        <!-- すべて -->
        <div class="works-tab-content active" data-column-panel="all">
          <?php
          $loop_posts = $sidebar_posts;
          $loop_type = 'column';
          $loop_ul_class = 'post_list';
          $loop_show_desc = true;
          $loop_empty_message = '';
          include 'loop_post.php';
          ?>
        </div>

        <!-- カテゴリ別 -->
        <?php foreach ($column_categories as $ccat): ?>
        <div class="works-tab-content" data-column-panel="<?php echo htmlspecialchars($ccat, ENT_QUOTES, 'UTF-8'); ?>">
          <?php
          $loop_posts = $column_by_category[$ccat];
          $loop_type = 'column';
          $loop_ul_class = 'post_list';
          $loop_show_desc = true;
          $loop_empty_message = '';
          include 'loop_post.php';
          ?>
        </div>
        <?php endforeach; ?>

        <script>
        document.addEventListener('DOMContentLoaded', function() {
          var nav = document.getElementById('columnTabNav');
          if (!nav) return;
          nav.addEventListener('click', function(e) {
            var btn = e.target.closest('.works-tab-btn');
            if (!btn) return;
            var target = btn.getAttribute('data-column-tab');
            nav.querySelectorAll('.works-tab-btn').forEach(function(b) { b.classList.remove('active'); });
            btn.classList.add('active');
            document.querySelectorAll('[data-column-panel]').forEach(function(p) { p.classList.remove('active'); });
            var panel = document.querySelector('[data-column-panel="' + target + '"]');
            if (panel) panel.classList.add('active');
          });
        });
        </script>

        <?php else: ?>
        <?php
        $loop_posts = $sidebar_posts;
        $loop_type = 'column';
        $loop_ul_class = 'post_list';
        $loop_show_desc = true;
        $loop_empty_message = '該当するコラムがありません。';
        include 'loop_post.php';
        ?>
        <?php endif; ?>

        <?php else: ?>
        <?php
        $loop_posts = $sidebar_posts;
        $loop_type = $list_type;
        $loop_ul_class = 'post_list';
        $loop_show_desc = true;
        if ($list_type === 'works') {
          $loop_empty_message = '該当する制作実績がありません。';
        } elseif ($list_type === 'column') {
          $loop_empty_message = '該当するコラムがありません。';
        } elseif ($list_type === 'all') {
          $loop_empty_message = '該当するアーカイブデータがありません。';
        } else {
          $loop_empty_message = '該当する記事がありません。';
        }
        include 'loop_post.php';
        ?>
        <?php endif; ?>

        <?php
        // ==========================================
        //  ページャー
        // ==========================================
        if ($total_posts > 0):
          // 現在のURLパラメータを保持してページリンクを生成
          $pager_params = [];
          if ($list_type !== 'blog') {
            $pager_params['type'] = $list_type;
          }
          if ($archive_month !== '') {
            $pager_params['archive'] = $archive_month;
          }

          /**
           * ページリンクURL生成
           */
          function pager_url($page_num, $params) {
            $p = $params;
            if ($page_num > 1) {
              $p['page'] = $page_num;
            }
            $qs = !empty($p) ? '?' . http_build_query($p) : '';
            return 'entry_list.php' . $qs;
          }

          $start_item = $paged_offset + 1;
          $end_item = min($paged_offset + $per_page, $total_posts);
        ?>
        <div class="pager-section">
          <!-- コンテンツ数 / ページ情報 -->
          <p class="pager-info">
            全 <strong><?php echo $total_posts; ?></strong> 件中
            <?php echo $start_item; ?>〜<?php echo $end_item; ?> 件を表示
            ｜ <?php echo $current_page; ?> / <?php echo $total_pages; ?> ページ
          </p>

          <?php if ($total_pages > 1): ?>
          <!-- ページリンク -->
          <nav class="pager-nav" aria-label="ページナビゲーション">
            <?php // 前へ ?>
            <?php if ($current_page > 1): ?>
            <a href="<?php echo htmlspecialchars(pager_url($current_page - 1, $pager_params), ENT_QUOTES, 'UTF-8'); ?>" class="pager-link pager-prev" aria-label="前のページ">&lsaquo;</a>
            <?php else: ?>
            <span class="pager-link pager-prev is-disabled" aria-hidden="true">&lsaquo;</span>
            <?php endif; ?>

            <?php
            // ページ番号の表示範囲を計算（最大7ページ分表示）
            $range = 3;
            $start_page = max(1, $current_page - $range);
            $end_page = min($total_pages, $current_page + $range);

            // 先頭ページ
            if ($start_page > 1): ?>
              <a href="<?php echo htmlspecialchars(pager_url(1, $pager_params), ENT_QUOTES, 'UTF-8'); ?>" class="pager-link">1</a>
              <?php if ($start_page > 2): ?>
              <span class="pager-dots">&hellip;</span>
              <?php endif; ?>
            <?php endif; ?>

            <?php // ページ番号
            for ($p = $start_page; $p <= $end_page; $p++): ?>
              <?php if ($p === $current_page): ?>
              <span class="pager-link is-current" aria-current="page"><?php echo $p; ?></span>
              <?php else: ?>
              <a href="<?php echo htmlspecialchars(pager_url($p, $pager_params), ENT_QUOTES, 'UTF-8'); ?>" class="pager-link"><?php echo $p; ?></a>
              <?php endif; ?>
            <?php endfor; ?>

            <?php // 末尾ページ
            if ($end_page < $total_pages): ?>
              <?php if ($end_page < $total_pages - 1): ?>
              <span class="pager-dots">&hellip;</span>
              <?php endif; ?>
              <a href="<?php echo htmlspecialchars(pager_url($total_pages, $pager_params), ENT_QUOTES, 'UTF-8'); ?>" class="pager-link"><?php echo $total_pages; ?></a>
            <?php endif; ?>

            <?php // 次へ ?>
            <?php if ($current_page < $total_pages): ?>
            <a href="<?php echo htmlspecialchars(pager_url($current_page + 1, $pager_params), ENT_QUOTES, 'UTF-8'); ?>" class="pager-link pager-next" aria-label="次のページ">&rsaquo;</a>
            <?php else: ?>
            <span class="pager-link pager-next is-disabled" aria-hidden="true">&rsaquo;</span>
            <?php endif; ?>
          </nav>
          <?php endif; ?>
        </div>
        <?php endif; ?>

      </section>
    </main>

    <!-- side -->
    <?php include 'entry_sidebar.php'; ?>

  </div>
</div>

<?php include_once './footer.php'; ?>
