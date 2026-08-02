<?php
$dr_page_title_key = strtolower(trim((string) ($page_title_eng ?? '')));
$dr_page_title_variants = [
    '404' => [
        'icon' => 'fa-solid fa-triangle-exclamation',
        'left' => '53.webp',
        'right' => '52.webp',
    ],
    'about us' => [
        'icon' => 'fa-solid fa-cat',
        'left' => '49.webp',
        'right' => '48.webp',
    ],
    'contact' => [
        'icon' => 'fa-solid fa-envelope',
        'left' => '57.webp',
        'right' => '56.webp',
    ],
    'portfolio' => [
        'icon' => 'fa-solid fa-images',
        'left' => '69.webp',
        'right' => '41.webp',
    ],
    'works archive' => [
        'icon' => 'fa-solid fa-images',
        'left' => '69.webp',
        'right' => '41.webp',
    ],
    'column' => [
        'icon' => 'fa-solid fa-lightbulb',
        'left' => '61.webp',
        'right' => '58.webp',
    ],
    'archive' => [
        'icon' => 'fa-solid fa-box-archive',
        'left' => '61.webp',
        'right' => '58.webp',
    ],
    'news' => [
        'icon' => 'fa-solid fa-newspaper',
        'left' => '61.webp',
        'right' => '58.webp',
    ],
    'faq' => [
        'icon' => 'fa-solid fa-circle-question',
        'left' => '09.webp',
        'right' => '07.webp',
    ],
    'law' => [
        'icon' => 'fa-solid fa-file-contract',
        'left' => '15.webp',
        'right' => '14.webp',
    ],
    'privacy policy' => [
        'icon' => 'fa-solid fa-shield-halved',
        'left' => '15.webp',
        'right' => '14.webp',
    ],
    'profile' => [
        'icon' => 'fa-solid fa-user-pen',
        'left' => '49.webp',
        'right' => '48.webp',
    ],
    'service design' => [
        'icon' => 'fa-solid fa-pen-ruler',
        'left' => '70.webp',
        'right' => '03.webp',
    ],
    'voice' => [
        'icon' => 'fa-solid fa-comments',
        'left' => '42.webp',
        'right' => '41.webp',
    ],
];

$dr_page_title_variant = $dr_page_title_variants[$dr_page_title_key] ?? [
    'icon' => 'fa-solid fa-paw',
    'left' => '42.webp',
    'right' => '41.webp',
];

$dr_page_title_icon = $page_title_icon ?? $dr_page_title_variant['icon'];
$dr_page_title_left = $page_title_sticker_left ?? $dr_page_title_variant['left'];
$dr_page_title_right = $page_title_sticker_right ?? $dr_page_title_variant['right'];
$dr_sticker_directory = rtrim((string) ($img ?? 'images'), '/') . '/sticker/';
$dr_page_title_id = 'dr-page-title-' . substr(md5((string) ($page_title_eng ?? $page_title ?? 'page')), 0, 8);

$dr_page_title_escape = static function ($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};
?>
<section class="dr_page_title" aria-labelledby="<?= $dr_page_title_escape($dr_page_title_id); ?>">
    <div class="dr_page_title_pattern" aria-hidden="true"></div>

    <img
        class="dr_page_title_mascot dr_page_title_mascot_left"
        src="<?= $dr_page_title_escape($dr_sticker_directory . $dr_page_title_left); ?>"
        alt=""
        width="200"
        height="200">

    <div class="dr_page_title_inner">
        <span class="dr_page_title_icon" aria-hidden="true">
            <i class="<?= $dr_page_title_escape($dr_page_title_icon); ?>"></i>
        </span>
        <p class="dr_page_title_eng" lang="en"><?= $dr_page_title_escape($page_title_eng ?? ''); ?></p>
        <h1 class="dr_page_title_jp" id="<?= $dr_page_title_escape($dr_page_title_id); ?>"><?= $dr_page_title_escape($page_title ?? ''); ?></h1>

        <nav class="dr_page_title_breadcrumb" aria-label="パンくずリスト">
            <ol>
                <li><a href="./">ホーム</a></li>
                <li aria-current="page"><?= $dr_page_title_escape($page_title ?? ''); ?></li>
            </ol>
        </nav>
    </div>

    <img
        class="dr_page_title_mascot dr_page_title_mascot_right"
        src="<?= $dr_page_title_escape($dr_sticker_directory . $dr_page_title_right); ?>"
        alt=""
        width="200"
        height="200">
</section>
