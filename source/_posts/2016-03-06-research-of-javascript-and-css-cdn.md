---
title: "JavaScript や CSS の CDN サービスについて調べてみた"
date: 2016-03-06 21:30
tags: [まとめ, CDN, JavaScript, CSS]
categories: [まとめ]

---

jQuery や Bootstrap などの一般的なライブラリを使うときは自分のサイトに設置する以外に、 Content Delivery Network 略して CDN サービスで配信されているものを利用することもあります、というかこのページでも使っています。

ということで、 CDN サービスを調べてみました。

## 対象

一般的な多くのライブラリを配信しているサービス

* [cdnjs.com - The free and open source CDN for web related libraries to speed up your website!](https://cdnjs.com/)
* [jsDelivr - A free super-fast CDN for developers and webmasters](https://www.jsdelivr.com/)
* [Hosted Libraries  |  Hosted Libraries  |  Google Developers](https://developers.google.com/speed/libraries/)
* [Microsoft Ajax Content Delivery Network | The ASP.NET Site](http://www.asp.net/ajax/cdn)

と、一部のライブラリの配信に特化しているサービス

* [jQuery CDN](https://code.jquery.com/)
* [BootstrapCDN by MaxCDN](https://www.bootstrapcdn.com/)

を調べてみました。

なお、結果は環境やタイミングなどにより変化することがある旨、予めご了承ください。

## ライブラリごとのレスポンス

調査は curl コマンドのレスポンスを [research-of-javascript-and-css-cdn.php - Gist](https://gist.github.com/sharkpp/bc3de3bbaa5e99752ca1) のスクリプトで集計しその結果をもとにまとめています。

各表は、50 回の問い合わせを算術平均した結果でソートしてあります。
また、 `loss` は、要求でエラーが返ってきていないかの確認のため設けましたが滅多なことではエラーは返ってこないので常に `0.0 %` となっています。

対象のライブラリは独断と偏見により、

* [jQuery](https://jquery.com/)
* [jQuery UI](https://jqueryui.com/)
* [jQuery Mobile](https://jquerymobile.com/)
* [lodash](https://lodash.com/)
* [Snap.svg](http://snapsvg.io/)
* [3D.js](https://d3js.org/)
* [three.js](http://threejs.org/)
* [Bootstrap](http://getbootstrap.com/)
* [Font Awesome](https://fortawesome.github.io/Font-Awesome/)
* [AngularJS](https://angularjs.org/)

を選び調査しました。

それぞれのライブラリは調査時点で各 CDN サービスで選択できる安定版を対象としています。
なので、一部古いバージョンが混じっていますが間違ってはいません。

### jQuery

|CDN|Ver|min|ave.|max|loss|
|:-|-:|-:|-:|-:|-:|
|Microsoft Ajax CDN     |2.2.1|  63 ms|  77 ms| 577 ms|  0.0 %|
|Google Hosted Libraries|2.2.0| 216 ms| 224 ms| 242 ms|  0.0 %|
|jsDelivr               |2.2.1| 195 ms| 233 ms| 305 ms|  0.0 %|
|cdnjs                  |2.2.1| 319 ms| 366 ms| 476 ms|  0.0 %|
|jQuery CDN             |2.2.1| 878 ms| 939 ms|1008 ms|  0.0 %|

### lodash

|CDN|Ver|min|ave.|max|loss|
|:-|-:|-:|-:|-:|-:|
|jsDelivr               |4.6.1| 129 ms| 168 ms| 196 ms|  0.0 %|
|cdnjs                  |4.6.1| 338 ms| 442 ms|1006 ms|  0.0 %|

### Snap.svg

|CDN|Ver|min|ave.|max|loss|
|:-|-:|-:|-:|-:|-:|
|jsDelivr               |0.4.1| 200 ms| 246 ms| 373 ms|  0.0 %|
|cdnjs                  |0.4.1| 344 ms| 386 ms| 451 ms|  0.0 %|

### D3.js

|CDN|Ver|min|ave.|max|loss|
|:-|-:|-:|-:|-:|-:|
|jsDelivr               |3.5.16| 302 ms| 330 ms| 419 ms|  0.0 %|
|cdnjs                  |3.5.16| 344 ms| 458 ms| 794 ms|  0.0 %|

### three.js

|CDN|Ver|min|ave.|max|loss|
|:-|-:|-:|-:|-:|-:|
|Google Hosted Libraries|r69| 251 ms| 274 ms| 323 ms|  0.0 %|
|jsDelivr               |r74| 308 ms| 583 ms| 829 ms|  0.0 %|
|cdnjs                  |r74| 526 ms| 641 ms| 860 ms|  0.0 %|

### jQuery UI

JavaScript

|CDN|Ver|min|ave.|max|loss|
|:-|-:|-:|-:|-:|-:|
|Microsoft Ajax CDN     |1.11.4|  90 ms| 104 ms| 612 ms|  0.0 %|
|Google Hosted Libraries|1.11.4| 225 ms| 235 ms| 278 ms|  0.0 %|
|jsDelivr               |1.11.4| 320 ms| 411 ms| 606 ms|  0.0 %|
|cdnjs                  |1.11.4| 384 ms| 534 ms|1003 ms|  0.0 %|
|jQuery CDN             |1.11.4|1096 ms|1194 ms|1760 ms|  0.0 %|

CSS

|CDN|Ver|min|ave.|max|loss|
|:-|-:|-:|-:|-:|-:|
|Microsoft Ajax CDN     |1.11.4|  42 ms|  55 ms| 557 ms|  0.0 %|
|jsDelivr               |1.11.4| 155 ms| 185 ms| 215 ms|  0.0 %|
|Google Hosted Libraries|1.11.4| 179 ms| 206 ms| 720 ms|  0.0 %|
|cdnjs                  |1.11.4| 295 ms| 347 ms| 980 ms|  0.0 %|
|jQuery CDN             |1.11.4| 761 ms| 815 ms| 895 ms|  0.0 %|

### jQuery Mobile

JavaScript

|CDN|Ver|min|ave.|max|loss|
|:-|-:|-:|-:|-:|-:|
|Microsoft Ajax CDN     |1.4.5| 130 ms| 153 ms| 655 ms|  0.0 %|
|Google Hosted Libraries|1.4.5| 221 ms| 234 ms| 288 ms|  0.0 %|
|jsDelivr               |1.4.5| 232 ms| 323 ms|2678 ms|  0.0 %|
|cdnjs                  |1.4.5| 358 ms| 466 ms| 917 ms|  0.0 %|
|jQuery CDN             |1.4.5|1002 ms|1141 ms|1609 ms|  0.0 %|

CSS

|CDN|Ver|min|ave.|max|loss|
|:-|-:|-:|-:|-:|-:|
|Microsoft Ajax CDN     |1.4.5|  86 ms| 102 ms| 606 ms|  0.0 %|
|Google Hosted Libraries|1.4.5| 222 ms| 244 ms| 755 ms|  0.0 %|
|jsDelivr               |1.4.5| 232 ms| 272 ms|1549 ms|  0.0 %|
|cdnjs                  |1.4.5| 360 ms| 466 ms| 655 ms|  0.0 %|
|jQuery CDN             |1.4.5| 995 ms|1124 ms|1244 ms|  0.0 %|

### Bootstrap

CSS

|CDN|Ver|min|ave.|max|loss|
|:-|-:|-:|-:|-:|-:|
|Microsoft Ajax CDN     |3.3.6|  66 ms|  86 ms| 590 ms|  0.0 %|
|jsDelivr               |3.3.6| 187 ms| 223 ms| 761 ms|  0.0 %|
|cdnjs                  |3.3.6| 338 ms| 437 ms| 899 ms|  0.0 %|
|BootstrapCDN           |3.3.6| 844 ms| 909 ms|1040 ms|  0.0 %|

JavaScript

|CDN|Ver|min|ave.|max|loss|
|:-|-:|-:|-:|-:|-:|
|Microsoft Ajax CDN     |3.3.6|  42 ms|  55 ms| 571 ms|  0.0 %|
|jsDelivr               |3.3.6| 156 ms| 196 ms| 475 ms|  0.0 %|
|cdnjs                  |3.3.6| 307 ms| 347 ms| 853 ms|  0.0 %|
|BootstrapCDN           |3.3.6| 714 ms| 756 ms| 809 ms|  0.0 %|

### Font Awesome

|CDN|Ver|min|ave.|max|loss|
|:-|-:|-:|-:|-:|-:|
|Google Hosted Libraries|1.4.9| 232 ms| 243 ms| 318 ms|  0.0 %|
|jsDelivr               |1.5.0| 220 ms| 330 ms| 434 ms|  0.0 %|
|cdnjs                  |1.5.0| 359 ms| 422 ms| 544 ms|  0.0 %|

### AngularJS

|CDN|Ver|min|ave.|max|loss|
|:-|-:|-:|-:|-:|-:|
|Google Hosted Libraries|1.4.9| 219 ms| 242 ms| 743 ms|  0.0 %|
|jsDelivr               |1.5.0| 223 ms| 312 ms| 759 ms|  0.0 %|
|cdnjs                  |1.5.0| 359 ms| 465 ms| 669 ms|  0.0 %|

## まとめ

レスポンス速度としては大まかには

|#|CDN|
|:-:|-|
|1|Microsoft Ajax CDN|
|2|Google Hosted Libraries|
|3|jsDelivr|
|4|cdnjs|
|5|jQuery CDN|
|6|BootstrapCDN|

の順のような感じです。

配信しているライブラリの数としては

|CDN|配信数|
|-|-:|
|cdnjs|1835|
|jsDelivr|1750|
|Microsoft Ajax CDN|20|
|Google Hosted Libraries|14|
|jQuery CDN|6|
|BootstrapCDN|3|

と、 cdnjs や jsDelivr が圧倒的に多いですが、 Bootstrap 用のテーマの Bootswatch は BootstrapCDN しか配信していないのでその場合はそれ一択です。
Google Hosted Libraries の場合は、最新バージョンのライブラリが配信されていないこともあるのでレスポンスはいいですが超憂が必要となります。

## おまけ

### 使いたいライブラリが配信されていない！

また、どうしても CDN を利用したい、でもライブラリがマイナーすぎて CDN で配信されていない、という場合は GitHub でライブラリが公開されている場合に限り  [RawGit](http://rawgit.com/) を利用することもできます。

まあ、その他の場合は諦めて素直に自分のサーバーのファイルを参照しましょう。

### CDN で障害が起きたら？

参照している CDN で障害が起きた場合は、当然ながら、ページのレイアウトが崩れたりしてしまいます。
基本的にはほとんど問題ないとはいえ、万が一に備えておいて悪くわありません。

方策としては例えば、

```javascript
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="/assets/jquery/jquery.min.js"><\/script>')</script>
```

と、このような感じで、CDN を参照している script タグの直後に、判定式を書いて、読み込めていないようであれば、ローカルを参照することができます。

また、専用のライブラリ [Fallback JS](http://fallback.io/) を使ってみるのもいいかもしれません。
ああ、 当然のことながら Fallback JS を CDN から読んではいけませんよ。

## 参考

* [jsのよく使うホスティングサービス（cdn）まとめ - Qiita](http://qiita.com/narikei/items/cffb27b6d5788005d1b0)
* [ウェブ制作でよく使うjQuery関連のCDNまとめ](http://www.hirok-k.com/blog/2634.html)
* [GitHub上のファイルをCDNとして参照する - Qiita](http://qiita.com/takanorig/items/89db46120d2ec171e3d8)
* [jQuery 公式 Blog 「jquery-latest.js を使用するのをやめろ」 | WWW WATCH](https://hyper-text.org/archives/2014/07/dont_use_jquery_latest_js.shtml)
* [JavaScriptライブラリーのCDN利用、フォールバック対応しました](http://little-braver.com/232/)
* [floatingdays: JSの CDNの速度比較 （2013年版）](http://fdays.blogspot.jp/2013/04/js-cdn-2013.html)
* [10 Useful Fallback Methods For CSS And Javascript - Hongkiat](http://www.hongkiat.com/blog/css-javascript-fallback-methods/)
* [人気上昇中のJavaScriptライブラリを調べてみた【2015年版】 - Build Insider](http://www.buildinsider.net/web/popularjslib/2015)
* [2015年、人気の「JavaScriptライブラリ＆ツール」はどれ？ Angular vs. Reactの行方 - Build Insider](http://www.buildinsider.net/hub/survey/201504-popularjs)
* [curl でレスポンスタイムを計測 - Please Sleep](http://please-sleep.cou929.nu/curl-write-out-option.html)
