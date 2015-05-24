---
title: "Qt 勉強会 名古屋 #5 に参加しました"
date: 2012-08-06 00:34:00
tags: [C++, Qt]
categories: [ブログ]

---

Qt 勉強会 名古屋 #5 に参加しました。

OSC名古屋で知ってから初めての勉強会でワクワクでした。

勉強会によって色々違ってて面白いなーと最近思っています。

内容は発表資料を見るとして、気になったキーワードを拾ってみた。

## Qt のアプリ開発と自動化 [@task_jp][1]

 [1]: http://www.twitter.com/task_jp

[資料][2]

 [2]: https://t.co/w994veGf

他の人からのパッチをもらったり送ったりが少ない 、、、が、それでいいのだろうか？

パッチ送ったりするのは大変、なので、もっと簡単に出来ないか？

が、主題の発表

  * [jcthemesimulator][3]
  * [qumoplayer][4]
  * [Gerrit][5]  
    git専用のコードレビューができるアプリ＆サービス
  * [Gitweb][6]  
    git専用のコードレビューサーバー、lhazも使っている模様
  * [transifex.com][7]  
    翻訳サポートサービス

 [3]: http://code.google.com/p/jcthemesimulator/
 [4]: https://gitorious.org/qumoplayer
 [5]: http://code.google.com/p/gerrit/
 [6]: https://git.wiki.kernel.org/index.php/Gitweb
 [7]: https://www.transifex.com/

Gerrit使ってパッチを送るのを簡単に出来るようにしてみた＆jenkinsとredmineを使ってみた↓

  * <http://cr.qtquick.me/>
  * <http://dev.qtquick.me/>

## Qt Quick2のCanvasを使ってみた [@IoriAYANE][8]

 [8]: http://www.twitter.com/IoriAYANE

[資料][9]

 [9]: http://t.co/szfRkdBM

Quick2の紹介

HTML5のCanvasのようなもの

好きな図形がかけてローカルの画像を読み書きできる。

pngやiconは透過色も保存できる。

  * [Canvas][10]
  * [Context2D][11]

 [10]: http://doc-snapshot.qt-project.org/5.0/qml-qtquick2-canvas.html
 [11]: http://doc-snapshot.qt-project.org/5.0/qml-qtquick2-context2d.html

http://relog.xii.jp/archives/2012/07/qmlqtcanvas.html

## Qtでジョイスティック

SDLを使ってマルチプラットフォームでジョイスティックの情報を取得。

wiiremote や openNI 使えばWiiリモコンやKinektつかえるかも？

## もくもく

何か新しいもの作ってみようかと思ったけど、hspideをMacでコンパイルしてみようかなって思ったので今回はそれをもくもくしてみた。

VCとgccの違いでインクルードガードが無効になったりとか _countof が無かったりとか、いろいろ面倒だorz

ちょっと時間が短かったのであまり進まなかった。
