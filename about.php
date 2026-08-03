<?php
$page_title = "デザネコについて";
$page_title_eng = "About us";
$page_seo_title = "デザネコについて｜沖縄のデザイン・Web制作事務所";
$page_description = "沖縄県宜野湾市のデザイン事務所デザネコについて。チラシ、ホームページ、撮影、AI活用、公開後の改善まで、おうちのデジタルを一緒に支えます。";
$page_style = '<link href="css/about-renewal.css?v=' . filemtime(__DIR__ . '/css/about-renewal.css') . '" rel="stylesheet">';
$page_script = '';
?>
<?php include_once './header.php'; ?>

<main class="dnk_about_page">
    <section class="dnk_about_hero" aria-labelledby="about-hero-title">
        <div class="dnk_about_hero_image" aria-hidden="true"></div>
        <div class="dnk_about_inner dnk_about_hero_inner">
            <div class="dnk_about_hero_copy">
                <p class="dnk_about_kicker">Design partner in Okinawa</p>
                <h1 id="about-hero-title">沖縄の<span>「作って終わり」</span>を、<br>なくしたくて。</h1>
                <p>デザインもホームページも、お渡しした日がゴールじゃないと思っています。</p>
                <p>デザネコは、沖縄で20年・1,000件以上の制作に関わってきた僕ひとりが、取材から撮影、デザイン、公開したあとのお手伝いまで受け持つ小さな事務所です。</p>
                <p>お店のことも、おうちのことも、まとめて相談できる<span class="dnk_about_orange">「ネコの手」</span>でいたい。そう思ってやっています。</p>
                <ul class="dnk_about_stats" aria-label="デザネコの実績">
                    <li><span class="dnk_about_stat_icon">🌺</span><strong>20<small>年</small></strong><em>デザイン・Web制作<br>の実績</em></li>
                    <li><span class="dnk_about_stat_icon">🐾</span><strong>1,000<small>件以上</small></strong><em>制作・サポート<br>実績</em></li>
                    <li><span class="dnk_about_stat_icon">🌴</span><strong>沖縄発</strong><em>沖縄の事業者様を<br>全力サポート</em></li>
                </ul>
            </div>
        </div>
    </section>

    <section class="dnk_about_section dnk_about_services" aria-labelledby="about-service-title">
        <div class="dnk_about_inner">
            <img class="dnk_about_mascot dnk_about_mascot_left" src="images/about-renewal/moja-laptop.png" alt="パソコンを使う黒猫のもじゃ" loading="lazy">
            <img class="dnk_about_mascot dnk_about_mascot_right" src="images/about-renewal/kururu-laptop.png" alt="パソコンを使う白猫のくるる" loading="lazy">
            <header class="dnk_about_section_header">
                <span>Service</span>
                <h2 id="about-service-title"><em>デザネコ</em>ができること</h2>
                <p>デザインのこと、Webのこと、パソコンやスマホのこと。<br>「これは誰に頼めばいいんだろう？」を、まとめて引き受けます。</p>
            </header>
            <ol class="dnk_about_service_grid">
                <li>
                    <span class="dnk_about_number is_orange">1</span>
                    <div><h3>チラシ・印刷物デザイン</h3><p>撮影からデザイン、印刷・納品まで。チラシ、名刺、ショップカード、パンフレットまでおまかせください。</p><a href="flyer-design.php">くわしく見る <b>→</b></a></div>
                    <img class="dnk_about_card_icon" src="images/about-renewal/icons/service-print.png" alt="チラシ・パンフレット・名刺のイメージ" loading="lazy">
                </li>
                <li>
                    <span class="dnk_about_number is_green">2</span>
                    <div><h3>ホームページ制作・運用</h3><p>初期費用0円、月額1万円以内から。公開してからの更新や改善まで、ずっと一緒に育てていきます。</p><a href="website-design.php">くわしく見る <b>→</b></a></div>
                    <img class="dnk_about_card_icon" src="images/about-renewal/icons/website.png" alt="ホームページを表示したパソコンのイメージ" loading="lazy">
                </li>
                <li>
                    <span class="dnk_about_number is_green">3</span>
                    <div><h3>AI活用コンサルティング</h3><p>仕事のどこにAIを使えるのか。むずかしい設定の話ではなく、あなたの仕事に合う使い方から一緒に考えます。</p><a href="ai-consulting.php">くわしく見る <b>→</b></a></div>
                    <img class="dnk_about_card_icon" src="images/about-renewal/icons/ai-support.png" alt="AI活用サポートのイメージ" loading="lazy">
                </li>
                <li>
                    <span class="dnk_about_number is_orange">4</span>
                    <div><h3>おうちのデジタルサポート</h3><p>スマホ、パソコン、Wi-Fi、LINE。「誰に聞けばいいか分からない」を、月額制の相談窓口でしっかり受けます。</p><a href="service_digital.php">くわしく見る <b>→</b></a></div>
                    <img class="dnk_about_card_icon" src="images/about-renewal/icons/digital-support.png" alt="スマートフォンとWi-Fiサポートのイメージ" loading="lazy">
                </li>
            </ol>
        </div>
    </section>

    <section class="dnk_about_section dnk_about_worries" aria-labelledby="about-worries-title">
        <div class="dnk_about_inner">
            <header class="dnk_about_section_header is_compact">
                <h2 id="about-worries-title">🐾 よくあるお悩み 🐾</h2>
                <p>開業したばかりの方や、お店をひとりで回している方から、日々こんなお話を伺います。</p>
            </header>
            <div class="dnk_about_worry_grid">
                <article><h3>A. ホームページの課題…</h3><ul><li>ホームページを作りたいけど、予算がない…</li><li>制作会社の見積もりが50万円で諦めた…</li><li>どこに頼めばいいか分からない…</li></ul><span aria-hidden="true">🧑‍💻</span></article>
                <article><h3>B. 運用・更新の課題…</h3><ul><li>作ったホームページが放置されている…</li><li>更新したいけど、時間がない…</li><li>更新の仕方が分からない…</li></ul><span aria-hidden="true">🤔</span></article>
                <article><h3>C. 集客の課題…</h3><ul><li>ホームページからの問い合わせがゼロ…</li><li>検索で見つけてもらえない…</li><li>SNSとホームページがつながっていない…</li></ul><span aria-hidden="true">🔎📱</span></article>
                <article><h3>D. 印刷物・撮影の課題…</h3><ul><li>チラシ、名刺をバラバラに発注している…</li><li>デザインの統一感がない…</li><li>撮影も別業者で、費用がかさむ…</li></ul><span aria-hidden="true">📸</span></article>
            </div>
            <div class="dnk_about_home_worry">
                <span class="dnk_about_home_icon" aria-hidden="true">🏠</span>
                <div><h3>おうちのデジタルの課題…</h3><ul><li>スマホの調子が悪いけど、誰に聞けばいいか分からない…</li><li>子どもや孫に聞くのは、なんとなく気がひける…</li><li>「詳しい人」に頼んでも、もっと困りごとを聞いてほしい…</li></ul></div>
                <span class="dnk_about_people_icon" aria-hidden="true">👵👴</span>
            </div>
            <div class="dnk_about_down" aria-hidden="true">⌄</div>
        </div>
    </section>

    <section class="dnk_about_section dnk_about_solutions" aria-labelledby="about-solutions-title">
        <div class="dnk_about_inner">
            <header class="dnk_about_section_header is_inverse">
                <span>Solution</span>
                <h2 id="about-solutions-title">デザネコなら解決できること</h2>
                <p>ひとりで全部やっているからこそ、まとめて引き受けられます。</p>
            </header>
            <div class="dnk_about_solution_grid">
                <article><h3>A. ホームページ面</h3><img class="dnk_about_solution_icon" src="images/about-renewal/icons/website.png" alt="ホームページ制作のイメージ" loading="lazy"><ul><li>初期費用0円ではじめられます</li><li>月額1万円以内から続けやすい</li><li>更新しやすい設計にします</li></ul></article>
                <article><h3>B. 運用・更新面</h3><img class="dnk_about_solution_icon" src="images/about-renewal/icons/updates.png" alt="継続的な更新のイメージ" loading="lazy"><ul><li>更新の回数に制限はありません</li><li>AIを使った記事づくりもお手伝い</li><li>LINEで24時間以内にお返事します</li></ul></article>
                <article><h3>C. 集客面</h3><img class="dnk_about_solution_icon" src="images/about-renewal/icons/analytics.png" alt="集客改善を表すグラフのイメージ" loading="lazy"><ul><li>検索を意識したつくりに設計します</li><li>公開後の数字を一緒に見ながら改善</li><li>SNS用の画像づくりもまとめて</li></ul></article>
                <article><h3>D. 印刷物・撮影面</h3><img class="dnk_about_solution_icon" src="images/about-renewal/icons/photo-print.png" alt="写真撮影と印刷物のイメージ" loading="lazy"><ul><li>チラシ、名刺、メニューを一括で</li><li>ホームページとデザインを統一</li><li>撮影も僕がやるので、窓口はひとつ</li></ul></article>
            </div>
            <div class="dnk_about_digital_solution">
                <img class="dnk_about_digital_icon" src="images/about-renewal/icons/home-support.png" alt="おうちのデジタルサポートのイメージ" loading="lazy">
                <div><h3>おうちのデジタル面</h3><ul><li>月額制で、何度でも相談できます</li><li>毎回おなじ人がうかがいます</li><li>むずかしい言葉は使いません</li></ul></div>
                <img class="dnk_about_digital_cat" src="images/about-renewal/moja.png" alt="黒猫のもじゃ" loading="lazy">
                <img class="dnk_about_digital_cat" src="images/about-renewal/kururu.png" alt="白猫のくるる" loading="lazy">
            </div>
        </div>
    </section>

    <section class="dnk_about_section dnk_about_experience" aria-labelledby="about-experience-title">
        <div class="dnk_about_inner dnk_about_experience_inner">
            <figure><img src="images/about-renewal/about-experience.png" alt="沖縄の風景の中に立つデザネコ代表と2匹の猫" loading="lazy"></figure>
            <div>
                <h2 id="about-experience-title">現場を<span>20年</span>やってきたから、できること</h2>
                <p>デザネコ代表のガーヒー（比嘉一茂）は、</p>
                <ul><li>沖縄のデザイン・Web業界で20年</li><li>制作担当として1,000件以上の実績</li><li>取材・撮影・デザイン・コーディング・ライティング</li><li>すべての工程をひとりで一貫して担当</li></ul>
                <p>小さなお店の「リアルな困りごと」を知っているからこそ、机上だけの提案ではなく、実際に手が動く提案ができます。</p>
                <a class="dnk_about_button" href="profile.php">くわしいプロフィールを見る <b>→</b></a>
            </div>
        </div>
    </section>

    <section class="dnk_about_section dnk_about_company" aria-labelledby="about-company-title">
        <div class="dnk_about_inner">
            <header class="dnk_about_section_header is_compact"><span>About us</span><h2 id="about-company-title"><em>デザネコ</em>について</h2></header>
            <div class="dnk_about_company_grid">
                <dl><div><dt>屋号</dt><dd>デザネコ</dd></div><div><dt>代表者</dt><dd>比嘉 一茂（ひが かずしげ）</dd></div><div><dt>設立</dt><dd>2015年</dd></div><div><dt>所在地</dt><dd>〒901-2226 沖縄県宜野湾市嘉数2-8-2</dd></div><div><dt>電話番号</dt><dd>090-2964-1664</dd></div><div><dt>メール</dt><dd>info@d-neko.com</dd></div></dl>
                <dl><div><dt>事業内容</dt><dd>ホームページ制作・運用／印刷物デザイン／ロゴ・撮影／AI活用コンサルティング／ご家庭向けデジタルサポート</dd></div><div><dt>対応エリア</dt><dd>沖縄県全域（オンラインで全国対応）</dd></div><div><dt>お支払い方法</dt><dd>銀行振込／クレジットカード／PayPal／PayPay</dd></div><div><dt>取引銀行</dt><dd>琉球銀行／沖縄銀行／楽天銀行</dd></div></dl>
            </div>
            <p class="dnk_about_estimate">ご相談の内容をお聞かせいただいたあとに、正式なお見積りをお出ししています。<br>ホームページ制作は初期費用0円・月額1万円以内のプランからご案内できます。</p>
        </div>
    </section>

    <section class="dnk_about_section dnk_about_faq" aria-labelledby="about-faq-title">
        <div class="dnk_about_inner">
            <header class="dnk_about_section_header is_compact"><h2 id="about-faq-title">よくあるご質問</h2></header>
            <div class="dnk_about_faq_list">
                <details open><summary><b>Q1.</b> なんでデザネコという屋号なんですか？</summary><p>デザネコという屋号は、ネコが持つ優雅さや遊び心をデザインに反映させることで、見る人の心を惹きつけたいという思いから名付けました。でも、単純にデザインとネコが好きという理由がいちばんかもしれません。</p></details>
                <details><summary><b>Q2.</b> なんでネコが好きなんですか？</summary><p>幼いころにネコを13匹飼っていたくらい、ネコが好きです。いまでも会話できるくらいネコのことを理解しているつもりです。</p></details>
                <details><summary><b>Q3.</b> ワンちゃんは嫌いなんですか？</summary><p>ワンちゃんも好きです。ネコアレルギーですが、イヌアレルギーではないので、ワンちゃんならいっぱい抱っこできます。</p></details>
            </div>
            <p class="dnk_about_faq_link">料金や制作の進め方など、そのほかのご質問は「よくあるご質問」ページにまとめています。<br><a href="faq.php">→ faq.php</a></p>
            <img class="dnk_about_faq_cats" src="images/about-renewal/faq-cats-v2.png" alt="質問マークと一緒にのぞく黒猫のもじゃと白猫のくるる" loading="lazy">
        </div>
    </section>

</main>

<?php include_once './footer.php'; ?>
