<?php include_once './header.php'; ?>

<div class="overflow">

    <section>
        <div class="overflow relative bg_white">
            <div class="puton center">
                <h2 class="tcenter line_height_20 white">
                    <span class="act01 blur sponly">
                        <img class="white width_2 width_sp5 b_m10" src='<?php echo $img; ?>/logo.webp' alt='<?php echo $title; ?>' loading='lazy'>
                    </span>
                    <br>
                    <span class="fs_50 fs_sp25 act02 blur">1,000件以上の制作現場を知る<br class="sponly">制作者のネコの手サポート。</span>
                    <br>
                    <span class="fs_50 fs_sp25 act03 blur">あなたのお店に寄り添うWeb担当サービス。</span>
                </h2>
                <p class="tcenter white t_m10 act04 blur">
                    チラシやブログ、作ったままになっていませんか？<br>
                    開業1〜3年目の個人事業主専門のデザネコ。<br>
                    「制作して終わり」じゃない、一緒に育てるパートナー。<br>
                    今すぐ、ネコの手を。
                </p>
                <div class='space_3 space_sp3'></div>
                <div class="width_6 width_sp6">
                    <button class="btn_normal transparent center radius fs_20 fs_sp16 act05 blur">
                        <a href='about.php'>
                            デザネコについて
                        </a>
                    </button>
                </div>
            </div>

            <div class='iframe_area cover'>
                <video src='<?php echo $img; ?>/movie_mojacat.mp4' poster='<?php echo $img; ?>/movie_mojacat.webp' playsinline muted autoplay loop onclick='this.play();' width='100%' height='auto'></video>
            </div>
        </div>
    </section>

    <section>
        <div id='a04' class='anchor'></div>
        <div class="bg_base">
            <div class="single03">
                <h2 class="line_height_14 tcenter">
                    <span class="eng base_color fs_40 act inup">
                        Service
                    </span><br>
                    <span class="fs_40 fs_sp30 act txt_split type_lineup">
                        ネコの手借りませんか？<br class="sponly">デザネコができること
                    </span>
                </h2>
                <div class='space_3 space_sp2'></div>

                <ul class="grid set2 gap1">
                    <li class="bg_white p5">
                        <div class="flex between gap2">
                            <div class="width_2">
                                <img width="200px" class="r_m0 tright" src='<?php echo $img; ?>/sticker/59.webp' alt='もじゃねこの印刷物のデザイン制作イメージ画像' loading='lazy'>
                            </div>
                            <div class="width_8">
                                <h4 class="bold fs_25 fs_sp20 base_color border_bottom">印刷物のデザイン制作</h4>
                                <p>パンフレット、チラシ、フライヤー、名刺、ロゴなど、印刷物全般のデザインに対応します。お客さまのブランドイメージや伝えたいメッセージを効果的に表現します。</p>
                            </div>
                        </div>
                    </li>
                    <li class="bg_white p5">
                        <div class="flex between gap2">
                            <div class="width_2">
                                <img width="200px" class="r_m0 tright" src='<?php echo $img; ?>/sticker/41.webp' alt='もじゃねこのIT関連のお手伝いイメージ画像' loading='lazy'>
                            </div>
                            <div class="width_8">
                                <h4 class="bold fs_25 fs_sp20 base_color border_bottom">ウェブ関連のデザインやお手伝い</h4>
                                <p>企業の魅力や商品の強みを引き出すウェブ関連のデザインやお手伝いをします。WebについてのデザインやLINE構築、集客や認知度アップをサポートします。</p>
                            </div>
                        </div>
                    </li>
                    <li class="bg_white p5">
                        <div class="flex between gap2">
                            <div class="width_2">
                                <img width="200px" class="r_m0 tright" src='<?php echo $img; ?>/sticker/69.webp' alt='もじゃねこの写真撮影と動画制作イメージ画像' loading='lazy'>
                            </div>
                            <div class="width_8">
                                <h4 class="bold fs_25 fs_sp20 base_color border_bottom">写真撮影と動画制作</h4>
                                <p>カメラマンによる一眼レフを使用した写真撮影や動画撮影・制作を提供します。商品の魅力を引き立てるビジュアルや、イベント・プロモーションの撮影ができます。</p>
                            </div>
                        </div>
                    </li>
                    <li class="bg_white p5">
                        <div class="flex between gap2">
                            <div class="width_2">
                                <img width="200px" class="r_m0 tright" src='<?php echo $img; ?>/sticker/56.webp' alt='もじゃねこのキャッチコピーや文章作成イメージ画像' loading='lazy'>
                            </div>
                            <div class="width_8">
                                <h4 class="bold fs_25 fs_sp20 base_color border_bottom">キャッチコピーや文章作成</h4>
                                <p>心に響くキャッチコピーや、分かりやすく魅力的な文章を作成します。商品の特徴やお客さまの想いを効果的に伝え、ターゲットにアピールします。</p>
                            </div>
                        </div>
                    </li>
                    <li class="bg_white p5">
                        <div class="flex between gap2">
                            <div class="width_2">
                                <img width="200px" class="r_m0 tright" src='<?php echo $img; ?>/sticker/70.webp' alt='もじゃねこの一貫した制作・印刷サポートイメージ画像' loading='lazy'>
                            </div>
                            <div class="width_8">
                                <h4 class="bold fs_25 fs_sp20 base_color border_bottom">一貫した制作・印刷サポート</h4>
                                <p>デザインから印刷までワンストップで対応します。名刺やチラシの追加印刷にも柔軟に対応し、急なニーズにもお応えします。</p>
                            </div>
                        </div>
                    </li>
                    <li class="bg_white p5">
                        <div class="flex between gap2">
                            <div class="width_2">
                                <img width="200px" class="r_m0 tright" src='<?php echo $img; ?>/sticker/13.webp' alt='もじゃねこのAIを活用した歌詞・曲の生成＆MV制作' loading='lazy'>
                            </div>
                            <div class="width_8">
                                <h4 class="bold fs_25 fs_sp20 base_color border_bottom">AIを活用した歌詞・曲の生成＆MV制作</h4>
                                <p>最新のAI技術を活用し、オリジナルの歌詞や楽曲を制作します。さらに、ミュージックビデオ（MV）の企画・制作も対応可能。クリエイティブな発想とテクノロジーを融合させ、魅力的な音楽コンテンツを提供します。</p>
                            </div>
                        </div>
                    </li>
                </ul>

                <div class='space_3 space_sp1'></div>

            </div>
        </div>
    </section>

    <section>
        <div>
            <div class="single03">
                <h2 class="line_height_14 tcenter">
                    <span class="eng base_color fs_60 act inup">
                        Portfolio
                    </span><br>
                    <span class="act txt_split type_lineup">
                        制作実績
                    </span>
                </h2>
                <div class='space_3 space_sp2'></div>

                <?php
                // Fetch portfolio items from microCMS works endpoint (多めに取得してカテゴリ分け)
                $portfolio_response = microcms_get("/works?limit=100&orders=-publishedAt");
                $portfolio_posts = ($portfolio_response && !empty($portfolio_response->contents)) ? $portfolio_response->contents : [];

                // カテゴリ別にグループ化
                $idx_works_categories = [];
                $idx_works_by_category = [];
                foreach ($portfolio_posts as $pw) {
                    $pcat = (isset($pw->category) && trim((string)$pw->category) !== '') ? trim((string)$pw->category) : 'その他';
                    if (!in_array($pcat, $idx_works_categories)) {
                        $idx_works_categories[] = $pcat;
                    }
                    $idx_works_by_category[$pcat][] = $pw;
                }
                ?>

                <?php if (!empty($portfolio_posts) && count($idx_works_categories) > 1): ?>
                    <!-- カテゴリタブ -->
                    <ul class="works-tab-nav" id="idxWorksTabNav">
                        <li><button class="works-tab-btn active" data-idx-tab="all">すべて</button></li>
                        <?php foreach ($idx_works_categories as $ipcat): ?>
                            <li><button class="works-tab-btn" data-idx-tab="<?php echo htmlspecialchars($ipcat, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($ipcat, ENT_QUOTES, 'UTF-8'); ?></button></li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- すべて（最新4件） -->
                    <div class="works-tab-content active" data-idx-panel="all">
                        <?php
                        $loop_posts = array_slice($portfolio_posts, 0, 4);
                        $loop_type = 'works';
                        $loop_ul_class = 'post_list_card grid set4 sp2 gap1';
                        $loop_show_desc = true;
                        $loop_empty_message = '該当する制作実績がありません。';
                        include 'loop_post.php';
                        ?>
                    </div>

                    <!-- カテゴリ別（各最新4件） -->
                    <?php foreach ($idx_works_categories as $ipcat): ?>
                        <div class="works-tab-content" data-idx-panel="<?php echo htmlspecialchars($ipcat, ENT_QUOTES, 'UTF-8'); ?>">
                            <?php
                            $loop_posts = array_slice($idx_works_by_category[$ipcat], 0, 4);
                            $loop_type = 'works';
                            $loop_ul_class = 'post_list_card grid set4 sp2 gap1';
                            $loop_show_desc = true;
                            $loop_empty_message = '該当する制作実績がありません。';
                            include 'loop_post.php';
                            ?>
                        </div>
                    <?php endforeach; ?>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var nav = document.getElementById('idxWorksTabNav');
                            if (!nav) return;
                            nav.addEventListener('click', function(e) {
                                var btn = e.target.closest('.works-tab-btn');
                                if (!btn) return;
                                var target = btn.getAttribute('data-idx-tab');
                                nav.querySelectorAll('.works-tab-btn').forEach(function(b) {
                                    b.classList.remove('active');
                                });
                                btn.classList.add('active');
                                document.querySelectorAll('[data-idx-panel]').forEach(function(p) {
                                    p.classList.remove('active');
                                });
                                var panel = document.querySelector('[data-idx-panel="' + target + '"]');
                                if (panel) panel.classList.add('active');
                            });
                        });
                    </script>

                <?php else: ?>
                    <?php
                    $loop_posts = array_slice($portfolio_posts, 0, 4);
                    $loop_type = 'works';
                    $loop_ul_class = 'post_list_card grid set4 sp2 gap1';
                    $loop_show_desc = true;
                    $loop_empty_message = '該当する制作実績がありません。';
                    include 'loop_post.php';
                    ?>
                <?php endif; ?>
                <div class='space_3 space_sp3'></div>
                <button class='btn_normal radius center'><a href='entry_list.php?type=works'>制作実績一覧</a></button>
            </div>
        </div>
    </section>

    <section>
        <div>
            <div class="single03">
                <h2 class="line_height_14 tcenter">
                    <span class="eng base_color fs_60 act inup">
                        Blog
                    </span><br>
                    <span class="act txt_split type_lineup">
                        ブログ
                    </span>
                </h2>
                <div class='space_3 space_sp2'></div>
                <?php
                // Fetch blog posts from microCMS blog endpoint (多めに取得してカテゴリ分け)
                $blog_response = microcms_get("/blog?limit=100&orders=-publishedAt");
                $blog_posts = ($blog_response && !empty($blog_response->contents)) ? $blog_response->contents : [];

                // カテゴリ別にグループ化
                $idx_blog_categories = [];
                $idx_blog_by_category = [];
                foreach ($blog_posts as $pb) {
                    $pbcat = (isset($pb->category) && trim((string)$pb->category) !== '') ? trim((string)$pb->category) : 'その他';
                    if (!in_array($pbcat, $idx_blog_categories)) {
                        $idx_blog_categories[] = $pbcat;
                    }
                    $idx_blog_by_category[$pbcat][] = $pb;
                }
                ?>

                <?php if (!empty($blog_posts) && count($idx_blog_categories) > 1): ?>
                    <!-- ブログ カテゴリタブ -->
                    <ul class="works-tab-nav" id="idxBlogTabNav">
                        <li><button class="works-tab-btn active" data-idx-blog-tab="all">すべて</button></li>
                        <?php foreach ($idx_blog_categories as $ibcat): ?>
                            <li><button class="works-tab-btn" data-idx-blog-tab="<?php echo htmlspecialchars($ibcat, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($ibcat, ENT_QUOTES, 'UTF-8'); ?></button></li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- すべて（最新4件） -->
                    <div class="works-tab-content active" data-idx-blog-panel="all">
                        <?php
                        $loop_posts = array_slice($blog_posts, 0, 4);
                        $loop_type = 'blog';
                        $loop_ul_class = 'post_list_card grid set4 sp2 gap1';
                        $loop_show_desc = true;
                        $loop_empty_message = '該当する記事がありません。';
                        include 'loop_post.php';
                        ?>
                    </div>

                    <!-- カテゴリ別（各最新4件） -->
                    <?php foreach ($idx_blog_categories as $ibcat): ?>
                        <div class="works-tab-content" data-idx-blog-panel="<?php echo htmlspecialchars($ibcat, ENT_QUOTES, 'UTF-8'); ?>">
                            <?php
                            $loop_posts = array_slice($idx_blog_by_category[$ibcat], 0, 4);
                            $loop_type = 'blog';
                            $loop_ul_class = 'post_list_card grid set4 sp2 gap1';
                            $loop_show_desc = true;
                            $loop_empty_message = '該当する記事がありません。';
                            include 'loop_post.php';
                            ?>
                        </div>
                    <?php endforeach; ?>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var nav = document.getElementById('idxBlogTabNav');
                            if (!nav) return;
                            nav.addEventListener('click', function(e) {
                                var btn = e.target.closest('.works-tab-btn');
                                if (!btn) return;
                                var target = btn.getAttribute('data-idx-blog-tab');
                                nav.querySelectorAll('.works-tab-btn').forEach(function(b) {
                                    b.classList.remove('active');
                                });
                                btn.classList.add('active');
                                document.querySelectorAll('[data-idx-blog-panel]').forEach(function(p) {
                                    p.classList.remove('active');
                                });
                                var panel = document.querySelector('[data-idx-blog-panel="' + target + '"]');
                                if (panel) panel.classList.add('active');
                            });
                        });
                    </script>

                <?php else: ?>
                    <?php
                    $loop_posts = array_slice($blog_posts, 0, 4);
                    $loop_type = 'blog';
                    $loop_ul_class = 'post_list_card grid set4 sp2 gap1';
                    $loop_show_desc = true;
                    $loop_empty_message = '該当する記事がありません。';
                    include 'loop_post.php';
                    ?>
                <?php endif; ?>
                <div class='space_3 space_sp3'></div>
                <button class='btn_normal radius center'><a href='entry_list.php?type=blog'>ブログ一覧</a></button>
            </div>
        </div>
    </section>

    <section>
        <div class="bg_base">
            <div class="single03">
                <h2 class="line_height_14 tcenter">
                    <span class="eng base_color fs_60 act inup">
                        Column
                    </span><br>
                    <span class="act txt_split type_lineup">
                        お役立ちコラム
                    </span>
                </h2>
                <div class='space_3 space_sp2'></div>
                <?php
                // Fetch column posts from microCMS column endpoint (多めに取得してカテゴリ分け)
                $column_response = microcms_get("/column?limit=100&orders=-publishedAt");
                $column_posts = ($column_response && !empty($column_response->contents)) ? $column_response->contents : [];

                // カテゴリ別にグループ化
                $idx_column_categories = [];
                $idx_column_by_category = [];
                foreach ($column_posts as $pc) {
                    $pccat = (isset($pc->category) && trim((string)$pc->category) !== '') ? trim((string)$pc->category) : 'その他';
                    if (!in_array($pccat, $idx_column_categories)) {
                        $idx_column_categories[] = $pccat;
                    }
                    $idx_column_by_category[$pccat][] = $pc;
                }
                ?>

                <?php if (!empty($column_posts) && count($idx_column_categories) > 1): ?>
                    <!-- コラム カテゴリタブ -->
                    <ul class="works-tab-nav" id="idxColumnTabNav">
                        <li><button class="works-tab-btn active" data-idx-column-tab="all">すべて</button></li>
                        <?php foreach ($idx_column_categories as $iccat): ?>
                            <li><button class="works-tab-btn" data-idx-column-tab="<?php echo htmlspecialchars($iccat, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($iccat, ENT_QUOTES, 'UTF-8'); ?></button></li>
                        <?php endforeach; ?>
                    </ul>

                    <!-- すべて（最新4件） -->
                    <div class="works-tab-content active" data-idx-column-panel="all">
                        <?php
                        $loop_posts = array_slice($column_posts, 0, 4);
                        $loop_type = 'column';
                        $loop_ul_class = 'post_list_card grid set4 sp2 gap1';
                        $loop_show_desc = true;
                        $loop_empty_message = '該当するコラムがありません。';
                        include 'loop_post.php';
                        ?>
                    </div>

                    <!-- カテゴリ別（各最新4件） -->
                    <?php foreach ($idx_column_categories as $iccat): ?>
                        <div class="works-tab-content" data-idx-column-panel="<?php echo htmlspecialchars($iccat, ENT_QUOTES, 'UTF-8'); ?>">
                            <?php
                            $loop_posts = array_slice($idx_column_by_category[$iccat], 0, 4);
                            $loop_type = 'column';
                            $loop_ul_class = 'post_list_card grid set4 sp2 gap1';
                            $loop_show_desc = true;
                            $loop_empty_message = '該当するコラムがありません。';
                            include 'loop_post.php';
                            ?>
                        </div>
                    <?php endforeach; ?>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            var nav = document.getElementById('idxColumnTabNav');
                            if (!nav) return;
                            nav.addEventListener('click', function(e) {
                                var btn = e.target.closest('.works-tab-btn');
                                if (!btn) return;
                                var target = btn.getAttribute('data-idx-column-tab');
                                nav.querySelectorAll('.works-tab-btn').forEach(function(b) {
                                    b.classList.remove('active');
                                });
                                btn.classList.add('active');
                                document.querySelectorAll('[data-idx-column-panel]').forEach(function(p) {
                                    p.classList.remove('active');
                                });
                                var panel = document.querySelector('[data-idx-column-panel="' + target + '"]');
                                if (panel) panel.classList.add('active');
                            });
                        });
                    </script>

                <?php else: ?>
                    <?php
                    $loop_posts = array_slice($column_posts, 0, 4);
                    $loop_type = 'column';
                    $loop_ul_class = 'post_list_card grid set4 sp2 gap1';
                    $loop_show_desc = true;
                    $loop_empty_message = '該当するコラムがありません。';
                    include 'loop_post.php';
                    ?>
                <?php endif; ?>
                <div class='space_3 space_sp3'></div>
                <button class='btn_normal radius center'><a href='entry_list.php?type=column'>コラム一覧</a></button>
            </div>
        </div>
    </section>

</div>

<?php include_once './footer.php'; ?>
