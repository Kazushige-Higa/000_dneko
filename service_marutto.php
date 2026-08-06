<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();
}
if (empty($_SESSION['marutto_form_token'])) {
  $_SESSION['marutto_form_token'] = bin2hex(random_bytes(32));
}
$marutto_form_token = $_SESSION['marutto_form_token'];
$page_title = '沖縄のHP制作×チラシ｜月々9,800円まるっとお任せ｜デザネコ';
$page_description = '沖縄のデザネコが、集客の「入口のチラシ」と「受け皿のホームページ」を月々9,800円のセットプランで提供。制作費0円・契約縛りなし・789社の実績。';
$page_og_image = 'https://d-neko.com/images/marutto-plan-ogp.jpg';
$page_canonical = 'https://d-neko.com/service_marutto.php';
$marutto_request_host = $_SERVER['HTTP_HOST'] ?? '';
$marutto_request_path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$marutto_is_local = preg_match('/^(?:localhost|127\.0\.0\.1|\[::1\])(?::[0-9]+)?$/i', $marutto_request_host) === 1;
$page_base = '/';
if ($marutto_is_local && is_string($marutto_request_path)) {
  if (preg_match('#^(.*?)/(?:service_marutto\.php|marutto-plan(?:/.*)?)$#', $marutto_request_path, $marutto_base_match)) {
    $page_base = rtrim($marutto_base_match[1], '/') . '/';
    if ($page_base === '') {
      $page_base = '/';
    }
  }
}
$marutto_page_path = $page_base . 'service_marutto.php';
$page_top_href = $marutto_page_path . '#top';
$page_head = '<link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+New:wght@400;500;700;900&display=swap" rel="stylesheet"><link rel="preload" as="image" href="images/marutto-moja-surprise.webp">';
$page_style = '<link href="css/service-marutto.css?v=' . filemtime(__DIR__ . '/css/service-marutto.css') . '" rel="stylesheet">';
$page_script = <<<'HTML'
<script>
document.addEventListener('DOMContentLoaded', function () {
  var sticky = document.querySelector('.marutto_sticky');
  var stickyHiddenAreas = document.querySelectorAll('.marutto_hero, .marutto_final, .marutto_contact_form_section');
  if (sticky && stickyHiddenAreas.length && 'IntersectionObserver' in window) {
    var stickyVisibility = new Map();
    var stickyObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        stickyVisibility.set(entry.target, entry.isIntersecting);
      });
      sticky.classList.toggle('is_hidden', Array.from(stickyVisibility.values()).some(Boolean));
    }, { threshold: 0.04 });
    stickyHiddenAreas.forEach(function (area) {
      stickyVisibility.set(area, false);
      stickyObserver.observe(area);
    });
  }
  document.querySelectorAll('.marutto_plan a').forEach(function (link) {
    link.addEventListener('click', function () {
      if (typeof gtag !== 'function') return;
      var href = link.getAttribute('href') || '';
      var label = href.indexOf('line.me') !== -1 ? 'line'
        : href.indexOf('tel:') === 0 ? 'phone'
        : href.indexOf('contact.php') !== -1 || href.indexOf('#contact_form') !== -1 ? 'form'
        : href.indexOf('works_archive.php') !== -1 ? 'works' : 'internal';
      gtag('event', 'marutto_plan_click', {
        event_category: 'contact',
        event_label: label,
        page_variant: 'service_marutto'
      });
    });
  });

  var form = document.getElementById('mailform');
  if (!form) return;

  var consultationChecks = form.querySelectorAll('input[name="ご相談内容(必須)[]"]');
  var consultationError = form.querySelector('[data-error-for="consultation"]');
  var requiredFields = form.querySelectorAll('[data-contact-required]');
  var submitBtn = form.querySelector('.contact-submit-btn');

  function setFieldError(field, hasError) {
    field.classList.toggle('field-error', hasError);
  }

  function isFormReady() {
    for (var i = 0; i < requiredFields.length; i++) {
      if (!requiredFields[i].value.trim()) return false;
    }
    return Array.prototype.some.call(consultationChecks, function (checkbox) {
      return checkbox.checked;
    });
  }

  function updateSubmitState() {
    if (submitBtn) submitBtn.disabled = !isFormReady();
  }

  function validateContactForm() {
    var isValid = true;
    requiredFields.forEach(function (field) {
      var hasError = !field.value.trim();
      setFieldError(field, hasError);
      if (hasError) isValid = false;
    });

    var hasCheckedConsultation = Array.prototype.some.call(consultationChecks, function (checkbox) {
      return checkbox.checked;
    });
    consultationChecks.forEach(function (checkbox) {
      checkbox.required = !hasCheckedConsultation;
    });
    if (consultationError) consultationError.classList.toggle('is-show', !hasCheckedConsultation);
    if (!hasCheckedConsultation) isValid = false;
    return isValid;
  }

  requiredFields.forEach(function (field) {
    field.addEventListener('input', function () {
      setFieldError(field, !field.value.trim());
      updateSubmitState();
    });
  });
  consultationChecks.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
      validateContactForm();
      updateSubmitState();
    });
  });
  updateSubmitState();

  form.addEventListener('submit', function (event) {
    if (!validateContactForm()) {
      event.preventDefault();
      event.stopImmediatePropagation();
      form.reportValidity();
    }
  }, true);

  if (new URLSearchParams(location.search).get('thanks') === '1') {
    if (typeof gtag === 'function') {
      gtag('event', 'form_submit', {
        event_category: 'contact',
        event_label: 'marutto_contact_form'
      });
    }
    if (window.history && history.replaceState) {
      history.replaceState(null, '', location.pathname + location.hash);
    }
  }
});
</script>
HTML;
$marutto_is_thanks = isset($_GET['thanks']) && $_GET['thanks'] === '1';
$marutto_has_form_error = isset($_GET['form_error']) && $_GET['form_error'] === '1';
?>
<?php include_once './header.php'; ?>
<?php
$marutto_line_url = htmlspecialchars($line, ENT_QUOTES, 'UTF-8');
$marutto_tel_link = htmlspecialchars(str_replace(['-', 'ー', ' '], '', $telNo), ENT_QUOTES, 'UTF-8');
?>

