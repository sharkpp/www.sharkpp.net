---
title: "Opscode Community に自作の Cookbook を登録してみた"
tags: [chef, Cookbook]
categories: [blog]

---

必要に迫られて作成した [ya-piwik][1] を \[Opscode Community\] (http://community.opscode.com/) に登録してみました。 もしか、動かなかったりするかもですがそのときはタイミングを見て直そうかと思います。 とりあえず自分所では動いています。

登録した Cookbook は [Chef Cookbook: ya-piwik - Opscode Community][2] から確認できます。

## アカウント登録

まず、\[Opscode Community\] (http://community.opscode.com/) の右上の [Sign up][3] からアカウント登録します。

アカウント登録後に、 private key が表示されますが、Cookbook の登録には必要ありません。

## Cookbook を登録

### 準備

Cookbook の登録は tarball として固めたファイルをアップロードするので、

    COOKBOOK_NAME
     +-- README.md
     +-- metadata.json
     +-- recipes
     |    +-- default.rb 
     +-- attributes
          +-- default.rb 
    

の用な感じでルートも含めて圧縮します。 なお zip 形式でも認識するようです。

また、 Cookbook を登録するときには `metadata.json` が必要となるようです。

metadata.rb から metadata.json を作成するには

    # cd COOKBOOK_NAME
    # knife cookbook metadata -o ../ COOKBOOK_NAME
    

とすれば OK です。

### 登録

[Cookbook][4] から [Add New Cookbook][5] をたどり Cookbook を登録します。 (トップページからは追加のリンクが無いようでちょっと迷いました)

タグは付けなくてよいようです。

ya-piwik は次のように入力しました。

![][6]

ついでに登録後に Edit cookbook からホームページの登録が出来るので github のページなどを登録しておきます。

### 登録時のエラーと対処方法

最後に Cookbook 登録時に表示されるエラーの対処方法を数は少ないですがまとめました。

  * `"Cookbook must contain metadata.json"` - `metadata.json` が存在していないので追加する必要が有る
  * `"Cookbook folder must match cookbook name"` - tarball内のルートのフォルダ名がcookbookと一致していない(例えば、githubのZIPダウンロードしたファイルのように)
  * `"Cookbook must contain only a single directory"` - 1つのCookbookのみを追加できる(Macで圧縮するとMacリソースが含まれてしまうことが有るので注意！)

 [1]: https://github.com/sharkpp-cookbooks/ya-piwik
 [2]: http://community.opscode.com/cookbooks/ya-piwik
 [3]: http://community.opscode.com/users/new
 [4]: http://community.opscode.com/cookbooks
 [5]: http://community.opscode.com/cookbooks/new
 [6]: /public/images/2014_0630_add_new_ya_piwik_field_fill.png