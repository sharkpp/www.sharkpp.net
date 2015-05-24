---
title: "rhaco2ってどうやって使うの？"
date: 2009-02-01 17:45:00
tags: [php, rhaco, rhaco2]
categories: [php, rhaco]

---

2009年12月31日 追記

以下の内容は、2009年02月01日の時点でのリポジトリ最新版で確認した記述です。

rhaco2は仕様がころころ変わっていたり、開発途中なためすでに内容が過去のものになっています。

なので、最新の内容については、[rhaco.org][1]とか[rhaco2 Documents][2]とか[rhaco_ja][3]をご参照ください。

 [1]: http://rhaco.org/
 [2]: http://wikihub.org/wiki/rhaco2-doc
 [3]: http://lingr.com/room/rhaco_ja

Google経由で訪れていただいた方すいません。

最新を追いきれていません。

* * *

[rhaco2どうやってつかうの@Linger::rhaco-ja][4] より

 [4]: http://www.lingr.com/room/rhaco-ja/archives/2009/01/25#msg-58317531

現時点でのRhaco2はSetupが存在しないので設定などを手動で定義してあげる必要があります

でまず、Subversionがインストール済みだとして、

適当なディレクトリで

<pre>svn co http://rhaco.svn.sourceforge.net/svnroot/rhaco/trunk rhaco2
</pre>

を実行

\_\_settings\_\_.php と名前を付けてファイルに

<pre>&lt;?php
require_once("/var/www/html/rhaco2/Rhaco.php");
Rhaco::init(__FILE__,null,"http://localhost");
</pre>

などと記述

"/var/www/html/rhaco2/Rhaco.php" の部分はRhaco.phpの絶対パスを指定します

相対パスでも今のところは良いみたい

使用するときは、例えば index.php と名前を付けたファイルに

<pre>&lt;?php
include_once("./__settings__.php");
</pre>

と記述すればOK

テンプレートを使いたいときは、

templateディレクトリを作り、そのパスを\_\_settings\_\_.phpに相対パスで指定

たとえば、\_\_settings\_\_.phpに

<pre>Rhaco::def("core.Template@path",Rhaco::path("template"));
</pre>

と追記

※rev.4039で区切り文字が"::"から"@"に変更されているので要注意！

templateディレクトリにfoo.htmlを作り、index.phpに

<pre>Rhaco::import("core.Template");
$template = new Template();
print($template-&gt;read("foo.html"));
</pre>

と追記すればfoo.htmlの内容が表示されます

あとはソース読んでねって事みたい
