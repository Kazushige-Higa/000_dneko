# 【初心者向け】GitHubからロリポップへ自動デプロイする方法｜GitHub Actions + FTPで`git push`だけで本番反映

> この記事でできるようになること
>
> - ローカルのサイトファイルをGitで管理する
> - GitHubにコードを保存する（バックアップ＆履歴管理）
> - `git push`するだけで**ロリポップサーバーへ自動アップロード**される仕組みを作る

「毎回FileZillaでFTPアップロードするのが面倒」
「うっかり古いファイルを上書きしたことがある」
「作業履歴を残したい」

こんな悩みを解決するのが、**GitHub Actions**を使った自動デプロイです。

この記事では、Git未経験でも手順通りに進めれば完成するように、実際に筆者がハマったトラブルとその解決法も含めて解説します。

---

## 完成イメージ

```
ローカルでファイル編集
    ↓
git add . → git commit → git push
    ↓
GitHubにコード保存（1〜2秒）
    ↓
GitHub Actionsが自動起動
    ↓
ロリポップFTPへ自動アップロード（1〜3分）
    ↓
https://あなたのドメイン に反映 ✅
```

一度設定すれば、以降はターミナルで3行のコマンドを打つだけで公開まで完了します。

---

## 前提環境

- **OS**: macOS（Windowsでも基本同じ手順）
- **サーバー**: ロリポップ（ライト／スタンダードプラン以上）
- **ドメイン**: ムームードメイン（他社ドメインでもOK）
- **GitHubアカウント**: 無料でOK
- **gitコマンド**: Macなら標準搭載（`git --version`で確認）

---

## STEP 1: ローカルプロジェクトをGitで管理する

### 1-1. プロジェクトフォルダに移動

ターミナルを開き、公開したいサイトのフォルダに移動します。

```bash
cd "/Users/あなたのユーザー名/path/to/サイトフォルダ"
```

フォルダ名にスペースや日本語が含まれる場合は、**ダブルクォートで囲む**のを忘れずに。

### 1-2. Gitリポジトリを初期化

```bash
git init -b main
git config user.email "あなたのメール@example.com"
git config user.name "あなたの名前"
```

`-b main`はデフォルトブランチを`main`にするオプション。最近はこちらが主流です。

### 1-3. `.gitignore`で不要ファイルを除外

プロジェクトフォルダ直下に`.gitignore`というファイルを作り、以下を書き込みます。

```
# macOS
.DS_Store

# Windows
Thumbs.db

# エディタ
.idea/
.vscode/
*.swp

# ログ・環境変数
*.log
.env
.env.*

# 依存関係
node_modules/
```

`.DS_Store`（macOSが勝手に作るファイル）などをGit管理から外せます。

### 1-4. 初回コミット

```bash
git add .
git commit -m "Initial commit"
```

```bash
git log --oneline
```

このコマンドで以下のように表示されればOK。

```
xxxxxxx (HEAD -> main) Initial commit
```

---

## STEP 2: GitHubにリポジトリを作ってpush

### 2-1. GitHubで新規リポジトリ作成

1. https://github.com/new を開く
2. **Repository name**: プロジェクト名を入力（例: `my-site`）
3. **Private**を選択（公開したくない場合）
4. 「**Initialize this repository with**」の項目は**すべてチェックなし**
5. 「Create repository」をクリック

### 2-2. リモートを登録してpush

GitHubの表示に従って以下を実行します。

```bash
git remote add origin https://github.com/あなたのアカウント/my-site.git
git push -u origin main
```

初回pushでは認証を求められます。**GitHubのパスワードではなくPersonal Access Token（PAT）**を使います。

**PATの作り方:**

1. https://github.com/settings/tokens/new にアクセス
2. Note: `my-site-push`などわかりやすい名前
3. Expiration: 90 daysなど任意
4. Scopes: `repo`にチェック
5. Generate token → 表示された文字列をコピー
6. ターミナルのパスワード欄に貼り付け

pushが完了したら、GitHubのリポジトリページをリロードしてファイルが反映されているか確認しましょう。

---

## STEP 3: GitHub Actions + FTP自動デプロイを設定する

ここからが本題です。以下4つの作業を行います。

1. ロリポップのFTP情報を確認
2. GitHubにSecrets（秘密情報）を4つ登録
3. ワークフローファイルを作成
4. pushしてデプロイ実行

### 3-1. ロリポップのFTP情報を確認

