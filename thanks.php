<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

$ticket = isset($_GET['ticket']) && is_string($_GET['ticket']) ? $_GET['ticket'] : '';
$tickets = isset($_SESSION['dneko_form_tickets']) && is_array($_SESSION['dneko_form_tickets'])
    ? $_SESSION['dneko_form_tickets']
    : [];
$now = time();

foreach ($tickets as $stored_ticket => $stored_payload) {
    $stored_at = is_array($stored_payload) && isset($stored_payload['created_at'])
        ? (int) $stored_payload['created_at']
        : 0;
    if ($stored_at <= 0 || ($now - $stored_at) > 600) {
        unset($tickets[$stored_ticket]);
    }
}

$success = preg_match('/\A[a-f0-9]{48}\z/', $ticket) === 1 && isset($tickets[$ticket])
    ? $tickets[$ticket]
    : null;
$success_source = is_array($success) && isset($success['source']) ? (string)$success['source'] : '';
$success_created_at = is_array($success) && isset($success['created_at']) ? (int)$success['created_at'] : 0;
$success_age = $now - $success_created_at;
$may_show_thanks = in_array($success_source, ['contact', 'marutto_contact'], true)
    && $success_created_at > 0
    && $success_age >= 0
    && $success_age <= 600;

if (!$may_show_thanks) {
    $_SESSION['dneko_form_tickets'] = $tickets;
    session_write_close();
    header('Location: /contact.php', true, 303);
    exit;
}

$should_track_conversion = empty($success['tracked']);
$tickets[$ticket]['tracked'] = true;
$_SESSION['dneko_form_tickets'] = $tickets;
session_write_close();

$page_title = 'お問い合わせ完了';
$page_title_eng = 'Thanks';
$page_seo_title = 'お問い合わせありがとうございます';
$page_description = 'デザネコへのお問い合わせを受け付けました。内容を確認のうえ、担当者よりご連絡いたします。';
$page_noindex = true;
$page_title_icon = 'fa-solid fa-circle-check';
$hide_footer_contact = true;
$page_script = '';

if ($should_track_conversion) {
    $event_label = $success_source === 'marutto_contact'
        ? 'marutto_contact_form'
        : 'contact_form';
    $page_script = '<script>window.addEventListener("load",function(){if(typeof gtag==="function"){gtag("event","form_submit",{event_category:"contact",event_label:'
        . json_encode($event_label, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES)
        . ',form_destination:"thanks.php"});}},{once:true});</script>';
}
?>
<?php include_once './header.php'; ?>
<?php include_once './page_title.php'; ?>

<!-- お問い合わせ完了 thanks.php -->
<div class="overflow">
    <section>
        <div class="bg_base">
            <div class="single">
                <div class="sbox">
                    <div class="mbox bg_white radius shadow_box tcenter border bc_sub">
                        <i class="fa-solid fa-circle-check fs_65 green_color" aria-hidden="true"></i>
                        <div class="space_1"></div>
                        <h2 class="line_height_14">
                            <span class="eng base_color fs_40">Thank You!</span><br>
                            <span class="bold fs_32 fs_sp24">お問い合わせを<br class="sponly">受け付けました</span>
                        </h2>
                        <div class="space_2 space_sp1"></div>
                        <p class="line_height_18">
                            ご入力いただいたメールアドレスへ、<br class="pconly">
                            自動返信メールをお送りしました。<br>
                            内容を確認のうえ、通常3営業日以内にご連絡いたします。
                        </p>
                        <div class="space_2 space_sp1"></div>
                        <div class="bg_base12 radius mbox">
                            <p class="b_m0 line_height_18">
                                自動返信メールが届かない場合は、迷惑メールフォルダをご確認ください。<br>
                                3営業日を過ぎても返信がない場合は、お手数ですが再度お問い合わせください。
                            </p>
                        </div>
                        <div class="space_3 space_sp2"></div>
                        <div class="btn_mini base_color radius center fs_18">
                            <a href="./"><i class="fa-solid fa-house" aria-hidden="true"></i> TOPページへ戻る</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!-- お問い合わせ完了 thanks.php -->

<?php include_once './footer.php'; ?>
