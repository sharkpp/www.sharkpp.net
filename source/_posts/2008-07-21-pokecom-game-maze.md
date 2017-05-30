---
title: "迷路"
date: 2008-07-21 00:00:00
tags: [ポケコン]
categories: [ポケコン, ポケコン用ゲーム]
redirect:
    - /pokecom/game/maze.html
---

## 画面


![動作画面][1] 

 [1]: /images/2008_0721_maze.gif

## ルール・ゲームの説明

[Toshi's HP][2](Toshiさん)の迷路自動作成ルーチンを用いた迷路ゲームです
  


 [2]: http://www.r66.7-dj.com/~toshi1/

まず、プログラムを実行すると、Hit any key! と表示されるのでスペースキーなどを押してください
	  
すると迷路を作成しますので作成が終るまで待っていてください
  


**地図**
	  
左上にある矢印は現在の地図上での進行方向を示しています。
	  
地図上に最初から存在している白抜きの点はKEYがある場所です
	  
まず最初にここを目指してください
	  
KEYを取ると次に地図のふちのどこかに出口が現れますので<!-- 底 -->そこに到達したらゲームクリアです 

## 操作説明

↑キーで上
	  
↓キーで下
	  
←キーで左
	  
→キーで右にそれぞれ進みます
	  
スペースキーで地図を表示します
  


## 動作環境

![C言語][3]プログラム
	  
PC-G850Sで動作確認済み 

 [3]: /images/pokecom-c.gif

## プログラム

[DOWNLOAD][4] : maze.txt
	  
※さらに以下のファイルが必要です
  


 [4]: /files/maze.txt "maze.txt"

[DOWNLOAD][5] : inkey.h
	  
[DOWNLOAD][6] : rand.h
	  
※ポケコンでは拡張子を .h として保存してください。
  


 [5]: /files/inkey.h "inkey.h"
 [6]: /files/rand.h "rand.h"

[DOWNLOAD][7] : Winows版デモ
	  
<span>※同梱の Readme.txt をよく読んでください
</span> 

 [7]: /files/maze.zip "maze.zip(Winows版デモ)"

[DOWNLOAD][8] : ポケコン風ダンプリスト
  


 [8]: maze_.txt "maze_.txt"

## 履歴

2004/09/26
: 公開

2004/12/19
: Windows版デモプログラム公開

2005/05/05
: ダンプリスト追加
