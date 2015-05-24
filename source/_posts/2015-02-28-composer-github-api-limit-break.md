---
title: "composer で github.com の API 制限を突破せよ"
date: 2015-02-28 23:38:00
tags: [php, Develop]
categories: [ブログ]

---

github のレポジトリを参照している場合に composer で update 時に

    $ php composer.phar update
    Loading composer repositories with package information
        Authentication required (api.github.com):         
          Username: 
          Password: 
    

の用な感じでユーザー名とパスワードを入力せよ！な状態になった場合、まあ素直に入力するのも手ですが、 token を発行して処理することも出来るようです。

## 手順

  1. [Authorized applications][1] にアクセス
  2. Personal access tokens の "Generate new token" を押下
  3. "Token description" を入力し "Generate token" を押下すると token が表示される
  4. composer に教える
    
        $ php composer.phar config -g github-oauth.github.com {発行したtoken}
        

 [1]: https://github.com/settings/applications#personal-access-tokens

で無事 API の制限を超えることが出来ます。

## 参考

  * [Authentication required, while manual file download succeeds ? Issue #2439 ? composer/composer][2]
  * [composer/troubleshooting.md at master ? composer/composer][3]

 [2]: https://github.com/composer/composer/issues/2439#issuecomment-33034375
 [3]: https://github.com/composer/composer/blob/master/doc/articles/troubleshooting.md#api-rate-limit-and-oauth-tokens
