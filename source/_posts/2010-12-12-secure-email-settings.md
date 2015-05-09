---
title: "セキュアな電子メールの設定"
tags: [雑記]
categories: [blog]

---

他ごと始めちゃったのでEdMaxのメールボックスからThunderbirdのメールボックスへの変換は中断してますorz

過去のメールは取り敢えず捨て置いてThunderbirdへ移行しちゃいました。

で、折角POP over SSLなどなど安全な接続が使えるので設定してしまおうと言うことで、既存のメールを全てThunderbirdで管理するようにしました。

xreaなどの設定が結構時間がかかったのでメモ代わりに公開します。

#### [inter7.jp][1]

プロトコル：POP

サーバー名：pop.inter7.jp:995

ユーザー名：_アカウント名_

接続の保護：SSL/TLS

認証方式　：通常のパスワード認証

#### [xrea+][2]

プロトコル：POP

サーバー名：_サーバー名_.value-domain.com:995

※_サーバー名_は、例えば、_s152.xrea.com_なら_s152-xrea-com_で_s152-xrea-com.value-domain.com_なかんじ

ユーザー名：_メールアドレス(hoge@example.netのような感じ)_

接続の保護：SSL/TLS

認証方式　：通常のパスワード認証



  


プロトコル：SMTP

サーバー名：_サーバー名_.value-domain.com:465

ユーザー名：_メールアドレス(hoge@example.netのような感じ)_

接続の保護：SSL/TLS

認証方式　：通常のパスワード認証

#### [Yahoo mail][3]

プロトコル：POP

サーバー名：pop.mail.yahoo.co.jp:995

ユーザー名：_アカウント名_

接続の保護：SSL/TLS

認証方式　：通常のパスワード認証



  


プロトコル：SMTP

サーバー名：smtp.mail.yahoo.co.jp:465

ユーザー名：_アカウント名_

接続の保護：SSL/TLS

認証方式　：通常のパスワード認証

#### [Microsoft Live Hotmail][4]

プロトコル：POP

サーバー名：pop3.live.com:995

ユーザー名：_アカウント名(Windows Live ID)_

接続の保護：SSL/TLS

認証方式　：通常のパスワード認証



  


プロトコル：SMTP

サーバー名：smtp.live.com:587

ユーザー名：_アカウント名(Windows Live ID)_

接続の保護：STARTTLS

認証方式　：通常のパスワード認証

#### [GMail][5]

プロトコル：IMAP

サーバー名：imap.googlemail.com:993

ユーザー名：_アカウント名_

接続の保護：SSL/TLS

認証方式　：通常のパスワード認証



  


プロトコル：SMTP

サーバー名：smtp.googlemail.com:465

ユーザー名：_アカウント名_

接続の保護：SSL/TLS

認証方式　：通常のパスワード認証



  


こんな感じで、合計7アカウントを取り敢えず登録してあります。

GMailやYahooやHotmailはメールアドレスなどを入力すると自動でサーバーを探してくれました。

 [1]: http://www.inter7.jp/
 [2]: http://www.xrea.com/
 [3]: http://www.yahoo.co.jp/
 [4]: http://www.live.com/
 [5]: http://www.googlemail.com/