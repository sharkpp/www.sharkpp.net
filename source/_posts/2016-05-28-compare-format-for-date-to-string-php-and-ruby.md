---
title: "日付を文字列にするための書式を比較してみた (php と Ruby 編)"
date: 2016-05-28 22:50
tags: [php, ruby, bash, POSIX, まとめ]
categories: [まとめ]

---

php を使っている時に、日付を書式化する場合、 `date()` 関数と `strftime()` 関数があって、どっち使うべきだろうか、とか片方のフォーマットは他方でどれだっけ？とか、まあようするになんでに種類あるんだろう？って思うわけです。

で、対応をまとめてみました。

ほかの言語も調べてみると Ruby の方が色々とフォーマットが追加されてたりするので、比較対象として追加してあります。

## 書式の比較

ざっと確認したところ、大まかに

* php の `date()`
* php の `strftime()` 系 Python や Perl や Linux の `strftime()` 関数(拡張なし)
* Ruby の `Time#strftime()` 系 Linux の `DATE` コマンド や `strftime()` 関数(拡張あり)

の３種類があるようです。

さてはて php の `date()` は一体どこから出てきたのでしょうね。

ともかく、 php と Ruby の関数の書式をまとめてみました。

|php:strftime|php:date|ruby:Time#strftime|説明|
|:-:|:-:|:-:|-|
|  %a  |  D  |        %a        |短縮された曜日の名前|
|  %A  |  l  |        %A        |完全な曜日の名前|
|  %d  |  d  |        %d        |２桁０埋めの日付|
|  %e  |     |        %e        |２桁空白埋めの日付|
|  %j  |     |        %j        |３桁０埋め１開始の年間の通算日|
|  %u  |  N  |        %u        |月曜を１で日曜を７とする曜日|
|  %w  |  w  |        %w        |日曜を０で土曜を６とする曜日|
|  %U  |     |        %U        |最初の日曜を１開始とする年間の通算週|
|  %V  |  W  |        %V        |最初の月曜を１開始とする年間の通算週、53週目は年をまたがる|
|  %W  |     |        %W        |最初の月曜を１開始とする年間の通算週|
|%b, %h|  M  |      %b, %h      |短縮された月の名前|
|  %B  |  F  |        %B        |完全な月の名前|
|  %m  |  m  |        %m        |２桁０埋めの月|
|  %C  |     |        %C        |２桁０埋めの世紀|
|  %g  |     |                  |２桁であらわした年。ISO-8601:1988 標準形式|
|  %G  |  o  |                  |%g の４桁完全版|
|  %y  |  y  |        %y        |２桁０埋めの年のしも２桁|
|  %Y  |  Y  |        %Y        |４桁０埋めの年|
|  %H  |  H  |        %H        |２桁０埋めの24時間制の時間|
|  %k  |     |        %k        |２桁空白埋めの24時間制の時間|
|  %I  |  h  |        %I        |２桁０埋めの12時間制の時間|
|  %l  |     |        %l        |２桁空白埋めの12時間制の時間|
|  %M  |  i  |        %M        |２桁０埋めの分|
|  %p  |  A  |        %p        |指定した時刻に応じた大文字の 'AM' あるいは 'PM'|
|  %P  |  a  |        %P        |指定した時刻に応じた小文字の 'am' あるいは 'pm'|
|  %r  |     |        %r        |"%I:%M:%S %p" と同じ|
|  %R  |     |        %R        |"%H:%M" と同じ|
|  %S  |  s  |        %S        |２桁０埋めの秒|
|%T, %X|     |      %T, %X      |"%H:%M:%S" と同じ|
|  %z  |  O  |        %z        |タイムゾーン。UTC/GMTからのオフセット|
|  %Z  |  T  |        %Z        |タイムゾーン|
|  %c  |     |        %c        |日付と時刻|
|%D, %x|     |      %D, %x      |"%m/%d/%y" と同じ|
|  %F  |     |        %F        |"%Y-%m-%d" と同じ|
|  %s  |  U  |        %s        |Unix エポックからのタイムスタンプ|
|  %n  |     |        %n        |改行文字 ("\n")|
|  %t  |     |        %t        |タブ文字 ("\t")|
|  %%  |     |        %%        |パーセント文字 ("%")|
|%a, %d %b %Y %T %z|  r  |%a, %d %b %Y %T %z|RFC 2822 フォーマットされた日付|
|      |  j  |       %-e        |左寄せの日|
|      |  S  |                  |英語形式の序数を表すサフィックス(stやndなど)|
|      |  z  |                  |左寄せで０開始の年間の通算日|
|      |  n  |       %-m        |左寄せの月|
|      |  t  |                  |指定した月の日数|
|      |  L  |                  |閏年であるかどうか|
|      |  B  |                  |Swatch インターネット時間|
|      |  g  |       %-l        |左寄せの12時間制の時間|
|      |  G  |       %-H        |左寄せの24時間制の時間|
|      |  u  |       %6N        |６桁０埋めのマイクロ秒|
|      |  e  |                  |タイムゾーン識別子|
|      |  I  |                  |サマータイム中か否か|
|      |  P  |       %:z        |タイムゾーン。コロンが入ったUTC/GMTからのオフセット|
|      |  Z  |                  |タイムゾーンのオフセット秒数|
|      |  c  |     %FT%T%:z     |ISO 8601 日付|
|      |     |     %L, %3N      |３桁０埋めのミリ秒|
|      |     |        %N        |９桁０埋めのナノ秒|
|      |     |        %v        |VMS形式の日付 (%e-%b-%Y)|
|      |     |       %::z       |タイムゾーン。コロンが入った秒まで含むUTCからのオフセット|

