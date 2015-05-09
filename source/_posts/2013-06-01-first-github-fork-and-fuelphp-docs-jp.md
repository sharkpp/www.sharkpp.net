---
title: "初めてのForkとFuelPHP 1.6 翻訳ウィーク参加"
tags: [php, github, FuelPHP, 翻訳]
categories: [blog]

---

FuelPHP 1.6 が公開されたのを記念？してまた [FuelPHP 1.6 翻訳ウィーク : ATND][1] が行なわれるとのことなので参加してみました。

とりあえず、[FuelPHP ドキュメント翻訳へのお誘い][2]とか[FuelPHP の日本語ドキュメントを 5分で修正する][3]を参考に自分はgithubのクライアントを基本に翻訳してみることにしました。

さあ、とりあえず翻訳できたし、とりあえずコミットしてみるかってんでコミットしてみたらここで事件発生！ なんか全行削除されて全行追加された感じになっていました。

<a href="/public/images/2013_0601_line_end_fail.png" rel="lytebox[2013_0601_first_step_fuelphp_docs_jp]" title="全行変更あり"><img src="/public/images/2013_0601_line_end_fail_s.png" alt="全行変更あり" /></a>

※そのままgithubにまでコミットしてしまい大変になったのはまた別の話。

で、ピンときて元を確認してみると案の定、改行コードがCrLfではなくLfだった。

<a href="/public/images/2013_0601_github_client_setting.png" rel="lytebox[2013_0601_first_step_fuelphp_docs_jp]" title="githubクライアント設定"><img src="/public/images/2013_0601_github_client_setting_s.png" alt="githubクライアント設定" /></a>

設定を確認すると .gitattributes で指定できるっぽいけど、、、余計なファイルを入れたくないなーと思って探してみたらどうも git コマンドで設定ができるっぽい。

見つけたページ [Dealing with line endings - GitHub Help][4] を参考に Git Shell 起動して

    git config --global core.autocrlf false
    

としてやると改行コードが勝手に変わるのが直った。

デフォルトが改行コードを変更するようになってるなんてヒドイorz

<blockquote class="twitter-tweet" lang="ja">
  <p>
    初めてのPR <a href="https://t.co/glnaIRBvE2" title="https://github.com/NEKOGET/FuelPHP_docs_jp/pull/280">github.com/NEKOGET/FuelPH…</a> <a href="http://t.co/HFy9inhvgx" title="http://atnd.org/events/39849">atnd.org/events/39849</a> <a href="https://twitter.com/search/%23fueldocsja">#fueldocsja</a>
  </p>&mdash; さめたすたす?(^o^)／さん (@sharkpp) 
  
  <a href="https://twitter.com/sharkpp/status/339041311573286913">2013年5月27日</a>
</blockquote>

で、いろいろ翻訳して Pull Request をしてみてさあマージされたと思って、、、あれ？更新を取り込むにはどうしたら？と思ったので試行錯誤をしてフォーク元から変更を取り込みました。

試行錯誤した後で[GitHubへpull requestする際のベストプラクティス - hnwの日記][5]などを見つけてorz状態になったけどとりあえず後で考えるようにした。

なので以下に書かれているのは良くない方法ではあると思うので参考にしてはいけないのです。

とりあえず、githubクライアントでcloneするとう upstream って名前はあるけどURLが指定されていないようです。

    $ git remote -v
    origin  https://github.com/sharkpp/FuelPHP_docs_jp.git (fetch)
    origin  https://github.com/sharkpp/FuelPHP_docs_jp.git (push)
    upstream
    

で、URLを指定します。

    $ git remote set-url upstream https://github.com/NEKOGET/FuelPHP_docs_jp
    

ここからは行儀が良くないやり方。 Pull Request で余計な変更が含まれたりしてしまいます。

フォーク元から変更を取り込みます。 --rebase を付けるのがポイントのようです。

    $ git pull --rebase upstream 1.6/develop_japanese
    From https://github.com/NEKOGET/FuelPHP_docs_jp
     * branch            1.6/develop_japanese -> FETCH_HEAD
    First, rewinding head to replay your work on top of it...
    

そして、変更をプッシュ。

    $ git push -f origin 1.6/develop_japanese
    Counting objects: 222, done.
    Delta compression using up to 2 threads.
    Compressing objects: 100% (140/140), done.
    Writing objects: 100% (185/185), 27.32 KiB, done.
    Total 185 (delta 127), reused 77 (delta 45)
    To https://github.com/sharkpp/FuelPHP_docs_jp.git
     + d1c090c...214104c 1.6/develop_japanese -> 1.6/develop_japanese (forced update)
    

あとは、思うように翻訳して、githubクライアント上で commit ＆ sync 。 そして、github上で Pull Request です。

git fetch とか git merge とかやってみたけどひどいことになりながら↑のやり方にたどり着きました。

まあ、もっとましなやり方を覚えないと、ですが、、、、順番になれていきたいです。

参考：

  * [Syncing a fork - GitHub Help][6]
  * [gitのoriginのurlを変更する。 - 僕の今さら日記][7]
  * [Github for Windows - Tutorials - ProcessWire Support Forums][8]

 [1]: http://atnd.org/events/39849
 [2]: http://pneskin2.nekoget.com/press/?p=1044
 [3]: http://d.hatena.ne.jp/Kenji_s/20130117/edit_fuel_docs
 [4]: https://help.github.com/articles/dealing-with-line-endings
 [5]: http://d.hatena.ne.jp/hnw/20110528
 [6]: https://help.github.com/articles/syncing-a-fork
 [7]: http://d.hatena.ne.jp/wats/20100915/1284478558
 [8]: http://processwire.com/talk/topic/1565-github-for-windows/