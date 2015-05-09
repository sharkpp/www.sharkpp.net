---
title: "木目パターンの生成: HSPで遊ぶ 其の１"
tags: [hsp, HSPで遊ぶ]
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

<a href="http://www.sharkpp.net/public/images/2009_1011_wood_pattern.jpg" rel="lytebox#2009_1011_wood_pattern" title="2009_1011_wood_pattern.jpg" ><img src="http://www.sharkpp.net/public/images/2009_1011_wood_pattern.png" alt="2009_1011_wood_pattern.png" /></a>

これだからプログラムはいいですね