表にして比較してみると、 php の `date()` 関数は若干サポートしているフォーマットが少ないですが、逆に特殊な内容をサポートしていたりと、なかなかおもしろいと思います。

両方が合わさると最強ではないかと思わなくもないですが、英字1文字で対応するには厳しい気もしますね。

比較は、手でやるのは面倒だったのでスクリプトを組んで調べましたが、まあ、これぐらいなら手でやっても良かったかもしれません。

ほかの言語を追加で調べる場合には、楽ができそうですが。

## スクリプトの利用方法

利用方法は下記の

* [_format-diff.php](https://gist.github.com/sharkpp/2bdf0b6a70fc08044b01b7089e6ef023)
* [php-date.php](https://gist.github.com/sharkpp/84deb455f9e1ffbc50f8cf1d5a0c399b)
* [php-strftime.php](https://gist.github.com/sharkpp/0426f8dd6650083dc30768fc9f3f3c61)
* [ruby-Time#strftime.rb](https://gist.github.com/sharkpp/7f45f212b1d58609bf7ee19164630452)

を同じところにダウンロードして `_format-diff.php` を実行するだけです。

```bash
$ wget https://gist.githubusercontent.com/sharkpp/2bdf0b6a70fc08044b01b7089e6ef023/raw/bffcab5b2ac52c5d2878a351f6626cc3a431baf0/
$ wget https://gist.githubusercontent.com/sharkpp/84deb455f9e1ffbc50f8cf1d5a0c399b/raw/5b8156bb66a21477ea2f6214721f8a7d46082379/
$ wget https://gist.githubusercontent.com/sharkpp/0426f8dd6650083dc30768fc9f3f3c61/raw/9404cd04f9bde929e0d61c97408f0a89a566a449/
$ wget https://gist.githubusercontent.com/sharkpp/7f45f212b1d58609bf7ee19164630452/raw/07c5e4093ad8db4af4048639fa7194b732c5387c/
$
$ php _format-diff.php
|php:strftime|php:date|ruby:Time#strftime|説明|
|:-:|:-:|:-:|-|
|  %a  |  D  |        %a        ||
|  %A  |  l  |        %A        ||
```

## 実際のコード(ちょっと長い)

<script src="https://gist.github.com/sharkpp/2bdf0b6a70fc08044b01b7089e6ef023.js"></script>

<script src="https://gist.github.com/sharkpp/84deb455f9e1ffbc50f8cf1d5a0c399b.js"></script>


<script src="https://gist.github.com/sharkpp/0426f8dd6650083dc30768fc9f3f3c61.js"></script>

<script src="https://gist.github.com/sharkpp/7f45f212b1d58609bf7ee19164630452.js"></script>


## 参考

* [PHP: strftime - Manual](http://jp2.php.net/manual/ja/function.strftime.php)
* [PHP: date - Manual](http://jp2.php.net/manual/ja/function.date.php)
* [instance method Time#strftime (Ruby 2.2.0)](http://docs.ruby-lang.org/ja/2.2.0/method/Time/i/strftime.html)
* [8.1. datetime — 基本的な日付型および時間型 — Python 2.7.x ドキュメント](http://docs.python.jp/2/library/datetime.html#strftime-strptime-behavior)
* [Man page of DATE](https://linuxjm.osdn.jp/html/GNU_coreutils/man1/date.1.html)
* [Man page of STRFTIME](http://linuxjm.osdn.jp/html/LDP_man-pages/man3/strftime.3.html)
* [POSIX::strftime::GNU - search.cpan.org](http://search.cpan.org/~dexter/POSIX-strftime-GNU-0.02/lib/POSIX/strftime/GNU.pm)
* [Time::Piece - オブジェクト指向な時間オブジェクト - perldoc.jp](http://perldoc.jp/docs/modules/Time-Piece-1.08/Piece.pod#pod20351-12356-26041)
