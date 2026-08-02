<?php
$page_title = "プロフィール";
$page_title_eng = "Profile";
$page_seo_title = "比嘉一茂プロフィール｜沖縄のWeb・デザイン制作者";
$page_description = "デザネコ代表・比嘉一茂（ガーヒー）のプロフィール。沖縄で20年・1,000件以上の制作に携わってきた現場経験型Web制作者が、なぜ個人事業主に寄り添う仕事を選んだのか。その原点と、大切にしている約束をご紹介します。";
$page_og_image = "https://d-neko.com/images/profile-renewal/profile-hero-gahie-v2.png";
$page_style = '<link href="css/profile-renewal.css?v=' . filemtime(__DIR__ . '/css/profile-renewal.css') . '" rel="stylesheet">';
$page_script = '';
?>
<?php include_once './header.php'; ?>

<main class="pf_page">
    <section class="pf_hero" aria-labelledby="pf-hero-title">
        <div class="pf_inner pf_hero_inner">
            <div class="pf_hero_copy">
                <p class="pf_hero_eyebrow"><i class="fa-solid fa-paw" aria-hidden="true"></i> デザインのネコの手</p>
                <h1 id="pf-hero-title">Profile</h1>
                <p class="pf_hero_subtitle">ガーヒーについて</p>
                <p class="pf_hero_lead">
                    沖縄でデザインとWebの仕事をして20年。<br>
                    チラシやホームページ制作、AI活用まで、<br class="pconly">
                    あなたの「やりたい」を一緒にカタチにします。
                </p>
                <ul class="pf_hero_chips" aria-label="対応分野">
                    <li><i class="fa-solid fa-pen-ruler" aria-hidden="true"></i>デザイン</li>
                    <li><i class="fa-solid fa-laptop-code" aria-hidden="true"></i>Web制作</li>
                    <li><i class="fa-solid fa-wand-magic-sparkles" aria-hidden="true"></i>AI活用</li>
                    <li><i class="fa-solid fa-house-laptop" aria-hidden="true"></i>デジタルサポート</li>
                </ul>
            </div>
        </div>
    </section>

    <section class="pf_section is_white pf_ref_section" aria-labelledby="pf-work-title">
        <div class="pf_inner">
            <header class="pf_section_heading pf_ref_heading is_orange">
                <h2 id="pf-work-title">ガーヒーの仕事風景</h2>
                <p>デザインからサポートまで、ひとりで幅広く対応しています！</p>
            </header>
            <ol class="pf_work_grid">
                <li class="pf_work_card">
                    <img src="<?php echo $img; ?>/profile-renewal/work-scenes/planning-v1.webp" alt="ガーヒーが白猫のくるるとパソコンで制作・企画を行う様子" width="1122" height="1402" loading="lazy" decoding="async">
                    <div class="pf_work_body">
                        <h3><span>1</span>制作・企画</h3>
                        <p>お客様の想いや目的をヒアリングし、最適なデザインや構成を考えます。</p>
                    </div>
                </li>
                <li class="pf_work_card">
                    <img src="<?php echo $img; ?>/profile-renewal/work-scenes/meeting-v1.webp" alt="ガーヒーがお客様と資料を囲んで打ち合わせをする様子" width="1122" height="1402" loading="lazy" decoding="async">
                    <div class="pf_work_body">
                        <h3><span>2</span>お打ち合わせ</h3>
                        <p>対面・オンラインで丁寧にご相談。一緒にゴールを目指します。</p>
                    </div>
                </li>
                <li class="pf_work_card">
                    <img src="<?php echo $img; ?>/profile-renewal/work-scenes/photo-interview-v1.webp" alt="ガーヒーが沖縄の海辺でカメラを持って撮影・取材をする様子" width="972" height="1619" loading="lazy" decoding="async">
                    <div class="pf_work_body">
                        <h3><span>3</span>撮影・取材</h3>
                        <p>写真撮影やお話・サービスの魅力を引き出す取材も行います。</p>
                    </div>
                </li>
                <li class="pf_work_card">
                    <img src="<?php echo $img; ?>/profile-renewal/work-scenes/design-production-v1.webp" alt="ガーヒーが黒猫のもじゃとホームページをデザイン・制作する様子" width="1122" height="1402" loading="lazy" decoding="async">
                    <div class="pf_work_body">
                        <h3><span>4</span>デザイン・制作</h3>
                        <p>デザイン・コーディング・運用まで、ひとりで一貫して対応します。</p>
                    </div>
                </li>
            </ol>
        </div>
    </section>

    <section class="pf_section is_cream pf_ref_section" aria-labelledby="pf-can-title">
        <div class="pf_inner">
            <header class="pf_section_heading pf_ref_heading">
                <h2 id="pf-can-title">デザネコができること</h2>
            </header>
            <ul class="pf_offer_grid">
                <li class="pf_offer_card is_orange">
                    <span class="pf_offer_icon"><i class="fa-regular fa-file-lines" aria-hidden="true"></i></span>
                    <h3>チラシ・印刷物デザイン</h3>
                    <p>チラシ・名刺・パンフレット・ポスターなど、伝わるデザインで集客や信頼づくりをサポート。</p>
                </li>
                <li class="pf_offer_card is_green">
                    <span class="pf_offer_icon"><i class="fa-solid fa-laptop-code" aria-hidden="true"></i></span>
                    <h3>ホームページ制作・運用</h3>
                    <p>スマホ対応のホームページ制作や更新・運用サポートまでお任せください。</p>
                </li>
                <li class="pf_offer_card is_orange">
                    <span class="pf_offer_icon"><i class="fa-solid fa-brain" aria-hidden="true"></i></span>
                    <h3>AI活用コンサルティング</h3>
                    <p>業務効率化やアイデア出しなど、AIを活用してビジネスの成長をお手伝いします。</p>
                </li>
                <li class="pf_offer_card is_green">
                    <span class="pf_offer_icon"><i class="fa-solid fa-house-laptop" aria-hidden="true"></i></span>
                    <h3>おうちのデジタルサポート</h3>
                    <p>パソコンやスマホの設定・相談、ネットやSNSの使い方までやさしくサポートします。</p>
                </li>
            </ul>
        </div>
    </section>

    <section class="pf_section is_white pf_ref_section" aria-labelledby="pf-strength-title">
        <div class="pf_inner">
            <header class="pf_section_heading pf_ref_heading">
                <h2 id="pf-strength-title">デザネコの強み</h2>
            </header>
            <ul class="pf_strength_grid">
                <li class="pf_strength_card is_orange">
                    <i class="fa-regular fa-calendar-days" aria-hidden="true"></i>
                    <strong>20<small>年</small></strong>
                    <b>デザイン＆Webの実績</b>
                    <p>2005年から、地域に寄り添ったデザインとWebを提供しています。</p>
                </li>
                <li class="pf_strength_card is_green">
                    <i class="fa-solid fa-people-group" aria-hidden="true"></i>
                    <strong>1,000<small>件以上</small></strong>
                    <b>制作実績</b>
                    <p>これまでに1,000件以上の制作・サポートを行いました。</p>
                </li>
                <li class="pf_strength_card is_orange">
                    <i class="fa-solid fa-user" aria-hidden="true"></i>
                    <strong class="is_words">ひとりで<br>一貫対応</strong>
                    <p>企画・デザイン・制作・運用まで責任を持って対応します。</p>
                </li>
                <li class="pf_strength_card is_green">
                    <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                    <strong class="is_area">沖縄県全域<br><small>＋</small><br>オンライン全国</strong>
                    <p>沖縄県全域はもちろん、オンラインで全国対応が可能です。</p>
                </li>
            </ul>
        </div>
    </section>

    <section class="pf_section is_cream pf_ref_section pf_bio_section" aria-labelledby="pf-bio-title">
        <div class="pf_inner pf_bio_grid">
            <figure class="pf_bio_visual">
                <img src="<?php echo $img; ?>/profile-renewal/profile-story-gahie-v2.webp" alt="沖縄の海を背景に看板猫のもじゃ・くるると並ぶガーヒー" width="1536" height="1024" loading="lazy" decoding="async">
            </figure>
            <div class="pf_bio_copy">
                <h2 id="pf-bio-title"><i class="fa-solid fa-paw" aria-hidden="true"></i> ガーヒー <span>（比嘉一茂）</span></h2>
                <p>はじめまして、ガーヒー（比嘉一茂）です。</p>
                <p>沖縄でデザインとWebの仕事を始めて20年。<br>これまでたくさんの方やお店、企業の「想い」をカタチにしてきました。</p>
                <p>デザイン・写真・Web・AIを通じて、地域や人の魅力を伝え、ビジネスの力になれることが何よりの喜びです。</p>
                <p>「わかりやすい」「相談しやすい」「任せてよかった」<br>そう言っていただける存在を目指して、これからも一つひとつ丁寧にサポートしていきます。</p>
                <p>どうぞよろしくお願いいたします！</p>
                <p class="pf_bio_sign">ガーヒー <i class="fa-solid fa-paw" aria-hidden="true"></i></p>
            </div>
        </div>
    </section>

    <section class="pf_section is_white pf_ref_section" aria-labelledby="pf-about-title">
        <div class="pf_inner">
            <header class="pf_section_heading pf_ref_heading">
                <h2 id="pf-about-title">デザネコについて</h2>
            </header>
            <div class="pf_about_grid">
                <figure class="pf_about_logo">
                    <img src="<?php echo $img; ?>/logo.png" alt="デザインのネコの手 デザネコ" width="424" height="160" loading="lazy" decoding="async">
                </figure>
                <dl class="pf_company_table">
                    <div><dt><i class="fa-solid fa-palette" aria-hidden="true"></i>屋号</dt><dd>デザネコ</dd></div>
                    <div><dt><i class="fa-regular fa-user" aria-hidden="true"></i>代表者</dt><dd>比嘉 一茂</dd></div>
                    <div><dt><i class="fa-regular fa-calendar" aria-hidden="true"></i>設立</dt><dd>2015年</dd></div>
                    <div><dt><i class="fa-solid fa-location-dot" aria-hidden="true"></i>所在地</dt><dd><?php echo htmlspecialchars($postalCode . ' ' . $addressRegion . $addressLocality . $streetAddress, ENT_QUOTES, 'UTF-8'); ?></dd></div>
                    <div><dt><i class="fa-solid fa-phone" aria-hidden="true"></i>電話番号</dt><dd><a href="tel:<?php echo htmlspecialchars(str_replace('-', '', $telNo), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($telNo, ENT_QUOTES, 'UTF-8'); ?></a></dd></div>
                    <div><dt><i class="fa-regular fa-envelope" aria-hidden="true"></i>メール</dt><dd><a href="mailto:<?php echo htmlspecialchars($mail, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($mail, ENT_QUOTES, 'UTF-8'); ?></a></dd></div>
                    <div><dt><i class="fa-regular fa-circle-dot" aria-hidden="true"></i>対応エリア</dt><dd>沖縄県全域（オンラインで全国対応）</dd></div>
                </dl>
            </div>
        </div>
    </section>

    <section class="pf_section is_cream pf_ref_section pf_faq_section" aria-labelledby="pf-faq-title">
        <div class="pf_inner">
            <header class="pf_section_heading pf_ref_heading">
                <h2 id="pf-faq-title">よくあるご質問</h2>
            </header>
            <div class="pf_faq_layout">
                <div class="pf_faq_list">
                    <details open>
                        <summary><span>Q</span>なぜ屋号が「デザネコ」なのですか？</summary>
                        <p>「デザインのネコの手になりたい」という想いから名付けました。ネコのように身近で、頼れる存在でありたいと思っています。</p>
                    </details>
                    <details open>
                        <summary><span>Q</span>ネコはなぜ好きなのですか？</summary>
                        <p>自由で気まぐれだけど、人に寄り添ってくれるネコの姿にいつも癒やされています。仕事にもその距離感を大切にしたいです。</p>
                    </details>
                    <details open>
                        <summary><span>Q</span>犬は嫌いですか？</summary>
                        <p>いいえ、犬も大好きです！実家にいたワンちゃんにもたくさん癒やされてきました。動物みんな大切なパートナーです。</p>
                    </details>
                </div>
                <figure class="pf_faq_cats" aria-label="看板猫のもじゃとくるる">
                    <img src="<?php echo $img; ?>/sticker/01.webp" alt="白猫のくるる" width="200" height="275" loading="lazy" decoding="async">
                    <img src="<?php echo $img; ?>/sticker/49.webp" alt="黒猫のもじゃ" width="200" height="272" loading="lazy" decoding="async">
                </figure>
            </div>
        </div>
    </section>

    <section class="pf_cta" aria-labelledby="pf-cta-title">
        <div class="pf_inner pf_cta_inner">
            <h2 id="pf-cta-title">「うちのホームページ、実際どうなの？」</h2>
            <p>アクセス数・検索での見え方・改善ポイントを無料で診断します。<br class="pconly">依頼内容が決まっていなくても大丈夫。まずはお気軽にご相談ください。</p>
            <div class="pf_cta_buttons">
                <a class="pf_cta_button is_primary" href="contact.php"><i class="fa-solid fa-envelope" aria-hidden="true"></i>まずは無料診断してみる</a>
                <a class="pf_cta_button is_secondary" href="./">デザネコホームページはこちら</a>
            </div>
        </div>
    </section>
</main>

<?php include_once './footer.php'; ?>
