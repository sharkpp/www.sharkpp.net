---
title: "Upptime を試してみた"
date: 2025-04-28 00:35
tags: [雑記, OSS, Upptime, 監視]
categories: [ブログ]

---

[Upptime](https://upptime.js.org/) という、OSSを偶然見つけたので、試しに使ってみることに。

Upptime は、ウェブサイトの死活監視をするツールで、自分でセルフホストする形式で、サーバーも GitHub Actions を使うのでお手軽に運用できる感じ。

## セットアップ

基本的には [Getting started | Upptime](https://upptime.js.org/docs/get-started) を元にセットアップします。

### レポジトリをフォーク

[upptime/upptime](https://github.com/upptime/upptime) を `Use this template` ➡️ `Create a new repository` からレポジトリを fork します。

![repository fork](/images/20250428_01_repository_fork.png)

この時、`Repository name` 蘭は任意の値を設定すれば問題ないが、 `Include all branches` のチェックは必ず必要。

また、特に理由がない場合、レポジトリは `Public` がおすすめ。これは Upptime は仕組み上、毎月数千分のビルド時間(デフォルト設定では約3,000分)を使用するため、`Private` の場合、その分の利用料が生じるため。

### フォーク後の作業

GitHub Pages は、`Include all branches` をチェックしていれば、自動で有効になるはず。

### リポジトリシークレットを作成＆設定

アカウントの `Settings` ➡️ `Developer settings` ➡️ `Personal access tokens` ➡️ `Fine-grained personal access tokens` ➡️ `Generate new token` からリポジトリシークレットを作成。

種類 | 値
-|-
`Expiration`   | 90日などに設定
`Repository Access`   | `Only select repositories` で fork したレポジトリを選択
`Permissions`   | 下記参照

![create repository secret](/images/20250428_02_create_repository_secret.png)

`Permissions` で必要なのは、

種類 | 権限
-|-
`Actions`   | `Read and Write`
`Contents`  | `Read and Write`
`Issues`    | `Read and Write`
`Workflows` | `Read and Write`

が、説明として書かれていますが、Setup CI の STEP `Update summary in README` で、
```code
RequestError [HttpError]: Resource not accessible by personal access token
    at /home/runner/work/_actions/upptime/uptime-monitor/v1.40.1/webpack:/@upptime/uptime-monitor/node_modules/@octokit/request/dist-node/index.js:86:1
    at processTicksAndRejections (node:internal/process/task_queues:95:5)
    at generateSummary (/home/runner/work/_actions/upptime/uptime-monitor/v1.40.1/webpack:/@upptime/uptime-monitor/dist/summary.js:143:1) {
  status: 403,
```
のようなエラーログが出るようです。

なので、

種類 | 権限
-|-
`Actions`   | `Read and Write`
`Contents`  | `Read and Write`
`Issues`    | `Read and Write`
`Workflows` | `Read and Write`
`Administration` | `Read and Write`

が、現状(2025/04/27時点)では、Setup CI の実行には必要なようです。


レポジトリの `Settings` ➡️ `Secrets and variables` ➡️ `Actions` ➡️ `New repository secret` からリポジトリシークレットを `GH_PAT` という名前で追加。

![add repository secret](/images/20250428_03_add_repository_secret.png)

## 設定の更新

レポジトリ直下の `.upptimerc.yml` を変更して設定を変えます。

主に、監視対象の追加や、ステータスの公開先の設定をします。

```diff
   # Change these first
-  owner: upptime # Your GitHub organization or username, where this repository   lives
-  repo: upptime # The name of this repository
+  owner: sharkpp # ユーザー名か組織名
+  repo: upptime # レポジトリの名前
   
   sites:
-    - name: Google
-      url: https://www.google.com
-    - name: Wikipedia
-      url: https://en.wikipedia.org
-    - name: Hacker News
-      url: https://news.ycombinator.com
-    - name: Test Broken Site
-      url: https://thissitedoesnotexist.koj.co
-    - name: IPv6 test
-      url: forwardemail.net
-      port: 80
-      check: "tcp-ping"
-      ipv6: true
+    - name: www.sharkpp.net
+      url: https://www.sharkpp.net
   
   status-website:
     # Add your custom domain name, or remove the `cname` line if you don't have a   domain
     # Uncomment the `baseUrl` line if you don't have a custom domain and add your   repo name there
-    cname: demo.upptime.js.org
+    cname: upptime.sharkpp.net
     # baseUrl: /your-repo-name
     logoUrl: https://raw.githubusercontent.com/upptime/upptime.js.org/master/  static/img/icon.svg
     name: Upptime
```

こんな感じに設定したので、 https://upptime.sharkpp.net/ で確認できるようになった。

## GitHub Actions ワークフローの動作確認

まず、 `.github/workflows` に存在する各ワークフローが、GitHub Actions に表示されているか確認。
表示されていないものがあった場合は、動作に影響がない範囲で編集(空行にスペースを追加するなど)を加えてコミットすると表示されるようです。
おそらく、fork 時にちゃんとGitHub Actions が列挙してくれないのだと思う。

```
Generate graphs                                0s
Run benc-uk/workflow-dispatch@v1
🏃 Workflow Dispatch Action v1.2.4
Error: Unable to find workflow 'Graphs CI' in sharkpp/upptime 😥
```

アークフローが表示されていない場合、Setup CI の STEPの途中でこのようなエラーが出ます。

![setup ci](/images/20250428_04_setup_ci.png)

Setup CI の実行に成功するまで、各STEPのエラーなどを確認し修正する感じ。

## 結果

正常に動作し始め https://upptime.sharkpp.net/ で確認できるようになった。

![status page](/images/20250428_05_status_page.png)

## 参考

* [Getting started | Upptime](https://upptime.js.org/docs/get-started#add-repository-secrets)
* [Unable to find workflow 'Graphs CI' · Issue #995 · upptime/upptime](https://  github.com/upptime/upptime/issues/995#issuecomment-2327757107)


