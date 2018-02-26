---
layout: post
title: "Qt 用の QDialog をベースとした吹き出し型のウィジェット"
date: 2018-02-27 01:01
tags: [Qt, OS X, macOS]
categories: [ブログ]

---

とりあえず、ネタがないので先日に公開した [Popover - QDialog base balloon shape widget](https://github.com/sharkpp/qtpopover) の紹介。

## 何ができる？

![スクリーンショット](/images/20180227_qtpopover.png)

こんな感じの切り欠き付きのポップアップが簡単に実装できます。

[NSPopover](https://developer.apple.com/documentation/appkit/nspopover) みたいなやつ。

## どこで利用できる？

現状は macOS しか動作の確認をしてないです。
もしかしたら Windows とか Linux でも動作するかも？

## どうやって使う？

使い方は、

* ソースを組み込んで利用(a)
* ライブラリとしてビルドして利用(b)

の２種類です。

組み込みのサンプルは [master/examples - qtpopover](https://github.com/sharkpp/qtpopover/tree/master/examples) あたりに。

### 環境例

|項目|内容|
|-|-|
|アプリケーション名|test|
|ライブラリフォルダ|`libs`|

### 1)ソースを取得

```console
# git submodule add git@github.com:sharkpp/qtpopover.git libs/qtpopover
# git submodule update
```

### 2a)ソースを取り込む

#### 2a.1)プロジェクトファイル(`.pro`)を変更

アプリケーションの `.pro` を変更する。
プロジェクトインクルードファイル（？）を追加します。

変更例

```diff
+ # You can also select to disable deprecated APIs only up to a certain version of Qt.
+ #DEFINES += QT_DISABLE_DEPRECATED_BEFORE=0x060000    # disables all the APIs deprecated before Qt 6.0.0
+
+ include(./libs/qtpopover/sources/popover.pri)
+
+ SOURCES += \
+         main.cpp \
+         mainwindow.cpp \
```

### 2b)ライブラリを取り込む

#### 2b.1)ライブラリをビルド

`./libs/qtpopover/popover.pro` を `Qt Creator` で開きビルドする。

#### 2b.2)プロジェクトファイル(`.pro`)を変更

アプリケーションの `.pro` を変更する。

`POPOVER_USE_STATIC_LIB=1` とプロジェクトインクルードファイル（？）を追加します。

変更例

```diff
+ # You can also select to disable deprecated APIs only up to a certain version of Qt.
+ #DEFINES += QT_DISABLE_DEPRECATED_BEFORE=0x060000    # disables all the APIs deprecated before Qt 6.0.0
+
+ POPOVER_USE_STATIC_LIB=1
+ include(./libs/qtpopover/sources/popover.pri)
+
+ SOURCES += \
+         main.cpp \
+         mainwindow.cpp \
```

### 3)`QDialog` ベースのクラスを作る。

### 4)ソースの変更

変更例

```cpp
  #include <QApplication>
  
  TaskTrayPopup::TaskTrayPopup(QWidget *parent)
-     : QDialog(parent)
+     : Popover(parent)
      , ui(new Ui::TaskTrayPopup)
  {
      ui->setupUi(this);
```

### 5)ヘッダの変更

変更例

```cpp
  #ifndef TASKTRAYPOPUP_H
  #define TASKTRAYPOPUP_H
  
+ #include "popover.h"
  
  namespace Ui {
  class TaskTrayPopup;
  }
  
  class TaskTrayPopup
-         : public QDialog
+         : public Popover
  {
      Q_OBJECT
  
```

## なぜ作った？

いろんなところで利用できそうな Qt のクラス作ったけど、簡単に利用できる方法がないかなと、捏ねくり回して作って見ました。

どこかに、`npm i HOGE` とか `composer require HOGE` みたいに手軽に利用できる Qt の標準的なパッケージの仕組みはないものですかね。
