---
title: "git メモ：コミット済みの電子メールの変更と履歴の復旧"
date: 2016-03-19 00:47
tags: [ git, メモ ]
categories: [ブログ]

---

commit 時のメールアドレスが間違っていたのを気がついたので調べて直したのはしばらく前のこと。

リモートのレポジトリががっつり更新されていたのでじゃあマージしてみるか、と思ってマージしてみたら、、、

コンフリクトがドバッと出て大変なことになりました、をなんとか直したメモ。

## メールアドレスを間違った！

```bash
$ git filter-branch --commit-filter '
        if [ "$GIT_AUTHOR_EMAIL" = "john.doe@localhost" ];
        then
                GIT_AUTHOR_NAME="John Doe";
                GIT_AUTHOR_EMAIL="john.doe@example.com";
                git commit-tree "$@";
        else
                git commit-tree "$@";
        fi' HEAD
```

みたいな感じで治せます。

が、これをやると、一つ前のコミットはもちろんのこと最初のコミットまでドバッとハッシュが変わります。

なので、はい、大変なことになりました。

## pull してみたところ！？

リモートの変更を取り込むために、 `git pull` してみたところ

```bash
$ git pull origin master
From git://source.winehq.org/git/wine
 * branch            master     -> FETCH_HEAD
Auto-merging tools/wrc/wrc.c
CONFLICT (add/add): Merge conflict in tools/wrc/wrc.c
Auto-merging tools/winemaker/winemaker.man.in
CONFLICT (add/add): Merge conflict in tools/winemaker/winemaker.man.in
               :
```

コンフリクトしました、、、、それは見事に。

そもそもの話、ブランチに直接マージするな、という話もなきにしもあらず、は置いておく。

## なんとか復旧してみる

なんともならなかったので、ブランチを作り直してパッチを当てようと思ったけど、変更箇所のコミットのみを適用できるのであれば、その方がいいので探てみるとできそうだったのでやってみた。

やり方は、 master にリモートの変更を pull し、ブランチを作り、変更を適用。

```bash
$ git checkout master
$ git pull origin master
$ git checkout -b 新しいブランチ名
$ git cherry-pick 範囲の最初のハッシュ^..範囲の終わりのハッシュ
```

こんな感じ。

## マージの確認

さて、どうやらまたリモートで変更があったようです。

実際にマージ作業の確認をしてみましょう。

```
$ git checkout master
$ git pull origin master
$ git checkout トピックブランチ名
$ git merge master
Auto-merging dlls/opengl32/wgl.c
Auto-merging dlls/opengl32/opengl_norm.c
               :
```

はい、問題なくマージできたようです。

## 参考

* [Git - 歴史の書き換え](https://git-scm.com/book/ja/v1/Git-%E3%81%AE%E3%81%95%E3%81%BE%E3%81%96%E3%81%BE%E3%81%AA%E3%83%84%E3%83%BC%E3%83%AB-%E6%AD%B4%E5%8F%B2%E3%81%AE%E6%9B%B8%E3%81%8D%E6%8F%9B%E3%81%88)
* [複数のコミットを同時にcherry-pickする - by shigemk2](http://www.shigemk2.com/entry/20130115/1358244775)
* [cherry-pickでリビジョンの範囲を指定する - Qiita](http://qiita.com/sasaplus1/items/434e51fba528b0e8853d)

