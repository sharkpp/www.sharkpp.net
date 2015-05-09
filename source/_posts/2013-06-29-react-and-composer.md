---
title: "React楽しい＆composerは怖くない"
tags: [php]
categories: [blog]

---

phpのイベントドリブンでノンブロッキングなライブラリであるところの [React][1] を使って見ました。

とりあえずメモ的な何かになっています。 インストールから順に、ググってもやり方が見つからなかった非同期にデータを受信しつつURLごとに分けてバッファに詰めていく方法なんぞを書いていきたいと思います。

最近のバージョンのPHPを使いこなしているPHPerの人たちには当たり前の機能を使っているので見つからないのが不思議なんだけど、、、きっと検索の仕方が悪かったんだろうな。

## Reqctのインストール

githubのページ([reactphp/react - GitHub][2])に書いてある通りに、

    {
        "require": {
            "react/react": "0.3.*"
        }
    }
    

こんな感じに composer.json に記述して

    # php composer.phar update
    

を実行するだけです。 すると、

    # php composer.phar update
    Loading composer repositories with package information
    Updating dependencies (including require-dev)
      - Installing react/promise (v1.0.4)
        Loading from cache
    
      - Installing guzzle/parser (v3.7.0)
        Downloading: 100%
    
      - Installing evenement/evenement (v1.0.0)
        Loading from cache
    
      - Installing react/react (v0.3.2)
        Downloading: 100%
    
    react/react suggests installing ext-libevent (*)
    react/react suggests installing ext-libev (*)
    Writing lock file
    Generating autoload files
    

って感じでカレントディレクトリにvenderディレクトリができて必要なファイルがダウンロードされます。

composer 便利だね(>_<)

## サンプル見ながら使ってみる

で、いきなりソースなんだけれど

    <?php
    
    include_once __DIR__.'/vendor/autoload.php';
    
    $urls = array();
    $urls[] = 'http://www.google.co.jp/';
    $urls[] = 'http://example.iana.org/';
    
    $r = array();
    
    $loop       = React\EventLoop\Factory::create();
    $dnsResolverFactory = new React\Dns\Resolver\Factory();
    $dns        = $dnsResolverFactory->createCached('8.8.8.8', $loop);
    $factory    = new React\HttpClient\Factory();
    $httpclient = $factory->create($loop, $dns);
    
    // 出力ヘッダを用意
    $headers = array(
                'User-Agent' => 'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/6.0)'
                );
    
    do {
        foreach (is_array($urls) ? $urls : array($urls) as $url)
        {
            $r[$url] = array('url'      => $url,
                             'data'     => '',
                             'complete' => false,
                             'error'    => false);
            $rr      = &$r[$url];
            $request = $httpclient->request('GET', $url, $headers);
            // データを要求(ここでは登録だけ)
            $request->on('response', function (React\HttpClient\Response $response) use (&$rr) {
                $response->on('data', function ($data) use (&$rr) {
                    $rr['data'] .= $data;
                });
                $response->on('end', function ($error, $response) use (&$rr) {
                    $header = $response->getHeaders();
    var_dump($header);
                    if (!isset($header['Content-Length']) ||
                        strlen($rr['data']) == $header['Content-Length'])
                    {
                        $rr['complete'] = true;
                    }
                });
                $response->on('error', function ($error, $response) use (&$rr) {
                    $rr['complete'] = true;
                    $rr['error']    = true;
                });
            });
            $request->end();
        }
        // 通信開始
        $loop->run();
        // 受信完了していない対象をリトライする
        $urls = array();
        foreach ($r as $r_)
        {
            if (!$r_['complete'] && !$r_['error'])
            {
                $urls[] = $r_['url'];
            }
        }
    } while (!empty($urls));
    
    $r = array_values($r);
    
    var_dump($r);
    

って感じで [Google Japan][3] と [Example.net][4] からページを取得して、バッファに入っていることを確認しているだけです。

    #php test.php
    array(2) {
      [0] =>
      array(5) {
        'url' =>
        string(24) "http://www.google.co.jp/"
        'data' =>
        string(67371) "<!doctype html><html itemscope="itemscope" itemtype="http://schema.org/WebPage"><head><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta content="text/html; charset=UTF-8" http-equiv="content-type"><meta content="世界中のあらゆる情報を検索するためのツールを提供しています。さまざまな検索機能を活用して、お探しの情報を見つけてください。" name="description"><meta content="noodp" name="robots"><meta itemprop="image" content="/images/google_favi"...
        'complete' =>
        bool(true)
        'error' =>
        bool(true)
      }
      [1] =>
      array(5) {
        'url' =>
        string(24) "http://example.iana.org/"
        'data' =>
        string(1270) "<!doctype html>\n<html>\n<head>\n    <title>Example Domain</title>\n\n    <meta charset="utf-8" />\n    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />\n    <meta name="viewport" content="width=device-width, initial-scale=1" />\n    <style type="text/css">\n    body {\n        background-color: #f0f0f2;\n        margin: 0;\n        padding: 0;\n        font-family: "Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;\n        \n    }\n    div {\n        width: 600px;\n        m"...
        'complete' =>
        bool(true)
        'error' =>
        bool(true)
      }
    }
    

実行すると、上のような感じで受信が完了後にデータがバッファに収納されています。

ここでの肝は、phpのクロージャを使って取得対象のアドレスごとに受信用のバッファを確保し、それを受け渡しています。

Reactの機能でアクセス中のURLを取得したりできないか頑張ってみましたけどうまくいかず、ソースを眺めていたら見たことない構文を見つけたのです。 で、マニュアルで調べると [PHP: 無名関数 - Manual][5] にスコープの外の変数を参照する方法が書かれていたので試してみたらうまくいったってのが事の真相。

PHP 5.3 から使える構文のようでしたが完全にスルーしてましたorz

## 注意点

なんか、ダウンロードが途中で失敗する場合や全部のリクエストを処理してくれないことがあるみたい。 たぶん、受信タイムアウトっぽい。

全部処理できないのは完了したのを覚えておいてリトライをすればいいし、途中で中断するのは Content-Length があれば比較すればOKみたい。

## まとめ

  * [PHP: 無名関数 - Manual][5] を使うと React で受信中に受信中のURLやデータをバッファに詰めたりできるよ
  * 受信タイムアウトはまれに起きる場合があるので注意！
  * composer 怖くない、 composer 友達
  * React 楽しい！

 [1]: http://reactphp.org/
 [2]: https://github.com/reactphp/react#install
 [3]: http://www.google.co.jp/
 [4]: http://example.iana.org/
 [5]: http://www.php.net/manual/ja/functions.anonymous.php