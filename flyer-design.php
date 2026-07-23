<?php
$page_title = "沖縄のチラシデザインならデザネコへ｜名刺・パンフレット作成もおまかせ";
$page_title_eng = "Flyer Design";
$page_description = "沖縄でチラシ・名刺・パンフレットのデザインを頼むならデザネコへ。宜野湾市を拠点に沖縄全島対応。修正は納品まで何度でもOK、撮影から印刷入稿までワンストップ。料金相場の解説つきで、初めての方・個人事業主の方も安心してご相談いただけます。";
$page_style = '<link href="css/flyer-design.css?v=' . filemtime(__DIR__ . '/css/flyer-design.css') . '" rel="stylesheet">';
$page_script = '';
$faq_items = [
    [
        'question' => '沖縄県内なら、どのエリアでも対応してもらえますか？',
        'answer' => 'はい。宜野湾市を拠点に、那覇市・浦添市・沖縄市・うるま市など沖縄全島に対応しています。LINEやZoomでのお打ち合わせも可能です。',
    ],
    [
        'question' => '写真や文章の準備がなくても、チラシは作れますか？',
        'answer' => '作れます。撮影から対応でき、キャッチコピーや文章もヒアリングをもとに一緒に考えます。',
    ],
    [
        'question' => 'チラシと一緒に、名刺やパンフレットもお願いできますか？',
        'answer' => 'もちろん可能です。同じデザイナーがまとめて制作することで、ブランド全体の雰囲気をきれいに揃えられます。',
    ],
    [
        'question' => '納期はどれくらいかかりますか？急ぎでも対応できますか？',
        'answer' => 'チラシ1枚であれば、初稿まで2〜3週間が目安です。日程が決まっている場合は、お早めにご相談ください。',
    ],
    [
        'question' => '完成したデザインのデータはもらえますか？',
        'answer' => '印刷用データの納品にも対応しています。増刷やWebでの二次利用についても、ご契約時に丁寧にご説明します。',
    ],
];
$faq_schema = [
    '@context' => 'https://schema.org',
    '@type' => 'FAQPage',
    'mainEntity' => array_map(static function ($faq_item) {
        return [
            '@type' => 'Question',
            'name' => $faq_item['question'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $faq_item['answer'],
            ],
        ];
    }, $faq_items),
];
?>
<?php include_once './header.php'; ?>

