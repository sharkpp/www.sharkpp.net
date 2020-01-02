---
title: "macOS 上に Homebrew を利用して Inkscape をインストールする"
date: 2017-04-30 23:30
update: 2020-01-02 11:48
tags: [Inkscape, Homebrew, macOS, Mac]
categories: [ブログ]

---

{% import 'post_alert.html' as m %}
{{ m.alert('2020-01-02 追記', 'Homebrew 経由でのインストールはできなくなっているようです。公式から動作可能なパッケージをインストールできます。詳しくは<a href="/blog/2020/01/02/install-inkscape-for-macos-mojave-or-later.html">macOS 上に Inkscape をインストールする</a>をご覧ください。') }}

開発中のアプリのアイコンを作成するために [Inkscape](https://inkscape.org/ja/) が必要だったのですが、先日に Inkscape と [XQuartz](https://www.xquartz.org/) をアップデートしてから何が悪いのか起動しなくて難儀していたところで、解決方法を見つけたのでその方法の記録です。

<img src="{{ thumbnail('/images/2017_0430_inkscape_version.png', 384, 384) }}" alt="Inkscape 0.92.1 version">

## はじめに

解決方法ですが、実は公式のダウンロードページにしれっと書いてあったんですよね。

> [Mac OS 版 | Inkscape](https://inkscape.org/ja/download/mac-os/)
>
> For users who cannot wait to try out the new features and have some technical experience, alternative installation methods are available.
>
> (意訳：腕に覚えがあるなら新しいバージョンをインストールする別の方法があるけどどうする？)

この記事を書いている時点(2017/04/30)では、どうやら最新バージョンの 0.92 系は .dmg が提供されていないので、ある意味、渡りに船かもと言うところも。

その方法 [alternative installation methods](https://inkscape.org/ja/download/mac-os/#alternative_install_0.92) を確認すると、macOS の２大パッケージマネージャーの [MacPorts](https://www.macports.org/) と [Homebrew](https://brew.sh/) でのインストール方法が書いてあります。

自分の環境は、Homebrew なので、そちらでのビルドとインストールを試してみました。

ビルド時間などは、こんな感じ。

|パッケージ|バージョン|ファイル数|サイズ|ビルド時間|
|-|-|-:|-:|-:|
|openssl|1.0.2k|1696|17.5MB|00:15:56|
|python|2.7.13|6337|86.7MB|00:04:03|
|inkscape|0.92.1|1019|128.3MB|00:27:50|

ちなみに、どうやらこの方法だとネイティブ版がビルドされるらしく日本語入力やシステムにインストールされているフォントが使えたりとか、嬉しい変化があったりもします。

## 準備

インストール前の準備として、Homebrew の環境を整えておきます。

まれに、パッケージのバージョンが上がっていたりするので、アップデートしておきます。

```bash
$ brew update
```

また、以前に Homebrew で Inkscape をインストールしたことがある場合は、どうやらあらかじめアンインストールが必要のようです。

```bash
$ brew uninstall inkscape
$ brew cleanup
```

## ビルド＆インストール

実際のところ、ビルド自体はコマンド一行で終わります。

```bash
$ brew install caskformula/caskformula/inkscape
```

ビルドとインストールが

```
$ brew install caskformula/caskformula/inkscape
==> Tapping caskformula/caskformula
Cloning into '/usr/local/Homebrew/Library/Taps/caskformula/homebrew-caskformula'...
remote: Counting objects: 5, done.
           :
==> make
==> make install
🍺 /usr/local/Cellar/inkscape/0.92.1: 1,019 files, 128.3MB, built in 27 minutes 50 seconds
```

とこのような感じで終了したら、おもむろに

```bash
$ inkscape
```

と入力します。
何もなければ Inkscape を起動できます。

インストール先の `/usr/local/Cellar/inkscape/0.92.1` は後で利用するので覚えておきます。

インストールした Inkscape のバージョンはこんな感じ。

[<img src="{{ thumbnail('/images/2017_0430_inkscape_version.png', 384, 384) }}" alt="Inkscape 0.92.1 version">](/images/2017_0430_inkscape_version.png)

お疲れ様でした、と言いたいところですが、残念ながらこの状態では Launchpad に登録されていないので、もう一手間かける必要があります。

実は、

```bash
$ brew cask install inkscape
```

でインストールすると、 .app がインストールされるようですが、現時点(2017/04/30)ではバージョンが 0.91-1 で、XQuartz 版で、実は裏で公式のパッケージをインストールしているだけなので日本語やフォントなどの制限があります。

## Launchpad への登録

以前は

```bash
$ brew linkapps inkscape
```

みたいにすれば、できていたらしいけど、

> Warning: `brew linkapps` has been deprecated and will eventually be removed!
>
> (訳：`brew linkapps`は廃止され、最終的に削除されます！)

と怒られるので、別の方法をとります。

Inksacpe のインストール先は、先のビルド時のログに出てくる、`/usr/local/Cellar/inkscape/0.92.1` なので、`/bin/inkscape` を追加して、`"/usr/local/Cellar/inkscape/0.92.1/bin/inkscape"` が実態となります。

記録し忘れていたら、

```bash
$ realpath $(which inkscape)
/usr/local/Cellar/inkscape/0.92.1/bin/inkscape
```

で確認できます。

スクリプトエディタで

```AppleScript
tell application "/usr/local/Cellar/inkscape/0.92.1/bin/inkscape"
    activate
end tell
```

と入力して、

1. 「ファイル」メニュー
2. 「書き出す...」
3. 書き出し名＝「Inkscape」
4. ファイルフォーマット＝「アプリケーション」 ※ここが重要
5. 「保存」を押下

<img src="/images/2017_0430_as2app.png" />

で、Inkscapeのランチャーアプリケーションを作成します。

書き出したアプリケーションを「アプリケーション」フォルダに入れれば完了です。

アプリケーションのアイコンはスクリプトファイルのアイコンがそのまま使われています。

「パッケージの内容を表示」で .app の中に潜ると

<img src="/images/2017_0430_app_package_contents.png" />

のような感じになっているので、

るので、気になるようであれば、公式インストーラの .app から `Contents/Resources/inkscape.icns` を取り出し、 `Contents/Resources/applet.icns` を置き換えてあげれば

<img src="/images/2017_0430_launcher_app_in_launchpad.png" />

こんな感じで Launchpad に表示されていると思います。

## まとめ

* 現状は 0.92.x に公式パッケージ(.dmg ファイル)は存在しない
* Macports か Homebrew 経由で Inkscape の 0.92.x のネイティブ版(非XQuartz版)をビルド＆インストール可能
* AppleScript でランチャーアプリを作れば Launchpad にも登録可能

## 参考

* [MacPorts と開発版 Inkscape (0.92pre3) - ながいものには、まかれたくない](http://a244.hateblo.jp/entry/2016/12/10/215848)
* [Mac OS 版 | Inkscape](https://inkscape.org/ja/download/mac-os/#alternative_install_0.92)
* [AppleScriptでアプリケーションの操作 - Qiita](http://qiita.com/nkimra/items/e30b5d120a6cae7ded8d)
* [How do I make an AppleScript file into a Mac App? - Ask Different](https://apple.stackexchange.com/questions/8299/how-do-i-make-an-applescript-file-into-a-mac-app)

