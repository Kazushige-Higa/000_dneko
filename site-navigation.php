<?php
if (!function_exists('dneko_navigation_items')) {
  function dneko_navigation_items(string $line_url, bool $website_diagnosis_context = false): array
  {
    $contact_label = $website_diagnosis_context ? '無料ホームページ診断' : 'お問い合わせ・無料相談';
    $contact_href = $website_diagnosis_context ? 'contact.php?consultation=website-diagnosis' : 'contact.php';
    $contact_children = $website_diagnosis_context
      ? [
        ['label' => '無料ホームページ診断', 'href' => 'contact.php?consultation=website-diagnosis'],
        ['label' => 'メールで相談する', 'href' => 'contact.php'],
      ]
      : [
        ['label' => 'メールで相談する', 'href' => 'contact.php'],
        ['label' => '無料ホームページ診断', 'href' => 'contact.php?consultation=website-diagnosis'],
      ];
    $contact_children[] = [
      'label' => 'LINEで相談する',
      'href' => $line_url,
      'target_blank' => true,
    ];

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
    'label' => 'ホームページ制作',
    'href' => 'service_blog.php',
    'icon' => 'fa-solid fa-laptop-code',
    'children' => [
      ['label' => '制作内容・料金', 'href' => 'service_blog.php'],
      ['label' => 'ホームページ制作実績', 'href' => 'works_archive.php'],
      ['label' => '無料ホームページ診断', 'href' => 'contact.php?consultation=website-diagnosis'],
    ],
  ],
  [
    'label' => 'その他のサービス',
    'href' => 'about.php',
    'icon' => 'fa-solid fa-palette',
    'children' => [
      ['label' => 'チラシデザイン', 'href' => 'flyer-design.php'],
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
      ['label' => '印刷デザインについて', 'href' => 'faq.php#print-design'],
      ['label' => 'ホームページデザインについて', 'href' => 'faq.php#website-design'],
      ['label' => '撮影について', 'href' => 'faq.php#photography'],
    ],
  ],
  [
    'label' => $contact_label,
    'href' => $contact_href,
    'icon' => 'fa-solid fa-envelope',
    'children' => $contact_children,
  ],
    ];
  }
}

if (!function_exists('dneko_render_navigation')) {
  function dneko_navigation_tracking_attributes(string $href, string $location): string
  {
    $event = '';
    if (strpos($href, 'website-diagnosis') !== false) {
      $event = 'free_diagnosis_click';
    } elseif (strpos($href, 'line.me/') !== false) {
      $event = 'line_click';
    } elseif (strpos($href, 'service_blog.php') !== false) {
      $event = 'web_service_click';
    } elseif (strpos($href, 'works_archive.php') !== false) {
      $event = 'web_works_click';
    }

    if ($event === '') {
      return '';
    }

    return ' data-ga-event="' . htmlspecialchars($event, ENT_QUOTES, 'UTF-8') . '" data-ga-location="' . htmlspecialchars($location, ENT_QUOTES, 'UTF-8') . '"';
  }

  function dneko_render_navigation(array $items, string $list_class): void
  {
    echo '<ul class="' . htmlspecialchars($list_class, ENT_QUOTES, 'UTF-8') . '">';

    foreach ($items as $item) {
      $label = htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8');
      $href = htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8');
      $icon = htmlspecialchars($item['icon'], ENT_QUOTES, 'UTF-8');
      $tracking = dneko_navigation_tracking_attributes((string)$item['href'], 'global_navigation');

      echo '<li class="dr_nav_item">';
      echo '<a class="dr_nav_primary" href="' . $href . '"' . $tracking . '>';
      echo '<i class="' . $icon . '" aria-hidden="true"></i>' . $label;
      echo '</a>';

      if (!empty($item['children'])) {
        echo '<ul class="dr_nav_dropdown">';
        foreach ($item['children'] as $child) {
          $child_label = htmlspecialchars($child['label'], ENT_QUOTES, 'UTF-8');
          $child_href = htmlspecialchars($child['href'], ENT_QUOTES, 'UTF-8');
          $target = !empty($child['target_blank']) ? ' target="_blank" rel="noopener noreferrer"' : '';
          $child_tracking = dneko_navigation_tracking_attributes((string)$child['href'], 'global_navigation_dropdown');
          echo '<li><a href="' . $child_href . '"' . $target . $child_tracking . '>' . $child_label . '</a></li>';
        }
        echo '</ul>';
      }

      echo '</li>';
    }

    echo '</ul>';
  }
}
