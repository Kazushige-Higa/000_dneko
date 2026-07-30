<?php
$page_title = '沖縄のご家庭に、デジタルのネコの手｜月額2,500円〜のデジタル担当サービス｜デザネコ';
$page_title_exact = true;
$page_title_eng = 'Digital Neko no Te';
$page_description = '沖縄のご家庭向け・月額聞き放題のデジタルサポート。スマホ、パソコン、Wi-Fi、詐欺対策、AI活用まで。解約金0円、追加請求なし。沖縄で20年・1,000件の実績。';
$page_og_image = 'https://d-neko.com/images/service-digital/ogp-digital-neko.jpg';
$page_style = '<link href="css/service-digital.css?v=' . filemtime(__DIR__ . '/css/service-digital.css') . '" rel="stylesheet">';
$page_script = '';

$digital_services = [
    ['icon' => 'fa-mobile-screen-button', 'title' => 'スマホ', 'text' => '初期設定・データ移行、LINE・PayPayの使い方、通知の整理'],
    ['icon' => 'fa-laptop', 'title' => 'パソコン', 'text' => '初期設定、動作が遅い相談、プリンタ接続、バックアップ'],
    ['icon' => 'fa-shield-halved', 'title' => 'セキュリティ', 'text' => '詐欺メール・偽警告の判定、ウイルス対策、パスワード整理'],
    ['icon' => 'fa-wifi', 'title' => 'ネット環境', 'text' => 'Wi-Fiが遅い・つながらない相談、ルーター買い替え相談'],
    ['icon' => 'fa-images', 'title' => '写真・思い出', 'text' => '写真の整理、アルバム化、動画の保存、ご家族との共有'],
    ['icon' => 'fa-robot', 'title' => 'AI活用', 'text' => 'ChatGPTなどAIの始め方、日常での便利な使い方レッスン'],
    ['icon' => 'fa-yen-sign', 'title' => '節約相談', 'text' => 'スマホ料金・ネット回線を、販売ノルマなしで中立に見直し'],
    ['icon' => 'fa-people-roof', 'title' => '家族との連絡', 'text' => 'ビデオ通話、写真共有、県外のご家族とのつながり方'],
];

$digital_faqs = [
    ['機械が本当に苦手ですが大丈夫？', 'そういう方のためのサービスです。LINEが使えれば十分。LINEの設定からお手伝いすることもできます。'],
    ['質問の回数に制限はありますか？', 'ありません。1日に何度でもどうぞ。'],
    ['家族も使えますか？', 'スタンダード以上は同居のご家族2名まで追加料金なしで使えます。'],
    ['解約したいときは？', 'LINEで「やめます」と一言で完了。解約金は0円、引き止めもしません。'],
    ['パソコンやスマホの購入もお願いできますか？', '販売は行いませんが、「あなたに合う機種と買う場所」を中立の立場でアドバイスし、設定はこちらで行います。'],
    ['対応エリアは？', 'LINE・リモートは沖縄全域（離島OK）。訪問は宜野湾・那覇・浦添・北谷ほか、詳しくは無料相談時にご確認ください。'],
    ['支払い方法は？', '現在準備中です。ご利用可能なお支払い方法は無料相談時にご案内します。'],
    ['高齢の親のために、県外に住む子どもが契約できますか？', 'はい、可能です。ご契約者と実際の利用者が別でも対応します。「実家のデジタル担当を頼みたい」というご相談も歓迎です。'],
];
?>
<?php include_once './header.php'; ?>

