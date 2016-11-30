---
title: "macOS と Wine 作る HSP 3 の開発環境"
date: 2016-12-01 01:00:00
tags: [Advent Calendar, HSP, OS X, macOS, Wine]
categories: [ブログ]

---

こんにちは、こんばんは。

[Hot Soup Processor Advent Calendar 2016](http://qiita.com/advent-calendar/2016/hsp) の 初日を担当する [@sharkpp](https://twitter.com/sharkpp) です。

この記事は、macOS 上で、どうしても HSP 3 のアプリを開発したい、iOS アプリのデプロイ時だけではなく HSPDish での開発時も macOS で行いたい、そういった人が、HSP 3 の開発環境を手に入れるまでの手順です。

題して「macOS と Wine 作る HSP 3 の開発環境」です。

## できるようになること

この記事に書かれていることを一通り行うと

* macOS で HSPDish 用のソースがコンパイルができる
* hgimg3 が動作する

が、できるようになります。

今回は諦めること。

* hgimg4 が動作する
  Wine にパッチを当てないとダメっぽいので、どうしてもやりたい場合は [Wine を使って Mac OS X で HSP と hgimg4 を動かしてみた](/blog/2016/03/26/running-hsp-and-hgimg4-on-mac-osx-using-wine.html) を見ながら試してみてください。
* オフラインでの HSP Document Library の動作
  IE コンポーネントがうまく動作しない模様なので

この記事を読みにあたっては、最低限 macOS のシェルが触れることが必要とされています。

## はじめに

まずはじめに、必要なソフトウェアの一覧です。

* [HSP 3](http://hsp.tv/) -- これがないと始まりませんよね？
* [Wine](https://www.winehq.org/) -- macOSでWindowsの実行ファイルを起動させるために必要です

## Wine

今回は、安定版ではなく開発版の Wine を利用します。

基本的には、安定版も手順は変わらないと思います。

macOS 用の Wine は [https://dl.winehq.org/wine-builds/macosx/download.html](https://dl.winehq.org/wine-builds/macosx/download.html) からダウンロードして、と行きたいのですが、どうやら現時点での最新の 1.9.23 から遡ること 1.9.9 まで、HSP が利用している API がうまく動いてくれないようなのです。

上記バージョンで動作させると

[<img src="{{ thumbnail('/images/2016_1201_hsp3_throw_error_with_lastest_wine.png', 384, 384) }}" alt="最新のWineでHSPを実行するとエラーが出る">](/images/2016_1201_hsp3_throw_error_with_lastest_wine.png) 

のような感じで画像読み込み時にエラーが出ます。

なので、

[<img src="{{ thumbnail('/images/2016_1201_wine_mac_archive_link.png', 384, 384) }}" alt="Wine の過去にリリースされたファイルの一覧ページへ">](/images/2016_1201_wine_mac_archive_link.png) 
[<img src="{{ thumbnail('/images/2016_1201_wine_mac_find_package.png', 384, 384) }}" alt="Wine 1.9.8 のパッケージを探す">](/images/2016_1201_wine_mac_find_package.png) 

このように辿り、[Index of /wine-builds/macosx/i686](https://dl.winehq.org/wine-builds/macosx/i686/) から `winehq-staging-1.9.8.pkg` をダウンロードしインストールしていきます。

### Wine のインストール


[<img src="{{ thumbnail('/images/2016_1201_wine_install_wizard_page_1.png', 128, 128) }}" alt="Wine 1.9.8 インストールウィザード ページ 01">](/images/2016_1201_wine_install_wizard_page_1.png) 
[<img src="{{ thumbnail('/images/2016_1201_wine_install_wizard_page_2.png', 128, 128) }}" alt="Wine 1.9.8 インストールウィザード ページ 02">](/images/2016_1201_wine_install_wizard_page_2.png) 
[<img src="{{ thumbnail('/images/2016_1201_wine_install_wizard_page_3.png', 128, 128) }}" alt="Wine 1.9.8 インストールウィザード ページ 03">](/images/2016_1201_wine_install_wizard_page_3.png) 
[<img src="{{ thumbnail('/images/2016_1201_wine_install_wizard_page_4.png', 128, 128) }}" alt="Wine 1.9.8 インストールウィザード ページ 04">](/images/2016_1201_wine_install_wizard_page_4.png) 
[<img src="{{ thumbnail('/images/2016_1201_wine_install_wizard_page_5.png', 128, 128) }}" alt="Wine 1.9.8 インストールウィザード ページ 05">](/images/2016_1201_wine_install_wizard_page_5.png) 
[<img src="{{ thumbnail('/images/2016_1201_wine_install_wizard_page_6.png', 128, 128) }}" alt="Wine 1.9.8 インストールウィザード ページ 06">](/images/2016_1201_wine_install_wizard_page_6.png) 
[<img src="{{ thumbnail('/images/2016_1201_wine_install_wizard_page_7.png', 128, 128) }}" alt="Wine 1.9.8 インストールウィザード ページ 07">](/images/2016_1201_wine_install_wizard_page_7.png)

インストールウィザードでは特に選択を変更する部分はありません。

[<img src="{{ thumbnail('/images/2016_1201_wine_in_applications.png', 384, 384) }}" alt="アプリケーションにインストールされたWine">](/images/2016_1201_wine_in_applications.png) 

インストールが完了すると、アプリケーションに追加されます。

[<img src="{{ thumbnail('/images/2016_1201_wine_console.png', 384, 384) }}" alt="Wineコンソール">](/images/2016_1201_wine_console.png) 

アプリケーションから `Wine Staging` を選び、ターミナルを起動します。
ターミナルから

```
$ winecfg
```

と入力し実行すると、 `winecfg` が起動する前に、Wine の動作環境の作成が行われます。

[<img src="{{ thumbnail('/images/2016_1201_wine_mono_install_select.png', 384, 384) }}" alt="Wine環境構築中のWine-Monoインストール確認">](/images/2016_1201_wine_mono_install_select.png) 

途中、 Wine-Mono をインストールするかどうか聞かれますが、これはどちらを選んでも問題ないです。

`winecfg` が起動したら、特に設定を変更することがない場合はそっと閉じます。

次は、日本語の表示ができるように設定を変更します。

設定しないと

[<img src="{{ thumbnail('/images/2016_0326_hsp_install_wizard_tofu.png', 256, 256) }}" alt="HSP インストールウィザード 豆腐">](/images/2016_0326_hsp_install_wizard_tofu.png)

こんな感じになります。

所謂、豆腐ですね。

### Wine に日本語の表示のための設定などを行う

[IPAモナーフォント](http://www.geocities.jp/ipa_mona/) のページから [opfc-ModuleHP-1.1.1_withIPAMonaFonts-1.0.8.tar.gz](http://www.geocities.jp/ipa_mona/opfc-ModuleHP-1.1.1_withIPAMonaFonts-1.0.8.tar.gz) をダウンロードし `~/.wine/drive_c/windows/Fonts/` へ放り込みます。

コマンドラインだけでやるなら

```bash
$ wget http://www.geocities.jp/ipa_mona/opfc-ModuleHP-1.1.1_withIPAMonaFonts-1.0.8.tar.gz
$ tar xzf opfc-ModuleHP-1.1.1_withIPAMonaFonts-1.0.8.tar.gz
$ mv opfc-ModuleHP-1.1.1_withIPAMonaFonts-1.0.8/fonts/ipa*.ttf ~/.wine/drive_c/windows/Fonts/
$ rm -rf opfc-ModuleHP-1.1.1_withIPAMonaFonts-1.0.8
```

こんな感じです。

次に、`MS Gothic` などのフォントを別のフォント(ここでは IPA モナー フォント)のエリアスとする設定をします。

```ini
REGEDIT4

[HKEY_CURRENT_USER¥Software¥Wine¥Fonts¥Replacements]
"MS Gothic"="IPA モナー ゴシック"
"MS Mincho"="IPA モナー 明朝"
"MS PGothic"="IPA モナー Pゴシック"
"MS PMincho"="IPA モナー P明朝"
"MS UI Gothic"="IPA モナー UIゴシック"
"ＭＳ ゴシック"="IPA モナー ゴシック"
"ＭＳ 明朝"="IPA モナー 明朝"
"ＭＳ Ｐゴシック"="IPA モナー Pゴシック"
"ＭＳ Ｐ明朝"="IPA モナー P明朝"
```

を **Shift_JIS** で！ `wine-font-replace-mona.reg` として保存しレジストリを更新します。

コピペも面倒な場合は、 [wine-font-replace-mona.reg](/files/2016_0326_wine-font-replace-mona.reg) をダウンロードしてください。

```bash
$ wine regedit wine-font-replace-mona.reg
```

[Google Noto Fonts](https://www.google.com/get/noto/) でも問題ないですが、このフォントには明朝がないので注意です。

Google Noto Fonts を利用する場合は、こんな感じです。

[Google Noto Fonts](https://www.google.com/get/noto/) から `Noto Sans CJK JP` をダウンロードし利用します。

```bash
$ wget https://noto-website-2.storage.googleapis.com/pkgs/NotoSansCJKjp-hinted.zip
$ unzip NotoSansCJKjp-hinted.zip
$ mv *.otf ~/.wine/drive_c/windows/Fonts/
$ rm -f NotoSansCJKjp-hinted.zip LICENSE_OFL.txt
```

レジストリに設定する内容は、例えば

```ini
REGEDIT4

[HKEY_CURRENT_USER¥Software¥Wine¥Fonts¥Replacements]
"MS Gothic"="Noto Sans Mono CJK JP Regular"
"MS Mincho"="Noto Sans Mono CJK JP Regular"
"MS PGothic"="Noto Sans CJK JP Medium"
"MS PMincho"="Noto Sans CJK JP Medium"
"MS UI Gothic"="Noto Sans CJK JP Medium"
"ＭＳ ゴシック"="Noto Sans Mono CJK JP Regular"
"ＭＳ 明朝"="Noto Sans Mono CJK JP Regular"
"ＭＳ Ｐゴシック"="Noto Sans CJK JP Medium"
"ＭＳ Ｐ明朝"="Noto Sans CJK JP Medium"
```

こんな感じです。

最後に、フォントのスムース処理の設定を行います。

```registory
REGEDIT4

[HKEY_CURRENT_USER\Control Panel\Desktop]
"FontSmoothing"="1"
"FontSmoothingGamma"=dword:00000578
"FontSmoothingOrientation"=dword:00000001
"FontSmoothingType"=dword:00000002
```

を同じく **Shift_JIS** で！ `wine-font-smoothing-rgb.reg` として保存しレジストリを更新します。

コピペがやっぱり面倒な場合は、 [wine-font-smoothing-rgb.reg](/files/2016_0326_wine-font-smoothing-rgb.reg) をダウンロードしてください。

```
$ wine regedit wine-font-smoothing-rgb.reg
```

## HSP

ここでは、現時点での最新の安定版 HSP 3.4 を利用します。

なぜ Wine は開発版を使うんだというツッコミはなしです。

[http://hsp.tv/make/downlist.html](http://hsp.tv/make/downlist.html) から HSP 3.4 をダウンロードしてください。

[<img src="{{ thumbnail('/images/2016_1201_hsp3_download.png', 384, 384) }}" alt="hsp.tv">](/images/2016_1201_hsp3_download.png) 
[<img src="{{ thumbnail('/images/2016_1201_hsp3_download_list_page.png', 384, 384) }}" alt="hsp.tv HSPダウンロードページ">](/images/2016_1201_hsp3_download_list_page.png) 

### HSP のインストール

ダウンロードした `hsp34.exe` をダブルクリックし、インストーラを起動します。

途中の「デスクトップ上にアイコンを作成する」や「拡張子の関連付けを行う」はチェックを外しておきましょう。

それ以外のインストール先などは、お好みで。

[<img src="{{ thumbnail('/images/2016_1201_hsp_install_wizard_page_1.png', 128, 128) }}" alt="HSP 3.4 インストールウィザード ページ 01">](/images/2016_1201_hsp_install_wizard_page_1.png) 
[<img src="{{ thumbnail('/images/2016_1201_hsp_install_wizard_page_2.png', 128, 128) }}" alt="HSP 3.4 インストールウィザード ページ 02">](/images/2016_1201_hsp_install_wizard_page_2.png) 
[<img src="{{ thumbnail('/images/2016_1201_hsp_install_wizard_page_3.png', 128, 128) }}" alt="HSP 3.4 インストールウィザード ページ 03">](/images/2016_1201_hsp_install_wizard_page_3.png) 
[<img src="{{ thumbnail('/images/2016_1201_hsp_install_wizard_page_4.png', 128, 128) }}" alt="HSP 3.4 インストールウィザード ページ 04">](/images/2016_1201_hsp_install_wizard_page_4.png) 
[<img src="{{ thumbnail('/images/2016_1201_hsp_install_wizard_page_5.png', 128, 128) }}" alt="HSP 3.4 インストールウィザード ページ 05">](/images/2016_1201_hsp_install_wizard_page_5.png) 
[<img src="{{ thumbnail('/images/2016_1201_hsp_install_wizard_page_6.png', 128, 128) }}" alt="HSP 3.4 インストールウィザード ページ 06">](/images/2016_1201_hsp_install_wizard_page_6.png) 
[<img src="{{ thumbnail('/images/2016_1201_hsp_install_wizard_page_7.png', 128, 128) }}" alt="HSP 3.4 インストールウィザード ページ 07">](/images/2016_1201_hsp_install_wizard_page_7.png)

インストールが完了したら、デモアプリが起動します。

[<img src="{{ thumbnail('/images/2016_1201_hsp_demo.png', 384, 384) }}" alt="HSPのデモアプリ">](/images/2016_1201_hsp_demo.png) 

エラーもなく起動していれば OK です。

Wine で `WINEPREFIX` を利用し環境を切り替えていなければ、 `~/.wine/drive_c/hsp34` にインストールされていると思います。

```bash
$ wine c:\\hsp34\\hsed3.exe
```

スクリプトエディタの実行ファイルを起動すると、Windwos と同じようにエディタが起動すると思います。

[<img src="{{ thumbnail('/images/2016_1201_hsp_script_edtor.png', 384, 384) }}" alt="HSPの標準エディタ">](/images/2016_1201_hsp_script_edtor.png) 

ついでにアシスタントも起動しているので、必要なければ設定から起動しないようにしておきましょう。

[<img src="{{ thumbnail('/images/2016_1201_hsp_script_edtor_disable_auto_run_assistant.png', 384, 384) }}" alt="HSPの標準エディタの設定を変更">](/images/2016_1201_hsp_script_edtor_disable_auto_run_assistant.png) 

この時点で、HSPDishのプログラムもコンパイルできるようになっていると思います。

[<img src="{{ thumbnail('/images/2016_1201_hspdish_sample.png', 384, 384) }}" alt="HSPDishのサンプル">](/images/2016_1201_hspdish_sample.png) 

hgimg4 を利用する場合は、もう少し手間がかかります。

ということで、時間切れ。

ここまで読んでいただきありがとうございます。

## やり残したこと

残念ながら、今回は諸事情でできなかったことがあります。

* Wine 最新版で動作しない
  * これは、Wine側の問題ではないかと思うので、少し調べてみたいと思います。
* HSP Help Library が動作しない
  * Wine に IE をインストールするのは難しいようなので諦めたほうがいいかも。
  * 公式で動作していたものはいつの間にかサーバーエラーとなるようなので [@mjhd_devlion](https://twitter.com/mjhd_devlion) さんの [ohdl.hsproom.me](http://ohdl.hsproom.me/) で確認するのがいいと思います。
  * Wine-Gecko なる IE 互換のアプリがあるようなのですが、はたして。
* hgimg4 が動作しない。
  * [Wine を使って Mac OS X で HSP と hgimg4 を動かしてみた](/blog/2016/03/26/running-hsp-and-hgimg4-on-mac-osx-using-wine.html) を見ながら頑張りましょう。
* iOS のアプリを実際に作れるまでの流れ
  * これも、いろいろ調べながら試してみたいです。

## 参考

* [Wine を使って Mac OS X で HSP と hgimg4 を動かしてみた](/blog/2016/03/26/running-hsp-and-hgimg4-on-mac-osx-using-wine.html)
* [MacOSX - WineHQ Wiki](https://wiki.winehq.org/MacOSX)
* [Google Fontsの日本語フォント「Noto Fonts」の使い方 | OXY NOTES](http://oxynotes.com/?p=10293)
* [IPAモナーフォント](http://www.geocities.jp/ipa_mona/)
* [FontSmoothing](https://technet.microsoft.com/en-us/library/cc978612.aspx)
* [Wine 1.1.12におけるフォントのサブピクセルレンダリングについて - 試験運用中なLinux備忘録](http://d.hatena.ne.jp/kakurasan/20090107/p1)

<hr />

この投稿は **[Hot Soup Processor Advent Calendar 2016](http://qiita.com/advent-calendar/2016/hsp)** の **1日目**の記事です。

* 2日目の記事: Coming Soon!

<hr />
