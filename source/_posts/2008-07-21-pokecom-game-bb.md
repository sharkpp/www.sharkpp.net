---
title: "BlockBreak"
date: 2008-07-21 00:00:00
tags: [ポケコン]
categories: [ポケコン, ポケコン用ゲーム]

---

## 画面


![動作画面][1] 

 [1]: /images/bb.gif

## ルール・ゲームの説明

言わずとしてたブロック崩しです
  


まず、プログラムを実行すると、"BLOCK BREAK" の文字がアニメーションするのでスペースキーなどを押してください
	  
ボールが上に動き出しゲームスタートです。
	  
ボールをブロックに当て壊してください
	  
ブロックを全部壊すか、ゲームオーバーになると終了します 

**アイテム**
	  
ブロックに当てるとたまに、当てた部分からアイテムが降ってくることがあります
	  
アイテムは、バーに当てると取ることが出来き、取れた場合は得点の下に取ったアイテムが表示されます
	  
アイテムには４種類あります 

<table summary="アイテムの種類"><tr>
<td>
SCORE+
</td>
<td>
得点が加算されます
</td>
</tr>
<tr>
<td>
<small>○</small> UP
</td>
<td>
画面内のボールが１つ増えます
</td>
</tr>
<tr>
<td>
<<->>
</td>
<td>
バーが広がります
</td>
</tr>
<tr>
<td>
>>-<<
</td>
<td>
バーが縮みます
</td>
</tr>
</table>

## 操作説明

←キーで左
	  
→キーで右にバーが動きます 

## 動作環境

![C言語][2]プログラム
	  
PC-G850Sで動作確認済み 

 [2]: ../image/c.gif

## プログラム

[DOWNLOAD][3] : bb.txt
	  
※さらに以下のファイルが必要です
  


 [3]: /pokecom/game/bb.txt "bb.txt"

[DOWNLOAD][4] : inkey.h
	  
[DOWNLOAD][5] : rand.h
	  
※ポケコンでは拡張子を .h として保存してください。
  


 [4]: /pokecom/game/../program/inkey.h "inkey.h"
 [5]: /pokecom/game/../program/rand.h "rand.h"

[DOWNLOAD][6] : Winows版デモ
	  
<span>※同梱の Readme.txt をよく読んでください
</span> 

 [6]: /pokecom/game/bb.zip "bb.zip(Winows版デモ)"

[DOWNLOAD][7] : ポケコン風ダンプリスト
  


 [7]: /pokecom/game/bb_.txt "bb_.txt"

## 履歴

2004/12/19
: 公開<br />Windows版デモプログラム公開

2005/05/05
: ダンプリスト追加
