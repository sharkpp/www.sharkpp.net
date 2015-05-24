---
title: "TeraPad KeyWord Help Tool"
date: 2008-07-21 00:09:00
tags: [TeraPad]
categories: [ソフト, TeraPad]

---

## ソフトの説明

TeraPad でキー 一発でキーワードヘルプを呼び出し表示するソフトです
	  
このソフト単体では役に立ちませんのであしからず。 

## 使用方法

TpJumpをTeraPadへ登録する時のツール設定項目です。 

<table border="1" summary="設定項目"><tr>
<th>
名前
</th>
<td>
(お好みで)
</td>
</tr>
<tr>
<th>
実行ファイル
</th>
<td>
C:\TeraPad\tool\TpkwHelp.exe<br /><br /> ※実行ファイルのパスは解凍したフォルダを指定してください。<br /> 例. C:\Program Files\TeraPad\tool\TpkwHelp に解凍したとすると<br /> 　<span style="text-decoration: underline">C:\TeraPad\tool</span>\TpkwHelp.exe<br /> 　この部分↑に解凍したフォルダを指定します。<br /> 　C:\Program Files\TeraPad\tool\TpkwHelp\TpkwHelp.exe<br />
</td>
</tr>
<tr>
<th>
コマンドラインパラメータ
</th>
<td>
表示してほしい実行ファイルやヘルプファイルをフルパスで入力してください。※
</td>
</tr>
<tr>
<th>
作業フォルダ
</th>
<td>
(空欄)
</td>
</tr>
<tr>
<th>
ファイルの上書き保存
</th>
<td>
"上書き保存しない" を指定
</td>
</tr>
<tr>
<td colspan="2">
その他のオプションについてはお好みで設定してください。
</td>
</tr>
</table>

**コマンドラインパラメータ** 

<pre>※キーワードが有効なのは今のところ、以下のファイルです。
　●WinHelpファイル
　　Win32APIヘルプ(win32.hlp) など
　　&gt;C:\lcc32\bin\win32.hlp&lt;こんな感じ
　●実行ファイル（実行パラメータにキーワードを添付します）
　　HSP Help Manager(helpman.exe) など
　　&gt;C:\hsp255\hsphelp\helpman.exe&lt;こんな感じ
　●'*'付きファイル（'*'の所がキーワードに換えられます）
　　キーワード別に分かれたHTMLファイル(*.html) など
　　&gt;C:\win32api\*.htm&lt;こんな感じ
　※もちろん、ほんとにあるフォルダ、ファイルを指定しなければ意味はありません。
</pre>

## 動作環境

Windows 2000で動作確認済み
	  
Windows 95/98/Me, Windows XP でも動作するはず
	  
TeraPad が必要です。 

## インストール＆アンインストール

**インストール**
	  
適当なフォルダに解凍して、実行するだけです。
	  
なお、実行時に自動的に Machines フォルダがソフトと同じフォルダにできます。 

**アンインストール**
	  
解凍して出来たフォルダごと削除するだけです。設定ファイル・レジストリは一切使用しておりません。 

## プログラム

[DOWNLOAD][1]
  


 [1]: /soft/tptool/tpkwh002.lzh "tpkwh002.lzh"

## 履歴

2004/02/24
: [Ver.0.02]<br />公開
