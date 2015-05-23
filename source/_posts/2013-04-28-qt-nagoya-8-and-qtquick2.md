---
title: "名古屋Qt勉強会#8に行ってきたよ＆QtQuick2でアプリ作ってみたよ"
date: 2013-04-28 00:07:00
tags: [Qt, 雑記, 勉強会, QML]
categories: [blog]

---

久しぶりの名古屋Qt勉強会でした。

[名古屋Qt勉強会#8 4/27][1]

 [1]: http://www.zusaar.com/event/607003

今回は発表する人が無かったので全員での自己紹介の後はもくもく会になったので良い機会なのでhspideの続きではなく未体験ゾーンのQtQuick2で何か作ってみることにしました。

ここからは少し雑談を挟みつつひたすらもくもくしていきます。

雑談は、Twitterに流れている物だと、

<blockquote class="twitter-tweet" lang="ja"><p>
なんとなくスルー QT @<a href="https://twitter.com/mizmit1222">mizmit1222</a>: OSC名古屋はなんとなくスルーということで <a href="https://twitter.com/search/%23qtngy">#qtngy</a>
</p>&mdash; 理音伊織さん (@IoriAYANE) 
<a href="https://twitter.com/IoriAYANE/status/327998905256136704">2013年4月27日</a>
</blockquote>

とかそんな感じです。

QtQuick2を使うための準備としてのQt5のインストールは数日前に終わっていたので(今回の勉強会がもくもくになりそうな感じであったので準備していた)とりあえずプロジェクトを作ってHello Worldを表示するのは簡単でした。

で、こっから少し躓きました。

QtCreatorでデザインボタンを押すとカーソルがくるくる回って一向に先に進まない、しばらく待っていると画面が切り替わるが、やっぱりカーソルはくるくる。

で、現行のQtCreatorはQtQuick2に対応していないとの情報が勉強会に参加している人から得られたのですが、最終的にはどうも状況が違っていてQtCreatorがうまく動いていないのではないかとの結論になりました。

とりあえず、そんな感じでQtCreatorのデザイナーを使うのをあきらめて参考ページを見つつ作っていくことに。

ざっとやった感じで何となく見えてきたのは、JavaScriptっぽいなーと、まあ、V8エンジンを使っていたり(なんか別のになる、なったらしいけど)するのでまあそりゃそうだなーって感じではあるのですが、、、

あとは、現状の理解の範囲では部品をぽこぽこ置いていきそれに対してプロパティーをセットしてって感じですね。

ただ、前に見聞きした話だとQMLはイベントドリブンではなくステートドリブンだって話だったような気がしたのでなんか違うのかも？(検索かけたら自分のページが出てきた、、、)

で、結局、色々あってがんばったのですが、途中でタイムアップしてしまいました。

![image][2]

 [2]: /images/2013_0427_qtquick2.png

表示的な部分は少し微妙なところはありますが大体できた感じです。 ただ、この先が問題、、、

作りたかった物はどうもQtの機能だけでは実現できないようでネイティブな機能、WindowsならAPIだとかLinuxならシステムコールだとかを呼び出さないと行けない代物。 なので、まあ、ここからが完全なる未体験ゾーンかなーと思います。 Macのシステムプログラミングなんてやったことねーよ(´・ω・｀)

ってことで、ぐぐってもよくわからないのでQtのソースなどを足がかりに進めていこうかなーと思います。

つ [sharkpp/TaskMemGraph - GitHub][3]

 [3]: https://github.com/sharkpp/TaskMemGraph

以上、報告終わり

## 参考

  * [Just Metal, Just Baroque.: 扇形を作る(moveTo+arc+closePath) [html5 の Canvas を使ってみる：第四回]][4]
  * [さまざまな図形を描く - Canvas - HTML5.JP][5]
  * [QML(Qt)でCanvasを使ってみた - 理ろぐ][6]
  * [QML(Qt)でJavaScript（処理）を分離する - 理ろぐ][7]
  * [Online RGB Color Wheel][8]
  * [RGB色空間とHSV色空間の相互変換 Javascript版 - 今日も適当ダイアリー][9]

 [4]: http://blog.flugel.biz/2009/12/html5-canvas-arc_17.html
 [5]: http://www.html5.jp/canvas/how2.html
 [6]: http://relog.xii.jp/mt5r/2012/07/qmlqtcanvas.html
 [7]: http://relog.xii.jp/mt5r/2011/09/qmlqtjavascript.html
 [8]: http://www.colorspire.com/rgb-color-wheel/
 [9]: http://d.hatena.ne.jp/ja9/20100903/1283504341