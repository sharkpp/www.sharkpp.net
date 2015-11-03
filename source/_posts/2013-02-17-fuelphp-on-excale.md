---
title: "eXcaleでFuelPHPをpublicサブディレクトリなしで動かしてみた(追記あり)"
date: 2013-02-17 23:30:00
tags: [php, FuelPHP, PaaS]
categories: [ブログ]

---

{% import 'post_alert.html' as m %}
{{ m.alert('2015-06-10 追記', 'eXcale(エクスケール) は 2014年11月28日 にサービスの提供が終了しました。そのため下記内容は過去の参考としてのみ残してあります。') }}

## 始めに

[FuelPHP 勉強会 大須 vol.3 に参加しました][1]で少し触れた FuelPHP + eXcale でデプロイ体験をもうすし踏み込んでまとめてみました。

 [1]: /blog/2013/02/17/fuelphp-workshop-in-osu-vol-3.html

内容的には [FuelPHP + eXcale][2] を参照した記事となります。

 [2]: http://yamamoto.phpapps.jp/2012/12/13/6/

なので、色々省かれているので先に目を通しておくことをお勧めします。

勉強会のレポ以外では、もしかして、初めてのFuelPHPの記事かもです。

**2013年2月18日追記**

[インストール方法 - インストール - FuelPHP ドキュメント][3] にルートからしか公開できない場合の設定方法が載っていました。

 [3]: http://fuelphp.jp/docs/1.5/installation/instructions.html#/install_inside_root2

<blockquote class="twitter-tweet" lang="ja"><p>@<a href="https://twitter.com/sharkpp">sharkpp</a> Assetのパスを変更する意義はないように思いますので、<a href="http://t.co/oQKk2vX9" title="http://ow.ly/hNx5G">ow.ly/hNx5G</a> の「もっと簡単な方法」の方がいいと思います <a href="https://twitter.com/search/%23fuelphposu">#fuelphposu</a></p>&mdash; kenjisさん (@kenji_s) <a href="https://twitter.com/kenji_s/status/303321663796289537">2013年2月18日</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

## アカウント登録

とりあえず、普通に eXcale に登録してみました。

メールアドレスで登録するだけなので簡単です。

と、ここで、、、

**This invitation link isn't valid. Perhaps you already used it?**

(´・ω・｀)

３?４回おなじメールアドレスで仮登録申請してみましたが、いずれもだめでした。 そもそも、本登録用のアドレスが何回やっても同じだったので結果は変わらないですね。

で、何回かやってて気が付きました。 なんかメッセージがページの上部に表示されてる？

**Please enter an collect email address format or password must be more than 6 characters, letters and numbers.**

あれ？もしかして、記号だめ？

はい、パスワード設定の時に記号を含めたパスワードを使用していました。

で、記号を抜いてみたら、、、できました。 酷いです(´・ω・｀)

あと、適当な名前でアプリケーションを登録しておきます。

## FuelPHPをアップロード

FuelPHP本家からパッケージをダウンロードし、一旦展開します。 現在のバージョンは、1.5.2なので展開すると fuelphp-1.5.2 というフォルダができています。

で、 fuelphp-1.5.2/fuel/app/config/config.php に、

```php
return array(
'default_timezone' =&gt; 'Asia/Tokyo'
);
```

のような感じで設定を追加します。

で、fuelphp-1.5.2 の **中身を** .tar.gz で圧縮します。圧縮の仕方とかは適当に検索してみてください。 そのままではなく、 **中身を** ってところが重要です。

で、eXcle上でアプリケーション一覧から上で登録したアプリケーションのアップロードから .tar.gz をアップします。

アップしても、1分ぐらいは

**Down for maintenance**

な状態から更新されないのでしばらく待ってます。

501とかのエラーになったら、ログを確認してみてください。 なんかメッセージがでてるかもです。

## 本題

ここからがこの記事の本題です。 上で書いた内容は、ただの前書き、序文、前菜です。

無事、デプロイ出来た場合でも、アクセスするには、 http://sharkpp.excale.net/public/ としないといけないのです。

これはかっこ悪い＆fuelとかにアクセスできてよろしくない。

何とかしたい、で何とかしてみました。

やり方は、

  1. ルートパスを変更
  2. <del>asset のパスを変更</del>
  3. <del>public/index.php を index.php に移動して内容変更</del> public/* を / に移動し index.php の内容を変更

### ルートパスを変更

上で変更した fuel/app/config/config.php に、base_urlの指定をします。 これ、なくても動くのかな？もしかして、、、試していないですが、、、

上の設定とあわせると最終的には、

```php
return array(
'default_timezone' => 'Asia/Tokyo',
'base_url'  =>  '/',
);
```

のような内容になっているはずです。

### <del>asset のパスを変更</del>

**2013年2月18日削除**

<del>fuel/app/config/asset.php はインストール直後では存在しないので、下のような内容を追加します。</del>

```php
return array(
'paths' => array('public/assets/'),
);
```

### <del>public/index.php を index.php に移動して内容変更</del> public/* を / に移動し index.php の内容を変更

<del>public/index.php をルートに移動し、 index.php とします。</del>

public/* をルートに移動します。 publicフォルダは空っぽなので削除しましょう。 で、パスも合わせて変更。

APPPATH と PKGPATH と COREPATH です。

```php
define('APPPATH', realpath(__DIR__.'/../fuel/app/').DIRECTORY_SEPARATOR);
```

を

```php
define('APPPATH', realpath(__DIR__.'/fuel/app/').DIRECTORY_SEPARATOR);
```

のような感じです。

この時、/fuel を、たとえば、 /fuel_hoge にしておけば、少し安全になるかもです。

で、また、固めなおしてアップします。

## 完成

で、うまくアクセスできるようになりました。

* <del>http://sharkpp.excale.net/</del>
* <del>http://sharkpp.excale.net/index.php/welcome</del>

ただ、mod_rewrite相当の機能が使えないとの話なので /welcom.php などとアクセスしても 404 エラーとなってしまいます。

少し残念です。

あと、 /index.php/hoge.php はかっこ悪いです。

**あとあと、なんか重大な見落としがあるかもなので実際にやる時は自己責任でお願いしますです、はい。**

## まとめ

eXcale は日本語で使えて遊べるかもってことで触ってみましたが、少し残念なところがあって、もうちょっと、、、って感じでした。

SNSなどに書くとそれを拾い上げてくれる場合もあるようなので、みんながいっぱい書けばもっとよくなるかも？ってことで期待をしたいなーと思います。
