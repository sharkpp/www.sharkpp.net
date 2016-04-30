---
js: { sheetrock: true }
title: "ファイル拡張子のようなドメインをまとめてみた"
date: 2016-04-30 14:29
tags: [まとめ, ドメイン名]
categories: [まとめ]

---

以前に [ローマ字として読むことが可能なドメインをまとめてみた](http://www.sharkpp.net/blog/2015/09/21/romaji-readable-domains.html) として、ローマ字として読めるドメインをまとめてみましたが、ある意味ではそれの第二弾のような内容です。

今回は、ファイルの拡張子、例えば hogehoge.sh でシェルスクリプト、見たいな拡張子が他にもないか調べまとめてみることにしました。

例えば、 `very-amazing.mov` とか `fiddle.py` とか `fiddle.pl` とか `fiddle.sh` とか `nandemo.zip` とか  `nandemo.cab` とか、ぱっと見で何ができるか、わかる気がしませんか？

例によって [IANA — Root Zone Database](http://www.iana.org/domains/root/db) をソースとして利用しています。

下の表は [ファイル拡張子のようなドメイン - Google スプレッドシート](https://docs.google.com/spreadsheets/d/164kFGy6G52qJ6xmqZ8oyxVwc5714mXoWYSohs23WZoo/edit?usp=sharing) から確認できます。

## ファイル拡張子のような TLD の一覧

<table class="table table-bordered table-hover table-condensed table-striped" data-sheetrock="https://docs.google.com/spreadsheets/d/164kFGy6G52qJ6xmqZ8oyxVwc5714mXoWYSohs23WZoo/edit#gid=0"></table>

## まとめ

ざっと見たところでは、あるアプリケーションの専用フォーマットに付けられている拡張子が多い気がします。

ただ、その中でも、

|ドメイン/拡張子|種別|
|-|-|
|.ai|Adobe Illustrator File|
|.app|Mac OS X Application|
|.as|ActionScript File / HSP source File|
|.bz|Bzip Compressed File|
|.cab|Windows Cabinet File|
|.cc|C++ Source Code File|
|.coffee|CoffeeScript JavaScript File|
|.java|Java Source Code File|
|.md|Markdown Documentation File|
|.mobi|Mobipocket eBook|
|.mov|Apple QuickTime Movie|
|.pl|Perl Script|
|.ps|PostScript File|
|.py|Python Script|
|.sh|Bash Shell Script|
|.tk|Tk Script|
|.zip|Zipped File|

辺りが一般的なものっぽいかな？と言う気がします。

まあ、なかなか活用は難しそうですが、この表を見て良いドメインを閃いきサービスを作ったのであれば、こっそりとサービスの極片隅に書いておいてもらえると嬉しいです。

## 参考

* [IANA — Root Zone Database](http://www.iana.org/domains/root/db)
* [FileInfo - The File Extensions Database](http://fileinfo.com/)
