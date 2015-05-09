---
title: "Archelon をGitHubに公開しました"
tags: [php, FuelPHP]
categories: [blog]

---

ここ最近、久々にウェブアプリを作ってました。 相変わらず作業時間が厳しかったですがまあそれなりに動くようになってきたのでとりあえずgithubに公開しました。

動かなかったらごめんなさいorz

  * [sharkpp/Archelon][1]
  * [sharkpp/ArchelonConnectorExample][2]

とりあえず、マスコット的な何かです。

![マスコット的な何か][3]

Archelon は アカウントアグリゲーションサービスの一種です。 REST APIなどなどウェブAPIを用意していないウェブアプリケーションにAPIを追加するシステムです。

たとえば、あるグループウエアがあるとして REST API などがまったく用意されていない場合、今日の予定一覧をメールで出したい、としてもログイン処理からスクレイピングから実装をしないといけなくて大変じゃないでしょうか？

これを、このアプリケーションは簡単におこなうことができます(コネクタがある場合に限っては、ではありますが)。

とりあえずは、プライベートネットワーク(社内LAN)で動かすことを想定しています。

同じネットワーク内で動作しているグループウエアなどのウェブアプリに対して Archelon に登録済みのアカウント情報でログイン、各種情報(コネクタの実装しだい)の取得を行うことができます。

取得した情報は、REST API 経由で受け取ることができるので、別のアプリで活用することができます。

ということで、実は、「コネクタ」と言う一種のプラグイン的なものがないと何もできません。

セットアップ画面も実装してあるのでデータベースの設定やマイグレーションなどはブラウザからできます。 これは、FUelPHP製のアプリでは珍しい部類なのではないかなと。

<a href="/public/images/2013_0929_archelon_setup.jpg" rel="lytebox[2013_0929_archelon_publish_to_github]" title="Archelon インストール画面"><img src="/public/images/2013_0929_archelon_setup.png" alt="Archelon インストール画面" /></a>

インストールが成功するとこの画面になります。

<a href="/public/images/2013_0929_archelon_welcom.jpg" rel="lytebox[2013_0929_archelon_publish_to_github]" title="Archelon Welcom画面"><img src="/public/images/2013_0929_archelon_welcom.png" alt="Archelon Welcom画面" /></a>

Archelon 自体は、

  * 「コネクタ」の管理
  * 登録済みのアカウントの管理
  * REST API のドキュメントの表示

を行います。

ダッシュボード上には登録されているアカウントの一覧が並びます。 そして、APIの使い方やAPI KEYの取得などができます。

<a href="/public/images/2013_0929_archelon_dashboard.jpg" rel="lytebox[2013_0929_archelon_publish_to_github]" title="Archelon ダッシュボード画面"><img src="/public/images/2013_0929_archelon_dashboard.png" alt="Archelon ダッシュボード画面" /></a>

「REST API のドキュメントの表示」は、こんな感じに表示されます。

<a href="/public/images/2013_0929_archelon_api_docs1.jpg" rel="lytebox[2013_0929_archelon_publish_to_github]" title="Archelon APIドキュメント画面1"><img src="/public/images/2013_0929_archelon_api_docs1.png" alt="Archelon APIドキュメント画面1" /></a> <a href="/public/images/2013_0929_archelon_api_docs2.jpg" rel="lytebox[2013_0929_archelon_publish_to_github]" title="Archelon APIドキュメント画面2"><img src="/public/images/2013_0929_archelon_api_docs2.png" alt="Archelon APIドキュメント画面2" /></a>

そして「コネクタ」は、

  * 外部のウェブサービスのログインなどに必要な情報の管理
  * REST APIの提供

を行います。

「REST APIの提供」は、JSONやXMLで返答することもできます。 ※これは実装しだいですが、FuelPHP の `Controller_Rest` で簡単に実装できます。

<a href="/public/images/2013_0929_archelon_api_result_json.jpg" rel="lytebox[2013_0929_archelon_publish_to_github]" title="Archelon API結果JSON"><img src="/public/images/2013_0929_archelon_api_result_json.png" alt="Archelon API結果JSON" /></a> <a href="/public/images/2013_0929_archelon_api_result_xml.jpg"  rel="lytebox[2013_0929_archelon_publish_to_github]" title="Archelon API結果XML" ><img src="/public/images/2013_0929_archelon_api_result_xml.png"  alt="Archelon API結果XML" /></a>

まあ、こんな感じで、「コネクタ」なければ何もできない感じですので面白い使い方があればこそっと教えてほしいです。

今のところ、数種類のアプリのコネクタは実装ないし実装予定ではあるのですが、その他は特に思いついていないので。

* * *

10月01日：少し文章を変更しました。

 [1]: https://github.com/sharkpp/Archelon
 [2]: https://github.com/sharkpp/ArchelonConnectorExample
 [3]: /public/images/2013_0929_archelon.gif