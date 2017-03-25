---
title: "Qt Network Authorization を使った Twitter API の利用"
date: 2017-03-25 22:59
update: 2017-03-25 23:44
tags: [Qt, Twitter, OAuth, C++, cpp, 勉強会]
categories: [ブログ]

---

さて、先月に続いて今月も参加した [Qt 勉強会 @ Nagoya No6(17.03)](https://qt-users.connpass.com/event/52009/) のまとめ。

今回はいつもに増して短め。

[sharkpp/Jugemutter: 長文投稿専用クライアント「じゅげむったー」](https://github.com/sharkpp/Jugemutter) で成果物を公開しています。

## はじめに

まずは、クラスの実装をしていきます。

[Qt Network Authorization Examples | Qt Network Authorization 5.8](https://doc-snapshots.qt.io/qt5-5.8/examples-qtnetworkauth.html) に Twitter認証のサンプルがあるので、それを参考にしつつ [NetworkStorageAccessSample](https://github.com/sharkpp/NetworkStorageAccessSample) で実装した認証済みトークンの保存処理を実装していきました。

あ、[はじめての Qt Network Authorization](http://www.sharkpp.net/blog/2017/01/28/first-impression-qt-network-authorization.html) も参考にしています。

そろそろ、だれか Qt Network Authorization を触った記事を書いてくれないだろうか？

## ポイント

実装するクラスは `QOAuth1` クラスから派生します。


これは、認証した後のトークンの復帰処理で `setStatus(QAbstractOAuth::Status::Granted)` の実行が必要となります。
ただし、該当のメソッドが `protected` として実装されているので、 `QOAuth1` クラスから派生する必要があるのです。


APIの各エンドポイントを設定

まあ、この辺はサンプルと同じです。

```cpp
setTemporaryCredentialsUrl(QUrl("https://api.twitter.com/oauth/request_token"));
setAuthorizationUrl(QUrl("https://api.twitter.com/oauth/authenticate"));
setTokenCredentialsUrl(QUrl("https://api.twitter.com/oauth/access_token"));
```

OAuth の認証を、ブラウザを利用するために、

```cpp
setReplyHandler(new QOAuthHttpServerReplyHandler(this));
```

としますが、これを実行するとポートを開きに行くので、必要な時のみポートを開くか PIN 認証にする方が良いかもしれません。

この時、

```cpp
connect(this, &QAbstractOAuth::authorizeWithBrowser,
        this, &Twitter::handleAuthorizeWithBrowser);
```

としてシグナルをスロットと関連づけて、

```cpp
void Twitter::handleAuthorizeWithBrowser(QUrl url)
{
    QDesktopServices::openUrl(url);
}
```

のような感じで実装することで、ブラウザで認証することができます。

`grant()` を呼び出すことで認証開始するので、適当なメソッドでラップします。

認証後は、

```
connect(this, &QOAuth1::granted, this, &Twitter::authenticated);
```

とすることで、 `authenticated()` を認証時に呼ばされるシグナルとして登録できます。

つぶやくには

```
    QUrl url("https://api.twitter.com/1.1/statuses/update.json");
    QUrlQuery query(url);
    query.addQueryItem("status", "hogehoge");
    url.setQuery(query);
    QNetworkReply *reply = post(url);
    connect(reply, &QNetworkReply::finished, this, &Twitter::tweetFinished);
```

みたいな感じです。

まあ、後から振り返ると割と簡単な部類になると思うけど、いろいろハマってしまいました。

## いろいろ失敗談

なぜか今回はハマることハマること。

ハマった所をメモとして残しておきます。

* `setClientIdentifier()` / `setClientSharedSecret()` と `token()` / `tokenSecret()` をなぜかとり間違える
  なぜ間違えたし。
* 設定したはずの、Consumer Key / Consumer Secret が設定されていなくて、`QOAuthOobReplyHandler::networkReplyFinished: Host requires authentication` とデバッグ主力に出る。
  `setModifyParametersFunction` で今の Stage とライブラリのソースをにらめっこで原因を見つけた。
* 呟く内容が別の変数を参照していたために空っぽで `Missing required parameter: status.` と返答が返ってくる。
  うん、たしかに設定されてなかったね。
* <del>`connect()` でラムダ式を使うとなぜか `qobject_cast<QNetworkReply*>(sender())` が `nullptr`。</del>
  <del>横着せずに 別メソッドを作って設定すると大丈夫だった。何で？</del>
  後で試したら大丈夫だった。

と、こんな感じ。

結局、時間内になんとかつぶやきを書き込むまでは行けたけど、先のハマりがなければ、もう少し行けたかもしれない。

## ツイッターのアプリケーション登録

[Create an application | Twitter Application Management](https://apps.twitter.com/app/new) でアプリケーションを登録できる。

ただし、電話番号を認証していないと <ruby><rb>You must add your mobile phone to your Twitter profile before creating an application.</rb><rp>(</rp><rt>アプリケーションを作成する前に携帯電話を Twitter プロファイルに追加する必要があります。</rt><rp>)</rp></ruby> って怒られる。

一度登録したら、電話番号の登録を解除しても、登録内容の変更とかは問題なくできる模様。

で、登録時、SMSで飛んでくるトークンを何回入力しても弾かれるので、途方にくれてたけど [twitterの電話番号認証がうまくいかないとき - やったこと](http://absg.hatenablog.com/entry/2015/01/26/163057) を見たらリロードすれば大丈夫のようなので試して見たらできた。
何じゃそりゃ？

まあともかく、アプリケーションを登録したら、Consumer Key / Consumer Secret を確認しアプリケーションに設定。

これでOK。

## 参考

* [はじめての Qt Network Authorization — さめたすたすのお家](http://www.sharkpp.net/blog/2017/01/28/first-impression-qt-network-authorization.html)
* [Qt Network Authorization Examples | Qt Network Authorization 5.8](https://doc-snapshots.qt.io/qt5-5.8/examples-qtnetworkauth.html)
* [Twitter Developer Documentation — Twitter Developers](https://dev.twitter.com/docs)
* [sharkpp/NetworkStorageAccessSample: Qt Network Authorization "Network storage access" sample](https://github.com/sharkpp/NetworkStorageAccessSample)
* [POST statuses/update - ツイートを投稿する](https://syncer.jp/Web/API/Twitter/REST_API/POST/statuses/update/) ※情報が古いようだ
* [POST statuses/update - Twitter 開発者ドキュメント 日本語訳](http://westplain.sakuraweb.com/translate/twitter/Documentation/REST-APIs/Public-API/POST-statuses-update.cgi)
* [API Console — Twitter Developers](https://dev.twitter.com/rest/tools/console)
* [twitterの電話番号認証がうまくいかないとき - やったこと](http://absg.hatenablog.com/entry/2015/01/26/163057)

