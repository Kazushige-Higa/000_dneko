<?php
$page_title = 'お問い合わせ';
$page_title_eng = 'Contact';
$page_description = 'デザネコへの制作相談・お見積り依頼はこちらから。チラシ、名刺、ショップカード、Webまわりのご相談などお気軽にお問い合わせください。';
$page_style = "
<link href='mailform/jquery.datetimepicker.css' type='text/css' media='all' rel='stylesheet'>
<style>
.contact-lead { max-width: 900px; margin-inline: auto; }
.contact-choice-list { align-items: stretch; }
.contact-choice-list > li { height: 100%; }
.contact-card { height: 100%; border: 1px solid rgba(249,177,4,.28); }
.contact-card__icon { display: grid; place-items: center; width: 54px; height: 54px; margin: 0 auto 1em; border-radius: 50%; background: #fff7df; color: #f9b104; font-size: 1.5em; }
.contact-note { border-left: 4px solid #f9b104; }
.contact-thanks { border: 2px solid #8ecc6f; }
.contact-form-wrap .form dl {
  display: block;
  max-width: 980px;
  margin-inline: auto;
}
.contact-form-wrap .form dl dt,
.contact-form-wrap .form dl dd {
  margin: 0;
}
.contact-form-wrap .form dl dt {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  gap: .7em;
  width: auto;
  font-size: 1.18em;
  line-height: 1.5;
  padding: 2.2em 0 .9em;
  text-align: center;
}
.contact-form-wrap .form dl dd {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding-left: 0;
  padding: 0 0 2.2em;
  border-bottom: 1px dotted #cfcfcf;
}
.contact-form-wrap .form dl dt span {
  order: -1;
  flex: 0 0 auto;
  min-width: 3.8em;
  margin: .12em 0 0;
  padding: .28em .7em;
  border-radius: 999px;
  background: #1e5fa8;
  color: #fff;
  font-size: .68em;
  line-height: 1.4;
  text-align: center;
}
.contact-form-wrap .form dl dt span.nini { color: #333; background: #f4ed20; }
.contact-form-wrap label.checkbox_text { margin-bottom: .4em; }
.contact-form-wrap .form .textarea,
.contact-form-wrap .form textarea,
.contact-form-wrap .form .dropdown {
  display: block;
  width: 100%;
  min-height: 100px;
  padding: 1.15em 1.25em;
  border: 2px solid #e2e2e2;
  border-radius: 0;
  background: #f0f0f0;
  box-shadow: none;
  color: #333;
  text-align: center;
  transition: border-color .2s ease, box-shadow .2s ease, background-color .2s ease;
}
.contact-form-wrap .form textarea {
  min-height: 260px;
  resize: vertical;
  text-align: left;
}
.contact-form-wrap .form .textarea::placeholder,
.contact-form-wrap .form textarea::placeholder { color: #8a8176; opacity: 1; }
.contact-form-wrap .form .textarea:focus,
.contact-form-wrap .form textarea:focus,
.contact-form-wrap .form .dropdown:focus {
  outline: none;
  border-color: #f9b104;
  background: #fff8e6;
  box-shadow: 0 0 0 4px rgba(249,177,4,.18);
}
.contact-form-wrap .form .field-error {
  border-color: #d94b4b;
  background: #fff5f5;
}
.contact-form-wrap .form .contact-error-message {
  display: none;
  margin-top: .7em;
  color: #d94b4b;
  font-weight: 600;
  line-height: 1.6;
}
.contact-form-wrap .form .contact-error-message.is-show { display: block; }
.contact-form-wrap .form .formbutton {
  color: #fff;
  border-color: #8ecc6f;
  background: #8ecc6f;
}
.contact-form-wrap .form .formbutton:before { color: #fff; }
.contact-form-wrap .form .formbutton:hover {
  color: #fff;
  background: #78bd5a;
  border-color: #78bd5a;
}
.contact-form-wrap .form label.checkbox_text,
.contact-form-wrap .form label.radio_text {
  padding-top: .25em;
  padding-bottom: .25em;
}
@media screen and (max-width: 500px) {
  .contact-card__icon { width: 46px; height: 46px; }
  .contact-form-wrap .form dl dt {
    padding: 1.3em 0 .5em;
    border-bottom: 0;
    font-size: 1.05em;
  }
  .contact-form-wrap .form dl dd {
    padding: 0 0 1.4em;
    border-bottom: 1px dotted #cfcfcf;
  }
  .contact-form-wrap .form .textarea,
  .contact-form-wrap .form textarea,
  .contact-form-wrap .form .dropdown {
    min-height: 80px;
    padding: .9em 1em;
  }
  .contact-form-wrap .form textarea { min-height: 180px; }
}
</style>
";
$page_script = "
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='mailform/mailform.js'></script>
<script src='mailform/ajaxzip3.js'></script>
<script>
window.addEventListener('load', function () {
  if (typeof gtag === 'function') {
    gtag('event', 'contact_page_view', {
      event_category: 'contact',
      event_label: 'contact_page'
    });

    // フォーム送信完了の計測（send.php が /contact.php?thanks=1 へリダイレクト）
    // → コンバージョン(CV)としてカウント
    var params = new URLSearchParams(location.search);
    if (params.get('thanks') === '1') {
      gtag('event', 'form_submit', {
        event_category: 'contact',
        event_label: 'contact_form'
      });
      // リロードによる二重計測を防ぐため URL から thanks を除去
      if (window.history && history.replaceState) {
        history.replaceState(null, '', location.pathname);
      }
    }
  }

  var form = document.getElementById('mailform');
  if (!form) return;

  var consultationChecks = form.querySelectorAll('input[name=\"ご相談内容(必須)[]\"]');
  var consultationError = form.querySelector('[data-error-for=\"consultation\"]');
  var requiredFields = form.querySelectorAll('[data-contact-required]');

  function setFieldError(field, hasError) {
    field.classList.toggle('field-error', hasError);
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
    if (consultationError) {
      consultationError.classList.toggle('is-show', !hasCheckedConsultation);
    }
    if (!hasCheckedConsultation) isValid = false;

    return isValid;
  }

  requiredFields.forEach(function (field) {
    field.addEventListener('input', function () {
      setFieldError(field, !field.value.trim());
    });
  });

  consultationChecks.forEach(function (checkbox) {
    checkbox.addEventListener('change', validateContactForm);
  });

  form.addEventListener('submit', function (event) {
    if (!validateContactForm()) {
      event.preventDefault();
      event.stopImmediatePropagation();
      form.reportValidity();
    }
  }, true);
});
</script>
";
$is_thanks = isset($_GET['thanks']) && $_GET['thanks'] === '1';
?>
<?php include 'header.php'; ?>
<?php include 'page_title.php'; ?>

<div class='overflow'>

  <section>
    <div class='bg_base'>
      <div class='single03'>
        <div class='contact-lead tcenter'>
          <div class='tcenter b_m3'>
            <img width='90' src='<?php echo $img; ?>/favicon.png' alt='<?php echo htmlspecialchars($company, ENT_QUOTES, 'UTF-8'); ?>' loading='lazy'>
          </div>
          <h2 class='line_height_14'>
            <span class='eng base_color fs_40 act inup'>Contact</span><br>
            <span class='fs_40 fs_sp30 act txt_split type_lineup'>ネコの手、借りませんか？</span>
          </h2>
          <p class='t_m2'>
            チラシ・名刺・ショップカードなどの印刷物、ブログやホームページまわりのご相談、制作後の運用サポートまで。<br>
            まだ内容がまとまっていない段階でも大丈夫です。まずはお気軽にお聞かせください。
          </p>
        </div>

        <div class='space_3 space_sp2'></div>

        <ul class='grid set3 sp1 gap1 contact-choice-list'>
          <li>
            <div class='contact-card bg_white radius p4 tcenter'>
              <div class='contact-card__icon'><i class='fas fa-pen-nib'></i></div>
              <h3 class='bold fs_22 fs_sp20 base_color'>印刷物の制作</h3>
              <p>名刺、ショップカード、チラシ、フライヤー、シールなどの制作相談。</p>
            </div>
          </li>
          <li>
            <div class='contact-card bg_white radius p4 tcenter'>
              <div class='contact-card__icon'><i class='fas fa-laptop-code'></i></div>
              <h3 class='bold fs_22 fs_sp20 base_color'>Webまわりの相談</h3>
              <p>ブログ、ホームページ、LINE導線、更新サポートなどのご相談。</p>
            </div>
          </li>
          <li>
            <div class='contact-card bg_white radius p4 tcenter'>
              <div class='contact-card__icon'><i class='fas fa-comments'></i></div>
              <h3 class='bold fs_22 fs_sp20 base_color'>まずは無料相談</h3>
              <p>依頼内容が決まっていなくても、状況整理から一緒に進められます。</p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </section>

  <section>
    <div class='bg_base'>
      <div class='single'>
        <div class='tcenter b_m5'>
          <img width='80' src='<?php echo $img; ?>/favicon.png' alt='<?php echo htmlspecialchars($company, ENT_QUOTES, 'UTF-8'); ?>' loading='lazy'>
        </div>
        <h2 class='line_height_14 tcenter'>
          <span class='eng base_color fs_40 act txt_split type_popup'>Flow</span><br>
          <span class='fs_40 fs_sp30 act blur font_kiwi'>ご利用の流れ</span>
        </h2>
        <div class='space_3 space_sp1'></div>
        <div class='mbox radius bg_white'>
          <div class='sbox'>
            <dl class='flow_dl'>
              <div class='inner'>
                <dt class='act set'>Step.1</dt>
                <dd class='act inright'>
                  <b class='base_color'>お問い合わせ</b><br>
                  フォームから、ご相談内容や制作したいものをお聞かせください。内容がまだ決まっていない段階でも大丈夫です。
                </dd>
              </div>
              <div class='inner'>
                <dt class='act set'>Step.2</dt>
                <dd class='act inright'>
                  <b class='base_color'>内容確認・ヒアリング</b><br>
                  いただいた内容を確認し、目的・ご希望の雰囲気・必要な情報などを整理しながら進め方をご案内します。
                </dd>
              </div>
              <div class='inner'>
                <dt class='act set'>Step.3</dt>
                <dd class='act inright'>
                  <b class='base_color'>ご提案・お見積り</b><br>
                  制作内容、納期、費用の目安をお伝えします。気になる点があれば、この時点で調整できます。
                </dd>
              </div>
              <div class='inner'>
                <dt class='act set'>Step.4</dt>
                <dd class='act inright'>
                  <b class='base_color'>制作スタート</b><br>
                  内容にご納得いただけましたら制作を開始します。確認や修正のやり取りをしながら仕上げていきます。
                </dd>
              </div>
              <div class='inner'>
                <dt class='act set'>Step.5</dt>
                <dd class='act inright'>
                  <b class='base_color'>納品・公開サポート</b><br>
                  完成データの納品や公開作業を行います。制作後の更新・運用についても必要に応じてサポートします。
                </dd>
              </div>
            </dl>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div>
      <div class='single03'>
        <?php if ($is_thanks): ?>
          <div class='mbox bg_white radius shadow contact-thanks tcenter'>
            <h2 class='line_height_14 b_m2'>
              <span class='eng base_color fs_40'>Thanks</span><br>
              <span class='bold fs_32 fs_sp24'>お問い合わせを受け付けました</span>
            </h2>
            <p>
              内容を確認のうえ、デザネコよりご連絡いたします。<br>
              万が一3日以内に返信がない場合は、メールアドレスの入力間違いなどの可能性がありますので、お手数ですが再度お問い合わせください。
            </p>
          </div>
          <div class='space_3 space_sp2'></div>
        <?php endif; ?>

        <div class='mbox bg_white shadow radius contact-form-wrap'>
          <h2 class='line_height_14 tcenter'>
            <span class='eng base_color fs_40 act inup'>Mail Form</span><br>
            <span class='bold fs_35 fs_sp25'>お問い合わせフォーム</span>
          </h2>

          <div class='space_2 space_sp1'></div>

          <div class='mbox tcenter'>
            <p>
              通常3営業日以内に返信いたします。お急ぎの場合は、ページ下部の公式LINEからのご相談もご利用ください。<br>
              ※営業・勧誘目的の送信はご遠慮ください。
            </p>
          </div>

          <div class='space_3 space_sp1'></div>

          <form id='mailform' class='form type_s' method='post' enctype='multipart/form-data' action='mailform/send.php' onsubmit='return sendmail(this);'>
            <input type='hidden' name='form_type' value='contact'>
            <input type='hidden' name='form_started_at' value='<?php echo time(); ?>'>
            <div style='position:absolute;left:-9999px;width:1px;height:1px;overflow:hidden;' aria-hidden='true'>
              <label>この欄は入力しないでください
                <input type='text' name='website_url' value='' tabindex='-1' autocomplete='off'>
              </label>
            </div>

            <dl>

              <dt>ご相談内容<span>必須</span></dt>
              <dd>
                <label class='checkbox_text'><input type='checkbox' name='ご相談内容(必須)[]' value='チラシ・フライヤー制作'>チラシ・フライヤー制作</label>
                <label class='checkbox_text'><input type='checkbox' name='ご相談内容(必須)[]' value='名刺・ショップカード制作'>名刺・ショップカード制作</label>
                <label class='checkbox_text'><input type='checkbox' name='ご相談内容(必須)[]' value='シール・印刷物制作'>シール・印刷物制作</label>
                <label class='checkbox_text'><input type='checkbox' name='ご相談内容(必須)[]' value='ブログ・ホームページ制作'>ブログ・ホームページ制作</label>
                <label class='checkbox_text'><input type='checkbox' name='ご相談内容(必須)[]' value='更新・運用サポート'>更新・運用サポート</label>
                <label class='checkbox_text'><input type='checkbox' name='ご相談内容(必須)[]' value='まずは相談したい'>まずは相談したい</label>
                <p class='contact-error-message' data-error-for='consultation'>ご相談内容を1つ以上選択してください。</p>
              </dd>
              <dt>お名前<span>必須</span></dt>
              <dd>
                <input type='text' class='textarea' name='お名前(必須)' size='70' placeholder='例：山田太郎' required data-contact-required>
              </dd>

              <dt>屋号・会社名<span class='nini'>任意</span></dt>
              <dd>
                <input type='text' class='textarea' name='屋号・会社名' size='70' placeholder='例：〇〇店'>
              </dd>

              <dt>メールアドレス<span>必須</span></dt>
              <dd>
                <input type='email' class='textarea' name='email(必須)' size='70' placeholder='例：info@〇〇.com' required data-contact-required>
              </dd>

              <dt>電話番号<span class='nini'>任意</span></dt>
              <dd>
                <input type='tel' class='textarea' name='電話番号' size='70' placeholder='例：090-0000-0000'>
              </dd>

              <dt>ご希望の連絡方法<span class='nini'>任意</span></dt>
              <dd>
                <label class='radio_text'><input type='radio' name='ご希望の連絡方法' value='メール' checked>メール</label>
                <label class='radio_text'><input type='radio' name='ご希望の連絡方法' value='電話'>電話</label>
                <label class='radio_text'><input type='radio' name='ご希望の連絡方法' value='LINE'>LINE</label>
              </dd>

              <dt>ご予算感<span class='nini'>任意</span></dt>
              <dd>
                <select class='dropdown' name='ご予算感'>
                  <option value=''>選択してください</option>
                  <option value='まずは相談したい'>まずは相談したい</option>
                  <option value='3万円未満'>3万円未満</option>
                  <option value='3万円〜5万円'>3万円〜5万円</option>
                  <option value='5万円〜10万円'>5万円〜10万円</option>
                  <option value='10万円以上'>10万円以上</option>
                </select>
              </dd>

              <dt>お問い合わせ内容<span>必須</span></dt>
              <dd>
                <textarea name='お問い合わせ内容(必須)' rows='10' cols='75' placeholder='ご相談内容、制作したいもの、現在困っていること、希望納期などをご自由にご記入ください。' required data-contact-required></textarea>
              </dd>
            </dl>

            <button class='formbutton' type='submit' value='送信する'>送信する</button>
          </form>
        </div>
      </div>
    </div>
  </section>

</div>

<?php include 'footer.php'; ?>
