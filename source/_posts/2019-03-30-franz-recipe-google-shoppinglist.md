---
layout: post
title: "Franz 用の Google ショッピングリスト レシピを作りました！"
date: 2019-03-30 23:22
tags: [Franz, Google, Javascript]
categories: [ブログ]

---

先日(といいつつ実はすでに数ヶ月は立っているのですが) Google Home で利用している買い物リストをPCから見えるページを見つけました。
今回は、それに対応したクライアント [Franz 5 recipe for Google Shopping List](https://github.com/sharkpp/franz-recipe-google-shoppinglist) を公開したので紹介します。

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
* [Google](https://myaccount.google.com/) アカウント<br />アカウントを持っていない場合は Google を作る必要があります。

## インストール方法

### 開発バージョン

1. `franz-recipe-google-shoppinglist` をダウンロードします。
2. PC上の Franz Plugins フォルダを開きます<br />(メモ： **`dev` ディレクトリが存在しない場合は作成する必要があります**)
    * Mac: `~/Library/Application Support/Franz/recipes/dev/`
    * Windows: `%AppData%\Franz\recipes\dev\`
    * Linux: `~/.config/Franz/recipes/dev`
3. `franz-recipe-google-shoppinglist` フォルダを plugins ディレクトリにコピーします
4. Franz を再起動する

詳しくは [Franz Recipe Documentation / Overview](https://github.com/meetfranz/plugins/blob/master/docs/integration.md) を参照してください。

### 安定版

準備中...

* [[Deploy] Google Shopping Lists · Issue #320 · meetfranz/plugins](https://github.com/meetfranz/plugins/issues/320)
 で公式リポジトリへの登録をリクエストをしているけど、どうなることやら

## 利用方法

### 新しいサービスを追加する

![サービスの追加](/images/20190330_add-service.png)

*開発バージョン*

### 設定

![サービスの追加](/images/20190330_add-service-settings.png)

| # | フィールド|説明|
| - | - | - |
| ① | サービス名 | 自由に設定してください |

### サインイン

![](/images/20190330_shoppinglist-signin.png)

登録されたアカウント情報を入力してください。
