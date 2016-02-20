---
title: "Sculpin で自動的に「続きを見る」リンクを作る方法"
date: 2015-12-29 23:00
tags: [Sculpin, Twig, php, Tips, Snippet]
categories: [Sculpin]

---

なんか、 [Sculpin](http://sculpin.io/) の日本語情報が圧倒的に少ない気がするのでTipsを投下してみます。

このサイトで使っている自動的に「続きを見る」リンク

![「続きを見る」リンク](/images/2015_1229_more_link.png)

のような感じのリンクを作る方法です。

## 方向性

方向性としては、

```md
じゅげむと、いろは歌は、、、、
ほげふが

## じゅげむ

寿限無寿限無、、、

## いろは歌

色はにほへど　散りぬるを 、、、、

```

と、

1. 最初のセクション(`じゅげむと、いろは歌は、、、、`の部分)
2. レベル２ヘッダ(`じゅげむ`の部分)
3. セクション(`寿限無寿限無、、、`の部分)
4. 以下続き

のような感じの投稿内容から

```html
じゅげむと、いろは歌は、、、、
ほげふが

<a href="...">... 続きを見る</a>
```

のように、最初のセクションを抜き出し、「続きを見る」リンクを作るようにします。

## 準備

うちのホムペは [sculpin/sculpin-blog-skeleton](https://github.com/sculpin/sculpin-blog-skeleton) ベースなので、これをベースとして直していく感じになります。

そうでない場合は、適時読み替えてください。

まず Twig で、`preg_XXX` 系が利用できるようになる拡張をインストールします。

利用するのは、[jasny/twig-extensions](https://packagist.org/packages/jasny/twig-extensions) です。

`app/config/sculpin_services.yml` に追記 or なければ作成し、Twig 拡張を利用できるようにします。

```diff
+ services:
+     twig.extension.text:
+         class: Twig_Extensions_Extension_Text
+         tags:
+             - { name: twig.extension }
+     twig.extension.pcre:
+         class: Jasny\Twig\PcreExtension
+         tags:
+             - { name: twig.extension }
```

`sculpin.json` に

```diff
          "components/jquery": "~1.9.1",
-         "components/highlightjs": "~7.3.0"
+         "components/highlightjs": "~7.3.0",
+         "jasny/twig-extensions": "@dev"
      },
      "config": {
```

`jasny/twig-extensions` を追加し

```
$ php sculpin.phar install
```

のようにしてインストール。

## 作成

やっていることは驚くほど簡単です。

`source/index.html` がトップページ用のテンプレートですが、

```diff
         </header>
          <div>
-             {{ '{{' }} post.blocks.content|raw }}
+             {{ '{{' }} post.blocks.content|preg_replace('!^(.+?)(<h.*)?$!sm', '$1') | raw }}
+             {{ '{%' }} if post.blocks.content|preg_replace('!^(.+?)(<h.*)?$!sm', '$1') != post.blocks.content %}
+                 &hellip;&nbsp;<a href="{{ site.url }}{{ post.url }}">続きを見る</a>
+             {{ '{%' }} endif %}
          </div>
          <hr />
```

と、このような感じにスケルトンから変更します。

やっていることは、

1. 生成済みコンテンツ(`post.blocks.content`) に対して、最初のヘッダタグの直前までを抜き出す
1. 「続きを見る」リンク追加、ただし、コンテンツが省略されていないこと。

と、すごく単純なことです。

これの肝は、最初のセクションにはヘッダタグがない、ということで、これはレベル１のヘッダタグとしてページタイトルが別になるようにしてあるためなので、違う構造であれば試行錯誤は必要ですが、うまいこと正規表現を変えて対応できると思います。

## 結果

![「続きを見る」リンク](/images/2015_1229_more_link2.png)

やったね！

## 参考

* [sharkpp/www.sharkpp.net@98c87d0](https://github.com/sharkpp/www.sharkpp.net/commit/98c87d045e04da9717cd5a30f650aea9dc373096)
* [How to Write a custom Twig Extension (The Symfony CookBook)](http://symfony.com/doc/current/cookbook/templating/twig_extension.html#register-an-extension-as-a-service)
* [jasny/twig-extensions](https://github.com/jasny/twig-extensions)
