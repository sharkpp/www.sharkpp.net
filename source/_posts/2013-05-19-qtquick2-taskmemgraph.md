---
title: "続・QtQuick2でアプリ作ってみたよ"
date: 2013-05-19 18:48:00
tags: [C++, Qt, Qtで遊ぶ, QtQuick]
categories: [ブログ]
redirect:
    - /blog/2013/05/19/qtquick2_taskmemgraph.html
---

勉強会の続きが結構かかってしまったけど何とかそれなりに形になりました。

もしくは、力尽きたともいうorz


![QtQuick2 on Mac][1] ![QtQuick2 on Windows][2]

 [1]: /images/2013_0519_qtquick2_mac.png
 [2]: /images/2013_0519_qtquick2_win.png

とりあえず、完成までの流れおば

## QtQuick2でUI描画を作成

勉強会ではここで力尽きました。

QtQuick2でCanvasエレメント上に円グラフを描き描きしてそれらしい形に。

後からTextエレメントでプロセス名の一覧とメモリの使用量を表示できるようにしました。

### 参考

  * [QtQuick 5.0: Loader | Documentation | Qt Project][3]
  * [QtQuick 5.0: Item | Documentation | Qt Project][4]
  * [QML(Qt)のエレメントを動的に生成をする - 理ろぐ][5]
  * [Qt 4.7: QML Data Models][6]

 [3]: http://qt-project.org/doc/qt-5.0/qtquick/qml-qtquick2-loader.html
 [4]: http://qt-project.org/doc/qt-5.0/qtquick/qml-qtquick2-item.html
 [5]: http://relog.xii.jp/mt5r/2012/03/qmlqt-16.html
 [6]: http://harmattan-dev.nokia.com/docs/platform-api-reference/xml/daily-docs/libqt4/qdeclarativemodels.html#qobjectlist-based-model

## QMLとC++の連携

最初作ったプロジェクトではどうもC++の関数が呼べなかったらしく少し回り道を、、、してしまったがプロジェクトを作り直して準備完了。

単純なQStringとかを返すのではなくいろんな情報を持つオブジェクトを返したかったので少し変わった事をしています。

[TaskMemGraph/processlist.h at master - sharkpp/TaskMemGraph - GitHub][7] や [TaskMemGraph/processinfo.h at master - sharkpp/TaskMemGraph - GitHub][8] など で実装しているのですが、`ProcessInfo`クラスは`QObject`から派生していて、`Q_PROPERTY`でプロパティーを定義しています。

 [7]: https://github.com/sharkpp/TaskMemGraph/blob/master/processlist.h
 [8]: https://github.com/sharkpp/TaskMemGraph/blob/master/processinfo.h

こうすると、QML側では、

    var v = item;
    var yy = v.name;
    

みたいに呼び出せます。

で、`ProcessList`クラスも`QObject`から派生していて、`Q_INVOKABLE`で必要なメソッドを定義してあります。

戻り値を`QList<QObject*>`で定義するとQML側では、

    var v = hoge.data();
    for(i in v) {
        var yy = v[i].name;
    }
    

みたいに呼び出せます。

もちろん、

    qmlRegisterType<ProcessInfo>("ProcessLib",1,0,"ProcessInfo");
    qmlRegisterType<ProcessList>("ProcessLib",1,0,"ProcessList");
    

のような感じで型の登録が必要になります。

ただ、なかなか思ったような処理のやり方がわからず探し回りました。

### 参考

  * [\[Qt\]\[QML\]QMLとC++コードの連携 - Utworks][9]
  * [Using QML Bindings in C++ Applications | Documentation | Qt Project][10]
  * [QtQuick での C++ × QML バインディングについてまとめてみた - 凹みTips][11]
  * [Calling Qt class methods from QML - Nokia Developer Wiki][12]
  * [Accessing C++ QLists from QML - Stack Overflow][13]

 [9]: http://utworks.net/?p=64
 [10]: http://qt-project.org/doc/qt-4.8/qtbinding.html
 [11]: http://d.hatena.ne.jp/hecomi/20130503/1367594609
 [12]: http://www.developer.nokia.com/Community/Wiki/Calling_Qt_class_methods_from_QML
 [13]: http://stackoverflow.com/questions/14287252/accessing-c-qlists-from-qml

