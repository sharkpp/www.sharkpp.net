---
title: "Boost.勉強会 #11 東京 に参加しました"
date: 2013-06-01 22:47:00
tags: [C++, Boost, 勉強会]
categories: [ブログ]

---

久しぶりのboost勉強会でした。 早速ですが、レポートというかメモというかをドーゾです。

  * [Boost.勉強会 #11 東京 - PARTAKE][1]
  * [Boost.勉強会 #11 東京 #boostjpの座席表 - セキココ][2]

 [1]: http://partake.in/events/e75cde86-75c8-47ce-b647-2dbd0495b053#
 [2]: http://sekico.co/zaseki/141

## C++ポケットリファレンスについて

著者前へ→一人足りないwww

C++11の日本語初のリファレンス。

著者ズ→ [@nyaocat][3] [@andochin][4] [@hotwatermorning][5] [@wraith13][6] [@egtra][7] [@cpp_akira][8]

 [3]: https://twitter.com/nyaocat
 [4]: https://twitter.com/andochin
 [5]: https://twitter.com/hotwatermorning
 [6]: https://twitter.com/wraith13
 [7]: https://twitter.com/egtra
 [8]: https://twitter.com/cpp_akira

コミュニティから本を出していきたい！

  * 日本語の問題が苦労した
  * Redmineで校正を管理

## Boostライブラリ一周の旅 1.51.0?1.53.0

  * 発表者：[@cpp_akira][8]
  * スライド：[Boost Tour 1.53.0 merge][9]

 [9]: http://www.slideshare.net/faithandbrave/boost-tour-1530-merge

### Atomic

InterlockedIncrimentなどの置き換え、mutexの代わりなど。

### Lookfree

キュー、スタック、順位付きキューなどの実装がある。 push() や pop() がシュッパイする可能性があるので注意が必要！

### Coroutine

処理中に中断＆復帰ができる。

次のバージョン(1.54)でStackOverflowをあまり気にしなくてすむ機能が入る。

### Multiprecision

多倍長整数計算ライブラリ。

### Odeint

常微分方程式を解くライブラリ。 ゲームでも使えるらしい。

## C++でデータをDBに保存して扱ってみよう

  * 発表者：[@sakisaka7][10]
  * スライド：[C++でDBにデータを保存して扱ってみよう :: Boost.勉強会 #11][11]

 [10]: https://twitter.com/sakisaka7
 [11]: http://beta.saki7.jp/slides/boost-study-11-cpp-database/

リレーショナルデータベース使ってる人→６〜７割

C++で使えるO/Rマッパーのはなし。

JSONで大量のデータの管理はいくない！

Wt(ウィッティー) [Wt::Dbo Tutorial][12]

 [12]: http://www.webtoolkit.eu/wt/doc/tutorial/dbo/tutorial.html

JSONと比べデータベースを使うと、データの整合性や検索、同期、そしてデータ構造の管理などもできる！

bind処理も実装してある。

ほかにもC++のO/Rマッパーには次のような物がある。

  * [O/Rマッピング | TreeFrog Framework][13]
  * [ODB - C++ Object-Relational Mapping (ORM)][14]
  * [boost.RDB][15]

 [13]: http://www.treefrogframework.org/ja/%E3%83%89%E3%82%AD%E3%83%A5%E3%83%A1%E3%83%B3%E3%83%88/%E3%83%A2%E3%83%87%E3%83%AB/or%E3%83%9E%E3%83%83%E3%83%94%E3%83%B3%E3%82%B0
 [14]: http://www.codesynthesis.com/products/odb/
 [15]: https://code.google.com/p/boost-rdb/

会場からつ boost.python boost.Fusion などを絡め統一的なのができるのでは？

### おまけ

何故、あえてC++なのか

  * データは表示するための物
  * 見やすいインターフェースが必要
  * HTMLとかのインターフェースに特化した物を使う
  * C++はデータを表示するインターフェースには向いていないのではないか？
  * C++の立ち位置を再確認するべき！
  * C++とWeb系言語を連携しよう！

## 昼休み＆C++ポケットリファレンス購入祭り

C++ポケットリファレンスをまだ購入していない人を有志で募って近くの本屋さんで購入しようって流れになったので、乗りました。

集まったのは9人

一番近くの三省堂書店に突撃しましたが、4冊しか置いてませんでした(後でTwitterでtweetされていましたがいつの間にかまた補充されていたようです)

周辺を探しましたが新刊でしかも技術書は扱っているところが少ないようで見つかりませんでした。

結局、未購入の人は秋葉原まで行って購入してきたようです(自分は三省堂書店で購入しました)。

あと、午後の発表の合間に著者ズにサインをしていただきました。

## The Instrumental C++

  * 発表者：[@hotwatermorning][5]
  * スライド：[The Instrumental C++.pdf][16]

 [16]: https://www.dropbox.com/s/8t7nfmxh7yprjzv/The%20Instrumental%20C%2B%2B.pdf

DTMer(D™を使っている人)向けの発表

※ただし、対象者は数人の模様

VSTプラグインを実装してみた話

サンプルでノイズを作るのに boost.Random を使っています。

### MIDI

  * ノートオン‥‥音を出す信号、ピアノの鍵盤を押したり笛を吹いたりする動作
  * ノートオフ‥‥音を止める信号、ピアノの鍵盤を離したりする動作

### まとめ

  * [「サウンドプログラミング入門」青木直史][17] オススメ
  * VSTプラグインをがんばって実装してもホスト側が機能を実装していないこともあるので注意！

 [17]: http://gihyo.jp/book/2013/978-4-7741-5522-7

## C++でぼくが忘れがちなこと

  * 発表者：[@andochin][4]

C++覚えてますか？

  * 型周り、char と signed char と unsigned char や int[n]_t 
  * typedefとcv修飾
  * virtualはいらない、overrideでいい
  * const参照での浮動小数点型と整数型、 const int &i = d; // dのテンポラリが保持される
  * アクセス修飾子、、、、
  * operator& をオーバーロードしていても addressof()でポインタ値がとれる
  * operator void の挙動、operator void をオーバーロードしていると static_cast<void>(s); とするとGCC4.7では呼ばれる
  * uniformd initializerによる初期化、 {} でクラスも初期化ができる。
  * クラスメンバの初期化の順番は宣言した順番に初期化される。

C言語との違い

  * main() Cではreturnが必要だけどC++では必要ない、C++では再起などが禁止
  * 式中の型宣言
  * 条件式の結果、代入式、カンマ演算子の結果がCだと右辺値だけどC++は左辺値
  * 戻り値の有無、Cではエラーにならないが不定な値が返る、C++ではエラー
  * typedefと構造体(クラス)、C++では同じスコープで別のtypedefを作れない
  * 定数の扱い、C++では未初期化の定数を作れない const int NG;

## CilkPlus, TBB, OpenMP

  * 発表者：[@krustf][18]

 [18]: https://twitter.com/krustf

並列プログラミングの話

支える技術

  * Intel CilkPlus
  * Intel TBB
  * OpenMP
  * Future/Promise

### Intel CilkPlus

並列プログラミング用のコンパイル拡張、GCCやLLVMでも使用可能。

  * cilk\_spawn と cilk\_sync
  * Array Notation 自動でSIMD化される
  * ＃pragma simd
  * Elemental Functions

### Intel TBB

C++STL風のアルゴリズム

parallel\_for と parallel\_reduce があればだいたい事足りる。

#### parallel_for

  * 並列でforを実行
  * 範囲の分割幅を指定
  * C++11のラムダ式が使える

#### parallel_reduce

  * 並列リダクションを実行
  * C++11のラムダ式が使える

### OpenMP

＃pragma で指示

### Future/Promise

詳しくは、去年の筑波で発表された資料を参照

### マークする理由

コンパイラは並列化可能かどうかの判断が難しい。

なので、プログラマが指示してあげる。

### ベンチマーク

時間がなかったので適当

性能差には大きく変化はない。

  * [姫野ベンチマーク][19]

 [19]: http://accc.riken.jp/2145.htm

### まとめ

  * CilkPlus や Intel TBB を使おう
  * C++11 が使える場合は Promise もいいかも
  * [構造化並列プログラミング][20] がおすすめ

 [20]: http://www.amazon.co.jp/dp/4877833056

## Hello, C++ + JavaScript World!

  * 発表者：[@hecomi][21]

 [21]: https://twitter.com/hecomi

### 世界観

  * ChromeのJSエンジンはV8
  * V8はC++で実装
  * SimCityやNode.jsやQtでも
  * NaitiveClient
  * [Emscripten][22] (C++をJSに変換)
  * Android

 [22]: https://github.com/kripken/emscripten

### Node.js

サーバーサイド JavaScript プラットフォーム

ブラウザでできないようなことができる

  * ローカルのファイルを読み込んだり
  * サーバーを立てたり
  * npm モジュールで拡張可能

### Qt

QtQuickでV8を使用

### NaitiveClient

  * NaCl(塩)
  * ブラウザ上で安全にネイティブのコードを実行
  * Pepper(湖沼) API ローカルファイル、キーボード、ゲームパッドへのアクセスなど
  * Twitterより： Portable NaCl LLVM中間言語を使いマルチプラットフォーム対応に

### Emscripten

  * LLVM-IRをJavaScriptに変換
  * C++ →(Clang)→ LLVM-IR →(Emscripten)→ JavaScript
  * UnrealEnginがヌルサクで → [Epic Citadel][23]
  * Qtもブラウザで動く！
  * HellowWorldは12万行に!?
  * asm.js形式で吐き出すので OdinMonkey で動かすとロードは遅いけどヌルサク

 [23]: http://www.unrealengine.com/html5/

## 未来のC++に向けて書いた論文という名のネタ帳

  * 発表者：[@Sigureya][24]

  * マクロ的な何か(boost.spirit.qi)

  * まとめ、LISPは神の言語、C++は邪心の言語
  * LISPの布教
  * 30分のところ、5分で終了

 [24]: https://twitter.com/Sigureya

## コンテナのパフォーマンスについて

  * 発表者：[@hgodai][25]

  * 29歳教

  * Ivar jacobson と一緒に仕事をしたことが
  * 思考を硬直させない
  * 常識、慣例、しきたり、都市伝説に惑わされない、 **自分の目で確かめる**

 [25]: https://twitter.com/hgodai

### std::vectorでいいの？

  * プロフェッショナルは「とりあえず」は似合わない
  * 「とりあえず」していいのは「ビール」

### ベンチマーク

  * std::deque + Win/VS2012 はなぜかすごい遅い
  * oreoreアロケータ使った場合、std::deque や boost::stable_vector が遅い
  * emplace\_back() つかえるなら push\_back() を使うよりパフォーマンス的に良いことが多い
  * insert()は std::list は爆速、大きなデータの場合は boost::stable_vector も候補に加えてもよい
  * 検索は unorderd_map が早い、ソート済みvectorはそこそこ早い

[ソフトウエア研究会in秋葉原][26]

 [26]: http://ssa.techarts.co.jp/

## C++14の概要

  * 発表者：[@cpp_akira][8]

  * C++11のバグ修正＆マイナーアップデート、改め、色々機能追加あり

  * C++17を目指すC++1yも

### コア機能

  * 2進数リテラル、 0b1100 で 12
  * 実行時サイズの配列、 定数だけでなくローカル変数や引数でも配列を初期化できるようになった、確保できなかったり0が指定された場合は例外が発生する
  * 通常の関数の戻り値型推論、ラムダ式と同様に通常の関数でも戻り値を推論できるようにする
  * ジェネリックラムダ、ラムダ式の引数にautoが使えるようになる
  * 一般化されたらラムダキャプチャ
  * constexpr関数の制限緩和
  * 変数テンプレート、変数定義にテンプレートを使用できるようになる
  * 軽量コンセプト、C++11で入らなかったコンセプトの軽量版

### ライブラリ

  * make\_unique()、std::unique\_ptr のヘルパ関数
  * exchange()、非並列プログラミング用compere_exchange()
  * コンパイル時整数シーケンス、主にstd::tuple用
  * tupleの型指定get()、インデックスではなく指定した型を取得できるようになる、最終的に変わるかも？
  * quotedマニュピレータ、Boost.Iostreams由来
  * ユーザー定義リテラルライブラリ
  * Type Traitsのエリアステンプレート版、C++11のType Traitsライブラリに対するエイリアステンプレートのラッパー
  * optional型、boost::optional由来、一部boostから変更(none→nullopt)
  * 実行時サイズの配列、dynarray<T>、std::vector風なインターフェースを持ちスタックでメモリを確保するコンテナ
  * 共有ミューテックス、multiple-reader / single-writer なミューテックス、shared_lock<T> / .lock_shared() が追加
  * ファイルシステム、ファイル属性やパス、ディレクトリのサポート、boost.FileSystem V3由来
  * ネットワークライブラリの基本的な機能、間に合わないのでバイトオーダーの交換機能のみ

入らないもの

  * モジュールシステム
  * Rangeライブラリ
  * コルーティン

などなど

### ここから始めよう

  * [Standard C++ Foundation][27]
  * ↑のRSS
  * std-proposalsのML

 [27]: http://isocpp.org/

### まとめ

  * C++14には便利な機能が入るっぽい、ただし状況が変わるかも？
  * C++14の次はC++1y
  * C++の仕様策定はクローズドからオープンに

## 全体的なまとめ

久しぶりのboost.勉強会でしたが、相変わらずboost成分が少ないなーと。

あと、C++ポケットリファレンスを買って著者にサインをもらう流れが面白かったなと、、、ただ、自分もですが休憩時間を越えてサインに行列ができたのはちょっとまずかったと反省(自分は越える前に席には戻っていましたが、、)。

個人的にはJavaScript関連はジャストミートで聞いていて楽しかったです。
