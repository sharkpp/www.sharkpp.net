---
title: "初めてのPHPバグ報告"
tags: [php]
categories: [blog]

---

先日、といっても一ヶ月以上前ですが、[PHP :: Bug #64699 :: is_dir() is inaccurate result on Windows with japanese locale.][1] としてPHPのバグ報告を初めてしてみました。

[PHPへのバグ報告の手順 - hnwの日記][2] や [PHP :: How to Report a Bug][3] などを参考に報告しました。

で、いつの間にかコメントがついていました。

まあ、結局のところ [PHP :: Bug #61315 :: stat() fails with specific DBCS characters][4] として(or他もろもろで)重複したものが登録されていたようですorz

毎回思うに、重複とかはどうやって確認するんだろう？ってところでバグの報告とか躊躇してしまうんだよなー　 そこまで気にする必要はないのかもしれないけど、、、

コメントでは、パッチ当てるか [php-wfio - Unicode filename support for PHP 5.4 on Windows - Google Project Hosting][5] 使ってみてって書かれてたのでphp-wfioを試してみました。

が、、、うまく動かないのでソースとか [fopen or such with UTF-8 filepath - PHP under Windows][6] とか見てみるとis_dir()実装してないから動くわけないじゃん、、、

パッチ当てれば動くかもって話もあるんだけど、、、そこまでは現状困ってない(本番環境はLinux)のでまあ、phpがUnicode対応したらそのうち直るだろうから気長に待つとするかな。 一瞬、php-wfioの実装を見て、そうか！phpの拡張でmbstringみたいに標準関数をoverloadすればできるかも？とか思ったのは秘密だ。

これ、問題はFuelPHPの方どうするかなー？ is_dir()は意図しない動きするけどfiletype()は意図する動きなんだよなー、、、まあ、filetype()がうまく動いているのも偶然かもしれないけど、、、

まあ、ってなわけで初めてのバグ報告はすでに同じものが登録されていましたってことで、、、、報告済みのバグをよく確認しましょうってことで終了、、、かな？

 [1]: https://bugs.php.net/bug.php?id=64699
 [2]: http://d.hatena.ne.jp/hnw/20081022
 [3]: https://bugs.php.net/how-to-report.php
 [4]: https://bugs.php.net/bug.php?id=61315
 [5]: https://code.google.com/p/php-wfio/
 [6]: http://comments.gmane.org/gmane.comp.php.windows/18001