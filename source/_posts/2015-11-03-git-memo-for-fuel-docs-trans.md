---
title: "FuelPHP ドキュメント翻訳のための git メモ"
date: 2015-11-03 08:54
tags: [ php, GitHub, git, FuelPHP, 翻訳, メモ ]
categories: [ブログ]

---

[初めてのForkとFuelPHP 1.6 翻訳ウィーク参加](/blog/2013/06/01/first-github-fork-and-fuelphp-docs-jp.html) で git の操作方法をメモってたけど色々おかしかったので新たにメモ。

それ以外にも関連する事柄をメモ。

## 未翻訳のドキュメントを探す

```bash
$ grep -RE " [a-zA-Z]+\.\s*$" * | grep -v "MIT license"
```

や

```bash
$ grep -RE " you " *
```

とすることでなんとなく探せます。

なんとなくですが。

## 親リポジトリからマージ

親リポジトリは

```bash
$ git remote set-url upstream <URL>
```

で指定しておき

```bash
$ git remote -v
```

で現状を確認できる。

そして、

```bash
$ git pull upstream <BRANCH_NAME>
```

でマージする。

さらに、自分の GitHub に pull アンド push でマージ。

```bash
$ git push origin 1.8/develop_japanese
$ git pull origin 1.8/develop_japanese
```

ブランチを切って作業していればマージも自動で終わるはず。

upstream から pull した後で↓の

![GitHub Desktop Sync Button](/images/2015_1103_github_desktop_sync_button.png)

GitHub Desktop の Sync ボタンでも自分のレポジトリにマージできるので普段はそっちの方が簡単。

## マージ済みのブランチを探す

```bash
git branch -r --list --merged | grep -vE "((upstream|NEKOGET)/|origin/[0-9]+)"
```

## PRしたブランチの削除

GitHub の Pull Request ページから

![Delete branch](/images/2015_1103_delete_branch.png)

のようにブランチを削除したりできる。

が、コマンドラインで処理をすることもできます。

ローカルのブランチを削除するにはこう↓

```bash
git branch -d <branchname>
```

リモートのブランチを削除するにはこう↓

```bash
git push origin :<branchname>
```

## OMG! 間違った名前で間違ったメッセージを書いてコミットしてまった

一連の流れはこう↓

```bash
$ git branch -m <OLD_BRANCH_NAME> <NEW_BRANCH_NAME>
$ git checkout <OLD_BRANCH_NAME>
$ git push origin :<OLD_BRANCH_NAME>
$ git branch --unset-upstream
$ git commit --amend -m "<NEW_COMMIT_LOG>"
$ git push origin <NEW_BRANCH_NAME>
```

個別解説。

直前のコミットログを修正するにはこう↓

```bash
$ git commit --amend -m "<NEW_COMMIT_LOG>"
```

ローカルのブランチ名を変更するにはこう↓

```bash
$ git branch -m <OLD_BRANCH_NAME> <NEW_BRANCH_NAME>
```

ローカルと同じ名前のリモートブランチを削除した場合に注意されることがあるので関連付け？を解除するには切り替えたブランチ上でこう↓

```bash
$ git branch --unset-upstream
```

## 参考

* [GitHubへpull requestする際のベストプラクティス - hnwの日記](http://d.hatena.ne.jp/hnw/20110528)
* [Gitで使われていないリモートブランチの整理 - Qiita](http://qiita.com/makoto_kw/items/c825e17e2a577bb83e19)
* [GitHub - Gitのリモートリポジトリの名前を付け替える　〜Railsのアップグレードを例にして〜 - Qiita](http://qiita.com/kon_yu/items/e9ebd7f778df430a4223)
* [git/コミットログを修正する方法 - TOBY SOFT wiki](http://tobysoft.net/wiki/index.php?git%2F%A5%B3%A5%DF%A5%C3%A5%C8%A5%ED%A5%B0%A4%F2%BD%A4%C0%B5%A4%B9%A4%EB%CA%FD%CB%A1#q9692e83)
* [Git超入門："git push origin master"の"push"と"origin"と"master"の意味がわからないあなたへ · DQNEO起業日記](http://dqn.sakusakutto.jp/2011/10/git_push_origin_master.html)
