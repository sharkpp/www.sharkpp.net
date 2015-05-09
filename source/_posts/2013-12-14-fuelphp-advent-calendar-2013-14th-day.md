---
title: "Request_Curlにまつわるエトセトラ"
tags: [php, FuelPHP]
categories: [blog]

---

[FuelPHP Advent Calendar 2013][1] 14日目。

[@sharkpp][2]です。

昨日は [@soudai1025][3] さんの「[FuelPHP（TwitterBootstrap3）でJQueryのプラグインのdataTablesを使う][4]」でした

2回目の FuelPHP Advent Calendar 2013 登場となります。

## Request_Curl 使っていますか？

さて、[Request_Curl][5] 使ってますか？

えっ？ [Guzzle][6] のが便利だからそっち使ってるですって？

まあ、そう言わずに Request_Curl は標準で含まれているので使ってみませんか？

簡単な使い方：

    $url = 'http://www.example.net/';
    $curl = \Request::forge($url, 'curl');
    $curl->execute();
    $response = $curl->response();
    echo $response->body;
    

ね！簡単でしょ？

## GET/POST時のパラメータ指定

GET/POST時のパラメータの指定は通常であれば、

    $param['user'] = 'john';
    $param['data'] = 'test';
    $curl->set_params($param);
    

で問題ありません。

が、`http://www.example.net/?user=john&user=smith` のように同じキーが複数存在する場合は先の方法ではうまくいきません。 そもそも、そんな指定はありえない？いえいえ、実際にこのような指定をするアプリケーションがありました。

そんな場合は、

    // Copyright (c) 2013 sharkpp
    // This function is released under the MIT License.
    // http://opensource.org/licenses/mit-license.php
    function build_query($data) {
      array_walk($data, function(&$value, $key){
          is_array($value) ?: $value = array($value);
          $value = array_map(function($value){ return urlencode($value); }, $value);
          $value = implode('&'.$key.'=', $value);
          $value = $key.'='.$value;
        });
      return implode('&', $data);
    }
    

のようなクエリ文字列の構築関数を使って

    $param['user'] = array('john', 'smith');
    $curl->set_params(build_query($param));
    

とすればOKです。

実はドキュメントに書かれていないですが、`Request_Curl::set_params()` の引数に文字列を渡すとクエリ文字列としてそのまま使ってくれます。

## Cookie はおいしい？

Cookie の与え方も簡単です。

    // Copyright (c) 2013 sharkpp
    // This function is released under the MIT License.
    // http://opensource.org/licenses/mit-license.php
    protected static function build_cookie($data) {
        if (is_array($data)) {
            $cookie = '';
            foreach ($data as $key => $value) {
                $cookie[] = $key.'='.urlencode($value);
            }
            if (count($cookie) > 0) {
                return trim(implode('; ', $cookie));
            }
        }
        return false;
    }
    

こんな関数を用意して

    $cookie['hoge'] = 'test';
    $cookie['fuga'] = '1234';
    $curl->set_option(CURLOPT_COOKIE, build_cookie($cookie));
    

とすればOKです。

## PHP さんですか？いえいえ IE11 です

User Agent 略して UA の偽装ももちろんできます。

    $UA = 'Mozilla/5.0 (Windows NT 6.3; WOW64; Trident/7.0; Touch; rv:11.0) like Gecko';
    $header['User-Agent']= $UA;
    foreach ($header as $key => $value) { $curl->set_header($key, $value); }
    

ちなみに、ヘッダの複数指定は出来ないようなので `foreach` で連想配列を処理して登録しています。 一回ずつ`Request_Curl::set_header()` を呼び出してもいいですが `foreach` の方が見やすい気がします。

## SSLが検証できない？大丈夫だ、問題ない

まったくもって大丈夫じゃないですが、、、そんな時もあります。

https なサーバーに対してアクセスする場合に、どうにもエラーが出てうまくいかない場合があります。

本来は無効にすべきではないのですが、SSLの証明書の検証を無効にすることも出来ます。

    $curl->set_option(CURLOPT_SSL_VERIFYPEER, false);
    

本来は

    $curl->set_option(CURLOPT_CAINFO, 'path/to/cacert.pem');
    

のような感じで検証用のファイルを指定するようですがうまくいきませんでした。

## あれ？

あれ？ちょっと `Request_Curl::set_option()` がいっぱい出てくるのだけれど、、、

あ、気が付かれましたか。 名前の通りと言ったところではあるのですが、 `curl_*` のラッパーになっているため、 [PHP: curl_setopt - Manual][7] 辺りを見ながら `Request_Curl::set_option()` に引数を与えてあげれば色々な事が出来ます。

クラス内部で色々やっているのですべてのオプションが確実に指定できるとは限らないですがある程度は自由に出来るようです。

と言うことで、 `Request_Curl` クラスの紹介でした。

明日は [@Tukimikage][8] さんの「[続・Cloudn_PaaSでFuelPHPを動かしてみた][9]」です。お楽しみに！

 [1]: http://atnd.org/events/45096
 [2]: https://twitter.com/sharkpp
 [3]: https://twitter.com/soudai1025
 [4]: http://soudai1025.blogspot.com/2013/12/fuelphp-datatables.html
 [5]: http://fuelphp.jp/docs/1.7/classes/request/curl.html
 [6]: https://github.com/guzzle/guzzle
 [7]: http://jp2.php.net/curl_setopt
 [8]: https://twitter.com/Tukimikage
 [9]: http://think-sv.net/blog/?p=1290