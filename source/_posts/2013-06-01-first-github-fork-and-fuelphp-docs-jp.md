---
title: "初めてのForkとFuelPHP 1.6 翻訳ウィーク参加"
date: 2013-06-01 00:24:00
tags: [php, GitHub, FuelPHP, 翻訳]
categories: [ブログ]

---

FuelPHP 1.6 が公開されたのを記念？してまた [FuelPHP 1.6 翻訳ウィーク : ATND][1] が行なわれるとのことなので参加してみました。

 [1]: http://atnd.org/events/39849

とりあえず、[FuelPHP ドキュメント翻訳へのお誘い][2]とか[FuelPHP の日本語ドキュメントを 5分で修正する][3]を参考に自分はgithubのクライアントを基本に翻訳してみることにしました。

 [2]: http://pneskin2.nekoget.com/press/?p=1044
 [3]: http://d.hatena.ne.jp/Kenji_s/20130117/edit_fuel_docs

さあ、とりあえず翻訳できたし、とりあえずコミットしてみるかってんでコミットしてみたらここで事件発生！ なんか全行削除されて全行追加された感じになっていました。

<a href="/files/widgets.js" charset="utf-8"></script> 
<p>
で、いろいろ翻訳して Pull Request をしてみてさあマージされたと思って、、、あれ？更新を取り込むにはどうしたら？と思ったので試行錯誤をしてフォーク元から変更を取り込みました。
</p>
<p>
試行錯誤した後で<a href="http://d.hatena.ne.jp/hnw/20110528">GitHubへpull requestする際のベストプラクティス - hnwの日記
</a>などを見つけてorz状態になったけどとりあえず後で考えるようにした。
</p>

<p>なので以下に書かれているのは良くない方法ではあると思うので参考にしてはいけないのです。
</p>

<p>とりあえず、githubクライアントでcloneするとう upstream って名前はあるけどURLが指定されていないようです。
</p>

<pre><code>$ git remote -v
origin  https://github.com/sharkpp/FuelPHP_docs_jp.git (fetch)
origin  https://github.com/sharkpp/FuelPHP_docs_jp.git (push)
upstream
</code>
</pre>

<p>で、URLを指定します。
</p>

<pre><code>$ git remote set-url upstream https://github.com/NEKOGET/FuelPHP_docs_jp
</code>
</pre>

<p>ここからは行儀が良くないやり方。 Pull Request で余計な変更が含まれたりしてしまいます。
</p>

<p>フォーク元から変更を取り込みます。 --rebase を付けるのがポイントのようです。
</p>

<pre><code>$ git pull --rebase upstream 1.6/develop_japanese
From https://github.com/NEKOGET/FuelPHP_docs_jp
* branch            1.6/develop_japanese -&gt; FETCH_HEAD
First, rewinding head to replay your work on top of it...
</code>
</pre>

<p>そして、変更をプッシュ。
</p>

<pre><code>$ git push -f origin 1.6/develop_japanese
Counting objects: 222, done.
Delta compression using up to 2 threads.
Compressing objects: 100% (140/140), done.
Writing objects: 100% (185/185), 27.32 KiB, done.
Total 185 (delta 127), reused 77 (delta 45)
To https://github.com/sharkpp/FuelPHP_docs_jp.git
+ d1c090c...214104c 1.6/develop_japanese -&gt; 1.6/develop_japanese (forced update)
</code>
</pre>

<p>あとは、思うように翻訳して、githubクライアント上で commit ＆ sync 。 そして、github上で Pull Request です。
</p>

<p>git fetch とか git merge とかやってみたけどひどいことになりながら↑のやり方にたどり着きました。
</p>

<p>まあ、もっとましなやり方を覚えないと、ですが、、、、順番になれていきたいです。
</p>

<p>参考：
</p>

<ul><li>
<a href="https://help.github.com/articles/syncing-a-fork">Syncing a fork - GitHub Help</a>
</li>
<li>
<a href="http://d.hatena.ne.jp/wats/20100915/1284478558">gitのoriginのurlを変更する。 - 僕の今さら日記</a>
</li>
<li>
<a href="http://processwire.com/talk/topic/1565-github-for-windows/">Github for Windows - Tutorials - ProcessWire Support Forums</a>
</li>
</ul>
