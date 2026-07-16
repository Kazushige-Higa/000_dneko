<?php
/**
 * visitor_tracker.php — 個別訪問者トラッキング API
 *
 * POST  { visitor_id, event, page, value }  → イベントを記録してスコアを返す
 * GET   ?action=stats                        → ダッシュボード用集計データを返す（内部のみ）
 *
 * データ: data/visitors.json
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: https://d-neko.com');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') { exit; }

/* ---- 設定 ---- */
define('VT_FILE',       __DIR__ . '/data/visitors.json');
define('VT_MAX_EVENTS', 200);   // 1訪問者あたりのイベント上限
define('VT_EXPIRE_DAYS', 90);   // この日数以上アクセスなしで削除

/* ---- スコア配点 ---- */
const SCORE_MAP = [
    'pageview'          => 1,
    'service_page'      => 10,   // サービス・実績ページ
    'voice_page'        => 8,    // お客様の声
    'law_page'          => 15,   // 特商法（購入意向高）
    'scroll_50'         => 3,
    'scroll_90'         => 5,
    'stay_60'           => 5,    // 60秒以上滞在
    'stay_120'          => 8,    // 120秒以上
    'revisit_7d'        => 10,   // 7日以内再訪
    'line_click'        => 30,
    'contact_click'     => 25,
    'contact_page'      => 25,
    'profile_page'      => 5,
    'works_page'        => 8,
];

/* ---- ティア判定 ---- */
function score_tier(int $score): array {
    if ($score >= 80) return ['tier' => 'hot',  'label' => '🔥 Hot',  'color' => '#ef4444'];
    if ($score >= 50) return ['tier' => 'warm', 'label' => '☀️ Warm', 'color' => '#f59e0b'];
    if ($score >= 20) return ['tier' => 'cool', 'label' => '🌡️ Cool', 'color' => '#3b82f6'];
    return              ['tier' => 'cold', 'label' => '❄️ Cold', 'color' => '#94a3b8'];
}

/* ---- ファイル読み書き ---- */
function vt_load(): array {
    if (!file_exists(VT_FILE)) return [];
    $json = file_get_contents(VT_FILE);
    $data = json_decode($json, true);
    return is_array($data) ? $data : [];
}

function vt_save(array $data): void {
    $dir = dirname(VT_FILE);
    if (!is_dir($dir)) mkdir($dir, 0755, true);
    file_put_contents(VT_FILE, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE), LOCK_EX);
}

/* ---- 期限切れ訪問者を削除 ---- */
function vt_cleanup(array &$data): void {
    $threshold = time() - (VT_EXPIRE_DAYS * 86400);
    foreach ($data as $vid => $v) {
        if (($v['last_seen_ts'] ?? 0) < $threshold) {
            unset($data[$vid]);
        }
    }
}

/* ================================================================
 * 行動属性ヘルパー（匿名のまま「どんな見込み客か」を把握する用途）
 *   ※ 個人特定はしない。IPは地域推定のみに使い、生IPは保存しない。
 * ================================================================ */

/* 訪問者IP（プロキシ経由を考慮） */
function vt_client_ip(): string {
    foreach (['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'] as $k) {
        if (!empty($_SERVER[$k])) {
            $ip = trim(explode(',', $_SERVER[$k])[0]);
            if (filter_var($ip, FILTER_VALIDATE_IP)) return $ip;
        }
    }
    return '';
}

/* IP → 大まかな地域（市区町村レベル）。失敗時は null。生IPは保存しない。 */
function vt_geo_lookup(string $ip): ?array {
    if ($ip === '' || !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
        return null;
    }
    $url = 'http://ip-api.com/json/' . urlencode($ip) . '?fields=status,country,regionName,city&lang=ja';
    $ch  = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT        => 2,
        CURLOPT_CONNECTTIMEOUT => 2,
    ]);
    $res = curl_exec($ch);
    curl_close($ch);
    if (!$res) return null;
    $j = json_decode($res, true);
    if (!is_array($j) || ($j['status'] ?? '') !== 'success') return null;
    return [
        'city'    => $j['city'] ?? '',
        'region'  => $j['regionName'] ?? '',
        'country' => $j['country'] ?? '',
    ];
}

/* geo配列 → 表示用ラベル */
function vt_geo_label($geo): string {
    if (!is_array($geo)) return '地域不明';
    $parts = array_filter([$geo['region'] ?? '', $geo['city'] ?? '']);
    if (!$parts) return ($geo['country'] ?? '') ?: '地域不明';
    return implode(' ', $parts);
}

