<?php
/**
 * いいねカウンター API (like_counter.php)
 *
 * GET  ?action=get&eid=xxx    → いいね数を返す (JSON)
 * POST ?action=like&eid=xxx   → いいね数を +1 して返す (JSON)
 *
 * データは data/likes.json に保存されます。
 */

header('Content-Type: application/json; charset=utf-8');

// データ保存先
$like_dir  = __DIR__ . '/data';
$like_file = $like_dir . '/likes.json';

// data ディレクトリが無ければ作成
if (!is_dir($like_dir)) {
    mkdir($like_dir, 0755, true);
}

// JSON ファイル読み込み
function likes_load($file)
{
    if (!file_exists($file)) {
        return [];
    }
    $json = file_get_contents($file);
    $data = json_decode($json, true);
    return is_array($data) ? $data : [];
}

// JSON ファイル書き込み（排他ロック付き）
function likes_save($file, $data)
{
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    file_put_contents($file, $json, LOCK_EX);
}

// パラメータ取得
$action = isset($_GET['action']) ? $_GET['action'] : '';
$eid    = isset($_GET['eid'])    ? trim($_GET['eid'])  : '';

if ($eid === '') {
    http_response_code(400);
    echo json_encode(['error' => 'eid is required']);
    exit;
}

$like_data = likes_load($like_file);

if ($action === 'like' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // いいね +1
    if (!isset($like_data[$eid])) {
        $like_data[$eid] = 0;
    }
    $like_data[$eid]++;
    likes_save($like_file, $like_data);

    echo json_encode(['eid' => $eid, 'count' => $like_data[$eid]]);
    exit;
}

if ($action === 'get') {
    // 現在値を返す
    $count = isset($like_data[$eid]) ? (int)$like_data[$eid] : 0;
    echo json_encode(['eid' => $eid, 'count' => $count]);
    exit;
}

http_response_code(400);
echo json_encode(['error' => 'Invalid action. Use action=get or action=like (POST)']);
