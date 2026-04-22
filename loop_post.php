<?php
/**
 * 記事ループ共通テンプレート (loop_post.php)
 *
 * include 前に以下の変数をセットしてください。
 *
 * 必須:
 *   $loop_posts          array   投稿オブジェクトの配列
 *   $loop_type           string  デフォルトの entry type ('blog' | 'works')
 *
 * 任意:
 *   $loop_ul_class       string  <ul> に付与するクラス (デフォルト: 'post_list_card grid set4 sp2 gap1')
 *   $loop_show_desc      bool    説明文(description)を表示するか (デフォルト: true)
 *   $loop_empty_message  string  投稿が0件時のメッセージ (空文字なら非表示)
 */

// デフォルト値の設定
$loop_ul_class      = isset($loop_ul_class)      ? $loop_ul_class      : 'post_list_card grid set4 sp2 gap1';
$loop_show_desc     = isset($loop_show_desc)      ? $loop_show_desc     : true;
$loop_empty_message = isset($loop_empty_message)  ? $loop_empty_message : '';

// --- いいね数・閲覧数をJSONから一括読み込み（1ページに複数回 include されてもファイルI/Oは1回） ---
if (!isset($GLOBALS['_loop_likes_data'])) {
    $GLOBALS['_loop_likes_data'] = [];
    $_likes_file = __DIR__ . '/data/likes.json';
    if (file_exists($_likes_file)) {
        $_likes_json = file_get_contents($_likes_file);
        $_likes_decoded = json_decode($_likes_json, true);
        if (is_array($_likes_decoded)) {
            $GLOBALS['_loop_likes_data'] = $_likes_decoded;
        }
    }
    unset($_likes_file, $_likes_json, $_likes_decoded);
}
if (!isset($GLOBALS['_loop_pv_data'])) {
    $GLOBALS['_loop_pv_data'] = [];
    $_pv_file = __DIR__ . '/data/pv.json';
    if (file_exists($_pv_file)) {
        $_pv_json = file_get_contents($_pv_file);
        $_pv_decoded = json_decode($_pv_json, true);
        if (is_array($_pv_decoded)) {
            $GLOBALS['_loop_pv_data'] = $_pv_decoded;
        }
    }
    unset($_pv_file, $_pv_json, $_pv_decoded);
}
?>

