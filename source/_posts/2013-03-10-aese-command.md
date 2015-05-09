---
title: "ANSI Escape Sequences Emulator作ったよ"
tags: [develop, C++]
categories: [blog]

---

ふと思いついて、ANSIエスケープシーケンスエミュレータなるものを作ってみました。

ソースは [sharkpp/AnsiEscapeSequencesEmulator - GitHub][1] に公開してあります。

バイナリも出来ます→[ダウンロード][2]

まずは、百聞は一見にしかずです。

↓が、

<a href="/public/images/2013_0310_aese_before.png" rel="lytebox[x2013_0310]" title="aese適用前"><img src="/public/images/2013_0310_aese_before_s.png"  alt="aese適用前" /></a>

↓になります。

<a href="/public/images/2013_0310_aese_after.png"  rel="lytebox[x2013_0310]" title="aese適用後"><img src="/public/images/2013_0310_aese_after_s.png" alt="aese適用後" /></a>

いやほんと、ぱっと思いついてさくっと作った割にはうまく動いてくれていい感じです。

以下、READMEからです。

## 何が出来る？

Windows標準のターミナル、いわゆる、「コマンドプロンプト」は、ANSIエスケープシーケンスをサポートしていません。

aeseコマンドは Windows API でANSIエスケープシーケンスを再現します。

下記の機能を実装しています。

  1. 標準出力を受け取りエスケープシーケンスを取り除く
  2. 文字属性の再現(部分的)
  3. カーソルの移動の再現(未実装)

## 使い方

    echo ^[[43maaa^[[0m|aese
    

^[ は CTRL + [ と入力します。コードは 0x1B です。

 [1]: https://github.com/sharkpp/AnsiEscapeSequencesEmulator
 [2]: http://www.sharkpp.net/soft/tool/aese_20130310_r2402.zip