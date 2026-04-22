<?php
$page_title = "特定商取引法に基づく表記";
$page_title_eng = "Law";
$page_description = "";
$page_style = "";
$page_script = '';
?>
<?php include_once './header.php'; ?>
<?php include_once './page_title.php'; ?>

<!-- 特定商取引法に基づく表記
 law.php -->
<div class='overflow'>

    <section>
        <div class="bg-f2">
            <div class="single">
                <div class="mbox">
                    <h2 class="tcenter">
                        <span class="fs_20 fs_16 bold">特定商取引法に基づく表記</span>
                    </h2>
                    <table class="tbl_simple fs_size_s">
                        <tbody>
                            <tr>
                                <th>販売業社の名称</th>
                                <td>
                                    <?php echo $company; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>所在地</th>
                                <td>
                                    <?php echo $postalCode; ?> <?php echo $address; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>電話番号</th>
                                <td>
                                    <?php echo $telNo; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>メールアドレス</th>
                                <td>
                                    <?php echo $mail; ?>
                                </td>
                            </tr>
                            <tr>
                                <th>運営統括責任者</th>
                                <td>
                                    <?php echo $name; ?>
                                </td>
                            </tr>

                            <tr>
                                <th>追加手数料等の追加料金</th>
                                <td>
                                    ・商品の配送料（1,000円）
                                </td>
                            </tr>
                            <tr>
                                <th>交換および返品<br class="sponly">（返金ポリシー）</th>
                                <td>
                                    ＜お客様都合の返品・交換の場合＞<br>
                                    発送処理前の商品：キャンセルのご依頼をすることで注文のキャンセルが可能です。<br>
                                    発送処理後の商品：未開封の商品は、商品到着後 10日以内に（TEL:090-2964-1664）にご連絡いただいた場合に限り、お客様の送料負担にて返金又は同額以下の商品と交換いたします。開封後の商品は、返品・交換はお受けしておりません。<br>
                                    <br>
                                    ＜商品に不備がある場合＞<br>
                                    当社の送料負担にて返金又は新しい商品と交換いたします。まずはお電話（TEL:090-2964-1664）までご連絡ください。
                                </td>
                            </tr>
                            <tr>
                                <th>引渡時期</th>
                                <td>注文は 3 ～ 5 営業日以内に処理され、商品は 14 日以内に到着します。<br>
                                    注文後すぐにご利用いただけます。</td>
                            </tr>

                            <tr>
                                <th>受け付け可能な決済手段</th>
                                <td>クレジットカードまたは国内の銀行振込</td>
                            </tr>
                            <tr>
                                <th>決済期間</th>
                                <td>クレジットカード決済の場合はただちに処理されますが、国内の銀行振込の場合は注文から 3 日以内にお振り込みいただく必要があります。</td>
                            </tr>
                            <tr>
                                <th>費用について</th>
                                <td>8,900円〜 (各ページに記載の金額)</td>
                            </tr>
                            <tr>
                                <th>申込み期間の制限</th>
                                <td>ご利用から1週間以内にお願いいたします。</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </section>

</div>
<!-- 特定商取引法に基づく表記 -->

<?php include_once './footer.php'; ?>