[ロリポップ!ユーザー専用ページ](https://user.lolipop.jp/)にログインし、**ユーザー設定 → アカウント情報**を開きます。

以下の3つをメモ。

| 項目 | 例 |
|---|---|
| FTPSサーバー | `ftp.lolipop.jp` |
| FTP・WebDAVアカウント | `lolipop.jp-xxxxxxxx` |
| FTP・WebDAVパスワード | 設定したパスワード |

**さらに、アップロード先のフォルダパスを確認**します。

1. 管理画面の「サーバーの管理・設定」→「ロリポップ!FTP」を開く
2. 公開したいドメイン用のフォルダをクリックして中に入る
3. 画面上部の「現在のディレクトリ」に表示されるパスをメモ（例: `/d-neko`）

**ポイント**: 末尾に`/`を付けて `/d-neko/` のようにしたものが、後で設定する値になります。

### 3-2. GitHub Secretsに4つの情報を登録

1. リポジトリページ → **Settings → Secrets and variables → Actions**
2. 「**New repository secret**」をクリック
3. 以下4つを1つずつ登録（「Add secret」を4回押す）

| Name | Secret（値） |
|---|---|
| `FTP_HOST` | `ftp.lolipop.jp` |
| `FTP_USERNAME` | FTP・WebDAVアカウント |
| `FTP_PASSWORD` | FTP・WebDAVパスワード |
| `FTP_SERVER_DIR` | `/d-neko/`（**先頭と末尾に`/`必須**） |

⚠️ Secretsは登録後、画面から値が見えなくなります（セキュリティ仕様）。

### 3-3. ワークフローファイルを作成

ローカルのプロジェクトフォルダで、以下を実行します。

```bash
cd "/Users/あなた/path/to/サイトフォルダ"

mkdir -p .github/workflows

cat > .github/workflows/deploy.yml << 'EOF'
name: Deploy to Lolipop via FTP

on:
  push:
    branches:
      - main
  workflow_dispatch:

jobs:
  ftp-deploy:
    name: Deploy to Lolipop
    runs-on: ubuntu-latest

    steps:
      - name: Checkout repository
        uses: actions/checkout@v5

      - name: Deploy via FTP
        uses: SamKirkland/FTP-Deploy-Action@v4.3.6
        with:
          server: ${{ secrets.FTP_HOST }}
          username: ${{ secrets.FTP_USERNAME }}
          password: ${{ secrets.FTP_PASSWORD }}
          server-dir: ${{ secrets.FTP_SERVER_DIR }}
          protocol: ftps
          port: 21
          security: loose
          exclude: |
            **/.git*
            **/.git*/**
            **/.github/**
            **/.DS_Store
            **/.vscode/**
            **/.idea/**
            **/node_modules/**
            **/.env
            **/.env.*
            **/README.md
            **/*.map
            **/scss/**
            **/*.scss
EOF
```

**解説:**

- `on: push: branches: [main]` — mainブランチへのpush時に自動実行
- `workflow_dispatch` — GitHub上から手動実行もできる
- `protocol: ftps` — FTPSでセキュアに転送
- `security: loose` — ロリポップが一部のTLS検証コマンドに対応していないため緩める
- `exclude:` — 転送しないファイル・フォルダ。`.git`や`node_modules`、SCSSソースなどを除外

### 3-4. pushして自動デプロイ実行

```bash
git add .github/workflows/deploy.yml
git commit -m "ci: GitHub ActionsでロリポップへのFTP自動デプロイを追加"
git push
```

これでpushした瞬間に自動デプロイが始まります。

### 3-5. 実行状況の確認

リポジトリの「**Actions**」タブを開きます。

- 🟡 黄色 → 実行中（通常1〜3分）
- ✅ 緑 → 成功！ブラウザでサイトを確認
- ❌ 赤 → ログを開いてエラー確認

成功していれば、ブラウザで独自ドメイン（例: `https://d-neko.com`）にアクセスすると最新の内容が反映されているはずです。

---

## よくあるトラブルと解決法

### トラブル1: `.git`ディレクトリへの書き込みが権限エラー

**症状:**
```
warning: unable to unlink '.git/objects/xx/xxxxx': Operation not permitted
```

**原因**: プロジェクトフォルダがGoogle DriveやiCloud Driveなど、クラウド同期フォルダ内にあると、同期プロセスと競合して`.git`内部ファイルが書き換えられず失敗することがある。

**対処**: クラウド同期フォルダ外（例: `~/Git/プロジェクト名`）にプロジェクトを移すのが最も安全。

```bash
mkdir -p ~/Git
cd ~/Git
git clone https://github.com/あなた/my-site.git
```

以降は`~/Git/my-site`で作業する。

### トラブル2: 間違ったホームディレクトリで`git init`してしまった

**症状:**
```
warning: could not open directory 'Library/Application Support/MobileSync/': Operation not permitted
warning: could not open directory 'Library/Assistant/SiriVocabulary/': Operation not permitted
...
```

macOSのシステムフォルダへのアクセス警告が大量に出る。

**原因**: `cd`でプロジェクトフォルダに移動せず、ホームディレクトリ（`~`）で`git init`してしまった。

**対処**:
```bash
# ホームディレクトリに誤って作った.gitを削除
cd ~
rm -rf .git

# 正しいフォルダに移動して再実行
cd "/Users/あなた/path/to/プロジェクト"
git init -b main
```

### トラブル3: FTPの転送先パスを間違えた

**症状**: デプロイは成功するが、`d-neko.main.jp/http:/d-neko.main.jp`のように**意図しないネスト構造**でフォルダが作られる。

**原因**: `FTP_SERVER_DIR`に`http://d-neko.main.jp/`のようなURL形式を入れてしまった。`//`が`/`に解釈され、`http:`というフォルダと入れ子構造ができる。

**対処**:

1. ロリポップ!FTPで誤って作られたフォルダを削除
2. GitHub Secrets画面で`FTP_SERVER_DIR`を「Update」
3. 正しい値 `/d-neko/` を再入力
4. Actionsタブから「Run workflow」で再デプロイ

**ポイント**: `FTP_SERVER_DIR`は**URLではなくサーバー内のパス**。`/d-neko/` のように先頭と末尾に`/`を付けた絶対パスで入れる。

### トラブル4: Node.js 20 deprecation警告

**症状**:
```
Node.js 20 actions are deprecated.
```

**原因**: GitHub Actionsが2026年6月からNode.js 24に強制移行されるための警告。

**対処**: `deploy.yml`で使用しているActionのバージョンを新しいものに更新。

```yaml
      - uses: actions/checkout@v5          # v4 → v5
      - uses: SamKirkland/FTP-Deploy-Action@v4.3.6   # v4.3.5 → v4.3.6
```

---

## 運用上の注意点

### サーバーの既存ファイルは上書きされる

FTP-Deploy-Actionの動作は以下の通り。

| サーバー側 | Git側 | 動作 |
|---|---|---|
| ファイルあり | 同名ファイルあり | **上書き** |
| ファイルあり | なし | 触らない（保持） |
| なし | あり | 新規アップロード |

**動的に書き換わるファイル（PVカウンター、いいね数、ユーザーアップロード画像など）がサーバーにある場合は、`exclude`セクションに追加して保護しましょう。**

```yaml
          exclude: |
            ...
            **/data/**              # データフォルダを保護
            **/images/uploads/**    # ユーザーアップロードを保護
```

### 初回デプロイ前にバックアップを推奨

本番サーバーにすでにファイルがある場合、初回デプロイで一部が上書きされます。FileZillaなどで`/公開フォルダ/`をローカルにダウンロードしておくと安心。

### Google Driveなどクラウド同期フォルダでの運用は非推奨

`.git`が同期プロセスに書き換えられて破損するリスクがある。Git管理するフォルダは、ローカルディスクの同期されない場所（例: `~/Git/`）に置くのがおすすめ。

---

## 完成後のワークフロー

設定が完了すれば、日常の作業はたった3行です。

```bash
# ファイル編集後...
git add .
git commit -m "変更内容の説明"
git push
```

1〜3分で本番サイトに自動反映されます。🎉

---

## まとめ

| メリット | 内容 |
|---|---|
| ⚡ 速い | pushするだけで1〜3分で本番反映 |
| 📜 履歴管理 | いつ・何を変更したかすべて記録 |
| 🔄 いつでも戻せる | 問題があれば過去バージョンに復元可能 |
| 🛡️ 安全 | ローカルの誤操作を防げる（Gitで管理されている） |
| 👥 共同作業 | 複数人でも同じ仕組みで安全に運用可能 |

FTPソフトを毎回立ち上げる必要がなくなり、作業効率が劇的に上がります。最初の設定に1時間ほどかかりますが、**この投資は毎日のストレスを減らしてくれる価値が十分あります**。

ぜひ試してみてください。
