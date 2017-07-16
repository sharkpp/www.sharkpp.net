---
title: "じゅげむったーの開発日記 その４"
date: 2017-07-16 18:10
tags: [Qt, Twitter, OAuth, C++, cpp, 開発日記, じゅげむったー]
categories: [ブログ]

---

ただいま、[じゅげむったー](https://github.com/sharkpp/Jugemutter) の実装中なのです。

まあ、それはともかくとして、「じゅげむったー」実装中に Qt 関連で躓いた部分や発生した問題の解決方法を、メモしておいたら溜まってきたので一度放出しようかと。

## ドロップダウン型のダイアログを表示する(macOS)

macOS でウインドウのタイトルバーの直下からまるで舌ベロのように垂れ下がるドロップダウン形式のダイアログの実装方法。

![QDialogのSheetスタイル](/images/2017_0716_macOS_QDialog_sheet_style.png)

こんな感じのダイアログの表示スタイルです。

Apple 的には `[Sheet](https://developer.apple.com/library/content/documentation/Cocoa/Conceptual/Sheets/Concepts/AboutSheets.html)` って名称らしいですね。

```cpp
#if defined(Q_OS_MAC)
    setWindowFlags(Qt::Sheet);
#endif
```

これだけです。

`#if` と `#endif` はなくても良さそうですが、一応。

そうして `.exec()` などを呼び出せば表示できます。

## リスト下部の追加や削除ボタン(macOS)

![リスト下部のボタン](/images/2017_0716_macOS_list_buttons.png)

こんな感じでリストの下部に追加や削除のボタンがついているやつ。

これは Apple 的には...なんて機能なんだろう？一度見つけたけど、見失った。

この機能はどうやら実装されていないようなので、レイアウトとボタンをそれらしく配置することで再現するしかない様です。
まあ、Windows や Linux でも同じ機能にしたいなら、そちらの方が良いかもですね。

## QDialog の大きさをコンテンツに合わせる

コンストラクタで [void QWidget::adjustSize()](http://doc.qt.io/qt-5/qwidget.html#adjustSize) を呼び出せばOK。

```cpp
MyDialog::MyDialog(QWidget *parent)
    : QDialog(parent)
    , ui(new Ui::MyDialog)
{
    ui->setupUi(this);
    adjustSize();
}
```

## オーバーロードされたシグナルとの接続方法

Qt 5 から？だったか `connect(hoge, SIGNAL(...), ...)` ではなく `connect(hoge, &..., ...)` で記述できるようになった。
なったのだけど、じゃあオーバーロードして宣言されているシグナルとの接続はどうするんだろう、と。

ちょうど必要な状況にぶち当たったので調べてみることに。

まず、

```cpp
    connect(m_tagListWidget, &QComboBox::currentIndexChanged,
            this, &TagInput::onTagListSelected);
```

こんな感じで記述すると `error: no matching member function for call to 'connect'` みたいなエラーが出ます。

解決方法は、`QtGlobal` の [QOverload](http://doc.qt.io/qt-5/qtglobal.html#qOverload) テンプレートクラスを利用すればいいみたいです。

```cpp
    connect(m_tagListWidget, QOverload<int>::of(&QComboBox::currentIndexChanged),
            this, &MyClass::onCurrentIndexChanged);
```

C++14 が有効であれば、

```cpp
    connect(m_tagListWidget, qOverload<int>(&QComboBox::currentIndexChanged),
            this, &MyClass::onCurrentIndexChanged);
```

こうれば良いようです。

## 子要素へスタイルシートを適用させない

ウィジェットをカスタマイズするためにスタイルシートで単純に

```css
QFrame { background: #F90; }
```

とした場合、これはもちろん、指定した要素に適用されます。

そして、実はこの時に子要素が存在していた場合、その子要素にまでその指定が効いてしまいます。
まあ、HTML のスタイルシートとして考えた場合には、確かにそれはそれで正しいのですが、ちょっと困り者ですね。

では、どうするか？

```css
.QFrame { background: #F90; }
```

もしくは

```css
#orangeColor { background: #F90; }
```

と要素を限定すればOKです。

## QtCreator で QToolBar を自由に設置する

QtCreator のデザイナでは、どうやら [QToolBar](http://doc.qt.io/qt-5/qtoolbar.html) は、ウインドウ内に一つで、`QLabel` など他のウィジェットのように自由には配置できないようです。
もっとも、普通のアプリケーションでは問題ないとは思います。

`QToolBar` をウィジェット的に扱う場合にはどうするか？

直接 .ui ファイルを編集します。
開くと、「このファイルはデザインモード以外では編集できません。」と出ますし、本来はダメなのですが...
どうしてもデザイナ上で扱いたかったんです。

手順は

1. デザイナで QWidget を追加し、`objectName` を指定
2. 対象の .ui を「エディタを指定して開く」→「テキストエディタ」で開く
3. 1で指定した名前を探す
4. クラス名を変更する
5. ファイルを保存し閉じる
6. デザイナで開き直す

となります。

クラス名の変更は

```diff
      <item>
-      <widget class="QWidget" name="widget1">
+      <widget class="QToolBar" name="widget1">
        <property name="sizePolicy">
```

こんな感じですね。

## QToolbar でスタイルシートの指定が反映されない(macOS限定？)

macOS ではどうやらスタイルシートの実装に不具合なのか仕様なのかがあるようで、背景色の指定がうまくできない時があるようです。
[[QTBUG-12717] Background color for QToolBar is not stylable on Mac - Qt Bug Tracker](https://bugreports.qt.io/browse/QTBUG-12717?focusedCommentId=216435&page=com.atlassian.jira.plugin.system.issuetabpanels%3Acomment-tabpanel#comment-216435) では `border` を指定し問題を回避できると書かれていました。

```css
QToolBar {
	background: red;
	border: none;
}
```

こんな感じです。

## QToolbar のデザインをカスタマイズ

完全にメモです。

[sharkpp/QToolbarCustomStyleSample](https://github.com/sharkpp/QToolbarCustomStyleSample) で利用したサンプルを公開しています。

### じゅげむったー

![QToolbar カスタマイズ：じゅげむったー](/images/2017_0716_QToolbar_customize_Jugemutter.png)

```css
QToolBar {
	background: qlineargradient(spread:pad, x1:0, y1:0, x2:1, y2:0, stop:0 rgba(54, 54, 67, 255), stop:1 rgba(84, 84, 104, 255));
	border: none;
	icon-size: 48px;
}
QToolButton {
	background: transparent;
	padding: 2px;
	margin: 0;
	spacing: 0;
	border: none;
	width: 56px;
	height: 48px;
}
QToolButton:checked {
	background-color: qlineargradient(spread:pad, x1:0, y1:0, x2:1, y2:0, stop:0 rgba(13, 13, 16, 255), stop:1 rgba(33, 33, 41, 255));
}
QToolButton:hover, QToolButton:checked:hover {
	background-color: rgb(96, 96, 96);
}
QToolButton:pressed {
	background-color: rgb(64, 64, 64);
}
```

### Qt Creator 風

あくまで、Qt Creator 風です。
選択時にアイコンの色が変わるとかその辺りは実装できていません。

![QToolbar カスタマイズ：Qt Creator 風](/images/2017_0716_QToolbar_customize_QtCreatorLike.png)

```css
QToolBar {
	background: #444;
	border: none;
    icon-size: 24px;
	padding: 0;
	margin: 0;
	spacing: 0;
}
QToolBar QToolButton {
	background: transparent;
	border: none;
    width: 70px;
	padding: 4px;
	margin: 0;
	spacing: 0;
    color: #fff;
}
QToolBar QToolButton:checked,
QToolBar QToolButton:pressed {
    background: #282828;
}
```

## 参考

* [Qtアプリのサンプル - Qiita](http://qiita.com/false-git@github/items/cbda9ddaaac5b6c81427)
* [Setting the Application Icon | Qt 5.8](http://doc.qt.io/qt-5/appicon.html)
* [Window Flags Example | Qt Widgets 5.8](http://doc.qt.io/qt-5/qtwidgets-widgets-windowflags-example.html)
* [Qt Namespace #WindowType-enum | Qt Core 5.8](http://doc.qt.io/qt-5/qt.html#WindowType-enum)
* [About Sheets](https://developer.apple.com/library/content/documentation/Cocoa/Conceptual/Sheets/Concepts/AboutSheets.html)
* [[Solved] Resize QDialog to fit all contents? | Qt Forum](https://forum.qt.io/topic/33448/solved-resize-qdialog-to-fit-all-contents/9)
* [How to stop child widgets from inheriting parent's StyleSheet and use system default?](http://www.qtcentre.org/threads/14099-How-to-stop-child-widgets-from-inheriting-parent-s-StyleSheet-and-use-system-default)
* [c++ - Connecting overloaded signals and slots in Qt 5 - Stack Overflow](https://stackoverflow.com/questions/16794695/connecting-overloaded-signals-and-slots-in-qt-5)
* [[QTBUG-12717] Background color for QToolBar is not stylable on Mac - Qt Bug Tracker](https://bugreports.qt.io/browse/QTBUG-12717)
