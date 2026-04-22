<?php
$page_title = "プライバシーポリシー";
$page_title_eng = "Privacy policy";
$page_description = "";
$page_style = "";
$page_script = '';
?>
<?php include_once './header.php'; ?>
<?php include_once './page_title.php'; ?>

<!-- プライバシーポリシー 
 privacypolicy.php -->
<div class='overflow'>

    <section>
        <div>
            <div class="single">
                <div class="mbox bg_white radius">
                    <div class="sbox">
                        <h4 class="fs_18 fs_sp14 base_color flex a_center b_m10 border_bottom">
                            <span class="r_m5"><img width="50px" src="<?php echo $img; ?>/favicon.png"></span>
                            <span class="bold font_kiwi">個人情報保護方針・プライバシーポリシーについて</span>
                        </h4>

                        <p class="b_m10"><?php echo $company; ?>（以下「<?php echo $abbreviation; ?>」といいます）は、以下のとおり個人情報保護方針を定め、個人情報保護の仕組みを構築し、全従業員に個人情報保護の重要性の認識と取組みを徹底させることにより、個人情報の保護を推進致します。</p>
                        <h5 class="border_bottom bold"><b class="base_color"><i class="fas fa-minus"></i></b> 個人情報の管理</h5>
                        <p class="b_m10"><?php echo $abbreviation; ?>は、お客さまの個人情報を正確かつ最新の状態に保ち、個人情報への不正アクセス・紛失・破損・改ざん・漏洩などを防止するため、セキュリティシステムの維持・管理体制の整備・社員教育の徹底等の必要な措置を講じ、安全対策を実施し個人情報の厳重な管理を行ないます。</p>
                        <h5 class="border_bottom bold"><b class="base_color"><i class="fas fa-minus"></i></b> 個人情報の利用目的</h5>
                        <p class="b_m10">お客さまからお預かりした個人情報は、<?php echo $abbreviation; ?>からのご連絡や業務のご案内やご質問に対する回答として、電子メールや資料のご送付に利用いたします。</p>
                        <h5 class="border_bottom bold"><b class="base_color"><i class="fas fa-minus"></i></b> 個人情報の第三者への開示・提供の禁止</h5>
                        <p class="b-m10"><?php echo $abbreviation; ?>は、お客さまよりお預かりした個人情報を適切に管理し、次のいずれかに該当する場合を除き、個人情報を第三者に開示いたしません。</p>
                        <ul class="list_disc b_m10">
                            <li>お客さまの同意がある場合</li>
                            <li>お客さまが希望されるサービスを行なうために<?php echo $abbreviation; ?>が業務を委託する業者に対して開示する場合</li>
                            <li>法令に基づき開示することが必要である場合</li>
                        </ul>
                        <h5 class="border_bottom bold"><b class="base_color"><i class="fas fa-minus"></i></b> 個人情報の安全対策</h5>
                        <p class="b_m10"><?php echo $abbreviation; ?>は、個人情報の正確性及び安全性確保のために、セキュリティに万全の対策を講じています。</p>
                        <h5 class="border_bottom bold"><b class="base_color"><i class="fas fa-minus"></i></b> ご本人の照会</h5>
                        <p class="b_m10">お客さまがご本人の個人情報の照会・修正・削除などをご希望される場合には、ご本人であることを確認の上、対応させていただきます。</p>
                        <h5 class="border_bottom bold"><b class="base_color"><i class="fas fa-minus"></i></b> 法令、規範の遵守と見直し</h5>
                        <p class="b_m10"><?php echo $abbreviation; ?>は、保有する個人情報に関して適用される日本の法令、その他規範を遵守するとともに、本ポリシーの内容を適宜見直し、その改善に努めます。</p>
                        <h5 class="border_bottom bold"><b class="base_color"><i class="fas fa-minus"></i></b> お問い合せ</h5>
                        <p><?php echo $abbreviation; ?>の個人情報の取扱に関するお問い合せは下記までご連絡ください。</p>

                        <table class="tbl fs_size_s">
                            <tbody>
                                <tr>
                                    <th width="30%">名称</th>
                                    <td><?php echo $company; ?></td>
                                </tr>
                                <tr>
                                    <th>所在地</th>
                                    <td><?php echo $postalCode; ?> <br class="sponly"><?php echo $address; ?></td>
                                </tr>
                                <tr>
                                    <th>TEL</th>
                                    <td><?php echo $telNo; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<!-- プライバシーポリシー -->

<?php include_once './footer.php'; ?>