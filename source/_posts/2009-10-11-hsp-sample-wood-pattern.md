---
title: "木目パターンの生成: HSPで遊ぶ 其の１"
date: 2009-10-11 22:48:00
tags: [HSP, HSPで遊ぶ]
categories: [blog]

---

今回はHSPのスクリプトです。

あるソフトで使いたかったので試しに作ってみたら意外とそれらしいのができました。

<pre>hsvcolor 26,49,246
boxf
sx = ginfo_winx
sy = ginfo_winy
repeat 256
hsvcolor 26,49,246+rnd(20)-10
y=rnd(sy)
y1=y+rnd(30)-15
y2=y+rnd(30)-15
repeat 1+rnd(3)
line 0,y1+cnt,sx,y2+cnt
loop
loop
</pre>

こんなのが出来ます。

[![2009_1011_wood_pattern.png][1]][2]

 [1]: /images/2009_1011_wood_pattern.png
 [2]: /images/2009_1011_wood_pattern.jpg

これだからプログラムはいいですね