/* リファラ → 流入元ラベル（初回のみ有効） */
function vt_classify_source(string $ref): string {
    if ($ref === '') return '直接/ブックマーク';
    $host = strtolower(parse_url($ref, PHP_URL_HOST) ?: '');
    if ($host === '' ) return '直接/ブックマーク';
    if (strpos($host, 'd-neko.com') !== false) return '直接/ブックマーク'; // 内部遷移
    $map = [
        'google.'    => 'Google検索', 'bing.' => 'Bing検索', 'yahoo.' => 'Yahoo検索',
        'duckduckgo' => 'DuckDuckGo検索',
        'instagram.' => 'Instagram', 'cktrack' => 'Instagram',
        'facebook.'  => 'Facebook', 'fb.'     => 'Facebook',
        't.co'       => 'X(Twitter)', 'twitter.' => 'X(Twitter)', '//x.com' => 'X(Twitter)',
        'youtube.'   => 'YouTube', 'youtu.be' => 'YouTube',
        'line.'      => 'LINE', 'lin.ee'   => 'LINE',
        'tiktok.'    => 'TikTok',
        'note.com'   => 'note', 'ameblo'   => 'アメブロ',
    ];
    foreach ($map as $needle => $label) {
        if (strpos($host, ltrim($needle, '/')) !== false) return $label;
    }
    return 'その他サイト';
}

/* User-Agent → デバイス種別 */
function vt_device(string $ua): string {
    if ($ua === '') return '不明';
    if (preg_match('/iPad|Tablet|Nexus 7|Nexus 10/i', $ua)) return 'タブレット';
    if (preg_match('/Mobile|Android|iPhone|iPod|Windows Phone/i', $ua)) return 'モバイル';
    return 'PC';
}

/* 閲覧履歴 → 行動ラベル（購入検討度の傾向を要約） */
function vt_behavior_label(array $v): string {
    $joined = implode(' ', array_column($v['top_pages'] ?? [], 'p'));
    $tags = [];
    if (preg_match('#/law#', $joined))                       $tags[] = '料金・特商法確認';
    if (preg_match('#/contact#', $joined))                   $tags[] = 'お問い合わせ接近';
    if (preg_match('#/voice#', $joined))                     $tags[] = 'お客様の声';
    if (preg_match('#/(service|works|entry)#', $joined))     $tags[] = '実績重視';
    if (preg_match('#/profile#', $joined))                   $tags[] = 'プロフィール確認';
    return $tags ? implode('・', array_slice($tags, 0, 3)) : '閲覧中心';
}

/* ================================================================
 * GET ?action=stats  — ダッシュボード用集計（内部IP制限なし、認証不要）
 * ================================================================ */
if ($_SERVER['REQUEST_METHOD'] === 'GET' && ($_GET['action'] ?? '') === 'stats') {
    $data = vt_load();
    vt_cleanup($data);

    $dist  = ['hot' => 0, 'warm' => 0, 'cool' => 0, 'cold' => 0];
    $hot_list = [];
    $total_score = 0;
    $total_count = 0;

    foreach ($data as $vid => $v) {
        $score = (int)($v['score'] ?? 0);
        $t     = score_tier($score)['tier'];
        $dist[$t]++;
        $total_score += $score;
        $total_count++;
        if ($t === 'hot' || $t === 'warm') {
            $hot_list[] = [
                'id'        => substr($vid, 0, 8) . '…',   // IDを短縮表示
                'score'     => $score,
                'tier'      => $t,
                'sessions'  => (int)($v['sessions'] ?? 1),
                'last_seen' => $v['last_seen'] ?? '',
                'top_pages' => array_slice($v['top_pages'] ?? [], 0, 3),
                // ── 行動属性（匿名のまま「どんな見込み客か」を把握）──
                'source'     => $v['source'] ?? '不明',
                'device'     => $v['device'] ?? '不明',
                'region'     => vt_geo_label($v['geo'] ?? null),
                'first_seen' => $v['first_seen'] ?? '',
                'label'      => vt_behavior_label($v),
            ];
        }
    }

    usort($hot_list, fn($a, $b) => $b['score'] <=> $a['score']);
    $hot_list = array_slice($hot_list, 0, 15);

    echo json_encode([
        'total'      => $total_count,
        'avg_score'  => $total_count ? round($total_score / $total_count, 1) : 0,
        'dist'       => $dist,
        'hot_list'   => $hot_list,
    ]);
    exit;
}

/* ================================================================
 * POST — イベント記録
 * ================================================================ */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'POST required']);
    exit;
}

