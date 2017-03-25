---
title: "Qt Network Authorization を使った Dropbox API　の利用"
date: 2017-02-28 01:45
update: 2017-03-25 22:30
tags: [Qt, Dropbox, OAuth, C++, cpp, 勉強会]
categories: [ブログ]

---

さて、今月も参加した [Qt 勉強会 @ Nagoya No5(17.02)](https://qt-users.connpass.com/event/50191/) のまとめ。

※ [Qt 勉強会 @ Nagoya No5(17.02) - Togetterまとめ](https://togetter.com/li/1092293) で当日のつぶやきがまとめられています。

今回も、前回に引き続き、[Qt Network Authorization](https://doc.qt.io/qt-5/qtnetworkauth-index.html) を色々さわって見ることにしました。

そして、翌日へとオーバーランをしつつ [sharkpp/NetworkStorageAccessSample: Qt Network Authorization "Network storage access" sample](https://github.com/sharkpp/NetworkStorageAccessSample) を作りました。

とりあえず、今時点では、Dropbox への認証と、ファイルのアップロードができます。

## Dropbox へのアプリケーションの登録

何はともあれまずはここからです。

[Developers - Dropbox](https://www.dropbox.com/developers) から "Create your app" を、そして <ruby><rb>Choose the type of access you need</rb><rp>(</rp><rt>必要なアクセスの種類を選択する</rt><rp>)</rp></ruby> は、 "App folder" を選び、アプリケーションを登録します。

[スタンドアロンアプリでDropbox APIを使ってaccess_tokenを取得する - Qiita](http://qiita.com/kz_morita/items/3ae70b10351a48a806eb) が参考になります。

API の詳細は [HTTP - Developers - Dropbox](https://www.dropbox.com/developers/documentation/http/documentation) を。

## 躓いたところ

Qt Network Authorization で Dropbox API へとアクセスしようと頑張りましたが、 Qt Network Authorization がテクノロジープレビューなためなのか、 Dropbox API が特殊なのか、はたまた両方なのか、現状ハマりどころが多い気がします。

OAuth 1 での Tumblr API アクセスは簡単だったんだけどなぁ、と。

### 認証後の動作を oob 方式にしたいが...

色々試して、一応 oob 方式での認証ができた。


もう少し調べたら Qt Network Authorization の redditclient サンプルで、コールバックによる認証を扱っていたのでそれを参考にすればできそうな感じではある。
ただ、Dropbox では、コールバックアドレスを厳密に設定するように求めているようなので、あらかじめ `http://localhost:12345/` や `http://localhost:12346/` など何個かのローカルアドレスを設定しておき、その中から開けるポートを開いて認証する、ということをすれば多分動くのではないかと思う。


認証を oob (Out-of-band 要するに pin で認証) で行うためには redirect_uri に `oob` とか空文字を設定するのではなく、省略しないとダメだった。
API ドキュメントをよく読むと確かに書いてあったけど、見逃していたorz

`QOAuthOobReplyHandler::callback()` メソッドで `redirect_uri` の値が指定できるが、省略はできないようなので、

```cpp
    setModifyParametersFunction([&](Stage stage, QVariantMap* data) {
        if (Stage::RequestingAuthorization == stage || // 認証要求開始
            Stage::RequestingAccessToken   == stage)   // アクセストークン要求開始
        {
            data->remove(Key::redirectUri);
        }
    });
```

と、このように `QAbstractOAuth::setModifyParametersFunction()` メソッドでパラメータを削除することで対応。

## Pin の設定はどうすれば？

ソースを読んでも、特に Pin を設定するメソッドとかなさそうだったので、自分でシグナルを発行してあげることにした。

```cpp
    void setPinCode(const QString& code)
    {
        QVariantMap data;
        data.insert(Key::error, "");
        data.insert(Key::code, code); // code = access token
        data.insert(Key::state, currentState);
        Q_EMIT callbackReceived(data);
    }
```

こんな感じで `callbackReceived` シグナルに適当なパラメータをセットするとうまくいった。

## なぜ "Content-Type: text/javascript" なの？

アクセストークンを取得するためのエンドポイント `https://api.dropboxapi.com/oauth2/token` の結果がなんと `Content-Type: text/javascript` で返ってきていた。

そう、 `Content-Type: application/json` ではなく。

API ドキュメントを確認すると、他の API では、 `Content-Type: application/json` を返すのにもかかわらず、である。

まあ、ともかく Qt Network Authorization のソースを見ると、`Content-Type: text/javascript` との比較は埋め込みでどうにもならないので、

`QNetworkReply` を派生して

```
    void fixContentType()
    {
        setHeader(QNetworkRequest::ContentTypeHeader, "application/json");
    }
```

のようなメソッドを追加し、無理やりキャストして

```
    void networkReplyFinished(QNetworkReply *reply)
    {
        DropboxOAuthOobReply *reply_ = (DropboxOAuthOobReply *)reply;
        reply_->fixContentType(); // fix content-type, "text/javascript" to "application/json"
        QOAuthOobReplyHandler::networkReplyFinished(reply);
    }
```

このように `networkReplyFinished()` のタイミングで実行することで対応した。

ただ、コンパイラの実装によってはNGかもしれないので、 Qt Network Authorization 側で対応しないとダメだなーと。

## なぜ、クエリしか設定できないのですか？

認証ができて、さあ API を呼び出してみよう、と思ったところで、 Dropbox API は REST API を捨てたようで、全ての呼び出しが POST メソッド、必要なパラメータは `Dropbox-API-Arg` ヘッダ、と特殊なことをしていたために、`QAbstractOAuth::post()` では処理が足りなかった。

そういう訳なので、自分でヘッダとかポストデータとかを設定できるようなメソッドを実装した。

## トークンの保存と復元

これはハマりどころではないですが、前回できなかった認証後の状態の保存処理も実装しました。

保存時は、`QOAuth2AuthorizationCodeFlow::token()` の結果を返すだけです。

```cpp
const QString Dropbox::serialize() const
{
    if (QAbstractOAuth::Status::Granted != status()) {
        return "";
    }
    return token();
}
```

読み込み時は、`setToken()` と `setStatus()` に `QAbstractOAuth::Status::Granted` を設定して、擬似的に認証済み、と状態を変更します。

```cpp
void Dropbox::deserialize(const QString& token)
{
    if (token.isEmpty()) {
        return;
    }

    setToken(token);
    setStatus(QAbstractOAuth::Status::Granted);
}
```

この時、忘れずに認証したよ、のシグナルを定義しているのであれば呼ぶ必要があります。

### その他

https なので通信内容を横から解析ができないので、結構面倒。
どうにか、中間者攻撃風に途中で通信を解析できる方法を作らないと結構デバッグが面倒。

## 目標

とりあえず、Dropbox の アップロードはできたので、ダウンロードや、削除。
`redirect_uri` を指定しての認証や、 Box などの別のオンラインストレージへのアクセスなどを追加していきたいな、と。

## 参考

* [Dropbox APIさわってみた](http://www.slideshare.net/ginpei_jp/dropbox-api-39190004) ※情報が古いっぽい
* [Dropbox API v2 仕様まとめ · GitHub](https://gist.github.com/voluntas/fe9394ce56ef4a305aa14168c09a3991)
* [HTTP - Developers - Dropbox](https://www.dropbox.com/developers/documentation/http/documentation)


