<?php
$page_title = "よくあるご質問";
$page_title_eng = "FAQ";
$page_description ="";
$page_style = "";
$page_script = '';
?>
<?php include_once './header.php'; ?>
<?php include_once './page_title.php'; ?>

<!-- ・よくあるご質問
faq.php（カスタムフィールド対応版） -->
<div class='overflow'>

    <section>
        <div class="bg_white">
            <div class="single03">
                <div class="mbox bg_white bc_base radius">
                    <div class="tcenter b_m5">
                        <img width="80px" src='<?php echo $img; ?>/favicon.png' alt='イメージ画像' loading='lazy'>
                    </div>
                    <h2 class="line_height_14 tcenter">
                        <span class="eng base_color fs_40 act txt_split type_popup">Question
                        </span><br>
                        <span class="fs_40 fs_sp30 act blur font_kiwi">
                            よくあるご質問
                        </span>
                    </h2>
                    <div class='space_3 space_sp1'></div>

                    <div class="sbox act blur">
                        <?php
                        // ==========================================
                        //  microCMS「faq」APIからデータを取得
                        //  （オブジェクト形式 → 繰り返しフィールド「items」）
                        // ==========================================
                        $faq_data = microcms_get('/faq');

                        if ($faq_data && isset($faq_data->items) && is_array($faq_data->items) && count($faq_data->items) > 0):
                        ?>
                        <dl class='accordion'>
                            <?php foreach ($faq_data->items as $item): ?>
                            <dt class='open'><?php echo htmlspecialchars($item->question, ENT_QUOTES, 'UTF-8'); ?></dt>
                            <dd class='panel'>
                                <div class='inner'>
                                    <p><?php echo nl2br(htmlspecialchars($item->answer, ENT_QUOTES, 'UTF-8')); ?></p>
                                </div>
                            </dd>
                            <?php endforeach; ?>
                        </dl>
                        <?php else: ?>
                        <!-- API取得失敗 or データ0件時はハードコード版を表示 -->
                        <dl class='accordion'>
                            <dt class='open'>WordPressって何ですか？よくわからないのですが、大丈夫でしょうか？</dt>
                            <dd class='panel'>
                                <div class='inner'>
                                    <p>はい、大丈夫です！<br>
                                        WordPressはブログやブログを作るための仕組み（システム）です。<br>
                                        「デザネコ」では、サーバー契約やドメイン取得のサポートから、初期設定・使い方のレクチャーまで丁寧に対応しますので、初心者の方でも安心してスタートできます。</p>
                                </div>
                            </dd>
                            <dt class='open'>ブログを作るのは初めてです。パソコンもあまり得意ではないのですが、大丈夫ですか？</dt>
                            <dd class='panel'>
                                <div class='inner'>
                                    <p>もちろん大丈夫です！<br>
                                        専門的な操作や難しい設定は、こちらで代行いたします。ブログ記事の書き方や画像の入れ方など、基本的な使い方もわかりやすくサポートいたしますので、パソコンが苦手な方でも安心してご利用いただけます。</p>
                                </div>
                            </dd>
                            <dt class='open'>サーバーやドメインの取得がよくわかりません。代行してもらえますか？</dt>
                            <dd class='panel'>
                                <div class='inner'>
                                    <p>はい、取得代行や手続きも全てコミコミです。<br>
                                        お客様のご希望を伺いながら、最適なプランをご提案します。</p>
                                </div>
                            </dd>
                        </dl>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>
<!-- ・よくあるご質問
faq.php（カスタムフィールド対応版） -->

<?php include_once './footer.php'; ?>
