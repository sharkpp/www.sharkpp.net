---
title: "FuelPHPをphar化してポータブルに！"
tags: [php, FuelPHP, Advent Calendar]
categories: [blog]

---

[FuelPHP Advent Calendar 2013][1] 1日目の参加記事です。

初めましての方もご存知の方も、よろしくお願いします。

[@sharkpp][2]です。

さて、昨年の12月1日はアドベント(待降節)ではありませんでしたが、安心してください、今年は12月1日からアドベントは始まります。

とりあえず、初日なので軽い内容でいきたいと思います。

内容は、FuelPHP を phar(PHP Archive) で１ファイルにしてウェブサーバーで動かしてみよう、です。

子ネタをやりつつ phar の紹介も兼ねています。

環境としては、

  * PHP 5.3 以上
  * FuelPHP 1.7
  * Apache on CentOS or Windows

を想定しています。

## phar(PHP Archive)ってご存知ですか？

まず、大前提。

[PHP: 導入 - Manual][3]によると、

> phar 拡張モジュールは、PHP アプリケーション全体をひとつの "phar" (PHP Archive) ファイルにまとめてしまい、配布やインストールを容易にするためのものです。

となっています。

実際に使われている例としては、

  * [composer.phar][4] パッケージ管理ツール
  * [goutte.phar][5] スクレイピングライブラリ
  * [guzzle.phar][6] HTTPクライアントライブラリ
  * [pyrus.phar][7] PEAR2

などがあります。

例として上げた中でも composer は FuelPHP を使っている方であれば

    $ php composer.phar update
    

と、このような形で触ったことがあると思います。

## FuelPHP をインストール

Pharクラスの中でも、今回は [Phar::webPhar][8] を使います。

まずは、FuelPHPを適当なフォルダに配置します。

詳しい手順は[FuelPHP ドキュメント][9]に書かれているので参考にしてください。

ここでは、`~/fuelphp-1.7` に配置されるものとします。

    $ curl get.fuelphp.com/oil | sh
    $ cd ~
    $ oil create fuelphp-1.7
    

もしくは、

    $ wget http://fuelphp.com/files/download/25 -O fuelphp.zip
    $ unzip fuelphp.zip
    

とすることで、git がインストールされていない場合は fuelphp.com からダウンロードして展開ができます。

次に

    $ cd fuelphp-1.7
    $ php composer.phar self-update
    $ php composer.phar update
    

として、composer自身のアップデートとパッケージを更新します。

これで、Apacheなどのウェブサーバー上に公開するとWelcome画面が表示されるはずです。

## FuelPHPをPharで1ファイルにまとめる

まず、そのままでは1ファイルにまとめても動かないのでいくつかソースを変更する必要があります。

残念なことに core の中も変更する必要がありました。

インストール直後のページを表示できるようにするために変更するファイルは

  * `public/index.php`
  * `fuel/app/config/config.php`
  * `fuel/app/config/asset.php` ※ fuel/core/config/asset.php からコピー
  * `fuel/core/bootstrap.php`
  * `fuel/core/classes/file/area.php`

の 5 個のファイルです。

実際のアプリケーションの場合は先に挙げたファイル以外にも変更が必要になると思います。

変更のポイントは、

  * phar 内からの realpath が常に空文字で返ってくるのでダミー関数に置き換え
  * Windows であっても パスの区切りは `'/'` とする
  * パスに含まれる親ディレクトリへの移動などを削除し正規化
  * ログやキャッシュの保存先が .phar 外を示すようにする

と、主に、ファイルパスに関する物が主となります。

まず、`public/index.php` の変更部分です。

パスを正規化する `canonicalizePath` 関数と `realpath` 関数のダミーとして `realpat_` 関数を定義しています。

     error_reporting(-1);
     ini_set('display_errors', 1);
    
     +function canonicalizePath($path) {
     +    $path = 0===strpos($path,'phar://')?'phar://'.preg_replace('!//!', '/', substr($path,7))
     +                                       :preg_replace('!//!', '/', $path);
     +    do {
     +        $tmp  = $path;
     +        $path = preg_replace('!/[^/]+/\.\./!', '/', $tmp);
     +    } while ($tmp != $path);
     +    return rtrim($path, '/');
     +}
     +
     +function realpat_($path) {
     +    return canonicalizePath(str_replace(array('/', '\\'), '/', $path));
     +}
    

