---
title: "QtをVisual C++ 2008 Express Editionで使えるようにしてみる: Qtで遊ぶ 其の１"
tags: [C++, Qt, Qtで遊ぶ]
categories: [blog]

---

前から興味を持っていた、[Qt][1]で遊び始めた。

クロスプラットフォームでルック＆フィールがネイティブなフレームワークとしてwxWidgetsかQtか迷うところだけどとりあえずQtに手を出してみた。

まず、Qtのオープンソース・Windows版はターゲットとしているコンパイラが[MinGW][2]みたいだけどVisual C++ 2008 Express Editionを使いたかったので検索。(<a href="#f1" name ="b1" title="http://www.off-soft.net/ja/develop/qt/qt1.html">*1</a>) (<a href="#f2" name ="b2" title="http://www.02.246.ne.jp/~torutk/cxx/qt/QtOnWindowsAndVisualStudio.html">*2</a>) 

でも、結局MinGWも入れないと後のビルド途中でエラーが出てしまったのでMinGWも入れました。



  


で最初に、「Qt SDK for Windows」をインストールしてみたんだけど、これが大失敗。

configureがインストールフォルダに見つからなくて、色々探した。

結局、「Windows版Qtライブラリ」の方が正解だったみたい。

で「Windows版Qtライブラリ」をインストール。



  


次に、環境設定とライブラリとサンプルのビルド。



  


「Visual Studio 2008 コマンド プロンプト」を実行してインストールフォルダに移動。

Z:\Qtにインストールしたので、

<pre>C:\Program Files (x86)\Microsoft Visual Studio 9.0\VC&gt;Z:
Z:\&gt;cd Z:\Qt
Z:\Qt&gt;
</pre>

そして、対象の開発環境を指定し環境設定を行う。

今回は、静的リンクでEXEを作りたいので、`-static`オプションも追加(<a href="#f3" name ="b3" title="http://doc.trolltech.com/4.1/deployment-windows.html#building-qt-statically">*3</a>) 

<pre>Z:\Qt&gt;set QMAKESPEC=win32-msvc2008
Z:\Qt&gt;configure -debug-and-release -static -D _CRT_SECURE_NO_WARNINGS
Which edition of Qt do you want to use ?
Type 'c' if you want to use the Commercial Edition.
Type 'o' if you want to use the Open Source Edition.
o &lt;-- オープンソース版を使うので'o'を入力
 
This is the Qt for Windows Open Source Edition.
 
You are licensed to use this software under the terms of
the GNU General Public License (GPL) version 3
or the GNU Lesser General Public License (LGPL) version 2.1.
 
Type '3' to view the GNU General Public License version 3 (GPLv3).
Type 'L' to view the Lesser GNU General Public License version 2.1 (LGPLv2.1).
Type 'y' to accept this license offer.
Type 'n' to decline this license offer.
 
Do you accept the terms of the license?
y &lt;-- ライセンスを受諾したので'y'を入力
--- この後Maikfileの作成などなどが自動で行われます。 ---
Z:\Qt&gt;
</pre>

この処理自体結構時間がかかる。



  


でライブラリ類やサンプルのMake。

<pre>Z:\Qt&gt;nmake
--- 以下、ずらずらとビルドログが出力されます。 ---
Z:\Qt&gt;
</pre>

なんか自分の環境では途中で失敗したけどテストアプリが生成できたので放置



  


OSの環境変数にも追加。

  * set QMAKESPEC=win32-msvc2008
  * set PATH=%path%;C:\Qt\Qt\bin\.;C:\Qt\Qt\lib\.;C:\Qt\bin\.



  


サンプル(<a href="#f4" name ="b4" title="http://null.michikusa.jp/misc/qt.html">*4</a>)を見ながら、コマンドを打ち込んでいく。 

で、Visual Studioのプロジェクトファイルを生成しビルド。

出来た、EXEのインポート情報を見てみると...MSVCR90.DLLをインポートしていた＿|￣|○



  


プロジェクトのプロパティの構成プロパティ→C/C++→コード生成を開き、「ランタイムライブラリ」を「マルチスレッド (/MT)」に変更。

でビルド...

すると大量のリンクエラーが出るのでリンカを開き「特定のライブラリの無視」に msvcrt.lib を追加しビルド...

でもやっぱりエラーが出る。

で検索(<a href="#f5" name ="b5" title="http://d.kawataso.net/2008/03/vs2005qt4-1.html">*5</a>) 

ライブラリ自体も「マルチスレッド (/MT)」に変更しないといけないみたいなので変更してビルド



  


ビルドが終わったらサンプルをもう一回ビルド＆インポート情報を確認

結果、完全に依存関係が無くなったEXEが出来ました。



  


EXEのサイズ：約5MB

...むー結構でかいな

<a href="#b1" name="f1">*1</a>: http://www.off-soft.net/ja/develop/qt/qt1.html

<a href="#b2" name="f2">*2</a>: http://www.02.246.ne.jp/~torutk/cxx/qt/QtOnWindowsAndVisualStudio.html

<a href="#b3" name="f3">*3</a>: http://doc.trolltech.com/4.1/deployment-windows.html#building-qt-statically

<a href="#b4" name="f4">*4</a>: http://null.michikusa.jp/misc/qt.html

<a href="#b5" name="f5">*5</a>: http://d.kawataso.net/2008/03/vs2005qt4-1.html

 [1]: http://qt.nokia.com/title-jp
 [2]: http://www.mingw.org/