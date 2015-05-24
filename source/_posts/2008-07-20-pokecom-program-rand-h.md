---
title: "rand.h"
date: 2008-07-20 23:40:00
tags: [ポケコン]
categories: [ポケコン, ポケコン用プログラム]

---

<div><img src="/images/pokecom-c.gif" alt="C言語" /> <a href="/files/rand.h">DOWNLOAD</a> 2004/03/14
</div>

<div><code>rnd;</code>
: 説明　：乱数を取得します。

<dd>
引数　：なし
</dd>
<dd>
戻り値：0 ? 32767 までの乱数
</dd><code>int rand(void);</code>
: 説明　：乱数を取得します。

<dd>
引数　：なし
</dd>
<dd>
戻り値：-32768 ? 32767 までの乱数
</dd><code>void srand(unsigned);</code>
: 説明　：乱数を初期化します。

<dd>
引数　：乱数のたね
</dd>
<dd>
戻り値：なし
</dd><code>void srnd(void);</code>
: 説明　：乱数を初期化します。

<dd>
引数　：なし
</dd>
<dd>
戻り値：なし
</dd>
<dd>
<span>※ FEh 番地に乱数のたねを書き込みます。</span>
</dd>

</div>
