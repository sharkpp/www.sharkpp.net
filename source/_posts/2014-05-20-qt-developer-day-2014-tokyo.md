---
title: "Qt DEVELOPER DAY 2014 Tokyo に行ってきました"
date: 2014-05-20 22:19:00
tags: [Qt, 雑記, 勉強会]
categories: [ブログ]

---

[Qt DEVELOPER DAY 2014 Tokyo に行ってきました][1] に行ってきました。

 [1]: http://qt.digia.com/Jp/QtDD2014/

要所要所でのメモで不正確な内容かもしれませんが聴いたセッションの内容をまとめました。

人々のつぶやきは [Qt Developer Day Tokyo 2014 - Togetterまとめ][2] にまとめられています。

 [2]: http://togetter.com/li/669676

## 開場・受付(9:00 - 10:00)

<blockquote class="twitter-tweet" lang="ja"><p lang="ja" dir="ltr">受付待ち <a href="https://twitter.com/hashtag/QtDDTokyo?src=hash">#QtDDTokyo</a> <a href="https://twitter.com/hashtag/QtJP?src=hash">#QtJP</a> <a href="http://t.co/dSSjU4rrvc">http://t.co/dSSjU4rrvc</a></p>&mdash; さめたすたす-22号 (@sharkpp) <a href="https://twitter.com/sharkpp/status/468548131756724225">2014, 5月 20</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

<blockquote class="twitter-tweet" lang="ja"><p lang="ja" dir="ltr">発見！ <a href="https://twitter.com/hashtag/QtDDTokyo?src=hash">#QtDDTokyo</a> <a href="https://twitter.com/hashtag/QtJP?src=hash">#QtJP</a> <a href="http://t.co/gpSJnoiybl">http://t.co/gpSJnoiybl</a></p>&mdash; さめたすたす-22号 (@sharkpp) <a href="https://twitter.com/sharkpp/status/468550069608656896">2014, 5月 20</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

Tシャツを貰いました。

## ジェネラルトラック(10:00 - 12:30)

### 御挨拶(10:00 - 10:15)

JP Niemi (Qt セールス＆マーケティング, 副社長, Digia, Qt)

  * 若干始まりは遅れたけど挨拶は時刻通り終わる

### 技術の壁を打ち破る(10:15 - 10:30)

現代のアプリケーション開発の最前線にある Qt

Tommi Laitinen (インターナショナルプロダクツ上級副社長, Digia, Qt)

  * 少ないコードでより多くの製品を
  * よりよいユーザーエクスペリエンスを、一番手でありたい
  * クロスプラットフォームの対応で一番になりたい！
  * Qtは開発者が開発者のために開発したものなので開発者の声に耳を傾けないといけない
  * Qt Enterprise Enbeded もあるよ！
  * 昨年末にQt 5.2をリリース、一時間までまでは最新バージョンでしたが、Qt 5.3 を本日リリースされました
  * Qt Quick Compiler はリバースエンジニアリングを防ぐ手段も提供 ※このバージョンでは製品版のみ
  * だんだん世の中のアプリケーションはクラウドサービスに移行すると考えるのでクラウドを提供することにした([Qt Cloud Services][3])
  * WindowsRT にも対応(ベータサポートで 5.4 で正式対応予定)
  * 昨年から iOS などもサポート
  * 最新の OS やウェブシステムも対応
  * 95% のユーザーが満足しているが、満足度をもっと上げていきたい

 [3]: http://qtcloudservices.com/

### Qt のあゆみ(10:30 - 11:15)

我々の今とテクノロジーの向かう先

Lars Knoll (Qt CTO および Qt Project チーフメンテナ, Digia, Qt)

  * Qt 5.2 と本日リリースの5.3及びその未来について
  * TrolltechがQtを開発しだしてから20年経った
  * 二人の開発者が立ち上げたプロジェクト
  * 一枚のファックスに書かれた仕様書からQtは始まった [写真][4]
  * Qt 5.2 は Qt everywhere を実現、デスクトップだけでなくモバイルにもフォーカス、将来に向けたAPIの拡張など改良を行った
  * Qt 5.3 は安定性、ユーザーエクスペリエンスを高める
  * AndroidとiOSてばQtWebKitはサポートされてない
  * WinRTのベータサポートが追加された、WebKitはサポートしてない
  * ウィジェットベースのアプリに Qt Quick の機能を統合する [QtQuickWidget][5] が追加された
  * 新しいQtQuickエンジンやシーンレンダラー
  * Qt Quick Compiler は QMLをネイティブなコードにコンパイルしてパフォーマンスを改善し、また、そしてQMLのコードを保護する
  * 新しいモジュール、Positioning や bluetooth 、 NFC を追加
  * Webkit を更新、ただし、最後のリリースになり、次は Chromium で Fork された WebKit をベースにした物(Qt WebEngine)に変わる
  * Qt clud service は data storage と managed websocket を提供し、managed runtime を提供予定
  * リリースのタイミングは Time based release に変更され、5.4 は 10月〜11月頃、5.5 は来年の4月〜5月を予定
  * Qt 5.4 は WinRT の正式サポートや bluetooth の拡張などが目玉
  * Qt 5.5 のリリースの目玉はまだ決まっていない
  * Qt 5.3 はデスクトップの強化もしてるので Qt 4 から Qt 5 へ移行しやすくなってるので、ぜひ移行して欲しい

 [4]: https://twitter.com/task_jp/status/468566003832471553
 [5]: http://qt-project.org/doc/qt-5/qquickwidget.html

