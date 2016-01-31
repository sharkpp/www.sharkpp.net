---
title: "Mac OS X での Wine のビルドの仕方"
date: 2016-01-31 12:30
tags: [Mac,Wine,How to,メモ,環境構築]
categories: [ブログ]

---

Mac で Wine を使うには、まあ普通に公式の [MacOSX](https://wiki.winehq.org/MacOSX) からビルド済みバイナリをインストールしたほうが早いのだけれど、どうしてもソースからビルドしないといけない場合のビルドの仕方をメモ。

環境は

* Mac OS X 10.10.5
* Xcode 7.2 Build version 7C68
* Homebrew 0.9.5 (git revision 4b1da8; last commit 2016-01-30)
* Wine 1.9.2

まずは結論から、[MacOSX](https://wiki.winehq.org/MacOSX) のページに書かれていることをそのままやれば、問題なくビルドが通りました。

最初、途中の手順を抜かしてしまいうまくいかなくて、[Build Wine the Scripted Way](https://wiki.winehq.org/MacOSX/Building#Build_Wine_the_Scripted_Way) に書かれているスクリプトを試してみたけど、結果から言うと、そのスクリプトは埋め込まれている内容が古いのと途中で失敗したので使わないほうが吉、のようです。
あと、Google code にホスティングされているのでもはや更新されない、ってのもある。

## ビルド方法

Xcode と XQuartz がインストール済みの場合は

```bash
$ brew install --only-dependencies --devel wine
$ wget http://dl.winehq.org/wine/source/1.9/wine-1.9.2.tar.bz2
$ tar xf wine-1.9.2.tar.bz2
$ cd wine-1.9.2
$ ./configure CC="clang" CXX="clang++" CFLAGS="-std=gnu89 -g"
$ make
```

と、こんな感じで、30分から40分ぐらいでビルドができます。

では、順番に

### 1. Xcode をインストール

まずはこれがないと始まらない

### 2. Homebrew をインストール＆アップデート

Homebrew をインストールします。

すでにインストール済みの場合、`brew update` で更新しておいたほうがいいと思います。

そうしないと

```bash
$ brew install --only-dependencies --devel wine
                  :
==> Installing wine dependency: libpng
==> Downloading https://downloads.sf.net/project/libpng/libpng16/1.6.16/libpng-1.6.16.tar.xz

curl: (22) The requested URL returned error: 404 Not Found
Error: Failed to download resource "libpng"
Download failed: https://downloads.sf.net/project/libpng/libpng16/1.6.16/libpng-1.6.16.tar.xz
```

みたいな感じになることがあります。

### 3. XQuartz をインストール

[XQuartz](http://www.xquartz.org/) からパッケージをダウンロードしてインストールすればいいと思う。

Homebrew の場合は

```bash
$ brew install caskroom/cask/xquartz
```

でインストールできる。

なんかおかしかったら再インストールをすれば直る、って書いてある。

### 4. 依存関係をインストール

[Dependencies](https://wiki.winehq.org/MacOSX/Building#Dependencies) に書かれている通りにやればOK。

例によって Homebrew の場合は `brew install --only-dependencies --devel wine` でOK。

```bash
$ brew install --only-dependencies --devel wine
==> Installing dependencies for wine: libtasn1, gmp, nettle, gnutls, libpng, freetype, jpeg, libtool, libusb, libusb-compat, font
==> Installing wine dependency: libtasn1
           :
```

### 5. Wine のソースのダウンロードと展開

[Wine Announcement](https://www.winehq.org/announce/1.9.2) のリンクから tar ball の URL をコピーしてソースをダウンロード。

(なんか、ゲートウエイの調子が悪い時があるようなので、リトライするかミラーからダウンロードしたほうがいいかもしれない)

そして、ダウンロードしたファイルを

```bash
$ wget http://dl.winehq.org/wine/source/1.9/wine-1.9.2.tar.bz2
$ tar xf wine-1.9.2.tar.bz2
$ cd wine-1.9.2
```

このように展開する。

### 6. コンフィグ＆ビルド

やり方は [Building from Source](https://wiki.winehq.org/MacOSX/Building#Building_from_Source) の通りに `./configure CC="clang" CXX="clang++" CFLAGS="-std=gnu89 -g" ; make` するだけ。

```bash
$ ./configure CC="clang" CXX="clang++" CFLAGS="-std=gnu89 -g"
checking build system type... x86_64-apple-darwin14.5.0
checking host system type... x86_64-apple-darwin14.5.0
                   :

configure: Finished.  Do 'make' to compile Wine.

$ make
clang -m32 -c -o ffs.o ffs.c -I. -I../../include ...
                   :
Wine build complete.
```

### 7. ビルドした Wine の実行

ドキュメントにも書いてありますが `make install` は**せず**に、ビルドした場所で実行します。

`$ ./wine explorer.exe`

のような感じ。

すでにパッケージなどで Wine をインストールしている場合は、

```bash
$ WINEPREFIX=`pwd`/wine-env ./wine explorer.exe
wine: created the configuration directory '~/wine-1.9.2/wine-env'
                   :
wine: configuration in '~/wine-1.9.2/wine-env' has been updated
```

のような感じで独自の環境を作ったほうがいいかもしれない。

なお、 X11/XQuartz 関連でエラーが出た場合は `DYLD_FALLBACK_LIBRARY_PATH="${DYLD_FALLBACK_LIBRARY_PATH}:/usr/X11/lib" wine program_name.exe` のような感じで回避できるようです。

## おまけ：ソースファイルの検証

きっと、ほとんどの場合は、tar ball をダウンロードしてそのまま使うと思うけど、シグネチャも公開されているので、せっかくだからダウンロードしたファイルの検証をしてみる。

検証には GnuPG を使います。

```bash
$ gpg
-bash: gpg: command not found
$ brew install gpg
==> Downloading https://homebrew.bintray.com/bottles/gnupg-1.4.20.yosemite.bottle.tar.gz
######################################################################## 100.0%
==> Pouring gnupg-1.4.20.yosemite.bottle.tar.gz
*  /usr/local/Cellar/gnupg/1.4.20: 53 files, 5.4M
```

が、インストールされていなかったので Homebrew でサクッとインストール。

```bash
$ wget http://dl.winehq.org/wine/source/1.9/wine-1.9.2.tar.bz2.sign
```

シグネチャを [Index of /wine/source/1.9](http://dl.winehq.org/wine/source/1.9/) から探し、ダウンロードして検証。

```bash
$ gpg --verify wine-1.9.2.tar.bz2.sign
gpg: assuming signed data in `wine-1.9.2.tar.bz2'
gpg: Signature made Fri Jan 22 23:29:08 2016 JST using RSA key ID AF17519D
gpg: Can't check signature: public key not found
```

公開鍵がない！って怒られる。

Wine のメーリングリストの [[Wine] Using .sign PGP/GnuPGP/gpg](https://www.winehq.org/pipermail/wine-users/2007-July/027429.html) のポストによると、どうやら `"Alexandre Julliard <julliard at winehq.org>"` さんの鍵で署名してあるらしいので探してインポートする。

`using RSA key ID AF17519D` って書かれているのでそれを探せばいいか、と思ったけどファイルの検証をするのにシグネチャの情報を信じてはダメですよね。

公式ページのどこかに、署名はどのキーでしてあるとか書いていないのだろうか？

```bash
$ gpg --search-keys "julliard@winehq.org"
gpg: searching for "julliard@winehq.org" from hkp server keys.gnupg.net
(1)	Alexandre Julliard <julliard@winehq.org>
	  4096 bit RSA key AF17519D, created: 2015-11-03
(2)	Alexandre Julliard <julliard@winehq.org>
	  1024 bit DSA key B9461DD7, created: 2004-10-07
Keys 1-2 of 2 for "julliard@winehq.org".  Enter number(s), N)ext, or Q)uit > q
$ gpg --recv-keys AF17519D
gpg: requesting key AF17519D from hkp server keys.gnupg.net
gpg: key AF17519D: public key "Alexandre Julliard <julliard@winehq.org>" imported
gpg: no ultimately trusted keys found
gpg: Total number processed: 1
gpg:               imported: 1  (RSA: 1)
```

鍵の種類が２種類あるらしいので新しいほうの `4096 bit RSA key` の `AF17519D` を選択してインポートする。

そして検証。

```bash
$ gpg --verify wine-1.9.2.tar.bz2.sign
gpg: assuming signed data in `wine-1.9.2.tar.bz2'
gpg: Signature made Fri Jan 22 23:29:08 2016 JST using RSA key ID AF17519D
gpg: Good signature from "Alexandre Julliard <julliard@winehq.org>"
gpg: WARNING: This key is not certified with a trusted signature!
gpg:          There is no indication that the signature belongs to the owner.
Primary key fingerprint: DA23 579A 74D4 AD9A F9D3  F945 CEFA C8EA AF17 519D
```

`Good signature` と表示されればOKです。
何かおかしければ、`BAD signature` と表示されます。


ということで、まとめると

```bash
$ gpg --recv-keys AF17519D
$ wget http://dl.winehq.org/wine/source/1.9/wine-1.9.2.tar.bz2
$ wget http://dl.winehq.org/wine/source/1.9/wine-1.9.2.tar.bz2.sign
$ gpg --verify wine-1.9.2.tar.bz2.sign 2>&1 | grep "Good signature"
gpg: Good signature from "Alexandre Julliard <julliard@winehq.org>"
```

こんな感じです。

## 参考

* [MacOSX/Building - WineHQ Wiki](https://wiki.winehq.org/MacOSX/Building)
* [Xcodeのコマンドラインツールのバージョン確認 - Qiita](http://qiita.com/tyfkda/items/565cd067a11419650323)
* [Wine環境(WINEPREFIX)を分けてWindowsアプリを上手に管理する - kakurasan](http://kakurasan.blogspot.jp/2015/06/manage-winapps-using-wineprefixes.html)
* [Index of /wine/source/1.9](http://dl.winehq.org/wine/source/1.9/)
* [[Wine] Using .sign PGP/GnuPGP/gpg](https://www.winehq.org/pipermail/wine-users/2007-July/027429.html)
* [GPGで署名確認 | POOH.GR.JP](http://pooh.gr.jp/?p=301)
* [VerifyIsoHowto - Community Help Wiki](https://help.ubuntu.com/community/VerifyIsoHowto)
* [Search results for 'winehq org julliard'](http://keyserver.ubuntu.com/pks/lookup?op=vindex&search=julliard%40winehq.org&fingerprint=on)
