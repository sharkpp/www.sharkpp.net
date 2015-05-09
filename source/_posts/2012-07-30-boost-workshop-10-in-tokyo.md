---
title: "Boost.勉強会 #10 東京 に参加しました"
tags: [C++, boost]
categories: [blog]

---

一昨日、Boost.勉強会 #10 東京 に参加しました。

## 入場

とりあえず、ビルマでたどり着けたは着けたけど、入り方がわからなくてうろうろしてたら係の人があけてくれた。

## Boostライブラリ一周の旅 1.49.0?1.50.0 [@cpp_akira][1]

以前に紹介した内容以外も含めたスライドをslideshareで公開する

  * [Boost.Algorithm][2] → 文字列処理ライブラリに加えて all\_of,copy\_if,clamp(min+maxの範囲制限がいっぺんにできる)などなどが追加されている。
  * functional/overloadfunction → ？
  * [Boost.LocalFunction][3] → ローカル関数を定義
  * [Boost.Utility/IdentityType][4] → 関数マクロに渡す引数でカンマを付けれるようにする機能など

## C++Now! 2012参加レポート [@cpp_akira][1]

気になった内容のメモ

### １日目

#### odeint

常備分方程式を解く為のライブラリ

http://headmyshoulder.github.com/odeint-v2/

#### Lambda Functions

C++11に追加されたラムダ式の紹介、スライドとしてうまくまとめられているので見るべきとのこと(ただし、もちろん英語)

[C++Now! 2012 - boostjp][5]

#### Ustring

[C++Now! 2012 - boostjp][6]

### ２日目

### Metaparse

コンパイル時構文解析ライブラリ、文字列リテラルで構文解析、謎の技術

[C++Now! 2012 - boostjp][7]

### 3日目

#### Modules in C++

次期標準に入れようとしているモジュールシステムに関するキーノート

Javaなどであるようなパッケージみたいな感じ、コンパイル時間の短縮などを主に意図している模様

[C++Now! 2012 - boostjp][8]

#### conceptClang

C++11に含まれなかったconceptをClang(クラン)で実験的に実装してみようという話

[C++Now! 2012 - boostjp][9]

４日目

#### Now What?

C++が今どこにいるのかというキーノート

[C++Now! 2012 - boostjp][10]

#### Using Boost.Coroutine to untangle a state machine

Boost.Contextをベースとして使いBoost.Coroutineを書き直したという話

[C++Now! 2012 - boostjp][11]

発表の資料はgithubで公開しているとのこと→ここ

## sexyhook 3の変更点 [@super_rti][12]

### 自己紹介

[なのは完売 とある関数の電脳戦][13] → アンチフック＆フックを仕掛けてきた対象を落とす

[regexp for assemble for PHP][14] → 文字列のリストをもとにそれを受諾する正規表現を自動で作る仕組みをPHPで実装する試み

### 本題

何をするライブラリか → テストなどを目的としてAPIや関数を乗っ取り強引に接合部を作る。

ヘッダのみで使え、x86とx64に対応。

通常のクラスメソッドや仮想関数もフック可能。

実装はトランポリンフック。 基本的な仕組みは、関数の先頭にフック先へのジャンプコードを入れる。この時、元のコードが壊れてしまうのでそれをどうするかが重要。

sexyhook2はバックアップした元コードをオリジナルの関数をコールするタイミングで書き戻し、デストラクタで再度フックコードを入れ直している。

sexyhook3はオペコードのバイト数を数えオペコードが壊れないサイズでバックアップしその最後にバックアップしていない箇所へのジャンプコードを挟んでおく。 オリジナルのコードを呼ぶときはバックアップしたコードを呼び出すことでオーバーヘッドを少なくしている。

副産物としてオペコードを数える処理ができたので公開したとのこと。

## 昼休み

予定より早く発表が終わってしまったので、@super_rti さんが別のときに発表したスライドで発表。

### 音声認識のご認識フィルタとしての機械学習

#### 音声認識で家電操作

発達した科学は魔法と区別がつかない

#### 音声認識

