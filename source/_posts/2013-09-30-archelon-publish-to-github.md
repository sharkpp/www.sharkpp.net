---
title: "Archelon をGitHubに公開しました"
date: 2013-09-30 00:14:00
tags: [php, FuelPHP]
categories: [ブログ]

---

ここ最近、久々にウェブアプリを作ってました。 相変わらず作業時間が厳しかったですがまあそれなりに動くようになってきたのでとりあえずgithubに公開しました。

動かなかったらごめんなさいorz

  * [sharkpp/Archelon][1]
  * [sharkpp/ArchelonConnectorExample][2]

 [1]: https://github.com/sharkpp/Archelon
 [2]: https://github.com/sharkpp/ArchelonConnectorExample

とりあえず、マスコット的な何かです。

![マスコット的な何か][3]

 [3]: /images/2013_0929_archelon.gif

Archelon は アカウントアグリゲーションサービスの一種です。 REST APIなどなどウェブAPIを用意していないウェブアプリケーションにAPIを追加するシステムです。

たとえば、あるグループウエアがあるとして REST API などがまったく用意されていない場合、今日の予定一覧をメールで出したい、としてもログイン処理からスクレイピングから実装をしないといけなくて大変じゃないでしょうか？

これを、このアプリケーションは簡単におこなうことができます(コネクタがある場合に限っては、ではありますが)。

とりあえずは、プライベートネットワーク(社内LAN)で動かすことを想定しています。

同じネットワーク内で動作しているグループウエアなどのウェブアプリに対して Archelon に登録済みのアカウント情報でログイン、各種情報(コネクタの実装しだい)の取得を行うことができます。

取得した情報は、REST API 経由で受け取ることができるので、別のアプリで活用することができます。

ということで、実は、「コネクタ」と言う一種のプラグイン的なものがないと何もできません。

セットアップ画面も実装してあるのでデータベースの設定やマイグレーションなどはブラウザからできます。 これは、FUelPHP製のアプリでは珍しい部類なのではないかなと。

[![Archelon インストール画面][4]][5]

 [4]: /images/2013_0929_archelon_setup.png
 [5]: /images/2013_0929_archelon_setup.jpg

インストールが成功するとこの画面になります。

[![Archelon Welcom画面][6]][7]

 [6]: /images/2013_0929_archelon_welcom.png
 [7]: /images/2013_0929_archelon_welcom.jpg

Archelon 自体は、

  * 「コネクタ」の管理
  * 登録済みのアカウントの管理
  * REST API のドキュメントの表示

を行います。

ダッシュボード上には登録されているアカウントの一覧が並びます。 そして、APIの使い方やAPI KEYの取得などができます。

[![Archelon ダッシュボード画面][8]][9]

 [8]: /images/2013_0929_archelon_dashboard.png
 [9]: /images/2013_0929_archelon_dashboard.jpg

「REST API のドキュメントの表示」は、こんな感じに表示されます。

[![Archelon APIドキュメント画面1][10]][11] [![Archelon APIドキュメント画面2][12]][13]

 [10]: /images/2013_0929_archelon_api_docs1.png
 [11]: /images/2013_0929_archelon_api_docs1.jpg
 [12]: /images/2013_0929_archelon_api_docs2.png
 [13]: /images/2013_0929_archelon_api_docs2.jpg

そして「コネクタ」は、

  * 外部のウェブサービスのログインなどに必要な情報の管理
  * REST APIの提供

を行います。

「REST APIの提供」は、JSONやXMLで返答することもできます。 ※これは実装しだいですが、FuelPHP の `Controller_Rest` で簡単に実装できます。

[![Archelon API結果JSON][14]][15] [![Archelon API結果XML][16]][17]

 [14]: /images/2013_0929_archelon_api_result_json.png
 [15]: /images/2013_0929_archelon_api_result_json.jpg
 [16]: /images/2013_0929_archelon_api_result_xml.png
 [17]: /images/2013_0929_archelon_api_result_xml.jpg

まあ、こんな感じで、「コネクタ」なければ何もできない感じですので面白い使い方があればこそっと教えてほしいです。

今のところ、数種類のアプリのコネクタは実装ないし実装予定ではあるのですが、その他は特に思いついていないので。

* * *

10月01日：少し文章を変更しました。
