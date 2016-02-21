---
title: "git メモ：Subversion からのインポート"
date: 2016-02-21 16:48
tags: [git, Subversion]
categories: [ブログ]

---

以前にも [github.com へ SVNのレポジトリを取り込んで公開する方法](http://www.sharkpp.net/blog/2014/10/19/github-import-from-svn.html) で Subversion から git へのインポート方法を調べたけど、再度調べ直してタグとかをちゃんと反映させる方法を試したメモ。

インポート、としていますが実質やってることは移行と言っても過言ではありません。

## 前提

### Subversion

複数のトップを持っている Subversion レポジトリがインポート元です。

あと、手元にワーキングディレクトリはありません。

レポジトリ：`http://example.com/svn/echo/...`

```
/
  client
    trunk
    branch
    tag
  server
    trunk
    branch
    tag
```

### git

それを、次のようなレイアウトとしてインポートします。

|repos|
|-|
|echo-client|
|echo-server|

## 手順

### Subversion からコミッターの名前を列挙する

まず、適当なところにチェックアウトします。

```bash
$ svn co http://example.com/svn/echo/ echo_svn
A    echo/client
         :
A    echo/server/trunk/readme.txt
Checked out revision 123.
```

そして、ユーザーの一覧を取得。

```bash
$ cd echo_svn/
$ svn log ^/ --xml | grep -P "^<author" | sort -u | ¥
  perl -pe 's/<author>(.*?)<\/author>/$1 = /' > ../users.txt
$ cd ..
$ cat users.txt
admin =
```

Subversion ユーザー名と git のコミッタ名とを対応付けて定義ファイルを作成します。

```bash
$ cat users.txt
admin = admin <hoge.fuga@example.com>
```

### Subversion を clone する

複数のリポジトリへと変換するので for でぐるぐるします。

```bash
$ for I in client server ; do ¥
    git svn clone http://example.com/svn/echo/$I -T trunk -b branch -t tag ¥
        --authors-file=users.txt --no-metadata -s echo_$I ; ¥
  done
```

### リモートのタグブランチをタグに、ブランチをローカルのブランチに変える

同じくぐるぐるしながら、ブランチやタグを整理します。

```bash
$ for I in client server ; do ¥
    pushd echo_$I ; ¥
    git for-each-ref refs/remotes/origin/tags | cut -d / -f 5- | grep -v @ | ¥
      while read tagname; do ¥
        git tag "$tagname" "origin/tags/$tagname"; ¥
        git branch -r -d "origin/tags/$tagname"; ¥
      done ; ¥
    git for-each-ref refs/remotes | cut -d / -f 3- | grep -v @ | ¥
      while read branchname; do ¥
        git branch "$branchname" "refs/remotes/$branchname"; ¥
        git branch -r -d "$branchname"; ¥
      done ; ¥
    popd ; ¥
  done
```

### 結果

それぞれのレポジトリ内は

```bash
$ cd client
$ git tag
0.1.0
0.2.0
0.3.5
$ git branch -a
* master
  origin/trunk
```

このような感じになります。

あとは、 GitHub やそのほかリモートの git に push すれば OK です。

## 参考

* [Git - Git への移行](http://git-scm.com/book/ja/v1/Git%E3%81%A8%E3%81%9D%E3%81%AE%E4%BB%96%E3%81%AE%E3%82%B7%E3%82%B9%E3%83%86%E3%83%A0%E3%81%AE%E9%80%A3%E6%90%BA-Git-%E3%81%B8%E3%81%AE%E7%A7%BB%E8%A1%8C)
* [面倒くさいsvnリポジトリをgit-svnで扱う時に役立ちそうなオプション一覧 - アジャイルSEの憂鬱](http://sinsoku.hatenablog.com/entry/2014/02/26/231918)

