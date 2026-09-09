<?php $is_website_footer_cta = isset($footer_contact_variant) && $footer_contact_variant === 'website_diagnosis'; ?>
<section>
  <div class="dr_contact">
  <div class="dr_contact_inner">
    <img class="dr_contact_mascots" src="images/home-renewal/deco-contact.jpg" alt="" loading="lazy">
    <div>
      <?php if ($is_website_footer_cta): ?>
        <p>いまのホームページ、これから作るホームページを一緒に整理します。</p>
        <h2><span>無料ホームページ診断</span>・ご相談</h2>
        <div class="dr_contact_actions">
          <a href="contact.php?consultation=website-diagnosis" data-ga-event="free_diagnosis_click" data-ga-location="footer_cta"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i> 無料診断を相談する</a>
          <a class="dr_contact_line" href="<?php echo htmlspecialchars($line, ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer" data-ga-event="line_click" data-ga-location="footer_cta"><i class="fa-brands fa-line" aria-hidden="true"></i> LINEで相談する</a>
        </div>
      <?php else: ?>
        <p>お気軽に<br class="dr_contact_mobile_break">ご相談ください。</p>
        <h2>お問い合わせ・<span>無料相談</span></h2>
        <a href="contact.php"><i class="fa-solid fa-envelope" aria-hidden="true"></i> メールで相談する</a>
      <?php endif; ?>
    </div>
  </div>
  </div>
</section>
