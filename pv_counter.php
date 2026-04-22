<?php
/**
 * PV カウンター API (pv_counter.php)
 *
 * GET  ?action=get&eid=xxx          → 閲覧数を返す (JSON)
 * POST ?action=count&eid=xxx        → 閲覧数を +1 して返す (JSON)
 *
 * データは data/pv.json に保存されます。
 */

header('Content-Type: application/json; charset=utf-8');

// データ保存先
$pv_dir  = __DIR__ . '/data';
$pv_file = $pv_dir . '/pv.json';

// data ディレクトリが無ければ作成
if (!is_dir($pv_dir)) {
    mkdir($pv_dir, 0755, true);
}

// JSON ファイル読み込み
function pv_load($file)
{
    if (!file_exists($file)) {
        return [];
    }
    $json = file_get_contents($file);
    $data = json_decode($json, true);
    return is_array($data) ? $data : [];
}

// JSON ファイル書き込み（排他ロック付き）
function pv_save($file, $data)
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

$pv_data = pv_load($pv_file);

if ($action === 'count' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    // カウントアップ
    if (!isset($pv_data[$eid])) {
        $pv_data[$eid] = 0;
    }
    $pv_data[$eid]++;
    pv_save($pv_file, $pv_data);

    echo json_encode(['eid' => $eid, 'count' => $pv_data[$eid]]);
    exit;
}

if ($action === 'get') {
    // 現在値を返す
    $count = isset($pv_data[$eid]) ? (int)$pv_data[$eid] : 0;
    echo json_encode(['eid' => $eid, 'count' => $count]);
    exit;
}

http_response_code(400);
echo json_encode(['error' => 'Invalid action. Use action=get or action=count (POST)']);
