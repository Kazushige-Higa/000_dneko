# 営業資料PDFの生成

`create_sales_material.py` は、リポジトリ内の次の入力から
`output/pdf/dezaneko_sales_guide_A4.pdf` を生成します。

- `data/web_design_works.csv`
- `data/print_works.json`
- `images/` 内の掲載画像

## 実行方法

```bash
python3 -m venv .venv
source .venv/bin/activate
pip install -r requirements-sales-material.txt
python scripts/create_sales_material.py
```

PDF生成には日本語1書体と欧文3書体が必要です。macOSでは Noto Sans JP Bold と
Roboto Regular / Bold / Black を Font Book でインストールしてください。Ubuntu系では
次のコマンドで、スクリプトが自動検出する互換フォントを導入できます。

```bash
sudo apt-get update
sudo apt-get install -y fonts-noto-cjk fonts-dejavu-core
```

上記以外の環境、または任意の書体を使う場合は、実行前に以下の環境変数へ
各フォントファイルの絶対パスを設定してください。フォントの不足は生成開始時に
対象の環境変数名とともにエラー表示されます。

- `DNEKO_FONT_JP`
- `DNEKO_FONT_EN`
- `DNEKO_FONT_EN_BOLD`
- `DNEKO_FONT_EN_BLACK`

microCMSの制作実績を更新した場合は、公開前に `data/print_works.json` の
`title`、`image`、`url` を更新してからPDFを再生成します。
印刷事例画像は `images.microcms-assets.io` から取得するため、生成時には
インターネット接続が必要です。画像URLを変更するとキャッシュも自動更新されます。
