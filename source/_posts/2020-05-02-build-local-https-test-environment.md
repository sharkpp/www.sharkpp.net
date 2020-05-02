---
layout: post
title: "ローカルのhttpsテスト環境の構築"
date: 2020-05-02 16:15
tags: [macOS, https, ssl, brew, nodejs, mkcert]
categories: [ブログ]

---

ローカルでのウェブアプリの開発では、もはや https が必須ということで動作確認に難儀していましたが、
しばらく前にローカルで認証局を簡単に設置できる [mkcert](https://github.com/FiloSottile/mkcert) なるツールがあると知ったので、使い方を調べてみました。

PC上での使い方は結構サクッと出てきたので、実際のユースケースも念頭に Android でもオレオレ証明書が正規の証明書として利用できるような設定方法も調べてみました。

[<img src="{{ thumbnail('/images/20200501_local_https_secure3.png', 640, 640) }}" alt="20200501_local_https_secure3">](/images/20200501_local_https_secure3.png)

## mkcert の Windows へのインストール

mkcert の [Windows](https://github.com/FiloSottile/mkcert#windows) セクションを参考にしてください。

## mkcert の macOS へのインストール

homebrew を使ったインストールが簡単です。

`brew install mkcert` とターミナルで入力し実行するだけ。

```console
$ brew install mkcert
Updating Homebrew...
==> Auto-updated Homebrew!
           :
==> Downloading https://homebrew.bintray.com/bottles/mkcert-1.4.1.mojave.bottle.tar.gz
==> Downloading from https://akamai.bintray.com/91/9100c7f044d91e6ca0c483ed572217de28daa34c04fa6e2a130116175ba162e9?__gda__=exp=1588341913~hmac=516f50b8cbb6930276b
######################################################################## 100.0%
==> Pouring mkcert-1.4.1.mojave.bottle.tar.gz
  /usr/local/Cellar/mkcert/1.4.1: 6 files, 5.3MB
```

Firefox で利用する場合は

```console
$ brew install nss
```

も必要なようです。

システムへのローカルの認証局のインストールは `mkcert -install` を実行するようです。

```console
$ mkcert -install
Created a new local CA at "/Users/****/Library/Application Support/mkcert" 
Sudo password: ******
The local CA is now installed in the system trust store! ⚡️
The local CA is now installed in the Firefox trust store (requires browser restart)! 
```

## 証明書の作成

証明書の作成は `mkcert {hostname_or_ip} ...` のような感じで、コマンドの後に証明書に含めたいホスト名もしくはIPを指定します。

```console
$ mkcert 0.0.0.0 localhost 127.0.0.1 ::1
Using the local CA at "/Users/****/Library/Application Support/mkcert" 

Created a new certificate valid for the following names 
 - "0.0.0.0"
 - "localhost"
 - "127.0.0.1"
 - "::1"

The certificate is at "./0.0.0.0+3.pem" and the key at "./0.0.0.0+3-key.pem" 
```

実行時のカレントディレクトリに `*.pem` = 公開鍵、と `*-key.pem ` = 秘密鍵、が作成されるので、https として動作させる場合の公開鍵と秘密鍵として指定します。

## macOS で利用する場合の設定

mkcert をインストールしたPCでは、すでに、システムにローカル認証局の証明書がインストールされているので特に何かする必要はないです。

もし、他のPCで利用する場合は、下記に記載の方法で証明書のエクスポートをし、それをシステムにインストールしてください。

## Android で利用する場合の設定

### 証明証のエクスポート

macOS の場合

[<img src="{{ thumbnail('/images/20200501_ser_export_from_macos_key_chain.png', 320, 320) }}" alt="20200501_ser_export_from_macos_key_chain">](/images/20200501_ser_export_from_macos_key_chain.png)

1. 「キーチェーン」を開く
2. 左部「ログイン」を選択し `mkcert ************` を探す、
3. 右クリックメニューから「"mkcert ************"を書き出す」を選んでファイルに保存

保存したファイルをなんとかして Android にコピーします。

### 証明書のインストール

1. 「設定」アプリを開く
2. 「セキュリティ」→「詳細設定」→「暗号化と認証情報」「ストレージからのインストール」 
   [<img src="{{ thumbnail('/images/20200501_android_ser_install1.png', 320, 320) }}" alt="20200501_android_ser_install1">](/images/20200501_android_ser_install1.png) 
   [<img src="{{ thumbnail('/images/20200501_android_ser_install2.png', 320, 320) }}" alt="20200501_android_ser_install2">](/images/20200501_android_ser_install2.png) 
   [<img src="{{ thumbnail('/images/20200501_android_ser_install3.png', 320, 320) }}" alt="20200501_android_ser_install3">](/images/20200501_android_ser_install3.png) 
3. エクスポートした証明書を選択
   [<img src="{{ thumbnail('/images/20200501_android_ser_install4.png', 320, 320) }}" alt="20200501_android_ser_install4">](/images/20200501_android_ser_install4.png) 
4. 「証明書の名前を指定する」欄は、適用に、「認証情報の使用」欄は「VPNとアプリ」を選択 
   [<img src="{{ thumbnail('/images/20200501_android_ser_install5.png', 320, 320) }}" alt="20200501_android_ser_install5">](/images/20200501_android_ser_install5.png)
5. 「信頼できる認証局」→「ユーザー」タブを選択し、インストールした証明書が含まれていたらOK 
   [<img src="{{ thumbnail('/images/20200501_android_ser_install6.png', 320, 320) }}" alt="20200501_android_ser_install6">](/images/20200501_android_ser_install6.png) 
   [<img src="{{ thumbnail('/images/20200501_android_ser_install7.png', 320, 320) }}" alt="20200501_android_ser_install7">](/images/20200501_android_ser_install7.png)

## 証明書の利用

適当なウェブサーバーを使って確認します。

Node.js がインストール済みの場合は [http-server - npm](https://www.npmjs.com/package/http-server) が簡単そうなので、

```console
$ npm install -g http-server
```

としてインストールして試してみます。

HTML は適当に

```html
<html>
  <head>
  </head>
  <body>
    Is this page visible on https?
  </body>
</html>
```

みたいな感じに作ります。

カレントディレクトリに、前述の `0.0.0.0+3.pem` と `0.0.0.0+3-key.pem` を保存し

```console
$ http-server . -S -C 0.0.0.0+3.pem -K .0.0.0.0+3-key.pem
```

とするとローカル認証局の証明書がインストールされていれば、有効な証明書として利用されます。

Chrome for Android で確認するとこんな感じ

[<img src="{{ thumbnail('/images/20200501_local_https_secure1.png', 320, 320) }}" alt="20200501_local_https_secure1">](/images/20200501_local_https_secure1.png)

[<img src="{{ thumbnail('/images/20200501_local_https_secure2.png', 320, 320) }}" alt="20200501_local_https_secure2">](/images/20200501_local_https_secure2.png)

Chrome for macOS で確認するとこんな感じ

[<img src="{{ thumbnail('/images/20200501_local_https_secure4.png', 320, 320) }}" alt="20200501_local_https_secure4">](/images/20200501_local_https_secure4.png)


## 参考

* [ローカル環境でSSLをオレオレ証明書で行っていて警告が出てる人に朗報 - Qiita](https://qiita.com/walkers/items/b90a97a99bbb27f6550f)
* [AndroidのCA証明書のインストールについて — Information Media Center](https://www.media.hiroshima-u.ac.jp/services/hinet/android-ca2)
* [証明書を追加、削除する - Pixel Phone ヘルプ](https://support.google.com/pixelphone/answer/2844832?hl=ja&visit_id=637239419312335821-3938346748&rd=1)