<main class="digital_neko_page">
    <section class="digital_neko_hero">
        <div class="digital_neko_hero_photo" aria-hidden="true"></div>
        <div class="digital_neko_inner digital_neko_hero_inner">
            <div class="digital_neko_hero_copy">
                <p class="digital_neko_kicker"><i class="fa-solid fa-paw" aria-hidden="true"></i> 沖縄のご家庭のデジタルサポート</p>
                <h1>沖縄のご家庭に、<br><span>デジタルのネコの手。</span></h1>
                <p class="digital_neko_hero_lead">スマホ、パソコン、Wi-Fi、LINE、AIまで。<br>「誰に聞けばいいか分からない」を、月額聞き放題でぜんぶ引き受ける<br class="digital_neko_pc"><strong>おうち専属のデジタル担当サービス</strong>です。</p>
                <div class="digital_neko_price_ribbon"><small>月額</small><strong>2,500</strong><small>円〜<br>聞き放題！</small></div>
                <ul class="digital_neko_badges" aria-label="サービスの安心ポイント">
                    <li><i class="fa-solid fa-paw" aria-hidden="true"></i><span>沖縄で20年<br><strong>1,000件の実績</strong></span></li>
                    <li><i class="fa-solid fa-heart" aria-hidden="true"></i><span>解約金0円<br><strong>いつでもやめられる</strong></span></li>
                    <li><i class="fa-solid fa-shield-halved" aria-hidden="true"></i><span>追加請求なし<br><strong>月額のみ</strong></span></li>
                </ul>
                <a class="digital_neko_cta digital_neko_cta_hero" href="<?php echo htmlspecialchars($line, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" onclick="gtag('event','line_click',{'event_category':'service_digital','event_label':'hero'})">
                    <i class="fa-brands fa-line" aria-hidden="true"></i>
                    <span><strong>まずは無料相談する</strong><small>LINEで質問OK</small></span>
                </a>
                <p class="digital_neko_phone"><i class="fa-solid fa-phone" aria-hidden="true"></i> 電話でお問い合わせ：<a href="tel:<?php echo preg_replace('/[^0-9]/', '', $telNo); ?>"><?php echo htmlspecialchars($telNo, ENT_QUOTES, 'UTF-8'); ?></a></p>
            </div>
            <div class="digital_neko_hero_characters" aria-hidden="true">
                <img class="digital_neko_hero_kururu" src="<?php echo $img; ?>/ai-consulting/kururu-laptop.webp" alt="">
                <img class="digital_neko_hero_moja" src="<?php echo $img; ?>/ai-consulting/moja-laptop.webp" alt="">
            </div>
        </div>
    </section>

    <section class="digital_neko_section digital_neko_worries">
        <div class="digital_neko_inner digital_neko_narrow">
            <div class="digital_neko_heading">
                <span>01</span>
                <p>PROBLEM</p>
                <h2>こんな“困った”、ありませんか？</h2>
            </div>
            <ul class="digital_neko_check_list">
                <li>スマホの通知が怖い。「これ押していいの？」がいつも不安</li>
                <li>パソコンが急に遅くなった。誰に聞けばいいか分からない</li>
                <li>詐欺メール・偽警告が本物かどうか判断できない</li>
                <li>県外の子どもに毎回電話で聞くのが申し訳ない</li>
                <li>携帯ショップは待ち時間が長く、契約の話ばかりされる</li>
                <li>「サポートに電話したら別のものを勧められた」経験がある</li>
            </ul>
            <blockquote class="digital_neko_bridge">
                <img src="<?php echo $img; ?>/ai-consulting/kururu-wave.webp" alt="" loading="lazy">
                <p>その「ちょっと聞きたい」に毎回3,000円、5,000円払うのはもったいない。<br>だから、<strong>聞き放題の定額</strong>にしました。</p>
                <img src="<?php echo $img; ?>/ai-consulting/moja-wave.webp" alt="" loading="lazy">
            </blockquote>
            <div class="digital_neko_center">
                <a class="digital_neko_cta" href="<?php echo htmlspecialchars($line, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-line" aria-hidden="true"></i><span><strong>無料相談する</strong><small>相談だけでも大歓迎です</small></span></a>
            </div>
        </div>
    </section>

    <section class="digital_neko_section digital_neko_about">
        <div class="digital_neko_inner">
            <div class="digital_neko_heading">
                <span>02</span>
                <p>ABOUT</p>
                <h2>デジタルの<span class="digital_neko_orange">ネコの手</span> とは</h2>
            </div>
            <p class="digital_neko_intro">デジタルのネコの手は、沖縄のデザイン会社<strong>デザネコ</strong>が運営する、ご家庭向けの<strong>月額定額デジタルサポート</strong>です。<br>機械が苦手でも大丈夫。専属担当「ガーヒー」と相棒のもじゃねこが、<strong>あなたの家の「デジタル担当」</strong>になります。</p>
            <div class="digital_neko_feature_grid">
                <article><i class="fa-brands fa-line" aria-hidden="true"></i><h3>定額聞き放題</h3><p>LINEで何度でも質問OK。写真を送るだけで解決します。</p></article>
                <article><i class="fa-solid fa-user-check" aria-hidden="true"></i><h3>担当者が変わらない</h3><p>いつも同じ担当が対応。ご家庭の状況を把握しています。</p></article>
                <article><i class="fa-solid fa-heart" aria-hidden="true"></i><h3>中立の立場</h3><p>機器は売りません。売るのは「安心」だけです。</p></article>
            </div>
        </div>
    </section>

    <section class="digital_neko_section digital_neko_why">
        <div class="digital_neko_inner digital_neko_narrow">
            <div class="digital_neko_heading">
                <span>03</span>
                <p>DIGITAL 119</p>
                <h2>困った時の「デジタル119番」、<br>それが月額聞き放題。</h2>
            </div>
            <div class="digital_neko_story">
                <p>「これくらいで呼ぶのは悪いかな」——そう思ってスマホを閉じたことが、たぶん一度や二度ではないはずです。</p>
                <p>呼べば5,000円。出張なら1万円。実際に困っている頻度から言えば、月に何度かは呼びたい場面がある。でも、その都度払いを積み上げると家計にひびく。だから我慢する。呼ばない。</p>
                <p>しばらくすると、我慢が習慣になります。詐欺メールが来ても閉じる。パソコンが遅くても使い続ける。呼び控えは、実は静かに損失を積んでいます。</p>
                <p class="digital_neko_story_emphasis">その仕組みを変えるのに、たいそうな発明はいりませんでした。<br><strong>呼ぶ／呼ばないを、月額にするだけでよかった。</strong></p>
                <p>月2,500円払っていれば、「これくらいで呼ぶのは悪いかな」がなくなる。写真を撮って、LINEで送るだけ。答えはたいてい当日中に返ります。呼び控えが習慣化するより先に、相談する習慣がつく。</p>
                <p>沖縄のご家庭に、これまでこの仕組みがなかった。それが不思議だと、20年やってきて、ずっと思っています。</p>
            </div>
        </div>
    </section>

    <section id="digital_neko_price" class="digital_neko_section digital_neko_price">
        <div class="digital_neko_inner">
            <div class="digital_neko_heading">
                <span>04</span>
                <p>PRICE</p>
                <h2>あなたの「デジタル119番」は、いくら？</h2>
            </div>
            <div class="digital_neko_price_grid">
                <article class="digital_neko_plan digital_neko_plan_light">
                    <div class="digital_neko_plan_paws"><i class="fa-solid fa-paw"></i></div>
                    <h3>ネコの手ライト</h3>
                    <p class="digital_neko_monthly">月額 <strong>2,500</strong>円 <small>（税別）</small></p>
                    <p class="digital_neko_target">スマホ or タブレット 1台</p>
                    <ul><li>LINEで質問し放題</li><li>回答は原則当日中</li><li>訪問・リモートは会員価格</li></ul>
                    <a href="<?php echo htmlspecialchars($line, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">このプランで無料相談する</a>
                </article>
                <article class="digital_neko_plan digital_neko_plan_standard">
                    <p class="digital_neko_recommend">いちばん人気・おすすめ</p>
                    <div class="digital_neko_plan_paws"><i class="fa-solid fa-paw"></i><i class="fa-solid fa-paw"></i></div>
                    <h3>ネコの手スタンダード</h3>
                    <p class="digital_neko_monthly">月額 <strong>4,000</strong>円 <small>（税別）</small></p>
                    <p class="digital_neko_target">2台まで／ご家族2名OK</p>
                    <ul><li>ライトの内容ぜんぶ</li><li>月1回のリモートサポート</li><li>半年に1回のデジタル健康診断</li><li>ご家族2人まで一緒に使える</li></ul>
                    <a href="<?php echo htmlspecialchars($line, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">このプランで無料相談する</a>
                </article>
                <article class="digital_neko_plan digital_neko_plan_premium">
                    <div class="digital_neko_plan_paws"><i class="fa-solid fa-paw"></i><i class="fa-solid fa-paw"></i><i class="fa-solid fa-paw"></i></div>
                    <h3>ネコの手プレミアム</h3>
                    <p class="digital_neko_monthly">月額 <strong>5,000</strong>円 <small>（税別）</small></p>
                    <p class="digital_neko_target">4台まで／ご家庭まるごと</p>
                    <ul><li>スタンダードの内容ぜんぶ</li><li>訪問サポート付き（対象エリア）</li><li>機種変更・買い替えの同行相談OK</li></ul>
                    <a href="<?php echo htmlspecialchars($line, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener">このプランで無料相談する</a>
                </article>
            </div>
            <p class="digital_neko_notes">※料金はすべて税別です。別途消費税がかかります。<br>※訪問対応エリア：宜野湾・那覇・浦添・北谷ほか（その他の地域は要相談）<br>※初期費用とお支払い方法は無料相談時にご案内します。</p>
            <div class="digital_neko_promises">
                <h3>デジタルのネコの手 <strong>3つの約束</strong></h3>
                <div>
                    <article><span>01</span><h4>契約書は1枚だけ</h4><p>分かりにくい規約で縛りません。読めば5分で理解できる契約書だけ。</p></article>
                    <article><span>02</span><h4>解約金・違約金は0円</h4><p>LINEで「やめます」と一言で完了。1ヶ月単位でいつでもやめられます。</p></article>
                    <article><span>03</span><h4>高額な機器を売りつけません</h4><p>提案は必ず「理由」とセット。中立の立場でアドバイスします。</p></article>
                </div>
            </div>
        </div>
    </section>

    <section class="digital_neko_section digital_neko_support">
        <div class="digital_neko_inner">
            <div class="digital_neko_heading">
                <span>05</span>
                <p>SUPPORT</p>
                <h2>こんなこと、全部お手伝いします</h2>
            </div>
            <div class="digital_neko_service_grid">
                <?php foreach ($digital_services as $service): ?>
                <article>
                    <i class="fa-solid <?php echo htmlspecialchars($service['icon'], ENT_QUOTES, 'UTF-8'); ?>" aria-hidden="true"></i>
                    <div><h3><?php echo htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8'); ?></h3><p><?php echo htmlspecialchars($service['text'], ENT_QUOTES, 'UTF-8'); ?></p></div>
                </article>
                <?php endforeach; ?>
            </div>
            <div class="digital_neko_center">
                <a class="digital_neko_cta" href="<?php echo htmlspecialchars($line, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-line" aria-hidden="true"></i><span><strong>無料相談する</strong><small>どんな小さなことでもOK</small></span></a>
            </div>
        </div>
    </section>

    <section class="digital_neko_section digital_neko_reasons">
        <div class="digital_neko_inner">
            <div class="digital_neko_heading">
                <span>06</span>
                <p>REASON</p>
                <h2>デザネコの「ネコの手」が選ばれる理由</h2>
            </div>
            <div class="digital_neko_reason_grid">
                <article><i class="fa-solid fa-award"></i><span>01</span><h3>沖縄で20年、<br>1,000件の支援実績</h3><p>Web、写真、動画、システムまで。20年間培ったプロの目で、ご家庭のサポートもお引き受けします。</p></article>
                <article><i class="fa-solid fa-user"></i><span>02</span><h3>「担当者」が<br>変わらない</h3><p>毎回一から説明する必要なし。ご家庭のスマホやパソコンの状況を把握した担当が対応します。</p></article>
                <article><i class="fa-solid fa-heart"></i><span>03</span><h3>うちなーんちゅの<br>ペースで</h3><p>専門用語を使わず、方言まじりでもOK。分かるまで何度でも同じ質問をしてください。</p></article>
            </div>
        </div>
    </section>

    <section class="digital_neko_section digital_neko_flow">
        <div class="digital_neko_inner">
            <div class="digital_neko_heading">
                <span>07</span>
                <p>FLOW</p>
                <h2>ご利用の流れ</h2>
            </div>
            <ol class="digital_neko_flow_list">
                <li><span>01</span><i class="fa-brands fa-line"></i><h3>無料相談</h3><p>LINEまたは電話で「困ってる」を送るだけ。30秒で完了します。</p></li>
                <li><span>02</span><i class="fa-regular fa-clipboard"></i><h3>プランのご案内</h3><p>状況を聞き、<strong>いちばん安いプラン</strong>から提案します。</p></li>
                <li><span>03</span><i class="fa-solid fa-laptop-medical"></i><h3>デジタル健康診断</h3><p>スマホ・PCの状態を一緒にチェックします。（スタンダード以上）</p></li>
                <li><span>04</span><i class="fa-solid fa-comments"></i><h3>あとは聞き放題</h3><p>困ったらいつでもLINE。写真を撮って送るだけでOKです。</p></li>
            </ol>
        </div>
    </section>

    <section class="digital_neko_section digital_neko_voice">
        <div class="digital_neko_inner">
            <div class="digital_neko_heading">
                <span>08</span>
                <p>VOICE</p>
                <h2>お客様の声</h2>
            </div>
            <p class="digital_neko_sample_note">※掲載内容はサービス利用イメージです。取材後、実際のお声へ差し替え予定です。</p>
            <div class="digital_neko_voice_grid">
                <article><div class="digital_neko_avatar">70<span>代</span></div><p class="digital_neko_voice_meta">70代女性・宜野湾市</p><h3>「孫とのビデオ通話が<br>できるようになった」</h3><p>ビデオ通話で毎週顔を見られるようになりました。方言でゆっくり教えてくれて助かりました。</p></article>
                <article><div class="digital_neko_avatar">50<span>代</span></div><p class="digital_neko_voice_meta">50代男性・那覇市</p><h3>「偽警告に課金する寸前で<br>止めてもらった」</h3><p>LINEで画面の写真を送ったら、すぐに「これは詐欺です」と返信が来て安心できました。</p></article>
                <article><div class="digital_neko_avatar">60<span>代</span></div><p class="digital_neko_voice_meta">60代女性・浦添市</p><h3>「携帯代が月3,000円<br>安くなった」</h3><p>余計なオプションを外せて、ネコの手代金より節約額のほうが大きくなりました。</p></article>
            </div>
        </div>
    </section>

    <section class="digital_neko_section digital_neko_profile">
        <div class="digital_neko_inner">
            <div class="digital_neko_heading">
                <span>09</span>
                <p>MESSAGE</p>
                <h2>あなたの家の「デジタル担当」、<br><span class="digital_neko_orange">ガーヒー</span>です。</h2>
            </div>
            <div class="digital_neko_profile_card">
                <div class="digital_neko_profile_visual">
                    <img class="digital_neko_profile_photo" src="<?php echo $img; ?>/profile.jpg" alt="デザネコ代表 比嘉一茂（ガーヒー）">
                    <img class="digital_neko_profile_cat" src="<?php echo $img; ?>/ai-consulting/moja-wave.webp" alt="" loading="lazy">
                </div>
                <div class="digital_neko_profile_text">
                    <p>比嘉一茂と申します。デザネコの代表で、みなさんからは「ガーヒー」と呼ばれています。</p>
                    <p>20年、この仕事をしてきて、企業のホームページを作り、写真を撮り、システムを組んできました。1,000件を超えたところで数えるのをやめました。</p>
                    <p>夜、母から「スマホに赤い警告が出ている。押して大丈夫？」と電話がかかってきます。写真を見て「詐欺だから閉じて」と返す。5分で終わります。こういう電話が、たぶん沖縄中の家で鳴っています。</p>
                    <p class="digital_neko_profile_emphasis">企業には「Web担当」がいる。ご家庭にはいない。<br>だから、私が担当になります。あなたの家の。</p>
                    <p>赤い警告が出た夜、写真を送る先が一つ増える。それだけでも、たぶん意味はあると思っています。</p>
                    <p class="digital_neko_signature">デザネコ代表　<strong>比嘉一茂（ガーヒー）</strong></p>
                </div>
            </div>
        </div>
    </section>

    <section class="digital_neko_section digital_neko_faq">
        <div class="digital_neko_inner digital_neko_narrow">
            <div class="digital_neko_heading">
                <span>10</span>
                <p>FAQ</p>
                <h2>よくある質問</h2>
            </div>
            <div class="digital_neko_faq_list">
                <?php foreach ($digital_faqs as $index => $faq): ?>
                <details<?php echo $index === 0 ? ' open' : ''; ?>>
                    <summary><span>Q</span><?php echo htmlspecialchars($faq[0], ENT_QUOTES, 'UTF-8'); ?></summary>
                    <p><span>A</span><?php echo htmlspecialchars($faq[1], ENT_QUOTES, 'UTF-8'); ?></p>
                </details>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <section class="digital_neko_closing">
        <div class="digital_neko_inner">
            <img src="<?php echo $img; ?>/ai-consulting/kururu-wave.webp" alt="" loading="lazy">
            <div>
                <p>「こんなこと聞いていいのかな？」</p>
                <h2>——その質問こそ、<br class="digital_neko_sp">お待ちしています。</h2>
                <a class="digital_neko_cta digital_neko_cta_closing" href="<?php echo htmlspecialchars($line, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener" onclick="gtag('event','line_click',{'event_category':'service_digital','event_label':'closing'})"><i class="fa-brands fa-line" aria-hidden="true"></i><span><strong>LINEで無料相談する</strong><small>30秒で友だち追加</small></span></a>
                <p class="digital_neko_closing_sub"><a href="tel:<?php echo preg_replace('/[^0-9]/', '', $telNo); ?>"><i class="fa-solid fa-phone"></i> <?php echo htmlspecialchars($telNo, ENT_QUOTES, 'UTF-8'); ?></a><a href="contact.php"><i class="fa-solid fa-envelope"></i> メールフォーム</a></p>
                <small>営業電話は一切しません。ご相談だけでも大歓迎です。</small>
            </div>
            <img src="<?php echo $img; ?>/ai-consulting/moja-wave.webp" alt="" loading="lazy">
        </div>
    </section>

    <section class="digital_neko_company">
        <div class="digital_neko_inner digital_neko_company_inner">
            <div>
                <img src="<?php echo $img; ?>/logo.png" alt="デザネコ" loading="lazy">
                <p>運営：デザネコ（d-neko.com）<br>代表：比嘉一茂（ガーヒー）<br>所在地：<?php echo htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?><br>電話：<?php echo htmlspecialchars($telNo, ENT_QUOTES, 'UTF-8'); ?><br>メール：<?php echo htmlspecialchars($mail, ENT_QUOTES, 'UTF-8'); ?></p>
            </div>
            <nav aria-label="デジタルのネコの手 フッターナビ">
                <a href="./">ホーム</a>
                <a href="service_blog.php">ホームページ制作</a>
                <a href="ai-consulting.php">AIコンサル</a>
                <a href="service_digital.php" aria-current="page">デジタルのネコの手</a>
                <a href="contact.php">お問い合わせ</a>
                <a href="privacypolicy.php">プライバシーポリシー</a>
                <a href="law.php">特定商取引法に基づく表記</a>
            </nav>
        </div>
        <p class="digital_neko_tax_note">※本ページの表示価格はすべて税別です。別途消費税がかかります。<br>※ヒーロー画像は生成イメージ、お客様の声は取材前の利用イメージです。</p>
    </section>

    <a class="digital_neko_sticky_cta" href="<?php echo htmlspecialchars($line, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-line"></i> 無料相談する</a>
</main>

<?php include_once './footer.php'; ?>
