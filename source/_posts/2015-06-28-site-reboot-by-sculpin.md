---
title: "Sculpin でホムペを再構築したときのメモ"
date: 2015-06-28 18:00
tags: [雑記,php,xrea.com,Sculpin]
categories: [ブログ]

---

[Sculpin](https://sculpin.io/) でホムペを再構築してからだいたい一ヶ月ぐらい経ちました。

元のページは、 Markdown で作ったり はてな記法で書いてたり色々あったので全ページをクロールしてダウンロードした .html から .md への変換スクリプトを書きページを再構成しました。

手順としては

1. 全ページをクロール
2. .html をスクリプトで .md に変換＆リンクを再構成(実際の変換スクリプトは [www.sharkpp.net/convert/ - GitHub](https://github.com/sharkpp/www.sharkpp.net/blob/master/convert) を参照)
3. Sculpin で構築しやすいように再構成
4. Github へ push したら自動で更新する仕組みを実装( [Sculpin を実行するために xrea.com 上で libxml2 を構築する方法](/blog/2015/05/31/how-to-build-libxml2-on-xrea-com-for-sculpin.html) や [www.sharkpp.net/site - GitHub](https://github.com/sharkpp/www.sharkpp.net/blob/master/site) を参照)
5. 公開

という感じです。

いろいろ自分好みなページを作る中で Sculpin の挙動を調べたメモを記録として残しておきます。

## コマンドライン

### 構築

```bash
$ php sculpin.phar generate
```

または

```bash
$ php sculpin.phar generate --env=prod
```

### 構築＆テストサーバー起動

```bash
$ php sculpin.phar generate --watch --server
```

## Sculpin で使用できる変数

### ページ内で使用できる変数

| 変数名             | 概要 |
|-------------------|------|
| site              | `sculpin_site.yml` の値 |
| page              | ページ自体 |
| formatter         | テンプレートエンジン名( `twig` など) |
| converters        | ？ |
| relative_root_url | ページ自体から見たルートへの相対パス |
| data              | `Frontmatter` (各ページ先頭での指示) で宣言されたコンテンツ |
| layout            | レイアウト名 |

### site 変数

`app/config/sculpin_site.yml` で指定した値が設定されます。

| キー             | 概要                                       |
|------------------|--------------------------------------------|
| .posts           | `use: ["posts"]`                           |
| .subtitle        | `app/config/sculpin_site.yml` で指定した値   |
| .url             | サイトのURL。引数 `--url` で指定した値。        |
| .auther          | `app/config/sculpin_site.yml` で指定した値   |
| .env             | 引数 `--env` で指定した値。`dev` など          |
| .calculated_date | ページの生成日時                             |

### page 変数

ページ自体の情報を参照できる変数。

```yaml
---
title: "Sculpin でホムペを再構築"
date: 2015-06-28 18:00
tags: [雑記,php,xrea.com,Sculpin]
categories: [ブログ]
user_data: [hoge,fuga]

---

```

の `user_data` の用な感じで自由に値を指定することも出来ます。

`post.data` と `data` は同じ内容を参照しているようです。

### data 変数

`Frontmatter` (各ページ先頭での指示) で `use: XXX` として宣言されたコンテンツが読み込まれます。

## Tips的なめも

### ブログページ意外を参照する変数や方法は無い

Sculpin 自体には `SculpinPostsBundle` から生成される `blogs/YYYY/MM/DD/XXXX` を参照するような感じで、ブログページ以外の単体ページを参照する仕組みは標準ではなさそうです。
ただ、拡張として内部の情報を参照する形で作れば出来そうな感じではあるようです。

### .htaccess 自体をコピーすることは出来ない

あれっと思いましたが、
[Is it expected behavior that .htaccess file is not carried over from source dir to destination? - Issue #121 - sculpin/sculpin](https://github.com/sculpin/sculpin/issues/121) を見ると `.htaccess` 自体をページ生成時にコピーすることは出来ない様です。
が、ちょっと考えると `htaccess.twig` というファイルを作り

```
---
permalink: .htaccess
---
# hoge fuga
```

とすればいいようです。

### 記事へのリンクを張るにはメタ情報が必要

ヘッダとして

```markdown
# Sculpin でホムペを再構築
```

の様にしても記事へのリンクが張られなかった。
タグ情報とかも結局入れるのでこのような形にする

```markdown
---
title: "Sculpin でホムペを再構築"

---
```

### タイトルはダブルコーテーションで囲うべし

タイトルの頭に記号が含まれると

```bash
$ php sculpin.phar generate --watch --server
     ! FileSource:FilesystemDataSource:.../source:_posts/2013-01-24-user-jp-follow-up.md Reference "-user.jp(?ユーザのためのハブサイト)のその後を追跡調査" does not exist at line 0. !
    Detected new or updated files
    Generating: 100% (215 sources / 0.04 seconds)
               :
```

の様に処理できない場合がある模様。
なので、ダブルコーテーションで囲うことでこの問題を回避出来る。

### デフォルトで全てのページに拡張子を付けるには？

設定を下記のようにする。

```yaml
# app/config/sculpin_kernel.yml
sculpin:
    permalink: :basename.html

```

ただし、ページネーションやページ内に埋め込まれているリンクは別個修正する必要がある。

### Twig Extensions を使う方法

[truncate](http://twig.sensiolabs.org/doc/extensions/text.html) などを使用するために必要な [Twig Extensions](http://twig.sensiolabs.org/doc/extensions/index.html) は `sculpin.phar` 自体には組み込まれていますが、デフォルトでは無効となっていてそのままでは利用できないようです。

利用するには `app/config/sculpin_services.yml` を作り設定を行う必要があります。

`sculpin_services.yml` の利用方法は [SculpinPostsBundle — Sculpin — PHP Static Site Generator](https://sculpin.io/documentation/bundles/SculpinPostsBundle/) あたりに書いてありますが、残念ながらドキュメントからのリンクが張られていないようです。

また、残念なことに `sculpin_services_{ENV}.yml` の用な感じで環境ごとに拡張の有効/無効を切り替えて使用することは出来ないようです。

```yaml
# app/config/sculpin_services.yml
services:
    twig.extension.text:
        class: Twig_Extensions_Extension_Text
        tags:
            - { name: twig.extension }
```

と、このようなファイルを作ることで

```html
<div>{{ '{{ post.contents | truncate }}' }}</div>
```

このように使用することが可能になります。

## 参考

* [Documentation — Sculpin — PHP Static Site Generator](https://sculpin.io/documentation/)
* [PHPで静的サイトを簡単に作成できるSculpin — A Day in Serenity (Reloaded) — PHP, FuelPHP, Linux or something](http://blog.a-way-out.net/blog/2013/10/11/how-to-use-sculpin/)
* [dragonmantank/solarized-sculpin](https://github.com/dragonmantank/solarized-sculpin)
* [ghislainphu.fr/sculpin_kernel.yml at 29ff7d704dab9df39d586b7781c47955019c0864 - GhislainPhu/ghislainphu.fr](https://github.com/GhislainPhu/ghislainphu.fr/blob/29ff7d704dab9df39d586b7781c47955019c0864/app/config/sculpin_kernel.yml)
* [Filters - Documentation - Twig - The flexible, fast, and secure PHP template engine](http://twig.sensiolabs.org/doc/filters/index.html)
* [Twig: 連想配列の連結](http://akasingo.com/483)
* [Getting Started With Sculpin - adamcod.es](https://adamcod.es/2014/02/07/getting-started-with-sculpin.html)
* [andrewshell/blog.andrewshell.org](https://github.com/andrewshell/blog.andrewshell.org)
* [SculpinPostsBundle — Sculpin — PHP Static Site Generator](https://sculpin.io/documentation/bundles/SculpinPostsBundle/)
* [Is it expected behavior that .htaccess file is not carried over from source dir to destination? - Issue #121 - sculpin/sculpin](https://github.com/sculpin/sculpin/issues/121)
