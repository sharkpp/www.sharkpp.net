---
title: "File Drop Buffer をリリースしました"
date: 2016-07-31 23:00
tags: [Qt, リリース]
categories: [ブログ]

---

Qt を利用し、[FileDropBuffer](https://github.com/sharkpp/FileDropBuffer) というソフトを作ってみました。

ダウンロードは [GitHub リリースページ](https://github.com/sharkpp/FileDropBuffer/releases) からどうぞ。

基本機能自体は Qt に実装済みのものを利用したので、プロトタイプはできるのが早かったですが、アイコンつけたり背景を設定したりに時間がかかりました。

## これはなに？

通常は、ファイルのドラッグ ＆ ドロップは、一度しかできないですが、このソフトに溜め込むことで、複数の操作が一度にできるようになります。

例えば、

* ファイルをドロップして形式を変換するコンバータがあるとして、別々のフォルダにあるファイルを一度に変換できる。
* 複数のフォルダのファイルを一度に別のフォルダにコピーや移動できる。

など、です。

## ダウンロード

|OS|リンク|
|-|-|
|Windows|[FileDropBuffer-win-0.1.0.zip](https://github.com/sharkpp/FileDropBuffer/releases/download/v0.1.0/FileDropBuffer-win-0.1.0.zip) ※ GitHub|
|OS X (macOS)|[FileDropBuffer-mac-0.1.0.dmg](https://github.com/sharkpp/FileDropBuffer/releases/download/v0.1.0/FileDropBuffer-mac-0.1.0.dmg) ※ GitHub|

## インストール

ファイルを解凍するだけで実行できます。

解凍した中にできている `File Drop Buffer` というアプリケーションを実行してください。

## アンインストール

レジストリや設定ファイルなどは利用していないので、フォルダごと削除するだけです。

## 使い方

まず、ファイルをこのソフトの `Drop file here` と書かれている部分にドロップします。

![ファイルのドロップ](/images/2016_0731_FileDropBuffer_droping.png)

何回かファイルをドロップし終えたら、アプリケーションの中央に表示されているファイルアイコンをドラッグし、目標とするアプリケーションへドロップします。

![ファイルのドラッグ](/images/2016_0731_FileDropBuffer_draging.png)

その他の機能は

* 右下のゴミ箱ボタンは、保持しているファイルの一覧をクリア
* その隣のボタンは、アプリケーションの最前面解除＆設定


