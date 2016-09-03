---
title: "Sculpin の Bundle をまとめてみた"
date: 2016-09-03 13:20
tags: [ Sculpin, まとめ, php ]
categories: [ まとめ ]

---

PHP 製の静的サイトジェネレータ [Sculpin](https://sculpin.io/) へ導入することで機能を拡張するパッケージを Bundle と呼んでいますが、それを公式のドキュメントを参考に

* コンバータ
* ジェネレータ
* テーマ
* その他

の 4 つのカテゴリへと Bundle を分類し、簡単な説明などをつけてまとめてみました。

こうしてまとめて見るために、いろいろググってみますが、日本語で書かれた Sculpin の情報というのは少ないですね。

今現在公開されているものを列挙していますが、最新の Sculpin に対応していないなど、もしかしたら利用できない Bundle があるかもしれないので、ご注意ください。

## コンバータ

[Converters - Sculpin](https://sculpin.io/documentation/converters/) に書かれているように、何か、これは標準では Markdown で書式化された投稿ページを HTML へと変換する Bundle をここで列挙しています。

### Sculpin league/commonmark bundle

ダウンロード：[bcremer/sculpin-commonmark-bundle](https://packagist.org/packages/bcremer/sculpin-commonmark-bundle)

[CommonMark](http://commonmark.org/) 記法で書かれた投稿をパースすることができるようにするバンドル。

### Sculpin Parsedown

ダウンロード：[mavimo/sculpin-parsedown](https://packagist.org/packages/mavimo/sculpin-parsedown)

標準の Markdown パーサーを置き換え、`sculpin generate` のパフォーマンスを上げることができるバンドル。

Sculpin 本体にパッチを当てる必要があるようなので、導入の難易度は高めのようです。

### Sculpin MtHaml Bundle

ダウンロード：[fervo/sculpin-mthaml-bundle](https://packagist.org/packages/fervo/sculpin-mthaml-bundle)

投稿を [MAML](https://en.wikipedia.org/wiki/Microsoft_Assistance_Markup_Language) で作成できるようになるバンドル。

### Sculpin reStructuredText Bundle

ダウンロード：[rjkip/sculpin-rst-bundle](https://packagist.org/packages/rjkip/sculpin-rst-bundle)

投稿を [ReStructuredText(reST)](https://ja.wikipedia.org/wiki/ReStructuredText) で作成できるようになるバンドル。


## ジェネレータ

投稿を列挙し特殊なページを作成したり、投稿内で利用できるタグクラウドなどのブロックを生成できる Bundle をここで列挙しています。

### Sculpin less bundle

ダウンロード：[bcremer/sculpin-less-bundle](https://packagist.org/packages/bcremer/sculpin-less-bundle)

`sculpin generate` 実行時に `*.less` を LESS でプリプロセスし `*.css` を作成することができるようにするバンドル。

### Sculpin Redirect Bundle

ダウンロード：[mavimo/sculpin-redirect-bundle](https://packagist.org/packages/mavimo/sculpin-redirect-bundle)

投稿に別名を追加し、追加したパスから元のページへのリダイレクトを作成することができるようにするバンドル。

「[Sculpin でリダイレクトページを生成する Sculpin Redirect Bundle を使ってみた](/blog/2016/06/12/using-sculpin-redirect-bundle.html)」 で紹介と使い方を記事にしています。

### Sculpin Multilingual Bundle

ダウンロード：[rocketage/sculpin-multilingual-bundle](https://packagist.org/packages/rocketage/sculpin-multilingual-bundle)

複数の言語用のサイトをサブドメインとして提供している場合にリソースを共通化できるようにすることができるバンドル。

これは、 `ja.example.net` と `en.example.net` で利用するリソースを共通化し、`sculpin generate` 時に、各言語用のサイトそれぞれへとコピーできるようになるようです。

### Sculpin Related Posts Bundle

ダウンロード：[tsphethean/sculpin-related-posts-bundle](https://packagist.org/packages/tsphethean/sculpin-related-posts-bundle)

記事と共通するタグを持つページの一覧を作成することができるようになるバンドル。

レイアウトに、適当なテンプレートを記述することで、記事に関連するページとして表示することができるようです。

### wjzijderveld/sculpin-related-content-bundle

ダウンロード：[wjzijderveld/sculpin-related-content-bundle](https://packagist.org/packages/wjzijderveld/sculpin-related-content-bundle)

記事と関連するタグを持つページの一覧を作成することができるようになるバンドル。

レイアウトに、適当なテンプレートを記述することで、記事に関連するページとして表示することができるようです。

### jbouzekri/sculpin-tag-cloud-bundle

ダウンロード：[jbouzekri/sculpin-tag-cloud-bundle](https://packagist.org/packages/jbouzekri/sculpin-tag-cloud-bundle)

[タグクラウド](https://ja.wikipedia.org/wiki/%E3%82%BF%E3%82%B0%E3%82%AF%E3%83%A9%E3%82%A6%E3%83%89)を作成することができるようになるバンドル。

作者のページで実際に利用されているようです　つ [Blog de Jonathan Bouzekri](http://blog.bouzekri.net/)

### beryllium/icelus

ダウンロード：[beryllium/icelus](https://packagist.org/packages/beryllium/icelus)

所定の書き方をすることで `sculpin generate` 時に画像のサムネイルを生成することができるようになるバンドル。

「[Sculpin でサムネイルを自動生成する Icelus Bundle を使ってみた](/blog/2015/11/02/using-sculpin-thumbnail-generator-icelus.html)」 で紹介と使い方を記事にしています。

### Sculpin Projects Bundle

ダウンロード：[mavimo/sculpin-projects-bundle](https://packagist.org/packages/mavimo/sculpin-projects-bundle)

所定のフォルダにまとめられたファイルからプロジェクトの一覧を作成するバンドル。

こんな感じに作成されるようです　つ [Projects - Mavimo](http://web.archive.org/web/20140815024704/http://mavimo.org/projects.html)

### Sculpin oEmbed bundle

ダウンロード：[bangpound/sculpin-oembed-bundle](https://packagist.org/packages/bangpound/sculpin-oembed-bundle)

[oEmbed](http://oembed.com/) をサポートした URL を指定することで簡単に埋め込み用のコードを生成し、投稿に埋め込むことができるようになるバンドル。

### jbouzekri/sculpin-date-navigation-bundle

ダウンロード：[jbouzekri/sculpin-date-navigation-bundle](https://packagist.org/packages/jbouzekri/sculpin-date-navigation-bundle)

投稿の日時ごとのインデックスページとそのリンクを生成することができるようになるバンドル。

### jbouzekri/sculpin-search-bundle

ダウンロード：[jbouzekri/sculpin-search-bundle](https://packagist.org/packages/jbouzekri/sculpin-search-bundle)

投稿から予めインデックスを生成し、投稿内を [IndexTank](https://github.com/linkedin/indextank-engine) を利用し検索することができるようになるバンドル。

### ramsey/sculpin-codeblock

ダウンロード：[ramsey/sculpin-codeblock](https://packagist.org/packages/ramsey/sculpin-codeblock)

[ramsey/twig-codeblock](https://github.com/ramsey/twig-codeblock) で拡張される `codeblock/endcodeblock` タグを利用することができるようになるバンドル。

### Sculpin Pages Bundle

ダウンロード：[fab/sculpin-pages-bundle](https://packagist.org/packages/fab/sculpin-pages-bundle)

現在表示しているページをハイライトしているようなメニューを作ることができるようになるバンドル。

bootstrap の navbar の active / 非active みたいな表示ができるようになる。

利用例 つ [librairie-sycomore.ch/page.twig at master · FiacreGH/librairie-sycomore.ch](https://github.com/FiacreGH/librairie-sycomore.ch/blob/master/source/_views/page.twig)

### sharkpp/sculpin-calendarian-bundle

ダウンロード：[sharkpp/sculpin-calendarian-bundle](https://packagist.org/packages/sharkpp/sculpin-calendarian-bundle)

投稿の日付ごとにインデックスページを作ることができるようになるバンドル。

拙作。

[Sculpin でブログアーカイブの日付ごとにポストをまとめたページを作るバンドルを作ってみた](/blog/2015/08/09/create-sculpin-blog-archive-date-directory-bundle.html) で使い方を記事にしています。

### wyrihaximus/html-compress-sculpin

ダウンロード：[wyrihaximus/html-compress-sculpin](https://packagist.org/packages/wyrihaximus/html-compress-sculpin)

`sculpin generate` で生成される HTML ファイルを minify することができるようになるバンドル。

Bundle と言って良いのかわからないですが、設定すると HTML を minify して圧縮してくれるようです。


## テーマ

Sculpin 用のテーマをここでは列挙しています。

[sculpin-theme-composer-plugin](https://packagist.org/packages/sculpin/sculpin-theme-composer-plugin) を利用すれば、 `composer.json` でテーマを管理できるようになる、ようです。

なお、 Sculpin のテーマ機能自体は [Themes - Sculpin](https://sculpin.io/documentation/themes/) に

> WARNING
> Theme support for Sculpin is still highly experimental. It has been stable in its current form since early 2014 but be aware that the theme API may change drastically sometime later this year.

訳すと

> 警告
> Sculpin のためのテーマのサポートはまだ非常に実験的なものです。これは初期の2014年以来現在の形で安定していますが、テーマ API は今年後半(※)にいつか大幅に変更される可能性があることに注意してください。

訳注：2015年後半のこと つ [Warn people about changes to themes.](https://github.com/sculpin/sculpin.io/commit/23f4d2f778c8ca9ef4070dac0041420bedb58ee9#diff-4a6302f145e637d38195213cf4295609)

と書かれているので、利用できなくなっている可能性があります。

### Slate is theme for GitHub Pages or your Sculpin site.

ダウンロード：[nedmas/slate](https://packagist.org/packages/nedmas/slate)

Sculpin 用の [Slate](https://github.com/jasoncostello/slate) テーマ。

Slate はこんな感じのページのようです　つ [Slate : A responsive theme for GitHub Pages](http://jasoncostello.github.io/slate/)

### Minimal Mistakes theme for Sculpin static site generator.

ダウンロード：[chrisnharvey/minimal-mistakes](https://packagist.org/packages/chrisnharvey/minimal-mistakes)

Sculpin 用の [Minimal Mistakes](https://github.com/mmistakes/minimal-mistakes) テーマ。

### A Bootstrap 3 Blog Theme for Sculpin

ダウンロード：[sculpin/bootstrap-3-blog-theme](https://github.com/sculpin/bootstrap-3-blog-theme)

Sculpin 用の Bootstrap 3 テーマ。

### Porting of Sticko theme for Sculpin

ダウンロード：[mavimo/sculpin-theme-sticko](https://github.com/mavimo/sculpin-theme-sticko)

Sculpin 用の Sticko テーマ。


## その他

Sculpin cli を拡張するなど、前 3 つ以外に分類される Bundle をここで列挙しています。

### sculpin/sculpin-theme-composer-plugin

ダウンロード：[sculpin/sculpin-theme-composer-plugin](https://packagist.org/packages/sculpin/sculpin-theme-composer-plugin)

Sculpin のテーマを Composer で管理できるようにするバンドル。

README がないので使い方が分かりにくいですが、 `composer.json` に、Sculpin のテーマを書いておくと、インストール時にテーマを既定のテーマフォルダにコピーし、アンインストール時に削除してくれるようです。

### Sculpin Editor Bundle

ダウンロード：[mavimo/sculpin-editor-bundle](https://packagist.org/packages/mavimo/sculpin-editor-bundle)

`sculpin editor:create` コマンドを Sculpin へし、投稿の新規作成を容易にするバンドル。

### opdavies/sculpin-content-generator-bundle

ダウンロード：[opdavies/sculpin-content-generator-bundle](https://packagist.org/packages/opdavies/sculpin-content-generator-bundle)

`sculpin content:new:post` コマンドを追加し、容易に新しい投稿を作成できるようにするバンドル。

### petemc/sculpin-gulp-bundle

ダウンロード：[petemc/sculpin-gulp-bundle](https://packagist.org/packages/petemc/sculpin-gulp-bundle)

`sculpin generate` 時に、同時に [Gulp](http://gulpjs.com/) を実行することができるようになるバンドル。

### dragonmantank/fillet-sculpin-bundle

ダウンロード：[dragonmantank/fillet-sculpin-bundle](https://packagist.org/packages/dragonmantank/fillet-sculpin-bundle)

[Fillet](https://packagist.org/packages/dragonmantank/fillet) と連携し、CMS から Sculpin への変換をサポートするバンドル。

## 参考

* [search of "sculpin" - Packagist](https://packagist.org/search/?q=sculpin)