## Macでのプロセス操作のプログラミング

ここから、完全に未知の領域です。

Macのプログラム、なにそれ？おいしいの？状態でしたが、、、そもそも、何をキーワードにして検索をすればいいかとか どこを見ればいいかとかが分からず、今回一番苦労したところです。

結局は、[Apple Developer][14]が総本山だったってことが分かったのですが、それにしても 目的の処理をしようとする方法も分からず？？？な状態でしたが、まあ、何とかなるもんです。

 [14]: https://developer.apple.com/

### 参考

  * [sysctl(3) Mac OS X Developer Tools Manual Page][15]
  * [Using task\_for\_pid on Mac OS X (Doug's Note System)][16]
  * [Mac OS X and task\_for\_pid() mach call - Ivan's blog][17]
  * [Evernote 共有ノートブック: IT sec research][18]
  * [QtDoc 5.0: qmake Platform Notes | Documentation | Qt Project][19]
  * [(Mac OS X / LINUX での) 外部コマンドの消費メモリのモニタリング - ny23の日記][20]

 [15]: https://developer.apple.com/library/mac/documentation/Darwin/Reference/ManPages/man3/sysctl.3.html
 [16]: https://blogs.oracle.com/dns/entry/understanding_the_authorization_framework_on
 [17]: http://os-tres.net/blog/2010/02/17/mac-os-x-and-task-for-pid-mach-call/
 [18]: https://www.evernote.com/pub/view/wishi/crazylazy/b213a94c-0780-4271-8c77-7da7f92a62b3?locale=ja#st=p&n=b213a94c-0780-4271-8c77-7da7f92a62b3
 [19]: http://qt-project.org/doc/qt-5.0/qtdoc/qmake-platform-notes.html
 [20]: http://d.hatena.ne.jp/ny23/20100818/p2

## Windowsでのプロセス操作のプログラミング

こっち側はまあAPIとかは少し探しましたが、まあそれなりで、、、

MSDNで日本語の内容も読めるし圧倒的に日本語の資料が多いので簡単です。

こういうところはユーザー数の違いが顕著に出ますね。

## まとめ

初めてQtQuick2をやってみて、、、まあそれなりに手が動いたのはJavaScriptベースだったからでしょうか？

まだ、ちょっと自分の作りたい方向性のものとちょっと違うので、このままどっぷりはまっていくかというとそうでもなさそうですが、 雰囲気は掴めたので何かの時には、またを出しそうな感じです。

そもそも、初っ端からC++との連携とかMacのプロセス操作とかハードルが高すぎましたねorz

[sharkpp/TaskMemGraph - GitHub][21]でソースを公開していますがバイナリはなんかdllがたくさん必要なので公開していません。 主にサイズ的な制限で、、、Windows側は必要なDLLが総計40MBですってよorz

 [21]: https://github.com/sharkpp/TaskMemGraph

ちなみに、動かすのに管理者権限が必要になります。

Mac側は確実に、そして、Windows側はXPでしか試していないですが、恐らく管理者権限が必要だと思います。

Macで動かしたアプリのスクショです。

[![QtQuick2 on Mac][1]][22]

 [22]: /images/2013_0519_qtquick2_mac.jpg

こっちはWindowsで動かしたアプリのスクショです。

[![QtQuick2 on Windows][2]][23]

 [23]: /images/2013_0519_qtquick2_win.jpg

自分で試してみたいという奇特な方は、[sharkpp/TaskMemGraph - GitHub][21]からソースを取得して遊んでみてください。

ではでは
