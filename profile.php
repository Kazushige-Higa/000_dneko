<?php
$page_title = "プロフィール";
$page_title_eng = "Profile";
$page_seo_title = "比嘉一茂プロフィール｜沖縄のWeb・デザイン制作者";
$page_description = "デザネコ代表・比嘉一茂（ガーヒー）のプロフィール。沖縄で1,000件以上の制作に携わってきた現場経験型Web制作者が、なぜ個人事業主に寄り添う仕事を選んだのか。その原点と、大切にしている約束をご紹介します。";
$page_style = <<<'CSS'
<style>
/* ストーリー */
.pf_story { position: relative; }
.pf_story_lead {
  font-size: 1.15em;
  line-height: 2;
}
.pf_story_q {
  display: inline-block;
  margin-bottom: .6em;
  padding: .35em 1.2em;
  border-radius: 999px;
  background: #f9b104;
  color: #fff;
  font-size: .95em;
  font-weight: 700;
  letter-spacing: .04em;
}
.pf_story_block + .pf_story_block { margin-top: 2.6em; }
.pf_story_block p { line-height: 2.05; }
.pf_story_block p + p { margin-top: 1.1em; }
/* 転機となったひとこと */
.pf_turning {
  position: relative;
  margin: 1.8em 0;
  padding: 1.6em 1.8em;
  border-left: 5px solid #f9b104;
  border-radius: 0 10px 10px 0;
  background: #fff8e6;
  font-size: 1.12em;
  font-weight: 700;
  line-height: 1.95;
}
/* お客様の声の引用 */
.pf_quote {
  position: relative;
  margin: 1.6em 0;
  padding: 2.2em 2em 1.8em;
  border: 1px solid rgba(249,177,4,.35);
  border-radius: 12px;
  background: #fff;
  box-shadow: 0 6px 18px rgba(80,58,28,.06);
}
.pf_quote::before {
  content: "\201C";
  position: absolute;
  top: -.1em;
  left: .35em;
  color: rgba(249,177,4,.35);
  font-family: Georgia, serif;
  font-size: 4.5em;
  line-height: 1;
}
.pf_quote p { position: relative; line-height: 2; }
.pf_quote p + p { margin-top: .9em; }
.pf_quote_by {
  display: block;
  margin-top: 1.2em;
  color: #7c7367;
  font-size: .92em;
  text-align: right;
}
/* 数字で見るガーヒー */
.pf_stats { list-style: none; margin: 0; padding: 0; }
.pf_stats li {
  padding: 1.8em 1em;
  border-radius: 14px;
  background: #fff;
  box-shadow: 0 4px 14px rgba(80,58,28,.07);
  text-align: center;
}
.pf_stats i { color: #f9b104; font-size: 1.9em; }
.pf_stats .pf_stats_label {
  display: block;
  margin: .7em 0 .2em;
  color: #6f6659;
  font-size: .92em;
  font-weight: 700;
}
.pf_stats .pf_stats_num {
  display: block;
  color: #333;
  font-size: 2.1em;
  font-weight: 700;
  line-height: 1.2;
}
.pf_stats .pf_stats_num small { font-size: .48em; margin-left: .2em; }
/* 3つの約束 */
.pf_promise { list-style: none; margin: 0; padding: 0; }
.pf_promise li {
  position: relative;
  padding: 2.4em 1.6em 1.8em;
  border: 1px solid rgba(249,177,4,.28);
  border-radius: 14px;
  background: #fff;
}
.pf_promise .pf_promise_no {
  position: absolute;
  top: -.85em;
  left: 50%;
  transform: translateX(-50%);
  display: grid;
  place-items: center;
  width: 2.6em;
  height: 2.6em;
  border-radius: 50%;
  background: #f9b104;
  color: #fff;
  font-size: .95em;
  font-weight: 700;
}
.pf_promise h4 {
  margin-bottom: .6em;
  color: #f0a000;
  font-size: 1.18em;
  font-weight: 700;
  text-align: center;
  line-height: 1.6;
}
.pf_promise p { line-height: 1.9; }
/* 対応できること */
.pf_skills { list-style: none; margin: 0; padding: 0; }
.pf_skills li {
  display: flex;
  align-items: flex-start;
  gap: .8em;
  padding: 1.1em 1.2em;
  border-radius: 10px;
  background: #fff;
  box-shadow: 0 3px 10px rgba(80,58,28,.05);
}
.pf_skills i {
  flex: 0 0 auto;
  margin-top: .15em;
  color: #f9b104;
  font-size: 1.15em;
}
.pf_skills b { display: block; margin-bottom: .15em; }
.pf_skills span { font-size: .93em; line-height: 1.75; }
/* 人柄 */
.pf_cats { list-style: none; margin: 0; padding: 0; }
.pf_cats li {
  padding: 1.6em 1.4em;
  border-radius: 14px;
  background: #fff;
  text-align: center;
}
.pf_cats img { width: min(140px, 60%); height: auto; }
.pf_cats b {
  display: block;
  margin: .6em 0 .3em;
  color: #f0a000;
  font-size: 1.1em;
}
.pf_cats p { font-size: .93em; line-height: 1.8; }
@media screen and (max-width: 500px) {
  .pf_story_lead { font-size: 1.05em; }
  .pf_turning { padding: 1.2em 1.2em; font-size: 1.02em; }
  .pf_quote { padding: 1.9em 1.2em 1.4em; }
  .pf_quote::before { font-size: 3.4em; }
  .pf_stats li { padding: 1.4em .8em; }
  .pf_stats .pf_stats_num { font-size: 1.75em; }
}
</style>
CSS;
$page_script = '';
?>
<?php include_once './header.php'; ?>
<?php include_once './page_title.php'; ?>

<!-- プロフィールprocile.php -->
<div class='overflow'>

    <section>
        <div class="bg_white">
            <div class='space_3 space_sp3'></div>
            <div class="single">
                <div class="mbox shadow radius bg_white">
                    <h2 class="line_height_14 tcenter">
                        <span class="eng base_color fs_40">
                            Profile
                        </span><br class="sponly">
                        <span class="fs_20 fs_sp20 font_kiwi">
                            プロフィール
                        </span>
                    </h2>
                    <div class='space_3 space_sp12'></div>

                    <div class="b_m5 tcenter width_sp5">
                        <img src='<?php echo $img; ?>/profile_sns.webp' alt='<?php echo $company; ?>のプロフィール画像' loading='lazy'>
                    </div>

                    <div class='space_3 space_sp1'></div>

                    <ul class="sns_btn a_center j_center">

                        <!-- // instagram -->
                        <li class="instagram">
                            <a href="<?php echo $instagram02; ?>" target="_blank" rel="nofollow">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17.9">
                                    <g>
                                        <path class="c" d="M9,1.6c2.4,0,2.7,0,3.6,.1,.9,0,1.3,.2,1.7,.3,.4,.2,.7,.4,1,.7s.5,.6,.7,1c.1,.3,.3,.8,.3,1.7s.1,1.2,.1,3.6,0,2.7-.1,3.6c0,.9-.2,1.3-.3,1.7-.2,.4-.4,.7-.7,1s-.6,.5-1,.7c-.3,.1-.8,.3-1.7,.3s-1.2,.1-3.6,.1-2.7,0-3.6-.1c-.9,0-1.3-.2-1.7-.3-.4-.2-.7-.4-1-.7s-.5-.6-.7-1c-.1-.4-.3-.9-.3-1.8s-.1-1.2-.1-3.6,0-2.7,.1-3.6c0-.9,.2-1.3,.3-1.7,.2-.4,.4-.7,.7-1s.6-.5,1-.7c.3-.1,.8-.3,1.7-.3h3.6m0-1.6c-2.4,0-2.7,0-3.7,.1-1,0-1.6,.2-2.2,.4-.6,.2-1.1,.5-1.6,1-.5,.5-.8,1-1,1.6-.2,.5-.4,1.2-.4,2.1,0,1-.1,1.3-.1,3.7s0,2.7,.1,3.7c0,1,.2,1.6,.4,2.2,.2,.6,.5,1.1,1,1.6,.5,.5,1,.8,1.6,1s1.2,.4,2.2,.4,1.3,.1,3.7,.1,2.7,0,3.7-.1c1,0,1.6-.2,2.2-.4,.6-.2,1.1-.5,1.6-1s.8-1,1-1.6,.4-1.2,.4-2.2,.1-1.3,.1-3.7,0-2.7-.1-3.7c0-1-.2-1.6-.4-2.2-.2-.6-.5-1.1-1-1.6-.5-.5-1-.8-1.6-1S13.7,0,12.7,0h-3.7Zm0,4.3c-2.6,0-4.6,2.1-4.6,4.6s2.1,4.6,4.6,4.6,4.6-2.1,4.6-4.6-2.1-4.6-4.6-4.6Zm0,7.6c-1.6,0-3-1.3-3-3,0-1.6,1.3-3,3-3,1.6,0,3,1.3,3,3-.1,1.6-1.4,3-3,3ZM13.7,3.1c-.6,0-1.1,.5-1.1,1.1s.5,1.1,1.1,1.1,1.1-.5,1.1-1.1-.5-1.1-1.1-1.1Z" />
                                    </g>
                                </svg>
                            </a>
                        </li>

                    </ul>

                    <div class='space_3 space_sp1'></div>

                    <h3 class="b_m10 mtext1 tcenter">
                        <span class="fs_30 fs_sp25 base_color tcenter font_kiwi">
                            多様な「デザイン」で<br class="sponly">「人と人とをつなげる」お手伝い。
                        </span>
                    </h3>

                    <div class="sbox b_m10">
                        <div class="mbox radius">
                            <p class="tjustify">
                                デザネコは、単純に「デザイン」と「ネコ」が好きなので名付けました。<br>
                                名刺1枚から、チラシやポスター、飲食店のメニューまで、撮影から取材・デザインまで幅広く対応しています。僕の手掛けた制作物が皆さんの幸せに少しでも貢献できれば光栄です。<br>
                                夢は「記念日を彩るギフト・ブランド」を作ること。個人ひとりひとりが自分の魅力「ブランド」を発信できる時代。これからも沖縄から世界へ発信できる環境をサポートしていけたらと考えています。
                            </p>
                        </div>

                        <div class='space_3 space_sp5'></div>

                        <!-- ガーヒーのストーリー -->
                        <h2 class="line_height_14 tcenter">
                            <span class="eng base_color fs_40">
                                My Story
                            </span><br class="sponly">
                            <span class="fs_20 fs_sp20 font_kiwi">
                                ガーヒーのストーリー
                            </span>
                        </h2>
                        <div class='space_3 space_sp2'></div>

                        <div class="mbox bg_f2 radius pf_story">
                            <div class="pf_story_block">
                                <span class="pf_story_q">なぜこの仕事を始めたのか？</span>
                                <p class="pf_story_lead tjustify">
                                    私自身も個人事業主として、「予算がない」「誰に頼めばいいかわからない」「制作会社の見積もりが高すぎる」という悩みを経験しました。
                                </p>
                            </div>

                            <div class="pf_story_block">
                                <p class="tjustify">
                                    デザインの仕事を始めた当初、大手制作会社で働いていましたが、分業制のため「お客様の顔が見えない」「本当に喜んでもらえているのか分からない」という違和感を感じていました。
                                </p>
                                <p class="tjustify">
                                    そんな時、友人の個人事業主から「ホームページを作りたいけど、予算がなくて困っている」と相談を受けたんです。
                                </p>
                            </div>

                            <p class="pf_turning tjustify">
                                「だったら、初期費用0円で作ろう。<br>
                                その代わり、月々のサポートで一緒に育てていこう」
                            </p>

                            <div class="pf_story_block">
                                <p class="tjustify">
                                    そう提案したところ、大変喜んでくれたことから始まりました。今では、こんな声もいただけるようになっています。
                                </p>
                            </div>

                            <blockquote class="pf_quote">
                                <p class="tjustify">
                                    ホームページとチラシを制作していただいてから、お問い合わせが毎年継続的に入るようになりました。
                                </p>
                                <p class="tjustify">
                                    以前は口コミ中心で教室周辺からのお問い合わせがほとんどでしたが、現在では少し離れた地域からもホームページをご覧になってご連絡をいただいています。
                                </p>
                                <p class="tjustify">
                                    昨年度は年間約60件、今年度も10月から現在までに45件のお問い合わせがあり、そのうち34名の方にご入会いただいています。
                                </p>
                                <p class="tjustify">
                                    教室の魅力が分かりやすく伝わるホームページとチラシのおかげで、毎年安定した集客につながっていると実感しています。
                                </p>
                                <cite class="pf_quote_by">― 音楽教室 様</cite>
                            </blockquote>

                            <div class="pf_story_block">
                                <p class="tjustify">
                                    この経験から、<b class="base_color">「個人事業主には、大手制作会社よりも寄り添ってくれるパートナーが必要なんだ」</b>と確信しました。
                                </p>
                                <p class="tjustify">
                                    今では「デザネコのガーヒーさんがいてくれて助かる」と言ってもらえることが、何よりの喜びです。
                                </p>
                            </div>
                        </div>

                        <div class='space_3 space_sp5'></div>

                        <!-- 数字で見るガーヒー -->
                        <h2 class="line_height_14 tcenter">
                            <span class="eng base_color fs_40">
                                Numbers
                            </span><br class="sponly">
                            <span class="fs_20 fs_sp20 font_kiwi">
                                数字で見るガーヒー
                            </span>
                        </h2>
                        <div class='space_3 space_sp2'></div>

                        <ul class="grid set4 sp2 gap1 pf_stats">
                            <li>
                                <i class="fas fa-chart-simple" aria-hidden="true"></i>
                                <span class="pf_stats_label">制作実績</span>
                                <span class="pf_stats_num">1,000<small>件以上</small></span>
                            </li>
                            <li>
                                <i class="fas fa-crown" aria-hidden="true"></i>
                                <span class="pf_stats_label">デザイン業界歴</span>
                                <span class="pf_stats_num">20<small>年</small></span>
                            </li>
                            <li>
                                <i class="fas fa-camera" aria-hidden="true"></i>
                                <span class="pf_stats_label">撮影・ライティング</span>
                                <span class="pf_stats_num">100<small>%</small></span>
                            </li>
                            <li>
                                <i class="fas fa-user" aria-hidden="true"></i>
                                <span class="pf_stats_label">担当者</span>
                                <span class="pf_stats_num">1<small>人で一貫</small></span>
                            </li>
                        </ul>

                        <div class='space_3 space_sp5'></div>

                        <!-- 大切にしている3つの約束 -->
                        <h2 class="line_height_14 tcenter">
                            <span class="eng base_color fs_40">
                                My Promise
                            </span><br class="sponly">
                            <span class="fs_20 fs_sp20 font_kiwi">
                                大切にしている3つの約束
                            </span>
                        </h2>
                        <div class='space_3 space_sp2'></div>

                        <ul class="grid set3 sp1 gap2 pf_promise">
                            <li>
                                <span class="pf_promise_no">1</span>
                                <h4>作って終わりにしない</h4>
                                <p class="tjustify">
                                    公開してからが本番です。アクセス数や問い合わせの動きを一緒に見ながら、必要な改善を続けていきます。
                                </p>
                            </li>
                            <li>
                                <span class="pf_promise_no">2</span>
                                <h4>専門用語を使わない</h4>
                                <p class="tjustify">
                                    パソコンが苦手でも大丈夫。分かりにくい言葉はできるだけ使わず、必要な確認だけを分かりやすくお伝えします。
                                </p>
                            </li>
                            <li>
                                <span class="pf_promise_no">3</span>
                                <h4>最初から最後まで同じ人が担当</h4>
                                <p class="tjustify">
                                    分業ではありません。取材・撮影・文章・デザイン・公開後の改善まで、私が責任を持って対応します。
                                </p>
                            </li>
                        </ul>

                        <div class='space_3 space_sp5'></div>

                        <!-- 対応できること -->
                        <h2 class="line_height_14 tcenter">
                            <span class="eng base_color fs_40">
                                Skills
                            </span><br class="sponly">
                            <span class="fs_20 fs_sp20 font_kiwi">
                                対応できること
                            </span>
                        </h2>
                        <div class='space_3 space_sp2'></div>

                        <ul class="grid set2 sp1 gap1 pf_skills">
                            <li>
                                <i class="fas fa-comments" aria-hidden="true"></i>
                                <div>
                                    <b>取材・ヒアリング</b>
                                    <span>お店の強みや想いを引き出し、伝わる形に整理します。</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-camera-retro" aria-hidden="true"></i>
                                <div>
                                    <b>撮影</b>
                                    <span>料理・商品・店内・人物まで。素材のご用意は不要です。</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-pen-nib" aria-hidden="true"></i>
                                <div>
                                    <b>ライティング</b>
                                    <span>キャッチコピーから本文まで、読みやすい文章を作成します。</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-palette" aria-hidden="true"></i>
                                <div>
                                    <b>グラフィックデザイン</b>
                                    <span>チラシ・名刺・ポスター・メニューなどの印刷物全般。</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-laptop-code" aria-hidden="true"></i>
                                <div>
                                    <b>Web制作・コーディング</b>
                                    <span>ホームページ、ブログ、スマホ対応まで一貫して対応。</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-chart-line" aria-hidden="true"></i>
                                <div>
                                    <b>アクセス解析・改善</b>
                                    <span>公開後の数字を見ながら、次の一手をご提案します。</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-robot" aria-hidden="true"></i>
                                <div>
                                    <b>AI活用サポート</b>
                                    <span>業務効率化やSNS運用の自動化など、AI活用のご相談。</span>
                                </div>
                            </li>
                            <li>
                                <i class="fas fa-video" aria-hidden="true"></i>
                                <div>
                                    <b>動画・音楽制作</b>
                                    <span>AIを活用したプロモーション動画やBGMの制作。</span>
                                </div>
                            </li>
                        </ul>

                        <div class='space_3 space_sp5'></div>

                        <h2 class="line_height_14 tcenter">
                            <span class="eng base_color fs_40">
                                Profile
                            </span><br class="sponly">
                            <span class="fs_20 fs_sp20 font_kiwi">
                                ガーヒーについて
                            </span>
                        </h2>
                        <div class='space_3 space_sp2'></div>


                        <div class="mbox bg_f2 radius">
                            <p>
                                10年以上、1000件以上のホームページ制作に携わってきました。<br>
                                取材・撮影・デザイン・コーディング・ライティング全て一貫して担当してきた現場経験型Web制作者です。
                            </p>
                            <p>
                                その中で感じたのは、多くのホームページが「作ったまま更新されていない」ということ。本当に大切なのは、ホームページを「作る」ことではなく「育てる」ことだと実感しました。<br>
                                その想いから、デザネコでは小さなお店のホームページ制作とブログ運用をサポートしています。
                            </p>
                        </div>

                        <div class='space_3 space_sp2'></div>

                        <h2 class="line_height_14 tcenter">
                            <span class="eng base_color fs_40">
                                Career History
                            </span><br class="sponly">
                            <span class="fs_20 fs_sp20 font_kiwi">
                                経歴・実績
                            </span>
                        </h2>
                        <div class='space_3 space_sp2'></div>

                        <dl class="dl_flow_dot">
                            <dt class="font_kiwi">1984年 沖縄県で生まれる</dt>
                            <dd>幼少期からものづくりや創作活動に興味を持ち、絵を描いたりすることが好きで、友人からデザイナーに向いているんじゃない？と言われたのが、この道に進むきっかけです。<br>
                                成長とともにクリエイティブな表現への関心が深まり、20歳から独学でデザインを学び始めました。</dd>
                            <dt class="font_kiwi">広告代理店でデザイナーとして勤務</dt>
                            <dd>デザイナーとしてのキャリアは、広告代理店での勤務から本格的にスタート。<br>
                                某大手スーパーやデパートのチラシ、広告印刷物のデザインを担当し、印刷物など出来上がったものを通じてお客さまの興味を引きつける表現を追求。<br>
                                限られたスペースの中で「伝えたい情報をわかりやすく、そして魅力的に伝える」ことの重要性を学び、質はもちろん、スピードも求められる現場では、実践を重ねる日々でした。</dd>
                            <dt class="font_kiwi">沖縄県内13店舗以上の飲食業界の専属デザイナーとして勤務</dt>
                            <dd>広告代理店での経験を経て、より自由なクリエイティブに挑戦するため、飲食業界の専属デザイナーとしての道を選びました。最大の理由は、「デザインだけでなく、撮影・編集・印刷・企画まですべての工程に携わりたい」という想いがあったからです。<br>
                                沖縄県内に13店舗以上を展開する飲食企業で、メニュー・ポスター・販促物などのデザインを一手に担当しました。料理の魅力を引き出す撮影や、店舗ごとの個性を活かしたデザインを通じて、より効果的な販促を目指しました。<br>
                                飲食業界ならではのスピード感や臨機応変な対応力が求められる環境の中で、**「売れるデザインとは何か」**を常に考え、実践を重ねてきました。この経験が、現在の幅広いクリエイティブ活動の基盤となっています。</dd>
                            <dt class="font_kiwi">沖縄県内のブログ制作会社に勤務</dt>
                            <dd>広告や飲食業界でのデザイン経験を積む中で、Web業界の急成長を肌で感じていました。特に、iPhoneの普及をはじめとするWeb市場の拡大を見て、「この流れに乗り遅れたらやばい」という危機感を抱き、ブログ制作の分野へと挑戦することを決意しました。<br>
                                今では沖縄県内でも最多級の制作実績を誇るブログ制作会社に入社し、Webデザインの技術やトレンドを学びながら、実践の中で経験を積んでいます。<br>
                                デザインだけでなく、構成やどうすればお客さまからのお問い合わせにつながるのか？などの導線を意識したブログ制作。お客さまの希望や目的に合わせた最適な提案を行っています。<br>
                                これまでに手掛けたブログは1,000件以上。紙媒体で培ったデザインスキルと、Webの知識を掛け合わせることで、より効果的なクリエイティブを提供できるようになりました。現在も、進化し続けるWeb業界の最前線で、新たな挑戦を続けています。
                            </dd>
                            <dt class="font_kiwi">AIを活用したクリエイティブな活動に力を入れています</dt>
                            <dd>近年、AI技術が急速に進化する中で、クリエイティブな分野にもその可能性が広がっていると感じています。僕は、この変革をチャンスと捉えていて、AIを活用したクリエイティブな活動に今、力を入れています。<br>

                                特に、AIを使った動画制作や音楽制作の技術発達はとても加速していて、これまでの手法では難しかったCGなどの新しい表現や、効率的な作業が可能になっています。<br>
                                AIを活用することで、制作時間の短縮や、クオリティの向上を実現し、より多くのお客さまに満足いただける作品を提供できるようになっています。<br>

                                また、AIを駆使したSNSなどのプロモーション活動にも力を入れています。<br>
                                ターゲットに合わせた最適な配信をすることで、より多くの人々にリーチできるよう努めていきたい。今後も、AIの進化に合わせて、さらに新しいクリエイティブを生み出し、お客さまに価値を届けていきたいと考えています。</dd>
                        </dl>
                        <div class='space_3 space_sp5'></div>

                        <!-- 相棒の看板猫 -->
                        <h2 class="line_height_14 tcenter">
                            <span class="eng base_color fs_40">
                                Our Cats
                            </span><br class="sponly">
                            <span class="fs_20 fs_sp20 font_kiwi">
                                相棒の看板猫たち
                            </span>
                        </h2>
                        <div class='space_2 space_sp2'></div>

                        <p class="tcenter">
                            デザネコには、いつも隣で見守ってくれる2匹の相棒がいます。<br class="pconly">
                            打ち合わせ中にひょっこり登場することも。
                        </p>
                        <div class='space_2 space_sp2'></div>

                        <ul class="grid set2 sp1 gap2 pf_cats">
                            <li>
                                <img src='<?php echo $img; ?>/sticker/49.webp' alt='看板猫「もじゃ」のイラスト' loading='lazy'>
                                <b>もじゃ</b>
                                <p class="tjustify">もじゃもじゃの毛が名前の由来。人懐っこくて、来客があるといちばんに顔を出す看板猫です。LINEスタンプやグッズにもなっています。</p>
                            </li>
                            <li>
                                <img src='<?php echo $img; ?>/sticker/01.webp' alt='看板猫「くるる」のイラスト' loading='lazy'>
                                <b>くるる</b>
                                <p class="tjustify">まんまるな瞳が特徴のマイペースな相棒。作業に行き詰まったときは、そっと膝に乗ってきて癒やしてくれます。</p>
                            </li>
                        </ul>

                        <div class='space_2 space_sp2'></div>

                        <div class="tcenter">
                            <button class='btn_normal radius center'><a href='moja-cat.php'>もじゃねこについて詳しく見る</a></button>
                        </div>

                        <div class='space_3 space_sp5'></div>

                        <!-- CTA -->
                        <div class="mbox bg_yellow radius tcenter">
                            <h3 class="fs_25 fs_sp20 bold font_kiwi b_m10">
                                「うちのホームページ、実際どうなの？」
                            </h3>
                            <p class="b_m20">
                                アクセス数・検索での見え方・改善ポイントを無料で診断します。<br class="pconly">
                                依頼内容が決まっていなくても大丈夫。まずはお気軽にご相談ください。
                            </p>
                            <button class='btn_normal radius center'><a href='contact.php'>まずは無料診断してみる</a></button>
                            <div class='space_1 space_sp1'></div>
                            <button class='btn_hologram radius center'><a href='./'>デザネコホームページはこちら</a></button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<!-- プロフィール -->

<?php include_once './footer.php'; ?>
