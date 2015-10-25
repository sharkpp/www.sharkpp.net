---
title: "Mac で rbenv を使って複数バージョンの Ruby を管理するためのメモ"
date: 2015-10-25 12:00
tags: [メモ, Ruby, Mac, rbenv, 環境構築]
categories: [ブログ]

---

## 概要

ちょっと、いろいろなバージョンの Ruby を使用しないといけない状況に陥ったので rbenv での ruby のバージョンを管理をする方法のメモ。
環境は、 Mac を使用しているので Homebrew を使って rbenv をインストールしています。

以前に [Mac OS X 10.8 に Ruby 1.9.3 をインストールする方法](/blog/2014/04/15/ruby-1-9-3-install-for-mac-10-8.html) で rvm を使ってインストールしていましたが、ごっそりアインインストールをしています。

## インストール

まず rbenv と ruby-build をインストール

```bash
$ brew install rbenv ruby-build
```

パスを通す＆設定反映

```bash
$ echo 'eval "$(rbenv init -)"' &gt;&gt; ~/.bash_profile
$ source ~/.bash_profile
$ rbenv rehash
```

インストール可能なバージョンを調べるには

```bash
$ rbenv install -l
```

で確認できますが、 JRuby とかいろいろ出てくるので

```bash
$ rbenv install -l | grep -E "\s+[0-9]"
```

のようにしたほうが多少探しやすくなるかも。

とりあえず Ruby 1.9 と 2.2 をインストール

```bash
$ rbenv install $(rbenv install -l |grep -E "^\s+1.9" | tail -n 1)
Cloning https://github.com/ruby/ruby.git...
Installing ruby-1.9.3-p551...
Installed ruby-1.9.3-p551 to ~/.rbenv/versions/1.9.3-p551

$ rbenv install $(rbenv install -l |grep -E "^\s+2.2" | tail -n 1)
Cloning https://github.com/ruby/ruby.git...
Installing ruby-2.2.1-dev...
Installed ruby-2.2.1 to ~/.rbenv/versions/2.2.1
```

システム全体で使用する Ruby を最新バージョンに切り替えるs

```bash
$ rbenv global $(rbenv versions | sed -e "s/\*/ /g" | sort -n | tail -n 1 | cut -d " " -f 3)
```

## アンインストール

アンインストールも簡単、インストールしたフォルダ自体を削除するか聞かれるので、まぁ基本は `y` 一択だと思われる

```bash
$ rbenv uninstall 1.9.3-p551
rbenv: remove ~/.rbenv/versions/1.9.3-p551? y
```

ただし、選択している Ruby をアンインストールした場合、選択し直さないといけない

```bash
$ rbenv versions
rbenv: version `1.9.3-p551' is not installed
  system
  2.2.1
```

## バージョン管理

システムにインストールされている Ruby のバージョンを確認するには

```bash
$ rbenv versions
  system
  1.9.3-p551
* 2.2.1 (set by ~/test/.ruby-version)
```

です。

`*` マークが付いているバージョンが現在選択されている Ruby のバージョンで、バージョンの後ろについている `set by XXXX` は、`.ruby-version` ファイルによってローカルでは、このバージョンが指定されています、ということです。

この状態でバージョンを確認すると

```bash
$ ruby -v
ruby 2.2.1p85 (2015-02-26 revision 49769) [x86_64-darwin13.4.0]
```

となります。

あるプロジェクトがシステムで使用しているバージョンと違うバージョンの Ruby を必要としているなら

```bash
$ rbenv local 1.9.3-p551
```

このようにします。

すると

```bash
$ ruby -v
ruby 1.9.3p551 (2014-11-13 revision 48407) [x86_64-darwin13.4.0]
```

となります。

## まとめ

インストール可能な一覧を取得

```bash
$ rbenv install -l | grep -E "\s+[0-9]"
```

Ruby をインストール

```bash
$ rbenv install バージョン
```

Ruby をアンインストール

```bash
$ rbenv uninstall バージョン
```

インストールされている Ruby のバージョンの一覧を表示

```bash
$ rbenv list
```

システムで使用する Ruby のバージョンを変更

```bash
$ rbenv global バージョン
```

ローカル(カレントディレクトリ以下)で使用する Ruby のバージョンを変更

```bash
$ rbenv local バージョン
```

## 参考

* [Mac - homebrewでバージョンを指定してインストールする - Qiita](http://qiita.com/semind/items/f8f647e757842f08b9ec)
* [Ruby 1.9と2.0, Rails3とRails4を切り替える - Qiita](http://qiita.com/dandy-z/items/578169e04acc475c39b5)
* [noanoa 日々の日記 : Ruby 2.0.0 を Homebrew + rbenv で OS X Mountain Lion にインストール](http://blog.livedoor.jp/noanoa07/archives/1897747.html)
* [MacPortsからHomeBrewに乗換え&Python開発環境構築 - c-bata web](http://nwpct1.hatenablog.com/entry/2014/03/20/173740)
