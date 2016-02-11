---
title: "git メモ：ローカルとリモートのブランチ名を変更する"
date: 2016-02-11 17:35
tags: [ GitHub, git, メモ ]
categories: [ブログ]

---

git のブランチ名を変えたい場合のやりかたメモ。

ある所に

1. master から別のブランチ名にブランチを切りました
2. 特定フォルダだけ必要なので subtree (`git subtree push --prefix public/ . sub-branch`) で push しています。
3. でも、よく考えたら一手間かかるし、もういっそのこと構造を変更しそのまま master ブランチを名前変えて使えばイイじゃん

と考えた男がいました。

## 前提条件

ということで、まずは条件を設定。

|ローカル|リモート|
|-|-|
|master|master|
|gh-pages|gh-pages|

と設定します。

```bash
$ git branch --all
  gh-pages
* master
  remotes/origin/gh-pages
  remotes/origin/master
```

こんな感じです。

これを、

|ローカル|リモート|
|-|-|
|gh-pages ※旧master|gh-pages ※旧master|

こうじゃ

## やり方

まずは、現状確認

```bash
$ git checkout master
$ git branch --all
  gh-pages
* master
  remotes/origin/gh-pages
  remotes/origin/master
```

おもむろに、いらない子、今の `gh-pages` ブランチをローカルとリモート両方で削除。

```bash
$ git push origin :gh-pages
To https://github.com/hsp-users-jp/hsp-users.jp.git
 - [deleted]         gh-pages
$ git branch -m gh-pages
```

`gh-pages` のみの変更はないので大丈夫。
傷は浅いぞ。

**もし、`gh-pages` 側で変更している場合は、忘れずに `master` にマージをしましょう。**

もう一度確認

```bash
$ git branch --all
* master
  remotes/origin/master
```

はい、いらない子は削除される運命だったのです。

次に、ローカルのブランチ名を変更します。
別のブランチで操作している場合は、`git branch -m OLD_BRANCH NEW_BRANCH` で操作します。

```bash
$ git branch -m gh-pages
$ git branch --all
* gh-pages
  remotes/origin/master
```

そして、ローカルの変更をリモートに送ります。

```bash
$ git push origin gh-pages
Total 0 (delta 0), reused 0 (delta 0)
To https://github.com/hsp-users-jp/hsp-users.jp.git
 * [new branch]      gh-pages -> gh-pages
$ git branch --all
* gh-pages
  remotes/origin/gh-pages
  remotes/origin/master
```

最後に、リモートの `master` ブランチを削除して完了です。

```bash
$ git push origin :master
To https://github.com/hsp-users-jp/hsp-users.jp.git
 - [deleted]         master
```

確認すると

```bash
$ git branch --all
* gh-pages
  remotes/origin/gh-pages
```

はい、できていますね。

## まとめ

変更先のブランチを削除。
ただし、該当ブランチでの作業がないこと。

```bash
$ git branch -D gh-pages
$ git push origin :gh-pages
```

ローカルとリモート両方のブランチ名を変更。

```bash
$ git checkout master
$ git branch -m gh-pages
$ git push origin gh-pages
$ git push origin :master
```

こんな感じです。

## 参考

* [Git で不要になったローカルブランチ・リモートブランチを削除する方法 - Qiita](http://qiita.com/iorionda/items/c7e0aca399371068a9b8)
* [Gitのリモートリポジトリの名前を付け替える　〜Railsのアップグレードを例にして〜 - Qiita](http://qiita.com/kon_yu/items/e9ebd7f778df430a4223)
* [git: ローカルのブランチ名を変更したい - Qiita](http://qiita.com/suin/items/96c110b218d919168d64)



