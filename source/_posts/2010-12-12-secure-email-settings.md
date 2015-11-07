---
title: "セキュアな電子メールの設定(追記あり)"
date: 2010-12-12 20:39:00
tags: [雑記, メール, Thunderbird]
categories: [ブログ]

---

{% import 'post_alert.html' as m %}
{{ m.alert('2015-11-07 追記', 'inter7.jp は 2014年12月20日 12時00分 にサービスの提供を終了しました。そのため下記の該当内容は過去の参考としてのみ残してあります。') }}

他ごと始めちゃったので EdMax のメールボックスから Thunderbird のメールボックスへの変換は中断してますorz

過去のメールは取り敢えず捨て置いて Thunderbird へ移行しちゃいました。

で、折角 POP over SSL などなど安全な接続が使えるので設定してしまおうと言うことで、既存のメールを全て Thunderbird で管理するようにしました。

xrea などの設定が結構時間がかかったのでメモ代わりに公開します。

## inter7.jp

| inter7.jp | http://www.inter7.jp/ |
|-----------|-----|
| プロトコル | POP3 |
| サーバー名 | pop.inter7.jp:995 |
| ユーザー名 | _アカウント名_ |
| 接続の保護 | SSL/TLS |
| 認証方式 | 通常のパスワード認証 |

## xrea+

| xrea+ | http://www.xrea.com/ |
|-----------|-----|
| プロトコル | POP3 |
| サーバー名 | _サーバー名_.value-domain.com:995<br/>※_サーバー名_ は、例えば、_s152.xrea.com_ なら _s152-xrea-com_ で _s152-xrea-com.value-domain.com_ なかんじ |
| ユーザー名 | _メールアドレス(hoge@example.netのような感じ)_ |
| 接続の保護 | SSL/TLS |
| 認証方式 | 通常のパスワード認証 |

| xrea+ | http://www.xrea.com/ |
|-----------|-----|
| プロトコル | SMTP |
| サーバー名 | _サーバー名_.value-domain.com:465 |
| ユーザー名 | _メールアドレス(hoge@example.netのような感じ)_ |
| 接続の保護 | SSL/TLS |
| 認証方式 | 通常のパスワード認証 |

## Yahoo!メール

| Yahoo!メール | http://www.yahoo.co.jp/ |
|-----------|-----|
| プロトコル | POP3 |
| サーバー名 | pop.mail.yahoo.co.jp:995 |
| ユーザー名 | _アカウント名_ |
| 接続の保護 | SSL/TLS |
| 認証方式 | 通常のパスワード認証 |

| Yahoo!メール | http://www.yahoo.co.jp/ |
|-----------|-----|
| プロトコル | SMTP |
| サーバー名 | smtp.mail.yahoo.co.jp:465 |
| ユーザー名 | _アカウント名_ |
| 接続の保護 | SSL/TLS |
| 認証方式 | 通常のパスワード認証 |

## Microsoft Live Hotmail

| Microsoft Live Hotmail | http://www.live.com/ |
|-----------|-----|
| プロトコル | POP3 |
| サーバー名 | pop3.live.com:995 |
| ユーザー名 | _アカウント名(Windows Live ID)_ |
| 接続の保護 | SSL/TLS |
| 認証方式 | 通常のパスワード認証 |

| Microsoft Live Hotmail | http://www.live.com/ |
|-----------|-----|
| プロトコル | SMTP |
| サーバー名 | smtp.live.com:587 |
| ユーザー名 | _アカウント名(Windows Live ID)_ |
| 接続の保護 | STARTTLS |
| 認証方式 | 通常のパスワード認証 |

## GMail

| Microsoft Live Hotmail | https://mail.google.com/ |
|-----------|-----|
| プロトコル | IMAP |
| サーバー名 | imap.gmail.com:993 |
| ユーザー名 | _アカウント名_ |
| 接続の保護 | SSL/TLS |
| 認証方式 | 通常のパスワード認証 |

| Microsoft Live Hotmail | https://mail.google.com/ |
|-----------|-----|
| プロトコル | SMTP |
| サーバー名 | smtp.gmail.com:465 |
| ユーザー名 | _アカウント名_ |
| 接続の保護 | SSL/TLS |
| 認証方式 | 通常のパスワード認証 |

## まとめ

こんな感じで、合計7アカウントを取り敢えず登録してあります。

GMail や Yahoo や Hotmail はメールアドレスなどを入力すると自動でサーバーを探してくれました。
