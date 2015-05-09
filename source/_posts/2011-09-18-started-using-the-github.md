---
title: "githubを使い始めました"
tags: [develop, subversion, git, github]
categories: [blog]

---

githubを今更ながら始めました。

食わず嫌いってほどでは無いですが、Windowsをメインにしている関係で、Subversion + TortoiseSVN のコンボが最強すぎてなかなか使い始める機会が無かったです。



  


で、ある人に進めた手前、自分が使っていないのはどうなのかと思って、どうやって使ったもんかと思い考えた末、

**Subversion → フックスクリプト → git → github**

と、Subversion と git のリポジトリを同期させSubversion から一方的にpushする方法を思いつきました。

まあ、まったくもってgitである必要は無いので世の中の使い方としては下の下に入る方法ではないかと思いますが...



  


とりあえず、

  * [github][1]
  * [tips - svnメイン、でもgithubでも公開したい場合の最小手順][2]

辺りを見ながらセットアップしました。



  


試行錯誤の結果は↓のレポジトリに公開しました。

<https://github.com/sharkpp/win-batch-utils>



  


リポジトリの公開は、

  1. githubでレポジトリを作る(たとえば、_example-test_)
  2. ローカルのgitレポジトリのフォルダへ移動
  3. [svn2github.cmd][3] _http://svn.example.net/test_ _example-test_ を実行

てな感じで簡単に出来るようにしました。



  


フックスクリプトは↓のような設定で使っています。

が、なんかどうもうまく動いていない気も... 単に遅いだけかな？

直接実行する分には問題ないのだけれど...

![][4]

  1. TortoiseSVNの設定画面を開き、「フックスクリプト」の設定を選択
  2. 「追加」を選択
  3. 「Post-Commit フック」を選択
  4. ローカルの作業フォルダのパスを指定
  5. 「[error_report.cmd][5] [sync4git.cmd][6] ローカルのgitレポジトリのパス」をそれぞれフルパスで入力



  


全部が全部公開しているわけではないけど、こんな感じでオープンな感じでやるのもいいかなーと最近思い始めてます。

 [1]: http://blog.makotokw.com/memo/github/
 [2]: http://blog.livedoor.jp/dankogai/archives/51194979.html
 [3]: https://github.com/sharkpp/win-batch-utils/blob/master/git/svn2github.cmd
 [4]: http://www.sharkpp.net/public/images/2011_0918_svn-hook-sync-git.png
 [5]: https://github.com/sharkpp/win-batch-utils/blob/master/error_report.cmd
 [6]: https://github.com/sharkpp/win-batch-utils/blob/master/git/sync4git.cmd