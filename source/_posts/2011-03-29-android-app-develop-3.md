---
title: "Androidアプリの開発(その3)"
date: 2011-03-29 01:21:00
tags: [Develop, Android]
categories: [blog]

---

色々メモ

なんだかんだ牛歩の歩みが如しですが何だか楽しいです。

とりあえず遊べるけどゲームバランスが悪すぎるので悩み中...

調べたページなどを記録



  


##### 設定の永続化

SharedPreferencesにバイナリを入れようとしちゃだめorz

プロセスKILLすると設定が読めなくなる謎の症状に悩まされるよ！

  * [Android（開発）/ちょっとした設定の永続化 - 俺の基地][1]
  * [データ保存 - ソフトウェア技術ドキュメントを勝手に翻訳][2]

 [1]: http://yakinikunotare.boo.jp/orebase/index.php?Android%A1%CA%B3%AB%C8%AF%A1%CB%2F%A4%C1%A4%E7%A4%C3%A4%C8%A4%B7%A4%BF%C0%DF%C4%EA%A4%CE%B1%CA%C2%B3%B2%BD
 [2]: https://sites.google.com/a/techdoctranslator.com/jp/android/guide/data-storage



  


##### 画面回転

状態の保存・復帰はonSaveInstanceState/onRestoreInstanceStateを処理

  * [Y.A.M の 雑記帳: Android　Bundle で状態を保存][3]
  * [Y.A.M の 雑記帳: Android　Parcelable を使ってクラスのメンバを一時保存][4]
  * [Android android.os.Parcelable / Parcel - adakoda][5]
  * [Parcelable | Android Developers][6]

 [3]: http://y-anz-m.blogspot.com/2010/03/androidbundle.html
 [4]: http://y-anz-m.blogspot.com/2010/03/androidparcelable.html
 [5]: http://www.adakoda.com/adakoda/2009/01/android-androidosparcelable-parcel.html
 [6]: http://developer.android.com/intl/ja/reference/android/os/Parcelable.html



  


##### 低速なストレージからの入力はonRetainNoneConfigurationInstance()でキャッシュすると切り替えが早いよ！

  * [Androidで画面の向きを高速に変更 | textdrop][7]

 [7]: http://www.textdrop.net/soft/android-faster-screen-orientation-change/



  


##### SurfaceViewでは切り替えアニメーションできない？

  * [めざせアンドロイドマーケット: surfaceView でのフェード処理][8]

 [8]: http://hajimori.blogspot.com/2011/02/surfaceview.html



  


##### Activityを1つにして高速に画面遷移

  * [Y.A.M の 雑記帳: Android　複数画面 1 Activity で画面遷移][9]

 [9]: http://y-anz-m.blogspot.com/2011/02/1-activity.html

でもView指定しなおすと一瞬ブラックアウトになるのでActivityとViewが1つずつでその中で描画処理だけ分割みたいな感じでなんだかとんでもないことにナッテマス

よい方法があれば誰か教えてほしいorz



  


##### String.splitでは-1をつけないといけない場合が

  * [JavaのString.split(”,”)は、split(”,”, -1)にしたほうがいい - $ cd ./.][10]

 [10]: http://d.hatena.ne.jp/hackaddict/20070119



  


##### クラス⇒文字列/文字列⇒クラス

画面回転時に状態の保存/復帰用に実装してみたが試してみたら実はまったく必要なかったというorz

  * [Javaリフレクションメモ(Hishidama’s Java Reflection Memo) - 引数ありコンストラクターを使ったインスタンス生成][11]
  * [Class.forName/newInstance - 文字列からインスタンスを生成 - Java入門][12]

 [11]: http://www.ne.jp/asahi/hishidama/home/tech/java/reflection.html#h3_newInstanceA
 [12]: http://www.syboos.jp/java/doc/create-object-instance-from-string.html



  


##### 読むべきところ

  * [Code Style Guidelines for Contributors | Android Open Source][13]
  * [開発の基礎 | Android Developers][14]
  * [Avoiding memory leaks （超訳）][15]

 [13]: http://source.android.com/source/code-style.html
 [14]: http://developer.android.com/intl/ja/guide/topics/fundamentals.html
 [15]: http://d.hatena.ne.jp/androidzaurus/20090121/