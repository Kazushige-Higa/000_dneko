# GA4 ダッシュボード セットアップ手順

`ga4_dashboard_prototype.html` を実データで動かすための設定手順です。
Google Cloud 側の準備（API有効化・サービスアカウント・JSONキー・GA4閲覧者追加）は完了済みです。

## 構成ファイル

| ファイル | 役割 |
|---|---|
| `ga4_dashboard_prototype.html` | ダッシュボード本体（`ga4_api.php` から実データを取得して表示） |
| `ga4_api.php` | GA4 Data API を呼び出して JSON を返すバックエンド |
| `data/ga4/.htaccess` | 認証情報・キャッシュを非公開にする設定 |
| `data/ga4/service_account.json` | **← あなたが配置する** サービスアカウント鍵 |

## セットアップ（3ステップ）

### 1. サービスアカウント鍵をサーバーにアップロード

ダウンロードした鍵ファイル（`project-4ad45ff5-f2da-4370-8b9-xxxxxxxx.json`）を、
サーバーの **`data/ga4/service_account.json`** という名前でアップロードします。

- 配置先パス: `（サイトルート）/data/ga4/service_account.json`
- ファイル名は必ず `service_account.json` に変更してください。
- `data/ga4/.htaccess` により、このファイルはブラウザから直接アクセスできません。

> ⚠️ この鍵はパスワード級の秘密情報です。GitHub や公開フォルダには置かないでください。
> Git で管理している場合は `.gitignore` に `data/ga4/service_account.json` を追加してください。

### 2. ファイルをアップロード

`ga4_api.php`、`ga4_dashboard_prototype.html`、`data/ga4/.htaccess` をサーバーにアップロードします。

### 3. 動作確認

ブラウザで以下を開きます。

- データAPI単体: `https://d-neko.com/ga4_api.php`
  → `{"kpi":{...},"trend":{...}, ...}` のような JSON が表示されれば成功です。
- ダッシュボード: `https://d-neko.com/ga4_dashboard_prototype.html`
  → KPI・グラフが実データで表示されれば完成です。

## 設定値（`ga4_api.php` 冒頭）

```php
$GA4_PROPERTY_ID = '415494708';   // GA4 プロパティ ID（デザネコ）
$CACHE_TTL       = 3600;          // キャッシュ有効秒数（既定1時間）
```

- データは `data/ga4/cache.json` に最大1時間キャッシュされます（API呼び出し回数の節約）。
- 最新化したい場合は `ga4_api.php?refresh=1` を開くとキャッシュを無視して再取得します。

## 表示される指標

- KPI: ページビュー / ユーザー数 / コンバージョン率 / 平均エンゲージメント（いずれも前月比つき）
- ページビュー推移（過去30日・日別）
- 流入元 / デバイス比率 / 男女比 / 年齢層
- 地域別アクセス（日本の都道府県 TOP10）
- 人気ページ TOP10

## よくあるトラブル

- **JSON に `error` が出る / グラフが出ない**
  - `data/ga4/service_account.json` が正しい場所・名前で置かれているか確認。
  - GA4 プロパティに `ga4-dashboard@project-4ad45ff5-f2da-4370-8b9.iam.gserviceaccount.com` が「閲覧者」で追加されているか確認。
- **男女比・年齢層が空**
  - これらは Google シグナルが有効でないと取得できません（GA4 管理 → データ設定 → データ収集）。
  - データが無い場合は「データがありません」と表示されます。
- **地域名が英語表記（Tokyo 等）**
  - GA4 の地域ディメンションは英語で返ります。仕様です。