$body = json_decode(file_get_contents('php://input'), true);
if (!$body) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid JSON']);
    exit;
}

$vid   = preg_replace('/[^a-zA-Z0-9\-_]/', '', $body['visitor_id'] ?? '');
$event = preg_replace('/[^a-zA-Z0-9_]/', '', $body['event']      ?? '');
$page  = substr(strip_tags($body['page'] ?? ''), 0, 200);
$ref   = substr(strip_tags($body['ref'] ?? ''), 0, 300);   // 流入元判定用リファラ
$ua    = $_SERVER['HTTP_USER_AGENT'] ?? '';
$now   = time();
$today = date('Y-m-d', $now);

if ($vid === '' || $event === '') {
    http_response_code(400);
    echo json_encode(['error' => 'visitor_id and event required']);
    exit;
}

// アクセス解析ダッシュボード自身の閲覧はPV・熱量スコアに含めない。
if (strpos($page, '/analytics') === 0) {
    echo json_encode(['ignored' => true]);
    exit;
}

/* ---- スコア加算量を決定 ---- */
$add = SCORE_MAP[$event] ?? 0;

/* ---- データ読み込み ---- */
$data = vt_load();
vt_cleanup($data);

if (!isset($data[$vid])) {
    $data[$vid] = [
        'first_seen'    => date('c', $now),
        'first_seen_ts' => $now,
        'last_seen'     => date('c', $now),
        'last_seen_ts'  => $now,
        'sessions'      => 1,
        'last_session'  => $today,
        'score'         => 0,
        'events'        => [],
        'top_pages'     => [],
        // ── 行動属性（初回訪問時に確定）──
        'source'        => vt_classify_source($ref),   // 流入元（初回リファラ）
        'device'        => vt_device($ua),             // デバイス種別
        'geo'           => vt_geo_lookup(vt_client_ip()), // 地域（生IPは保存しない）
    ];
} else {
    // 既存訪問者の行動属性を補完（旧データ・未取得分のバックフィル）
    if (empty($data[$vid]['device']))                 $data[$vid]['device'] = vt_device($ua);
    if (!isset($data[$vid]['source']) || $data[$vid]['source'] === '') {
        $data[$vid]['source'] = vt_classify_source($ref);
    }
    if (!array_key_exists('geo', $data[$vid])) {
        $data[$vid]['geo'] = vt_geo_lookup(vt_client_ip());
    }
    // 再訪問判定
    $last_session = $data[$vid]['last_session'] ?? '';
    if ($last_session !== $today) {
        $data[$vid]['sessions'] = ($data[$vid]['sessions'] ?? 1) + 1;
        $data[$vid]['last_session'] = $today;

        $last_ts = $data[$vid]['last_seen_ts'] ?? 0;
        if ($now - $last_ts <= 7 * 86400 && $event === 'pageview') {
            $add += SCORE_MAP['revisit_7d'];
        }
    }
    $data[$vid]['last_seen']    = date('c', $now);
    $data[$vid]['last_seen_ts'] = $now;
}

/* ---- イベント記録 ---- */
$data[$vid]['score'] = ($data[$vid]['score'] ?? 0) + $add;

$events = $data[$vid]['events'] ?? [];
$events[] = [
    'e'  => $event,
    'p'  => $page,
    'ts' => $now,
    's'  => $add,
];
// 上限超えは古いものを切り詰め
if (count($events) > VT_MAX_EVENTS) {
    $events = array_slice($events, -VT_MAX_EVENTS);
}
$data[$vid]['events'] = $events;

/* ---- よく見たページ TOP5 更新 ---- */
if ($event === 'pageview' && $page !== '') {
    $tp = $data[$vid]['top_pages'] ?? [];
    $found = false;
    foreach ($tp as &$entry) {
        if ($entry['p'] === $page) { $entry['n']++; $found = true; break; }
    }
    unset($entry);
    if (!$found) $tp[] = ['p' => $page, 'n' => 1];
    usort($tp, fn($a, $b) => $b['n'] <=> $a['n']);
    $data[$vid]['top_pages'] = array_slice($tp, 0, 5);
}

/* ---- 保存 ---- */
vt_save($data);

/* ---- レスポンス ---- */
$score = (int)$data[$vid]['score'];
$tier_info = score_tier($score);
echo json_encode([
    'visitor_id' => $vid,
    'score'      => $score,
    'tier'       => $tier_info['tier'],
    'label'      => $tier_info['label'],
    'added'      => $add,
]);