<?php if (!empty($loop_posts)): ?>
  <ul class="<?php echo htmlspecialchars($loop_ul_class, ENT_QUOTES, 'UTF-8'); ?>">
    <?php foreach ($loop_posts as $loop_post): ?>
      <?php
      // --- 公開日 ---
      $loop_date_source = !empty($loop_post->publishedAt)
          ? $loop_post->publishedAt
          : (!empty($loop_post->createdAt) ? $loop_post->createdAt : '');
      $loop_timestamp = ($loop_date_source !== '') ? strtotime($loop_date_source) : false;
      $loop_date_attr = $loop_timestamp ? date('Y-m-d', $loop_timestamp) : '';
      $loop_date_text = $loop_timestamp ? date('Y.m.d', $loop_timestamp) : '-';

      // --- 更新日 ---
      $loop_updated_source = !empty($loop_post->updatedAt) ? $loop_post->updatedAt : '';
      $loop_updated_ts = ($loop_updated_source !== '') ? strtotime($loop_updated_source) : $loop_timestamp;
      $loop_updated_attr = $loop_updated_ts ? date('Y-m-d', $loop_updated_ts) : '';
      $loop_updated_text = $loop_updated_ts ? date('Y.m.d', $loop_updated_ts) : '-';

      // --- いいね数・閲覧数 ---
      $loop_eid = isset($loop_post->id) ? $loop_post->id : '';
      $loop_like_count = isset($GLOBALS['_loop_likes_data'][$loop_eid]) ? (int)$GLOBALS['_loop_likes_data'][$loop_eid] : 0;
      $loop_pv_count   = isset($GLOBALS['_loop_pv_data'][$loop_eid])   ? (int)$GLOBALS['_loop_pv_data'][$loop_eid]   : 0;

      // --- 説明文 ---
      $loop_description = '';
      if ($loop_show_desc) {
          foreach (['description', 'summary', 'excerpt'] as $loop_key) {
              if (isset($loop_post->{$loop_key}) && trim(strip_tags((string)$loop_post->{$loop_key})) !== '') {
                  $loop_description = trim(strip_tags((string)$loop_post->{$loop_key}));
                  break;
              }
          }
          if ($loop_description === '') {
              $loop_plain = trim(preg_replace('/\s+/u', ' ', strip_tags((string)($loop_post->content ?? ''))));
              if (function_exists('mb_substr') && function_exists('mb_strlen')) {
                  $loop_description = mb_substr($loop_plain, 0, 80, 'UTF-8');
                  if (mb_strlen($loop_plain, 'UTF-8') > 80) {
                      $loop_description .= '...';
                  }
              } else {
                  $loop_description = substr($loop_plain, 0, 80);
                  if (strlen($loop_plain) > 80) {
                      $loop_description .= '...';
                  }
              }
          }
      }

      // --- entry type（投稿ごとに _entry_type があればそちらを優先） ---
      $loop_post_type = (!empty($loop_post->_entry_type))
          ? $loop_post->_entry_type
          : $loop_type;
      ?>
      <li>
        <a href='entry.php?type=<?php echo urlencode($loop_post_type); ?>&eid=<?php echo urlencode($loop_post->id); ?>'>
          <figure class="img">
            <?php if (isset($loop_post->thumbnail->url)): ?>
              <img src="<?php echo htmlspecialchars($loop_post->thumbnail->url, ENT_QUOTES, 'UTF-8'); ?>?w=200"
                   alt="<?php echo htmlspecialchars($loop_post->title, ENT_QUOTES, 'UTF-8'); ?>"
                   loading="lazy">
            <?php else: ?>
              <img src="<?php echo $img; ?>/no-img.webp"
                   alt="<?php echo htmlspecialchars($loop_post->title, ENT_QUOTES, 'UTF-8'); ?>"
                   loading="lazy">
            <?php endif; ?>
          </figure>
          <div class="detail">
            <div class="title">
              <?php echo htmlspecialchars($loop_post->title, ENT_QUOTES, 'UTF-8'); ?>
            </div>
            <?php if ($loop_show_desc && $loop_description !== ''): ?>
              <div class="text">
                <?php echo htmlspecialchars($loop_description, ENT_QUOTES, 'UTF-8'); ?>
              </div>
            <?php endif; ?>
            <div class="post_meta">
              <span class="post_meta_item"><i class="fas fa-heart"></i><?php echo $loop_like_count; ?></span>
              <span class="post_meta_item"><i class="fas fa-eye"></i><?php echo $loop_pv_count; ?></span>
              <time class="post_meta_item" itemprop="datePublished" datetime="<?php echo $loop_date_attr; ?>"><i class="far fa-clock"></i><?php echo htmlspecialchars($loop_date_text, ENT_QUOTES, 'UTF-8'); ?></time>
              <time class="post_meta_item" itemprop="dateModified" datetime="<?php echo $loop_updated_attr; ?>"><i class="fas fa-undo-alt"></i><?php echo htmlspecialchars($loop_updated_text, ENT_QUOTES, 'UTF-8'); ?></time>
            </div>
          </div>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php elseif ($loop_empty_message !== ''): ?>
  <p class="tcenter"><?php echo htmlspecialchars($loop_empty_message, ENT_QUOTES, 'UTF-8'); ?></p>
<?php endif; ?>

<?php
// 変数をクリーンアップ（呼び出し元の変数空間を汚さない）
unset($loop_ul_class, $loop_show_desc, $loop_empty_message);
unset($loop_date_source, $loop_timestamp, $loop_date_attr, $loop_date_text);
unset($loop_updated_source, $loop_updated_ts, $loop_updated_attr, $loop_updated_text);
unset($loop_eid, $loop_like_count, $loop_pv_count);
unset($loop_description, $loop_key, $loop_plain, $loop_post_type);
?>
