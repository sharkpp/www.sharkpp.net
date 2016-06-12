---
title: "Sculpin でリダイレクトページを生成する Sculpin Redirect Bundle を使ってみた"
date: 2016-06-12 13:01
tags: [ Sculpin, php, Composer ]
categories: [ブログ]

---

GitHub Pages にホムペを移行させようと考えていたけど、 [Redirects on GitHub Pages](https://help.github.com/articles/redirects-on-github-pages/) を見ると

> For the security of our users, GitHub Pages does not support customer server configuration files such as .htaccess or .conf.
> 訳：ユーザーの皆様の安全のために、GitHub Pages は、.htaccess ファイルや .conf のような顧客のサーバ設定ファイルをサポートしていません。

って記載があるので、ページのリダイレクトを GitHub Pages ではできないのかって思ってたけど、すぐ後に

> using the [Jekyll Redirect From plugin](https://github.com/jekyll/jekyll-redirect-from), you can automatically redirect visitors to the updated URL.
> 訳：[Jekyll Redirect From プラグイン](https://github.com/jekyll/jekyll-redirect-from)を使用して、更新された URL への訪問者を自動的にリダイレクトすることができます。

と、書いてあったので Jekyll は出来ていいな〜と、使いたいのは Sculpin なんだけどなぁって考えて…… そうだ！なければ作ればいいじゃん！

と、その前に、[Packagist](https://packagist.org/) で [#sculpin](https://packagist.org/search/?tags=sculpin) を探してみたところ、ちょうど良さそうなの [mavimo/sculpin-redirect-bundle - Packagist](https://packagist.org/packages/mavimo/sculpin-redirect-bundle)
 があったので使ってみました。

## インストール

内容的には Bundle の README を見れば OK です。

`sculpin.json` にパッケージを追加。

```diff
     "require": {
+        "mavimo/sculpin-redirect-bundle": "@dev"
     },
```

次に `sculpin update` をします。
次の手順を先に行うと実行できると言えばできるのですが、 Bundle のクラスがないよ！って怒られるので先に更新をします。

```bash
$ php sculpin update
Loading composer repositories with package information
      :
Compiling component files
```

`app/SculpinKernel.php` にパッケージのクラスを追加。

```diff
     protected function getAdditionalSculpinBundles()
     {
         return array(
+           'Mavimo\Sculpin\Bundle\RedirectBundle\SculpinRedirectBundle'
         );
     }
 }
```

<p class="alert alert-info" role="alert">ファイルが存在しない場合は、 <a href="https://github.com/beryllium/icelus#installation">beryllium/icelus § Installation</a> や <a href="https://sculpin.io/documentation/extending-sculpin/configuration/">Configuration — Sculpin</a> を参考にして <code>app/SculpinKernel.php</code> を作ってください。
</p>

次にリダイレクト用のページの元となるテンプレート `source/_layouts/redirect.html` を作ります。
作る内容は Bundle の README のままでもいいですし、リダイレクト先を `{{ '{{' }} site.url }}{{ '{{' }} page.destination.url }}` としてもいいでしょう。

```
<!DOCTYPE html>
{{ '{%' }} spaceless %}
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="refresh" content="0;url={{ '{{' }} page.destination.url }}" />
  </head>
</html>
{{ '{%' }} endspaceless %}
```

そして、これで、準備は完了です。


余談として、 `redirect.html` を作る場所が README には `Then create a redirect.html file in your theme` としか書かれていないので、最初 `source` 直下にファイルを置いてテストしていたところ生成されず小一時間ほど頭を悩ましました。
ページ生成時時には、ログが大量に流れていくのですが、

```bash
$ php sculpin.phar generate
Detected new or updated files
Generating: 100% (80 sources / 0.01 seconds)
Converting:  71% [ Twig_Error_Loader: Template "redirect" is not defined (Sculpin\Bundle\TwigBundle\FlexibleExtensionFilesystemLoader: Template "redirect" is not defined.). ]
              :
```

と、このようなログが出ていたので、拡張子を変えてみたり、いろいろ変えてみた結果、もしかして！と思い `source/_layouts/redirect.html` にファイルを作ると思った通りに動作するようになったのでした。

## 利用方法

こちらも基本的には Bundle の README に書かれている通りです。

それぞれのページ用のファイルの先頭部分、ページタイトルや日時が書かれている部分に転送元のパスを列挙するだけで OK です。

例として `main.html` が転送先とします。

```yaml
          :
redirect:
    - alias-path.html
    - old-path.html

---
        :
```

と、このような感じで書くと `alias-path.html` と `old-path.html` が生成されて、そのアドレスにアクセスされると `main.html` へと転送されます。

例えば [commit 8888448e41b1439570011158c2be2396f4afbab3](https://github.com/sharkpp/travis-ci-pull-test/commit/8888448e41b1439570011158c2be2396f4afbab3#diff-8b370a9f2d572cc50d203266c8281d58) のように追加すると [/old-path.html](http://sharkpp.github.io/travis-ci-pull-test/old-path.html) からアクセスすると [/blog/2013/02/04/highlight/](http://sharkpp.github.io/travis-ci-pull-test/blog/2013/02/04/highlight/) へと転送されます。

## テンプレート redirect.html で利用できる変数

|変数名|説明|
|-|-|
|`page.destination`|リダイレクト先の `page` の内容|

## 参考

* [mavimo/sculpin-redirect-bundle - Packagist](https://packagist.org/packages/mavimo/sculpin-redirect-bundle)
* [sculpin-redirect-bundle/RedirectGenerator.php at master · mavimo/sculpin-redirect-bundle](https://github.com/mavimo/sculpin-redirect-bundle/blob/master/RedirectGenerator.php)



