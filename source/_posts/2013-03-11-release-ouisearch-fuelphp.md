---
title: "OUIを検索するFuelPHP用のパッケージを作ったよ"
date: 2013-03-11 01:57:00
tags: [php, Develop, FuelPHP]
categories: [ブログ]

---

OUIを検索するFuelPHP用のパッケージを作ったよってことで、、、誰得なんでしょうか？

何が出来るかというと、[IEEE-SA - Registration Authority OUI Public Listing][1]で 公開されているOUI(Organizationally Unique Identifier)のリストを使いOUIから組織名の取得、あるいは、その逆を行います。

 [1]: http://standards.ieee.org/develop/regauth/oui/public.html

ソース→[sharkpp/fuel-ouisearch - GitHub][2] Travis CI→[fuel-ouisearch][3] [![Build Status][4]][3]

 [2]: https://github.com/sharkpp/fuel-ouisearch
 [3]: https://travis-ci.org/sharkpp/fuel-ouisearch
 [4]: https://travis-ci.org/sharkpp/fuel-ouisearch.png?branch=master

まあ、誰得かは置いておいて、今回は、

  * 単体テストを実装
  * プラグインでタスクを実装
  * プラグインでマイグレーションを実装
  * [Travis CI][5]使ってみたよ

 [5]: https://travis-ci.org/

の、４本です。

パッケージは誰得だとしても、その過程は有用だ！と信じたい、、、、

## 単体テストを実装

今回のパッケージはサンプル作るのもあれなのでテストで代用って側面もありテスト書きながら実装していきました。

テストカバレッジレポートとか見ながら作るとなんだか楽しいです。

### 参考ページ

  * [FuelPHP での PHPUnit によるユニットテスト - A Day in Serenity @ kenjis][6]
  * [ユニットテストのすすめ][7]
  * [PHPUnit Manual][8]

 [6]: http://d.hatena.ne.jp/Kenji_s/20111110/1320922825
 [7]: http://ounziw.com/2012/12/06/phpunit/
 [8]: http://www.phpunit.de/manual/3.8/ja/index.html

### XDebugがないとテストカバレッジレポートが作成できない

あ、テストカバレッジレポートを出力するにはXDebugが必要っぽいです。 インストールされていなかったので **"The Xdebug extension is not loaded. No code coverage will be generated."** って怒られちゃいました。

テストカバレッジレポートをHTMLで出力する場合はファイルパスの指定ではなくディレクトリの指定になります。

    php oil t --coverage-html=coverage
    

見たいな感じ。 HTML出力のみディレクトリ指定なので間違えないようにしませう。

## プラグインでタスクを実装

これは、そんなに大変ではなかった、というか、以前に同じようなことをしていて簡単だった。

しいて言えば、最初はORMパッケージを使う実装にしていて色々やっていたけど、 よく考えると他のパッケージに依存するほどでもないのでそのあたりをばっさり削除して作り直しています。

より詳しく書くと、ORMで設定からテーブル名を指定しようとしていたけど、設定をテーブル名に反映するタイミングが 最初は見つからず右往左往していたけど、結局は[Classes - General - FuelPHP Documentation][9]に書いてあった。

 [9]: http://fuelphp.com/docs/general/classes.html

<blockquote class="twitter-tweet" data-conversation="none" lang="ja"><p>@<a href="https://twitter.com/sharkpp">sharkpp</a> 必要としているタイミングはクラスのロード時ですか？であるなら、_init()が呼ばれます。<a href="http://t.co/PSGMSXIzTH" title="http://fuelphp.com/docs/general/classes.html#/init_method">fuelphp.com/docs/general/c…</a></p>&mdash; Shintaro Ikezakiさん (@hackoh) <a href="https://twitter.com/hackoh/status/310210084334612480">2013年3月9日</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

## プラグインでマイグレーションを実装

これが以外と難儀だった。 ソースを追うと、パッケージやモジュールに対してもマイグレーション処理が 動作するっぽかったので意気揚々と実装していったのだけれども、、、

### 設定をしないと動作しない

パッケージを app/config/config.php の always_load.packages に登録する必要はもちろんあるのだけれど、それだけではだめでした。 package_paths に PKGPATH を追加しないとやっぱり動作しない。 これはなんかバグくさい気がする。

### コマンド打っても反応しない

    php oil r migrate
    

と単純にコマンドを打っても反応しない！ で、ソースを追っていったら、何もしないとパッケージなどはマイグレーションの対象外になる模様。 なので、

    php oil r migrate --all
    

などとやるのが正解。

## [Travis CI][5]使ってみたよ

簡単、CIサービス [Travis CI][5] を使ってみました。

### 参考ページ

  * [madroom project: FuelPHPのユニットテストをTravis CIで実行してみる][10]
  * [madroom project: FuelPHPのマイグレーションをTravis CIで実行する][11]
  * [laravel-oneauth/.travis.yml at master - codenitive/laravel-oneauth - GitHub][12]
  * [fuelphp/.travis.yml at develop - fuelphp/fuelphp - GitHub][13]

 [10]: http://madroom-project.blogspot.jp/2013/01/fuelphptravis-ci.html
 [11]: http://madroom-project.blogspot.jp/2013/01/fuelphptravis.html
 [12]: https://github.com/codenitive/laravel-oneauth/blob/master/.travis.yml
 [13]: https://github.com/fuelphp/fuelphp/blob/develop/.travis.yml

### ドキュメントに嘘付かれた(´･ω･\`)

[Build Lifecycle][14]は間違っているっぽいです。 before_install の後で clone したディレクトリに移動するって書いてありますが、cloneした直後に移動していました。 途中で仕様が変わったんでしょうか？

 [14]: http://about.travis-ci.org/docs/user/build-configuration/#Build-Lifecycle

### なんだかんだで出来た

<blockquote class="twitter-tweet" lang="ja"><p>@<a href="https://twitter.com/sharkpp">sharkpp</a> パッケージテスト用のFuelPHPプロジェクトをGitHubに用意。パッケージはサブモジュールで管理。とかは比較的簡単かもしれませんね。そのパッケージプロジェクトへのpushではtravis ciが走らない。1プロジェクトで複数パッケージを管理。になりますけど。</p>&mdash; mamorさん (@madmamor) <a href="https://twitter.com/madmamor/status/310629656120397824">2013年3月10日</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

という、アイデアを頂きつつ、やっぱり単体でテストできるのがかっこいいので頑張りました。

[![Travis CI][15]][16]

 [15]: /images/2013_0311_ouisearch_travisci_s.png
 [16]: /images/2013_0311_ouisearch_travisci.png

最終的に完成した .travis.yml は、[fuel-ouisearch/.travis.yml at master ? sharkpp/fuel-ouisearch ? GitHub][17] です。 中身はたいしたことをやっていなくて

 [17]: https://github.com/sharkpp/fuel-ouisearch/blob/master/.travis.yml

  1. git clone で FuelPHP を取得
  2. packages にリンクを張る
  3. 設定を上書き
  4. MySQLにデーターベースを作成(user:root pass:なし)
  5. テスト実行

ってことをつらつらと書いているだけです。

とりあえず、Travis CI のテンプレが出来たのはいい感じです。
