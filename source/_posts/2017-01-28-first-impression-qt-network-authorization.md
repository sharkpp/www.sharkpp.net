---
title: "はじめての Qt Network Authorization"
date: 2017-01-28 16:50
update: 2017-03-25 22:30
tags: [Qt, OAuth, C++, cpp, 勉強会]
categories: [ブログ]

---

先日、ちょうど「[設定を統合した「Qt 5.8」が登場 | OSDN Magazine](https://mag.osdn.jp/17/01/25/161000)」の記事が目に入り、ふんふんと読んでいたところで、Qt Lite も気になりましたが、それよりも OAuth 2 と OAuth 2 に対応した [Qt Network Authorization](https://doc.qt.io/qt-5/qtnetworkauth-index.html) が技術プレビューで追加、と書かれていたので軽く試して見ました。

と言うことで、新しくなってから２回目の参加になる [Qt 勉強会 @ Nagoya No4(17.01)](https://qt-users.connpass.com/event/48608/) は、Qt Network Authorization を触って見ることにしました。

※ [Qt 勉強会 @ Nagoya No4(17.01) - Togetterまとめ](https://togetter.com/li/1092291) で当日のつぶやきがまとめられています。

結論を先に言うと、 **Qt Network Authorization** は簡単に OAuth 認証をアプリケーションへ組み込めるようです。

気になる点としては、

* ドキュメントが少ない
* 認証が通った後「Callback received. Feel free to close this page.」と書かれたページがブラウザで開いたままになる。
    * これは自動で閉じてほしい
* コールバックを受け取るためにポートを自動で開くのでファイヤーウォールなどでブロックしていると失敗する

などですが、まあ現状は技術プレビューの段階なので正式版までになんとかなっていてほしいなと。

## まず始めに

まあ、大前提として、Qt Network Authorization を利用するには Qt 5.8 以降が必要となります。

次に [Qt Network Authorization 5.8](http://doc.qt.io/qt-5/qtnetworkauth-index.html) を参考に、

.pro に 

```
QT += network networkauth
```

と追加しましょう。

あとは、 Twitter なり Tumblr なりなんなりへ、アプリケーションを登録して OAuth Consumer Key と Secret Key を取得しておきましょう。
この時、コールバックURLを書く必要がある場合は、適当なアドレスを書いておけば問題ありません。

## 流れ

最低限のプログラムの流れです。

OAuth 1.x なら QOAuth1 クラスを基底クラスにして処理を実装していけば良いようです。

今回は、 Tumblr で試していたので OAuth 1.0a 対応の QOAuth1 を触りますが、 QOAuth2 でも多分大体同じだと思います。

ただ、 QOAuth1 のドキュメントがないので [QAbstractOAuth](http://doc.qt.io/qt-5/qabstractoauth.html) クラスのドキュメントで我慢しましょう。

### URLの登録

とりあえず３種類のURLを登録する必要があります。

|メソッド|URL例|説明|
|-|-|-|
|setTemporaryCredentialsUrl |https://api.twitter.com/oauth/request_token<br/>https://www.tumblr.com/oauth/request_token| トークンの要求|
|setAuthorizationUrl |https://api.twitter.com/oauth/authenticate<br/>https://www.tumblr.com/oauth/authorize| 認証|
|setTokenCredentialsUrl |https://api.twitter.com/oauth/access_token<br/>https://www.tumblr.com/oauth/access_token| アクセストークン取得|

いずれも `QAbstractOAuth` クラスの public メンバメソッドです。

ここに変なのを指定すると `QOAuthOobReplyHandler::networkReplyFinished: Protocol "" is unknown` と言われたりします。

### Consumer Key と Secret Key の指定

OAuth Consumer Key と Secret Key を指定します。
これ自体の扱いはいろいろ厄介なのですが、とりあえずそれは置いておきます。

`QOAuth1.setClientCredentials()` に `QPair<QString, QString>` で指定します。

`QPair<QString, QString>().first` は Consumer Key で

`QPair<QString, QString>().second` は Secret Key です。

### 認証要求

ここまで設定できたら `grant()` を呼ぶことで、認証手続きが開始されます。

### ブラウザでの認証要求のシグナル

`grant()` を呼ぶと `QAbstractOAuth::authorizeWithBrowser` シグナルが飛んでくるので、あらかじめスロットで受け取れるようにしておきましょう。

[QAbstractOAuth::authorizeWithBrowser](http://doc.qt.io/qt-5/qabstractoauth.html#authorizeWithBrowser) の中で引数に指定されたURLをウェブブラウザで開くことでいつも利用しているブラウザを用いた認証ができるような仕組みになっています。

ただ、この処理を実現するために、アプリケーション自身でポートをリッスンし、そのアドレスをコールバックとして指定しているようで、ファイヤーウォールなどでブロックされる可能性があるので注意が必要です。

### 認証完了のシグナル

認証が完了すると [QOAuth1::granted](http://doc.qt.io/qt-5/qabstractoauth.html#grant) シグナルが飛ぶので、必要に応じてメッセージを出すなり、UIを有効化させるなりで利用できると思います。

一応、認証後にはアクセストークンも取れるので、それを保存しておけば次回以降は認証が必要なくなると思いますが、すこし試したところうまくいきませんでした。

### APIを呼ぶ

ここまできたら、後は簡単で `QAbstractOAuth` に含まれるメンバメソッドの get() / head() / post() を呼ぶだけで、非同期でコンテンツが取得できます。

要求アドレスへ `api_key` などというパラメータをユーザーがつける必要はないので扱いやすいと思います。

## まとめ

* **Qt Network Authorization** は簡単に OAuth 認証をアプリケーションへ組み込めそう
* サンプルがあるからまあなんとかなりそう
* ツイッター連携とか実装するのが簡単になるね！

## 参考

* [Qt Network Authorization 5.8](https://doc.qt.io/qt-5/qtnetworkauth-index.html)
* [Qt Network Authorization Examples | Qt Network Authorization 5.8](https://doc-snapshots.qt.io/qt5-5.8/examples-qtnetworkauth.html)
* [qt/qtnetworkauth.git - Qt Network Authenticators; QtOAuth in particular](http://code.qt.io/cgit/qt/qtnetworkauth.git/)
* [oAuth 認証を提供しているサービスをまとめてみました — さめたすたすのお家](http://www.sharkpp.net/blog/2014/03/30/oauth-providers-list.html)

