---
title: "eXcaleでFuelPHPをpublicサブディレクトリなしで動かしてみた(追記あり)"
date: 2013-02-17 23:30:00
tags: [php, FuelPHP]
categories: [ブログ]

---

## 始めに

<a href="/files/widgets.js" charset="utf-8"></script> 
<h2>
アカウント登録
</h2>
<p>
とりあえず、普通に eXcale に登録してみました。
</p>
<p>
メールアドレスで登録するだけなので簡単です。
</p>
<p>
と、ここで、、、
</p>
<p>
<strong>This invitation link isn't valid. Perhaps you already used it?</strong>
</p>
<p>
(´・ω・｀)
</p>
<p>
３?４回おなじメールアドレスで仮登録申請してみましたが、いずれもだめでした。 そもそも、本登録用のアドレスが何回やっても同じだったので結果は変わらないですね。
</p>
<p>
で、何回かやってて気が付きました。 なんかメッセージがページの上部に表示されてる？
</p>
<p>
<strong>Please enter an collect email address format or password must be more than 6 characters, letters and numbers.</strong>
</p>
<p>
あれ？もしかして、記号だめ？
</p>
<p>
はい、パスワード設定の時に記号を含めたパスワードを使用していました。
</p>
<p>
で、記号を抜いてみたら、、、できました。 酷いです(´・ω・｀)
</p>
<p>
あと、適当な名前でアプリケーションを登録しておきます。
</p>
<h2>
FuelPHPをアップロード
</h2>
<p>
FuelPHP本家からパッケージをダウンロードし、一旦展開します。 現在のバージョンは、1.5.2なので展開すると fuelphp-1.5.2 というフォルダができています。
</p>
<p>
で、 fuelphp-1.5.2/fuel/app/config/config.php に、
</p>
<pre>
return array(
'default_timezone' =&gt; 'Asia/Tokyo'
);
</pre>
<p>
のような感じで設定を追加します。
</p>
<p>
で、fuelphp-1.5.2 の <strong>中身を</strong> .tar.gz で圧縮します。圧縮の仕方とかは適当に検索してみてください。 そのままではなく、 <strong>中身を</strong> ってところが重要です。
</p>
<p>
で、eXcle上でアプリケーション一覧から上で登録したアプリケーションのアップロードから .tar.gz をアップします。
</p>
<p>
アップしても、1分ぐらいは
</p>
<p>
<strong>Down for maintenance</strong>
</p>
<p>
な状態から更新されないのでしばらく待ってます。
</p>
<p>
501とかのエラーになったら、ログを確認してみてください。 なんかメッセージがでてるかもです。
</p>
<h2>
本題
</h2>
<p>
ここからがこの記事の本題です。 上で書いた内容は、ただの前書き、序文、前菜です。
</p>
<p>
無事、デプロイ出来た場合でも、アクセスするには、 http://sharkpp.excale.net/public/ としないといけないのです。
</p>
<p>
これはかっこ悪い＆fuelとかにアクセスできてよろしくない。
</p>
<p>
何とかしたい、で何とかしてみました。
</p>
<p>
やり方は、
</p>
<ol>
<li>
ルートパスを変更
</li>
<li>
<del>asset のパスを変更</del>
</li>
<li>
<del>public/index.php を index.php に移動して内容変更</del> public/* を / に移動し index.php の内容を変更
</li>
</ol>
<h3>
ルートパスを変更
</h3>
<p>
上で変更した fuel/app/config/config.php に、base_urlの指定をします。 これ、なくても動くのかな？もしかして、、、試していないですが、、、
</p>
<p>
上の設定とあわせると最終的には、
</p>
<pre>
return array(
'default_timezone' => 'Asia/Tokyo',
'base_url'  =>  '/',
);
</pre>
<p>
のような内容になっているはずです。
</p>
<h3>
<del>asset のパスを変更</del>
</h3>
<p>
<strong>2013年2月18日削除</strong>
</p>
<p>
<del>fuel/app/config/asset.php はインストール直後では存在しないので、下のような内容を追加します。</del>
</p>
<pre>
return array(
'paths' => array('public/assets/'),
);
</pre>
<h3>
<del>public/index.php を index.php に移動して内容変更</del> public/* を / に移動し index.php の内容を変更
</h3>
<p>
<del>public/index.php をルートに移動し、 index.php とします。</del>
</p>
<p>
public/* をルートに移動します。 publicフォルダは空っぽなので削除しましょう。 で、パスも合わせて変更。
</p>
<p>
APPPATH と PKGPATH と COREPATH です。
</p>
<pre>
define('APPPATH', realpath(__DIR__.'/../fuel/app/').DIRECTORY_SEPARATOR);
</pre>
<p>
を
</p>
<pre>
define('APPPATH', realpath(__DIR__.'/fuel/app/').DIRECTORY_SEPARATOR);
</pre>
<p>
のような感じです。
</p>
<p>
この時、/fuel を、たとえば、 /fuel_hoge にしておけば、少し安全になるかもです。
</p>
<p>
で、また、固めなおしてアップします。
</p>
<h2>
完成
</h2>
<p>
で、うまくアクセスできるようになりました。
</p>
<ul>
<li>
<a href="http://sharkpp.excale.net/">http://sharkpp.excale.net/
</a>
  </li>
  <li>
    <a href="http://sharkpp.excale.net/index.php/welcome">http://sharkpp.excale.net/index.php/welcome</a>
  </li>
</ul>

<p>ただ、mod_rewrite相当の機能が使えないとの話なので /welcom.php などとアクセスしても 404 エラーとなってしまいます。
</p>

<p>少し残念です。
</p>

<p>あと、 /index.php/hoge.php はかっこ悪いです。
</p>

<p><strong>あとあと、なんか重大な見落としがあるかもなので実際にやる時は自己責任でお願いしますです、はい。</strong>
</p>

<h2>
  まとめ
</h2>

<p>eXcale は日本語で使えて遊べるかもってことで触ってみましたが、少し残念なところがあって、もうちょっと、、、って感じでした。
</p>

<p>SNSなどに書くとそれを拾い上げてくれる場合もあるようなので、みんながいっぱい書けばもっとよくなるかも？ってことで期待をしたいなーと思います。
</p>