### 休息(11:15 - 11:30)

席に荷物を置いて休息する人もちらほら、、、

### 日本市場におけるQtの拡がり(11:30 - 12:00)

山口 大介 (シニアマネージャー、株式会社SRA)

  * SRA はライセンス販売以外にQtouch や Qinput なども作ってる
  * SRA が関係した書籍以外に Qt Quickの本 も紹介
  * Qt は世界で100万ダウンロード！
  * ナビメーカーの半数でQtを採用！

### QtはあなたのInternet of Thingsにつながるデバイスの戦略を後押しします(12:00 - 12:30)

Tuukka Ahoniemi (テクニカルプロダクトマーケティングマネージャー, Digia, Qt)

  * Qt Cloud Services でセンサーをネットワーク経由で使うことが出来る
  * デザインの変更にも Qt Quick を使っていたから即対応が出来た

## ランチタイム・展示(12:30 - 13:30)

<blockquote class="twitter-tweet" lang="ja"><p>
お弁当もぐもぐ♪ <a href="https://twitter.com/search?q=%23QtJP&src=hash">#QtJP</a> <a href="https://twitter.com/search?q=%23QtDDTokyo&src=hash">#QtDDTokyo</a> <a href="https://twitter.com/search?q=%23mogmog&src=hash">#mogmog</a> <a href="http://t.co/mB2Csd8WmF">http://t.co/mB2Csd8WmF</a>
</p>&mdash; 98式AVさめたすたす (@sharkpp) 
<a href="https://twitter.com/sharkpp/statuses/468595870535933952">2014, 5月 20</a>
</blockquote>

## LT(12:45 - 13:30)

弁当を食べながらLTを聴く

### Qtのよい(と思う)ところ

[@IoriAYANE][6]

 [6]: https://twitter.com/IoriAYANE

  * 簡単
  * 少ないコードで高機能
  * QtWidget と Qt Quick
  * マルチプラットフォーム

### タイトル不明

柴田充也

  * スマートフォンはスマートですか？
  * そのスマホ Qt 動いてますか？
  * Ubuntu touch の紹介
  * Qt Creatorでアプリが作れる
  * Ubuntu touch は全て Qt 製
  * Nexus 4 /Nexus 7 2013 / Nexus 10 をサポート
  * ARMhf / i386 エミュレータが有る

### Qt creatorでremote_debug

[Qt creatorでremote_debug][7] by [@sazus][8]

 [7]: http://www.slideshare.net/sazuzas/qt-creatorremotedebug
 [8]: https://twitter.com/sazus

  * Qt on せんべい あるよ！
  * Embeded Linux (non X Window System)
  * 組み込み環境のデバッグでQtCreator使ってますか？
  * Qt Creator で デプロイやリモートでバッグが出来る！

### Qtおやつ部活動報告

[@hermit4][9]

 [9]: https://twitter.com/hermit4

  * おやつを持ち込む人は部員
  * Qtのケーキやガム、チロルチョコも作った
  * 普段はみかんや饅頭など
  * Androidは女子部があるのに、、、おやつ目当てのひと募集
  * 勉強会はどなたでも参加可能！
  * アドレスは <http://qt-users.jp/>

### Qt Developer Day 2014 〜 前回からの２年半 〜

[@moguriso][10]

 [10]: https://twitter.com/moguriso

  * intel　MeeGo　捨てた！
  * NOKIA Meego/Qt 捨てた！
  * 日本Qtユーザー会発足
  * 関東、名古屋、大阪で勉強会が開催

## テクニカルトラック(13:30 - 18:15)

### Qt と Qt Creator(13:30 - 15:00)

