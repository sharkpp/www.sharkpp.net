---
title: "SqaleでFuelPHPを動かしてみました"
date: 2013-03-17 01:34:00
tags: [php, FuelPHP]
categories: [blog]

---

[fuelphp.jpのGoogleグループ][1]で [Sqale『無料アプリケーション1個 プレゼント』キャンペーン実施中！ | Sqale Information][2] なんてものをやってるのを知ったので早速登録してみました。(※3/17まで)

 [1]: https://groups.google.com/group/fuelphp_jp?hl=ja
 [2]: http://info.sqale.jp/?eid=33

立ち上げてみたページは↓

  * <http://fuelphp-sharkpp.sqale.jp/>
  * [http:/sqale.sharkpp.net/][3] ※独自ドメインを設定

 [3]: http://sqale.sharkpp.net/

## 登録

とりあえず、ページの手順通りにアカウントの登録とアプリケーションの登録をします。 ユーザー名とアプリケーション名を決めるのですが、公開用のURLが `http://{アプリケーション名}-{ユーザー名}.sqale.jp/` となるため、 うまいこと考えないと間抜けなアドレスになってしまいます。 独自のドメインを設定する方法もあります。

トップページからユーザー登録します。

[![トップページ][4]][5]

 [4]: /images/2013_0317_sqale_01_s.png
 [5]: /images/2013_0317_sqale_01.png

Twitterやfacebook、githubのアカウントを使っての登録もできます。

[![アカウント登録][6]][7]

 [6]: /images/2013_0317_sqale_02_s.png
 [7]: /images/2013_0317_sqale_02.png

登録が完了するとダッシュボードが表示されるので、続けてアプリケーションも登録しましょう。

[![登録直後のダッシュボード][8]][9]

 [8]: /images/2013_0317_sqale_03_dashboard_s.png
 [9]: /images/2013_0317_sqale_03_dashboard.png

ここで登録したアプリケーション名は、 `http://{アプリケーション名}-{ユーザー名}.sqale.jp/` の形式で公開アドレスに使われます。 なので、適当に自分の名前とかにすると、 `http://sharkpp-sharkpp.sqale.jp/` と、間抜けな感じになります(なります、なってしまったので、一旦削除しましたorz)

[![アプリケーションの登録][10]][11]

 [10]: /images/2013_0317_sqale_04_add_app_s.png
 [11]: /images/2013_0317_sqale_04_add_app.png

アプリケーションも登録完了です。 準備ができても勝手にリロードされないので、指示のとおり30秒ぐらい経ったらリロードしましょう。

[![アプリケーション登録直後のダッシュボード][12]][13]

 [12]: /images/2013_0317_sqale_05_dashboard_s.png
 [13]: /images/2013_0317_sqale_05_dashboard.png

リロードすると、アプリケーション詳細画面が表示されます。

[![アプリケーション詳細画面][14]][15]

 [14]: /images/2013_0317_sqale_06_dashboard_s.png
 [15]: /images/2013_0317_sqale_06_dashboard.png

登録直後の公開用ページ

[![登録直後の公開ページ][16]][17]

 [16]: /images/2013_0317_sqale_07_all_ready_s.png
 [17]: /images/2013_0317_sqale_07_all_ready.png

最後に、問い合わせフォームからキャンペーンの申し込みをしておきます。

登録完了すると、ステータスが契約状態：Freeになります。

[![契約状態][18]][19]

 [18]: /images/2013_0317_sqale_08_free_s.png
 [19]: /images/2013_0317_sqale_08_free.png

と、このように登録が完了したところで、本題のFuelPHPをアップします。

## FuelPHPを動かしてみる

サポートページの[Sqale - Sqale で FuelPHP を利用する][20]に やり方が書いてあるので参考にします。 とりあえず、SFTPで転送してみます。

 [20]: https://sqale.jp/support/manual/fuelphp

自分は、[WinSCP][21]を使っているのでこいつで転送しました。 ログイン情報はダッシュボードのアプリケーション詳細に書かれています。

 [21]: http://winscp.net/

[![アプリケーション詳細画面２][22]][23]

 [22]: /images/2013_0317_sqale_09_dashboard_s.png
 [23]: /images/2013_0317_sqale_09_dashboard.png

これで、しばらくすると、ダッシュボード上で、「ビルドを開始」→「ビルドが完了」→「デプロイを開始」→「デプロイが完了」と表示されるので、 ページをリロードすると確認できると思います。 SFTPの転送に時間がかかりますが簡単ですね！

[![公開ページ][24]][25]

 [24]: /images/2013_0317_sqale_10_fuelphp_s.png
 [25]: /images/2013_0317_sqale_10_fuelphp.png

さて、デフォルトではdevelopment環境になってるので、環境変数を設定してproduction環境にします、、、と思ったのだけれど、まだうまく動作しないみたいです。 問い合わせたら、もうすぐ動くようになるとのことなので期待しましょう。

## gitでのデプロイ

gitでのデプロイは、ダッシュボードからSFTPではなくGITを選択することでできます。

[![git][26]][27]

 [26]: /images/2013_0317_sqale_13_git_s.png
 [27]: /images/2013_0317_sqale_13_git.png

選択をするとgitのアドレスが表示されるので git clone や git add remote などを使って関連付けます。 認証は公開鍵の使用を前提としているので予め公開鍵をアップしておきます。

[Sqale - Getting Started for Windows][28]の先頭あたりが参考になります。

 [28]: https://sqale.jp/support/manual/getting-started-win

[![ダッシュボード][29]][30]

 [29]: /images/2013_0317_sqale_14_dashboard_s.png
 [30]: /images/2013_0317_sqale_14_dashboard.png

## 独自ドメインの割り当て

*-*.sqale.jp ではなく、独自ドメインで公開したい場合は、

[![ドメインの割り当て][31]][32]

 [31]: /images/2013_0317_sqale_11_domain_s.png
 [32]: /images/2013_0317_sqale_11_domain.png

[![ドメインの割り当て][33]][34]

 [33]: /images/2013_0317_sqale_12_domain_s.png
 [34]: /images/2013_0317_sqale_12_domain.png

で設定して、DNSのCNAMEで、設定すると公開できます。

## まとめ

  * SFTPやGIT、SSHなどデータのアップ方法が選べる
  * FuelPHPも簡単に動かせる
  * 公開用のディレクトリ外部にファイルが置ける
  * 独自ドメインが指定できる
  * .htaccess が機能していないっぽい
  * 環境変数を設定できない(FUEL_ENVの指定やデータベースのパスワードの指定など) ※後日対応予定とのこと
  * メンテナンスモードがない(これは一般的な機能なんだろうか？)

と、少し痒いところに手が届かない感じではありますが、サービスの公開用としても十分な感じがします。