あとは、`realpath` 関数の代わりに `realpat_` 関数を使うようにし、パスの区切りも `'/'` に変更しています。

    -define('DOCROOT', __DIR__.DIRECTORY_SEPARATOR);
    +define('DOCROOT', realpat_(__DIR__.'/'));
    

　

    -define('APPPATH', realpath(__DIR__.'/../fuel/app/').DIRECTORY_SEPARATOR);
    +define('APPPATH', realpat_(__DIR__.'/../fuel/app/').'/');
    

　

    -define('PKGPATH', realpath(__DIR__.'/../fuel/packages/').DIRECTORY_SEPARATOR);
    +define('PKGPATH', realpat_(__DIR__.'/../fuel/packages/').'/');
    

　

    -define('COREPATH', realpath(__DIR__.'/../fuel/core/').DIRECTORY_SEPARATOR);
    +define('COREPATH', realpat_(__DIR__.'/../fuel/core/').'/');
    

`fuel/app/config/config.php` の変更部分です。 .phar 内には書き込めないので .phar と同じ場所の `writable` ディレクトリを示すように変更しています。

**保存先は公開ディレクトリ外を示すべきなので、さらに一つ上などに示すようにするのが本来は良いでしょう。**

    -    // 'cache_dir'       => APPPATH.'cache/',
    +    'cache_dir'       => canonicalizePath(str_replace('phar://', '', APPPATH).'../../../writable/cache/'),
    

　

    -    // 'log_path'         => APPPATH.'logs/',
    +    'log_path'         => canonicalizePath(str_replace('phar://', '', APPPATH).'../../../writable/logs/'),
    

`fuel/app/config/asset.php` の変更部分です。 `fuel/core/config/asset.php` をコピーして使うのでそのファイルとの比較になります。 一部、三項演算を使っていますが phar でまとめない場合にもそのまま動くようにとの苦肉の策です。

    -    'paths' => array('assets/'),
    +    'paths' => array(DOCROOT . 'assets/'),
    

　

    -    'url' => Config::get('base_url'),
    +    'url' => Config::get('base_url').(0===strpos(__DIR__,'phar://')?'index.phar/':''),
    

　

    -    'add_mtime' => true,
    +    'add_mtime' => false,
    

`fuel/core/bootstrap.php` の変更部分です。 パスの区切りの変更と関数の置き換えです。

    -define('DS', DIRECTORY_SEPARATOR);
    +define('DS', '/');
    
    -defined('VENDORPATH') or define('VENDORPATH', realpath(COREPATH.'..'.DS.'vendor').DS);
    +defined('VENDORPATH') or define('VENDORPATH', realpat_(COREPATH.'..'.DS.'vendor').DS);
    

