---
title: "FuelPHP 日本語言語パッケージ 作ってみたよ"
date: 2013-04-27 00:36:00
tags: [php, Develop, FuelPHP]
categories: [blog]

---

FuelPHPのパッケージも３つ目となりました、ValidationクラスやDateクラスなどの英語のメッセージを日本語で表示してくれるパッケージを作ってみました。

[sharkpp/fuel-language-pack-ja - GitHub][1]

 [1]: https://github.com/sharkpp/fuel-language-pack-ja

インストールは普通のパッケージと同じで下記のように難しいことは何もないです。

  1. `PKGPATH` に展開([Packages - General - FuelPHP Documentation][2]を参照)
  2. `APPPATH/config/config.php` の `'always_load' => array('packages' => array())` にパッケージを追加
  3. `APPPATH/config/config.php` の言語を日本語に変更。 `'language'` に `'ja'` を指定。

 [2]: http://fuelphp.com/docs/general/packages.html

とりあえず、それなりに動いてそうだけど、実は間違ったことやってる、とかだといやだなー。

まあ、何にせよ、パッケージの追加だけでメッセージが日本語になるのはいい感じです。

実際訳してみたけど、そもそもの対象となる英文の内で多言語での表示に対応している部分が少ないのでなんかいまいちな感じです。 若干、意訳っぽくなってたり、訳が間違ってたりしてるかもですが、こっちの訳のほうがいいよとか、あればForkするなりIssueに登録するなりしてみてください。

本当はスクリーンショットをつけたほうがいいんだけれど良い例が手元にないので乗せられないのです(´･ω･\`)