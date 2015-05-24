---
title: "Tumblr. extend shortcut key 作りました"
date: 2014-11-23 17:51:00
tags: [Develop, Javascript, Userscript]
categories: [ブログ]

---

[Tumblr.][1]™のダッシュボードで使用できるショートカットキーを追加するスクリプトを作りました。

 [1]: https://www.tumblr.com/

レポジトリは [sharkpp-userscripts/tumblr-extend-shortcut-key][2] です。

 [2]: https://github.com/sharkpp-userscripts/tumblr-extend-shortcut-key

userscripts.org がいつの間にか死んでいたので [GreasyFork][3] を移転先にしてぼちぼちと再アップロードをしていきたいと思い、ユーザースクリプトの置き場を github に [sharkpp UserScripts][4] として作りました。

 [3]: https://greasyfork.org/ja/users/5799-sharkpp
 [4]: https://github.com/sharkpp-userscripts

とりあえず、リハビリをかねて新しく作ったスクリプトは GreasyFork の [Tumblr. extend shortcut key][5] からインストールできます。

 [5]: https://greasyfork.org/ja/scripts/6588-tumblr-extend-shortcut-key

## 機能の紹介

機能的な部分を、、、まあ、何が出来るかってと、 `alt + E` とかをリブログのポップアップ画面時にも出来るようにとか、ブログをショートカットキーで選択できるようにとか、そんな感じです。

### ショートカットキーの一覧

| ショートカットキー | 機能                                                           |
| ------------------------------------------------------------------------ | -------------------------------------------------------------------------- |
| <tt>alt + [数字キー]</tt>                        | ブログを選択                           |
| <tt>alt + R</tt>                                                         | 今すぐ投稿(リブログ) |
| <tt>alt + E</tt>                                                         | 予約投稿に追加                   |
| <tt>alt + D</tt>                                                         | 下書きに追加                           |

### ブログの選択

ブログが複数有る場合に `alt + [数字キー]` で、`[数字キー]` で指定したブログに切り替えることができます。

ブログが数字キーのどれに割り当てられているか？は、リストを表示することでショートカットキーが末尾に表示されるのため確認することが出来ます。

![ブログの選択][6]

 [6]: /images/2014_1123_blog-select.png

## 投稿指示

投稿指示は、「今すぐ投稿」と「予約投稿に追加」と「下書きに追加」に、それぞれショートカットキーが新たに割り当てられています。

ブログの選択と同じように、リストを表示することでショートカットキーの確認が出来ます。

![リブログボタン][7]

 [7]: /images/2014_1123_reblog-button.png
