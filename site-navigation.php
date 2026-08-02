<?php
if (!function_exists('dneko_navigation_items')) {
  function dneko_navigation_items(string $line_url): array
  {
    return [
  [
    'label' => 'ホーム',
    'href' => './',
    'icon' => 'fa-solid fa-house',
    'children' => [
      ['label' => '制作実績', 'href' => 'entry_list.php?type=works'],
      ['label' => 'ブログ', 'href' => 'entry_list.php?type=blog'],
      ['label' => 'お役立ちコラム', 'href' => 'entry_list.php?type=column'],
    ],
  ],
  [
    'label' => 'サービス・料金について',
    'href' => 'about.php',
    'icon' => 'fa-solid fa-palette',
    'children' => [
      ['label' => 'チラシデザイン', 'href' => 'flyer-design.php'],
      // ホームページ制作ページへの導線は一時非表示
      ['label' => 'デジタルのネコの手', 'href' => 'service_digital.php'],
      ['label' => 'AI活用コンサルティング', 'href' => 'ai-consulting.php'],
    ],
  ],
  [
    'label' => 'デザネコについて',
    'href' => 'about.php',
    'icon' => 'fa-solid fa-cat',
    'children' => [
      ['label' => 'デザネコについて', 'href' => 'about.php'],
      ['label' => 'もじゃねこについて', 'href' => 'moja-cat.php'],
      ['label' => '制作者プロフィール', 'href' => 'profile.php'],
    ],
  ],
  [
    'label' => 'お客様の声',
    'href' => 'voice.php',
    'icon' => 'fa-solid fa-comment-dots',
    'children' => [
      ['label' => 'お客様の声一覧', 'href' => 'voice.php'],
      ['label' => '制作実績を見る', 'href' => 'entry_list.php?type=works'],
    ],
  ],
  [
    'label' => 'よくあるご質問',
    'href' => 'faq.php',
    'icon' => 'fa-solid fa-circle-question',
    'children' => [
      ['label' => 'よくあるご質問一覧', 'href' => 'faq.php'],
      ['label' => 'デジタルサポートについて', 'href' => 'service_digital.php'],
    ],
  ],
  [
    'label' => 'お問い合わせ・無料相談',
    'href' => 'contact.php',
    'icon' => 'fa-solid fa-envelope',
    'children' => [
      ['label' => 'メールで相談する', 'href' => 'contact.php'],
      [
        'label' => 'LINEで相談する',
        'href' => $line_url,
        'target_blank' => true,
      ],
    ],
  ],
    ];
  }
}

if (!function_exists('dneko_render_navigation')) {
  function dneko_render_navigation(array $items, string $list_class): void
  {
    echo '<ul class="' . htmlspecialchars($list_class, ENT_QUOTES, 'UTF-8') . '">';

    foreach ($items as $item) {
      $label = htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8');
      $href = htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8');
      $icon = htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8');

      echo '<li class="dr_nav_item">';
      echo '<a class="dr_nav_primary" href="' . $href . '">';
      echo '<i class="' . $icon . '" aria-hidden="true"></i>' . $label;
      echo '</a>';

      if (!empty($item['children'])) {
        echo '<ul class="dr_nav_dropdown">';
        foreach ($item['children'] as $child) {
          $child_label = htmlspecialchars($child['label'], ENT_QUOTES, 'UTF-8');
          $child_href = htmlspecialchars($child['href'], ENT_QUOTES, 'UTF-8');
          $target = !empty($child['target_blank']) ? ' target="_blank" rel="noopener noreferrer"' : '';
          echo '<li><a href="' . $child_href . '"' . $target . '>' . $child_label . '</a></li>';
        }
        echo '</ul>';
      }

      echo '</li>';
    }

    echo '</ul>';
  }
}
