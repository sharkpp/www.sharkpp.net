---
title: "除夜の鐘をブログパーツにしてみた"
date: 2015-12-31 12:00
tags: [除夜の鐘, 季節物, 大晦日, HSP, HTML5, JavaScript]
categories: [ブログ]

---

この季節の風物詩、「除夜の鐘」がブログパーツになって帰ってきた！

ってな感じの更新を行ったのでその紹介。

HSPDish.js そのままでブログパーツにしたので、この程度なら書き直したほうが早いかも、、、と思わなくもない。

## 簡単な紹介

除夜の鐘をつくだけのプログラムです。

表示されている鐘をクリックします。

すると、煩悩が「ゴ～ン」という音とともに消えて行くことでしょう。

## 使い方

すぐに表示させる場合は、このような感じ。

```html
<iframe src="https://sharkpp.github.io/joya_no_kane/widget.html"
　　　　　width="128" height="128" frameborder="0" scrolling="no"></iframe>
```

<iframe src="https://sharkpp.github.io/joya_no_kane/widget.html"
        width="128" height="128" frameborder="0" scrolling="no"></iframe>

<i class="fa-solid fa-triangle-exclamation"></i> ランタイムやリソースを含めたサイズの合計が 1MB 程度あるので注意が必要です。

## その他リンク

<ul class="fa-ul">
<li><span class="fa-li"><i class="fa-solid fa-arrow-up-right-from-square"></i></span><a href="https://github.com/sharkpp/joya_no_kane">ソースコード</a></li>
<li><span class="fa-li"><i class="fa-solid fa-arrow-up-right-from-square"></i></span><a href="http://sharkpp.github.io/joya_no_kane/">GitHubページ</a></li>
<li><span class="fa-li"><i class="fa-solid fa-arrow-up-right-from-square"></i></span><span href="http://hsproom.me/program/view/?p=146" style="    text-decoration: line-through; color: gray;">HSP部屋(β)</span></li>
<li><span class="fa-li"><i class="fa-solid fa-download"></i></span><a href="/files/bells100.zip">Windows版ダウンロード</a></li>
<li><span class="fa-li"><i class="fa-solid fa-download"></i></span><a href="https://github.com/sharkpp/joya_no_kane/zipball/master">HTML/ブログパーツ版ダウンロード</a></li>
</ul>

## 参考

* [TEST CORDING » GithubからJavaScriptを読み込み時は専用のドメインから！](http://testcording.com/?p=1259)
* <del>[ヘルプ - HSP部屋(β)](https://web.archive.org/web/20201101170951/http://hsproom.me/help/#ブログパーツ)</del>
* [HSP3Dish WebGL/JavaScript版(hsp3dish.js)プログラミングガイド](http://www.onionsoft.net/hsp/v34/doclib/hsp3dish_js.htm)



