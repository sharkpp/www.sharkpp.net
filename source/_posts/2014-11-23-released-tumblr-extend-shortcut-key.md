---
title: "Tumblr. extend shortcut key 作りました"
tags: [develop, JavaScript, UserScript]
categories: [blog]

---

[Tumblr.][1]™のダッシュボードで使用できるショートカットキーを追加するスクリプトを作りました。

レポジトリは [sharkpp-userscripts/tumblr-extend-shortcut-key][2] です。

userscripts.org がいつの間にか死んでいたので [GreasyFork][3] を移転先にしてぼちぼちと再アップロードをしていきたいと思い、ユーザースクリプトの置き場を github に [sharkpp UserScripts][4] として作りました。

とりあえず、リハビリをかねて新しく作ったスクリプトは GreasyFork の [Tumblr. extend shortcut key][5] からインストールできます。

## 機能の紹介

機能的な部分を、、、まあ、何が出来るかってと、 `alt + E` とかをリブログのポップアップ画面時にも出来るようにとか、ブログをショートカットキーで選択できるようにとか、そんな感じです。

### ショートカットキーの一覧

<table>
  <tr>
    <th>
      ショートカットキー
    </th>
    
    <th>
      機能
    </th>
  </tr>
  
  <tr>
    <td>
      <tt>alt + [数字キー]</tt>
    </td>
    
    <td>
      ブログを選択
    </td>
  </tr>
  
  <tr>
    <td>
      <tt>alt + R</tt>
    </td>
    
    <td>
      今すぐ投稿(リブログ)
    </td>
  </tr>
  
  <tr>
    <td>
      <tt>alt + E</tt>
    </td>
    
    <td>
      予約投稿に追加
    </td>
  </tr>
  
  <tr>
    <td>
      <tt>alt + D</tt>
    </td>
    
    <td>
      下書きに追加
    </td>
  </tr>
</table>

### ブログの選択

ブログが複数有る場合に `alt + [数字キー]` で、`[数字キー]` で指定したブログに切り替えることができます。

ブログが数字キーのどれに割り当てられているか？は、リストを表示することでショートカットキーが末尾に表示されるのため確認することが出来ます。

![ブログの選択][6]

## 投稿指示

投稿指示は、「今すぐ投稿」と「予約投稿に追加」と「下書きに追加」に、それぞれショートカットキーが新たに割り当てられています。

ブログの選択と同じように、リストを表示することでショートカットキーの確認が出来ます。

![リブログボタン][7]

 [1]: https://www.tumblr.com/
 [2]: https://github.com/sharkpp-userscripts/tumblr-extend-shortcut-key
 [3]: https://greasyfork.org/ja/users/5799-sharkpp
 [4]: https://github.com/sharkpp-userscripts
 [5]: https://greasyfork.org/ja/scripts/6588-tumblr-extend-shortcut-key
 [6]: /public/images/2014_1123_blog-select.png
 [7]: /public/images/2014_1123_reblog-button.png