<!-- デザインまるっとお任せプラン service_marutto.php -->
<main>
  <div class="overflow marutto_plan service_marutto">
    <section>
      <div id="marutto_top" class="marutto_hero">
        <div class="marutto_campaign_limit">
          <div class="marutto_campaign_limit_inner">
            <a class="marutto_campaign_brand" href="<?php echo htmlspecialchars($page_base, ENT_QUOTES, 'UTF-8'); ?>" aria-label="デザネコ ホームへ">デザネコ</a>
            <h1>
              <span class="marutto_campaign_service">チラシとホームページ<br>まるっとお任せプラン</span>
              <span class="marutto_campaign_limit_title">守成クラブの方 <strong>毎月2組限定</strong></span>
            </h1>
            <p>一人で全工程を担当するため、月に2組までしかお引き受けできません。</p>
            <a class="marutto_hero_line" href="<?php echo htmlspecialchars($line, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-line" aria-hidden="true"></i> LINEで無料相談</a>
          </div>
        </div>

        <div class="marutto_campaign_stage">
          <div class="marutto_campaign_stage_inner">
            <p class="marutto_campaign_word is_left"><strong>チラシ</strong><span>デザインが</span></p>
            <p class="marutto_campaign_word is_right"><strong>タダ</strong><span>にゃんて!!</span></p>
            <img class="marutto_campaign_cat" src="<?php echo $img; ?>/marutto-moja-surprise.webp" alt="料金を見て驚く看板猫のもじゃ" width="877" height="928" fetchpriority="high" decoding="async">

            <div class="marutto_campaign_prices">
              <div class="marutto_campaign_price is_flyer">
                <p>守成クラブの方特別サービス</p>
                <div><span>通常30,000円チラシデザインが</span><strong>制作費 <em>0</em>円</strong></div>
              </div>
              <span class="marutto_campaign_plus" aria-hidden="true">＋</span>
              <div class="marutto_campaign_price is_web">
                <p>守成クラブの方限定特別価格</p>
                <div><span>通常月額9,800円のホームページが</span><strong><small>月々</small><em>8,800</em>円<sup>（税別）</sup></strong></div>
              </div>
            </div>
          </div>
        </div>

        <p class="marutto_campaign_tagline">チラシとホームページまるっとお任せプラン、<strong>はじめました！</strong></p>

        <div class="marutto_campaign_follow">
          <div class="marutto_inner">
          <ul class="marutto_trust_bar" aria-label="デザネコの実績とプランの特徴">
            <li><span>デザイン歴</span><strong>20<small>年</small></strong></li>
            <li><span>HP制作実績</span><strong>789<small>社</small></strong></li>
            <li><span>制作費</span><strong>0<small>円</small></strong></li>
            <li><span>契約</span><strong>縛りなし</strong></li>
          </ul>
          <div class="marutto_hero_action">
            <p class="marutto_plan_name">◆ デザインまるっとお任せプラン ◆</p>
            <p class="marutto_limited">★ 守成クラブの方 毎月2組限定 ★</p>
            <a class="marutto_cta" href="<?php echo $marutto_line_url; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-line" aria-hidden="true"></i><span>まずはLINEで無料相談する<small>相談・お見積りは無料です</small></span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a>
            <a class="marutto_anchor_link" href="<?php echo htmlspecialchars($marutto_page_path, ENT_QUOTES, 'UTF-8'); ?>#plan"><i class="fa-regular fa-circle-play" aria-hidden="true"></i> 30秒で分かるプランの中身を見る</a>
          </div>
          </div>
        </div>
      </div>
    </section>

    <section>
      <div class="marutto_section marutto_worries">
        <div class="marutto_inner">
          <div class="marutto_heading">
            <p>Problem</p>
            <h2>こんなお悩み、ありませんか？</h2>
          </div>
          <div class="marutto_worries_layout">
            <img src="<?php echo $img; ?>/flyer-design/mascot-kururu-wave.webp" alt="お悩みに耳を傾ける白猫のくるる" width="519" height="694" loading="lazy" decoding="async">
            <ul class="marutto_check_list">
              <li>ホームページとチラシの依頼を別々にするのが面倒…</li>
              <li>制作会社の見積もりが50万円で諦めた…</li>
              <li>HPを作ったけれど、問い合わせに繋がらない…</li>
              <li>ブログ・SNS・チラシのデザインがバラバラで統一感がない…</li>
              <li>更新のたびに追加料金が請求されて、放置している…</li>
              <li>Webの知識がなく、気軽に相談できる人が身近にいない…</li>
            </ul>
            <img src="<?php echo $img; ?>/flyer-design/mascot-moja-wave.webp" alt="一緒に解決策を考える黒猫のもじゃ" width="539" height="693" loading="lazy" decoding="async">
          </div>
          <p class="marutto_turning">3つ以上あてはまったら、<br><strong>デザネコの“まるっとお任せプラン”がぴったりです。</strong></p>
          <div class="marutto_section_action"><a class="marutto_cta marutto_cta_compact" href="<?php echo $marutto_line_url; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-line" aria-hidden="true"></i><span>まずは無料相談する<small>まとまっていないお悩みでも大丈夫です</small></span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a><a class="marutto_anchor_link" href="<?php echo htmlspecialchars($marutto_page_path, ENT_QUOTES, 'UTF-8'); ?>#plan">プランの詳細を見る</a></div>
        </div>
      </div>
    </section>

    <section>
      <div id="about_plan" class="marutto_section marutto_solution">
        <div class="marutto_inner">
          <div class="marutto_heading">
            <p>Solution</p>
            <h2>“入口のチラシ”×“受け皿のHP”の掛け算で、<br>集客が続く仕組み。</h2>
          </div>
          <div class="marutto_concept" aria-label="チラシからホームページを通じてお問い合わせにつながる仕組み">
            <div><img class="marutto_concept_icon" src="<?php echo $img; ?>/marutto-icon-flyer-v1.jpg" alt="チラシのイメージ" width="512" height="512" loading="lazy"><strong>チラシ</strong><span>興味を持つ</span></div>
            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            <div><img class="marutto_concept_icon" src="<?php echo $img; ?>/marutto-icon-website-v1.jpg" alt="ホームページのイメージ" width="512" height="512" loading="lazy"><strong>ホームページ</strong><span>ちゃんと調べる</span></div>
            <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            <div class="is_goal"><img class="marutto_concept_icon" src="<?php echo $img; ?>/marutto-icon-contact-v1.jpg" alt="お問い合わせのイメージ" width="512" height="512" loading="lazy"><strong>お問い合わせ</strong><span>行動につながる</span></div>
          </div>
          <div class="marutto_feature_grid">
            <article><span>特徴 1</span><i class="fa-solid fa-user-pen" aria-hidden="true"></i><h3>20年・1,000件超の経験で<br>一貫プロデュース</h3><p>大手のような分業ではなく、ヒアリングから公開後の改善まで、比嘉が最初から最後まで責任を持って担当します。</p></article>
            <article><span>特徴 2</span><i class="fa-solid fa-chart-line" aria-hidden="true"></i><h3>HP制作後も、<br>数字で改善サポート</h3><p>閲覧数・男女比・検索キーワード等を数値化し、改善案をご提案。狙ったターゲットへの届け方や検索上位表示のご相談にも柔軟に対応します。</p></article>
            <article><span>特徴 3</span><i class="fa-solid fa-palette" aria-hidden="true"></i><h3>印刷物以外のデザインも<br>まとめてお任せ</h3><p>シールやオリジナルグッズなど、大手では高額だったデザインもご相談可能。ブランドの雰囲気を揃えながら、低価格でご提供します。</p></article>
          </div>
          <div class="marutto_section_action"><a class="marutto_cta marutto_cta_compact" href="<?php echo $marutto_line_url; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-line" aria-hidden="true"></i><span>まずは無料相談する<small>チラシだけ、HPだけのご相談も歓迎です</small></span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></div>
        </div>
      </div>
    </section>

    <section>
      <div class="marutto_section marutto_results">
        <div class="marutto_inner">
          <div class="marutto_heading">
            <p>Results</p>
            <h2>これまでに手がけたホームページは、<strong>789社</strong>。</h2>
          </div>
          <ul class="marutto_numbers">
            <li><strong>789<small>社</small></strong><span>HP制作実績</span></li>
            <li><strong>27<small>件</small></strong><span>印刷物制作実績</span></li>
            <li><strong>20<small>年</small></strong><span>デザイン歴</span></li>
            <li><strong>10<small>店舗</small></strong><span>お客様の拡大事例</span></li>
          </ul>
          <div class="marutto_results_grid">
            <div class="marutto_work_samples">
              <h3>制作実績の一例</h3>
              <div>
                <figure><img src="<?php echo $img; ?>/web_design/nicoli-music.com.webp" alt="音楽教室のホームページ制作実績" width="480" height="360" loading="lazy" decoding="async"><figcaption>音楽教室</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/yukyu-okinawa.com.webp" alt="旅行会社のホームページ制作実績" width="480" height="360" loading="lazy" decoding="async"><figcaption>旅行・観光</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/arakaki-grow.co.jp.webp" alt="企業ホームページの制作実績" width="480" height="360" loading="lazy" decoding="async"><figcaption>企業サイト</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/churasakura.okinawa.webp" alt="沖縄県内事業者のホームページ制作実績" width="480" height="360" loading="lazy" decoding="async"><figcaption>地域サービス</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/hamagawa-nursery.com.webp" alt="保育園のホームページ制作実績" width="480" height="360" loading="lazy" decoding="async"><figcaption>保育園</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/ryukyu-urology.jp.webp" alt="医療機関のホームページ制作実績" width="480" height="360" loading="lazy" decoding="async"><figcaption>医療機関</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/24c.jp.webp" alt="制作実績 24c.jp" width="480" height="360" loading="lazy"><figcaption>店舗</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/higawa-parking.jp.webp" alt="制作実績 higawa-parking.jp" width="480" height="360" loading="lazy"><figcaption>駐車場</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/glanz-amami.com.webp" alt="制作実績 glanz-amami.com" width="480" height="360" loading="lazy"><figcaption>宿泊・観光</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/umui.co.jp.webp" alt="制作実績 umui.co.jp" width="480" height="360" loading="lazy"><figcaption>福祉</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/inkankobo-han.com.webp" alt="制作実績 inkankobo-han.com" width="480" height="360" loading="lazy"><figcaption>小売店舗</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/kitamura-ind.com.webp" alt="制作実績 kitamura-ind.com" width="480" height="360" loading="lazy"><figcaption>工業</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/yamagen-syouten.com.webp" alt="制作実績 yamagen-syouten.com" width="480" height="360" loading="lazy"><figcaption>卸売</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/okinawapump.com.webp" alt="制作実績 okinawapump.com" width="480" height="360" loading="lazy"><figcaption>建設・工事</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/f-marui.com.webp" alt="制作実績 f-marui.com" width="480" height="360" loading="lazy"><figcaption>サービス</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/itomansjc.or.jp.webp" alt="制作実績 itomansjc.or.jp" width="480" height="360" loading="lazy"><figcaption>団体</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/nahawest-rotary.org.webp" alt="制作実績 nahawest-rotary.org" width="480" height="360" loading="lazy"><figcaption>地域団体</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/yutaka-ema.com.webp" alt="制作実績 yutaka-ema.com" width="480" height="360" loading="lazy"><figcaption>専門サービス</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/artdesignhakata.com.webp" alt="制作実績 artdesignhakata.com" width="480" height="360" loading="lazy"><figcaption>デザイン</figcaption></figure>
                <figure><img src="<?php echo $img; ?>/web_design/okikoken.co.jp.webp" alt="制作実績 okikoken.co.jp" width="480" height="360" loading="lazy"><figcaption>建築</figcaption></figure>
              </div>
              <a class="marutto_text_link" href="works_archive.php">制作実績一覧を見る（789社すべて） <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
            </div>
            <div class="marutto_chart">
              <h3>カテゴリ別内訳</h3>
              <p class="marutto_chart_note">※棒の長さは最多カテゴリを100とした比較です。</p>
              <dl>
                <div><dt>建築・建設・工事</dt><dd><span style="--value:73%"></span><b>166</b></dd></div>
                <div><dt>サービス</dt><dd><span style="--value:38%"></span><b>87</b></dd></div>
                <div><dt>福祉施設</dt><dd><span style="--value:32%"></span><b>73</b></dd></div>
                <div><dt>医院</dt><dd><span style="--value:22%"></span><b>51</b></dd></div>
                <div><dt>小売店舗</dt><dd><span style="--value:21%"></span><b>49</b></dd></div>
                <div><dt>工場・工業</dt><dd><span style="--value:17%"></span><b>39</b></dd></div>
                <div><dt>卸売</dt><dd><span style="--value:17%"></span><b>38</b></dd></div>
                <div><dt>保育園・幼稚園</dt><dd><span style="--value:13%"></span><b>30</b></dd></div>
                <div><dt>飲食</dt><dd><span style="--value:12%"></span><b>28</b></dd></div>
                <div><dt>その他各種</dt><dd><span style="--value:100%"></span><b>228</b></dd></div>
              </dl>
            </div>
          </div>
          <div class="marutto_section_action"><a class="marutto_cta marutto_cta_compact" href="<?php echo $marutto_line_url; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-line" aria-hidden="true"></i><span>まずは無料相談する<small>同業種の事例もご案内できます</small></span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></div>
        </div>
      </div>
    </section>

    <section>
      <div class="marutto_section marutto_voices">
        <div class="marutto_inner">
          <div class="marutto_heading">
            <p>Voice</p>
            <h2>“作って終わり”じゃない、続く成果。</h2>
          </div>
          <div class="marutto_voice_grid">
            <article>
              <div class="marutto_voice_person"><img src="<?php echo $img; ?>/voice-nicoli-arakaki.jpg" alt="ニコリミュージック代表 新垣里実さま" width="480" height="720" loading="lazy"><p><small>音楽教室経営</small><strong>ニコリミュージック代表<br>新垣 里実 様</strong></p></div>
              <h3>“作って終わり”じゃなかった。<br>毎年60件、問い合わせが続いています。</h3>
              <p>HPとチラシを制作していただいてから、お問い合わせが毎年継続的に入るように。以前は口コミ中心でしたが、今は少し離れた地域からもご連絡が。昨年度は年間約60件、うち34名の方にご入会いただいています。</p>
              <div class="marutto_voice_stats"><span>年間<strong>60</strong>件</span><span><strong>34</strong>名入会</span></div>
            </article>
            <article>
              <div class="marutto_voice_person"><img src="<?php echo $img; ?>/voice-yukyunotabi-ura.jpg" alt="悠久の旅 沖縄 代表 宇良さま" width="480" height="480" loading="lazy"><p><small>旅行代理店経営</small><strong>悠久の旅 沖縄<br>代表 宇良 様</strong></p></div>
              <h3>“本能にぶっ刺さるチラシ”で即決契約。<br>第2弾の受注まで生まれました。</h3>
              <p>「本能にぶっ刺さるデザインを」とオーダー。上がってきたチラシは圧倒的なクオリティ！お客様にお見せすると即決でご契約となり、旅行自体も大好評。ホームページと印刷物を一貫して任せられる強みを実感しています。</p>
              <div class="marutto_voice_stats"><span><strong>即決</strong>契約</span><span>第<strong>2</strong>弾受注</span></div>
            </article>
            <article>
              <div class="marutto_voice_person"><span class="marutto_voice_avatar"><i class="fa-solid fa-store" aria-hidden="true"></i></span><p><small>日用品小売経営</small><strong>株式会社バリューボックス<br>代表 屋良 竜紀 様</strong></p></div>
              <h3>HPリニューアル後、<br>5年で1店舗から10店舗近くまで拡大。</h3>
              <p>デザネコさんとは10年以上のお付き合い。HPと印刷物を一貫して任せられるので、ブランドの統一感が出せる。結果、5年で1店舗から10店舗近くまで拡大することができました。</p>
              <div class="marutto_voice_stats"><span>5年で<strong>10</strong>倍</span><span><strong>10</strong>年以上</span></div>
            </article>
          </div>
          <div class="marutto_section_action"><a class="marutto_cta marutto_cta_compact" href="<?php echo $marutto_line_url; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-line" aria-hidden="true"></i><span>まずは無料相談する<small>成果につながる組み合わせをご提案します</small></span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></div>
        </div>
      </div>
    </section>

    <section>
      <div id="plan" class="marutto_section marutto_pricing">
        <div class="marutto_inner">
          <div class="marutto_heading">
            <p>Price</p>
            <h2>シンプルな月額制。<strong>制作費は0円</strong>です。</h2>
          </div>
          <div class="marutto_price_layout">
            <div class="marutto_price_card">
              <p>デザインまるっとお任せプラン</p>
              <div><span>制作費<strong>0<small>円</small></strong></span><i class="fa-solid fa-plus" aria-hidden="true"></i><span>月額（通常）<strong>9,800<small>円</small></strong></span></div>
              <p class="marutto_price_note">※ 今お持ちのHPと並行して新規制作もOK！</p>
            </div>
            <div class="marutto_special_price">
              <p>★ ご紹介限定 特別価格 ★</p>
              <strong><small>月額</small> 8,800<em>円</em><small>（税別）</small></strong>
              <span>守成クラブの方／毎月2組限定</span>
            </div>
          </div>
          <div class="marutto_package">
            <div>
              <h3><i class="fa-solid fa-box-open" aria-hidden="true"></i> パッケージ内容</h3>
              <ul>
                <li>6ページ制作＋TOPアニメーション</li><li>サーバー・ドメイン費 コミコミ</li><li>SSL・スマホ・タブレット対応</li><li>ブログシステム（WordPress不使用）</li><li>お問い合わせフォーム／SNS連携</li><li>Google Map（MEO）サポート</li><li><strong>年2回のチラシ制作込み</strong></li><li>各種印刷物の相談サポート</li><li>デザインの追加修正いつでもOK</li>
              </ul>
            </div>
            <aside><h3>オプション</h3><ul><li>予約システム</li><li>クレジットカード決済機能</li><li>カート決済システム</li></ul><p>必要な機能だけ、事前に分かりやすくお見積りします。</p></aside>
          </div>
          <div class="marutto_section_action"><a class="marutto_cta" href="<?php echo $marutto_line_url; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-line" aria-hidden="true"></i><span>まずは無料相談する<small>料金や契約についても丁寧にご説明します</small></span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></div>
        </div>
      </div>
    </section>

    <section>
      <div class="marutto_section marutto_profile">
        <div class="marutto_inner">
          <div class="marutto_heading">
            <p>Designer</p>
            <h2>制作するのは、こんな人です。</h2>
          </div>
          <div class="marutto_profile_grid">
            <div class="marutto_profile_intro">
              <img src="<?php echo $img; ?>/profile-renewal/profile-story-gahie-v2.webp" alt="ガーヒーと看板猫のもじゃ・くるる" width="1536" height="1024" loading="lazy" decoding="async">
              <div><p class="marutto_profile_role">現場経験型Web制作者 ／ 1984年 沖縄県生まれ</p><h3><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?> <small>（ガーヒー＠ネコ好き）</small></h3><p>名刺1枚から、チラシやポスター、飲食店のメニューまで、撮影から取材・デザインまで幅広く対応してきました。10年以上、1,000件以上のホームページ制作を経験。取材・撮影・デザイン・コーディング・ライティング全てを一貫して担当してきた現場経験型Web制作者です。</p></div>
            </div>
            <div class="marutto_profile_thought"><h3>「作って終わり」ではなく、<br>「育てる」という発想</h3><p>1,000件超の制作現場を経験する中で感じたのは、多くのホームページが「作ったまま更新されていない」ということでした。本当に大切なのは、ホームページを“作る”ことではなく“育てる”こと。</p><p>その想いから、デザネコでは小さなお店の“外部Web担当”として、ホームページ制作・チラシ・撮影・SNS運用まで一括でサポートしています。</p></div>
          </div>
          <div class="marutto_timeline">
            <h3>これまでの歩み</h3>
            <ol>
              <li><strong>1984年</strong><p>沖縄県で生まれる。友人から「デザイナーに向いているんじゃない？」と言われたのが、この道に進むきっかけ。</p></li>
              <li><strong>20代前半</strong><p>広告代理店でデザイナー勤務。大手スーパー・デパートのチラシ、広告印刷物を担当。</p></li>
              <li><strong>20代後半</strong><p>沖縄県内13店舗以上の飲食業界の専属デザイナー。撮影・編集・印刷・企画まで全工程を担当。</p></li>
              <li><strong>30代</strong><p>沖縄県内最多級の実績を持つHP制作会社に勤務。1,000件以上のHPを担当。</p></li>
              <li><strong>現在</strong><p>AIを活用したクリエイティブに注力。動画・音楽・画像生成でお客様の価値を最大化。</p></li>
            </ol>
          </div>
          <div class="marutto_cats"><div><img src="<?php echo $img; ?>/about-renewal/moja-laptop.png" alt="パソコンを使う黒猫のもじゃ" width="370" height="320" loading="lazy"><img src="<?php echo $img; ?>/about-renewal/kururu-laptop.png" alt="タブレットを使う白猫のくるる" width="370" height="320" loading="lazy"></div><p>相棒の看板猫「もじゃ」と「くるる」が、<br>あなたの商売のネコの手になれたら嬉しいです<i class="fa-solid fa-paw" aria-hidden="true"></i></p></div>
          <div class="marutto_section_action"><a class="marutto_cta marutto_cta_compact" href="<?php echo $marutto_line_url; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-line" aria-hidden="true"></i><span>まずは無料相談する<small>最初から最後まで比嘉本人が対応します</small></span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></div>
        </div>
      </div>
    </section>

    <section>
      <div class="marutto_section marutto_faq">
        <div class="marutto_inner">
          <div class="marutto_heading">
            <p>FAQ</p>
            <h2>よくあるご質問</h2>
          </div>
          <div class="marutto_faq_grid">
            <details open><summary><span>Q1.</span> 制作費が本当に0円ですか？<i class="fa-solid fa-plus" aria-hidden="true"></i></summary><p>はい。月額のみでスタートでき、初期費用は一切いただきません。</p></details>
            <details><summary><span>Q2.</span> 契約期間の縛りはありますか？<i class="fa-solid fa-plus" aria-hidden="true"></i></summary><p>ございません。合わないと感じたら、いつでも解約OKです。</p></details>
            <details><summary><span>Q3.</span> 印刷代は月額に含まれますか？<i class="fa-solid fa-plus" aria-hidden="true"></i></summary><p>デザイン制作費のみ含まれます。印刷代は部数・仕様により別途実費でご案内します。</p></details>
            <details><summary><span>Q4.</span> HP公開までどれくらいかかりますか？<i class="fa-solid fa-plus" aria-hidden="true"></i></summary><p>お打ち合わせから約1〜2ヶ月が目安です。</p></details>
            <details><summary><span>Q5.</span> 写真や文章は自分で準備が必要ですか？<i class="fa-solid fa-plus" aria-hidden="true"></i></summary><p>ご不要です。取材・撮影・執筆までこちらでお手伝いします。</p></details>
            <details><summary><span>Q6.</span> 今持っているHPと並行でも大丈夫？<i class="fa-solid fa-plus" aria-hidden="true"></i></summary><p>大丈夫です。切り替え時期や告知は無理のないタイミングでご相談しながら進めます。</p></details>
            <details><summary><span>Q7.</span> 遠方からの依頼でも対応できますか？<i class="fa-solid fa-plus" aria-hidden="true"></i></summary><p>はい、可能です。オンラインでの打ち合わせやデータ共有にも対応しております。</p></details>
            <details><summary><span>Q8.</span> デザインの修正は何回までできますか？<i class="fa-solid fa-plus" aria-hidden="true"></i></summary><p>基本的な修正は2〜3回まで無料で対応。それ以降の修正や大幅な変更が必要な場合は、事前にご案内いたします。</p></details>
          </div>
          <div class="marutto_section_action"><a class="marutto_cta marutto_cta_compact" href="<?php echo $marutto_line_url; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-line" aria-hidden="true"></i><span>まずは無料相談する<small>小さな疑問にも丁寧にお答えします</small></span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></div>
        </div>
      </div>
    </section>

    <section>
      <div class="marutto_section marutto_company">
        <div class="marutto_inner">
          <div class="marutto_heading">
            <p>Company</p>
            <h2>会社概要</h2>
          </div>
          <div class="marutto_company_layout">
            <table>
              <tbody>
                <tr><th scope="row">屋号</th><td><?php echo htmlspecialchars($company, ENT_QUOTES, 'UTF-8'); ?>（デザインのネコの手）</td></tr>
                <tr><th scope="row">設立日</th><td>2015年</td></tr>
                <tr><th scope="row">代表</th><td><?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>（ガーヒー）</td></tr>
                <tr><th scope="row">所在地</th><td><?php echo htmlspecialchars($postalCode, ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlspecialchars($address, ENT_QUOTES, 'UTF-8'); ?></td></tr>
                <tr><th scope="row">事業内容</th><td>ホームページ制作／印刷物デザイン／ロゴデザイン／ブログ制作／写真撮影／動画撮影／AI画像生成／SNS運用代行</td></tr>
                <tr><th scope="row">取引銀行</th><td>琉球銀行 ／ 沖縄銀行 ／ 楽天銀行</td></tr>
                <tr><th scope="row">お支払い方法</th><td>PayPal（JCB／VISA／MasterCard／American Express）／銀行振込／PayPay ほか</td></tr>
                <tr><th scope="row">Web</th><td><a href="https://d-neko.com/">https://d-neko.com</a></td></tr>
              </tbody>
            </table>
            <img src="<?php echo $img; ?>/about-renewal/moja-laptop.png" alt="パソコンで制作する黒猫のもじゃ" width="370" height="320" loading="lazy">
          </div>
          <div class="marutto_section_action"><a class="marutto_cta marutto_cta_compact" href="<?php echo $marutto_line_url; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-line" aria-hidden="true"></i><span>まずは無料相談する<small>沖縄・宜野湾から丁寧に対応します</small></span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a></div>
        </div>
      </div>
    </section>

    <section>
      <div class="marutto_final">
        <div class="marutto_inner">
          <img class="marutto_final_cats" src="<?php echo $img; ?>/home-renewal/deco-contact.jpg" alt="無料相談をお待ちする看板猫のもじゃとくるる" width="1200" height="630" loading="lazy">
          <div class="marutto_heading">
            <p>Contact</p>
            <h2>まずは無料相談から。</h2>
          </div>
          <p class="marutto_final_lead">チラシ・ホームページ・SNS…どんなご相談でも大丈夫。<br><strong>お気軽にLINEでご連絡ください（返信は24時間以内）</strong>。</p>
          <p class="marutto_limited">★ 守成クラブの方 毎月2組限定 ★</p>
          <div class="marutto_contact_grid">
            <a class="is_line" href="<?php echo $marutto_line_url; ?>" target="_blank" rel="noopener noreferrer"><img src="<?php echo $img; ?>/marutto-plan-line-qr.png" alt="デザネコ公式LINEのQRコード" width="320" height="320" loading="lazy"><i class="fa-brands fa-line" aria-hidden="true"></i><span><small>LINEで気軽に相談</small><strong>まずは無料相談する</strong></span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a>
            <a class="is_tel" href="tel:<?php echo $marutto_tel_link; ?>"><i class="fa-solid fa-phone" aria-hidden="true"></i><span><small>今すぐ電話する／平日9:00〜18:00</small><strong><?php echo htmlspecialchars($telNo, ENT_QUOTES, 'UTF-8'); ?></strong></span></a>
            <a class="is_mail" href="<?php echo htmlspecialchars($marutto_page_path, ENT_QUOTES, 'UTF-8'); ?>#contact_form"><i class="fa-regular fa-envelope" aria-hidden="true"></i><span><small>24時間受付</small><strong>フォームで送る</strong></span><i class="fa-solid fa-chevron-right" aria-hidden="true"></i></a>
          </div>
          <p class="marutto_final_message">沖縄・宜野湾から、<br>あなたの商売の“ネコの手”になれたら嬉しいです<i class="fa-solid fa-paw" aria-hidden="true"></i><br><small>— <?php echo htmlspecialchars($company, ENT_QUOTES, 'UTF-8'); ?> <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>（ガーヒー）</small></p>
        </div>
      </div>
    </section>

    <section>
      <div id="contact_form" class="marutto_section marutto_contact_form_section">
        <div class="marutto_inner">
          <div class="marutto_heading">
            <p>Contact Form</p>
            <h2>お気軽に無料相談ください。</h2>
          </div>
          <p class="marutto_contact_form_lead">チラシやホームページの内容がまだ決まっていなくても大丈夫です。<br>現在のお悩みや気になることを、そのままお聞かせください。</p>

          <?php if ($marutto_is_thanks): ?>
            <div class="marutto_form_thanks" role="status">
              <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
              <h3>お問い合わせを受け付けました</h3>
              <p>内容を確認のうえ、デザネコよりご連絡いたします。<br>万が一3日以内に返信がない場合は、公式LINEよりご連絡ください。</p>
            </div>
          <?php endif; ?>

          <?php if ($marutto_has_form_error): ?>
            <div class="marutto_form_error" role="alert">
              <i class="fa-solid fa-triangle-exclamation" aria-hidden="true"></i>
              <p>送信内容を確認できませんでした。お手数ですが、必須項目をご確認のうえ、もう一度送信してください。</p>
            </div>
          <?php endif; ?>

          <div class="marutto_contact_form_wrap contact-form-wrap">
            <p class="marutto_contact_form_note">通常3営業日以内に返信いたします。<br>※営業・勧誘目的の送信はご遠慮ください。</p>

            <form id="mailform" class="form type_s" method="post" enctype="multipart/form-data" action="mailform/send.php">
              <input type="hidden" name="form_type" value="marutto_contact">
              <input type="hidden" name="form_started_at" value="<?php echo time(); ?>">
              <input type="hidden" name="marutto_form_token" value="<?php echo htmlspecialchars($marutto_form_token, ENT_QUOTES, 'UTF-8'); ?>">
              <div class="marutto_honeypot" aria-hidden="true">
                <label>この欄は入力しないでください
                  <input type="text" name="website_url" value="" tabindex="-1" autocomplete="off">
                </label>
              </div>

              <dl>
                <div>
                  <dt id="marutto_consultation_label">ご相談内容<span>必須</span></dt>
                  <dd role="group" aria-labelledby="marutto_consultation_label" aria-describedby="marutto_consultation_error">
                    <label class="checkbox_text"><input type="checkbox" name="ご相談内容(必須)[]" value="チラシ・フライヤー制作">チラシ・フライヤー制作</label>
                    <label class="checkbox_text"><input type="checkbox" name="ご相談内容(必須)[]" value="名刺・ショップカード制作">名刺・ショップカード制作</label>
                    <label class="checkbox_text"><input type="checkbox" name="ご相談内容(必須)[]" value="シール・印刷物制作">シール・印刷物制作</label>
                    <label class="checkbox_text"><input type="checkbox" name="ご相談内容(必須)[]" value="ブログ・ホームページ制作">ブログ・ホームページ制作</label>
                    <label class="checkbox_text"><input type="checkbox" name="ご相談内容(必須)[]" value="更新・運用サポート">更新・運用サポート</label>
                    <label class="checkbox_text"><input type="checkbox" name="ご相談内容(必須)[]" value="まずは相談したい">まずは相談したい</label>
                    <p id="marutto_consultation_error" class="contact-error-message" data-error-for="consultation" role="alert">ご相談内容を1つ以上選択してください。</p>
                  </dd>
                </div>
                <div>
                  <dt><label for="marutto_name">お名前<span>必須</span></label></dt>
                  <dd><input id="marutto_name" type="text" class="textarea" name="お名前(必須)" size="70" maxlength="100" autocomplete="name" placeholder="例：山田太郎" required data-contact-required></dd>
                </div>
                <div>
                  <dt><label for="marutto_company">屋号・会社名<span class="nini">任意</span></label></dt>
                  <dd><input id="marutto_company" type="text" class="textarea" name="屋号・会社名" size="70" maxlength="150" autocomplete="organization" placeholder="例：〇〇店"></dd>
                </div>
                <div>
                  <dt><label for="marutto_url">今お持ちのホームページURL<span class="nini">任意</span></label></dt>
                  <dd><input id="marutto_url" type="url" class="textarea" name="今お持ちのホームページURL" size="70" maxlength="500" autocomplete="url" placeholder="例：https://example.com"></dd>
                </div>
                <div>
                  <dt><label for="marutto_email">メールアドレス<span>必須</span></label></dt>
                  <dd><input id="marutto_email" type="email" class="textarea" name="email(必須)" size="70" maxlength="254" autocomplete="email" placeholder="例：info@example.com" required data-contact-required></dd>
                </div>
                <div>
                  <dt><label for="marutto_tel">電話番号<span class="nini">任意</span></label></dt>
                  <dd><input id="marutto_tel" type="tel" class="textarea" name="電話番号" size="70" maxlength="30" autocomplete="tel" placeholder="例：090-0000-0000"></dd>
                </div>
                <div>
                  <dt id="marutto_reply_label">ご希望の連絡方法<span class="nini">任意</span></dt>
                  <dd class="marutto_inline_choices" role="radiogroup" aria-labelledby="marutto_reply_label">
                    <label class="radio_text"><input type="radio" name="ご希望の連絡方法" value="メール" checked>メール</label>
                    <label class="radio_text"><input type="radio" name="ご希望の連絡方法" value="電話">電話</label>
                    <label class="radio_text"><input type="radio" name="ご希望の連絡方法" value="LINE">LINE</label>
                  </dd>
                </div>
                <div>
                  <dt><label for="marutto_budget">ご予算感<span class="nini">任意</span></label></dt>
                  <dd>
                    <select id="marutto_budget" class="dropdown" name="ご予算感">
                      <option value="">選択してください</option>
                      <option value="まずは相談したい">まずは相談したい</option>
                      <option value="3万円未満">3万円未満</option>
                      <option value="3万円〜5万円">3万円〜5万円</option>
                      <option value="5万円〜10万円">5万円〜10万円</option>
                      <option value="10万円以上">10万円以上</option>
                    </select>
                  </dd>
                </div>
                <div>
                  <dt><label for="marutto_message">お問い合わせ内容<span>必須</span></label></dt>
                  <dd><textarea id="marutto_message" name="お問い合わせ内容(必須)" rows="10" cols="75" maxlength="5000" placeholder="ご相談内容、制作したいもの、現在困っていること、希望納期などをご自由にご記入ください。" required data-contact-required></textarea></dd>
                </div>
              </dl>

              <button class="formbutton contact-submit-btn" type="submit" value="無料相談する">無料相談する</button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <div class="marutto_sticky"><a href="<?php echo $marutto_line_url; ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-line" aria-hidden="true"></i><span>LINEで無料相談する</span></a></div>
  </div>
</main>
<!-- デザインまるっとお任せプラン service_marutto.php -->

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {"@type":"Question","name":"制作費が本当に0円ですか？","acceptedAnswer":{"@type":"Answer","text":"はい。月額のみでスタートでき、初期費用は一切いただきません。"}},
    {"@type":"Question","name":"契約期間の縛りはありますか？","acceptedAnswer":{"@type":"Answer","text":"ございません。合わないと感じたら、いつでも解約OKです。"}},
    {"@type":"Question","name":"印刷代は月額に含まれますか？","acceptedAnswer":{"@type":"Answer","text":"デザイン制作費のみ含まれます。印刷代は部数・仕様により別途実費でご案内します。"}},
    {"@type":"Question","name":"HP公開までどれくらいかかりますか？","acceptedAnswer":{"@type":"Answer","text":"お打ち合わせから約1〜2ヶ月が目安です。"}},
    {"@type":"Question","name":"写真や文章は自分で準備が必要ですか？","acceptedAnswer":{"@type":"Answer","text":"ご不要です。取材・撮影・執筆までこちらでお手伝いします。"}},
    {"@type":"Question","name":"今持っているHPと並行でも大丈夫？","acceptedAnswer":{"@type":"Answer","text":"大丈夫です。切り替え時期や告知は無理のないタイミングでご相談しながら進めます。"}},
    {"@type":"Question","name":"遠方からの依頼でも対応できますか？","acceptedAnswer":{"@type":"Answer","text":"はい、可能です。オンラインでの打ち合わせやデータ共有にも対応しております。"}},
    {"@type":"Question","name":"デザインの修正は何回までできますか？","acceptedAnswer":{"@type":"Answer","text":"基本的な修正は2〜3回まで無料で対応。それ以降の修正や大幅な変更が必要な場合は、事前にご案内いたします。"}}
  ]
}
</script>

<?php include_once './footer.php'; ?>
