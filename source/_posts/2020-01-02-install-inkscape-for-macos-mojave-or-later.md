---
title: "macOS 上に Inkscape をインストールする"
date: 2020-01-02 11:48
tags: [Inkscape, macOS, Mac]
categories: [ブログ]

---

macOS を Mojave 10.14 にしてから Inkscape が起動しなくなっていた。
が、まぁ、とりあえず使わないからいいか... と、そのままにしていたところ... 年末に急に使う事態が発生して大慌てで色々調べ入れ直したときの記録。

[以前試した方法](/blog/2017/04/30/Install-inkscape-using-homebrew-on-macos.html)ではうまくいかなかったので調べました。

<img src="{{ thumbnail('/images/20200102_inkscape_on_macos_mojave.png', 384, 384) }}" alt="Inkscape 1.0beta2 version">

## 結論

結論から書くと、公式に 0.92.2 もしくは 1.0 beta 2 があるのでそちらを利用しましょうということになります。

<img src="{{ thumbnail('/images/20200102_inkscape_v1b2_download_page.png', 256, 256) }}" alt="Inkscape 1.0beta2 download page">

色々調べましたが、どうもそういうことらしいです。

[Inkscape 0.92.4 - macOS : dmg | Inkscape](https://inkscape.org/ja/release/inkscape-0.92.4/mac-os-x/dmg/dl/) によると

> Note:
> There is no .dmg file for macOS for the current Inkscape version at this time.
> Please use Inkscape 0.92.2 on macOS <= 10.14. For Catalina (macOS 10.15), there is no stable version available, please use the latest beta version of Inkscape 1.0 or the development version.
> 
> There will be a notarized and signed .dmg file for the upcoming Inkscape 1.0.
>> 注：
>> 現時点では、現在の Inkscape バージョンの macOS 用の .dmg ファイルはありません。
>> macOS <= 10.14 では Inkscape 0.92.2 を利用してください。Catalina（macOS 10.15）の場合、利用可能な安定バージョンはありません。Inkscape 1.0 の最新ベータバージョンまたは開発バージョンを利用してください。
>> 
>> 今後の Inkscape 1.0 には、公証され署名された .dmg ファイルがあります。

と書かれています。

<img src="{{ thumbnail('/images/20200102_inkscape_installed_on_macos_mojave.png', 256, 256) }}" alt="Inkscape 1.0beta2 download page">

Launchpad やファイルとの関連付けもできるようになって快適です。
ただ、高確率で突然強制終了するので自動保存の設定は必須かなと、思います。

<img src="{{ thumbnail('/images/20200102_inkscape_auto_save.png', 256, 256) }}" alt="Inkscape 1.0beta2 download page">

## Homebrew 経由でのインストール

[以前はできた](/blog/2017/04/30/Install-inkscape-using-homebrew-on-macos.html) Homebrew 経由でのインストールは `"cxx11" is not a recognized standard` と怒られて、現時点ではできないようです。

```console
$ brew install caskformula/caskformula/inkscape
==> Tapping caskformula/caskformula
Cloning into '/usr/local/Homebrew/Library/Taps/caskformula/homebrew-caskformula'...
remote: Enumerating objects: 5, done.
remote: Counting objects: 100% (5/5), done.
remote: Compressing objects: 100% (4/4), done.
remote: Total 5 (delta 0), reused 3 (delta 0), pack-reused 0
Unpacking objects: 100% (5/5), done.
Error: Invalid formula: /usr/local/Homebrew/Library/Taps/caskformula/homebrew-caskformula/Formula/inkscape.rb
inkscape: "cxx11" is not a recognized standard
Error: Cannot tap caskformula/caskformula: invalid syntax in tap!
```

こんな感じでエラーとなります。

## まとめ

* 現状、macOS 10.14 Mojave 以降では Homebrew でのインストールが失敗する
* macOS 10.15 Catalina では 1.0 beta 2 以降が唯一の選択
* macOS 10.14 Mojave もしくはそれ以下の macOS 10.x では、 1.0 beta 2 もしくは 0.92.2 が利用できる
* 公式バージョンをインストールすれば Launchpad やファイルの関連付けも設定される
* Inkscape 1.0 beta 2 は高確率で強制終了するので自動保存の設定は必須

## 参考

* [Download Inkscape 1.0beta2 | Inkscape](https://inkscape.org/release/inkscape-1.0/?latest=1)
* [Inkscape 0.92.4 - macOS : dmg | Inkscape](https://inkscape.org/ja/release/inkscape-0.92.4/mac-os-x/dmg/dl/)
* [brew install fails on bad "cxx11" · Issue #89 · caskformula/homebrew-caskformula](https://github.com/caskformula/homebrew-caskformula/issues/89)
* ["cxx11" is not a recognized standard · Issue #90 · caskformula/homebrew-caskformula](https://github.com/caskformula/homebrew-caskformula/issues/90)
* [Many brew commands fail with :cxx is disabled! There is no replacement. · Issue #74 · caskformula/homebrew-caskformula](https://github.com/caskformula/homebrew-caskformula/issues/74)
* [Error: Calling needs :cxx11 is disabled! There is no replacement. というエラーがbrewで出た話 | 水面下のブログ](https://trsasasusu.com/blog/58/)
* [macOS 上に Homebrew を利用して Inkscape をインストールする — さめたすたすのお家](/blog/2017/04/30/Install-inkscape-using-homebrew-on-macos.html)
