---
title: "FuelPHP 勉強会 大須 vol.3 に参加しました"
date: 2013-02-17 20:09:00
tags: [php, FuelPHP, 勉強会]
categories: [ブログ]

---

[FuelPHP 勉強会 大須 vol.3][1]に行ってきました。 何気に、今年初めての勉強会です。

 [1]: http://atnd.org/events/36476

## 自己紹介

まず始めにATNDに登録した順で自己紹介

なかなか、しゃべろうと思ってたことをうまくしゃべれなかったです。

## はじめての FuelPHP

[@ounziw][2] [はじめての FuelPHP][3]を使って概要を説明

 [2]: https://twitter.com/ounziw
 [3]: http://www.slideshare.net/akagisho/fuelphp-13573981

  * ORM プロファイラ上で出てこないクエリ発行をしている場合もある
  * プロファイリングでSQLのクエリも出す場合は、app/config.php 以外に DB の接続設定でもONにする必要がある
  * プロファイリングはdevelopmentでもproductionでも効いてしまうので普通はdevelopmentでのみONにする

## ユニットテストのすすめ

[@ounziw][2] [Day.06 ユニットテストのすすめ][4]

 [4]: http://ounziw.com/2012/12/06/phpunit/

  * いまからやるならPHPUnit
  * テスト書かずに機能追加するのは怖いと思う
  * Controllerのテストを書くのは難しい

<pre>function _form() {
:
}
function action_hoge() {
return View::forge($this->_form());
}
</pre>

みたいな感じで、、、

ただ、これは純粋なControllerのテストではないのかなー？現状はコントローラのテストを書くのは難しいかも

  * oil test --coverage-html DIRNAME ではなくて oil test --coverage-html=DIRNAME [Test - Oil Package - FuelPHP Documentation][5]がおかしいっぽい(2月17日現在)
  * CakePHPもPHPUnitなのでメジャーなフレームワークは全部 PHPUnit を使ってる
  * みなさん今日からテストを書きましょう

 [5]: http://fuelphp.com/docs/packages/oil/test.html

## 休憩

20分ぐらい休憩

## Day 13 FuelPHP + eXcale でデプロイ体験

[@yamamoto_manabu][6] [Day 13 FuelPHP + eXcale][7]

 [6]: https://twitter.com/yamamoto_manabu
 [7]: http://yamamoto.phpapps.jp/2012/12/13/6/

スライドを書いた本人が直々に説明＆レクチャーをしていただきました。

  * [Pagoda Box][8]はFuelPHPに対応、バージョンは？
  * eXcale 「This invitation link isn't valid. Perhaps you already used it?」ってでて登録できなかったorz → なんかパスワードに記号を使うとエラーになるっぽい
  * [ニフティクラウド][9]もFuelPHPに対応、5日間は無料で試せる！

 [8]: https://pagodabox.com/
 [9]: http://cloud.nifty.com/

eXcale とりあえずFuelPHPで/index.phpで表示できた Fuel/以下も名前変えたのでとりあえずいいのかな？ ただ、.htaccess使えないのでなんか残念な感じ。

SNSで言及すると拾ってくれるかも？

  * <http://sharkpp.excale.net/>
  * <http://sharkpp.excale.net/index.php/welcome>

## Day 15 FuelPHPドキュメント翻訳へのお誘い

[Day 13 FuelPHP + eXcale][10]

 [10]: http://pneskin2.nekoget.com/press/?p=1044

  * 翻訳ウィークの結果は15ポイントアップ
  * [github上][11]で簡単に翻訳作業ができる！
  * 翻訳作業状況はつ[FuelPHP翻訳状況 1.5][12]
  * 翻訳すると日本人ユーザーみんながハッピー
  * 原文からおかしい場合はこんな感じに本家にPullRequestつ[Pull Request #512 fuel/docs GitHub][13]

 [11]: https://github.com/NEKOGET/FuelPHP_docs_jp/
 [12]: https://docs.google.com/spreadsheet/ccc?key=0ArwGmfmveOhNdE9fU1BlNTNpNVVnaWJEaUVPbzgwQ0E#gid=2
 [13]: https://github.com/fuel/docs/pull/512

## まとめ

とりあえず、こんな感じでした。 プログラムをもくもくでもなく、かといってスライドを食い入るようにってわけでもなく、まあ、途中すこし手は動かしたのですが、、、なかなか新鮮で面白かったです。

去年からぽつぽつ勉強会に顔を出していますがいろんなスタイルがあって面白いなーと楽しみながら行ってます。

あっ、あと近くの味仙に台湾ラーメンを食べに行きましたが、標準ではなく辛さマイルドなアメリカンを食べましたが辛かったです(´･ω･\`)
