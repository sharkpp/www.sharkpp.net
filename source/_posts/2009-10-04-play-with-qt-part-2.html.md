---
title: "色々なメモ: Qtで遊ぶ 其の２"
tags: [C++, Qt, Qtで遊ぶ]
categories: [blog]

---

Qtでアプリケーションを作る時のコマンドなどなどのメモ

そのほか、其の１で書いていなかった詳細など

要するに忘れないようにするためのメモ書き

### プロジェクトの作成方法などのメモ

uiファイルからヘッダを生成するには、

<pre>uic -o hoge.h hoge.ui
</pre>



  


Makefileを作るには、

<pre>qmake -project
qmake
</pre>



  


プロジェクトファイルを作るには、

<pre>qmake -project -t vcapp
qmake
</pre>

ただし、生成されたプロジェクトファイルにはQtのパスが埋め込まれているので注意が必要！



  


### QtCore.libなどのライブラリを静的リンク形式にする方法

  * 参考：[VS2005+Qt4でフルスタティックビルド][1]
  * ソリューションなんか作られていなかったので、一つずつ新規ソリューションに追加。
  * src\corelib\QtCore.vcproj と src\winmain\qtmain.vcproj と　src\gui\QtGui.vcproj は基本で後は必要あればな感じ
  * それぞれ、「マルチスレッド (/MTd)」と「マルチスレッド デバッグ (/MDd)」から「マルチスレッド (/MT)」と「マルチスレッド デバッグ (/MD)」に変更
  * 参考記事ではReleaseとDebugで二回ビルドが必要とか書いてあるけどバッチビルドを使えば一回ですむ



  


### その他メモ

  * アプリケーションアイコンはこの辺が参考になる→[アプリケーションアイコンの設定][2] 最新：[Setting the Application Icon][3]

 [1]: http://d.kawataso.net/2008/03/vs2005qt4-1.html
 [2]: http://www.kde.gr.jp/~ichi/qt/appicon.html
 [3]: http://qt.linux-life.net/4/doc/ja/appicon.html