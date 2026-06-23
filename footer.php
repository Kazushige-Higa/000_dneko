<?php
// ==========================================
//  サイト共通CTAバナー
//  microCMS「cta_banner」API（オブジェクト形式）から取得
//  enabled=trueの場合のみ表示
// ==========================================
$cta_banner = microcms_get("/cta_banner");
if ($cta_banner && isset($cta_banner->enabled) && $cta_banner->enabled === true):
  $cta_heading     = isset($cta_banner->heading) ? trim((string)$cta_banner->heading) : '';
  $cta_description = isset($cta_banner->description) ? trim((string)$cta_banner->description) : '';
  $cta_image_url   = (isset($cta_banner->image->url) && $cta_banner->image->url !== '') ? $cta_banner->image->url : '';
  $cta_btn_text    = isset($cta_banner->button_text) ? trim((string)$cta_banner->button_text) : '';
  $cta_btn_url     = isset($cta_banner->button_url) ? trim((string)$cta_banner->button_url) : '';
  $cta_btn_text2   = isset($cta_banner->button_text2) ? trim((string)$cta_banner->button_text2) : '';
  $cta_btn_url2    = isset($cta_banner->button_url2) ? trim((string)$cta_banner->button_url2) : '';
?>
<section class="site-cta-banner">
  <div class="site-cta-banner__inner">
    <?php if ($cta_image_url !== ''): ?>
    <div class="site-cta-banner__image">
      <img src="<?php echo htmlspecialchars($cta_image_url, ENT_QUOTES, 'UTF-8'); ?>?w=600" alt="<?php echo htmlspecialchars($cta_heading, ENT_QUOTES, 'UTF-8'); ?>" loading="lazy">
    </div>
    <?php endif; ?>
    <div class="site-cta-banner__body">
      <?php if ($cta_heading !== ''): ?>
      <h3 class="site-cta-banner__heading"><?php echo htmlspecialchars($cta_heading, ENT_QUOTES, 'UTF-8'); ?></h3>
      <?php endif; ?>
      <?php if ($cta_description !== ''): ?>
      <p class="site-cta-banner__desc"><?php echo nl2br(htmlspecialchars($cta_description, ENT_QUOTES, 'UTF-8')); ?></p>
      <?php endif; ?>
      <?php if ($cta_btn_text !== '' && $cta_btn_url !== ''): ?>
      <div class="site-cta-banner__buttons">
        <a href="<?php echo htmlspecialchars($cta_btn_url, ENT_QUOTES, 'UTF-8'); ?>" class="site-cta-banner__btn site-cta-banner__btn--primary"><?php echo htmlspecialchars($cta_btn_text, ENT_QUOTES, 'UTF-8'); ?></a>
        <?php if ($cta_btn_text2 !== '' && $cta_btn_url2 !== ''): ?>
        <a href="<?php echo htmlspecialchars($cta_btn_url2, ENT_QUOTES, 'UTF-8'); ?>" class="site-cta-banner__btn site-cta-banner__btn--secondary"><?php echo htmlspecialchars($cta_btn_text2, ENT_QUOTES, 'UTF-8'); ?></a>
        <?php endif; ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<footer>
    <div class='bg_grd_anime overflow'>
        <div class='single'>
            <h3 class="tcenter line_height_18">
                <span class="bold white fs_35 fs_sp30 font_kiwi">
                    無料相談受付中。<br>
                    LINEで気軽にご相談ください。
                </span>
            </h3>
            <div class='space_3 space_sp2'></div>
            <div class="sbox">
                <button class="btn_normal transparent center radius fs_20 fs_sp20">
                    <a href="<?php echo $line; ?>" target='_blank' rel='noopener'
                      onclick="gtag('event','line_click',{'event_category':'contact','event_label':'footer_btn'})">
                        <i class="fab fa-line" style="font-size: 1.3em; vertical-align: middle; margin-right: 0.5em;"></i>
                        公式LINEからお問い合わせ
                    </a>
                </button>
            </div>
        </div>
    </div>


    <div class="bg_white">
        <div class="single03">

            <div class='flexbox'>
                <div class='width_3 width_sp10'>
                    <div class="b_m5 tcenter">
                        <img src='<?php echo $img; ?>/logo.png' alt='<?php echo $company; ?>' loading='lazy'>
                    </div>
                    <ul class="sns_btn type1 center b_m5">


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
                            <a href="<?php echo $instagram; ?>" target="_blank" rel="nofollow"
                              onclick="gtag('event','instagram_click',{'event_category':'sns','event_label':'footer_icon'})">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17.9">
                                    <g>
                                        <path class="c" d="M9,1.6c2.4,0,2.7,0,3.6,.1,.9,0,1.3,.2,1.7,.3,.4,.2,.7,.4,1,.7s.5,.6,.7,1c.1,.3,.3,.8,.3,1.7s.1,1.2,.1,3.6,0,2.7-.1,3.6c0,.9-.2,1.3-.3,1.7-.2,.4-.4,.7-.7,1s-.6,.5-1,.7c-.3,.1-.8,.3-1.7,.3s-1.2,.1-3.6,.1-2.7,0-3.6-.1c-.9,0-1.3-.2-1.7-.3-.4-.2-.7-.4-1-.7s-.5-.6-.7-1c-.1-.4-.3-.9-.3-1.8s-.1-1.2-.1-3.6,0-2.7,.1-3.6c0-.9,.2-1.3,.3-1.7,.2-.4,.4-.7,.7-1s.6-.5,1-.7c.3-.1,.8-.3,1.7-.3h3.6m0-1.6c-2.4,0-2.7,0-3.7,.1-1,0-1.6,.2-2.2,.4-.6,.2-1.1,.5-1.6,1-.5,.5-.8,1-1,1.6-.2,.5-.4,1.2-.4,2.1,0,1-.1,1.3-.1,3.7s0,2.7,.1,3.7c0,1,.2,1.6,.4,2.2,.2,.6,.5,1.1,1,1.6,.5,.5,1,.8,1.6,1s1.2,.4,2.2,.4,1.3,.1,3.7,.1,2.7,0,3.7-.1c1,0,1.6-.2,2.2-.4,.6-.2,1.1-.5,1.6-1s.8-1,1-1.6,.4-1.2,.4-2.2,.1-1.3,.1-3.7,0-2.7-.1-3.7c0-1-.2-1.6-.4-2.2-.2-.6-.5-1.1-1-1.6-.5-.5-1-.8-1.6-1S13.7,0,12.7,0h-3.7Zm0,4.3c-2.6,0-4.6,2.1-4.6,4.6s2.1,4.6,4.6,4.6,4.6-2.1,4.6-4.6-2.1-4.6-4.6-4.6Zm0,7.6c-1.6,0-3-1.3-3-3,0-1.6,1.3-3,3-3,1.6,0,3,1.3,3,3-.1,1.6-1.4,3-3,3ZM13.7,3.1c-.6,0-1.1,.5-1.1,1.1s.5,1.1,1.1,1.1,1.1-.5,1.1-1.1-.5-1.1-1.1-1.1Z" />
                                    </g>
                                </svg>
                            </a>
                        </li>
                        <!-- // line -->
                        <li class="line">
                            <a href="<?php echo $line; ?>" target='_blank' rel='noopener'
                              onclick="gtag('event','line_click',{'event_category':'contact','event_label':'footer_icon'})">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.9 18.12">
                                    <path d="M18.9,7.7C18.9,3.4,14.6,0,9.4,0S0,3.4,0,7.7c0,3.8,3.4,7,7.9,7.6,.3,.1,.7,.2,.8,.5,.1,.2,.1,.6,0,.9,0,0-.1,.7-.1,.8,0,.2-.2,.9,.8,.5s5.4-3.2,7.4-5.5h0c1.4-1.6,2.1-3.1,2.1-4.8Zm-13.2,2.5h-1.9c-.3,0-.5-.2-.5-.5v-3.8c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.3h1.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5Zm2-.5c0,.3-.2,.5-.5,.5s-.5-.2-.5-.5v-3.8c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.8Zm4.5,0c0,.2-.1,.4-.3,.5h-.2c-.2,0-.3-.1-.4-.2l-1.9-2.6v2.3c0,.3-.2,.5-.5,.5s-.5-.2-.5-.5v-3.8c0-.2,.1-.4,.3-.5h.2c.2,0,.3,.1,.4,.2l1.9,2.6v-2.3c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.8Zm3-2.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.4v.9h1.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.9c-.3,0-.5-.2-.5-.5v-1.9h0v-1.9h0c0-.3,.2-.5,.5-.5h1.9c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.4v.9h1.4Z" />
                                </svg>
                            </a>
                        </li>


                    </ul>


                </div>
                <div class='width_6 width_sp10 pconly'>
                    <nav class="nav_icon clone_nav tcenter set4 bold" aria-label="フッターナビゲーション">
                    </nav>
                </div>
            </div>
            <nav class="nav_normal t_m10 tcenter center" aria-label="法的情報">
                <ul>
                    <li><a href="privacypolicy.php">プライバシーポリシー</a></li>
                    <li><a href="law.php">特定商取引法に基づく表記について</a></li>
                </ul>
            </nav>

        </div>
    </div>

    <div class="bg_base_color p5 tcenter white">
        <small>&copy;<?php echo date('Y'); ?> <?php echo $copyright; ?>.</small>
    </div>
</footer>

<div id="pagetop" class="radius bottom">
    <a href="#top"><i class="fas fa-chevron-up" alt="to top"></i></a>
</div>

<script src="js/javascript.js" defer></script>
<script src="js/bg_parallax.js" defer></script>

<?php echo $page_script; ?>
</body>

</html>