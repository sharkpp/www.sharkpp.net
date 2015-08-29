---
title: "FuelPHPのメモ"
date: 2015-08-23 18:00
tags: [雑記, FuelPHP, php, メモ]
categories: [ブログ]

---

落ち葉拾い的な？

SSDの肥やしになっていたのをサルベージしてきました。

FuelPHP を使っている中で気がついたことのメモです。

## Orm\Model_Temporal を使うときの注意点

[Orm パッケージ](http://fuelphp.com/docs/packages/orm/intro.html)の [Model_Temporal](http://fuelphp.com/docs/packages/orm/model/temporal.html) という、データを履歴管理するのに便利そうなモデルが FuelPHP 1.6 以降で実装されています。

このモデルを使っているときにちょっと気がついたことがあるのでメモしておきます。

とりあえず、モデルは次のような感じで用意します。
`mysql_timestamp` に `true` と指定しているのが [Temporal Model - Orm Package - FuelPHP Documentation](http://fuelphp.com/docs/packages/orm/model/temporal.html) の例と違うところですが、 `false` でも同じ問題が起きます。 **要確認**

```php
// app/classes/model/mytemporal.php
class Model_MyTemporal extends Orm\Model_Temporal
{
    protected static $_primary_key = array('id', 'temporal_start', 'temporal_end');
    protected static $_temporal = array(
        'start_column' => 'temporal_start',
        'end_column' => 'temporal_end',
        'mysql_timestamp' => true, // ここを true に
    );
}
```

テストで↓のようなのを実行します。

```php
// app/tests/model/mytemporal.php

$model = new Model_MyTemporal();
$model->save();
```

そして実行

```bash
[root@localhost test_temporal_model]# oil t --group=App
Tests Running...This may take a few moments.
PHPUnit 3.7.31 by Sebastian Bergmann.

Configuration read from /var/www/html/test_temporal_model/fuel/core/phpunit.xml

.

Time: 68 ms, Memory: 22.50Mb

OK (1 test, 5 assertions)
```

日付を 2040/1/1 00:00 にしてみると、、、

下は失敗、、、、

```bash
[root@localhost test_temporal_model]# date 010100002040
2040年  1月  1日 日曜日 00:00:00 JST
[root@localhost test_temporal_model]# oil t --group=App
Tests Running...This may take a few moments.
PHPUnit 3.7.31 by Sebastian Bergmann.

Configuration read from /var/www/html/test_temporal_model/fuel/core/phpunit.xml

E

Time: 12 ms, Memory: 20.50Mb

There was 1 error:

1) Test_Model_MyTemporal::test_save_and_between
PDOException: SQLSTATE[HY000]: General error: 2013 Lost connection to MySQL server during query

/var/www/html/test_temporal_model/fuel/core/classes/database/pdo/connection.php:150
/var/www/html/test_temporal_model/fuel/core/classes/database/pdo/connection.php:113
/var/www/html/test_temporal_model/fuel/core/classes/database/pdo/connection.php:167
/var/www/html/test_temporal_model/fuel/core/classes/database/query.php:287
/var/www/html/test_temporal_model/fuel/core/classes/dbutil.php:621
/var/www/html/test_temporal_model/fuel/core/classes/migrate.php:595
/var/www/html/test_temporal_model/fuel/core/classes/migrate.php:74
/var/www/html/test_temporal_model/fuel/core/classes/autoloader.php:364
/var/www/html/test_temporal_model/fuel/core/classes/autoloader.php:247
/var/www/html/test_temporal_model/fuel/app/tests/model/mytemporal.php:12

FAILURES!
Tests: 1, Assertions: 0, Errors: 1.
[root@localhost test_temporal_model]# 
```

まあ、詳しくは調べていないですが、どうやら MySQL で 32ビットで日付を扱っているためのようです。

[MySQLの日付型の扱い方や機能をまとめてみました | つかびーの技術日記](http://tech-blog.tsukaby.com/archives/179) などを見ると DATETIME 型を使うといいようですね。

## Opauth クラス メモ

* Opauth::forge() ではプロバイダのIdは大文字小文字区別して、一致しないと、 **`Unsupported or undefined Opauth strategy - XXXXX`** と例外が発行される、基本小文字？
* **`Authentication error: the callback returned an error auth response`** とログイン時に出た場合、Webサーバーを再起動すれば直る、、、かも(なんかセッションが残ってるか、期限が切れてるけどリセットできてない？)
* 設定の `opauth.auto_registration` を true にしておけば、ユーザー名とメールアドレスがあれば、初めての認証時に自動でユーザー登録してログインできる(Twitterはメールアドレスが取得できないので無理そう)
* ログイン中にOauthでアカウントと関連付けると、既に別のアカウントで関連づけていても関連付けが変更される(A ユーザーに Twitter の @hoge を関連づけた後、 B ユーザーでログイン中に @hoge に関連づけると、関連づけされているユーザーが A あら B に変更されてしまう、 `login_or_register()` の戻り値は `'linked'`)
* 関連付けの解除は存在しないので、解除したい場合は `_providers` から `parent_id` と `provider` で探して削除する

## Ormauth クラス メモ

* `Auth::member()` は `Auth::member($group, $user)` ではなく `Auth::member($group, 'Ormgroup', $user)` っぽい(それでも欲しかった情報が取得できなかったけど)

## Orm クラス メモ

* `Model_SoftDelete` は `Model_XXX::query()` からは 論理削除が出来ないので `Model_XXX::find()` で探してから削除する
* `Model_SoftDelete` は `Model_XXX::find('all'`) では削除が呼び出せないので foreach でまわして処理する
* `Model_Temporal::query()` で検索すると全ての履歴が範囲に含まれてしまうので、自分で `where('temporal_start', '<=', $timestamp)->where('temporal_end', '>=', $timestamp)` として制限を掛けないと最新の履歴のみが取得できない
* `hoge IN SUBQUERY` なサブクエリを使うときには `->where('id', 'in', DB::expr('('.$subQuery->get_query(true).')'))` とすれば一応使える
* `Model_Soft::disable_filter()` は `Model_Soft::query()` の前で使用しないと効果がない。
* `$this->_is_new` を `true` にした場合、 `_original_relations` もクリア(リレーションごとに空に)しないと new したときと同じ動作にならない。
* `Model_Huga::query()->related('hoge')->where('hoge.id', '!=', null)->get_one()` すると結果がおかしくなることがあるので `Model_Huga::query()->related('hoge')->where('hoge.id', '!=', null)->limit_row(1)->get()` とする(参考：[php - Fuelphp ORM related limit ignored - Stack Overflow](http://stackoverflow.com/questions/13399884/fuelphp-orm-related-limit-ignored))

## File クラス メモ

* `$area->read_dir()` では `File_Handler_Directory` が返されるのでこのオブジェクトのインターフェースを通してディレクトリ内のファイルの一覧を取得することはできない。

## その他 メモ

* `oil t` など CLI インターフェースでは Asset は使えないので `Config::set('assets.fail_silently', true);` しておくとエラーが出ない(暫定)
* `DomainException: Form instance already exists, cannot be recreated. Use instance() instead of forge() to retrieve the existing instance.` って言われたらリクエスト内で `::forge('hoge')` の `hoge` が同じ物が居るってこと

## まとめ

とりあえず、フレームワークを触るとドキュメントに載っていないことが色々でてくるのはしょうがないのかなぁと思います。

まぁ、そのうち、整理してまとめたいなぁとは思いますが、きっと手つかずのままになるの未来予想が出来てしまいます。

