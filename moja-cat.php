<?php
$page_title = "もじゃネコについて";
$page_title_eng = "Moja cat";
$page_description = "";
$page_style = "";
$page_script = '';
?>
<?php include_once './header.php'; ?>

<!-- もじゃネコ moja-cat.php -->
<div class='overflow'>

    <section>
        <div class="overflow relative bg_pink">

            <div class="puton tcenter center line_height_10 shadow width_sp10">
                <h2>
                    <span class="act02 txt_split type_up fs_120 fs_sp80 line_height_14 tcenter white bold shadow font_kiwi">moja-cats</span>
                    <br>
                    <span class="act03 blur fs_40 fs_sp30 line_height_14 tcenter white bold shadow font_kiwi">もじゃねこの「もじゃ」と「くるる」</span>
                </h2>
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

    <section>
        <div class='bg_pink'>
            <div class='space_1 space_sp1'></div>
            <ul class="sns_btn a_center j_center">

                <!-- // youtube -->
                <li class="youtube">
                    <a href="<?php echo $youtube; ?>" target="_blank" rel="nofollow">
                        <svg id="a" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.1 13.37">
                            <path class="b" d="M18.7,2.09c-.22-.82-.87-1.47-1.69-1.69-1.49-.4-7.46-.4-7.46-.4,0,0-5.97,0-7.46,.4-.82,.22-1.47,.87-1.69,1.69-.4,1.49-.4,4.6-.4,4.6,0,0,0,3.11,.4,4.6,.22,.82,.87,1.47,1.69,1.69,1.49,.4,7.46,.4,7.46,.4,0,0,5.97,0,7.46-.4,.82-.22,1.47-.87,1.69-1.69,.4-1.49,.4-4.6,.4-4.6,0,0,0-3.11-.4-4.6ZM7.64,9.55V3.82l4.96,2.86-4.96,2.86Z" />
                        </svg>
                    </a>
                </li>
                <!-- // instagram -->
                <li class="instagram">
                    <a href="<?php echo $instagram; ?>" target="_blank" rel="nofollow">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17.9">
                            <g>
                                <path class="c" d="M9,1.6c2.4,0,2.7,0,3.6,.1,.9,0,1.3,.2,1.7,.3,.4,.2,.7,.4,1,.7s.5,.6,.7,1c.1,.3,.3,.8,.3,1.7s.1,1.2,.1,3.6,0,2.7-.1,3.6c0,.9-.2,1.3-.3,1.7-.2,.4-.4,.7-.7,1s-.6,.5-1,.7c-.3,.1-.8,.3-1.7,.3s-1.2,.1-3.6,.1-2.7,0-3.6-.1c-.9,0-1.3-.2-1.7-.3-.4-.2-.7-.4-1-.7s-.5-.6-.7-1c-.1-.4-.3-.9-.3-1.8s-.1-1.2-.1-3.6,0-2.7,.1-3.6c0-.9,.2-1.3,.3-1.7,.2-.4,.4-.7,.7-1s.6-.5,1-.7c.3-.1,.8-.3,1.7-.3h3.6m0-1.6c-2.4,0-2.7,0-3.7,.1-1,0-1.6,.2-2.2,.4-.6,.2-1.1,.5-1.6,1-.5,.5-.8,1-1,1.6-.2,.5-.4,1.2-.4,2.1,0,1-.1,1.3-.1,3.7s0,2.7,.1,3.7c0,1,.2,1.6,.4,2.2,.2,.6,.5,1.1,1,1.6,.5,.5,1,.8,1.6,1s1.2,.4,2.2,.4,1.3,.1,3.7,.1,2.7,0,3.7-.1c1,0,1.6-.2,2.2-.4,.6-.2,1.1-.5,1.6-1s.8-1,1-1.6,.4-1.2,.4-2.2,.1-1.3,.1-3.7,0-2.7-.1-3.7c0-1-.2-1.6-.4-2.2-.2-.6-.5-1.1-1-1.6-.5-.5-1-.8-1.6-1S13.7,0,12.7,0h-3.7Zm0,4.3c-2.6,0-4.6,2.1-4.6,4.6s2.1,4.6,4.6,4.6,4.6-2.1,4.6-4.6-2.1-4.6-4.6-4.6Zm0,7.6c-1.6,0-3-1.3-3-3,0-1.6,1.3-3,3-3,1.6,0,3,1.3,3,3-.1,1.6-1.4,3-3,3ZM13.7,3.1c-.6,0-1.1,.5-1.1,1.1s.5,1.1,1.1,1.1,1.1-.5,1.1-1.1-.5-1.1-1.1-1.1Z" />
                            </g>
                        </svg>
                    </a>
                </li>
                <!-- // line -->
                <li class="line">
                    <a href="<?php echo $line; ?>" target='_blank' rel='noopener'>
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
                        <img class="radius" src='<?php echo $img; ?>/moja-cats_moja.webp' alt='もじゃネコの黒ネコ「もじゃ」' loading='lazy'>
                    </div>
                    <div class='width_4 width_sp10 p10 act inup'>
                        <div>
                            <h2>
                                <span class='bold border_bottom fs_35 fs_sp24 font_kiwi'>
                                    もじゃネコの黒ネコ「もじゃ」
                                </span>
                            </h2>
                            <div class='space_2 space_sp1'></div>

                            <div class="tjustify bold">
                                <p>
                                    黒い毛並みと黄色い瞳、そしてトレードマークの“もじゃもじゃヘア”が特徴の黒ネコ。<br>
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
                        <img class="radius" src='<?php echo $img; ?>/moja-cats_kururu.webp' alt='もじゃネコの黒ネコ「もじゃ」' loading='lazy'>
                    </div>
                    <div class='width_4 width_sp10 p10 act inup'>
                        <div>
                            <h2>
                                <span class='bold pink border_bottom fs_35 fs_sp24 font_kiwi'>
                                    もじゃネコの白ネコ「くるる」
                                </span>
                            </h2>
                            <div class='space_2 space_sp1'></div>

                            <div class="tjustify bold">
                                <p>
                                    白い毛並みと青い瞳、そしてまるでパーマをかけたような美しいカールヘアが特徴の白ネコ。<br>
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
                    <li><img src="<?php echo $img; ?>/goods01.webp" alt="もじゃネコのグッズ01" /></li>
                    <li><img src="<?php echo $img; ?>/goods02.webp" alt="もじゃネコのグッズ02" /></li>
                    <li><img src="<?php echo $img; ?>/goods03.webp" alt="もじゃネコのグッズ03" /></li>
                    <li><img src="<?php echo $img; ?>/goods04.webp" alt="もじゃネコのグッズ04" /></li>
                </ul>
                <ul>
                    <li><img src="<?php echo $img; ?>/goods01.webp" alt="もじゃネコのグッズ01" /></li>
                    <li><img src="<?php echo $img; ?>/goods02.webp" alt="もじゃネコのグッズ02" /></li>
                    <li><img src="<?php echo $img; ?>/goods03.webp" alt="もじゃネコのグッズ03" /></li>
                    <li><img src="<?php echo $img; ?>/goods04.webp" alt="もじゃネコのグッズ04" /></li>
                </ul>
            </div>
            <div class='space_3 space_sp4'></div>
            <div class="tcenter b_m5">
                <img width="80px" src='<?php echo $img; ?>/favicon_goods.webp' alt='イメージ画像' loading='lazy'>
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
                            そんなもじゃネコの「もじゃ」と「くるる」のLINEスタンプと、かわいいオリジナルグッズができました！<br>
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
                    <button class='btn_hologram center'><a href='https://suzuri.jp/design_cat' target='_blank' rel='noopener'>「もじゃネコ」のオリジナルグッズ販売中</a></button>
                    <div class='space_1 space_sp1'></div>
                    <ul class="sns_btn a_center j_center">

                        <!-- // youtube -->
                        <li class="youtube">
                            <a href="<?php echo $youtube; ?>" target="_blank" rel="nofollow">
                                <svg id="a" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.1 13.37">
                                    <path class="b" d="M18.7,2.09c-.22-.82-.87-1.47-1.69-1.69-1.49-.4-7.46-.4-7.46-.4,0,0-5.97,0-7.46,.4-.82,.22-1.47,.87-1.69,1.69-.4,1.49-.4,4.6-.4,4.6,0,0,0,3.11,.4,4.6,.22,.82,.87,1.47,1.69,1.69,1.49,.4,7.46,.4,7.46,.4,0,0,5.97,0,7.46-.4,.82-.22,1.47-.87,1.69-1.69,.4-1.49,.4-4.6,.4-4.6,0,0,0-3.11-.4-4.6ZM7.64,9.55V3.82l4.96,2.86-4.96,2.86Z" />
                                </svg>
                            </a>
                        </li>
                        <!-- // instagram -->
                        <li class="instagram">
                            <a href="<?php echo $instagram; ?>" target="_blank" rel="nofollow">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17.9">
                                    <g>
                                        <path class="c" d="M9,1.6c2.4,0,2.7,0,3.6,.1,.9,0,1.3,.2,1.7,.3,.4,.2,.7,.4,1,.7s.5,.6,.7,1c.1,.3,.3,.8,.3,1.7s.1,1.2,.1,3.6,0,2.7-.1,3.6c0,.9-.2,1.3-.3,1.7-.2,.4-.4,.7-.7,1s-.6,.5-1,.7c-.3,.1-.8,.3-1.7,.3s-1.2,.1-3.6,.1-2.7,0-3.6-.1c-.9,0-1.3-.2-1.7-.3-.4-.2-.7-.4-1-.7s-.5-.6-.7-1c-.1-.4-.3-.9-.3-1.8s-.1-1.2-.1-3.6,0-2.7,.1-3.6c0-.9,.2-1.3,.3-1.7,.2-.4,.4-.7,.7-1s.6-.5,1-.7c.3-.1,.8-.3,1.7-.3h3.6m0-1.6c-2.4,0-2.7,0-3.7,.1-1,0-1.6,.2-2.2,.4-.6,.2-1.1,.5-1.6,1-.5,.5-.8,1-1,1.6-.2,.5-.4,1.2-.4,2.1,0,1-.1,1.3-.1,3.7s0,2.7,.1,3.7c0,1,.2,1.6,.4,2.2,.2,.6,.5,1.1,1,1.6,.5,.5,1,.8,1.6,1s1.2,.4,2.2,.4,1.3,.1,3.7,.1,2.7,0,3.7-.1c1,0,1.6-.2,2.2-.4,.6-.2,1.1-.5,1.6-1s.8-1,1-1.6,.4-1.2,.4-2.2,.1-1.3,.1-3.7,0-2.7-.1-3.7c0-1-.2-1.6-.4-2.2-.2-.6-.5-1.1-1-1.6-.5-.5-1-.8-1.6-1S13.7,0,12.7,0h-3.7Zm0,4.3c-2.6,0-4.6,2.1-4.6,4.6s2.1,4.6,4.6,4.6,4.6-2.1,4.6-4.6-2.1-4.6-4.6-4.6Zm0,7.6c-1.6,0-3-1.3-3-3,0-1.6,1.3-3,3-3,1.6,0,3,1.3,3,3-.1,1.6-1.4,3-3,3ZM13.7,3.1c-.6,0-1.1,.5-1.1,1.1s.5,1.1,1.1,1.1,1.1-.5,1.1-1.1-.5-1.1-1.1-1.1Z" />
                                    </g>
                                </svg>
                            </a>
                        </li>
                        <!-- // line -->
                        <li class="line">
                            <a href="<?php echo $line; ?>" target='_blank' rel='noopener'>
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
                    <li><img src="<?php echo $img; ?>/goods01.webp" alt="もじゃネコのグッズ01" /></li>
                    <li><img src="<?php echo $img; ?>/goods02.webp" alt="もじゃネコのグッズ02" /></li>
                    <li><img src="<?php echo $img; ?>/goods03.webp" alt="もじゃネコのグッズ03" /></li>
                    <li><img src="<?php echo $img; ?>/goods04.webp" alt="もじゃネコのグッズ04" /></li>
                </ul>
                <ul>
                    <li><img src="<?php echo $img; ?>/goods01.webp" alt="もじゃネコのグッズ01" /></li>
                    <li><img src="<?php echo $img; ?>/goods02.webp" alt="もじゃネコのグッズ02" /></li>
                    <li><img src="<?php echo $img; ?>/goods03.webp" alt="もじゃネコのグッズ03" /></li>
                    <li><img src="<?php echo $img; ?>/goods04.webp" alt="もじゃネコのグッズ04" /></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- <section>
        <div class="bg_pink">
            <div class='single'>
                <div>
                    <div class="tcenter b_m5">
                        <img width="80px" src='<?php echo $img; ?>/favicon_goods.webp' alt='イメージ画像' loading='lazy'>
                    </div>
                    <h2 class="line_height_14 tcenter">
                        <span class="eng pink fs_40 act txt_split type_popup">Recommended
                        </span><br>
                        <span class="fs_40 fs_sp30 act blur font_kiwi">
                            こんな方におすすめ
                        </span>
                    </h2>
                    <div class='space_3 space_sp3'></div>
                    <ul class="voice grid set2 gap1">

                        <li>
                            <div class="figure">
                                <img src="<?php echo $img; ?>/w01.webp" alt="">
                            </div>
                            <div class="speech act inleft">
                                <p class="fs_size_m">グッズ制作がはじめてで、何から始めたらいいかわからない⋯</p>
                            </div>
                        </li>
                        <li>
                            <div class="figure">
                                <img src="<?php echo $img; ?>/w02.webp" alt="">
                            </div>
                            <div class="speech act inleft">
                                <p class="fs_size_m">自分だけのオリジナルアイテムを作ってみたい⋯</p>
                            </div>
                        </li>
                        <li>
                            <div class="figure">
                                <img src="<?php echo $img; ?>/w03.webp" alt="">
                            </div>
                            <div class="speech act inleft">
                                <p class="fs_size_m">イベントやライブで配るグッズを用意したい⋯</p>
                            </div>
                        </li>
                        <li>
                            <div class="figure">
                                <img src="<?php echo $img; ?>/w04.webp" alt="">
                            </div>
                            <div class="speech act inleft">
                                <p class="fs_size_m">少ない数量で気軽に販売したい⋯</p>
                            </div>
                        </li>
                        <li>
                            <div class="figure">
                                <img src="<?php echo $img; ?>/w05.webp" alt="">
                            </div>
                            <div class="speech act inleft">
                                <p class="fs_size_m">デザインに自信がなく、相談しながら進めたい⋯</p>
                            </div>
                        </li>
                        <li>
                            <div class="figure">
                                <img src="<?php echo $img; ?>/w06.webp" alt="">
                            </div>
                            <div class="speech act inleft">
                                <p class="fs_size_m">自社のノベルティや商品パッケージのデザインを作りたい⋯</p>
                            </div>
                        </li>
                        <li>
                            <div class="figure">
                                <img src="<?php echo $img; ?>/w07.webp" alt="">
                            </div>
                            <div class="speech act inleft">
                                <p class="fs_size_m">お友達や家族へのプレゼントとしてオリジナルグッズを作りたい⋯</p>
                            </div>
                        </li>
                        <li>
                            <div class="figure">
                                <img src="<?php echo $img; ?>/w08.webp" alt="">
                            </div>
                            <div class="speech act inleft">
                                <p class="fs_size_m">ショップやブランドのオリジナル商品を試作で販売したい⋯</p>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </section> -->

    <!--  <section>
        <div class='bg_pink'>
            <div class='single02'>
                <div class='mbox '>
                    <div class="tcenter b_m5">
                        <img width="80px" src='<?php echo $img; ?>/favicon_goods.webp' alt='イメージ画像' loading='lazy'>
                    </div>
                    <h2 class="line_height_14 tcenter">
                        <span class="eng pink fs_40 act txt_split type_popup">Voice
                        </span><br>
                        <span class="fs_40 fs_sp30 act blur font_kiwi">
                            お客様からのうれしい声
                        </span>
                    </h2>
                    <div class='space_3 space_sp3'></div>
                    <ul class="grid2 voice_box">
                        <li class="b_m20 radius">
                            <div class='mbox bg_white'>
                                <div class='flexbox gap3'>
                                    <div class="width_3 width_sp10">
                                        <div class="picture">
                                            <img src='<?php echo $img; ?>/voice03.webp' alt='イメージ画像' loading='lazy'>
                                        </div>
                                    </div>
                                    <div class='width_7 width_sp10 act inup'>
                                        <p class="bold b_m10 fs_30 fs_sp22">
                                            <span class="pink border_bottom">カフェ経営／Dさん／Aさん</span><br>
                                        </p>

                                        <dl class="dl_list pink radius b_m10">
                                            <dt>年齢</dt>
                                            <dd>50代</dd>
                                            <dt>地域</dt>
                                            <dd>沖縄・宜野湾</dd>
                                        </dl>

                                        <div class="memo">
                                            <p>
                                                <b class="pink">デザインに自信がなかったけど、丁寧にサポートしてくれて安心でした！</b><br>
                                                初めての商品開発のシールデザインで不安でしたが、イメージやこちらの要望を伝えるだけで形にしてもらえて感動しました。仕上がりも大満足です！
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="b_m20 radius">
                            <div class='mbox bg_white b_m20'>
                                <div class='flexbox gap3'>
                                    <div class="width_3 width_sp10">
                                        <div class="picture">
                                            <img src='<?php echo $img; ?>/voice02.webp' alt='イメージ画像' loading='lazy'>
                                        </div>
                                    </div>
                                    <div class='width_7 width_sp10 act inup'>
                                        <p class="bold b_m10 fs_30 fs_sp22">
                                            <span class="pink border_bottom">Sさん</span><br>
                                        </p>

                                        <dl class="dl_list pink radius b_m10">
                                            <dt>年齢</dt>
                                            <dd>30代</dd>
                                            <dt>地域</dt>
                                            <dd>沖縄・宜野湾</dd>
                                        </dl>

                                        <div class="memo">
                                            <p>
                                                <b class="pink">プレゼントで渡したらすごく喜ばれました！</b><br>
                                                家族のペットの写真を使ってタンブラーを作りプレゼント！世界に一つだけの贈り物になって、サプライズ大成功でした！
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="b_m20 radius">
                            <div class='mbox bg_white b_m20'>
                                <div class='flexbox gap3'>
                                    <div class="width_3 width_sp10">
                                        <div class="picture">
                                            <img src='<?php echo $img; ?>/voice01.webp' alt='イメージ画像' loading='lazy'>
                                        </div>
                                    </div>
                                    <div class='width_7 width_sp10 act inup'>
                                        <p class="bold b_m10 fs_30 fs_sp22">
                                            <span class="pink border_bottom">Hさん</span><br>
                                        </p>

                                        <dl class="dl_list pink radius b_m10">
                                            <dt>年齢</dt>
                                            <dd>40代</dd>
                                            <dt>地域</dt>
                                            <dd>沖縄・宜野湾</dd>
                                        </dl>

                                        <div class="memo">
                                            <p>
                                                <b class="pink">少ない数でも販売できて助かりました！</b><br>
                                                イベント用に10個だけ作りたかったのですが、気軽にお願いできて本当にありがたかったです。次は別のアイテムも作りたいです！
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>

                </div>

            </div>
        </div>
    </section> -->
    <!-- 
    <section>
        <div class="bg_pink">
            <div class="single03">
                <div class="mbox bg_white radius">
                    <div class="tcenter b_m5">
                        <img width="80px" src='<?php echo $img; ?>/favicon_goods.webp' alt='イメージ画像' loading='lazy'>
                    </div>
                    <h2 class="line_height_14 tcenter">
                        <span class="eng pink fs_40 act txt_split type_popup">Question
                        </span><br>
                        <span class="fs_40 fs_sp30 act blur font_kiwi">
                            よくあるご質問
                        </span>
                    </h2>
                    <div class='space_3 space_sp1'></div>

                    <div class="sbox act blur">
                        <dl class='accordion pink'>
                            <dt class='open'>はじめてのグッズ制作でも大丈夫ですか？</dt>
                            <dd class='panel'>
                                <div class='inner'>
                                    <p>はい、もちろん大丈夫です！<br>
                                        デザインのご相談から制作の流れまで、スタッフが丁寧にサポートいたします。</p>
                                </div>
                            </dd>
                            <dt class='open'>デザインのデータがなくても注文できますか？</dt>
                            <dd class='panel'>
                                <div class='inner'>
                                    <p>はい、手描きのイメージやイメージ写真があればOKです。こちらでデータ化やデザインの調整も承ります。</p>
                                </div>
                            </dd>
                            <dt class='open'>何個から注文できますか？</dt>
                            <dd class='panel'>
                                <div class='inner'>
                                    <p>商品によって異なりますが、1個から注文できるアイテムも多数ご用意しています。お気軽にご相談ください。</p>
                                </div>
                            </dd>
                            <dt class='open'>納期はどのくらいかかりますか？</dt>
                            <dd class='panel'>
                                <div class='inner'>
                                    <p>ご注文内容や数量によって異なりますが、通常はご注文確定から約1〜2週間程度でお届け可能です。</p>
                                </div>
                            </dd>
                            <dt class='open'>グッズの色や素材は選べますか？</dt>
                            <dd class='panel'>
                                <div class='inner'>
                                    <p>はい、商品によってカラーバリエーションや素材が複数ございます。選べる選択肢をご案内します。</p>
                                </div>
                            </dd>
                        </dl>
                    </div>

                </div>
            </div>
        </div>
    </section> -->
    <!-- 
    <section>
        <div class="bg_pink">
            <div class="single">
                <div class="tcenter b_m5">
                    <img width="80px" src='<?php echo $img; ?>/favicon_goods.webp' alt='イメージ画像' loading='lazy'>
                </div>
                <h2 class="line_height_14 tcenter">
                    <span class="eng pink fs_40 act txt_split type_popup">Flow
                    </span><br>
                    <span class="fs_40 fs_sp30 act blur font_kiwi">
                        ご利用の流れ
                    </span>
                </h2>
                <div class='space_3 space_sp1'></div>
                <div class="mbox radius bg_white">
                    <div class="sbox">
                        <dl class="flow_dl pink">
                            <div class="inner">
                                <dt class="act set">Step.1</dt>
                                <dd class="act inright">
                                    <b class="pink">お問い合わせ・ご相談（無料）</b><br>
                                    「こんなグッズを作りたい」「デザインが決まっていないけど大丈夫？」など、どんな内容でもお気軽にご相談ください。
                                </dd>
                            </div>
                            <div class="inner">
                                <dt class="act set">Step.2</dt>
                                <dd class="act inright">
                                    <b class="pink">ヒアリング・ご提案</b><br>
                                    ご希望のアイテム、用途、数量、デザインのイメージなどをお伺いし、ぴったりのプランや商品をご提案します。
                                </dd>
                            </div>
                            <div class="inner">

                                <dt class="act set">Step.3</dt>
                                <dd class="act inright">
                                    <b class="pink">お見積りのご確認</b><br>
                                    内容に応じてお見積りをお出しします。ご納得いただけた場合、正式にご注文となります。
                                </dd>
                            </div>
                            <div class="inner">

                                <dt class="act set">Step.4</dt>
                                <dd class="act inright">
                                    <b class="pink">デザイン制作・最終確認</b><br>
                                    お持ちのデザインデータを元に調整したり、こちらでデザインを作成したり、ご要望に合わせて対応します。完成イメージをご確認いただきます。
                                </dd>
                            </div>
                            <div class="inner">

                                <dt class="act set">Step.5</dt>
                                <dd class="act inright">
                                    <b class="pink">制作・印刷</b><br>
                                    ご確認後、グッズの制作・印刷に入ります。心を込めて丁寧に仕上げます。
                                </dd>
                            </div>
                            <div class="inner">

                                <dt class="act set">Step.6</dt>
                                <dd class="act inright">
                                    <b class="pink">納品・お届け</b><br>
                                    完成した商品をご指定の場所へお届けします。全国発送にも対応しています。
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

            </div>
        </div>
    </section> -->
    <!-- 
    <section>
        <div class='bg_pink'>
            <div class='single02'>
                <div class='flexbox reversal'>
                    <div class='width_5 width_sp10 act blur'>
                        <img class="radius" src='<?php echo $img; ?>/goods_img02.webp' alt='「作って終わり」ではありませんイメージ画像' loading='lazy'>
                    </div>
                    <div class='width_4 width_sp10 p10 act inup'>
                        <div>
                            <h3>
                                <span class='bold pink border_bottom fs_35 fs_sp28 font_kiwi'>
                                    「作って終わり」ではありません
                                </span>
                            </h3>
                            <div class='space_2 space_sp1'></div>

                            <div class="tjustify bold">
                                <p>
                                    オリジナルグッズは、ただ作るだけではなく、そのあとに「どう届けるか」もとても大切です。<br>
                                    デザネコでは、デザイン制作や発注のお手伝いだけでなく、完成したグッズをどう届けるかまで、一緒に考えていきます。<br>
                                </p>
                                <p>
                                    たとえば、SNSでの紹介方法や、チラシやWebでの配布アイデアなど<span class="underline_y pink">「作ったあと」にこそ、あなたの商品が生きる場所</span>があります。<br>
                                    作って終わりじゃない。<b class="pink">“あなたの想い”</b>を届けるところまでのお手伝いもお任せください。
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section> -->

</div>
<!-- もじゃネコ -->


<?php include_once './footer.php'; ?>