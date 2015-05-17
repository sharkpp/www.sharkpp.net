---
title: "ANSI Escape Sequences Emulator作ったよ"
tags: [develop, C++]
categories: [blog]

---

ふと思いついて、ANSIエスケープシーケンスエミュレータなるものを作ってみました。

ソースは [sharkpp/AnsiEscapeSequencesEmulator - GitHub][1] に公開してあります。

 [1]: https://github.com/sharkpp/AnsiEscapeSequencesEmulator

バイナリも出来ます→[ダウンロード][2]

 [2]: /soft/tool/aese_20130310_r2402.zip

まずは、百聞は一見にしかずです。

↓が、

[![aese適用前][3]][4]

 [3]: /images/2013_0310_aese_before_s.png
 [4]: /images/2013_0310_aese_before.png

↓になります。

[![aese適用後][5]][6]

 [5]: /images/2013_0310_aese_after_s.png
 [6]: /images/2013_0310_aese_after.png

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