---
title: "色々なメモ: Qtで遊ぶ 其の3"
date: 2011-07-31 23:32:00
tags: [C++, Qt, Qtで遊ぶ]
categories: [blog]

---

過去の記事は↓

[QtをVisual C++ 2008 Express Editionで使えるようにしてみる: Qtで遊ぶ 其の１][1]

 [1]: /blog/2009/10/04/play-with-qt-part-1

[色々なメモ: Qtで遊ぶ 其の２][2]

 [2]: /blog/2009/10/04/play-with-qt-part-2.html

少しずつQtのソース見つつ調べつつでやってきたメモ的な何か

### ウィジェット関連の何か

QProgressBarでマーキー(marquee、メモリが左右に動くなどして進捗の終了が不明の場合に使うスタイル)で表示するには、`QProgressBar.setRange(0, 0)` のように範囲の最小と最大を共に0にすれば良いようだ。

  * [Marquee progress bar?][3]

 [3]: http://www.qtcentre.org/threads/28046-Marquee-progress-bar

その他、ウィジェットをカスタマイズする時などに参考になりそうなメモ

  * [Qt開発時のメモ][4]
  * [Using QStatusBar : QStatusBar???Qt???C][5]

 [4]: http://uilabo.web.fc2.com/Qt/QtDevMemo.html
 [5]: http://www.java2s.com/Code/Cpp/Qt/UsingQStatusBar.htm



  


### シグナル＆スロット関連の何か

  * [Qt 4.7: Signals & Slots][6]

 [6]: http://doc.qt.nokia.com/latest/signalsandslots.html



  


### アルゴリズム的な何か

Qtでスマートポインタ使う場合は、`QSharedPointer`や`QScopedPointer`がある。

あと、QObjectの派生クラスは、コンストラクタで親を指定すると親の破棄で勝手に削除してくれるらしい。

  * [c++ - Smart pointers in Qt - Stack Overflow][7]
  * [@sharkpp 独自クラスのコンストラクタの初期化リストで...][8]
  * [QObject?Life?Cycle][9] ※PDF

 [7]: http://stackoverflow.com/questions/1481616/smart-pointers-in-qt
 [8]: https://twitter.com/#!/rofi/status/94670745967403008
 [9]: http://taschenorakel.de/files/qobject-lifecycle.pdf



  


### ディレクトリ、ファイル関連の何か

ディレクトリ移動は、`QDir::setCurrent()` で出来るようだが、ディレクトリの区切りが最後に無いとうまくいかないようだ。

  * [Couldn't change current directory in windows's QT][10]

 [10]: http://www.qtcentre.org/threads/12038-Couldn-t-change-current-directory-in-windows-s-QT



  


### プロセス間通信の何か

子プロセスの終了時にシグナルを呼ばれるようにするには `finished()` を `connect` すればいいようだ。

他にも標準出力やエラー出力を取得した時などのシグナルがあるようだ。

試したところ、なぜか、強制終了した場合も正常終了となってしまうようだが、、、もうすこし調べる必要はあるようだ。

  * [c++ - How can I monitor QProcess finished() in qt4 (Signal/Slot) - Stack Overflow][11]

 [11]: http://stackoverflow.com/questions/4200760/how-can-i-monitor-qprocess-finished-in-qt4-signal-slot

Window メッセージをQtで取得するには↓をオーバーライドすればいいらしい

`QApplication::winEventFilter(MSG*)`

  * [Qt-interest Archive - Getting Windows message in Qt app][12]

 [12]: http://lists.trolltech.com/qt-interest/2002-04/thread00039-0.html



  


### コーディング規則など

  * [Designing Qt-Style C++ APIs][13]

 [13]: http://doc.trolltech.com/qq/qq13-apis.html



  


### 多言語対応な何か

標準ツールを日本語で使うには...

インストールディレクトリ直下の translations フォルダの *_ja.ts を lrelease で変換してあげればよいようです。

ただ、何故か Linguist はうまく日本語にならなかったです。

  * [Qt (8) QtAssistantのGUIの日本語化 | OFF-SOFT.net][14]
  * [Qtの日本語ドキュメント - Emacs ひきこもり生活][15]

 [14]: http://www.off-soft.net/ja/develop/qt/qt1-8.html
 [15]: http://d.hatena.ne.jp/meech/20110213/1297597395

ファイルを読み込んだときの文字化けを解消するため↓を先頭に書く

リンク先では埋め込み文字列が云々と書かれているが、ファイルから様だと気にも影響があるようだ(別のページで見たけどそのページが見つからない...)。

<pre>QTextCodec::setCodecForCStrings(QTextCodec::codecForLocale());
</pre>

  * [日本語の表示][16]

 [16]: http://qtprogramming.s2.zmx.jp/Qt4Examples/Japanese.html

そのほか実際の実装などについてのメモ

  * [国際化][17]
  * [QLocale - QtCentreWiki][18]
  * [Qt (8)-2 QtAssistantで使うHELPファイルを作成する | OFF-SOFT.net][19]

 [17]: http://qtprogramming.s2.zmx.jp/Qt4Note/qt4_note/internationalization.html
 [18]: http://www.qtcentre.org/wiki/index.php?title=QLocale
 [19]: http://www.off-soft.net/ja/develop/qt/qt1-8-2.html