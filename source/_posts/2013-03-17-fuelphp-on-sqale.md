---
title: "SqaleでFuelPHPを動かしてみました"
tags: [php, FuelPHP]
categories: [blog]

---

[fuelphp.jpのGoogleグループ][1]で [Sqale『無料アプリケーション1個 プレゼント』キャンペーン実施中！ | Sqale Information][2] なんてものをやってるのを知ったので早速登録してみました。(※3/17まで)

立ち上げてみたページは↓

  * <http://fuelphp-sharkpp.sqale.jp/>
  * [http:/sqale.sharkpp.net/][3] ※独自ドメインを設定

## 登録

とりあえず、ページの手順通りにアカウントの登録とアプリケーションの登録をします。 ユーザー名とアプリケーション名を決めるのですが、公開用のURLが `http://{アプリケーション名}-{ユーザー名}.sqale.jp/` となるため、 うまいこと考えないと間抜けなアドレスになってしまいます。 独自のドメインを設定する方法もあります。

トップページからユーザー登録します。

<a href="/public/images/20130317_sqale_01.png" rel="lytebox[x2013_0317_sqale]" title="トップページ"><img src="/public/images/20130317_sqale_01_s.png" alt="トップページ" /></a>

Twitterやfacebook、githubのアカウントを使っての登録もできます。

<a href="/public/images/20130317_sqale_02.png" rel="lytebox[x2013_0317_sqale]" title="アカウント登録"><img src="/public/images/20130317_sqale_02_s.png" alt="アカウント登録" /></a>

登録が完了するとダッシュボードが表示されるので、続けてアプリケーションも登録しましょう。

<a href="/public/images/20130317_sqale_03_dashboard.png" rel="lytebox[x2013_0317_sqale]" title="登録直後のダッシュボード"><img src="/public/images/20130317_sqale_03_dashboard_s.png" alt="登録直後のダッシュボード" /></a>

ここで登録したアプリケーション名は、 `http://{アプリケーション名}-{ユーザー名}.sqale.jp/` の形式で公開アドレスに使われます。 なので、適当に自分の名前とかにすると、 `http://sharkpp-sharkpp.sqale.jp/` と、間抜けな感じになります(なります、なってしまったので、一旦削除しましたorz)

<a href="/public/images/20130317_sqale_04_add_app.png" rel="lytebox[x2013_0317_sqale]" title="アプリケーションの登録"><img src="/public/images/20130317_sqale_04_add_app_s.png" alt="アプリケーションの登録" /></a>

アプリケーションも登録完了です。 準備ができても勝手にリロードされないので、指示のとおり30秒ぐらい経ったらリロードしましょう。

<a href="/public/images/20130317_sqale_05_dashboard.png" rel="lytebox[x2013_0317_sqale]" title="アプリケーション登録直後のダッシュボード"><img src="/public/images/20130317_sqale_05_dashboard_s.png" alt="アプリケーション登録直後のダッシュボード" /></a>

リロードすると、アプリケーション詳細画面が表示されます。

<a href="/public/images/20130317_sqale_06_dashboard.png" rel="lytebox[x2013_0317_sqale]" title="アプリケーション詳細画面"><img src="/public/images/20130317_sqale_06_dashboard_s.png" alt="アプリケーション詳細画面" /></a>

登録直後の公開用ページ

<a href="/public/images/20130317_sqale_07_all_ready.png" rel="lytebox[x2013_0317_sqale]" title="登録直後の公開ページ"><img src="/public/images/20130317_sqale_07_all_ready_s.png" alt="登録直後の公開ページ" /></a>

最後に、問い合わせフォームからキャンペーンの申し込みをしておきます。

登録完了すると、ステータスが契約状態：Freeになります。

<a href="/public/images/20130317_sqale_08_free.png" rel="lytebox[x2013_0317_sqale]" title="契約状態"><img src="/public/images/20130317_sqale_08_free_s.png" alt="契約状態" /></a>

と、このように登録が完了したところで、本題のFuelPHPをアップします。

## FuelPHPを動かしてみる

サポートページの[Sqale - Sqale で FuelPHP を利用する][4]に やり方が書いてあるので参考にします。 とりあえず、SFTPで転送してみます。

自分は、[WinSCP][5]を使っているのでこいつで転送しました。 ログイン情報はダッシュボードのアプリケーション詳細に書かれています。

<a href="/public/images/20130317_sqale_09_dashboard.png" rel="lytebox[x2013_0317_sqale]" title="アプリケーション詳細画面２"><img src="/public/images/20130317_sqale_09_dashboard_s.png" alt="アプリケーション詳細画面２" /></a>

これで、しばらくすると、ダッシュボード上で、「ビルドを開始」→「ビルドが完了」→「デプロイを開始」→「デプロイが完了」と表示されるので、 ページをリロードすると確認できると思います。 SFTPの転送に時間がかかりますが簡単ですね！

<a href="/public/images/20130317_sqale_10_fuelphp.png" rel="lytebox[x2013_0317_sqale]" title="公開ページ"><img src="/public/images/20130317_sqale_10_fuelphp_s.png" alt="公開ページ" /></a>

さて、デフォルトではdevelopment環境になってるので、環境変数を設定してproduction環境にします、、、と思ったのだけれど、まだうまく動作しないみたいです。 問い合わせたら、もうすぐ動くようになるとのことなので期待しましょう。

## gitでのデプロイ

gitでのデプロイは、ダッシュボードからSFTPではなくGITを選択することでできます。

<a href="/public/images/20130317_sqale_13_git.png" rel="lytebox[x2013_0317_sqale]" title="git"><img src="/public/images/20130317_sqale_13_git_s.png" alt="git" /></a>

選択をするとgitのアドレスが表示されるので git clone や git add remote などを使って関連付けます。 認証は公開鍵の使用を前提としているので予め公開鍵をアップしておきます。

[Sqale - Getting Started for Windows][6]の先頭あたりが参考になります。

<a href="/public/images/20130317_sqale_14_dashboard.png" rel="lytebox[x2013_0317_sqale]" title="ダッシュボード"><img src="/public/images/20130317_sqale_14_dashboard_s.png" alt="ダッシュボード" /></a>

## 独自ドメインの割り当て

*-*.sqale.jp ではなく、独自ドメインで公開したい場合は、

<a href="/public/images/20130317_sqale_11_domain.png" rel="lytebox[x2013_0317_sqale]" title="ドメインの割り当て"><img src="/public/images/20130317_sqale_11_domain_s.png" alt="ドメインの割り当て" /></a>

<a href="/public/images/20130317_sqale_12_domain.png" rel="lytebox[x2013_0317_sqale]" title="ドメインの割り当て"><img src="/public/images/20130317_sqale_12_domain_s.png" alt="ドメインの割り当て" /></a>

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

 [1]: https://groups.google.com/group/fuelphp_jp?hl=ja
 [2]: http://info.sqale.jp/?eid=33
 [3]: http://sqale.sharkpp.net/
 [4]: https://sqale.jp/support/manual/fuelphp
 [5]: http://winscp.net/
 [6]: https://sqale.jp/support/manual/getting-started-win