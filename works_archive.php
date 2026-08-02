<?php
$page_title = "ホームページ制作実績一覧";
$page_title_eng = "Works Archive";
$page_seo_title = "沖縄のホームページ制作実績一覧";
$page_description = "デザネコが制作した沖縄県内外のホームページ制作実績を一覧でご紹介します。業種や目的に合わせたデザイン、スマホ対応、運用支援の事例をご覧ください。";
$page_noindex = true;
$page_style = <<<'CSS'
<style>
.wd_arch_grid li a {
  display: block;
  overflow: hidden;
  border-radius: 8px;
  background: #fff;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  color: #333;
  transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.wd_arch_grid li a:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.14);
}
.wd_arch_grid img {
  display: block;
  width: 100%;
  height: auto;
  aspect-ratio: 960 / 600;
  object-fit: cover;
}
.wd_arch_noimg {
  display: flex;
  align-items: center;
  justify-content: center;
  aspect-ratio: 960 / 600;
  background: #eef0ee;
  color: #999;
  font-size: 12px;
}
.wd_arch_name {
  display: block;
  padding: 8px 10px 10px;
  font-size: 13px;
  line-height: 1.5;
}
/* reset.css の button{width:100%} を打ち消し、ページャーを横並びにする */
.pager-nav .pager-link {
  width: auto;
}
</style>
CSS;
$page_script = '';
?>
<?php include_once './header.php'; ?>
<?php include_once './page_title.php'; ?>

<!-- ・ホームページ制作実績一覧（検索エンジン非公開）
works_archive.php -->

<?php
// httpsが利用できないサイトの一覧（httpでリンクする）
$wd_http_only = [];
$wd_http_only_file = __DIR__ . '/data/web_design_http_only.txt';
if (is_readable($wd_http_only_file)) {
  $wd_http_only = array_flip(array_filter(array_map('trim', file($wd_http_only_file))));
}

// CSVから実績データを読み込み（業種, 顧客名, URL）
// URLはスキームなしで格納。サブページ（例: example.com/sub.php）も可。
$wd_items = [];
$wd_categories = [];
$wd_csv = __DIR__ . '/data/web_design_works.csv';
if (is_readable($wd_csv) && ($wd_fp = fopen($wd_csv, 'r')) !== false) {
  fgetcsv($wd_fp); // ヘッダー行を読み飛ばし
  while (($wd_row = fgetcsv($wd_fp)) !== false) {
    $wd_cat  = trim((string)($wd_row[0] ?? ''));
    $wd_name = trim((string)($wd_row[1] ?? ''));
    $wd_url  = trim((string)($wd_row[2] ?? ''));
    if ($wd_url === '') continue;
    if ($wd_cat === '') $wd_cat = 'その他';
    // ドメイン部（サブページ付きURLでもhttp_only判定できるよう先頭要素を取り出す）
    $wd_domain = explode('/', $wd_url)[0];
    // サムネイルファイル名（"/"や":"を含むURLでも安全なファイル名に変換）
    $wd_thumb_name = preg_replace('/[^A-Za-z0-9._-]/', '_', $wd_url) . '.webp';
    $wd_thumb = 'images/web_design/' . $wd_thumb_name;
    $wd_items[] = [
      'cat'    => $wd_cat,
      'name'   => $wd_name !== '' ? $wd_name : $wd_url,
      'url'    => $wd_url,
      'scheme' => isset($wd_http_only[$wd_domain]) ? 'http' : 'https',
      'thumb'  => file_exists(__DIR__ . '/' . $wd_thumb) ? $wd_thumb : '',
    ];
    $wd_categories[$wd_cat] = ($wd_categories[$wd_cat] ?? 0) + 1;
  }
  fclose($wd_fp);
}
arsort($wd_categories); // 件数の多い順にタブを並べる
// 「その他」は件数に関わらず常に最後尾へ
if (isset($wd_categories['その他'])) {
  $wd_other_count = $wd_categories['その他'];
  unset($wd_categories['その他']);
  $wd_categories['その他'] = $wd_other_count;
}
?>

