---
layout: post
title: "Franz 用の Mastodon レシピを作りました！"
date: 2018-03-27 01:10
tags: [Franz, Mastodon, Javascript]
categories: [ブログ]

---

ネタがない... ことはないけど、これまた先日公開した [Franz 5 recipe for Mastodon](https://github.com/sharkpp/franz-recipe-mastodon) の紹介です。

## そもそも Franz とはなんぞや？

簡単にいうと Franz は、各種 SNS をタブでまとめて管理できるデスクトップアプリです。

[Franz – a free messaging app for Slack, Facebook Messenger, WhatsApp, Telegram and more](https://meetfranz.com/) からダウンロードできますが、利用するにはアカウント登録が必要です。

特徴として

* レシピ（＝拡張）を追加することで様々な SNS などの Webサービスに対応可能
* レシピごとに複数のアカウントを割り当て可能（＝マルチアカウント対応）
* クロスプラットフォームなデスクトップアプリ

などがあります。

まあ、要するに Webで提供されているページをタブで表示している訳です。
そのため、LINE など Webページが存在しないサービスに対しては逆立ちしても利用できないのですが...

## 必要なもの

* [Franz](https://meetfranz.com/) 5 以降<br />古いバージョンはサポートしていません。
* [Mastodon](https://joinmastodon.org/) アカウント<br />アカウントを持っていない場合は、自分で Mastodon インスタンスを立ち上げるか [Mastodon instances](https://instances.social/list) から探して見てください

## インストール方法

### 開発バージョン

1. `franz-recipe-mastodon` をダウンロードします。
2. PC上の Franz Plugins フォルダを開きます<br />(メモ： **`dev` ディレクトリが存在しない場合は作成する必要があります**)
    * Mac: `~/Library/Application Support/Franz/recipes/dev/`
    * Windows: `%appdata%/Franz/recipes/dev/`
    * Linux: `~/.config/Franz/recipes/dev`
3. `franz-recipe-mastodon` フォルダを plugins ディレクトリにコピーします
4. Franz をリロードする

詳しくは [Franz Recipe Documentation / Overview](https://github.com/meetfranz/plugins/blob/master/docs/integration.md) を参照してください。

### 安定版

準備中...

※ [[Deploy] Mastodon - Issue #137 - meetfranz/plugins](https://github.com/meetfranz/plugins/issues/137) で公式リポジトリへの登録をリクエストをしているけど、どうなることやら

## 利用方法

### 新しいサービスを追加する

![](/images/20180327_add-service.png)

*開発バージョン*

### 設定

![](/images/20180327_add-service-settings.png)

| # | フィールド|説明|
| - | - | - |
| ① | サービス名 | 自由に設定してください |
| ② | Mastodon インスタンスのホスト名 | Mastodon を実行しているホストを入力してください。 httpsのみがサポートされています|

### サインイン

![](/images/20180327_mstdn_jp-signin.png)

登録されたアカウント情報を入力してください。

### 通知バッジについて

![](/images/20180327_notification-badge-example.png)

利用するには *mastodon* 側でデスクトップ通知を有効にする必要があります。

バッジのクリア条件

| 現在アクティブなサービス | バッジのクリア |
|-|-|
| このサービス | 最後の通知から10秒後 | 
| その他のサービス | このサービスがアクティブになった時 |

## おまけ

Franz で Mastodon を管理したいなーと思って、github とかとか探して見たけど、どうやら最新版ではまともに動かないらしい、という所からじゃあ自分で作ってみようかと思って作って見ました。

まあ、表示するだけならなんとかなったんですが...

* ログイン画面へのリダイレクト（トップ画面はごちゃごちゃ表示されているので）
* 新着の通知（画面に通知が出ない）

あたりの実装がすっごく大変でした。
この辺り、色々調べたことをまとめたいなとは思います。