最後、`fuel/core/classes/file/area.php` の変更部分です。

             {
    -            $this->basedir = realpath($this->basedir) ?: $this->basedir;
    +            $this->basedir = realpat_($this->basedir) ?: $this->basedir;
             }
    

　

             {
    -            $pathinfo['dirname'] = realpath($pathinfo['dirname']);
    +            $pathinfo['dirname'] = realpat_($pathinfo['dirname']);
             }
             else
             {
                 // attempt to get the realpath(), otherwise just use path with any double dots taken out when basedir is set (for security)
    -            $pathinfo['dirname'] = ( ! empty($this->basedir) ? realpath($this->basedir.DS.$pathinfo['dirname']) : realpath($pathinfo['dirname']) )
    +            $pathinfo['dirname'] = ( ! empty($this->basedir) ? realpat_($this->basedir.DS.$pathinfo['dirname']) : realpat_($pathinfo['dirname']) )
                         ?: ( ! empty($this->basedir) ? $this->basedir.DS.str_replace('..', '', $pathinfo['dirname']) : $pathinfo['dirname']);
    

一つ一つ編集するのが大変であれば [Gist][10] に差分をアップしたので

    $ cd fuelphp-1.7
    $ wget -q https://gist.github.com/sharkpp/7716098/raw -O - | patch -u -p0
    

とすることで変更を適用することができます。

次は、phar の生成スクリプトです。

    <?php
    /*
     * Copyright (c) 2013 sharkpp
     * This software is released under the MIT License.
     * http://opensource.org/licenses/mit-license.php
     */
    // 確実に削除 
    @unlink('index.phar');
    // phar書庫作成のためクラスを生成 
    $phar = new Phar(__DIR__ . '/index.phar', 0, 'index.phar');
    // fuelphp17 ディレクトリ丸ごと固める 
    $phar->buildFromDirectory(__DIR__ . '/fuelphp-1.7/');
    // gzipで圧縮
    //$phar->compressFiles(Phar::GZ); // ※ css などがうまく取り出せない
    // 起動スタブを設定 
    $phar->setStub(<<<'EOD'
    <?php
        function phar_rewrites($path) {
            if (0 === strpos($path,'/assets/'))
                return '/public' . $path;     // assets だけはパスを変更 
            return '/public/index.php'.$path; // あとはすべてindexに渡す 
        }
        Phar::interceptFileFuncs();
        Phar::webPhar('index.phar', 'public/index.php', '', array(), 'phar_rewrites');
        __HALT_COMPILER(); ?>
    EOD
    );
    

FuelPHP をインストールした fuelphp-1.7 ディレクトリの上にファイルを保存してください。

こちらも [Gist][11] にアップしてあるので、

    $ cd ~
    $ wget -q https://gist.github.com/sharkpp/7716423/raw/mkphar.php
    

として、ローカルに保存できます。

準備ができたら

    $ php mkphar.php
    

と入力して、index.phar を作成すると、70MBぐらいのファイルが出来上がります。

ドキュメントや .git などが含まれているので巨大になってしまいました。

**ちなみに、Pharクラスでアーカイブを作成するには設定を変える必要があるかもしれません。**

具体的には、`php.ini` の `Phar` セクション内で `phar.readonly = Off` と設定されている必要があります。

## ブラウザで確認

ここまでできたら index.phar をウェブサーバーの公開フォルダに置きましょう。

と、その前に、 AddType で .phar を php で実行できるように `.htaccess` を設置しましょう。

    Options +FollowSymLinks
    DirectoryIndex index.phar
    AddType application/x-httpd-php .phar
    
    <IfModule mod_rewrite.c>
        RewriteEngine on
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        <IfModule mod_fcgid.c>
            RewriteRule ^(.*)$ index.phar?/$1 [QSA,L]
        </IfModule>
        <IfModule !mod_fcgid.c>
            <IfModule mod_php5.c>
                RewriteRule ^(.*)$ index.phar/$1 [L]
            </IfModule>
            <IfModule !mod_php5.c>
                RewriteRule ^(.*)$ index.phar?/$1 [QSA,L]
            </IfModule>
        </IfModule>
    </IfModule>
    

こちらも例によって [Gist][12] にアップしてあるので、

    $ wget -q https://gist.github.com/sharkpp/7718075/raw/.htaccess
    

で取得できます。

例えば、ローカルホストでウェブサーバーを動かしていてドキュメントルートに先の .htaccess と共に置いたのであれば、

    http://127.0.0.1/
    

にブラウザでアクセスすると Welcome 画面が表示されます。

    http://127.0.0.1/hello
    

にアクセスすると hello と表示されます。

    http://127.0.0.1/xxxx
    

エラーページも表示できます。

## まとめ

お遊びのつもりで手を出してみたら、かなり時間をかけないとうまくいかなかったりで当てが外れてちょっとションボリ。

実際問題として core の修正が必要となるので実用性となると皆無だと思います。

ただ、１ファイルでウェブサーバーにアプリが公開できるのは、うまく作れば面白いことが出来るのではないかとの期待が持てそうな機能でした。

明日は [@kenji_s][13] さんの「[FuelPHPの開発環境を20分で構築する（Vagrant編）][14]」です。お楽しみに！

 [1]: http://atnd.org/events/45096
 [2]: https://twitter.com/sharkpp
 [3]: http://jp2.php.net/manual/ja/intro.phar.php
 [4]: http://getcomposer.org/
 [5]: https://github.com/fabpot/goutte
 [6]: https://github.com/guzzle/guzzle
 [7]: http://pear2.php.net/PEAR2_Pyrus
 [8]: http://jp2.php.net/manual/ja/phar.webphar.php
 [9]: http://fuelphp.jp/docs/1.7/
 [10]: https://gist.github.com/sharkpp/7716098
 [11]: https://gist.github.com/sharkpp/7716423
 [12]: https://gist.github.com/sharkpp/7718075
 [13]: https://twitter.com/kenji_s
 [14]: http://blog.a-way-out.net/blog/2013/12/02/quick-mastering-fuelphp/