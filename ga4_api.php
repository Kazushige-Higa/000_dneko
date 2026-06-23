<?php
/**
 * GA4 ダッシュボード用 データ取得 API (ga4_api.php)
 *
 * Google Analytics 4 Data API (REST) からレポートデータを取得して JSON で返します。
 * Composer / gRPC 不要。PHP の openssl + cURL のみで動作するため、
 * ロリポップ等の共有レンタルサーバーでも利用できます。
 *
 * 仕組み:
 *   1. サービスアカウントの秘密鍵(JSON)で JWT を作成し RS256 署名
 *   2. JWT を Google のトークンendpointに送り、アクセストークンを取得(キャッシュ)
 *   3. GA4 Data API (batchRunReports) を呼び出してレポートを取得
 *   4. 整形した結果を data/ga4/cache.json にキャッシュして JSON 返却
 *
 * 使い方:
 *   GET ga4_api.php            … キャッシュがあればキャッシュ、無ければAPI取得
 *   GET ga4_api.php?refresh=1  … キャッシュを無視して強制再取得
 *
 * 事前準備:
 *   - data/ga4/service_account.json にサービスアカウント鍵を配置
 *   - 下の $GA4_PROPERTY_ID を自分のプロパティIDに設定
 */

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

/* ===================== 設定 ===================== */
$GA4_PROPERTY_ID = '415494708';                                   // GA4 プロパティ ID
$GA4_KEY_FILE    = __DIR__ . '/data/ga4/service_account.json';    // サービスアカウント鍵
$GA4_CACHE_DIR   = __DIR__ . '/data/ga4';                         // キャッシュ保存先
$CACHE_TTL       = 3600;                                          // キャッシュ有効秒数(1時間)
/* ================================================ */

$cache_file = $GA4_CACHE_DIR . '/cache.json';
$token_file = $GA4_CACHE_DIR . '/token.json';

// data/ga4 ディレクトリが無ければ作成
if (!is_dir($GA4_CACHE_DIR)) {
    @mkdir($GA4_CACHE_DIR, 0755, true);
}

/* ---------- キャッシュ応答 ---------- */
$force = isset($_GET['refresh']) && $_GET['refresh'] == '1';
if (!$force && file_exists($cache_file) && (time() - filemtime($cache_file) < $CACHE_TTL)) {
    echo file_get_contents($cache_file);
    exit;
}

/* ---------- メイン処理 ---------- */
try {
    $token = ga4_get_access_token($GA4_KEY_FILE, $token_file);
    $data  = ga4_build_dashboard($GA4_PROPERTY_ID, $token);
    $data['generated_at'] = date('c');
    $json = json_encode($data, JSON_UNESCAPED_UNICODE);

    // キャッシュ書き込み(失敗してもレスポンスは返す)
    @file_put_contents($cache_file, $json, LOCK_EX);

    echo $json;
} catch (Exception $e) {
    http_response_code(500);
    // エラー時、古いキャッシュがあればそれを返す(フォールバック)
    if (file_exists($cache_file)) {
        $stale = json_decode(file_get_contents($cache_file), true);
        if (is_array($stale)) {
            $stale['stale'] = true;
            $stale['error'] = $e->getMessage();
            echo json_encode($stale, JSON_UNESCAPED_UNICODE);
            exit;
        }
    }
    echo json_encode(['error' => $e->getMessage()], JSON_UNESCAPED_UNICODE);
}
exit;


/* ==================================================================
 * 認証: サービスアカウント鍵 → アクセストークン
 * ================================================================== */
