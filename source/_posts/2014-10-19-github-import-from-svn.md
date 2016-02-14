---
title: "github.com へ SVNのレポジトリを取り込んで公開する方法"
date: 2014-10-19 13:48:00
tags: [Develop, git, GitHub]
categories: [ブログ]

---

svn のレポジトリを既存の github レポジトリに取り込む手順をメモ。 多分、既存の git に取り込むのにも使えるはず。

ちなみに取り込むとログに `git-svn-id: 〜` の用な感じで SVN のリポジトリパスが残るのでパスを秘密にしたい場合は諦めてファイルコピーで取り込んだ方がいいと思います。

* 2016-02-14 git-svn-id を付与せずに clone する方法を追記

## 前提条件

  * `git clone` したディレクトリは `~/hoge/`
  * `git checkout` したブランチは `import_from_svn_example_net`
  * 取り込みたい SVN レポジトリは `http://svn.example.net/path/to/svn/repos/`
  * 作業用の git レポジトリは `tmp`

## 準備

  1. github.com からレポジトリを `git clone` する
  2. ブランチを作り `git checkout` する **重要**

ブランチは、

    $ git checkout -b import_from_svn_example_net
    

みたいな感じで作る

## 手順

    $ cd ~
    $ git svn clone http://svn.example.net/path/to/svn/repos/ tmp
    $ cd ~/hoge/
    $ git pull ~/tmp
    $ cd ~
    $ rm -rf tmp
    

でターミナルでの作業は終了。 あとは githubクライアントで sync するなどして github に push すれば終了です。

## git-svn-id を削除したい場合

git-svn-id を削除したい場合は

```bash
$ git svn clone http://svn.example.net/path/to/svn/repos/ --no-metadata tmp
```

とすると良いようです。

<blockquote class="twitter-tweet" data-lang="ja"><p lang="ja" dir="ltr"><a href="https://twitter.com/sharkpp">@sharkpp</a> ところでsvnのリポジトリをもう使わわずgit-svn-idがいらないのでしたら、git svn clone --no-metadataが使えるはずです。 <a href="http://t.co/FRKHmnEj6z">http://t.co/FRKHmnEj6z</a> <a href="http://t.co/ZWGezekJls">http://t.co/ZWGezekJls</a></p>&mdash; zakki (@k_matsuzaki) <a href="https://twitter.com/k_matsuzaki/status/532728589444063232">2014, 11月 13</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

## 参考

* [git-svnでSVN→Gitへの移行をやってみたログ - Qiita](http://qiita.com/hidekuro/items/4727715fbda8f10b6b11)
* [Git - Git と Subversion](http://git-scm.com/book/ja/Git%E3%81%A8%E3%81%9D%E3%81%AE%E4%BB%96%E3%81%AE%E3%82%B7%E3%82%B9%E3%83%86%E3%83%A0%E3%81%AE%E9%80%A3%E6%90%BA-Git-%E3%81%A8-Subversion#はじめましょう)
* [リモート操作 | 逆引きGit | サルでもわかるGit入門 〜バージョン管理を使いこなそう〜 | どこでもプロジェクト管理バックログ](http://www.backlog.jp/git-guide/reference/remote.html#sec7)
* [Git - Git への移行](http://git-scm.com/book/ja/v1/Git%E3%81%A8%E3%81%9D%E3%81%AE%E4%BB%96%E3%81%AE%E3%82%B7%E3%82%B9%E3%83%86%E3%83%A0%E3%81%AE%E9%80%A3%E6%90%BA-Git-%E3%81%B8%E3%81%AE%E7%A7%BB%E8%A1%8C)