[杉田 研治][11] (プログラマ, 株式会社 SRA)

 [11]: https://twitter.com/bluepicky

  * 商用版はグラフ、データビジュアライゼーション、[Qt Purchasing API][12](Android/iOS用ストア向け)など
  * デバッガは QString や QList などの中身を表示できる！
  * Qt用の拡張は、Qt CreatorのバージョンやWindowsの場合はデバッグやリリースなどにも気お付けないとうまく動かない
  * Qt Creator だとオーバーライドされた関数はイタリックで表示されるのでプロトタイプが間違っている場合にはすぐ分かる！
  * OS X での emacs のキーバインドは 3.2 で取り込まれる予定
  * Qt Creator 3.1 の新機能としては Clang コードモデルなど

 [12]: http://doc.qt.digia.com/QtPurchasing/

### QtQuick の紹介(15:00 - 16:00)

[朝木卓見][13] (シニアコンサルタント, 株式会社 SRA)

 [13]: https://twitter.com/takumiasaki

  * Qt Quick が出来た背景
  * もっと動きのある、タッチやジェチャー、アニメーションやエフェクトがあるUIを簡単に作りたい
  * C++の機能が増えても楽にはならないしサンプルどまりだった
  * ユーザー入力系にはキーボードやマウス入力などがある
  * レイアウトはカラムやグリッドなど
  * ステートは状態の定義やトランジションなど
  * アニメーションには NumberAnimation など複数種類がある
  * Easing (補完関数？) には線形やバウンスなどがある
  * モデルビューはリストモデル、グリッドビュー、パスビュー(任意の曲線上に並べる)など
  * パーティクルも表示できるがいろいろな種類のパーティクルのデモはブースで(もしくは[サンプルアプリ(https://play.google.com/store/apps/details?id=com.digia.Qt5Intro&hl=ja))
  * シェーダーは OpenGL が使える、使用頻度の高そうなものは予め定義してあるので QtGraphicalEffect を import をすれば使える
  * ファイル単位で独自の QML を部品として再利用できる
  * Loaderを使った動的なオブジェクトの生成もできる
  * HTML5 の canvas 風エレメントも QtQuick2 からある
  * Bluetooth や NFC を Qt Quick から使えるモジュールもある 
  * QtWidget 風の Qt Quick Controls が別で用意してある
  * 現状 Qt Quick Designer は雛形の作成用として使うぐらいが良さそう
  * QQuickRenderControl はレンダリング制御用のクラスで現状はプライベートクラスだけど後々に公開APIになる予定

### 休憩(16:00 - 16:15)

### Qt Enterprise Embedded による組み込み開発の紹介(16:15 -17:15)

Tuukka Ahoniemi & Andy Nichols (ソフトウェアエンジニア, Digia, Qt)

  * デプロイに半日かかったりビルド設定が大変だったりを Qt enterprise enbeded を使って変えていきたい
  * その価値はプロジェクトの開発期間の短縮
  * Qt creaitor が中心となりデプロイやデバックをすることが可能
  * キュートのシステムはエッシェンシャルとアドオンにわけられる
  * Qt quick はモバイルにも組み込みも使われている
  * Qt Creator からのデプロイは USBでもIPでもできる
  * キーワード：Boot to Qt
  * Boot to Qt では標準でNexus 7やエミュレータなどが使用可能でカスタマイズすることで他にも対応することができる
  * グラフや仮想キーボードなどが含まれている

### Qt QuickとQt Quick Controlsの深淵へ(17:15 - 18:15)

Dr. Gabriel de Dietrich (シニアソフトウェアディベロッパー, Digia, Qt)

  * QtQuick の `Qt.platform.os` で os が分かる
  * `import QtQuick.Controls` で Qt Quick Control を使える
  * QtQuick.Dialogs はファイル選択などができるモジュール
  * Menu/MenuItem でメニューを表示できる
  * C++のようにActionってエレメントありツールバーやメニューからと処理を共通化できる
  * DockWidget は入る可能性はあるが時間はかかる
  * 一億行をテーブルビューに入れた場合もデータの再利用をしたりで出来るだけパフォーマンスが出るようになっている
  * QtQuickWidget を使って表示するのではなく今はまだ QtQuick をUiで使うほうがいいと思う

## 懇親会

日本Qtユーザー会の皆様で乾杯＆もぐもぐ

## まとめ

はじめてな感じの日本でやる海外企業の展示会に潜入した結果ですが、同時通訳を聴けたり質問(自分はしていないですが)も通訳してもらったりと聞き取れなくて (´・ω・｀) な状態にはならなかったので良かったです。

ただ、人によるのでしょうがスライドの文字が小さかったので後ろの席だと、場合によっては前の方でも内容が見えないことが有ったので座るなら前の方がいい感じでした。 いろいろな話が聞けて、自分的には満足な一日でした。

あとは、開催日が平日でなければとかはなきにしもあらず、、、でしたが、休みを取ってまでして行ってよかった感じです。
