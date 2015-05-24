---
title: "Lhaplus x64 shell extension"
date: 2009-08-23 16:31:00
categories: [ソフト, ツール]

---

### ソフトの説明

DLLなし圧縮・解凍ソフト [Lhaplus][1] の 64bit版Windows用シェル拡張です。

 [1]: http://hoehoe.com/

Lhaplus標準のシェル拡張では32bi版Windows用しか対応しておらず、残念な思いをしていたので作りました。

### ダウンロード

[DOWNLOAD][2]

 [2]: /soft/x64/LplsShlx64-v1.0.1.0.zip "LplsShlx64-v1.0.1.0.zip"

### インストール

  * 任意のフォルダに解凍して install.cmd を実行してください。
  * ※Lhaplusのインストール先はレジストリから取得します。
  * ※インストール時には管理者権限が必要です。  
    　Windows Vista 以降の場合、右クリックメニューの「管理者として実行」から実行してください。
  * ※アップデートを行う場合は、一旦アンインストール後、DLLなどを削除した後に行ってください。  
    　アンインストールを行わずにアップデートすると、DLLのコピーに失敗します。

### アンインストール

  * uninstall.cmd を実行しDLLなどを再起動後に削除してください。
  * ※アンインストール時には管理者権限が必要です。  
    　Windows Vista 以降の場合、右クリックメニューの「管理者として実行」から実行してください。

### 動作確認環境

PC　: 自作PC

OS　: Windows XP Professional x64 Edition Version 5.20.3790 SP2

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Windows 7 Ulitimate x64 Edition Version 6.1.7100 RC1

App : Lhaplus 1.57

以上の環境で動作を確認しました。

### 更新履歴

  * 1.0.0.0 2009-08-23　ほしい機能が実装できたのでリリース
  * 1.0.1.0 2009-11-25　フォルダツリー/ナビゲーションウィンドウを表示している場合にメニュー項目が表示されていなかった問題を修正
