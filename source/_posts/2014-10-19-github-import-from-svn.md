---
title: "github.com へ SVNのレポジトリを取り込んで公開する方法"
date: 2014-10-19 13:48:00
tags: [Develop, git]
categories: [blog]

---

svn のレポジトリを既存の github レポジトリに取り込む手順をメモ。 多分、既存の git に取り込むのにも使えるはず。

ちなみに取り込むとログに `git-svn-id: 〜` の用な感じで SVN のリポジトリパスが残るのでパスを秘密にしたい場合は諦めてファイルコピーで取り込んだ方がいいと思います。

### 前提条件

  * `git clone` したディレクトリは `~/hoge/`
  * `git checkout` したブランチは `import_from_svn_example_net`
  * 取り込みたい SVN レポジトリは `http://svn.example.net/path/to/svn/repos/`
  * 作業用の git レポジトリは `tmp`

### 準備

  1. github.com からレポジトリを `git clone` する
  2. ブランチを作り `git checkout` する **重要**

ブランチは、

    $ git checkout -b import_from_svn_example_net
    

みたいな感じで作る

### 手順

    $ cd ~
    $ git svn clone http://svn.example.net/path/to/svn/repos/ tmp
    $ cd ~/hoge/
    $ git pull ~/tmp
    $ cd ~
    $ rm -rf tmp
    

でターミナルでの作業は終了。 あとは githubクライアントで sync するなどして github に push すれば終了です。

### 参考

  * [git-svnでSVN→Gitへの移行をやってみたログ - Qiita][1]
  * [Git - Git と Subversion][2]
  * [リモート操作 | 逆引きGit | サルでもわかるGit入門 〜バージョン管理を使いこなそう〜 | どこでもプロジェクト管理バックログ][3]

 [1]: http://qiita.com/hidekuro/items/4727715fbda8f10b6b11
 [2]: http://git-scm.com/book/ja/Git%E3%81%A8%E3%81%9D%E3%81%AE%E4%BB%96%E3%81%AE%E3%82%B7%E3%82%B9%E3%83%86%E3%83%A0%E3%81%AE%E9%80%A3%E6%90%BA-Git-%E3%81%A8-Subversion#はじめましょう
 [3]: http://www.backlog.jp/git-guide/reference/remote.html#sec7