方法は、SAPI と [julius][15] (フリーの実装) を使ってみたとのこと。

##### 文法認識とディクテーション

  * 文法認識、認識率は高いが過剰認識をしやすい
  * ディクテーション、フリーの実装は認識率が低い

呼びかけと命令、「コンピュータ、電気つけて」の規則を作ることで音声認識を賢くする

信頼度がそれぞれのライブラリで取得できるがそのまま信頼すると裏切られる。

認識率が芳しくないので、フィルタとして機械学習を使用し音声認識＋機械学習とすることで認識率アップをもくろむ。 中身いじれないので、juliusを以降では使うことに。

  * SVM → ？
  * mfcc → ？

### 課題

テストに使った声や呼びかけが「コンピュータ」に特化してしまった。 まだ、数時間に一回のミスが出るが、数ヶ月に一回にしたい。

### その他

julius の voca と grammer は使いにくい。 なぜなら、メモリリークしたりstatic使いまくっている。 なので独自のコンバータを作った

[inline namesapce][16]ってのがこのあたりでサラッと出てきた気がする。

## 昼休み終了

閉め切られていたので戻るのに難儀した。

## C++でエレガントな並列計算 [@ponkotuy][17]

### Thrust

CUDA上で動くSTL

[thrust - Code at the speed of light - Google Project Hosting][18]

### [Boost.uBLAS][19]

会場から突っ込みが出ていたが、デフォルトの実装がひどいらしく処理のエンジンをかえてやらないといけない。 下に書いてあるEigenをバックエンジンとして使うこともできる模様。

### Eigen

[Eigen][20]

### Boost.SIMD

SIMD型＋周辺処理を行うライブラリ。 実装途中。

[Boost.SIMDの元][21]

## C++ Transactional Memory言語拡張の紹介 [@yohhoy][22]

C++の次の規格に入れようとしている機能、とりあえずは、TRで入れられる模様。

データベースな世界の「トランザクション」をメモリ操作に適用し、同時操作からメモリの一貫性を保護する機能。

ハードウエアベースの実装：Intel Haswell,AMD ASF(シミュレータベース) ソフトウエアベースの実装：Haskell,Clojure,C++STM,TBoost.STM

[generalized attribute 構文][23]

gccに実験的に実装中。 ただし、ソフトウエアベースなのでパフォーマンスはすごく悪い、公式としても速度はとりあえず二の次。 [GCC 4.7にはTransactional Memoryの拡張が入る予定][24]

## 万能数値型URR [@wraith13][25]

浮動小数点（IEEE754）とも固定小数点とも違う表現方法。

IEEE754は1985と2008の２つがある。

URRの特徴は、1もしくは-1付近で精度がものすごく良くなる、が、その逆は悪くなる。 また、ビット長によらず内部表現は同じ。

課題は、ハードウエアによる支援がないため現状は遅い。 なので収納ビットが節約できるぐらいであまりメリットがない。 文字列との相互変換が難しい。 ビット長を大きくしても極大値、極小値の精度はあまり変わらない。

実際に実装してみたとのこと→[ここ][26]

## 家に帰るまでが遠足です． [@Cryolite][27]

Boost.Build(bjam)の紹介。

Boost.Build使えば、複数のコンパイラオプション、複数のコンパイラ(gccのバージョンとかgccとclangとか)をそれぞれ一括でビルドできる。 依存関係を考えオプションなどの波及なもどしてくれる。 Boost.Build便利だよ。

## 全員参加ディスカッション

今回は、これをお目当てでいったようなものです。

  * ディスカッションはワールド・カフェ形式をベースに。
  * １テーブル６人ぐらいで30分でテーブルチェンジ、３回目のチェンジでもとのテーブルに戻る。
  * 各テーブルに白紙が配られそれに内容を書いてく。

### イベント処理ライブラリ

[@egtra][28]さんがテーブルマスター。

もともと、じゃんけんで自分がなる予定だったけど内容を考えたの自分だからやりましょうか？と助け舟が出てきたので好意に甘えちゃいましたorz

自分がテーブルマスターになったときに、さっとないよう出しておけばよかったなーと後悔。