<div class="overflow">

  <section>
    <div class="bg_base">
      <div class="single03">
        <h2 class="line_height_14 tcenter">
          <span class="eng base_color fs_60 act inup">Portfolio</span><br>
          <span class="act txt_split type_lineup">これまでの制作実績</span>
        </h2>
        <div class='space_2 space_sp2'></div>
        <p class="tcenter">
          これまでに制作で携わったホームページ制作は1,000件以上。<br class="pconly">
          その中で実際に閲覧できるホームページを一覧でご紹介いたします。
        </p>
        <div class='space_2 space_sp2'></div>

        <?php if (empty($wd_items)): ?>
          <p class="tcenter">制作実績データが見つかりませんでした。</p>
        <?php else: ?>

          <!-- 業種タブ -->
          <ul class="works-tab-nav" id="wdTabNav">
            <li><button type="button" class="works-tab-btn active" data-wd-tab="all">すべて（<?php echo count($wd_items); ?>）</button></li>
            <?php foreach ($wd_categories as $wd_cat => $wd_count): ?>
              <li><button type="button" class="works-tab-btn" data-wd-tab="<?php echo htmlspecialchars($wd_cat, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($wd_cat, ENT_QUOTES, 'UTF-8'); ?>（<?php echo $wd_count; ?>）</button></li>
            <?php endforeach; ?>
          </ul>

          <!-- 実績グリッド（PC4カラム／スマホ2カラム） -->
          <ul class="grid set4 sp2 gap1 wd_arch_grid" id="wdGrid">
            <?php foreach ($wd_items as $wd_it): ?>
              <li data-wd-cat="<?php echo htmlspecialchars($wd_it['cat'], ENT_QUOTES, 'UTF-8'); ?>" style="display:none">
                <a href="<?php echo $wd_it['scheme']; ?>://<?php echo htmlspecialchars($wd_it['url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">
                  <?php if ($wd_it['thumb'] !== ''): ?>
                    <img src="<?php echo htmlspecialchars($wd_it['thumb'], ENT_QUOTES, 'UTF-8'); ?>" alt="<?php echo htmlspecialchars($wd_it['name'], ENT_QUOTES, 'UTF-8'); ?>のホームページ制作実績" loading="lazy" width="960" height="600">
                  <?php else: ?>
                    <span class="wd_arch_noimg">No Image</span>
                  <?php endif; ?>
                  <span class="wd_arch_name"><?php echo htmlspecialchars($wd_it['name'], ENT_QUOTES, 'UTF-8'); ?></span>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>

          <!-- ページネーション -->
          <div class="pager-section" id="wdPagerSection">
            <p class="pager-info" id="wdPagerInfo"></p>
            <nav class="pager-nav" id="wdPagerNav" aria-label="ページナビゲーション"></nav>
          </div>

          <script>
            document.addEventListener('DOMContentLoaded', function() {
              var PER_PAGE = 100;
              var grid = document.getElementById('wdGrid');
              var tabNav = document.getElementById('wdTabNav');
              var pagerSection = document.getElementById('wdPagerSection');
              var pagerInfo = document.getElementById('wdPagerInfo');
              var pagerNav = document.getElementById('wdPagerNav');
              if (!grid || !tabNav) return;

              var items = Array.prototype.slice.call(grid.children);
              var state = { cat: 'all', page: 1 };

              function filteredItems() {
                if (state.cat === 'all') return items;
                return items.filter(function(li) {
                  return li.getAttribute('data-wd-cat') === state.cat;
                });
              }

              function makeBtn(label, page, opts) {
                opts = opts || {};
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'pager-link' + (opts.extraClass ? ' ' + opts.extraClass : '');
                btn.innerHTML = label;
                if (opts.current) {
                  btn.classList.add('is-current');
                  btn.setAttribute('aria-current', 'page');
                } else if (opts.disabled) {
                  btn.classList.add('is-disabled');
                  btn.disabled = true;
                } else {
                  btn.addEventListener('click', function() {
                    state.page = page;
                    render(true);
                  });
                }
                return btn;
              }

              function render(scroll) {
                var list = filteredItems();
                var total = list.length;
                var pages = Math.max(1, Math.ceil(total / PER_PAGE));
                if (state.page > pages) state.page = pages;
                if (state.page < 1) state.page = 1;
                var start = (state.page - 1) * PER_PAGE;
                var end = Math.min(start + PER_PAGE, total);

                items.forEach(function(li) {
                  li.style.display = 'none';
                });
                list.slice(start, end).forEach(function(li) {
                  li.style.display = '';
                });

                pagerInfo.textContent = '全' + total + '件中 ' + (total > 0 ? (start + 1) : 0) + '〜' + end + '件を表示';

                pagerNav.innerHTML = '';
                if (pages > 1) {
                  pagerNav.appendChild(makeBtn('&lsaquo;', state.page - 1, { extraClass: 'pager-prev', disabled: state.page <= 1 }));
                  for (var p = 1; p <= pages; p++) {
                    pagerNav.appendChild(makeBtn(String(p), p, { current: p === state.page }));
                  }
                  pagerNav.appendChild(makeBtn('&rsaquo;', state.page + 1, { extraClass: 'pager-next', disabled: state.page >= pages }));
                  pagerNav.style.display = '';
                } else {
                  pagerNav.style.display = 'none';
                }

                if (scroll) {
                  tabNav.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
              }

              tabNav.addEventListener('click', function(e) {
                var btn = e.target.closest('.works-tab-btn');
                if (!btn) return;
                tabNav.querySelectorAll('.works-tab-btn').forEach(function(b) {
                  b.classList.remove('active');
                });
                btn.classList.add('active');
                state.cat = btn.getAttribute('data-wd-tab');
                state.page = 1;
                render(false);
              });

              render(false);
            });
          </script>

        <?php endif; ?>

        <div class='space_3 space_sp3'></div>
      </div>
    </div>
  </section>

</div>

<?php include_once './footer.php'; ?>
