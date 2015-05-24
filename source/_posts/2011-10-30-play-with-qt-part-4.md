---
title: "色々なメモ: Qtで遊ぶ 其の4"
date: 2011-10-30 21:00:00
tags: [Develop, C++, Qt, Qtで遊ぶ]
categories: [ブログ]

---

色々メモ...

だんだんと手抜きにorz

### QStringListIteratorの使い方

QtのイテレーションにはJava風とSTL風の二種類があるらしい...

[bool addDirectors(const Movie &theMovie) { QStringListIterator it(theMovie - Pastebin.com][1]

 [1]: http://pastebin.com/3HZP6RUr

[Qt 4.7: Container Classes][2]

 [2]: http://doc.qt.nokia.com/latest/containers.html

### QXmlSimpleReaderの使い方

[Qt 4.7: SAX Bookmarks Example][3]

 [3]: http://doc.qt.nokia.com/stable/xml-saxbookmarks.html

### タブ付きドック

複数のドックをまとめてタブ付きにするのは、

tabifyDockWidget()

タブ付きにすると最後にまとめたドックが表示されるので、表示を変えるには

dock->setFocus();

dock->raise();

とする。

setFocusは無くてもよいようだ。

[qt - Focusing on a tabified QDockWidget in PyQt - Stack Overflow][4]

 [4]: http://stackoverflow.com/questions/1290882/focusing-on-a-tabified-qdockwidget-in-pyqt

### ツリービューのダブルクリックシグナルを受信

検索して見つかったページと同じようにしても残念ながらうまくいかなかったので少しゴニョゴニョしています。

#### シグナル受信の準備

<pre>// シグナルに接続
connect(myTree, SIGNAL(doubleClicked(const QModelIndex &)), this, SLOT(dblClickedOnMyTreeView(const QModelIndex &)));
</pre>

<pre>// ダブルクリックで編集を開始しないようにする
myTree-&gt;setEditTriggers(QAbstractItemView::NoEditTriggers);
</pre>

#### シグナル受信

<pre>void foo::dblClickedOnMyTreeView(const QModelIndex & index) {
MyItem * myObj = (static_cast&lt;MyItem*&gt;(index.internalPointer()))-&gt;child(index.row(), index.column());
}
</pre>

[How to double click on a QTreeView - Qt Programming - QtForum.org][5]

 [5]: http://www.qtforum.org/article/14999/how-to-double-click-on-a-qtreeview.html

Qt関連のメモをもう少しまとめれたらいいんだけどなーorz