内容としては、C#にある、functional reactive programming のようなことをC++で実装したい。 を選びました。

そもそも、FRPがなんなのか？ってのもあったけど、どう表現するか？や、スレッドセーフをどう実装するか？など、でぐるぐる話し合ってました。

イベントの繊維をどうやって表現するかに関しては、グラフを書いてこれをソースに落とせないか？ や、アスキーアートで書いてこれをそのまま実行できればいいよねみたいなことも話してました。

### ゲームエンジン

赤い服きた人

なんか、ゲームエンジンの話から上のレイヤーはC++関係ないよねーって話になって、 たしか、@cpp_akiraさんが、テスト済みの通信ライブラリ欲しい、って話になり、 そのうち、テスターが欲しいよねー、何かアプリ入れてテスターになってもらえばいいじゃん？ からテスター請負サービス作ろう、な流れになりました、自分のいるときは。 チェンジのときに、もはや、C++関係ないよねーっていいながら席を立ってしまいました。

で、最初のテーブルに居たメンバーが同じテーブルになっていたようで聞いた話によると、 上の話はおじゃんにしてFR*のような話題になっていた模様

### 究極の文字列クラス

とりあえず、席に着いたときには紙が真っ白でした。

席に着いたときに聞いた以前の内容としては、文字列クラスは可変長を管理するか固定長にするか、みたいな内容でした。

未知の言語を追加できる仕組みがほしいとか、 ソート処理が欲しいとか？（これはアドオンだったかも？） 高速な検索と高速な編集はトレードオフだとか？ 表示処理などはアドオンかなー？とか

あれ？一番興味あったのに一番記憶がないorz

## まとめ

ディスカッションだけ、メモをとっていなかったので記憶のみで書いてるため結構あやふや、、、orz

まーでも、楽しかったです。

知らないライブラリとか出てきて色々興味深かったです。

あと、懇親会の中華料理店は中ギュウギュウだったのとなかなか注文とりにきてくれなかったのが辛かった。

 [1]: http://www.twitter.com/cpp_akira
 [2]: http://www.boost.org/doc/libs/1_50_0/doc/html/string_algo.html
 [3]: http://www.boost.org/doc/libs/1_50_0/libs/local_function/doc/html/index.html
 [4]: http://www.boost.org/doc/libs/1_50_0/libs/utility/identity_type/doc/html/index.html
 [5]: https://sites.google.com/site/boostjp/cppnow/2012#lambda
 [6]: https://sites.google.com/site/boostjp/cppnow/2012#ustring
 [7]: https://sites.google.com/site/boostjp/cppnow/2012#metaparse
 [8]: https://sites.google.com/site/boostjp/cppnow/2012#modules
 [9]: https://sites.google.com/site/boostjp/cppnow/2012#concept-clang
 [10]: https://sites.google.com/site/boostjp/cppnow/2012#now-what
 [11]: https://sites.google.com/site/boostjp/cppnow/2012#coroutine
 [12]: http://www.twitter.com/super_rti
 [13]: http://d.hatena.ne.jp/rti7743/20111220/1324389840
 [14]: http://d.hatena.ne.jp/rti7743/20111113/1321149932
 [15]: julius.sourceforge.jp/
 [16]: http://d.hatena.ne.jp/faith_and_brave/20080602/1212397278
 [17]: http://www.twitter.com/ponkotuy
 [18]: https://code.google.com/p/thrust/
 [19]: http://www.boost.org/libs/numeric/
 [20]: http://eigen.tuxfamily.org/
 [21]: http://d.hatena.ne.jp/faith_and_brave/20110330/1301469339
 [22]: http://www.twitter.com/yohhoy
 [23]: http://www.codesynthesis.com/~boris/blog/2012/04/18/cxx11-generalized-attributes/
 [24]: http://d.hatena.ne.jp/faith_and_brave/20111122/1321938184
 [25]: http://www.twitter.com/wraith13
 [26]: http://tricklib.com/cxx/ex/urr/
 [27]: http://www.twitter.com/Cryolite
 [28]: http://www.twitter.com/egtra