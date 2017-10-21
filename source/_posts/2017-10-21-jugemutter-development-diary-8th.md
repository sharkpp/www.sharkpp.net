---
title: "じゅげむったーの開発日記 その８"
date: 2017-10-21 17:41
tags: [Qt, Twitter, OAuth, C++, cpp, 勉強会, 開発日記, じゅげむったー]
categories: [ブログ]

---

今回は、明日行われる [技術書典３](https://techbookfest.org/event/tbf03) に前日入りして、[Qt 勉強会 @ Tokyo #52](https://qt-users.connpass.com/event/68878/) に参加してきました。

東京の勉強会はすごく久しぶりの参加でした。
以前は、誰かしらが発表をして、それを聞く感じの会でしたが、最近はもくもくがメインのようでした。

レポジトリは ... [sharkpp/Jugemutter: 長文投稿専用クライアント「じゅげむったー」](https://github.com/sharkpp/Jugemutter) となります。

## Twitter API の "Could not authenticate you." 問題

Twitter API への要求で `Could not authenticate you.` とレスポンスが返ってくる問題、どうも [[QTBUG-61125] QOAuth1 creates an invalid signature for percent encoded query - Qt Bug Tracker](https://bugreports.qt.io/browse/QTBUG-61125) のバグが原因ではなかった様子。

なので、ちょっと踏み込んで調べて見ることにする。

とりあえず、比較のために PHP で同じように Twitter API を使って見ることに。

ライブラリは [risan/oauth1: 🔐 OAuth 1.0 client library for PHP](https://github.com/risan/oauth1) をとりあえず試して見る。

何はともあれ composer をインストール

```console
$ php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
$ php -r "if (hash_file('SHA384', 'composer-setup.php') === '544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
$ php composer-setup.php
$ php -r "unlink('composer-setup.php');"
```

ライブラリをインストール

```console
$ php composer.phar require risan/oauth1
```

で、いろいろ試している..

ソースは [risan/oauth1: Basic Usage](https://github.com/risan/oauth1#basic-usage) を基にした。

```php
<?php

// Start session.
session_start();

// Include Composer autoload file.
require 'vendor/autoload.php';

// Create a new instance of OAuth1 client for Twitter.
$oauth1 = new OAuth1\OAuth1([
    'consumer_key'      => 'YOUR_TWITTER_CONSUMER_KEY',
    'consumer_secret'   => 'YOUR_TWITTER_CONSUMER_SECRET',
    'request_token_url' => 'https://api.twitter.com/oauth/request_token',
    'authorize_url'     => 'https://api.twitter.com/oauth/authorize',
    'access_token_url'  => 'https://api.twitter.com/oauth/access_token',
    'callback_url'      => 'http://localhost:80', // Optional
    'resource_base_url' => 'https://api.twitter.com/1.1/'
]);

// STEP 4: ACCESS PROTECTED RESOURCE.
if (isset($_SESSION['access_token'])) {
    // Retrieve the saved AccessToken instance (see STEP 3).
    $accessToken = unserialize($_SESSION['access_token']);

    // Set access token.
    $oauth1->setGrantedAccessToken($accessToken);

    // Get authenticated user's timeline.
    // @return Psr\Http\Message\ResponseInterface instance
    //$response = $oauth1->get('statuses/user_timeline.json');
    $response = $oauth1->post('statuses/update.json', [
        'query' => [
        //'form_params' => [ // risan/oauth1 が対応していない様子
            'status' => 'test',
        ]
    ]);

    echo $response->getBody()->getContents();
}

// STEP 3: GET ACCESS TOKEN.
elseif (isset($_GET['oauth_token']) && isset($_GET['oauth_verifier'])) {
    // Retrieve the previously generated request token (see STEP 1).
    $requestToken = unserialize($_SESSION['request_token']);

    // Get access token.
    // @return OAuth1\Tokens\AccessToken instance
    $accessToken = $oauth1->accessToken($requestToken, $_GET['oauth_token'], $_GET['oauth_verifier']);

    // Serialize AccessToken instance and save it to session.
    $_SESSION['access_token'] = serialize($accessToken);

    // No longer need request token.
    unset($_SESSION['request_token']);

    // Reload page.
    header("Location: {$_SERVER['PHP_SELF']}");
    exit();
}

// STEP 1: Get request token.
// STEP 2: Redirect to authorization page.
else {
    // Get request token.
    // @return OAuth1\Tokens\RequestToken instance
    $requestToken = $oauth1->requestToken();

    // Serialize RequestToken instance and save to session.
    $_SESSION['request_token'] = serialize($requestToken);

    // Redirect to authorization url.
    $authorizationUrl = $oauth1->buildAuthorizationUrl($requestToken);
    header("Location: {$authorizationUrl}");
    exit();
}
```

あれ？

<del>`{"code":32,"message":"Could not authenticate you."}` になるっぽい、なぜだろう？</del> `risan/oauth1` の実装が POST の フォームに対応していなかっただけのようだ。

↑から、URLのクエリ形式で送れば大丈夫っぽい。

<blockquote class="twitter-tweet" data-lang="ja"><p lang="ja" dir="ltr">むぅPOSTのフォームではなくURLのクエリで送れば(や%も大丈夫っぽいなぁ (おわり <a href="https://twitter.com/hashtag/qtjp?src=hash&amp;ref_src=twsrc%5Etfw">#qtjp</a> <a href="https://twitter.com/hashtag/jugemutter?src=hash&amp;ref_src=twsrc%5Etfw">#jugemutter</a></p>&mdash; これでチーム「さめたすたす」は最強だ！ (@sharkpp) <a href="https://twitter.com/sharkpp/status/921656868535021570?ref_src=twsrc%5Etfw">2017年10月21日</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

何か勘違いしているのか？

というところでタイムアップ。

## Twitter API reference の URL が変わった？

なんか、Twitter API のリファレンスページのアドレスが変わっている様子。

```
https://dev.twitter.com/rest/reference/post/statuses/update
```
↓
```
https://developer.twitter.com/en/docs/tweets/post-and-engage/api-reference/post-statuses-update
```

リダイレクトで飛ばして欲しかったなぁ。

## 勉強会

### Qt contributors summit 2017 と Qt World Summit 2017 の報告

2017年10月9日〜10月10日に開催された [Qt Contributors' Summit 2017](https://www1.qt.io/event/qt-contributors-summit-2017/) および、2017年10月10日〜10月12日に開催された [Qt World Summit](https://www1.qt.io/event/qt-world-summit-2017/) の[朝木卓見(@takumiasaki)](https://twitter.com/takumiasaki) さんによる報告。

関連するリンク

* [Qt contributors summit 2017 - Qt Wiki](https://wiki.qt.io/Qt_contributors_summit_2017)
* [Qt contributors summit 2017 Program - Qt Wiki](https://wiki.qt.io/Qt_contributors_summit_2017_Program) - セッションプログラム一覧
* [QtCS2017 QtCore - Qt Wiki](https://wiki.qt.io/QtCS2017_QtCore) - 該当のセッションで出た話
* [Qt 3D Studio Source Code and Pre-Release Snapshots Available - Qt Blog](http://blog.qt.io/blog/2017/10/11/qt-3d-studio-source-code-pre-release-snapshots-available/)
* [KDAB](https://github.com/KDAB)

### Qt 3D Studio の紹介

[岡田 真一(@shin1_okada)](https://twitter.com/shin1_okada) さんによる、Qt 3D Studio の紹介。

現状、macOS向けは、ビルドできるけど大きなデモを動かす、Qt Creator から動作させる、などでクラッシュする、とのこと。

関連するリンク

* [Qt 3D Studio Source Code and Pre-Release Snapshots Available - Qt Blog](http://blog.qt.io/blog/2017/10/11/qt-3d-studio-source-code-pre-release-snapshots-available/)
* [codereview.qt-project Code Review](https://codereview.qt-project.org/#/admin/projects/qt3dstudio/qt3dstudio) - デフォルトだと submodule が取得されないので注意

## 参考

* [SipHashについてのメモ - Qiita](https://qiita.com/hnw/items/d72815e2d45f898d9184)
* [Clients — Guzzle Documentation](http://docs.guzzlephp.org/en/5.3/clients.html)
* [Windows + Goutte 3.0でHTTPSでのリクエストで発生するSSL証明書のエラー - Qiita](https://qiita.com/k-holy/items/4362b8cce85642e477ec)
* [guzzle で Http通信する - Qiita](https://qiita.com/mikakane/items/58c30b243bba697ec3fe)
* [POST statuses/update — Twitter Developers](https://developer.twitter.com/en/docs/tweets/post-and-engage/api-reference/post-statuses-update)