function ga4_get_access_token($key_file, $token_file)
{
    // 有効なキャッシュ済みトークンがあれば使う
    if (file_exists($token_file)) {
        $t = json_decode(file_get_contents($token_file), true);
        if (is_array($t) && isset($t['access_token'], $t['expires_at']) && $t['expires_at'] > time() + 60) {
            return $t['access_token'];
        }
    }

    if (!file_exists($key_file)) {
        throw new Exception('サービスアカウント鍵が見つかりません: ' . $key_file);
    }
    $key = json_decode(file_get_contents($key_file), true);
    if (!is_array($key) || empty($key['client_email']) || empty($key['private_key'])) {
        throw new Exception('サービスアカウント鍵の形式が不正です');
    }

    $now = time();
    $header = ['alg' => 'RS256', 'typ' => 'JWT'];
    $claim  = [
        'iss'   => $key['client_email'],
        'scope' => 'https://www.googleapis.com/auth/analytics.readonly',
        'aud'   => 'https://oauth2.googleapis.com/token',
        'iat'   => $now,
        'exp'   => $now + 3600,
    ];

    $segments = [
        ga4_b64url(json_encode($header)),
        ga4_b64url(json_encode($claim)),
    ];
    $signing_input = implode('.', $segments);

    $signature = '';
    if (!openssl_sign($signing_input, $signature, $key['private_key'], 'sha256')) {
        throw new Exception('JWTの署名に失敗しました(openssl)');
    }
    $jwt = $signing_input . '.' . ga4_b64url($signature);

    // トークン交換
    $res = ga4_http_post(
        'https://oauth2.googleapis.com/token',
        http_build_query([
            'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
            'assertion'  => $jwt,
        ]),
        ['Content-Type: application/x-www-form-urlencoded']
    );
    $tok = json_decode($res, true);
    if (!is_array($tok) || empty($tok['access_token'])) {
        throw new Exception('アクセストークンの取得に失敗しました: ' . $res);
    }

    // トークンをキャッシュ
    @file_put_contents($token_file, json_encode([
        'access_token' => $tok['access_token'],
        'expires_at'   => $now + (int)($tok['expires_in'] ?? 3600),
    ]), LOCK_EX);

    return $tok['access_token'];
}


/* ==================================================================
 * GA4 Data API を呼び出してダッシュボード用データを組み立てる
 * ================================================================== */
