<?php
require_once __DIR__ . "/common.php";
$page_title = "もじゃねこ｜もじゃ・くるる・ふわりん・パーム｜デザネコ公式キャラクター";
$is_moja_page = true;
$hide_common_layout = true;
$moja_image = "image";
$moja_subscribe_url = "https://www.youtube.com/@mojaneko_okinawa?sub_confirmation=1";
$page_title_eng = "Moja Cats";
$page_description = "もじゃねこは沖縄のデザインブランド「デザネコ」公式キャラクター。もじゃ・くるる・ふわりん・パームのプロフィール・誕生ストーリー、LINEスタンプ・オリジナルグッズをご紹介します。";

// もじゃねこ専用OGP画像（差し替え用：images/ogp_moja-cat.jpg）
$page_og_image = ((isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/' . ltrim($img, '/') . '/ogp_moja-cat.jpg');

// JSON-LD構造化データ（もじゃねこ専用 / WebPage + CreativeWork + Character / BreadcrumbList）
$current_url = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$home_url = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
$moja_img_url = $home_url . ltrim($img, '/') . '/moja-cats_moja.webp';
$kururu_img_url = $home_url . ltrim($img, '/') . '/moja-cats_kururu.webp';

$page_style = '
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "もじゃねこ｜もじゃ・くるる・ふわりん・パーム｜デザネコ公式キャラクター",
  "url": "' . htmlspecialchars($current_url, ENT_QUOTES, 'UTF-8') . '",
  "description": "もじゃねこは沖縄のデザインブランド「デザネコ」公式キャラクター。もじゃ・くるる・ふわりん・パームのプロフィール・誕生ストーリー、LINEスタンプ・オリジナルグッズをご紹介します。",
  "inLanguage": "ja",
  "isPartOf": {
    "@type": "WebSite",
    "name": "デザネコ",
    "url": "' . htmlspecialchars($home_url, ENT_QUOTES, 'UTF-8') . '"
  },
  "mainEntity": {
    "@type": "CreativeWork",
    "name": "もじゃねこ",
    "alternateName": ["もじゃネコ", "Moja Cats"],
    "description": "デザネコ公式キャラクター。黒猫「もじゃ」、白猫「くるる」と、新しい仲間「ふわりん」「パーム」のキャラクターシリーズ。",
    "creator": {
      "@type": "Organization",
      "name": "デザネコ",
      "url": "' . htmlspecialchars($home_url, ENT_QUOTES, 'UTF-8') . '",
      "sameAs": [
        "https://www.instagram.com/dezaneko/",
        "https://www.youtube.com/@mojaneko_okinawa",
        "https://line.me/R/ti/p/@quy1014b",
        "https://store.line.me/stickershop/author/5708453/ja",
        "https://suzuri.jp/design_cat",
        "https://dic.pixiv.net/a/もじゃねこ"
      ]
    },
    "character": [
      {
        "@type": "Person",
        "name": "もじゃ",
        "alternateName": "もじゃねこのもじゃ",
        "description": "黒い毛並みと黄色い瞳、もじゃもじゃヘアが特徴の黒猫。デザインが得意で、みんなの『らしさ』をカタチにする。",
        "image": "' . htmlspecialchars($moja_img_url, ENT_QUOTES, 'UTF-8') . '"
      },
      {
        "@type": "Person",
        "name": "くるる",
        "alternateName": "もじゃねこのくるる",
        "description": "白い毛並みと青い瞳、カールヘアが特徴の白猫。明るく好奇心旺盛で、なんでもチャレンジする性格。",
        "image": "' . htmlspecialchars($kururu_img_url, ENT_QUOTES, 'UTF-8') . '"
      },
      {
        "@type": "Person",
        "name": "ふわりん",
        "alternateName": "Fuwarin",
        "description": "黄色い瞳とふわふわのアフロが特徴の、おだやかで賢い女の子。キーボードと読書が好き。",
        "image": "' . htmlspecialchars($home_url . $moja_image . '/moja-cat-fuwarin-v1.webp', ENT_QUOTES, 'UTF-8') . '"
      },
      {
        "@type": "Person",
        "name": "パーム",
        "alternateName": "Palm",
        "description": "青い瞳とゆるくかかったパーマヘアが特徴の、クールで賢いロシアンブルーの男の子。ベースと読書が好き。",
        "image": "' . htmlspecialchars($home_url . $moja_image . '/moja-cat-palm-v1.webp', ENT_QUOTES, 'UTF-8') . '"
      }
    ]
  }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {"@type": "ListItem", "position": 1, "name": "ホーム", "item": "' . htmlspecialchars($home_url, ENT_QUOTES, 'UTF-8') . '"},
    {"@type": "ListItem", "position": 2, "name": "もじゃねこ", "item": "' . htmlspecialchars($current_url, ENT_QUOTES, 'UTF-8') . '"}
  ]
}
</script>
';

