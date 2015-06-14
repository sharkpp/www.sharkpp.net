---
title: "SNSの共有ボタンを設置できる jQuery (他も含む) プラグインをまとめてみた"
date: 2015-06-14 16:00
tags: [まとめ, Javascript, jQuery, SNS, Twitter, Facebook]
categories: [まとめ, Javascript]

---

記事ページに Twitter とか Facebook とかの共有ボタンを設置したいなぁと思い、 AddThis で試しに追加してみると、、、なんと言うことでしょう、 AdBlock でボタンが消えてしまうではないですかorz

ということで、公式のコードをぺたりんこするか jQuery などのプラグインで設置するかを悩み、また、ボタンのデザインをカスタマイズできないかと jQuery を使って設置できるプラグインを調べてまとめてみました。

基本的には jQuery をキーワードに調べたので jQuery のプラグインですが、それ以外にも引っかかったので一応は乗せてあります。

[Social Share Button Plugin - Google スプレッドシート](https://docs.google.com/spreadsheets/d/1_tXrnlwV5Vbql-5yEgcPZ3q7PcIlV6DxHD4BJLExUgc/edit?usp=sharing)

## めとめ

ざっくりとした感じとしては、日本のサービスはやっぱりあまりサポートされていないなぁということ。

Hatena Bookmark とかほとんどサポートされていませんでした。

あと、 StumbleUpon って知らなかったのですが人気があるんでしょうか？

ちなみに、 `btn` はボタンの設置が出来る、 `cnt` はカウンターの表示あり、です。

| Plugins | Depends | Design | Mail | Facebook<br/>share | Facebooklike | Twitter | Pinterest | Google+<br/>share | Google+1 | LinkedIn<br/>share | LinkedIn<br/>recommend | Hatena<br/>bookmark | mixi<br/>like | mixi<br/>check | GREE<br/>like | LINE<br/>send | Evernote | Digg | StumbleUpon | Pocket | Delicious | GitHub | Tumblr | reddit | blogger | friendfeed | Myspace | Dribbble | Scoutzie | Hacker News<br/>share | Sumally | Fancy | & more |
|---------|---------|--------|------|--------------------|--------------|---------|-----------|-------------------|----------|--------------------|------------------------|---------------------|---------------|----------------|---------------|---------------|----------|------|-------------|--------|-----------|--------|--------|--------|---------|------------|---------|----------|----------|-----------------------|---------|-------|--------|
| [jQuery.socialbutton](http://itra.jp/jquery_socialbutton_plugin/) | jQuery | native |  | btn,cnt | btn | btn,cnt | btn |  | btn |  |  | btn,cnt | btn,cnt | btn | btn |  | btn |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |
| [Sharrre](http://sharrre.com/) | jQuery | native,custom,graph |  | btn,cnt | btn,cnt | btn,cnt | btn | btn,cnt |  | btn,cnt |  |  |  |  |  |  |  | btn,cnt | btn,cnt |  | btn,cnt |  |  |  |  |  |  |  |  |  |  |  |  |
| [RRSSB](http://kurtnoble.com/labs/rrssb/) | jQuery | custom | btn | btn |  | btn | btn | btn |  | btn |  |  |  |  |  |  |  |  |  |  |  | btn |  |  |  |  |  |  |  |  |  |  |  |
| [Flati Social Share Plugin](http://www.voidtricks.com/flati-social-share-plugin-jquery/) | jQuery | custom |  | btn |  | btn | btn | btn |  | btn |  |  |  |  |  |  |  | btn | btn |  |  |  | btn | btn |  |  |  |  |  |  |  |  |  |
| [#50C1AL Share](http://tolgaergin.com/files/social/) | jQuery | popup |  | btn |  | btn | btn | btn |  | btn |  |  |  |  |  |  |  | btn | btn |  | btn |  | btn | btn | btn | btn | btn | btn | btn |  |  |  |  |
| [Minishare](http://rawgit.com/dwhewitson/minishare/master/demo.html) | jQuery | native |  | btn |  | btn |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |
| [HIDESHARE](http://arnonate.github.io/hideshare/) | jQuery | popup |  | btn |  | btn | btn | btn |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |
| [floatShare](http://egrappler.com/jquery-floating-social-share-plugin-floatshare/) | jQuery | native,custom |  | btn,cnt |  | btn,cnt |  | btn,cnt |  | btn,cnt |  |  |  |  |  |  |  | btn,cnt | btn,cnt |  |  |  |  |  |  |  |  |  |  |  |  |  |  |
| [jsSocials](http://js-socials.com/) | jQuery | native,custom | btn | btn,cnt |  | btn,cnt | btn,cnt | btn,cnt |  | btn,cnt |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |
| [socialShare.js](https://github.com/ritz078/socialShare.js) | jQuery | custom |  | btn,cnt |  | btn,cnt | btn,cnt | btn,cnt |  | btn,cnt |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |
| [jQuery-Awesome-Sosmed-Share-Button](https://github.com/bachors/jQuery-Awesome-Sosmed-Share-Button) | jQuery,fontawesome | custom |  | btn,cnt |  | btn,cnt |  | btn,cnt |  | btn,cnt |  |  |  |  |  |  |  |  | btn,cnt |  |  |  |  | btn,cnt |  |  |  |  |  |  |  |  |  |
| [Social Likes](http://sapegin.github.io/social-likes/) | jQuery | native,custom |  | btn,cnt |  | btn,cnt | btn | btn,cnt |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |
| [SocialCount](https://github.com/filamentgroup/SocialCount/) | jQuery | custom |  |  | btn,cnt | btn,cnt | btn |  | btn,cnt |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |
| [jquery.kyco.easyshare](https://github.com/kyco/jquery.kyco.easyshare) | jQuery,php | custom |  | btn,cnt |  | btn,cnt |  |  | btn,cnt |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |
| [jQuery.socialthings](https://github.com/Takazudo/jQuery.socialthings) | jQuery | native |  | btn,cnt | btn,cnt | btn,cnt |  |  | btn,cnt |  |  | btn,cnt |  | btn |  | btn |  |  |  | btn,cnt |  |  |  |  |  |  |  |  |  |  | btn |  |  |
| [SocialShare.js](https://github.com/AyumuKasuga/SocialShare) | jQuery | custom |  | btn,cnt |  | btn,cnt | btn,cnt | btn |  | btn,cnt |  | btn |  | btn |  |  | btn | btn | btn | btn | btn |  | btn | btn | btn | btn | btn |  |  | btn |  |  | btn |
| [jQuery Social Sharing Buttons](https://github.com/cshold/social-sharing-buttons) | jQuery | custom |  | btn,cnt |  | btn,cnt | btn |  | btn |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  | btn |  |
| [jQuery Social Buttons](https://github.com/michaek/jquery-socialButtons) | jQuery | custom |  | btn,cnt |  | btn,cnt | btn,cnt |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |
| [jquery.sitekit/social-buttons](https://github.com/cyokodog/jquery.sitekit/tree/gh-pages/social-buttons) | jQuery | native |  |  | btn,cnt | btn,cnt |  |  | btn,cnt |  |  | btn,cnt |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |
| [share-button](http://sharebutton.co/) | none | popup | btn | btn |  | btn | btn | btn |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |  |
| [Slingpic](http://slingpic.com/) | none | popup | btn,cnt | btn,cnt |  | btn,cnt | btn,cnt |  |  | btn |  |  |  |  |  |  |  | btn |  |  | btn |  | btn | btn |  | btn | btn |  |  |  |  |  |  |
| [Socialite](http://socialitejs.com/) | none | native |  |  | btn,cnt | btn,cnt | btn | btn | btn,cnt | btn,cnt | btn |  |  |  |  |  |  |  |  |  |  | btn |  |  |  |  |  |  |  | btn |  |  |  |

## 参考

* [10 Social Sharing jQuery Plugins You May Have Missed](http://www.sitepoint.com/10-social-sharing-jquery-plugins-missed/)
* [social share button | jQuery Plugins](http://jquery-plugins.net/tag/social-share-button)
* [35+ jQuery Social Share Plugin with Example](http://www.jqueryrain.com/demo/jquery-social-share-plugin/)
