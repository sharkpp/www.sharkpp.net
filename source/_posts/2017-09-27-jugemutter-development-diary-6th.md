---
title: "じゅげむったーの開発日記 その６"
date: 2017-09-27 12:40
tags: [Qt, Twitter, OAuth, C++, cpp, 勉強会, 開発日記, じゅげむったー, Wireshark, SSL, https]
categories: [ブログ]

---

遅くなりましたが、今月も引き続き参加した [Qt 勉強会 @ Nagoya No12 - connpass](https://qt-users.connpass.com/event/65548/) のまとめです。

重大発表があってちょっとびっくりでした。
それはともかく今回も長文投稿専用Twitterクライアントの開発の続きでした。

レポジトリは ... [sharkpp/Jugemutter: 長文投稿専用クライアント「じゅげむったー」](https://github.com/sharkpp/Jugemutter) となります。

画面は...変わってないからいいですね。

## 進捗

相変わらず `Could not authenticate you.` がなぜか出る、と。

そこで、先日に [sharkpp/http-peeper: This is a proxy server for peeping HTTP/HTTPS communication, mainly for debugging.](https://github.com/sharkpp/http-peeper) と言うツールを NodeJS でサクッと作ってみました。
一言で言うと https 通信の間に割り込んで中身を見てしまうツールです。

今回は、これの改良というか改善？をして、他のソフトの通信の内容と比較してみました。

まあ、結果として、少なくともパラメータやヘッダなどには特に違いがなさそうだ、という事がわかりました。
困ったことに、全く解決になっていないです...

あとは、HMACなどの計算時に無駄にエスケープしている事で、サーバー側での検証時と値が違うのかなぁと。
まあ、そうだとすると Qt 側のバグなのですが...

と、まあそんなところで終了。

まあ、あとは重大発表として Qt 勉強会 @ Nagoya が残念なことに今回で一旦休止の発表があり（次回が一旦の〆）となってしまいました。
なかなか、会場の都合が付かないので難しいですねぇ。

## 他のソフトの通信を覗き見

先のツール（[http-peeper](https://github.com/sharkpp/http-peeper)）、証明書は当然本物ではなく所謂オレオレ証明書と呼ばれているものを使っている都合、証明書の検証をしている（OpenSSL等のライブラリを使っている場合は基本検証している）とエラーが出てしまうのです。
そのために、そのままだと他のソフトには使えないのでした。
さてどうするか？と考えていたところ、そういえばオレオレ認証局の証明書を作りシステムに登録して信頼、その認証局で署名することで対応と書かれている記事を見かけた覚えがあったので、とりあえずツールに組み込む前に手作業でやって見ました。

### 手順

`openssl.conf` をコピーして書き換えたり、いろいろして見ましたが結局こんな感じで試しました。

```console
$ mkdir demoCA
$ cd demoCA
$ mkdir newcerts certs crl private
$ chmod 700 private
$ touch index.txt
$ echo 00 |tee serial
$ openssl req -batch -new -x509 -sha256 -days 36500 -newkey rsa:4096 -out ca.crt -keyout demoCA/private/ca.key -subj "/C=JP/ST=Tokyo/L=Tokyo/O=root.http-peeper.local/OU=root.http-peeper.local/CN=root.http-peeper.local"
$ openssl rsa -in demoCA/private/ca.key -out demoCA/private/ca.key
$ openssl req -batch -new -sha256 -days 36500 -newkey rsa:4096 -out demoCA/server.csr -keyout demoCA/private/server.key -batch -subj "/C=JP/ST=Tokyo/L=Tokyo/O=root.http-peeper.local/OU=api.twitter.com/CN=api.twitter.com"
$ openssl rsa -in demoCA/private/server.key -out demoCA/private/server.key
$ openssl ca -batch -days 36500 -keyfile demoCA/private/ca.key -cert demoCA/ca.crt -in demoCA/server.csr -out demoCA/server.crt
```

そして `ca.crt` を開き

![証明書の追加](/images/2017_0916_macos_cert_reg_to_system.png)

と、システムに登録します。

登録したら「キーチェーンアクセス」から証明書を探し

![証明書を右クリック](/images/2017_0916_macos_view_cert_detail.png)

右クリックで「情報を見る」から「常に信頼」を選び

![証明書を信頼](/images/2017_0916_macos_trust_root_cert.png)

と信頼させます。

![キーチェーンアクセス](/images/2017_0916_macos_trusted_cert.png)

「キーチェーンアクセス」では「この証明書はこのアカウントにとって信頼されている物として指定されています」と表示されています。

あとは、 `server.key` と `server.crt` を

```console
$ openssl x509 -in server.crt -out tmp.der -outform DER
$ openssl x509 -in tmp.der -inform DER -out server-cert.pem -outform pem
$ openssl rsa -in server.key -out tmp.der -outform DER
$ openssl rsa -in tmp.der -inform DER -out server-key.pem -outform pem
```

と .pem 形式に変換（元々.pemで利用していたため）し利用しました。

手順はツールに組み込んで自動化したいところですが、とりあえず他のソフトの通信を覗き見できるようになりました。

## 参考

* [Chrome58以降でハネられないSHA-2でオレオレ認証局署名のあるオレオレ証明書 - Qiita](http://qiita.com/mkgask/items/8d66dcada58a485e3585#_reference-0c1fe982bfae4639fb65)
* [オレだよオレオレ認証局で証明書つくる - Qiita](http://qiita.com/ll_kuma_ll/items/13c962a6a74874af39c6#20170508%E8%BF%BD%E8%A8%98)
* [オレオレ認証局とオレオレ証明書 - Qiita](http://qiita.com/softark/items/15a5280bd38c5dd97b48)
* [SSL証明書設定でよくやってることをまとめる。 - Qiita](http://qiita.com/NakashimaKeisuke_zerodaynet/items/bfc77e5fe98b587532d0)
* [RSA鍵、証明書のファイルフォーマットについて - Qiita](http://qiita.com/kunichiko/items/12cbccaadcbf41c72735)
* [SSL証明書を.crtから.pemに変換する方法 | ハックノート](https://hacknote.jp/archives/13939/)
* [OpenSSL - OpenSSL "ca" Error "... directory for new certificate ..."](http://certificate.fyicenter.com/2134_OpenSSL_ca_Error_..._directory_for_new_certificate_..._.html)
