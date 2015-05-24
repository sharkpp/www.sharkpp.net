---
title: "memfile.hpi"
date: 2008-08-15 01:03:00
tags: [HSP]
categories: [HSP, HSPプラグイン]

---

## プラグインの説明

HSP 3.1以降用のファイル読み込みフックプラグインです。
	  
プラグインやDLLが行うファイルの読み込みをフックして実際のデータの読み込みをメモリ上から行うようにするプラグインです。
	  
たとえば、<del title="出来ません">MIDIをEXEにパックして再生を行うことや</del>Easy3DでモデルデータをEXEに埋め込むことも出来ます。
	  
が、実用には程遠いでしょう。
	  
なお<span class="warning">このプラグインについての動作保障はありませんし今後する予定もありません。</span> 

## 動作環境

HSP 3.1 以降
	  
Windows XP/Vista(2000は未検証) 

## ファイル

  * memfile.hpi - プラグインファイル
  * memfile.as - プラグインヘッダファイル
  * readme.txt - 最初に読むファイル
  * sample 
      * sample1.hsp - 基本的なサンプル
      * sample2.hsp - 【実行不可】MIDIのバッファからの再生サンプル
      * sample3.hsp - 【実行不可】PNGのメモリからの読み込みサンプル
      * sample4.hsp - GIFのメモリからの読み込みサンプル
      * sample5.hsp - oggのメモリからの読み込みサンプル
      * sample6.hsp - Easy3Dのモデルデータ・テクスチャのメモリからの読み込みサンプル

## ダウンロード

[DOWNLOAD][1] 

 [1]: /hsp/plugin/memfile001.zip

## 履歴

2008/08/17
: 公開
