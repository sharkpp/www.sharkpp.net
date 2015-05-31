---
title: "Qt JAPAN SUMMIT 2015 に行ってきた"
date: 2015-05-27 20:58
update: 2015-05-31 15:50
tags: [Qt, 雑記, 勉強会]
categories: [ブログ]

---

去年の [Qt DEVELOPER DAY 2014 Tokyo](/blog/2014/05/20/qt-developer-day-2014-tokyo.html) に続き 2015-05-26 に行われた [Qt JAPAN SUMMIT 2015](https://www.qt.io/qtjapansummit2015/) に行ってきました。

メモった内容が予想以上の量になってしまったので、面倒な人は読み飛ばして<a href="{{ page.url }}#%E3%81%BE%E3%81%A8%E3%82%81">まとめ</a>を読むといいのです。

* 2015-05-28 誤記修正＆スライド追記
* 2015-05-31 スライド追記

## 開場・受付(9:00 - 10:08)

9:00 から受付開始だったけど、もろもろの事情から少し遅れて会場に到着。

とりあえず Pepper が居た！

## General トラック(10:08 - 12:30)

### 御挨拶(10:08 - 10:23)

８分ほど遅れて開始。

セミナー会場はパッと見で７割から８割ほどが埋まった状態。

[鈴木 佑](https://twitter.com/task_jp) – 日本Qtユーザー会

* お昼は配布＆セミナー会場でもぐもぐします。
* 午後は２階から５階へ移動し、 Business トラックと Technical & Features トラックに分かれます。
* スポンサー様([The Qt Company](https://www.qt.io/) ([Digiaからスピンオフ](http://osdn.jp/magazine/14/08/08/072200))様、[株式会社 SRA](https://www.sra.co.jp/) 様、[株式会社アイ・エス・ビー](http://www.isb.co.jp/)様、[ウインドリバー](http://www.windriver.com/japan/)様、 [Adeneo Embedded](http://www.adeneo-embedded.com/) 様、[株式会社 PTP](http://www.ptp.co.jp/) 様、[日本 Qt ユーザー会](http://qt-users.jp/)様)と QtJS イベント事務局様に感謝を！
* 見所
    * Lars Knoll による基調講演
    * ライトニングトーク大会
    * デモ展示、スポンサーによるショーケース
* 目標
    * もっと知ってもらう
    * より便利に使ってもらう
    * みんなで話をしたい
    * みなさんに楽しんでもらいたい
    * そして
        * 日本で全体的に盛り上がっていく
        * 日本すげーとなる
        * 「来年もこのイベントを無料で開催できる」
* 来年はスポンサーになりませんか？
* 午後は５階！午後は５階！

### Strategy Insight & Qt Roadmap: Build your world with Qt (10:23 - 11:10)

「戦略の見通し ＆ Qt のロードマップ : Qt と共にあなたの世界を構築」

Lars Knoll - The Qt Company

MacBook がクラッシュしちゃった！ Oh no!

この間に、 Qt が 20 周年を記念しユーザー会よりケーキが送られた。

<blockquote class="twitter-tweet" lang="ja"><p lang="en" dir="ltr">What a great cake! Celebrating 20 years of Qt at the Japan Summit <a href="https://twitter.com/hashtag/qtjp?src=hash">#qtjp</a> <a href="http://t.co/dJkpLVWyTU">pic.twitter.com/dJkpLVWyTU</a></p>&mdash; Lars Knoll (@LarsKnoll) <a href="https://twitter.com/LarsKnoll/status/603049082009956353">2015, 5月 26</a></blockquote>
<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>

* The Qt Company の代表かつチーフメンテナ
* 20 周年を祝い先週、オフィスでもお祝いした。
* 1997 年に Qt を初めて知り、 2000 年から Qt に実際に関わり始めた。
* Qt はアプリケーションまたはデバイスを開発するために必要なこと全て、アプリケーションの開発を簡単に、楽しくできるように！
* デスクトップ、 Windows Mobile 、 Android 、 iOS 、 どのスクリーンもサポート
* いろんなデバイスでネイティブな表示も出来、独自の表示も出来る。
* 事例
    * [Autodesk Maya](http://www.autodesk.co.jp/products/maya/overview)
    * [Tesla Motors](http://www.teslamotors.com/) : 車載ダッシュボードなど
    * 航空管制システム、ヨーロッパの半分ほどの空港で利用されている。
    * フライトエンターテイメント、９割程度で利用。
* クロスプラットフォーム
    * 非グラフィックな API 、 スレッドやファイルI/O、 Unicode サポートなど
    * デスクトップ
        * Windows 、 Windows RT
        * Mac
        * Linux
    * Mobile
        * Android
        * iOS
        * Windows Phone
    * 組み込み
        * Linux
        * [QNX](http://ja.wikipedia.org/wiki/QNX)
        * Windows Embedded
        * vxWorks
* ツール
    * Qt Creator
* UI techology
    * Qt Widget ... 従来のアプリケーションを作る場合は
    * Qt Quick ... タッチスクリーンのサポートなどをしたい場合
    * Qt OpenGL ... OpenGL のコンテンツをインテグレート、
    * Qt Canvas 3D
    * Qt 3D ... 3Dモデルを読み込んで表示できる
    * Qt Web Engine ... WebKit ベースから Google が Fork したライブラリベースに、 Qt Quick でも Qt Widget のどちらでも埋め込める
    * Qt Multimedia ... AVサポート、カメラサポートなど
* 接続性
    * ネットワーク
    * IPC
    * シリアルポート
    * Web Sockets
    * NFC
    * XML/JSON/DBUS
    * Bluetooth
    * マッピングとルーティング
* パフォーマンス
    * Qtは推定80万ユーザー
    * C++ ベースの確固たる基盤
* 固有のプラットフォームの作成
* 見地
    * 組み込みデバイスへのさらなる対応、高応答性をもつことが出来る物のひとつ
    * より早くより簡単にデバイスを作成できるように
    * 組み込みデバイスのアップデートを保つ
    * ユーザーインターフェースをより良く、例えば Qt Quick と イラストレータとの親和性など
* まとめ
    * アプリケーション開発
        * デスクトップとモバイル
    * デバイスの作成
        * yacto 向けのリファレンススタック
        * 独自のスタックの作成用のツール
        * デバイスシミュレータ
    * ライセンス
        * オープンソース(LGPLv2.1 / LGPLv3) と コマーシャル(The Qt Company license) のデュアルライセンス
    * ロードマップ
        * 2015-05-15 5.5 beta リリース
        * 2015-06-XX 5.5 final リリース予定
        * 2015-11-XX 5.6 リリース予定

### Qtにおけるベストプラクティス (11:10 - 11:43)

SRA 山口 大介

* Qtでどうする？
    * ライセンス
    * パフォーマンス
    * マルチプラットフォーム
    * アーキテクチャ
    * ポーティング
    * 日本語入力
    * テスト
    * 他言語対応
    * Qt4 から Qt5 へのバージョンアップ
    * アーキテクチャ
* よく問題になること
    * バグ、障害
    * 性能が出ない
    * アーキテクチャ
* 困らないために
    * 「バグ、障害」に困らないために Qt の実装・テストを知っていますか？
    * 「性能が出ない」に困らないために Qt の実装・設計を知っていますか？
    * 「アーキテクチャ」に困らないために Qt の設計を知っていますか？
* 活用するために
    * よくしり
    * 課題を明確にし
    * 
* Qtに置けるテスト
    * 静的解析や動的解析 → Civerty Fortify CPPCheck Valgrind Purify
    * 単体テスト → QTestLib Google Mock
    * GUIテスト → Squish for Qt
    * コードカバレッジ → Squish Coco
    * 集計 → Covertura
    * などを → Jenkins で管理
* [Squish for Qt](http://www.froglogic.com/squish/gui-testing/)
    * ユーザー操作をスクリプト化
    * Qt 専用
    * あ
* Qt における高速化
    * QML Profiler
    * [Qt Quick Compiler](http://doc.qt.io/QtQuickCompiler/) (商用ライセンスのみ)
         * C++ に変換し高速化
         * 10 倍以上高速化することも
* Qt Linguist による他言語化
    * それぞれの言語文字列の長さの違いの対応
    * QML では fontSizeMode で制御可能
    * [TRADOS](http://www.translationzone.com/jp/trados.html) が出力する XML との連携も出来る
* Qt 4 から Qt 5 へのバージョンアップ
    * 比較的簡単にできる
    * Tips がいろいろ公開されている
* Qt のライセンス
    * 商用と LGPL と GPL
    * LGPL を使用して開発すると 商用ライセンスへ移行できない。
* まとめ
    * テストなどの仕組みは最初にしっかり作ればあとが楽になる

### 休憩 (11:45 - 12:00)

11:45 から 12:00 まで

### Qt for your Multiscreen Strategy (12:00 - 12:30)

「あなたのマルチスクリーン戦略のための Qt 」

Qt - A Framework for the Multi-Screen World
「QT - マルチスクリーンの世界のためのフレームワーク」

Nils Christian Roscher-Nielsen – The Qt Company

* マルチスクリーン世界のための 4 つのコンセプト
    * C++ の力
    * QML でネイティブなパフォーマンス
    * ハイブリッドアプリケーション開発
    * 相互接続性
* アプリケーション開発とデバイス作成とSDKの作成
    * 自動車業界
        * デバイスにアプリケーションをインストールしカスタマイズできるようになってきている。
        * 頻繁なアップデート、UIのカスタマイズ
* C++ の力
    * C++ の API により高速に、強力にアプリケーションを構築することが出来る。
        * C++11 、 C++14 なども対応。
    * UIで一番良い方法は Qt Quick を使用すること。
    * QWidget では対応が難しい OpenGL 用に最適化した言語を作ることにした。
    * Qt Quick により プラットフォームにではなくそれぞれの会社ごとの独自色を出すことが出来る。
    * 相互接続製、 C++ と Javascript との間で簡単に接続することが出来る
* あなたのデバイスでのマルチスクリーン
    * QML を使うことでデスクトップ、モバイル、組み込みで最適化された画面を容易に準備できる。
* Qt Creator はカスタマイズが容易に出来て独自のデバイスにも対応できる
* LGPLv3 にアップしたので LGPLv2 で曖昧だった部分が明確になった。

## 休憩/スポンサー・デモショーケース (12:30 - 13:30)

### お昼

お昼もぐもぐ♪ Qt 20周年のケーキも切り分けられて配られていました。

<blockquote class="instagram-media" data-instgrm-captioned data-instgrm-version="4" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:300px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:8px;"> <div style=" background:#F8F8F8; line-height:0; margin-top:40px; padding:50% 0; text-align:center; width:100%;"> <div style=" background:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACwAAAAsCAMAAAApWqozAAAAGFBMVEUiIiI9PT0eHh4gIB4hIBkcHBwcHBwcHBydr+JQAAAACHRSTlMABA4YHyQsM5jtaMwAAADfSURBVDjL7ZVBEgMhCAQBAf//42xcNbpAqakcM0ftUmFAAIBE81IqBJdS3lS6zs3bIpB9WED3YYXFPmHRfT8sgyrCP1x8uEUxLMzNWElFOYCV6mHWWwMzdPEKHlhLw7NWJqkHc4uIZphavDzA2JPzUDsBZziNae2S6owH8xPmX8G7zzgKEOPUoYHvGz1TBCxMkd3kwNVbU0gKHkx+iZILf77IofhrY1nYFnB/lQPb79drWOyJVa/DAvg9B/rLB4cC+Nqgdz/TvBbBnr6GBReqn/nRmDgaQEej7WhonozjF+Y2I/fZou/qAAAAAElFTkSuQmCC); display:block; height:44px; margin:0 auto -44px; position:relative; top:-22px; width:44px;"></div></div> <p style=" margin:8px 0 0 0; padding:0 4px;"> <a href="https://instagram.com/p/3IWku5Pb1M/" style=" color:#000; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none; word-wrap:break-word;" target="_top">Qt 20周年ケーキ配布ミッションコンプリート！ #qtjp #qtjs</a></p> <p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;">@sharkppが投稿した写真 - <time style=" font-family:Arial,sans-serif; font-size:14px; line-height:17px;" datetime="2015-05-26T03:44:53+00:00">2015 5月 25 8:44午後 PDT</time></p></div></blockquote>
<script async defer src="//platform.instagram.com/en_US/embeds.js"></script>

### ライトニングトーク大会 (12:30 から 13:30)

### Qt おやつ部活動報告

[@hermit4](https://twitter.com/hermit4)

[内容は去年と同じ](/blog/2014/05/20/qt-developer-day-2014-tokyo.html#qt%E3%81%8A%E3%82%84%E3%81%A4%E9%83%A8%E6%B4%BB%E5%8B%95%E5%A0%B1%E5%91%8A)

### ペッパー

川田 卓志 - ALDEBARAN

* ペッパーの開発ツール、コレグラフを作るのに Qt を使ったよ
* Windows / Linux / Mac で同じ UI を作ることが出来た

### Qt quick でオトゲー

[@latte_zero](https://twitter.com/latte_zero)

* Jubeat 風ゲーム
* 文化祭のために 1 ヶ月ぐらいで作成
* Qt Quick 本をみて Qt Quick で作ろうと考えた
* コードは QML 3000 行、 Javascript 1000 行、 C++ 200 行

### MUJIN の紹介

* 工作機械用の制御プログラムを作っている
* Pick Worker の UI 部分を Qt で作った

### Mac OS X 用ファイルコピーソフト「RapidCopy」の開発

澤津 健吾 - [レスパスビジョン株式会社](http://www.lespace.co.jp/)

<iframe src="//www.slideshare.net/slideshow/embed_code/key/CZ022q7n3TKTTz" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="border:1px solid #CCC; border-width:1px; margin-bottom:5px; max-width: 100%;" allowfullscreen> </iframe> <div style="margin-bottom:5px"> <strong> <a href="//www.slideshare.net/KengoSawa2/20150526-rapidcopy-lt-onn-qt-japan-summit-2015" title="20150526 RapidCopy LT on Qt Japan Summit 2015" target="_blank">20150526 RapidCopy LT on Qt Japan Summit 2015</a> </strong> from <strong><a href="//www.slideshare.net/KengoSawa2" target="_blank">L&#x27;espaceVision</a></strong> </div>

* Mac で TB 単位のファイル操作に標準の Finder が耐えられない
* Windows のファイルコピーソフト FastCopy をベースとして Mac に移植
* FastCopy は WIN32API のみでフレームワークをいっさい使用していない
    * ファイル操作部分は POSIX として移植
    * GUI に Qt を使用
    * その他、新規実装部分にも Qt を使用

### コラージュ作成ソフト

郵便局勤めのサンデープログラマ氏

* [コラージュ](http://ja.wikipedia.org/wiki/%E3%82%B3%E3%83%A9%E3%83%BC%E3%82%B8%E3%83%A5)作成ソフトを Qt Quick で作成
* 資料を探すのが大変だった

## Technical & Features トラック (13:35 - 18:45)

5 階に移動

### Custom Modern Qt Quick Components (13:35 - 14:40)

Sébastien Ronsse – Adeneo Embedded

* 壁にトグルスイッチをつける デモを交えたセッション
* Qt Quick とは？
* クロスプラットフォーム
* Qt Creator はすばらしい開発環境
* iOS や Android などのモバイルプラットフォームがをターゲットとしている
* Qt Quick はパワフルでしかし簡単だ
* 楽勝におすすめできる。
* ハードウェアアクセラレーションで応答性を高く

FAQ

Q. OpenGL を使うにはシーングラフを使うしかないのか？直接は扱えない？
: A. QQuickItem やフレームバッファを使えば可能

&nbsp;
Q. どこかにこのセッションのスライドなどをアップする予定はあるか？
: A. アップする予定はなかったがどこかに上げましょう

&nbsp;
Q. QtWidget で同じことはできるか？
: A. QtWwdget でできなくはないが複雑な処理が必要になる。 Qt Quick だと簡単かつダイナミックに書ける。

&nbsp;
Q. QtWidget と Qt Quick と同じようなことが出来るものがあるがそればわざとそうしているのか？
: A. QtWdget は長く使われてきたもの。Qt Quick は UI とロジックを分けて記述しやすくしやすくなってる

### Using Qt Creator Value-Add Features to Further Productivity (14:40 - 15:45)

[朝木 卓見](https://twitter.com/takumiasaki) – 株式会社 SRA

* QtCreator 使われてる方、挙手→意外と多い
* Qt 以外でも使われてる例もある
    * →ベアメタル
    * プラグインで拡張できるが、Ｃ系じゃないと大変
* インストール方法は Online Installer 、 Offline Installer 、 QtCreator 単体、の 3 種類。
    * QtCreator も Qt も常に最新を使いたいなら Online Installer で
* ユニットテストや C や C++ のソース単体の作成、リポジトリの取り込みもできる
* Qt Quick Designer
* gdb は最近のバージョン、 python scripting extension が必要
* Windows は cdb が必要
* Windows でのデバッグが遅くなったらリビルドやおまじないを追加
* QML プロファイリング
* Qt5 で対応イベントが増えた影響で遅くなる場合がある
* プロファイルを有効にしているとセキュリティ的に脆弱になるので注意
* クイックアクセス(locator)
* QML の文法チェックなどもできる

商用版

* Auto Test → テスト結果を色分けが出来る
* Clang static analyzer → Clangを使って解析、 Clang は同梱されていない
* Qt Quick Designer 拡張
    * Path View でのパスの編集
    * エレメント公開用のチェック
    * コネクションペイン
* QML Profiling
    * シーングラフ
    * メモリ使用量など
* CPU usage anlayzer
    * 次期qt device creation(boot2qt)用？
* Qt Quick Compiler

### 休憩/スポンサー・デモショーケース (15:45 - 16:15)

### 地味に便利な Qt の◯◯ (16:15 - 17:15)

[鈴木 佑](https://twitter.com/task_jp) – 日本Qtユーザー会

<script async class="speakerdeck-embed" data-id="0344db39536341099c2c1248f8ff75ac" data-ratio="1.33333333333333" src="//speakerdeck.com/assets/embed.js"></script>

Q_PROPERTY に MEMBER が追加

* Q_PROPERTY は C++ ではあまり必要ではない
* Javascript とのやり取りでは必要
* たくさんプロパティがあるとゲッターとセッターの定義が大変、 MEMBER を使えばメンバ変数の定義だけで良い

```cpp
Q_PROPERTY(QColor color MEMBER m_color NOTIFY colorChanged)
Q_PROPERTY(qreal spacing MEMBER m_spacing NOTIFY spacingChanged)
Q_PROPERTY(QString text MEMBER m_text NOTIFY textChanged)
```

コマンドラインの引数

* コマンドラインの解析用クラス([QCommandLineParser Class](http://doc.qt.io/qt-5/qcommandlineparser.html))が追加された

qDebug()

おさらい

* いろいろなレベル(エラー、警告、情報)がある
* C 形式 `qDebig("")` と C++ 形式 `qDebug() << ""` の 2 つの形式がある
* スペースと改行文字が勝手に入る。
* C++ 形式だと Qt のクラスのダンプができる。

出力の変更

* `qDebig().nospace()` でスペースなし
* `qDebig().noquote()` で文字列のダブルクォートが出なくなる

QDebug 型

```cpp
{
    QDebug dbg = qDebug();
    dbg << "";
} // このタイミングで出力
```

* QDebug 型の変数を作ると内容をバッファリングし変数が破棄されるタイミングで出力されるようにできる。

16進数で出力もできる

独自のクラスのダンプを作るときに [QDebugStateSaver Class](http://doc.qt.io/qt-5/qdebugstatesaver.html) を使うと `.nospace()` などの状態を保持できる。

<del>qStdOut() で標準出力</del>

カテゴリ分け

* マクロや環境変数で制御しなくても5.2から(5.3から関数形式も)は [QLoggingCategory Class](http://doc.qt.io/qt-5/qloggingcategory.html) と [QCDebug](http://doc.qt.io/qt-5/qloggingcategory.html#qCDebug) でログのカテゴリを定義してオン/オフを制御できる。
* [Q_LOGGING_CATEGORY マクロ](http://doc.qt.io/qt-5/qloggingcategory.html#Q_LOGGING_CATEGORY)も追加
* カテゴリは [QLoggingCategory::setFilterRules](http://doc.qt.io/qt-5/qloggingcategory.html#setFilterRules) (カテゴリ内のレベルも制御できる)や設定ファイルで指定する方法などがある。
* QqMessagePattern/Q_MESSAGE_PATTERN でログの出力フォーマットを指定できてファイル名を出力することができる
* [qInstallMessageHandler](http://doc.qt.io/qt-5/qtglobal.html#qInstallMessageHandler) で ログの出力先も変えられるが、スレッドセーフと再起に対して安全であることが求められる。

QInfo と QIonfo が追加された

### Highlights of the latest Qt 5 Features (17:15 - 18:10)

「最新の Qt5 の機能のハイライト」

Lars Knoll – The Qt Company

* Windows 10/Store App リリースに合わせる
* Android バッケージサイズの最適化、ルックアンドフィール、
* iOS xcode 6 サポート、ポップアップメニューなどよりネイティブのサポートの改善
* 3D コンテンツのサポートもよりいっそうすすめる
    OpenGL の統合、 8 bit alpha/grayscale サポート、 exif rotate
* Qt 5.5 で Qt Canvas 3D を完全サポート、 [three.js](http://threejs.org/) なともサポート
* Qt 5.5 から Qt 3D の最初のテクノロジープレピューが利用できるようになる
* Qt Multimedia をプラットフォーム感での差異をなくすように改善を進めている
* Qt Quick
    * typed Array をサポート
    * C++ と js との間を改善
    * パフォーマンスの改善
    * QQuickRenderControl
    * TreeView の追加
    * OS X ネイティブなジェスチャーを特定のコンポーネントでサポート
    * Qt Quick Compiler を正式追加
    * OpenGL 無しでの描画を行う 2D Render の追加
    * 新しいコントロールコンポーネントセット、 Qt 5.6 で最初のリリース予定
* QWeb Engine を完全サポートしパフォーマンスも改善
* プラットフォーム
    * iOS WebView のサポート追加
    * Qt Web Channel
    * Qt Bluetooth / Bluetooth LE 、iOSは仕様上 Bluetooth LE のみサポート
    * Qt Location を Qt 5.5 より追加
* Virtual Keyboard を追加 (商用ライセンスのみ)
* QStorageInfo の追加
* Data Visualization (商用ライセンスのみ)
* Wayland もサポート

FAQ

Q. Qt5 はどのぐらいサポートする予定か？
: A. Qt4 は 2004 から 10 年以上サポートしているのでそれぐらいはサポートするだろう、だだ Qt 6 の話は出てきてないのでしばらくは Qt 5 のサポートは続く。 The Qt Company としては新しいバージョンが出てからも最低でも2年程度はサポートする予定だ。

&nbsp;
Q. QtWdget もサポートを続けるのか？
: A. 今後もサポートするし削除することもない。 OS の更新でルックアンドフィードが変わった場合も可能な限りサポートする。

### qmake 入門 (18:10 - 18:45)

[石田 伸吾](https://twitter.com/hermit4) – 日本Qtユーザー会

<iframe src="//www.slideshare.net/slideshow/embed_code/key/fczhDZ1ekppu1y" width="425" height="355" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="border:1px solid #CCC; border-width:1px; margin-bottom:5px; max-width: 100%;" allowfullscreen> </iframe> <div style="margin-bottom:5px"> <strong> <a href="//www.slideshare.net/ShingoIshida/qmake" title="qmake入門" target="_blank">qmake入門</a> </strong> from <strong><a href="//www.slideshare.net/ShingoIshida" target="_blank">hermit4 Ishida</a></strong> </div>

* qmake はクロスプラットフォーム用のツールで makefile やソリューションファイルなどを作れる
* 変数、if など 制御構文、コメントも使える
* 変数に対して正規表現での文字列置き換えもできる
* 文字列途中のコメントはそのままコメントとして処理されてしまう
* 多くの組み込み関数がある
* C++11 用など makefile のテンプレートが予め用意されている
* qmake を使いこなしていくと闇が現れる
* `qmake -d` でデバックできる `-dd` とかでレベルを上げれる

## まとめ

* サミット的には全体的にスケジュールが押していた感じ
* 会場は電源が無かったので大変だった
* 来月 Qt 5.5 がリリース予定
* 今年秋には Qt 5.6 をリリース予定(これは正式リリースじゃない？)
* Qt はメジャーなプラットフォームのほとんどで利用できるようになっているよ
* 組み込み向けにもカスタマイズした Qt をビルドする方法の用意があるよ
* QtWidget も Qt Quick と平行して開発するよ
* Qt 5 のサポートは Qt 6 もまだ出てないからしばらくこのままサポートされるよ
* Qt Canvas 3D を正式にリリースしたので three.js もそのまま使えるよ
* Qt Bluetooth や Qt Location など新たなコンポーネントも続々追加されているよ
* Qt Creator もどんどん便利な機能が増えているよ
* Pepper の開発ツールも工作機械用の画面でもファイルコピーツールでも Qt は使われているよ
* qDebug() よりもカテゴリ管理をサポートした qCDebug() を使ってみないか？
* qmake 便利だよ

と以上でした。
メモ書きが予想以上に大量でおかしいな？的なあれでしたがなかなか興味深い話が聞けて良かったです。

ちなみに、今年のノベルティーはボールペンとエコバックでした。
