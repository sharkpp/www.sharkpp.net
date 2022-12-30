---
title: "Sculpin でブログアーカイブの日付ごとにポストをまとめたページを作るバンドルを作ってみた"
date: 2015-08-09 22:00
tags: [Sculpin, php, Composer]
categories: [ブログ]

---

[Sculpin](https://sculpin.io/) でブログアーカイブの日付ごとにポストをまとめたページを作るバンドルを作ってみました。

* [sharkpp/sculpin-calendarian-bundle - GitHub](https://github.com/sharkpp/sculpin-calendarian-bundle)
* [sharkpp/sculpin-calendarian-bundle - Packagist](https://packagist.org/packages/sharkpp/sculpin-calendarian-bundle)

とりあえずは、 generator として指定されたディレクトリ以下にインデックスページをどかどかっと作成します。

ようするに、 [https://www.sharkpp.net/blog/2015/](https://www.sharkpp.net/blog/2015/) とかで、この例だと 2015 年に投稿された記事の一覧が列挙されるページを作ることが出来ます。

## まず始めに

Sculpin でブログとかを作ると、記事の日付で URL を掘り下げて作ってくれたりするのですが、残念なことに、 Wordpress などでもよくあるような、年月日ごとに記事を列挙したページを作る機能がありませんでした。

で、無ければ作ろう！と思い立ったはいいけど、進捗は思わしくなく、、、ってところで最終的に３時間程度で動く物が出来たのでもにょる所。

それはともかく、公式のドキュメントを見たり、[Symfony](https://symfony.com/) のドキュメントを見たり、 Sculpin のソースを見たりと、なんとか形に出来ました。

## Sculpin を拡張するための心得

1. 公式ドキュメントの "[Extending Sculpin](https://sculpin.io/documentation/extending-sculpin)" を熟読しよう！
2. Symfony2 のドキュメント "[バンドルの構造とベストプラクティス](http://docs.symfony.gr.jp/symfony2/cookbook/bundles/best_practices.html)"、"[セマンティックコンフィギュレーションを通してバンドルを設定する方法](http://docs.symfony.gr.jp/symfony2/cookbook/bundles/extension.html)" を熟読しよう！
3. [mavimo/sculpin-redirect-bundle](https://github.com/mavimo/sculpin-redirect-bundle) を熟読しよう！
4. Sculpin の [ソース](https://github.com/sculpin/sculpin/) を熟読しよう！

で、なんとなくは作れる気がします。

## Packagist に公開しよう！

Composer で簡単に使えるようにするに、 Packagist に登録してみます。

というか、登録せずに ```composer.json``` 書いて ```php composer.phar install``` したら

```bash
$ php sculpin.phar update
Loading composer repositories with package information
Updating dependencies
Your requirements could not be resolved to an installable set of packages.

  Problem 1
    - The requested package sharkpp/sculpin-calendarian-bundle could not be found in any version, there may be a typo in the package name.

Potential causes:
 - A typo in the package name
 - The package is not available in a stable-enough version according to your minimum-stability setting
   see <https://groups.google.com/d/topic/composer-dev/_g3ASeIFlrc/discussion> for more details.

Read <http://getcomposer.org/doc/articles/troubleshooting.md> for further common problems.
```

って言われてもにょる。

ってことで、

1. パッケージ用の composer.json を書きましょう！
2. Packagist への登録時に怒られるので、レポジトリ名は小文字で！
3. Packagist 登録時には Git or Svn or Hg の公開レポジトリ URL が必要になるので、今回は GitHub に登録！
4. Packagist に登録です！

ってことで、GitHub の [sharkpp/sculpin-calendarian-bundle](https://github.com/sharkpp/sculpin-calendarian-bundle) で公開し、 Packagist の [sharkpp/sculpin-calendarian-bundle](https://packagist.org/packages/sharkpp/sculpin-calendarian-bundle) でパッケージを登録しました。

## 参考

* [サービスコンテナ | Symfony2日本語ドキュメント](http://docs.symfony.gr.jp/symfony2/book/service_container.html)
* [セマンティックコンフィギュレーションを通してバンドルを設定する方法 | Symfony2日本語ドキュメント](http://docs.symfony.gr.jp/symfony2/cookbook/bundles/extension.html)
* [バンドルの構造とベストプラクティス | Symfony2日本語ドキュメント](http://docs.symfony.gr.jp/symfony2/cookbook/bundles/best_practices.html)
* [sculpin/PaginationGenerator.php at master · sculpin/sculpin · GitHub](https://github.com/sculpin/sculpin/blob/master/src/Sculpin/Bundle/PaginationBundle/PaginationGenerator.php)
* [Configuration — Sculpin — PHP Static Site Generator](https://sculpin.io/documentation/extending-sculpin/configuration/)
* [mavimo/sculpin-redirect-bundle · GitHub](https://github.com/mavimo/sculpin-redirect-bundle)
