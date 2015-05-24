---
title: "色々なメモ: Qtで遊ぶ 其の５"
date: 2012-01-29 18:25:00
tags: [Develop, C++, Qt, Qtで遊ぶ]
categories: [ブログ]

---

過去の記事は↓

[QtをVisual C++ 2008 Express Editionで使えるようにしてみる: Qtで遊ぶ 其の１][1]

 [1]: /blog/2009/10/04/play-with-qt-part-1.html

[色々なメモ: Qtで遊ぶ 其の２][2]

 [2]: /blog/2009/10/04/play-with-qt-part-2.html

[色々なメモ: Qtで遊ぶ 其の３][3]

 [3]: /blog/2011/07/31/play-with-qt-part-3.html

[色々なメモ: Qtで遊ぶ 其の４][4]

 [4]: /blog/2011/10/30/play-with-qt-part-4.html

こつこつとQt使ってアプリ作ってます、、、

### 非Qtアプリから使われることを前提としたDLLでQtを使うのは面倒くさい

QtアプリからQtを使ったDLLを使うのは割かし簡単のようでサンプルも多数あるようだけど非Qtアプリからの場合はサンプルが見つからなかった。

状況が特殊といえば特殊なのだがちょっと面倒。

結局のところ、DLL側でスレッドを立ててそこでメイン処理を動くようにしてあげないといけなかった。

しかし、このスレッドが曲者でQtのスレッドを使おうとするとうまくいかないので結局ネイティブのスレッドを使うというなんとも不恰好な結果に、、、

[hspdbg at master from sharkpp/hspide - GitHub][5]

 [5]: https://github.com/sharkpp/hspide/tree/master/hspdbg

### QSyntaxHighlighterで正規表現を使っては駄目

`QSyntaxHighlighter`で`QRegExp`を使うとめちゃめちゃ遅くなる。

一行ごとに処理を呼び出しているため、数十行程度であれば問題ないが、1000行とかになってくると目も当てられないぐらい遅い。

正規表現を使わず自力で字句解析処理を行ったところ十分実用に耐える処理になった。

ちなみに、QtCreatorも自力で字句解析を行っている。

### QTreeViewなどのカラムの文字列の右揃え方法

`Qt::TextAlignmentRole` を Role に指定し、値を `Qt::AlignRight` にすればOK

### QSortFilterProxyModelをQTreeVeiwなどのモデルに使った時のdoubleClickedシグナルなどの処理

`QSortFilterProxyModel::mapToSource()` を使ってインデックスを変換してあげればOK

[Qt-interest Archive - QTreeVie, QSortFilterProxyModel and double click signal][6]

 [6]: http://lists.trolltech.com/qt-interest/2006-09/thread00423-0.html




  


とりあえず、こんなものかな、、、

今回は余りメモを取っていなかったorz
