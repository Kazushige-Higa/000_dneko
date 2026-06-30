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
                'id'       => substr($vid, 0, 8) . '…',   // IDを短縮表示
                'score'    => $score,
                'tier'     => $t,
                'sessions' => (int)($v['sessions'] ?? 1),
                'last_seen'=> $v['last_seen'] ?? '',
                'top_pages'=> array_slice($v['top_pages'] ?? [], 0, 3),
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
$now   = time();
$today = date('Y-m-d', $now);

if ($vid === '' || $event === '') {
    http_response_code(400);
    echo json_encode(['error' => 'visitor_id and event required']);
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
    ];
} else {
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