function ga4_build_dashboard($property_id, $token)
{
    $base = 'https://analyticsdata.googleapis.com/v1beta/properties/' . $property_id;
    $auth = ['Authorization: Bearer ' . $token, 'Content-Type: application/json'];

    $cur  = [['startDate' => '30daysAgo', 'endDate' => 'yesterday']];
    $comp = [
        ['startDate' => '30daysAgo', 'endDate' => 'yesterday', 'name' => 'current'],
        ['startDate' => '60daysAgo', 'endDate' => '31daysAgo', 'name' => 'previous'],
    ];

    /* ---- バッチ1: KPI合計(当月/前月), PV推移, 流入元, デバイス, 人気ページ ---- */
    $batch1 = ['requests' => [
        // 0: KPI(2期間)
        [
            'dateRanges' => $comp,
            'metrics' => [
                ['name' => 'screenPageViews'],
                ['name' => 'totalUsers'],
                ['name' => 'sessions'],
                ['name' => 'averageSessionDuration'],
                ['name' => 'keyEvents'],
            ],
        ],
        // 1: PV推移(日別)
        [
            'dateRanges' => $cur,
            'dimensions' => [['name' => 'date']],
            'metrics' => [['name' => 'screenPageViews']],
            'orderBys' => [['dimension' => ['dimensionName' => 'date']]],
        ],
        // 2: 流入元
        [
            'dateRanges' => $cur,
            'dimensions' => [['name' => 'sessionDefaultChannelGroup']],
            'metrics' => [['name' => 'sessions']],
            'orderBys' => [['metric' => ['metricName' => 'sessions'], 'desc' => true]],
            'limit' => 6,
        ],
        // 3: デバイス
        [
            'dateRanges' => $cur,
            'dimensions' => [['name' => 'deviceCategory']],
            'metrics' => [['name' => 'totalUsers']],
            'orderBys' => [['metric' => ['metricName' => 'totalUsers'], 'desc' => true]],
        ],
        // 4: 人気ページ
        [
            'dateRanges' => $cur,
            'dimensions' => [['name' => 'pagePath'], ['name' => 'pageTitle']],
            'metrics' => [['name' => 'screenPageViews']],
            'orderBys' => [['metric' => ['metricName' => 'screenPageViews'], 'desc' => true]],
            'limit' => 10,
        ],
    ]];

    /* ---- バッチ2: 男女比, 年齢, 地域 ---- */
    $batch2 = ['requests' => [
        // 0: 男女比
        [
            'dateRanges' => $cur,
            'dimensions' => [['name' => 'userGender']],
            'metrics' => [['name' => 'totalUsers']],
        ],
        // 1: 年齢層
        [
            'dateRanges' => $cur,
            'dimensions' => [['name' => 'userAgeBracket']],
            'metrics' => [['name' => 'totalUsers']],
            'orderBys' => [['dimension' => ['dimensionName' => 'userAgeBracket']]],
        ],
        // 2: 地域(日本の都道府県 TOP10)
        [
            'dateRanges' => $cur,
            'dimensions' => [['name' => 'region']],
            'metrics' => [['name' => 'totalUsers']],
            'dimensionFilter' => [
                'filter' => [
                    'fieldName' => 'country',
                    'stringFilter' => ['value' => 'Japan'],
                ],
            ],
            'orderBys' => [['metric' => ['metricName' => 'totalUsers'], 'desc' => true]],
            'limit' => 10,
        ],
    ]];

    $r1 = json_decode(ga4_http_post($base . ':batchRunReports', json_encode($batch1), $auth), true);
    $r2 = json_decode(ga4_http_post($base . ':batchRunReports', json_encode($batch2), $auth), true);

    if (isset($r1['error'])) throw new Exception('GA4 APIエラー: ' . json_encode($r1['error'], JSON_UNESCAPED_UNICODE));
    if (isset($r2['error'])) throw new Exception('GA4 APIエラー: ' . json_encode($r2['error'], JSON_UNESCAPED_UNICODE));

    $rep1 = $r1['reports'] ?? [];
    $rep2 = $r2['reports'] ?? [];

    /* ---- KPI 合計の組み立て ---- */
    $kpi_rows = $rep1[0]['rows'] ?? [];
    // dateRange ごとに metricValues が並ぶ。dateRanges_name で判別する。
    $cur_m = ['pv' => 0, 'users' => 0, 'sessions' => 0, 'dur' => 0, 'key' => 0];
    $prev_m = $cur_m;
    foreach ($kpi_rows as $row) {
        // 比較レポートでは dimensionValues に dateRange 名が入る
        $rangeName = $row['dimensionValues'][0]['value'] ?? 'date_range_0';
        $mv = $row['metricValues'];
        $vals = [
            'pv'       => (float)($mv[0]['value'] ?? 0),
            'users'    => (float)($mv[1]['value'] ?? 0),
            'sessions' => (float)($mv[2]['value'] ?? 0),
            'dur'      => (float)($mv[3]['value'] ?? 0),
            'key'      => (float)($mv[4]['value'] ?? 0),
        ];
        if ($rangeName === 'previous' || $rangeName === 'date_range_1') {
            $prev_m = $vals;
        } else {
            $cur_m = $vals;
        }
    }

    $cvr_cur  = $cur_m['sessions']  > 0 ? $cur_m['key']  / $cur_m['sessions']  * 100 : 0;
    $cvr_prev = $prev_m['sessions'] > 0 ? $prev_m['key'] / $prev_m['sessions'] * 100 : 0;

    $kpi = [
        'pv' => [
            'value'  => (int)$cur_m['pv'],
            'change' => ga4_pct_change($cur_m['pv'], $prev_m['pv']),
        ],
        'users' => [
            'value'  => (int)$cur_m['users'],
            'change' => ga4_pct_change($cur_m['users'], $prev_m['users']),
        ],
        'cvr' => [
            'value'  => round($cvr_cur, 2),
            'change' => round($cvr_cur - $cvr_prev, 2), // ポイント差
        ],
        'engagement' => [
            'seconds' => $cur_m['users'] > 0 ? $cur_m['dur'] : 0, // 平均セッション時間(秒)
            'change'  => ga4_pct_change($cur_m['dur'], $prev_m['dur']),
        ],
    ];

    /* ---- PV推移 ---- */
    $trend = ['labels' => [], 'data' => []];
    foreach (($rep1[1]['rows'] ?? []) as $row) {
        $d = $row['dimensionValues'][0]['value']; // yyyymmdd
        $trend['labels'][] = (int)substr($d, 4, 2) . '/' . (int)substr($d, 6, 2);
        $trend['data'][]   = (int)($row['metricValues'][0]['value'] ?? 0);
    }

    /* ---- 流入元 ---- */
    $source = ['labels' => [], 'data' => []];
    foreach (($rep1[2]['rows'] ?? []) as $row) {
        $source['labels'][] = $row['dimensionValues'][0]['value'];
        $source['data'][]   = (int)($row['metricValues'][0]['value'] ?? 0);
    }

    /* ---- デバイス ---- */
    $device = ['labels' => [], 'data' => []];
    foreach (($rep1[3]['rows'] ?? []) as $row) {
        $device['labels'][] = ucfirst($row['dimensionValues'][0]['value']);
        $device['data'][]   = (int)($row['metricValues'][0]['value'] ?? 0);
    }

    /* ---- 人気ページ ---- */
    $pages = [];
    foreach (($rep1[4]['rows'] ?? []) as $row) {
        $pages[] = [
            'path'  => $row['dimensionValues'][0]['value'],
            'title' => $row['dimensionValues'][1]['value'] ?: $row['dimensionValues'][0]['value'],
            'pv'    => (int)($row['metricValues'][0]['value'] ?? 0),
        ];
    }

    /* ---- 男女比 ---- */
    $gender_map = ['female' => '女性', 'male' => '男性', 'unknown' => '不明'];
    $gender = ['labels' => [], 'data' => []];
    foreach (($rep2[0]['rows'] ?? []) as $row) {
        $g = $row['dimensionValues'][0]['value'];
        $label = $gender_map[$g] ?? $g;
        if ($g === 'unknown') continue; // 不明は除外(男女比を見やすく)
        $gender['labels'][] = $label;
        $gender['data'][]   = (int)($row['metricValues'][0]['value'] ?? 0);
    }

    /* ---- 年齢層 ---- */
    $age = ['labels' => [], 'data' => []];
    foreach (($rep2[1]['rows'] ?? []) as $row) {
        $a = $row['dimensionValues'][0]['value'];
        if ($a === 'unknown') continue;
        $age['labels'][] = $a;
        $age['data'][]   = (int)($row['metricValues'][0]['value'] ?? 0);
    }

    /* ---- 地域 ---- */
    $region = [];
    foreach (($rep2[2]['rows'] ?? []) as $row) {
        $region[] = [
            'name'  => $row['dimensionValues'][0]['value'],
            'count' => (int)($row['metricValues'][0]['value'] ?? 0),
        ];
    }

    return [
        'kpi'     => $kpi,
        'trend'   => $trend,
        'source'  => $source,
        'device'  => $device,
        'gender'  => $gender,
        'age'     => $age,
        'region'  => $region,
        'pages'   => $pages,
        'period'  => '過去30日間',
    ];
}


/* ==================================================================
 * ヘルパー
 * ================================================================== */
function ga4_b64url($data)
{
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function ga4_pct_change($cur, $prev)
{
    if ($prev <= 0) return null;
    return round(($cur - $prev) / $prev * 100, 1);
}

function ga4_http_post($url, $body, $headers)
{
    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST           => true,
        CURLOPT_POSTFIELDS     => $body,
        CURLOPT_HTTPHEADER     => $headers,
        CURLOPT_TIMEOUT        => 30,
    ]);
    $res = curl_exec($ch);
    if ($res === false) {
        $err = curl_error($ch);
        curl_close($ch);
        throw new Exception('通信エラー: ' . $err);
    }
    curl_close($ch);
    return $res;
}
