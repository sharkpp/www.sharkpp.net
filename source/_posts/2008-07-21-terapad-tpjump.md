---
title: "TeraPad Jump Tool"
date: 2008-07-21 00:08:00
tags: [TeraPad]
categories: [ソフト, TeraPad]
redirect:
    - /soft/tptool/tpjump.html
---

## 画面


![画面][1] 

 [1]: /images/2008_0721_tpjump.jpg

## ソフトの説明

TeraPad Jump Tool(TpJump)は、TeraPad などに関数、ラベルを表示し、HSP 2.55さながら、ジャンプをするソフトです。 

現在対応しているジャンプ機能は以下のとおりです 

<table border="1" width="90%" summary="TpJump対応形式"><tr>
<th>
拡張子
</th>
<th>
形式名
</th>
<th>
説明
</th>
</tr>
<tr>
<td colspan="3">
cacpp.fpi
</td>
</tr>
<tr>
<td>
*.c
</td>
<td>
C
</td>
<td>
関数<br />ラベル<br />Switch() ～ case :<br />
</td>
</tr>
<tr>
<td>
*.cpp
</td>
<td>
C++
</td>
<td>
関数(スコープ解決演算子は未対応)<br />ラベル<br />Switch() ～ case :<br />
</td>
</tr>
<tr>
<td>
*.h
</td>
<td>
C ＆ C++ Header
</td>
<td>
CとC++言語の関数が書いてある場合のみ
</td>
</tr>
<tr>
<td>
*.rc
</td>
<td>
Windows Resource
</td>
<td>
リソースブロック<br />(ACCELERATORS, BITMAP, ICON, MENU, DIALOG, VERSIONINFO, STRINGTABLE)<br />
</td>
</tr>
<tr>
<td colspan="3">
txt.fpi
</td>
</tr>
<tr>
<td rowspan="2">
*.txt
</td>
<td rowspan="2">
Text
</td>
<td>
UNLHA32.DLL の"%n"形式ファイル
</td>
</tr>
<tr>
<td>
WzEditorの[表示]メニューの[アウトライン]で表示できる形式
</td>
</tr>
<tr>
<td colspan="3">
hsp.fpi
</td>
</tr>
<tr>
<td>
*.as
</td>
<td>
HSP※
</td>
<td>
#deffunc で定義した命令<br />ラベル
</td>
</tr>
<tr>
<td colspan="3">
html.fpi
</td>
</tr>
<tr>
<td>
*.htm<br />*.html
</td>
<td>
HTML
</td>
<td>
HTML のアンカータグ(href,name)
</td>
</tr>
</table>

※HSP(Hot Soup Processor) は onion software/おにたま氏 が作成された、インタプリタ型プログラミング言語です 

## 使用方法

TpJumpを設定したキー等で起動し移動先を選択することで移動することが出来ます。
	  
\[↑\]\[↓\]キーで選択、
	  
[Enter]キーで移動、
	  
[ESC]キーで戻ることが出来ます。 

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
C:\TeraPad\tool\TpJump.exe<br /><br /> ※実行ファイルのパスは解凍したフォルダを指定してください。<br /> 例. C:\Program Files\TeraPad\tool\TpJump に解凍したとすると<br /> 　<span style="text-decoration: underline">C:\TeraPad\tool</span>\TpJump.exe<br /> 　この部分↑に解凍したフォルダを指定します。<br /> 　C:\Program Files\TeraPad\tool\TpJump\TpJump.exe<br />
</td>
</tr>
<tr>
<th>
コマンドラインパラメータ
</th>
<td>
(空欄)
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

## 注意事項

  * 大きいファイルの場合は、少し時間がかかる場合があります。
  * 折り返し桁指定で、折り返しを指定していると、ジャンプ先に命令などが無い場合があります。
  * あまりにも大きいファイル(正確には64K Byte 以上)だと正確にジャンプ出来ない可能性があります。
  * Inprise 系プログラミング環境(Borland Delphi や Borland C++ など)で作られたエディタは、 タスクバーとウインドウが別になっていて無理やり表示しようとするとタスクバーの表示と 食い違いが出てしまうので非表示や最小化になっているウインドウは無視するようにしています。
	  
    TeraPad,K2Editor,鍋Editor がそのようなエディタです

## 動作環境

Windows 2000で動作確認済み
	  
Windows 95/98/Me, Windows XP でも動作するはず
	  
TeraPad が必要です。 

## インストール＆アンインストール

**インストール**
	  
適当なフォルダに解凍して、実行するだけです。
	  
なお、実行時に自動的に Machines フォルダがソフトと同じフォルダにできます。 

**アンインストール**
	  
解凍して出来たフォルダごと削除するだけです。レジストリは一切使用しておりません。 

## プログラム

[DOWNLOAD][2]
  


 [2]: http://www.vector.co.jp/soft/win95/writing/se320394.html "tpjp010d.lzh"

## 履歴

2004/02/29<br />(03/02公開)
: [Ver.0.10d]<br />公開
