---
title: "PuTTY command line interface proxy for TeraTerm"
date: 2009-07-24 01:04:00
categories: [ソフト, ツール]

---

### ソフトの説明

[WinSCP][1]のPuTTY呼び出しボタンで[TeraTerm][2]を呼び出せるようにする、中継アプリです。

 [1]: http://winscp.net/
 [2]: http://ttssh2.sourceforge.jp/

### プログラム

[DOWNLOAD][3]

 [3]: /soft/tool/PuTTYdummy-v0.1.0.1.zip "PuTTYdummy-v0.1.0.1.zip"

### インストール

  * TeraTermのインストール先フォルダに入れてください。
  * WinSCPの「環境設定」→「統合」→「アプリケーション」のPuTTYのパスにこのアプリを指定してください。  
    TeraTermをデフォルトでインストールしている場合は、"C:\Program Files\teraterm\PuTTYdummy.exe" となると思います。

### アンインストール

  * WinSCPの設定をリセットし、PuTTYdummy.exeを削除してください。

### 動作確認環境

PC　: 自作PC

OS　: Microsoft Windows XP(x64) Version 5.20.3790 SP2

Appl: WinSCP 4.1.9 / TeraTerm 4.63

以上の環境で動作を確認しました。

### 更新履歴

  * 0.1.0.0 2009-07-24　ほしい機能が実装できたのでリリース
  * 0.1.0.1 2009-07-25　バージョンリソース追加・UPXで圧縮
