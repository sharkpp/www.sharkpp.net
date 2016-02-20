---
title: "Sculpin で投稿カレンダー(年/月)を作る方法"
date: 2016-02-20 22:29
tags: [Sculpin, Twig, Tips, Snippet]
categories: [Sculpin]

---

[Sculpin](http://sculpin.io/) で、はてなダイアリー&trade;のような、年/月 カレンダーを表示したいと思ったので作ってみました。

![年/月カレンダー](/images/2016_0220_year_month_calendar.png)

みたいな感じです。

## まずは

posts へのアクセスが必要になるので、コードを書きこむファイルには

```yaml
use:
    - posts
```

と、 posts へのアクセスができるように宣言が必要です。

{% verbatim %}
```twig
{% for post in data.posts %}
   :
{% endfor %}
```
{% endverbatim %}

そうすることで、 `data.posts` で記事全部にアクセスすることができます。

## 実装

わかりやすいように [commit:f579cde9ea1c630ba9aa18b883ff26baf4d4ef54](https://github.com/sharkpp/www.sharkpp.net/commit/f579cde9ea1c630ba9aa18b883ff26baf4d4ef54) からコメントを追加したり、削ったりしているけどだいたいこんな感じ。

{% verbatim %}
```twig
{%   set post_ym = post.date|date("Y-m") %}
{%   set ym_posts = ym_posts|merge({ (post_ym): 1 }) %}
{# ついでに、記事の最初と最後の日付を覚える #}
{%   if min_posts is empty or post_ym < min_posts %}{% set min_posts = post_ym %}{% endif %}
{%   if max_posts is empty or max_posts < post_ym %}{% set max_posts = post_ym %}{% endif %}
{% endfor %}
{# カレンダー構築：年×月でループを回し、記事の範囲外の日付は表示しないようにする #}
{% for y in range((max_posts|slice(0,4)), min_posts|slice(0,4)) %}
<a href="{{ site.url }}/blog/{{ y }}/">{{ y }}</a>
{%   for m in 1..12 %}
{%     set ym = "%04d-%02d"|format(y, m) %}
{%     if min_posts <= ym and ym <= max_posts %}
{%       if not ym_posts[ym] is empty %}
| <a href="{{ site.url }}/blog/{{ y }}/{{ "%02d"|format(m) }}/">{{ "%02d"|format(m) }}</a>
{%       else %}
| <del class="text-muted">{{ "%02d"|format(m) }}</del>
{%       endif %}
{%     else %}
| {{ "%02d"|format(m) }}
{%     endif %}
{%   endfor %}
<br />
{% endfor %}
```
{% endverbatim %}

最終的にこんな表示になりました。

![年/月カレンダー](/images/2016_0220_year_month_calendar.png)

これ自体のコードは [www.sharkpp.net/archive_histories.html at master · sharkpp/www.sharkpp.net](https://github.com/sharkpp/www.sharkpp.net/blob/master/source/_includes/archive_histories.html) を参考にしてみてください。

## おまけ

実は、最初に作った[コード](https://github.com/sharkpp/www.sharkpp.net/commit/81f8614d5f4ab8f12035e497a3251d120bc928ff)は、あまりにも処理時間がかかり、そもそもホムペが更新できない状態になっていました。
なので、再度作り直した結果、まあ、とりあえず動くものができた感じ。

### 何が問題だったか？

とりあえず、

![年/月カレンダーサンプル](/images/2016_0220_year_month_calendar_sample.png)

みたいな表示のカレンダーを表示したい、といったことを思いついて、実装してみる。

その結果、出来上がったのがこちら。
だたし、使えない。

[commit:81f8614d5f4ab8f12035e497a3251d120bc928ff](https://github.com/sharkpp/www.sharkpp.net/commit/81f8614d5f4ab8f12035e497a3251d120bc928ff)

コードをここにペタリンコするのは略。

これ、何が問題だったかというと、処理時間が異様に掛かってしまう、この一点が唯一、そして最大の問題でした。

簡単に計算すると、`記事数(=250程度) × (ループ１(=250程度) ＋ ループ２(=9年) × ループ３(=12ヶ月) × ループ４(=250程度) ＝ 6812500)` で一番内側のループの回数がすごいことになっていたので、それはまあ、遅くなるのも通りだろうと。

というわけで、数日は記事を書いてサーバー上で直接アップデート、をしていました。

### 再実装

もう一度、Twigの仕様などを調べ、作り直した結果がこれ。

[commit:f579cde9ea1c630ba9aa18b883ff26baf4d4ef54](https://github.com/sharkpp/www.sharkpp.net/commit/f579cde9ea1c630ba9aa18b883ff26baf4d4ef54)

今度は、`記事数(=250程度) × (ループ１(=250程度) ＋ ループ２(=9年) × ループ３(=12ヶ月) ＝ 89500)` とまだ、多いは多いですが、1/250 には減っています。
やったね！

## 参考

* [Provide {{ '{{' }} item.item.alt }} Twig syntax for getting data from $item&#091;'#item'&#093;&#091;'alt'&#093; &#091;#2160611&#093; | Drupal.org](https://www.drupal.org/node/2160611)
* [Twig for Template Designers - Documentation - Twig - The flexible, fast, and secure PHP template engine](http://twig.sensiolabs.org/doc/templates.html#variables)
* [slice - Documentation - Twig - The flexible, fast, and secure PHP template engine](http://twig.sensiolabs.org/doc/filters/slice.html)

