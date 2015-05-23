---
title: "HSPLetについて"
date: 2008-09-02 01:35:00
tags: [HSP, HSPlet]
categories: [blog]

---

1ヶ月ぐらい前の記事だけどfujidigさんの所でHSPLetの挙動について書かれていたのでトラックバックのテストついでに書いてみる。

[HSPLet あれこれ][1]

 [1]: http://d.hatena.ne.jp/chaperatta/20080805/1217938231

このコードを実行するとHSP 3.1とHSPLetで挙動が違う

<pre>#runtime "hsplet3"
a = 0, 1, 3, 4, 5, 6
dim b, 6
mes "length(a)=" + length(a)
mes "length(b)=" + length(b)
</pre>

HSP 3.1

<pre>length(a)=6
length(b)=6
</pre>

HSPLet 3.0 

<pre>length(a)=16
length(b)=6
</pre>

どうもdimで初期化せずに代入すると最低16は配列の要素が確保されてしまうようで、foreachで変数を処理するとHSPではエラーが出ずにHSPLetでエラーが出てしまうことがある。

HSPLetもメンテとかしてみたい気はするが取り敢えず他ごと優先でいきたいと思います。