---
title: "QMacCocoaViewContainer を使ってみる"
date: 2016-12-10 17:25:00
tags: [Advent Calendar, Qt, AppKit, Objective-C, OS X, macOS]
categories: [ブログ]

---

こんにちは、こんばんは。

[Qt Advent Calendar 2016](http://qiita.com/advent-calendar/2016/qt) の 10日目を担当する [@sharkpp](https://twitter.com/sharkpp) です。

今回は [QMacCocoaViewContainer](http://doc.qt.io/qt-5/qmaccocoaviewcontainer.html) Class を触ってみようかと思います。

題して「QMacCocoaViewContainer を使ってみる」です。

## はじめに

これは、 Qt で macOS Sierra の [Touch Bar](https://developer.apple.com/reference/appkit/nstouchbar) を使ってみようとして挫折したあれこれのから生まれた記事であります。

公式の方では [[QTBUG-56908] Support NSTouchBar on latest MacBook Pro - Qt Bug Tracker](https://bugreports.qt.io/browse/QTBUG-56908) で 5.9 を目標に実装が提案？されているようです。

まあ、とりあえず Touch Bar の事は忘れましょう。

## 環境

|項目|値|
|-|-|
|OS|macOS Sierra 10.12.1 (16B2659)|
|Qt|5.7.0|
|Qt Creator|4.1.0|

この記事では Qt Creator でコードを書いていきます。

## 目標など

今回は [NSButton](https://developer.apple.com/reference/appkit/nsbutton) を Qt のウインドウ上に表示してクリックをハンドリングするまでがこの記事の内容になります。

とりあえず作るクラスの階層です。

```
CocoaButton -- QPushButton を派生
  +-- CocoaButtonWrapper -- NSButton の参照を所有
        +-- CocoaButtonProxy -- NSButton のクリックを CocoaButtonWrapper に送る
```

`CocoaButton` が Qt のウィジェットとして利用できるようにするクラスで、そのほかに `CocoaButtonWrapper` や `CocoaButtonProxy` があります。

## プロジェクトを作る

まず適当なプロジェクトを作り、`NSButton` ボタン用のクラスを追加します。

[Using Objective-C Code in Qt Applications](http://doc.qt.io/qt-5/ios-support.html#using-objective-c-code-in-qt-applications) に書かれているように `OBJECTIVE_SOURCES` に `.mm` ファイルを追加しますが、「クラスの定義」でソースファイル名の拡張子を `.mm` に変更した場合は自動で設定してくれるようです。

[<img src="{{ thumbnail('/images/2016_1210_qtcreator_newclass.png', 384, 384) }}" alt="Qt Creator">](/images/2016_1210_qtcreator_newclass.png) 

また、 `NSButton` などを利用するので .pro に AppKit をリンクするように `LIBS` に追加します。

```diff
  
  FORMS    += mainwindow.ui
+ 
+ OBJECTIVE_SOURCES += \
+     cocoabutton.mm
+ 
+ macx: LIBS += -framework AppKit
```

こんな感じです。

完全な内容は [MacCocoaWithQtSample.pro](https://github.com/sharkpp/MacCocoaWithQtSample/blob/master/MacCocoaWithQtSample.pro) を見てみてください。

## CocoaButton の実装

追加したファイルにクラスの実装をしていきます。

[cocoabutton.mm](https://github.com/sharkpp/MacCocoaWithQtSample/blob/master/cocoabutton.mm) に `CocoaButton` を実装してきます。

Qt Cretor のデザイナでボタンを設置したいがために `moveEvent` や `resizeEvent` を実装します。

```cpp
void CocoaButton::moveEvent(QMoveEvent *event)
{
    NSRect frame;
    frame = [m_wrpper->m_refButton frame];
    frame.origin.x = event->pos().x();
    frame.origin.y = event->pos().y();
    [m_wrpper->m_refButton setFrame:frame];
}

void CocoaButton::resizeEvent(QResizeEvent *event)
{
    NSRect frame;
    frame = [m_wrpper->m_refButton frame];
    frame.size.width = event->size().width();
    frame.size.height = event->size().height();
    [m_wrpper->m_refButton setFrame:frame];
}
```

`setText` でボタンのキャプションを変えれるようにしておきます。

```cpp
void CocoaButton::setText(const QString &text)
{
    [m_wrpper->m_refButton setTitle: text.toNSString()];
}
```

あとは、

```cpp
    CocoaButtonProxy *proxy = [[CocoaButtonProxy alloc] init:this];
    [m_refButton setTarget:proxy];
    [m_refButton setAction:@selector(clicked:)];
```

みたいな形で Objective-C で実装された target と action を登録して

```objectivec
- (IBAction)clicked:(id)sender
{
    proxyDest->handleClicked();
}
```

とすれば、クリックで C++ で実装されたメソッドが呼び出せます。

最後に `CocoaButtonProxy` から `CocoaButton` そしてその上位へとシグナルを飛ばすようにすれば、

```cpp
connect(ui->buttonCocoa, SIGNAL(clicked()), this, SLOT(onCocoaButtonClick()));
```

このような形でシグナルを受け取ることができます。

[<img src="{{ thumbnail('/images/2016_1210_sample_ss.png', 384, 384) }}" alt="Qt Creator">](/images/2016_1210_sample_ss.png) 

実際に動かすとこんな感じです。

## 成果物

[sharkpp/MacCocoaWithQtSample](https://github.com/sharkpp/MacCocoaWithQtSample) に今回の記事の完全なソースを置いておきます。

## 参考

* [QMacCocoaViewContainer Class | Qt Widgets 5.7](http://doc.qt.io/qt-5/qmaccocoaviewcontainer.html)
* [[QTBUG-40583] Unable to use QMacCocoaViewContainer - Qt Bug Tracker](https://bugreports.qt.io/browse/QTBUG-40583)
* [vdfuse/VBoxCocoa.h at master - vasi/vdfuse](https://github.com/vasi/vdfuse/blob/master/include/VBox/VBoxCocoa.h)

## 最後に

今回は、[Touch Bar](https://developer.apple.com/reference/appkit/nstouchbar) を Qt から使ってみたい、から始まり結果、かなりスケールダウンした記事となりましたが、それもこれも、初めてさわる Objective-C が原因でしたが、今回いろいろ調べてなんとなくわかってきたので Touch Bar の方も何かしらためせるといいなと思っています。

それでは、また。

明日は [@nekomatu](https://twitter.com/nekomatu) さんによる「[BuildrootとQtCreatorを使ってQtアプリを開発する方法](http://nekomatu.blogspot.jp/2016/12/develop-qtapp-with-qtcreator-on-buildroot.html)」です。
お楽しみに。

<hr />

この投稿は **[Qt Advent Calendar 2016](http://qiita.com/advent-calendar/2016/qt)** の **10日目**の記事です。

* ９日目の記事: [スレッドの同期について学ぼう(その１）](http://qiita.com/hermit4/items/6282640a7fe4dbcdec43)
* 11日目の記事: [BuildrootとQtCreatorを使ってQtアプリを開発する方法](http://nekomatu.blogspot.jp/2016/12/develop-qtapp-with-qtcreator-on-buildroot.html)

<hr />
