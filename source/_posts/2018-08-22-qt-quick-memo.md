---
layout: post
title: "Qt Quick メモ"
date: 2018-08-22 00:40
tags: [C++, Qt, 雑記, QtQuick]
categories: [ブログ]

---

[sharkpp/qtauthwith](https://github.com/sharkpp/qtauthwith) を実装中に調べメモした、 Qt Quick 関連の事をとりあえず記事にしました。

## ListView タイプの特定項目へスクロールする

```javascript
    listView.currentIndex = index
```

のような感じでインデックスを代入すればスクロールする

## GridLayout と Grid

`GridLayout` は `Layout.row` と `Layout.column` が効く。

`Grid` は `Layout.row` と `Layout.column` が効かない。

## モデルをテーブル上に並べる

```javascript
[
    { foo: XXX1, bar: YYY1 },
    { foo: XXX2, bar: YYY2 }
]
```

を返すモデルが例。

```javascript
import QtQuick.Layouts 1.11
         :
    GridLayout {
        id: grid
        anchors.fill: parent
        columns: 2
        rowSpacing: 5
        columnSpacing: 5
        anchors.margins: 5

        Repeater {
            model: hoge // [ { foo: XXX1, bar: YYY1 }, { foo: XXX2, bar: YYY2 } ]
            Label {
                Layout.row: index
                Layout.column: 0
                text: modelData.foo
            }
        }

        Repeater {
            model: hoge
            TextArea {
                Layout.row: index
                Layout.column: 1
                text: modelData.bar
            }
        }
    }
```

## QMLで定数を利用する

定数が大量にある場合は

```javascript
// hoge.js
var xxx = "aa";
var yyy = "bb";
```

と登録したソースを import して

```javascript
// fuga.qml
import "hoge.js" as Hoge
          :
        Label {
            text: Hoge.xxx
        }
        Label {
            text: Hoge.yyy
        }
          :
```

のような感じで利用すると管理が楽そう。
他の QML で使い回すならなおさら。

## qml側から呼び出す関数の引数にオブジェクトを渡した場合の動き

```javascript
// xxx.qml
   var xxx = { aa: 10, bb: "bb" };
   hoge(xxx);
```

と QML 側で C++ で定義した関数を呼び出す場合は

```cpp
#include <QJSValue>
            :
   Q_INVOKABLE void hoge(const QJSValue& abc);
```

という関数定義にする必要がある。

## qml で空っぽのオブジェクトを定義する

```javascript
Item {
    property var badSyntax:   {}   // ng, empty block statement
    property var emptyObject: ({}) // ok
}
```

その他の JavaScript 標準な型のプロパティを定義

```javascript
Item {
    property var aNumber: 100
    property var aBool: false
    property var aString: "Hello world!"
    property var anotherString: String("#FF008800")
    property var aColor: Qt.rgba(0.2, 0.3, 0.4, 0.5)
    property var aRect: Qt.rect(10, 10, 10, 10)
    property var aPoint: Qt.point(10, 10)
    property var aSize: Qt.size(10, 10)
    property var aVector3d: Qt.vector3d(100, 100, 100)
    property var anArray: [1, 2, 3, "four", "five", (function() { return "six"; })]
    property var anObject: { "foo": 10, "bar": 20 }
    property var aFunction: (function() { return "one"; })
}
```

## 参考

* [qt - Populate GridLayout with Repeater - Stack Overflow](https://stackoverflow.com/questions/32969414/populate-gridlayout-with-repeater)
* [QML(Qt)アプリ全体で使いたいグローバルな設定値の扱い方 - 理ろぐ](http://relog.xii.jp/mt5r/2011/10/qmlqt-9.html)
* [var QML Basic Type | Qt QML 5.11](http://doc.qt.io/qt-5/qml-var.html#property-value-initialization-semantics)
