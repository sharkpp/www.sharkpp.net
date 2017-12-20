---
title: "FuelPHP 勉強会 東海 vol.5 に参加しました"
date: 2013-10-26 20:52:00
tags: [php, FuelPHP, 勉強会]
categories: [ブログ]

---

[FuelPHP 勉強会 東海 vol.5][1]に行ってきました。

 [1]: http://connpass.com/event/3573/

久しぶりの FuelPHP の勉強会です。 会場は先週と同じニューキャストさんのセミナールームでした。

## 自己紹介タイム

自己紹介をぐるっと時計回りで、、、

## 内容

### FuelPHP 2.0 について

[@ounziw][2]

 [2]: https://twitter.com/ounziw

2.0 へ向けての変更点を [FuelPHP - 2.0 - An Update | Blog][3] の内容をもとに確認

 [3]: http://fuelphp.com/blogs/2013/08/2-0-an-update

  * php 5.4 以降が必須に
  * フォルダ構成の変更
  * PSR-2 は非採用
  * module が Application という新しい仕組みになる
  * package が Composer から取得するようになる
  * ViewModel → Presenter
  * oil が Application として実装される
  * [Version 1.7 is the final version 1 release.][4] (訳:バージョン 1.7 が最後のバージョン 1 のリリースです)
  * 2014/4 頃をリリース目標

 [4]: http://fuelphp.com/

memo: LdapAuthも2.0対応やormauth風などに対応しないと、、、次は Ldapauth2 とか？

### 1.7 についてなど

[@ts_asano][5]

 [5]: https://twitter.com/ts_asano

[1.7 の viewmodel の挙動について - Google グループ][6] で報告されている問題。 [render the response body before attempting to process it; closes #1546 - e6237ba - fuel/fuel][7] で直っている模様。 でも、直し方がなんか腑に落ちない、、ので実は直っていない？

 [6]: https://groups.google.com/forum/#!topic/fuelphp_jp/APUGlBAKwq0
 [7]: https://github.com/fuel/fuel/commit/e6237ba66444818adb2434c50b5951502baa1696

`Controller` クラスに `action_index()` 以外に `get_index()` と `post_index()` が 1.3 から増えてた！

バージョナップしたらドキュメントを読み直すと新たな発見がある、、、かも？

### 翻訳について

  * どうやったら翻訳する人を増やせるか？
  * バージョンアップで増えた機能が使えそうな機能だったりしても、ほとんど未翻訳

進んではいるけど全ドキュメントが翻訳完了しないのは翻訳する人が余集まらないからかなー？

### その他

  * 盛り上がりがいまいち、、、参加者がなかなか集まらない、、、東京は割と集まる

まったり聞きながら個人的にネタとなることをやってたけど、、、駄目だった(失敗した)、、、もうちとがんばる必要がありそう。

同じく、翻訳も少し、、、一文をさくっと直すには github のページから編集するのが簡単だなー

memo:

  * 個人的に OrmAuth とか使ってみて人に話せる内容を増やしたい( [@ts_asano][5] さんに聞かれたけど余使っていなかったので詳しくはなせなかった)。
  * [NestedSets][8] とかも使ってみたい＆ドキュメントも未翻訳なので翻訳してみたい。

 [8]: http://fuelphp.com/docs/packages/orm/model/nestedset.html

## 懇親会という名の飲み会

手羽先もぐもぐでした、手羽先オイチー(>_<)
