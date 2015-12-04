---
title: "NestedSets Model を使って FuelPHP 用コメントボックスパッケージを作った話"
date: 2015-12-05 01:00
tags: [Advent Calendar, php, FuelPHP]
categories: [ブログ]

---

こんにちは、こんばんは、昨日に引き続き [FuelPHP Advent Calendar 2015](http://qiita.com/advent-calendar/2015/fuelphp) の 5 日目を担当する [@sharkpp](https://twitter.com/sharkpp) です。

今回は、一番最後に追加された [NestedSets Model](http://fuelphp.com/docs/packages/orm/model/nestedset.html) (日本語訳は [NestedSets Model @ fuelphp.jp](http://fuelphp.jp/docs/1.8/packages/orm/model/nestedset.html) を参照) を使って [Disqus](https://disqus.com/) や [Facebook Comments](https://developers.facebook.com/docs/plugins/comments) のようなものを貼り付けられる FuelPHP パッケージを作ってみた話をしようかと思います。

実際のパッケージは [sharkpp/fuel-commentbox](https://github.com/sharkpp/fuel-commentbox) からダウンロードできます。

[<img src="{{ thumbnail('/images/2015_1205_fuel_5th_example.png', 512, 512) }}" alt="画面例">](/images/2015_1205_fuel_5th_example.png)

こんな画面になります。

## NestedSets Model の使い方

使い方を、、、と言いつつ、実際は公式ドキュメントの [NestedSets Model](http://fuelphp.com/docs/packages/orm/model/nestedset.html) (日本語訳は [NestedSets Model @ fuelphp.jp](http://fuelphp.jp/docs/1.8/packages/orm/model/nestedset.html) を参照) を参照すれば簡単に使えてしまうぐらいに整っていると思います。

基本的な機能は `\Orm\Model_Nestedset` からの派生としてモデルクラスを作れば特に考えることもなく用意されたものを使うことができます。

`model/commentbox.php`

```php
namespace Commentbox;

class Model_Commentbox extends \Orm\Model_Nestedset
{
	protected static $_properties = array(
```

のような感じです。

[oil generate](http://fuelphp.jp/docs/1.8/packages/oil/generate.html#/model_nestedset) のドキュメントを参照すると

```bash
$ php oil g model post title:varchar[50] body:text user_id:int --nestedset
```

と、実は、このような感じでスケルトンを作ることもできるため、ドキュメントを見ながら必要なフィールドを用意したりマイグレーションコードを用意したりする必要もなく、簡単に機能の実装に入ることができます。

[multi tree に必要なフィールドを追加 · sharkpp/fuel-commentbox@a222248](https://github.com/sharkpp/fuel-commentbox/commit/a2222480c0151b9f9a68f5e1336d2f4b50360343#diff-5d2aaa6da1e3955b9a2582f5894e5d8e)

```diff
 @@ -8,6 +8,7 @@ class Model_Commentbox extends \Orm\Model_Nestedset
 		'id',
 		'left_id',
 		'right_id',
+		'tree_id',
 		'comment_key',
 		'user_id',
 		'name',
 @@ -30,6 +31,9 @@ class Model_Commentbox extends \Orm\Model_Nestedset
 	);
 
 	protected static $_tree = array(
+		'left_field' => 'left_id',
+		'right_field' => 'right_id',
+		'tree_field' => 'tree_id',
 		'title_field' => 'comment_key',
 	);
 
```

と、このように、 `tree_id` を追加することで、

* 唯一の親を持つツリーで管理する
* 複数の親を持つツリーで管理する

か、を選べるようになっています。

コメントや掲示板、などは「複数の親を持つツリーで管理する」方が管理しやすいのではないかと自分は思います。

なので、追加するには先にルートを作っておいたほうが管理がしやすいので

`classes/model/commentbox.php`

```php
	public static function get_parent($comment_key, $create = false)
	{
		$root = self::get_item($comment_key);
		if (null != $root ||
			! $create)
		{
			return $root;
		}
		$root = new static();
		$root->comment_key = $comment_key;
		$root->user_id = -1;
		$root->name = '';
		$root->email = '';
		$root->website = '';
		$root->body = '';
		$root->save();
		return $root;
	}
```

のように、ルートノード取得時に、存在しなければルートノードを作成するメソッドを作り、扱いやすくしています。

子を追加するときは

```php
					}
	
					$model->child($parent)->save();
				}
```

のような感じです。

ツリーの扱いとしては、例えば、

`classes/commentbox.php`

```php
		$form = $this->fieldset();
		$root = Model_Commentbox::get_parent($this->comment_key);
		$tree = $root ? $root->dump_tree() : array();
		$user_page_empty
```

このように `dump_tree()` 関数を使うことで指定のアイテムを含めた下位のツリーを丸ごと取ることができます。

ドキュメントではこの他にも、ツリーを移動するためのメソッドが多数用意されています。

また、通常のモデルのように

`classes/commentbox.php`

```php
				{ // 投稿処理
					// キーとなるハッシュを生成
					for ($comment_key = \Str::random('alnum', 32);
					     Model_Commentbox::query()
					     	->where('comment_key', $comment_key)
					     	->count();
					     $comment_key = \Str::random('alnum', 32))
						continue;
```

と `query()` メソッドを使い個別に条件を追加して検索することもできます。

## まとめ

* oil コマンドでスケルトンを作ることができるので素早く実装に進むことができる。
* ２種類の管理の仕方、「唯一の親を持つツリーで管理する」か「複数の親を持つツリーで管理する」があり、フィールドの有無でどちらか選ぶことができる。
* 通常のモデルクラスと同じように条件を指定し検索することができる。
* 多彩なツリーの移動メソッドがあらかじめ用意されている。

と、このような感じなのでサクサクと実装できるのではないかと思います。

ぜひ使って見てください。

以上、[@sharkpp](https://twitter.com/sharkpp) がお送りいたしました。


この文章は [クリエイティブ・コモンズ 表示 4.0 国際](https://creativecommons.org/licenses/by/4.0/legalcode.ja) ライセンス、コードスニペットは [MIT ライセンス](http://osdn.jp/projects/opensource/wiki/licenses%2FMIT_license) の下に提供されています。

## おまけ

コメントに張り付くアイコンの表示としては [Gravatar](http://ja.gravatar.com/) が有名ですが、探してみるとマイナー気味ですがおもしろそーなサービスが他にもあったのでこのパッケージでは選んで使えるようにしてあります。

[Gravatar](http://ja.gravatar.com/) は

![avatar example gravatar](/images/2015_1205_fuel_5th_avatar_example_gravatar.png)

こんな感じの表示になります。

その２は、[RoboHash](http://robohash.org/) というサービスで、アイコンがいろんなタイプのロボットで表示され、背景も何種類か選ぶことができます。

![avatar example robohash](/images/2015_1205_fuel_5th_avatar_example_robohash.png)

こんな感じの表示になります。

その３は、[Adorable Avatars!](http://avatars.adorable.io/) というサービスで、とぼけた？ような顔のアイコンを作ってくれます。
ただ、このサービスはアイコンの種類が少ないのか意外とアイコンが被ってしまうことが多い気がします。

![avatar example adorable](/images/2015_1205_fuel_5th_avatar_example_adorable.png)

こんな感じの表示になります。

[Avatar](https://github.com/sharkpp/fuel-commentbox/blob/master/classes/util/avatar.php) というクラスを作りまとめて管理しているので他にも同じようなサービスが見つかったら簡単に追加できるようにしてあるので誰か使って欲しいなぁ、なんて。

## 参考

* [fuel-nestedsetsを試す。 - 備忘録的な @7wk](http://fennec.hatenablog.com/entry/2012/12/12/031408)
* [fuel-nestedsetsを試す。の続き。 - 備忘録的な @7wk](http://fennec.hatenablog.com/entry/2012/12/12/231456)
* [NestedSets Model @ fuelphp.jp](http://fuelphp.jp/docs/1.8/packages/orm/model/nestedset.html)

<hr>

この投稿は **[FuelPHP Advent Calendar 2015](http://qiita.com/advent-calendar/2015/fuelphp)** の **5日目**の記事です。

* 4日目の記事: [Markdown Wiki を通して Model_Temporal の使い方を覚えよう](http://www.sharkpp.net/blog/2015/12/04/fuelphp-advent-calender-2015-4th.html)
* 6日目の記事: [????]()