<main class="fd_page">
    <section class="fd_hero" aria-labelledby="fd_hero_title">
        <div class="fd_hero_decor fd_hero_decor_01" aria-hidden="true">●</div>
        <div class="fd_hero_decor fd_hero_decor_02" aria-hidden="true">●</div>
        <div class="fd_inner fd_hero_inner">
            <div class="fd_hero_copy">
                <p class="fd_eyebrow">Flyer Design</p>
                <h1 id="fd_hero_title" class="fd_hero_title">
                    沖縄のチラシデザインなら<br>
                    <span>デザネコへ</span>
                </h1>
                <p class="fd_hero_lead">
                    チラシ・フライヤーはもちろん、名刺・ショップカード・パンフレットまで。<br>
                    撮影からデザイン、印刷・納品までトータルでサポートします。
                </p>
                <p class="fd_hero_note">ふんわりしたご相談から、あなたのお店やサービスを形にします。</p>
                <a class="fd_button fd_button_primary" href="contact.php"
                    onclick="gtag('event','line_click',{'event_category':'contact','event_label':'flyer_design_hero'})">
                    <i class="fa-regular fa-envelope" aria-hidden="true"></i>
                    無料で相談してみる
                    <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                </a>
                <ul class="fd_trust_list" aria-label="デザネコの特徴">
                    <li><i class="fa-regular fa-circle-check" aria-hidden="true"></i>修正は何度でもOK</li>
                    <li><i class="fa-solid fa-leaf" aria-hidden="true"></i>沖縄全島対応</li>
                    <li><i class="fa-regular fa-sun" aria-hidden="true"></i>相談・見積り無料</li>
                </ul>
            </div>

            <div class="fd_hero_visual">
                <img class="fd_hero_collage" src="<?php echo $img; ?>/flyer-design/hero-collage-v2.webp"
                    alt="チラシ・ショップカードの制作物と黒猫のもじゃ・白猫のくるる" width="1254" height="1254"
                    fetchpriority="high">
            </div>
        </div>
    </section>

    <section class="fd_section fd_trouble" aria-labelledby="fd_trouble_title">
        <div class="fd_inner">
            <div class="fd_section_heading">
                <p class="fd_section_en">Trouble</p>
                <h2 id="fd_trouble_title">こんなお悩みありませんか？</h2>
            </div>

            <div class="fd_trouble_layout">
                <div class="fd_trouble_body">
                    <ul class="fd_check_list">
                        <li><i class="fa-regular fa-circle-check" aria-hidden="true"></i><span>お店やサロンのオープンに合わせて、チラシを作りたいけど作り方が分からない</span></li>
                        <li><i class="fa-regular fa-circle-check" aria-hidden="true"></i><span>自分でCanvaやWordで作ってみたけど、なんだか素人っぽくなってしまう</span></li>
                        <li><i class="fa-regular fa-circle-check" aria-hidden="true"></i><span>デザイン会社に頼むと高そうで、料金の相場も分からなくて不安</span></li>
                        <li><i class="fa-regular fa-circle-check" aria-hidden="true"></i><span>名刺・チラシ・パンフレットを別々に頼み、お店の雰囲気が揃わなかった</span></li>
                        <li><i class="fa-regular fa-circle-check" aria-hidden="true"></i><span>印刷会社への入稿など、専門的なことはさっぱり分からない</span></li>
                    </ul>
                </div>
                <div class="fd_trouble_mascot_wrap">
                    <img class="fd_trouble_mascot" src="<?php echo $img; ?>/flyer-design/mascot-kururu-wave.png"
                        alt="相談を呼びかける白猫のくるる" width="519" height="694" loading="lazy">
                </div>
            </div>

            <p class="fd_trouble_message">
                <i class="fa-solid fa-paw" aria-hidden="true"></i>
                ひとつでも当てはまったら、デザネコにご相談ください。<br class="sp">
                はじめてのチラシづくりを、二人三脚でお手伝いします。
            </p>
        </div>
    </section>

    <section class="fd_section fd_reason" aria-labelledby="fd_reason_title">
        <div class="fd_inner">
            <div class="fd_section_heading">
                <p class="fd_section_en">Reason</p>
                <h2 id="fd_reason_title">デザネコが選ばれる<span>4</span>つの理由</h2>
            </div>

            <ol class="fd_reason_grid">
                <li class="fd_reason_card">
                    <p class="fd_reason_no">01</p>
                    <div class="fd_reason_content">
                        <h3>修正は納品まで何度でもOK</h3>
                        <p>「なんかしっくり来ない」というふんわりしたご要望も大丈夫。納得できる形になるまで、何度でも丁寧に調整します。</p>
                    </div>
                    <figure class="fd_reason_sticker"><img src="<?php echo $img; ?>/sticker/17.webp" alt="親指を立てる白猫のくるる" width="200" height="154" loading="lazy"></figure>
                </li>
                <li class="fd_reason_card">
                    <p class="fd_reason_no">02</p>
                    <div class="fd_reason_content">
                        <h3>撮影から印刷入稿までワンストップ</h3>
                        <p>料理や店舗の撮影、デザイン、印刷会社の選定・入稿代行まで対応。写真の準備がなくても始められます。</p>
                    </div>
                    <figure class="fd_reason_sticker"><img src="<?php echo $img; ?>/sticker/69.webp" alt="カメラを持つ黒猫のもじゃ" width="200" height="270" loading="lazy"></figure>
                </li>
                <li class="fd_reason_card">
                    <p class="fd_reason_no">03</p>
                    <div class="fd_reason_content">
                        <h3>沖縄密着。対面でもオンラインでもOK</h3>
                        <p>宜野湾市を拠点に沖縄全島へ対応。対面はもちろん、LINEやZoomでも進められるので忙しい方も安心です。</p>
                    </div>
                    <figure class="fd_reason_sticker"><img src="<?php echo $img; ?>/sticker/45.webp" alt="寄り添う黒猫のもじゃと白猫のくるる" width="200" height="156" loading="lazy"></figure>
                </li>
                <li class="fd_reason_card">
                    <p class="fd_reason_no">04</p>
                    <div class="fd_reason_content">
                        <h3>専門用語なしで相談できる</h3>
                        <p>入稿や塗り足しなどの知識は不要です。パソコンが苦手な方にも分かりやすい言葉で、一緒に作り上げます。</p>
                    </div>
                    <figure class="fd_reason_sticker"><img src="<?php echo $img; ?>/sticker/56.webp" alt="パソコンで案内する白猫のくるる" width="200" height="197" loading="lazy"></figure>
                </li>
            </ol>
        </div>
    </section>

    <section class="fd_section fd_price" aria-labelledby="fd_price_title">
        <div class="fd_inner">
            <div class="fd_section_heading">
                <p class="fd_section_en">Price</p>
                <h2 id="fd_price_title">料金の目安と沖縄の相場</h2>
            </div>

            <div class="fd_price_layout">
                <div class="fd_price_table_wrap">
                    <table class="fd_price_table">
                        <caption class="visually_hidden">チラシ・名刺・パンフレットのデザイン料金</caption>
                        <thead>
                            <tr>
                                <th scope="col">メニュー</th>
                                <th scope="col">仕様</th>
                                <th scope="col">料金</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><th scope="row">チラシ・フライヤー（〜A4）</th><td>片面</td><td>¥20,000〜</td></tr>
                            <tr><th scope="row">チラシ・フライヤー（〜A4）</th><td>両面</td><td>¥50,000〜</td></tr>
                            <tr><th scope="row">名刺・ショップカード</th><td>片面</td><td>¥5,000〜</td></tr>
                            <tr><th scope="row">名刺・ショップカード</th><td>両面</td><td>¥10,000〜</td></tr>
                            <tr><th scope="row">三つ折りパンフレット（〜A4）</th><td>両面</td><td>¥60,000〜</td></tr>
                            <tr><th scope="row">DM・ハガキ（〜A6）</th><td>片面</td><td>¥20,000〜</td></tr>
                        </tbody>
                    </table>
                </div>

                <aside class="fd_price_note" aria-labelledby="fd_price_note_title">
                    <h3 id="fd_price_note_title">沖縄でチラシデザインを頼むと<br>いくらかかる？</h3>
                    <p>一般的な相場は、フリーランスで片面1〜3万円ほど、デザイン会社で4〜15万円ほど。デザネコは少人数の事務所だから、品質を保ちながら費用を抑えられます。</p>
                    <p>修正回数・撮影・印刷入稿まで含めてお見積りするため、あとから追加料金に驚く心配もありません。</p>
                    <span class="fd_price_paw" aria-hidden="true"><i class="fa-solid fa-paw"></i></span>
                </aside>
            </div>

            <p class="fd_price_caution">上記は目安です。ご予算に合わせたご提案も可能です。詳しくは<a href="service_design.php">印刷デザイン・料金ページ</a>をご覧ください。</p>
        </div>
    </section>

    <section class="fd_section fd_flow" aria-labelledby="fd_flow_title">
        <div class="fd_inner">
            <div class="fd_section_heading">
                <p class="fd_section_en">Flow</p>
                <h2 id="fd_flow_title">ご依頼から納品までの流れ</h2>
            </div>

            <ol class="fd_flow_list">
                <li class="fd_flow_item">
                    <p class="fd_flow_no">01</p>
                    <figure class="fd_flow_image"><img src="<?php echo $img; ?>/flyer-design/flow-inquiry.webp" alt="お問い合わせを受けている黒猫のもじゃ" width="1254" height="1254" loading="lazy"></figure>
                    <h3>お問い合わせ</h3>
                    <p>「何から始めれば？」の段階でOK。相談・お見積りは無料です。</p>
                </li>
                <li class="fd_flow_item">
                    <p class="fd_flow_no">02</p>
                    <figure class="fd_flow_image"><img src="<?php echo $img; ?>/flyer-design/flow-hearing-estimate.webp" alt="ヒアリングとお見積りを行う黒猫のもじゃと白猫のくるる" width="1254" height="1254" loading="lazy"></figure>
                    <h3>ヒアリング・お見積り</h3>
                    <p>魅力やご予算、配りたい相手を伺い、正式なお見積りをご提示します。</p>
                </li>
                <li class="fd_flow_item">
                    <p class="fd_flow_no">03</p>
                    <figure class="fd_flow_image"><img src="<?php echo $img; ?>/flyer-design/flow-design-revision.webp" alt="デザイン制作と修正を行う黒猫のもじゃと白猫のくるる" width="1254" height="1254" loading="lazy"></figure>
                    <h3>デザイン制作・修正</h3>
                    <p>初稿は2〜3週間が目安。納得いくまで何度でも修正します。</p>
                </li>
                <li class="fd_flow_item">
                    <p class="fd_flow_no">04</p>
                    <figure class="fd_flow_image"><img src="<?php echo $img; ?>/flyer-design/flow-print-delivery.webp" alt="印刷物の納品準備をする黒猫のもじゃと白猫のくるる" width="1254" height="1254" loading="lazy"></figure>
                    <h3>印刷・納品</h3>
                    <p>印刷会社の選定から入稿、納品までしっかりサポートします。</p>
                </li>
            </ol>
        </div>
    </section>

    <section class="fd_section fd_works" aria-labelledby="fd_works_title">
        <div class="fd_inner fd_inner_wide">
            <div class="fd_section_heading">
                <p class="fd_section_en">Works</p>
                <h2 id="fd_works_title">チラシ・フライヤーの制作事例</h2>
            </div>

            <div class="fd_index_works">
                <?php
                // index.phpの制作実績欄と同じデータ・表示ロジックを使用
                $portfolio_response = microcms_get_list("/works", "limit=100&orders=-publishedAt");
                $portfolio_posts = ($portfolio_response && !empty($portfolio_response->contents)) ? $portfolio_response->contents : [];
                $idx_works_categories = [];
                $idx_works_by_category = [];
                foreach ($portfolio_posts as $pw) {
                    $pcat = microcms_extract_category_name($pw->category ?? null);
                    if (!in_array($pcat, $idx_works_categories)) {
                        $idx_works_categories[] = $pcat;
                    }
                    $idx_works_by_category[$pcat][] = $pw;
                }
                ?>

                <?php if (!empty($portfolio_posts) && count($idx_works_categories) > 1): ?>
                    <ul class="works-tab-nav" id="idxWorksTabNav">
                        <li><button class="works-tab-btn active" data-idx-tab="all" aria-pressed="true">すべて</button></li>
                        <?php foreach ($idx_works_categories as $ipcat): ?>
                            <li><button class="works-tab-btn" data-idx-tab="<?php echo htmlspecialchars($ipcat, ENT_QUOTES, 'UTF-8'); ?>" aria-pressed="false"><?php echo htmlspecialchars($ipcat, ENT_QUOTES, 'UTF-8'); ?></button></li>
                        <?php endforeach; ?>
                    </ul>

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
                        var root = nav.closest('.fd_index_works');
                        if (!root) return;
                        nav.addEventListener('click', function(e) {
                            var btn = e.target.closest('.works-tab-btn');
                            if (!btn) return;
                            var target = btn.getAttribute('data-idx-tab');
                            nav.querySelectorAll('.works-tab-btn').forEach(function(b) {
                                b.classList.remove('active');
                                b.setAttribute('aria-pressed', 'false');
                            });
                            btn.classList.add('active');
                            btn.setAttribute('aria-pressed', 'true');
                            var panels = Array.from(root.querySelectorAll('[data-idx-panel]'));
                            panels.forEach(function(p) {
                                p.classList.remove('active');
                            });
                            var panel = panels.find(function(p) {
                                return p.dataset.idxPanel === target;
                            });
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
                <div class="fd_works_button"><button class="btn_normal radius center"><a href="entry_list.php?type=works">制作実績一覧</a></button></div>
            </div>
        </div>
    </section>

    <section class="fd_section fd_faq" aria-labelledby="fd_faq_title">
        <div class="fd_inner">
            <div class="fd_section_heading">
                <p class="fd_section_en">FAQ</p>
                <h2 id="fd_faq_title">チラシデザインのよくあるご質問</h2>
            </div>

            <div class="fd_faq_layout">
                <div class="fd_faq_list">
                    <?php foreach ($faq_items as $faq_index => $faq_item): ?>
                    <details<?php echo $faq_index === 0 ? ' open' : ''; ?>>
                        <summary><span class="fd_faq_q">Q</span><span><?php echo htmlspecialchars($faq_item['question'], ENT_QUOTES, 'UTF-8'); ?></span><i class="fa-solid fa-plus" aria-hidden="true"></i></summary>
                        <div class="fd_faq_answer"><span class="fd_faq_a">A</span><p><?php echo htmlspecialchars($faq_item['answer'], ENT_QUOTES, 'UTF-8'); ?></p></div>
                    </details>
                    <?php endforeach; ?>
                    <p class="fd_text_link_wrap"><a class="fd_text_link" href="faq.php">そのほかのよくあるご質問はこちら<i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a></p>
                </div>
                <img class="fd_faq_mascot" src="<?php echo $img; ?>/flyer-design/mascot-moja-wave.png"
                    alt="よくある質問をご案内する黒猫のもじゃ" width="539" height="693" loading="lazy">
            </div>
        </div>
    </section>

    <section class="fd_final_cta" aria-labelledby="fd_final_cta_title">
        <div class="fd_inner fd_final_cta_inner">
            <img class="fd_final_mascot fd_final_mascot_moja"
                src="<?php echo $img; ?>/flyer-design/mascot-moja-laptop.png" alt="パソコンで対応する黒猫のもじゃ" width="370" height="320" loading="lazy">
            <div class="fd_final_cta_copy">
                <h2 id="fd_final_cta_title">まずは「こんなチラシ作れる？」から<br class="fd_pc_only">お聞かせください</h2>
                <p>ご相談・お見積りは無料です。しつこい営業は一切いたしません。<br>安心してお気軽にお問い合わせください。</p>
                <a class="fd_button fd_button_cta" href="contact.php"
                    onclick="gtag('event','line_click',{'event_category':'contact','event_label':'flyer_design_cta'})">
                    <i class="fa-regular fa-envelope" aria-hidden="true"></i>
                    無料で相談してみる
                    <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                </a>
            </div>
            <img class="fd_final_mascot fd_final_mascot_kururu"
                src="<?php echo $img; ?>/flyer-design/mascot-kururu-laptop.png" alt="パソコンで対応する白猫のくるる" width="370" height="320" loading="lazy">
        </div>
    </section>
</main>

<script type="application/ld+json">
<?php echo json_encode($faq_schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG); ?>
</script>

<?php include_once './footer.php'; ?>
