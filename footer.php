<?php include __DIR__ . '/footer-contact.php'; ?>
<?php require_once __DIR__ . '/site-navigation.php'; ?>
<?php
$dr_line_url = isset($line) ? $line : 'contact.php';
if (!isset($dr_navigation_items)) {
    $dr_navigation_items = dneko_navigation_items($dr_line_url);
}
?>
<footer>
    <div class="bg_white">
        <div class="single03">

            <div class='flexbox'>
                <div class='width_3 width_sp10'>
                    <div class="b_m5 tcenter">
                        <img src='<?php echo $img; ?>/logo.png' alt='<?php echo $company; ?>' width='424' height='160' loading='lazy' decoding='async'>
                    </div>
                    <ul class="sns_btn type1 center b_m5">


                        <!-- // youtube -->
                        <li class="youtube">
                            <a href="<?php echo htmlspecialchars($youtube, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="nofollow noopener noreferrer">
                                <svg id="a" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19.1 13.37">
                                    <path class="b" d="M18.7,2.09c-.22-.82-.87-1.47-1.69-1.69-1.49-.4-7.46-.4-7.46-.4,0,0-5.97,0-7.46,.4-.82,.22-1.47,.87-1.69,1.69-.4,1.49-.4,4.6-.4,4.6,0,0,0,3.11,.4,4.6,.22,.82,.87,1.47,1.69,1.69,1.49,.4,7.46,.4,7.46,.4,0,0,5.97,0,7.46-.4,.82-.22,1.47-.87,1.69-1.69,.4-1.49,.4-4.6,.4-4.6,0,0,0-3.11-.4-4.6ZM7.64,9.55V3.82l4.96,2.86-4.96,2.86Z" />
                                </svg>
                            </a>
                        </li>
                        <!-- // instagram -->
                        <li class="instagram">
                            <a href="<?php echo htmlspecialchars($instagram, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="nofollow noopener noreferrer"
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
                            <a href="<?php echo htmlspecialchars($dr_line_url, ENT_QUOTES, 'UTF-8'); ?>" target='_blank' rel='noopener'
                              onclick="gtag('event','line_click',{'event_category':'contact','event_label':'footer_icon'})">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18.9 18.12">
                                    <path d="M18.9,7.7C18.9,3.4,14.6,0,9.4,0S0,3.4,0,7.7c0,3.8,3.4,7,7.9,7.6,.3,.1,.7,.2,.8,.5,.1,.2,.1,.6,0,.9,0,0-.1,.7-.1,.8,0,.2-.2,.9,.8,.5s5.4-3.2,7.4-5.5h0c1.4-1.6,2.1-3.1,2.1-4.8Zm-13.2,2.5h-1.9c-.3,0-.5-.2-.5-.5v-3.8c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.3h1.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5Zm2-.5c0,.3-.2,.5-.5,.5s-.5-.2-.5-.5v-3.8c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.8Zm4.5,0c0,.2-.1,.4-.3,.5h-.2c-.2,0-.3-.1-.4-.2l-1.9-2.6v2.3c0,.3-.2,.5-.5,.5s-.5-.2-.5-.5v-3.8c0-.2,.1-.4,.3-.5h.2c.2,0,.3,.1,.4,.2l1.9,2.6v-2.3c0-.3,.2-.5,.5-.5s.5,.2,.5,.5v3.8Zm3-2.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.4v.9h1.4c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.9c-.3,0-.5-.2-.5-.5v-1.9h0v-1.9h0c0-.3,.2-.5,.5-.5h1.9c.3,0,.5,.2,.5,.5s-.2,.5-.5,.5h-1.4v.9h1.4Z" />
                                </svg>
                            </a>
                        </li>


                    </ul>


                </div>
                <div class='width_6 width_sp10'>
                    <nav class="nav_icon dr_footer_navigation tcenter set4 bold" aria-label="フッターナビゲーション">
                        <?php dneko_render_navigation($dr_navigation_items, 'dr_global_nav_list dr_footer_nav_list'); ?>
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

<div id="pagetop" class="radius bottom dr_common_pagetop">
    <a href="<?php echo htmlspecialchars($page_top_href ?? '#top', ENT_QUOTES, 'UTF-8'); ?>" aria-label="ページトップへ"><i class="fas fa-chevron-up" aria-hidden="true"></i><span>TOP</span></a>
</div>

<script src="js/site-common.js?v=<?= filemtime(__DIR__ . '/js/site-common.js') ?>" defer></script>
<script src="js/javascript.js?v=<?= filemtime(__DIR__ . '/js/javascript.js') ?>" defer></script>
<script src="js/bg_parallax.js?v=<?= filemtime(__DIR__ . '/js/bg_parallax.js') ?>" defer></script>

<?php echo $page_script ?? ''; ?>
</body>

</html>
