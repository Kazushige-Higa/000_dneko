<?php
http_response_code(404);
$page_title = "404エラー";
$page_title_eng = "404";
$page_seo_title = "ページが見つかりません";
$page_description = "お探しのページは移動または削除された可能性があります。デザネコのトップページやサービス一覧から目的の情報をお探しください。";
$page_noindex = true;
$page_style = "";
$page_script = '';
?>
<?php include_once './header.php'; ?>
<?php include_once './page_title.php'; ?>

<div class="overflow">

    <section>
        <div class="single tcenter">
            <div class="mbox tcenter border bc_aaa radius">
                <h3 class='line_height_14 tcenter'>
                    <span class='eng base_color fs_30'>
                        404 NOT FOUND
                    </span>
                </h3>
                <div class='space_3 space_sp2'></div>
                <p>リクエストされたページが<br>
                    見つかりませんでした。</p>
                <div class='space_3 space_sp1'></div>
                <button class='btn_mini radius center fs_18'><a href='./'>TOPページへ戻る</a></button>
            </div>
        </div>
    </section>

</div>

<?php include_once './footer.php'; ?>
