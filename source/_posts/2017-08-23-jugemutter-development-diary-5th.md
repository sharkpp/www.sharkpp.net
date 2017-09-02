---
title: "じゅげむったーの開発日記 その５"
date: 2017-08-23 01:50
update: 2017-08-31 00:50
tags: [Qt, Twitter, OAuth, C++, cpp, 勉強会, 開発日記, じゅげむったー, Wireshark, SSL, https]
categories: [ブログ]

---

さて、今月も引き続き参加した [Qt 勉強会 @ Nagoya No11 - connpass](https://qt-users.connpass.com/event/62861/) のまとめ。

つぶやきは [Qt 勉強会 @ Nagoya No11 つぶやきまとめ - Togetterまとめ](https://togetter.com/li/1146658) でまとめられています。

先月の勉強会から日付(YY.MM)が付かなくなりました。

さて、今回も長文投稿専用Twitterクライアントの開発の続きをしました。

レポジトリは ... [sharkpp/Jugemutter: 長文投稿専用クライアント「じゅげむったー」](https://github.com/sharkpp/Jugemutter) です。

![画面](/images/2017_0819_jugemutter1.png)

## 進捗

![テスト画面](/images/2017_0819_jugemutter2.png)

とりあえず、分割処理のいろんなパターンのテストがやっと通ったので、ようやく一山越えた感じです。
ここまで長かった。

で、`Could not authenticate you.` がなぜか出る、と。
これは、[Error Codes & Responses — Twitter Developers](https://dev.twitter.com/overview/api/response-codes) によると、『<ruby>ダイヤルしても通話を完了できませんでした。<rp>(</rp><rt>Your call could not be completed as dialed.</rt><rp>)</rp></ruby>』って意味らしい。

## Wireshark で https の中身の確認

Twitter の API への指示がおかしいらしいので、なんとか調べられないかとググってた所、Wiresharkでhttpsの中身が確認できるとの記事を発見。

```
# SSLKEYLOGFILE=~/tls_key.log {ChromeやFirefox、cURLなどのパス}
```

で起動し、Wireshark で

![Wireshark](/images/2017_0819_https_decrypt_in_wireshark.png)

と、このような設定をすれば良いらしい。

が、解析画面

![Wireshark](/images/2017_0819_wireshark.png)

を見ても、 <del>`Decrypted SSL Data` なんてタブはもちろん、`Frame` などのタブも表示されていないので、もしかしてUIがQtベースになった時に何か変わったのかもしれない。</del>

![Wireshark](/images/2017_0831_wireshark.png)

`RSA keys list` の設定を触って居たら、なぜかタブが出るようになった。
実装自体はされているようだ。


あと、そもそもの話、Qtの通信を覗きたいのが目的。
なので、Qtで上の方法が使えないと意味がないんだけど使えるのだろうか？

## 参考

* [暗号化された Application Data を復号する - Qiita](http://qiita.com/Hexa/items/ce0ac23526df12a64ad0)
* [Floating Octothorpe: Decrypting HTTPS traffic without a key](https://f-o.org.uk/2017/decrypting-https-traffic-without-a-key.html)
* [How can I filter https when monitoring traffic with Wireshark? - Server Fault](https://serverfault.com/questions/263530/how-can-i-filter-https-when-monitoring-traffic-with-wireshark)
* [Wireshark を用いて、クライアント側の情報のみでHTTPS 通信を複合する方法](http://troushoo.blog.fc2.com/blog-entry-234.html)
* [HTTPSのパケットをwiresharkで見てみる - Qiita](http://qiita.com/toshihirock/items/acbf9800f7e784118e46)
* [Wireshark で HTTP/2 over TLS の通信をダンプする方法](https://gist.github.com/summerwind/a482dd1f8e9887d26199)
* [NSS Key Log Format - Mozilla | MDN](https://developer.mozilla.org/en-US/docs/Mozilla/Projects/NSS/Key_Log_Format)