$page_style .= '<link rel="preload" as="image" href="image/moja-cat-hero-v1.webp" media="(min-width: 601px)">';
$page_style .= '<link rel="preload" as="image" href="image/moja-cat-hero-mobile-v1.webp" media="(max-width: 600px)">';
$page_script = '';
?>
<?php include_once './header.php'; ?>

<!-- Moja Cats -->
<main>
<div class="overflow moja_page">
    <section aria-labelledby="moja_title">
        <div class="moja_hero">
            <picture>
                <source media="(max-width: 600px)" srcset="<?php echo $moja_image; ?>/moja-cat-hero-mobile-v1.webp">
                <img class="moja_hero_art" src="<?php echo $moja_image; ?>/moja-cat-hero-v1.webp" alt="青空とお花畑で迎える、もじゃ・くるる・ふわりん・パーム" width="1774" height="887" fetchpriority="high">
            </picture>
            <div class="moja_hero_title">
                <p class="fs_18 fs_sp12">デザネコ公式キャラクター</p>
                <h1 id="moja_title" class="fs_60 fs_sp28">もじゃねこシリーズ</h1>
            </div>
            <p class="moja_hero_message moja_hero_message_left fs_22 fs_sp14">いつも<br>きっとうまくいくよ。</p>
            <p class="moja_hero_message moja_hero_message_right fs_22 fs_sp14">かわいい もじゃねこたちが<br>みんなを えがおにするよ！</p>
            <div class="moja_hero_cta">
                <a class="moja_subscribe fs_22 fs_sp18" href="<?php echo htmlspecialchars($moja_subscribe_url, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">
                    <i class="fa-brands fa-youtube" aria-hidden="true"></i>
                    <span><span>YouTubeのチャンネル登録</span><span>してもらえると喜ぶにゃ</span></span>
                    <i class="fa-solid fa-paw" aria-hidden="true"></i>
                    <span class="moja_sparkle moja_sparkle_one" aria-hidden="true">✦</span>
                    <span class="moja_sparkle moja_sparkle_two" aria-hidden="true">✧</span>
                    <span class="moja_sparkle moja_sparkle_three" aria-hidden="true">✦</span>
                </a>
            </div>
        </div>
    </section>

    <section aria-label="もじゃねこについて">
        <div class="moja_intro moja_container">
            <p class="fs_18 fs_sp16"><strong>もじゃねこ</strong>は、沖縄県を拠点とするデザインブランド「<a href="./">デザネコ</a>」の公式キャラクターです。<br class="moja_desktop_break">黒猫の「もじゃ」と白猫の「くるる」は、デザネコのコラム記事やSNS、LINEスタンプ、オリジナルグッズに登場しています。</p>
            <p class="fs_16 fs_sp16">このページでは、<strong>もじゃねこ</strong>それぞれの誕生ストーリー・性格・トレードマーク、<br class="moja_desktop_break">そしてLINEスタンプ・オリジナルグッズの情報をご紹介します。</p>
            <p class="moja_announcement fs_18 fs_sp16"><i class="fa-solid fa-paw" aria-hidden="true"></i><span>新しい仲間、<strong>ふわりんとパーム</strong>が加わりました！</span><i class="fa-solid fa-paw" aria-hidden="true"></i></p>
            <ul class="moja_social" aria-label="もじゃねこのSNS">
                <li><a href="<?php echo htmlspecialchars($youtube, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" aria-label="デザネコ公式YouTube"><i class="fa-brands fa-youtube" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo htmlspecialchars($instagram, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" aria-label="もじゃねこ公式Instagram"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo htmlspecialchars($line, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" aria-label="もじゃねこ公式LINE"><i class="fa-brands fa-line" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </section>

    <section aria-labelledby="moja_friends_heading">
        <div class="moja_friends moja_container">
            <div class="moja_section_heading"><h2 id="moja_friends_heading" class="fs_35 fs_sp26"><i class="fa-solid fa-paw" aria-hidden="true"></i><span>もじゃねこの</span><span>なかまたち</span></h2></div>
            <div class="moja_friend_grid">
                <a class="moja_friend moja_yellow" href="#moja_story"><img src="<?php echo $moja_image; ?>/moja-cat-moja-v1.webp" alt="もじゃ" width="1024" height="1024" loading="lazy"><h3 class="fs_26 fs_sp22">もじゃ</h3><p class="fs_15 fs_sp14">もじゃもじゃヘアが<br>チャームポイントの男の子</p></a>
                <a class="moja_friend moja_pink" href="#kururu_story"><img src="<?php echo $moja_image; ?>/moja-cat-kururu-v1.webp" alt="くるる" width="1024" height="1024" loading="lazy"><h3 class="fs_26 fs_sp22">くるる</h3><p class="fs_15 fs_sp14">ふわふわカールが自慢の<br>明るくやさしい女の子</p></a>
                <a class="moja_friend moja_yellow" href="#fuwarin_profile"><span class="moja_new fs_14">NEW</span><img src="<?php echo $moja_image; ?>/moja-cat-fuwarin-v1.webp" alt="ふわりん" width="1024" height="1024" loading="lazy"><h3 class="fs_26 fs_sp22">ふわりん</h3><p class="fs_15 fs_sp14">ふわふわアフロの<br>おだやかで賢い女の子</p></a>
                <a class="moja_friend moja_blue" href="#palm_profile"><span class="moja_new fs_14">NEW</span><img src="<?php echo $moja_image; ?>/moja-cat-palm-v1.webp" alt="パーム" width="1024" height="1024" loading="lazy"><h3 class="fs_26 fs_sp22">パーム</h3><p class="fs_15 fs_sp14">サラサラ前髪と青い瞳が<br>チャームポイントの男の子</p></a>
            </div>
        </div>
    </section>

    <section aria-labelledby="moja_story_heading">
        <div class="moja_story moja_yellow moja_container" id="moja_story">
            <div class="moja_story_picture"><img src="<?php echo $moja_image; ?>/moja-cat-moja-v1.webp" alt="もじゃもじゃヘアと黄色い瞳の黒猫もじゃ。ノートパソコンでデザインのお仕事" width="1024" height="1024" loading="lazy"></div>
            <div class="moja_story_text">
                <h2 id="moja_story_heading" class="fs_30 fs_sp24"><i class="fa-solid fa-paw" aria-hidden="true"></i><span>もじゃねこの黒猫</span><span>「もじゃ」</span></h2>
                <p class="fs_16 fs_sp16">黒い毛並みと黄色い瞳、トレードマークの“もじゃもじゃヘア”が特徴の、<strong>もじゃねこの黒猫「もじゃ」</strong>。<br>幼い頃はこのくせ毛がコンプレックスで、まわりのネコたちにからかわれることもありました。</p>
                <p class="fs_16 fs_sp16">そんなもじゃを変えたのは、同じ天然パーマを持つ白ネコ「くるる」との出会い。<br>「その髪型は個性的でステキよ。」<br>その一言が心に火を灯し、もじゃは自分のもじゃもじゃヘアを誇れるようになりました。</p>
                <p class="fs_16 fs_sp16">いまではその個性を活かして、デザインの仕事をしているもじゃ。<br>「みんなの“らしさ”をカタチにする」ことが、もじゃの得意分野です。<br>今日もくるんとした髪を揺らしながら、世界に“かわいい”と“自信”を届けています。</p>
            </div>
        </div>
    </section>

    <section aria-labelledby="kururu_story_heading">
        <div class="moja_story moja_pink moja_story_reverse moja_container" id="kururu_story">
            <div class="moja_story_picture"><img src="<?php echo $moja_image; ?>/moja-cat-kururu-v1.webp" alt="白いカールヘアと青い瞳のくるる。ピンクのリボンとお花のチャームが目印" width="1024" height="1024" loading="lazy"></div>
            <div class="moja_story_text">
                <h2 id="kururu_story_heading" class="fs_30 fs_sp24"><i class="fa-solid fa-paw" aria-hidden="true"></i><span>もじゃねこの白猫</span><span>「くるる」</span></h2>
                <p class="fs_16 fs_sp16">白い毛並みと青い瞳、まるでパーマをかけたような美しいカールヘアが特徴の、<strong>もじゃねこの白猫「くるる」</strong>。<br>明るくて好奇心旺盛、気になることがあればなんでもチャレンジ！<br>ピアノにダンス、料理や接客まで、くるるの毎日はワクワクでいっぱい。</p>
                <p class="fs_16 fs_sp16">でも、パソコン作業やデザインはちょっぴり苦手。<br>そんなときは、いつも黒ネコの「もじゃ」にお願いして助けてもらっています。</p>
                <p class="fs_16 fs_sp16">「もじゃはすごいのよ。私が思ってることを、ちゃんと形にしてくれるんだもん！」<br>くるるの自由な発想と、もじゃの丁寧なデザイン。<br>ふたりがそろえば、どんなことだって楽しいクリエイティブに変わります。</p>
            </div>
        </div>
    </section>

    <section aria-labelledby="moja_new_heading">
        <div class="moja_new_friends moja_container">
            <div class="moja_section_heading"><h2 id="moja_new_heading" class="fs_35 fs_sp26"><i class="fa-solid fa-paw" aria-hidden="true"></i><span>新しいなかまを</span><span>ご紹介</span></h2></div>
            <div class="moja_profile_grid">
                <div class="moja_profile moja_yellow" id="fuwarin_profile">
                    <img src="<?php echo $moja_image; ?>/moja-cat-fuwarin-v1.webp" alt="キーボードを弾く、ふわふわのアフロが特徴のふわりん" width="1024" height="1024" loading="lazy">
                    <div><h3 class="fs_30 fs_sp26"><i class="fa-solid fa-paw" aria-hidden="true"></i>ふわりん <small>Fuwarin</small></h3>
                    <dl class="fs_16 fs_sp16"><div><dt>性別</dt><dd>ふわふわの女の子</dd></div><div><dt>性格</dt><dd>無口・賢い・おだやか</dd></div><div><dt>好きなこと</dt><dd>キーボード、読書、<br>静かに考えること</dd></div><div><dt>チャームポイント</dt><dd>サラサラふわふわアフロ</dd></div></dl>
                    <blockquote class="fs_16 fs_sp16">「ことばは少なくても、<br>ちゃんと思ってるよ。<br>ゆっくりで大丈夫。」</blockquote></div>
                </div>
                <div class="moja_profile moja_blue" id="palm_profile">
                    <img src="<?php echo $moja_image; ?>/moja-cat-palm-v1.webp" alt="青いベースと本が好きな、青い瞳のロシアンブルーのパーム" width="1024" height="1024" loading="lazy">
                    <div><h3 class="fs_30 fs_sp26"><i class="fa-solid fa-paw" aria-hidden="true"></i>パーム <small>Palm</small></h3>
                    <dl class="fs_16 fs_sp16"><div><dt>性別</dt><dd>ロシアンブルーの男の子</dd></div><div><dt>性格</dt><dd>冷静・賢い・クール</dd></div><div><dt>好きなこと</dt><dd>ベース、読書、考えること</dd></div><div><dt>チャームポイント</dt><dd>青い瞳とゆるくかかった<br>パーマヘア</dd></div></dl>
                    <blockquote class="fs_16 fs_sp16">「あわてなくて大丈夫。<br>落ち着いていれば、<br>きっとうまくいくよ。」</blockquote></div>
                </div>
            </div>
        </div>
    </section>

    <section aria-labelledby="moja_items_heading">
        <div class="moja_shop moja_container">
            <div class="moja_section_heading">
                <img class="moja_goods_icon" src="<?php echo $img; ?>/favicon_goods.webp" alt="" width="80" height="80" loading="lazy">
                <h2 id="moja_items_heading" class="fs_30 fs_sp24"><span>ネコ好きをちょっと</span><span><em>Happy</em>にする</span><span>アイテム誕生！</span></h2>
                <p class="moja_english fs_18 fs_sp14">Purrfect Items to Make Cat Lovers Happy!</p>
            </div>
            <p class="moja_shop_lead fs_16 fs_sp16">そんな<strong>もじゃねこ</strong>の「もじゃ」と「くるる」のLINEスタンプと、かわいいオリジナルグッズができました！<br>2匹のゆるくて楽しい表情がたっぷり詰まっています。<br>下記のリンクからご購入いただけます。</p>
            <div class="moja_shop_grid">
                <div class="moja_shop_card moja_shop_line">
                    <h3 class="fs_30 fs_sp26"><i class="fa-brands fa-line" aria-hidden="true"></i>LINEスタンプ</h3>
                    <p class="fs_18 fs_sp16">かわいい表情がいっぱい！</p>
                    <div class="moja_stamp_grid"><img src="<?php echo $img; ?>/sticker/01.webp" alt="もじゃねこLINEスタンプ" width="370" height="320" loading="lazy"><img src="<?php echo $img; ?>/sticker/16.webp" alt="もじゃねこLINEスタンプの表情" width="370" height="320" loading="lazy"><img src="<?php echo $img; ?>/sticker/20.webp" alt="もじゃねこの楽しいLINEスタンプ" width="370" height="320" loading="lazy"><img src="<?php echo $img; ?>/sticker/42.webp" alt="もじゃねこのかわいいLINEスタンプ" width="370" height="320" loading="lazy"></div>
                    <a class="moja_button moja_button_line fs_18 fs_sp16" href="https://store.line.me/stickershop/author/5708453/ja" target="_blank" rel="noopener"><i class="fa-brands fa-line" aria-hidden="true"></i>LINEスタンプはコチラ<i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a>
                </div>
                <div class="moja_shop_card moja_shop_goods">
                    <h3 class="fs_30 fs_sp26"><i class="fa-solid fa-bag-shopping" aria-hidden="true"></i>オリジナルグッズ</h3>
                    <p class="fs_18 fs_sp16">日常をもっと、かわいく。</p>
                    <div class="moja_merch_gallery"><img src="<?php echo $img; ?>/goods01.webp" alt="販売中のもじゃねこTシャツ" width="800" height="428" loading="lazy"><img src="<?php echo $img; ?>/goods02.webp" alt="販売中のもじゃねこトートバッグ" width="800" height="428" loading="lazy"><img src="<?php echo $img; ?>/goods03.webp" alt="販売中のスマホケースとマグカップ" width="800" height="428" loading="lazy"><img src="<?php echo $img; ?>/goods04.webp" alt="販売中のソックスとアクリルキーホルダー" width="800" height="428" loading="lazy"></div>
                    <a class="moja_button moja_button_pink fs_18 fs_sp16" href="https://suzuri.jp/design_cat" target="_blank" rel="noopener"><span>「もじゃねこ」の</span><span>オリジナルグッズ販売中</span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section aria-labelledby="moja_links_heading">
        <div class="moja_links moja_container">
            <div class="moja_section_heading"><h2 id="moja_links_heading" class="fs_28 fs_sp24"><i class="fa-solid fa-paw" aria-hidden="true"></i>もじゃねこの関連リンク</h2><p class="moja_english fs_14">Related Links</p></div>
            <p class="fs_16 fs_sp16">もじゃねこのプロフィールは、ピクシブ百科事典にも掲載されています。<br>また、もじゃねこ関連のSNS・グッズ販売ページは以下からアクセスいただけます。</p>
            <ul class="moja_link_grid fs_16 fs_sp16">
                <li><a href="https://dic.pixiv.net/a/もじゃねこ" target="_blank" rel="noopener"><i class="fa-solid fa-book-open" aria-hidden="true"></i><span>ピクシブ百科事典<small class="fs_12">キャラクターを知る</small></span><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a></li>
                <li><a href="https://store.line.me/stickershop/author/5708453/ja" target="_blank" rel="noopener"><i class="fa-brands fa-line" aria-hidden="true"></i><span>LINEスタンプ<small class="fs_12">会話に、もじゃとくるるを</small></span><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a></li>
                <li><a href="https://suzuri.jp/design_cat" target="_blank" rel="noopener"><i class="fa-solid fa-shirt" aria-hidden="true"></i><span>オリジナルグッズ<small class="fs_12">お気に入りを見つける</small></span><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo htmlspecialchars($instagram, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-instagram" aria-hidden="true"></i><span>公式Instagram<small class="fs_12">日々の姿を楽しむ</small></span><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a></li>
                <li><a href="<?php echo htmlspecialchars($youtube, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-youtube" aria-hidden="true"></i><span>公式YouTube<small class="fs_12">音楽と映像で楽しむ</small></span><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </section>

    <div class="moja_media dr_page">
        <?php include __DIR__ . '/home-media.php'; ?>
    </div>

    <div class="moja_garden_footer">
        <p class="fs_24 fs_sp20">もじゃねこといっしょに、<br>たのしいじかんを。</p>
        <div class="moja_footer_friends"><img src="<?php echo $moja_image; ?>/moja-cat-moja-v1.webp" alt="" width="1024" height="1024" loading="lazy"><img src="<?php echo $moja_image; ?>/moja-cat-kururu-v1.webp" alt="" width="1024" height="1024" loading="lazy"><img src="<?php echo $moja_image; ?>/moja-cat-fuwarin-v1.webp" alt="" width="1024" height="1024" loading="lazy"><img src="<?php echo $moja_image; ?>/moja-cat-palm-v1.webp" alt="" width="1024" height="1024" loading="lazy"></div>
        <a class="moja_brand fs_22" href="./"><i class="fa-solid fa-paw" aria-hidden="true"></i>デザネコ</a>
    </div>
</div>
</main>
<!-- Moja Cats -->
<?php include __DIR__ . '/video-modal.php'; ?>
<script src="js/index-renewal.js?v=<?= filemtime(__DIR__ . '/js/index-renewal.js') ?>" defer></script>
<?php include_once './footer.php'; ?>
