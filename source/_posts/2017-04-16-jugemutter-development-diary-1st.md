---
title: "じゅげむったー(仮)の開発日記 その１"
date: 2017-04-16 23:07
tags: [Qt, Twitter, OAuth, C++, cpp, 勉強会, 開発日記, じゅげむったー]
categories: [ブログ]

---

さて、先月に続いて今月も参加した [Qt 勉強会 @ Nagoya No7(17.04) - connpass](https://qt-users.connpass.com/event/53963/) のまとめ。

つぶやきは [Qt勉強会 Tokyo #46 + Nagoya # 7 つぶやきまとめ - Togetterまとめ](https://togetter.com/li/1101299) でまとめられています。

今月は先月から作り始めた、長文投稿専用Twitterクライアントの開発をしました。

レポジトリは ... [sharkpp/Jugemutter: 長文投稿専用クライアント「じゅげむったー」](https://github.com/sharkpp/Jugemutter) です。

## はじめに

会場に到着する前のこと。

マクドナルドで昼食を食べ、いざ会場へ行かん、としたところで、外を見ると土砂降り，とまでは行かないけれど雨がザーザー<ruby><rb>OMG</rb><rp>(</rp><rt>おーまいがー</rt><rp>)</rp></ruby>。

慌ててコンビニで傘を買って行きましたとさ。
いや、まさか雨が降るとは思わず、折り畳み傘をカバンに入れてなかったのです。

会場に着くと、主催の [@nekomatu](https://twitter.com/nekomatu) さん以外おらず。
もともと [@IoriAYANE](https://twitter.com/IoriAYANE) さんも調子を崩して参加できず、だったので特に人数が少なかった。

しばらくして、最後の一人も到着で、もくもく開始。

<blockquote class="twitter-tweet" data-lang="ja"><p lang="ja" dir="ltr">本日のおやつ <a href="https://twitter.com/hashtag/qtjp?src=hash">#qtjp</a> <a href="https://t.co/HhGVbaUAWk">pic.twitter.com/HhGVbaUAWk</a></p>&mdash; 夜は短し歩けよさめたすたす (@sharkpp) <a href="https://twitter.com/sharkpp/status/853103000910413824">2017年4月15日</a></blockquote>

## やったこと

ドキュメントを見つつ、画面周りを作成。

QtCreator みたいに左側にツールバーを設置してみようと思うが、どうやらデザイナ上ではウィジェットとしてツールバーは設置できないようだ。
「[How to change toolbar layout in Qt Creator? - Stack Overflow](http://stackoverflow.com/questions/26691010/how-to-change-toolbar-layout-in-qt-creator)」 を見ると、 `.ui` を直接触れって書いてあって、確かにできるんだけど... いいのかな？

`QPlainTextEdit` の画面内の余白、
<img src="images/2017_0415_qplaintextedit_margin.png" />
を計算するうまい方法はないものかと、探すも見つからず。
[QWidget::contentsMargins()](http://doc.qt.io/qt-5/qwidget.html#contentsMargins)はどうも違うらしい。

`QLabel` の文字色は ... そうだ、そうだ。
`foregroundRole()` を使うんだ、とか。

調べながら、コードを書いているとなかなか進まないなぁ。

## 成果

とりあえず、なんとなくの画面はできてきた感じ。

<img src="/images/2017_0415_jugemutter.png" />

もうちょっとで文章を分割してつぶやけるところまて行ったけど、残念ながら時間切れ。

* 分割して投稿
* 文章をWYSIWYGで編集＆プレビューしたい
* 投稿のレジューム機能
* マルチアカウント管理

とか、まだまだ先は長そうだ。

<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

## 知ったこと

* Qt
    * [`Q_PROPERTY`](http://doc.qt.io/qt-5/properties.html) は 	`setProperty()` / `property()` でアクセスできるようにするマクロ。
      何回か、同じ勘違いをやっているけど、 setter/getter を自動で作る機能ではない。
	* パスに日本語が含まれていると qmake が失敗するらしい、このご時世に。
* QtCreator
	*  のソースエディタで、変数の後に `.` を入力すると `->` に変換される。便利！
	* デザイナ上でツールバーを削除してしまった場合は、オブジェクトインスペクタ？上の `QMainWIndow` を右クリックして「ツールバーを追加」で追加できる。
	* `QDesignerCustomWidgetCollectionInterface` とか長ったらしい名前は `QDCW` と入力すれば補完される！
	  参考：[Qt Creator を便利に使いこなそう - Qiita # キャメルケース対応の補完を最大限に活用しよう](http://qiita.com/task_jp/items/098319a33bd946955c0a#%E3%82%AD%E3%83%A3%E3%83%A1%E3%83%AB%E3%82%B1%E3%83%BC%E3%82%B9%E5%AF%BE%E5%BF%9C%E3%81%AE%E8%A3%9C%E5%AE%8C%E3%82%92%E6%9C%80%E5%A4%A7%E9%99%90%E3%81%AB%E6%B4%BB%E7%94%A8%E3%81%97%E3%82%88%E3%81%86)
    * `QString m_xxx;` などとメンバ変数を定義して、「リファクタリング」を実行すれば  `setXxx()` と `xxx()` つまり setter/getter の宣言と実装の枠組みが自動で追加される。
      参考：* [c++ - Auto-generate setters/getters with QTCreator? - Stack Overflow](http://stackoverflow.com/questions/19729288/auto-generate-setters-getters-with-qtcreator)

## 参考

* [How to change toolbar layout in Qt Creator? - Stack Overflow](http://stackoverflow.com/questions/26691010/how-to-change-toolbar-layout-in-qt-creator)
* [qt - QTextEdit sets fix line Height, paragraph spacing - Stack Overflow](http://stackoverflow.com/questions/18909507/qtextedit-sets-fix-line-height-paragraph-spacing)
* [c++ - qplaintextedit line spacing - Stack Overflow](http://stackoverflow.com/questions/10317845/qplaintextedit-line-spacing)
* [Qt Creator を便利に使いこなそう - Qiita](http://qiita.com/task_jp/items/098319a33bd946955c0a#%E3%82%AD%E3%83%A3%E3%83%A1%E3%83%AB%E3%82%B1%E3%83%BC%E3%82%B9%E5%AF%BE%E5%BF%9C%E3%81%AE%E8%A3%9C%E5%AE%8C%E3%82%92%E6%9C%80%E5%A4%A7%E9%99%90%E3%81%AB%E6%B4%BB%E7%94%A8%E3%81%97%E3%82%88%E3%81%86)
* [qt - QLabel: set color of text and background - Stack Overflow](http://stackoverflow.com/questions/2749798/qlabel-set-color-of-text-and-background)
* [The Property System | Qt Core 5.8](http://doc.qt.io/qt-5/properties.html)
* [c++ - Auto-generate setters/getters with QTCreator? - Stack Overflow](http://stackoverflow.com/questions/19729288/auto-generate-setters-getters-with-qtcreator)

