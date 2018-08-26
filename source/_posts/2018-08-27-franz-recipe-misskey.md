---
layout: post
title: "Franz 用の Misskey レシピを作りました！"
date: 2018-08-27 07:30
tags: [Franz, Misskey, Javascript]
categories: [ブログ]

---

先日から話題になってた分散マイクロブログSNSであるところの [syuilo/misskey: A planet of fediverse ✨🐢🚀✨](https://github.com/syuilo/misskey) があります。
それに対応したクライアント [Franz 5 recipe for Misskey](https://github.com/sharkpp/franz-recipe-misskey) を昨晩公開したので紹介します。

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
* [Misskey](https://joinmisskey.github.io/) アカウント<br />アカウントを持っていない場合は、自分で Misskey インスタンスを立ち上げるか [Misskey instances](https://joinmisskey.github.io/ja/wiki/instances/) から探して見てください

## インストール方法

### 開発バージョン

1. `franz-recipe-misskey` をダウンロードします。
2. PC上の Franz Plugins フォルダを開きます<br />(メモ： **`dev` ディレクトリが存在しない場合は作成する必要があります**)
    * Mac: `~/Library/Application Support/Franz/recipes/dev/`
    * Windows: `%AppData%\Franz\recipes\dev\`
    * Linux: `~/.config/Franz/recipes/dev`
3. `franz-recipe-misskey` フォルダを plugins ディレクトリにコピーします
4. Franz を再起動する

詳しくは [Franz Recipe Documentation / Overview](https://github.com/meetfranz/plugins/blob/master/docs/integration.md) を参照してください。

### 安定版

準備中...

※ [[Deploy] Misskey - Issue #194 - meetfranz/plugins](https://github.com/meetfranz/plugins/issues/194) で公式リポジトリへの登録をリクエストをしているけど、どうなることやら

## 利用方法

### 新しいサービスを追加する

![サービスの追加](/images/20180826_add-service.png)

*開発バージョン*

### 設定

![サービスの追加](/images/20180826_add-service-settings.png)

| # | フィールド|説明|
| - | - | - |
| ① | サービス名 | 自由に設定してください |
| ② | Misskey インスタンスのホスト名 | Misskey を実行しているホストを入力してください。 httpsのみがサポートされています|

### サインイン

![](/images/20180826_misskey-signin.png)

登録されたアカウント情報を入力してください。

### 通知バッジについて

![](/images/20180826_notification-badge-example.png)

通知を確認すると同時にクリアされます。
