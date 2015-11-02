---
title: "Sculpin でサムネイルを自動生成する Icelus Bundle を使ってみた"
date: 2015-11-02 12:50
tags: [ Sculpin, php, Composer ]
categories: [ブログ]

---

Sculpin でページ生成時にサムネイルを作る Bundle 無いかなぁ？

無いなら作ろうかなぁ〜って思って [Packagist](https://packagist.org/) を探してみたらそれらしいのを見つけたので試してみた。

見つけたのは [beryllium/icelus - Packagist](https://packagist.org/packages/beryllium/icelus) です。

> Thumbnail generator for Sculpin-based websites

と書いてありました。

## とりあえず使ってみる

完全な差分は [IcelusBundle を追加してサムネイルを自動で生成するように変更 · sharkpp/www.sharkpp.net@68efa31](https://github.com/sharkpp/www.sharkpp.net/commit/68efa31f1f13a8db8ab45dd5d1cbfb019fffa316) です。

### インストール

`sculpin.json` にパッケージを追加。

```diff
         "components/jquery": "~1.9.1",
         "components/highlightjs": "~7.3.0",
         "jasny/twig-extensions": "@dev",
-        "sharkpp/sculpin-calendarian-bundle": "dev-master"
+        "sharkpp/sculpin-calendarian-bundle": "dev-master",
+        "beryllium/icelus": "*"
     },
     "autoload": {
         "psr-0": {
```

そして、おもむろに `sculpin.phar update` を実行。

```bash
$ php sculpin.phar update
Loading composer repositories with package information
Updating dependencies
  - Installing imanee/imanee (1.2.2)
    Downloading: 100%         

  - Installing beryllium/icelus (1.0.0)
    Downloading: 100%         

Writing lock file
Generating autoload files
Compiling component files
```

`app/SculpinKernel.php` にパッケージのクラスを追加。


```diff
     protected function getAdditionalSculpinBundles()
     {
         return array(
-           'Sharkpp\Sculpin\Bundle\CalendarianBundle\SculpinCalendarianBundle'
+           'Sharkpp\Sculpin\Bundle\CalendarianBundle\SculpinCalendarianBundle',
+           'Beryllium\Icelus\IcelusBundle',
         );
     }
 }
```

<p class="alert alert-info" role="alert">ファイルが存在しない場合は、 <a href="https://github.com/beryllium/icelus#installation">beryllium/icelus § Installation</a> や <a href="https://sculpin.io/documentation/extending-sculpin/configuration/">Configuration — Sculpin</a> を参考にして <code>app/SculpinKernel.php</code> を作ってください。
</p>

## 使ってみる

の前に、どうやら Markdown Converter と相性というか、タイミングが悪いみたいで、

```markdown
![64 x 64]({{ '{{' }} thumbnail('/images/noname/196x196.png', 64, 64) }})
```

と記述すると、

```md
![64 x 64](/_thumbs/b0d061130443fcd10d882073d6ef32f0-64x64.png)
```

と、このように惜しい感じになるので

```html
<img src="{{ '{{' }} thumbnail('/images/noname/196x196.png', 64, 64) }}" alt="64 x 64">
```

と、HTMLのタグで直接記述しないとダメなようです。

### 元画像

![196 x 196](/images/noname/196x196.png)

### 64px のサムネイル

<img src="{{ thumbnail('/images/noname/196x196.png', 64, 64) }}" alt="64 x 64">

```html
<img src="{{ '{{' }} thumbnail('/images/noname/196x196.png', 64, 64) }}" alt="64 x 64">
```

### 16px のサムネイル

<img src="{{ thumbnail('/images/noname/196x196.png', 16, 16) }}" alt="16 x 16">

```html
<img src="{{ '{{' }} thumbnail('/images/noname/196x196.png', 16, 16) }}" alt="16 x 16">
```

### ドキュメントのミスについて

あと、最初に使い方を[ドキュメント](https://github.com/beryllium/icelus/blob/484174cc735c0589ffe77d94f165e9f6c9f3c726/README.md#usage)で見たところ、

```hmtl
<a href="image.jpg"><img src="{{ '{%' }} thumbnail('image.jpg', 100, 100) %}"></a>
```

と記述してあったので素直にその通り書いて、実行したところ、

```bash
             :
Generating: 100% (1079 sources / 0.17 seconds)
Converting:  14% [ Twig_Error_Syntax: Unexpected tag name "thumbnail" (expecting closing tag for the "for" tag defined near line 7) in "FileSource:FilesystemDataSource:~/git/test/source:test.html" at line 14 ]
 [ Twig_Error_Syntax: Unexpected tag name "thumbnail" (expecting closing tag for the "for" tag defined near line 7) in "FileSource:FilesystemDataSource:~/git/test/source:test.html" at line 14 ]
100% (1722 sources / 7.49 seconds)
             :
```

とエラーが出たので、

しばらく、これ実は使えない？とか、設定が足らない？とか思いながらしばらく試してみて、ふと

```hmtl
<a href="image.jpg"><img src="{{ '{{' }} thumbnail('image.jpg', 100, 100) }}"></a>
```

と書かないとダメなのではと思い試してみたところ、うまく動きました。

これは、 もう Pull Request するしかないと思ってサクッと [PR](https://github.com/beryllium/icelus/pull/1) しました。

### 設定について

[icelus/DependencyInjection/Configuration.php](https://github.com/beryllium/icelus/blob/484174cc735c0589ffe77d94f165e9f6c9f3c726/DependencyInjection/Configuration.php) とかを見ると設定で出力先などが変更できそうな気がしましたが、、、

他のソースを見ると使っている形跡がなく、そもそもドキュメントにも記載がないのできっと作りかけなのでしょう。

## 参考

* [beryllium/icelus - Packagist](https://packagist.org/packages/beryllium/icelus)
* [beryllium/icelus](https://github.com/beryllium/icelus)
* [Twig for Template Designers - Documentation - Twig - The flexible, fast, and secure PHP template engine](http://twig.sensiolabs.org/doc/templates.html)
* [Generators — Sculpin — PHP Static Site Generator](https://sculpin.io/documentation/generators/)
* [Configuration — Sculpin — PHP Static Site Generator](https://sculpin.io/documentation/extending-sculpin/configuration/)
