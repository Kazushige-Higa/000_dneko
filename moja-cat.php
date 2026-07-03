<?php
$page_title = "もじゃねこ｜デザネコ公式キャラクター｜黒猫もじゃ・白猫くるる";
$page_title_eng = "Moja Cats";
$page_description = "もじゃねこは沖縄のデザインブランド「デザネコ」公式キャラクター。黒猫「もじゃ」と白猫「くるる」のプロフィール・誕生ストーリー、LINEスタンプ・オリジナルグッズをご紹介します。";

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
  "name": "もじゃねこ｜デザネコ公式キャラクター｜黒猫もじゃ・白猫くるる",
  "url": "' . htmlspecialchars($current_url, ENT_QUOTES, 'UTF-8') . '",
  "description": "もじゃねこは沖縄のデザインブランド「デザネコ」公式キャラクター。黒猫「もじゃ」と白猫「くるる」のプロフィール・誕生ストーリー、LINEスタンプ・オリジナルグッズをご紹介します。",
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
    "description": "デザネコ公式キャラクター。黒猫「もじゃ」と白猫「くるる」の2匹で構成される、ねこの兄妹キャラクター。",
    "creator": {
      "@type": "Organization",
      "name": "デザネコ",
      "url": "' . htmlspecialchars($home_url, ENT_QUOTES, 'UTF-8') . '",
      "sameAs": [
        "https://www.instagram.com/dezaneko/",
        "https://www.youtube.com/@design-cat",
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

$page_script = '';
?>
<?php include_once './header.php'; ?>

<!-- もじゃねこ moja-cat.php -->
<div class='overflow'>

    <section>
        <div class="overflow relative bg_pink">

            <div class="puton tcenter center line_height_10 shadow width_sp10">
                <h1>
                    <span class="act02 txt_split type_up fs_120 fs_sp80 line_height_14 tcenter white bold shadow font_kiwi">moja-cats</span>
                    <br>
                    <span class="act03 blur fs_40 fs_sp30 line_height_14 tcenter white bold shadow font_kiwi">もじゃねこ｜デザネコ公式キャラクターの「もじゃ」と「くるる」</span>
                </h1>
                <div class='space_3 space_sp6'></div>
                <div class="act04 blur width_3 width_sp7">
                    <button class='btn_normal bg_line radius center'>
                        <a href='https://store.line.me/stickershop/author/5708453/ja' target='_blank' rel='noopener'>
                            <!-- LINEアイコン（SVG） -->
                            <span style="vertical-align:middle; display:inline-block; margin-right:8px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.9 18.12" width="24" height="24" style="vertical-align:middle;">
                                    <path fill="#fff" d="M18.9,7.7C18.9,3.4,14.6,0,9.4,0S0,3.4,0,7.7c0,3.8,3.4,7,7.9,7.6,.3,.1,.7,.2,.8,.5,.1,.2,.1,.6,0,.9,0,0-.1,.7-.1,.8,0,.2-.2,.9,.8,.5s5.4-3.2,7.4-5.5h0c1.4-1.6,2.1-3.1,2.1-4.8Zm-13.2,2.5h-1.9c-.3,0-.5-.2-.5-.5v-3.8c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.3h1.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5Zm2-.5c0,.3-.2,.5-.5,.5s-.5-.2-.5-.5v-3.8c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.8Zm4.5,0c0,.2-.1,.4-.3,.5h-.2c-.2,0-.3-.1-.4-.2l-1.9-2.6v2.3c0,.3-.2,.5-.5,.5s-.5-.2-.5-.5v-3.8c0-.2,.1-.4,.3-.5h.2c.2,0,.3,.1,.4,.2l1.9,2.6v-2.3c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.8Zm3-2.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.4v.9h1.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.9c-.3,0-.5-.2-.5-.5v-1.9h0v-1.9h0c0-.3,.2-.5,.5-.5h1.9c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.4v.9h1.4Z" />
                                </svg>
                            </span>
                            LINEスタンプはコチラ
                        </a>
                    </button>
                    <div class='space_1 space_sp1'></div>
                    <button class='btn_hologram center'>
                        <a href='https://suzuri.jp/design_cat' target='_blank' rel='noopener'>
                            <!-- グッズアイコンフォント（Font Awesome 使用例） -->
                            <span style="vertical-align:middle; display:inline-block; margin-right:8px;">
                                <i class="fa-solid fa-shirt" aria-hidden="true"></i>
                            </span>
                            オリジナルグッズ販売中
                        </a>
                    </button>
                </div>

            </div>
            <div class='iframe_area cover bg_black'>
                <video src='<?php echo $img; ?>/moja_movie.mp4' poster='<?php echo $img; ?>/moja_movie.webp' playsinline muted autoplay loop onclick='this.play();' width='100%' height='auto'></video>
            </div>
        </div>
    </section>

    <!-- ▼ 導入リード文（SEO的に重要・キーワード密度向上） ▼ -->
    <section>
        <div class='bg_pink'>
            <div class='single02'>
                <div class='mbox'>
                    <div class="tcenter act blur">
                        <p class="fs_22 fs_sp16 bold line_height_18 tjustify">
                            <strong>もじゃねこ</strong>は、沖縄県を拠点とするデザインブランド「<a href="./">デザネコ</a>」の公式キャラクターです。黒猫の「もじゃ」と白猫の「くるる」の2匹で構成され、デザネコのコラム記事やSNS、LINEスタンプ、オリジナルグッズに登場しています。
                        </p>
                        <div class='space_1 space_sp1'></div>
                        <p class="fs_18 fs_sp14 line_height_18 tjustify">
                            このページでは、<strong>もじゃねこ</strong>の2匹それぞれの誕生ストーリー・性格・トレードマーク、そしてLINEスタンプ・オリジナルグッズの情報をご紹介します。
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class='bg_pink'>
            <div class='space_1 space_sp1'></div>
            <ul class="sns_btn a_center j_center">

                <!-- // youtube -->
                <li class="youtube">
                    <a href="<?php echo $youtube; ?>" target="_blank" rel="nofollow" aria-label="もじゃねこ公式YouTube">
                        <svg id="a" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.1 13.37">
                            <path class="b" d="M18.7,2.09c-.22-.82-.87-1.47-1.69-1.69-1.49-.4-7.46-.4-7.46-.4,0,0-5.97,0-7.46,.4-.82,.22-1.47,.87-1.69,1.69-.4,1.49-.4,4.6-.4,4.6,0,0,0,3.11,.4,4.6,.22,.82,.87,1.47,1.69,1.69,1.49,.4,7.46,.4,7.46,.4,0,0,5.97,0,7.46-.4,.82-.22,1.47-.87,1.69-1.69,.4-1.49,.4-4.6,.4-4.6,0,0,0-3.11-.4-4.6ZM7.64,9.55V3.82l4.96,2.86-4.96,2.86Z" />
                        </svg>
                    </a>
                </li>
                <!-- // instagram -->
                <li class="instagram">
                    <a href="<?php echo $instagram; ?>" target="_blank" rel="nofollow" aria-label="もじゃねこ公式Instagram">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17.9">
                            <g>
                                <path class="c" d="M9,1.6c2.4,0,2.7,0,3.6,.1,.9,0,1.3,.2,1.7,.3,.4,.2,.7,.4,1,.7s.5,.6,.7,1c.1,.3,.3,.8,.3,1.7s.1,1.2,.1,3.6,0,2.7-.1,3.6c0,.9-.2,1.3-.3,1.7-.2,.4-.4,.7-.7,1s-.6,.5-1,.7c-.3,.1-.8,.3-1.7,.3s-1.2,.1-3.6,.1-2.7,0-3.6-.1c-.9,0-1.3-.2-1.7-.3-.4-.2-.7-.4-1-.7s-.5-.6-.7-1c-.1-.4-.3-.9-.3-1.8s-.1-1.2-.1-3.6,0-2.7,.1-3.6c0-.9,.2-1.3,.3-1.7,.2-.4,.4-.7,.7-1s.6-.5,1-.7c.3-.1,.8-.3,1.7-.3h3.6m0-1.6c-2.4,0-2.7,0-3.7,.1-1,0-1.6,.2-2.2,.4-.6,.2-1.1,.5-1.6,1-.5,.5-.8,1-1,1.6-.2,.5-.4,1.2-.4,2.1,0,1-.1,1.3-.1,3.7s0,2.7,.1,3.7c0,1,.2,1.6,.4,2.2,.2,.6,.5,1.1,1,1.6,.5,.5,1,.8,1.6,1s1.2,.4,2.2,.4,1.3,.1,3.7,.1,2.7,0,3.7-.1c1,0,1.6-.2,2.2-.4,.6-.2,1.1-.5,1.6-1s.8-1,1-1.6,.4-1.2,.4-2.2,.1-1.3,.1-3.7,0-2.7-.1-3.7c0-1-.2-1.6-.4-2.2-.2-.6-.5-1.1-1-1.6-.5-.5-1-.8-1.6-1S13.7,0,12.7,0h-3.7Zm0,4.3c-2.6,0-4.6,2.1-4.6,4.6s2.1,4.6,4.6,4.6,4.6-2.1,4.6-4.6-2.1-4.6-4.6-4.6Zm0,7.6c-1.6,0-3-1.3-3-3,0-1.6,1.3-3,3-3,1.6,0,3,1.3,3,3-.1,1.6-1.4,3-3,3ZM13.7,3.1c-.6,0-1.1,.5-1.1,1.1s.5,1.1,1.1,1.1,1.1-.5,1.1-1.1-.5-1.1-1.1-1.1Z" />
                            </g>
                        </svg>
                    </a>
                </li>
                <!-- // line -->
                <li class="line">
                    <a href="<?php echo $line; ?>" target='_blank' rel='noopener' aria-label="もじゃねこ公式LINE">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.9 18.12">
                            <path d="M18.9,7.7C18.9,3.4,14.6,0,9.4,0S0,3.4,0,7.7c0,3.8,3.4,7,7.9,7.6,.3,.1,.7,.2,.8,.5,.1,.2,.1,.6,0,.9,0,0-.1,.7-.1,.8,0,.2-.2,.9,.8,.5s5.4-3.2,7.4-5.5h0c1.4-1.6,2.1-3.1,2.1-4.8Zm-13.2,2.5h-1.9c-.3,0-.5-.2-.5-.5v-3.8c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.3h1.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5Zm2-.5c0,.3-.2,.5-.5,.5s-.5-.2-.5-.5v-3.8c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.8Zm4.5,0c0,.2-.1,.4-.3,.5h-.2c-.2,0-.3-.1-.4-.2l-1.9-2.6v2.3c0,.3-.2,.5-.5,.5s-.5-.2-.5-.5v-3.8c0-.2,.1-.4,.3-.5h.2c.2,0,.3,.1,.4,.2l1.9,2.6v-2.3c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.8Zm3-2.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.4v.9h1.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.9c-.3,0-.5-.2-.5-.5v-1.9h0v-1.9h0c0-.3,.2-.5,.5-.5h1.9c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.4v.9h1.4Z" />
                        </svg>
                    </a>
                </li>

            </ul>
            <div class='space_1 space_sp1'></div>

            <div class='single02'>
                <div class='flexbox'>
                    <div class='width_5 width_sp10 act blur'>
                        <img class="radius" src='<?php echo $img; ?>/moja-cats_moja.webp' alt='もじゃねこの黒猫「もじゃ」もじゃもじゃヘアと黄色い瞳が特徴のキャラクター' loading='lazy'>
                    </div>
                    <div class='width_4 width_sp10 p10 act inup'>
                        <div>
                            <h2>
                                <span class='bold border_bottom fs_35 fs_sp24 font_kiwi'>
                                    もじゃねこの黒猫「もじゃ」
                                </span>
                            </h2>
                            <div class='space_2 space_sp1'></div>

                            <div class="tjustify bold">
                                <p>
                                    黒い毛並みと黄色い瞳、トレードマークの“もじゃもじゃヘア”が特徴の、<strong>もじゃねこの黒猫「もじゃ」</strong>。<br>
                                    幼い頃はこのくせ毛がコンプレックスで、まわりのネコたちにからかわれることもありました。
                                </p>
                                <p>
                                    そんなもじゃを変えたのは、同じ天然パーマを持つ白ネコ「くるる」との出会い。<br>
                                    「その髪型は個性的でステキよ。」<br>
                                    その一言が心に火を灯し、もじゃは自分のもじゃもじゃヘアを誇れるようになりました。
                                </p>
                                <p>
                                    いまではその個性を活かして、デザインの仕事をしているもじゃ。<br>
                                    「みんなの“らしさ”をカタチにする」ことが、もじゃの得意分野です。<br>
                                    今日もくるんとした髪を揺らしながら、世界に“かわいい”と“自信”を届けています。
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section>
        <div class='bg_pink'>
            <div class='single02'>
                <div class='flexbox reversal'>
                    <div class='width_5 width_sp10 act blur'>
                        <img class="radius" src='<?php echo $img; ?>/moja-cats_kururu.webp' alt='もじゃねこの白猫「くるる」白い毛並みと青い瞳、カールヘアが特徴のキャラクター' loading='lazy'>
                    </div>
                    <div class='width_4 width_sp10 p10 act inup'>
                        <div>
                            <h2>
                                <span class='bold pink border_bottom fs_35 fs_sp24 font_kiwi'>
                                    もじゃねこの白猫「くるる」
                                </span>
                            </h2>
                            <div class='space_2 space_sp1'></div>

                            <div class="tjustify bold">
                                <p>
                                    白い毛並みと青い瞳、まるでパーマをかけたような美しいカールヘアが特徴の、<strong>もじゃねこの白猫「くるる」</strong>。<br>
                                    明るくて好奇心旺盛、気になることがあればなんでもチャレンジ！<br>
                                    ピアノにダンス、料理や接客まで、くるるの毎日はワクワクでいっぱい。
                                </p>
                                <p>
                                    でも、パソコン作業やデザインはちょっぴり苦手。<br>
                                    そんなときは、いつも黒ネコの「もじゃ」にお願いして助けてもらっています。
                                </p>
                                <p>
                                    「もじゃはすごいのよ。私が思ってることを、ちゃんと形にしてくれるんだもん！」<br>
                                    くるるの自由な発想と、もじゃの丁寧なデザイン。<br>
                                    ふたりがそろえば、どんなことだって楽しいクリエイティブに変わります。
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section>
        <div class="bg_pink">
            <div class="gallery_slider radius set4 left">
                <ul>
                    <li><img src="<?php echo $img; ?>/goods01.webp" alt="もじゃねこLINEスタンプ もじゃとくるるの楽しい表情" /></li>
                    <li><img src="<?php echo $img; ?>/goods02.webp" alt="もじゃねこオリジナルグッズ 黒猫もじゃと白猫くるるのデザイン" /></li>
                    <li><img src="<?php echo $img; ?>/goods03.webp" alt="もじゃねこグッズ かわいい2匹のキャラクターアイテム" /></li>
                    <li><img src="<?php echo $img; ?>/goods04.webp" alt="もじゃねこグッズ デザネコ公式キャラクターのアイテム" /></li>
                </ul>
                <ul>
                    <li><img src="<?php echo $img; ?>/goods01.webp" alt="もじゃねこLINEスタンプ もじゃとくるるの楽しい表情" /></li>
                    <li><img src="<?php echo $img; ?>/goods02.webp" alt="もじゃねこオリジナルグッズ 黒猫もじゃと白猫くるるのデザイン" /></li>
                    <li><img src="<?php echo $img; ?>/goods03.webp" alt="もじゃねこグッズ かわいい2匹のキャラクターアイテム" /></li>
                    <li><img src="<?php echo $img; ?>/goods04.webp" alt="もじゃねこグッズ デザネコ公式キャラクターのアイテム" /></li>
                </ul>
            </div>
            <div class='space_3 space_sp4'></div>
            <div class="tcenter b_m5">
                <img width="80px" src='<?php echo $img; ?>/favicon_goods.webp' alt='もじゃねこグッズイメージ' loading='lazy'>
            </div>
            <h2 class="tcenter line_height_20 tcenter">
                <span class="pink fs_30 fs_sp20 eng act txt_split type_popup">Purrfect Items to Make Cat Lovers Happy!
                </span>
                <br>
                <span class="fs_30 fs_sp22 black tcenter act blur">
                    <b class="font_kiwi">
                        ネコ好きをちょっとHappyにするアイテム誕生！
                    </b>
                </span>
            </h2>

            <div class="mbox act set">
                <div class="sbox bold act blur">

                    <div class="tcenter">
                        <p>
                            そんな<strong>もじゃねこ</strong>の「もじゃ」と「くるる」のLINEスタンプと、かわいいオリジナルグッズができました！<br>
                            2匹のゆるくて楽しい表情がたっぷり詰まっています。<br>
                            下記のリンクからご購入いただけます。
                        </p>


                    </div>
                    <div class='space_3 space_sp2'></div>
                    <button class='btn_normal bg_line radius center'>
                        <a href='https://store.line.me/stickershop/author/5708453/ja' target='_blank' rel='noopener'>
                            <!-- LINEアイコン（SVG） -->
                            <span style="vertical-align:middle; display:inline-block; margin-right:8px;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.9 18.12" width="24" height="24" style="vertical-align:middle;">
                                    <path fill="#fff" d="M18.9,7.7C18.9,3.4,14.6,0,9.4,0S0,3.4,0,7.7c0,3.8,3.4,7,7.9,7.6,.3,.1,.7,.2,.8,.5,.1,.2,.1,.6,0,.9,0,0-.1,.7-.1,.8,0,.2-.2,.9,.8,.5s5.4-3.2,7.4-5.5h0c1.4-1.6,2.1-3.1,2.1-4.8Zm-13.2,2.5h-1.9c-.3,0-.5-.2-.5-.5v-3.8c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.3h1.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5Zm2-.5c0,.3-.2,.5-.5,.5s-.5-.2-.5-.5v-3.8c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.8Zm4.5,0c0,.2-.1,.4-.3,.5h-.2c-.2,0-.3-.1-.4-.2l-1.9-2.6v2.3c0,.3-.2,.5-.5,.5s-.5-.2-.5-.5v-3.8c0-.2,.1-.4,.3-.5h.2c.2,0,.3,.1,.4,.2l1.9,2.6v-2.3c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.8Zm3-2.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.4v.9h1.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.9c-.3,0-.5-.2-.5-.5v-1.9h0v-1.9h0c0-.3,.2-.5,.5-.5h1.9c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.4v.9h1.4Z" />
                                </svg>
                            </span>
                            LINEスタンプはコチラ
                        </a>
                    </button>
                    <div class='space_1 space_sp1'></div>
                    <button class='btn_hologram center'><a href='https://suzuri.jp/design_cat' target='_blank' rel='noopener'>「もじゃねこ」のオリジナルグッズ販売中</a></button>
                    <div class='space_1 space_sp1'></div>
                    <ul class="sns_btn a_center j_center">

                        <!-- // youtube -->
                        <li class="youtube">
                            <a href="<?php echo $youtube; ?>" target="_blank" rel="nofollow" aria-label="もじゃねこ公式YouTube">
                                <svg id="a" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.1 13.37">
                                    <path class="b" d="M18.7,2.09c-.22-.82-.87-1.47-1.69-1.69-1.49-.4-7.46-.4-7.46-.4,0,0-5.97,0-7.46,.4-.82,.22-1.47,.87-1.69,1.69-.4,1.49-.4,4.6-.4,4.6,0,0,0,3.11,.4,4.6,.22,.82,.87,1.47,1.69,1.69,1.49,.4,7.46,.4,7.46,.4,0,0,5.97,0,7.46-.4,.82-.22,1.47-.87,1.69-1.69,.4-1.49,.4-4.6,.4-4.6,0,0,0-3.11-.4-4.6ZM7.64,9.55V3.82l4.96,2.86-4.96,2.86Z" />
                                </svg>
                            </a>
                        </li>
                        <!-- // instagram -->
                        <li class="instagram">
                            <a href="<?php echo $instagram; ?>" target="_blank" rel="nofollow" aria-label="もじゃねこ公式Instagram">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17.9">
                                    <g>
                                        <path class="c" d="M9,1.6c2.4,0,2.7,0,3.6,.1,.9,0,1.3,.2,1.7,.3,.4,.2,.7,.4,1,.7s.5,.6,.7,1c.1,.3,.3,.8,.3,1.7s.1,1.2,.1,3.6,0,2.7-.1,3.6c0,.9-.2,1.3-.3,1.7-.2,.4-.4,.7-.7,1s-.6,.5-1,.7c-.3,.1-.8,.3-1.7,.3s-1.2,.1-3.6,.1-2.7,0-3.6-.1c-.9,0-1.3-.2-1.7-.3-.4-.2-.7-.4-1-.7s-.5-.6-.7-1c-.1-.4-.3-.9-.3-1.8s-.1-1.2-.1-3.6,0-2.7,.1-3.6c0-.9,.2-1.3,.3-1.7,.2-.4,.4-.7,.7-1s.6-.5,1-.7c.3-.1,.8-.3,1.7-.3h3.6m0-1.6c-2.4,0-2.7,0-3.7,.1-1,0-1.6,.2-2.2,.4-.6,.2-1.1,.5-1.6,1-.5,.5-.8,1-1,1.6-.2,.5-.4,1.2-.4,2.1,0,1-.1,1.3-.1,3.7s0,2.7,.1,3.7c0,1,.2,1.6,.4,2.2,.2,.6,.5,1.1,1,1.6,.5,.5,1,.8,1.6,1s1.2,.4,2.2,.4,1.3,.1,3.7,.1,2.7,0,3.7-.1c1,0,1.6-.2,2.2-.4,.6-.2,1.1-.5,1.6-1s.8-1,1-1.6,.4-1.2,.4-2.2,.1-1.3,.1-3.7,0-2.7-.1-3.7c0-1-.2-1.6-.4-2.2-.2-.6-.5-1.1-1-1.6-.5-.5-1-.8-1.6-1S13.7,0,12.7,0h-3.7Zm0,4.3c-2.6,0-4.6,2.1-4.6,4.6s2.1,4.6,4.6,4.6,4.6-2.1,4.6-4.6-2.1-4.6-4.6-4.6Zm0,7.6c-1.6,0-3-1.3-3-3,0-1.6,1.3-3,3-3,1.6,0,3,1.3,3,3-.1,1.6-1.4,3-3,3ZM13.7,3.1c-.6,0-1.1,.5-1.1,1.1s.5,1.1,1.1,1.1,1.1-.5,1.1-1.1-.5-1.1-1.1-1.1Z" />
                                    </g>
                                </svg>
                            </a>
                        </li>
                        <!-- // line -->
                        <li class="line">
                            <a href="<?php echo $line; ?>" target='_blank' rel='noopener' aria-label="もじゃねこ公式LINE">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.9 18.12">
                                    <path d="M18.9,7.7C18.9,3.4,14.6,0,9.4,0S0,3.4,0,7.7c0,3.8,3.4,7,7.9,7.6,.3,.1,.7,.2,.8,.5,.1,.2,.1,.6,0,.9,0,0-.1,.7-.1,.8,0,.2-.2,.9,.8,.5s5.4-3.2,7.4-5.5h0c1.4-1.6,2.1-3.1,2.1-4.8Zm-13.2,2.5h-1.9c-.3,0-.5-.2-.5-.5v-3.8c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.3h1.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5Zm2-.5c0,.3-.2,.5-.5,.5s-.5-.2-.5-.5v-3.8c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.8Zm4.5,0c0,.2-.1,.4-.3,.5h-.2c-.2,0-.3-.1-.4-.2l-1.9-2.6v2.3c0,.3-.2,.5-.5,.5s-.5-.2-.5-.5v-3.8c0-.2,.1-.4,.3-.5h.2c.2,0,.3,.1,.4,.2l1.9,2.6v-2.3c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.8Zm3-2.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.4v.9h1.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.9c-.3,0-.5-.2-.5-.5v-1.9h0v-1.9h0c0-.3,.2-.5,.5-.5h1.9c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.4v.9h1.4Z" />
                                </svg>
                            </a>
                        </li>

                    </ul>

                </div>
            </div>

            <div class="gallery_slider radius set4 right act blur">
                <ul>
                    <li><img src="<?php echo $img; ?>/goods01.webp" alt="もじゃねこLINEスタンプ もじゃとくるるの楽しい表情" /></li>
                    <li><img src="<?php echo $img; ?>/goods02.webp" alt="もじゃねこオリジナルグッズ 黒猫もじゃと白猫くるるのデザイン" /></li>
                    <li><img src="<?php echo $img; ?>/goods03.webp" alt="もじゃねこグッズ かわいい2匹のキャラクターアイテム" /></li>
                    <li><img src="<?php echo $img; ?>/goods04.webp" alt="もじゃねこグッズ デザネコ公式キャラクターのアイテム" /></li>
                </ul>
                <ul>
                    <li><img src="<?php echo $img; ?>/goods01.webp" alt="もじゃねこLINEスタンプ もじゃとくるるの楽しい表情" /></li>
                    <li><img src="<?php echo $img; ?>/goods02.webp" alt="もじゃねこオリジナルグッズ 黒猫もじゃと白猫くるるのデザイン" /></li>
                    <li><img src="<?php echo $img; ?>/goods03.webp" alt="もじゃねこグッズ かわいい2匹のキャラクターアイテム" /></li>
                    <li><img src="<?php echo $img; ?>/goods04.webp" alt="もじゃねこグッズ デザネコ公式キャラクターのアイテム" /></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- ▼ 関連リンク・外部参照（被リンク先からの相互リンク強化） ▼ -->
    <section>
        <div class='bg_pink'>
            <div class='single02'>
                <div class='mbox act blur'>
                    <h2 class="tcenter line_height_14">
                        <span class="eng pink fs_30 fs_sp22">Related Links</span><br>
                        <span class="fs_30 fs_sp22 font_kiwi bold">もじゃねこの関連リンク</span>
                    </h2>
                    <div class='space_2 space_sp1'></div>
                    <div class="sbox bold">
                        <p class="tjustify">
                            もじゃねこのプロフィールは、ピクシブ百科事典にも掲載されています。<br>
                            また、もじゃねこ関連のSNS・グッズ販売ページは以下からアクセスいただけます。
                        </p>
                        <div class='space_2 space_sp1'></div>
                        <ul class="link_list bold">
                            <li>📘 <a href="https://dic.pixiv.net/a/もじゃねこ" target="_blank" rel="noopener">もじゃねこ｜ピクシブ百科事典</a></li>
                            <li>🎨 <a href="https://store.line.me/stickershop/author/5708453/ja" target="_blank" rel="noopener">もじゃねこLINEスタンプ</a></li>
                            <li>👕 <a href="https://suzuri.jp/design_cat" target="_blank" rel="noopener">もじゃねこオリジナルグッズ（SUZURI）</a></li>
                            <li>📷 <a href="<?php echo $instagram; ?>" target="_blank" rel="noopener">もじゃねこ公式Instagram</a></li>
                            <li>▶️ <a href="<?php echo $youtube; ?>" target="_blank" rel="noopener">もじゃねこ公式YouTube</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<!-- もじゃねこ -->


<?php include_once './footer.php'; ?>
