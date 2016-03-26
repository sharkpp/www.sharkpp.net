---
title: "Wine を使って Mac OS X で HSP と hgimg4 を動かしてみた"
date: 2016-03-26 23:43
tags: [ Mac, Wine, How to, メモ, 環境構築, HSP, HSP3, hgimg4 ]
categories: [ブログ]

---

HSP をどうしても Mac OS X で動かしたい！

まあ、とりあえず Wine 使っておけばいいよね！

よしよし動いた、って hgimg4 が動かないじゃないか！むきー

と、言う所から

[<img src="{{ thumbnail('/images/2016_0326_hgimg4_test9.png', 512, 512) }}" alt="hgimg4 サンプル test9">](/images/2016_0326_hgimg4_test9.png)

このように、hgimg4 のサンプルが動くようにするための方法です。

## Wine の日本語環境を設定する

まず Wine で UI などに日本語を表示させる為の設定を行います。

設定をしないと

[<img src="{{ thumbnail('/images/2016_0326_hsp_install_wizard_tofu.png', 256, 256) }}" alt="HSP インストールウィザード 豆腐">](/images/2016_0326_hsp_install_wizard_tofu.png)

こんな感じに、全部が全部では無いですが豆腐になります。

最初に HSP のインストール前にいろいろ設定を行うために Wine の環境を作ります。

標準では `~/.wine` に環境が作られます。

```
$ wine xxx
```

「xxx.exe が見つから無い」と言われても無視してください。ワザとです。


別の場所に専用の環境を作る場合は

```
$ WINEPREFIX=~/wine-hgimg4-test wine xxx
```

と `WINEPREFIX` 環境変数を指定します。


以降では `~/wine-hgimg4-test` を環境として使用します。


日本語のフォントは  [IPAモナーフォント](http://www.geocities.jp/ipa_mona/) をインストールし、利用します。

まずは、フォントをインストールします。

```bash
$ wget http://www.geocities.jp/ipa_mona/opfc-ModuleHP-1.1.1_withIPAMonaFonts-1.0.8.tar.gz
$ tar xzf opfc-ModuleHP-1.1.1_withIPAMonaFonts-1.0.8.tar.gz
$ mv opfc-ModuleHP-1.1.1_withIPAMonaFonts-1.0.8/fonts/ipa*.ttf ~/wine-hgimg4-test/drive_c/windows/Fonts/
$ rm -rf opfc-ModuleHP-1.1.1_withIPAMonaFonts-1.0.8
```

次に、`MS Gothic` などのフォントを別のフォント(ここでは IPA モナー フォント)のエリアスとする設定をします。

```
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
$ WINEPREFIX=~/wine-hgimg4-test wine regedit wine-font-replace-mona.reg
```

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
$ WINEPREFIX=~/wine-hgimg4-test wine regedit wine-font-smoothing-rgb.reg
```

## HSP のインストール

[HSPダウンロード](http://hsp.tv/make/downlist.html) から HSP 3.4 をダウンロードします。

※ [HSP3.5β3を公開しました - おにたま(オニオンソフト)のおぼえがき](http://www.onionsoft.net/wp/archives/1642) から HSP 3.5b3 をダウンロードしてもいいですが、こちらはインストーラ版では無いので注意です。

コマンドでダウンロードする場合はこんな感じです。

```
$ wget http://www.onionsoft.net/hsp/file/hsp34.exe
```

そして、インストールします。

```bash
$ WINEPREFIX=~/wine-hgimg4-test wine hsp34.exe
```

途中の「デスクトップ上にアイコンを作成する」や「拡張子の関連付けを行う」はチェックを外しておきましょう。

[<img src="{{ thumbnail('/images/2016_0326_hsp_install_wizard_page_1.png', 128, 128) }}" alt="HSP インストールウィザード ページ 01">](/images/2016_0326_hsp_install_wizard_page_1.png) 
[<img src="{{ thumbnail('/images/2016_0326_hsp_install_wizard_page_2.png', 128, 128) }}" alt="HSP インストールウィザード ページ 02">](/images/2016_0326_hsp_install_wizard_page_2.png) 
[<img src="{{ thumbnail('/images/2016_0326_hsp_install_wizard_page_3.png', 128, 128) }}" alt="HSP インストールウィザード ページ 03">](/images/2016_0326_hsp_install_wizard_page_3.png) 
[<img src="{{ thumbnail('/images/2016_0326_hsp_install_wizard_page_4.png', 128, 128) }}" alt="HSP インストールウィザード ページ 04">](/images/2016_0326_hsp_install_wizard_page_4.png) 
[<img src="{{ thumbnail('/images/2016_0326_hsp_install_wizard_page_5.png', 128, 128) }}" alt="HSP インストールウィザード ページ 05">](/images/2016_0326_hsp_install_wizard_page_5.png) 
[<img src="{{ thumbnail('/images/2016_0326_hsp_install_wizard_page_6.png', 128, 128) }}" alt="HSP インストールウィザード ページ 06">](/images/2016_0326_hsp_install_wizard_page_6.png) 
[<img src="{{ thumbnail('/images/2016_0326_hsp_install_wizard_page_7.png', 128, 128) }}" alt="HSP インストールウィザード ページ 07">](/images/2016_0326_hsp_install_wizard_page_7.png)

こんな感じにセットアップウィザードを行うと、

[<img src="{{ thumbnail('/images/2016_0326_hsp_demo.png', 384, 384) }}" alt="HSPデモ">](/images/2016_0326_hsp_demo.png)

とりあえず、 Wine で HSP が動くようになります。

```bash
$ WINEPREFIX=~/wine-hgimg4-test wine c:\\hsp34\\hsed3.exe
```

とすると HSPスクリプトエディタ も起動します。

[<img src="{{ thumbnail('/images/2016_0326_hsp_script_editor_with_assistant.png', 384, 384) }}" alt="HSP スクリプトエディタ＆アシスタント">](/images/2016_0326_hsp_script_editor_with_assistant.png)

## OSX 上の Wine で hgimg3 を動かす

HSPスクリプトエディタ で `sample\\hgimg3\\tamane4.hsp` を開きます。

```bash
$ WINEPREFIX=~/wine-hgimg4-test wine c:\\hsp34\\hsed3.exe "sample\\hgimg3\\tamane4.hsp"
```

[<img src="{{ thumbnail('/images/2016_0326_hgimg3_tamane_source.png', 384, 384) }}" alt="hgimg3 珠音 ソース">](/images/2016_0326_hgimg3_tamane_source.png)

そして、おもむろに <kbd>F5</kbd> を押下、

[<img src="{{ thumbnail('/images/2016_0326_hgimg3_tamane_running.png', 384, 384) }}" alt="hgimg3 珠音">](/images/2016_0326_hgimg3_tamane_running.png)

はい、無事にSDサイズの<ruby>珠音<rp>(</rp><rt>たまね</rt><rp>)</rp></ruby>ちゃんが表示されました。

## OSX 上の Wine で hgimg4 を動かす

HSPスクリプトエディタ で `sample\\hgimg4\\tamane1.hsp` を開きます。

```bash
$ WINEPREFIX=~/wine-hgimg4-test wine c:\\hsp34\\hsed3.exe "sample\\hgimg4\\tamane1.hsp"
```

[<img src="{{ thumbnail('/images/2016_0326_hgimg4_tamane_source.png', 384, 384) }}" alt="hgimg4 珠音 ソース">](/images/2016_0326_hgimg4_tamane_source.png)

そして、おもむろに <kbd>F5</kbd> を押下、

[<img src="{{ thumbnail('/images/2016_0326_hgimg4_tamane_running_failed.png', 384, 384) }}" alt="hgimg4 珠音 失敗">](/images/2016_0326_hgimg4_tamane_running_failed.png)

<span style="font-family: IPAMonaPGothic,'ＭＳ Ｐゴシック',sans-serif;font-size:16px;">(´・ω・`)</sapn>

ここで諦めずに頑張る自分。

Wine のビルド方法は [Mac OS X での Wine のビルドの仕方](/blog/2016/01/31/building-wine-on-mac-osx.html)
 の記事を参照のこと。

そして、Wine 1.9.6 からの変更が、[どーん](https://github.com/sharkpp/wine/commit/6a876fd9a51d5c6ce54c1a6facf9b59561f62ecd)

```diff
$ git diff 6bc0ce26a853b51f11958545bfa5570bdcb1cf01 6a876fd9a51d5c6ce54c1a6facf9b59561f62ecd
diff --git a/dlls/winemac.drv/opengl.c b/dlls/winemac.drv/opengl.c
index ab79a82..c1492f7 100644
--- a/dlls/winemac.drv/opengl.c
+++ b/dlls/winemac.drv/opengl.c
@@ -2387,6 +2387,13 @@ static struct wgl_context *macdrv_wglCreateContextAttribsARB(HDC hdc,
         }
     }
 
+    if (3 == major && minor <= 1) { // force down OpenGL version
+        major   = 2;
+        minor   = 1;
+        flags  &= ~WGL_CONTEXT_FORWARD_COMPATIBLE_BIT_ARB;
+        profile&= ~WGL_CONTEXT_CORE_PROFILE_BIT_ARB;
+    }
+
     if ((major == 3 && (minor == 2 || minor == 3)) ||
         (major == 4 && (minor == 0 || minor == 1)))
     {
```

ビルドが、ばーん

```bash
$ make
   :
Wine build complete.
```

最後に `sample\\hgimg4\\tamane1.hsp` を開き、

```bash
$ WINEPREFIX=~/wine-hgimg4-test ./wine c:\\hsp34\\hsed3.exe "sample\\hgimg4\\tamane1.hsp"
```

そして、おもむろに <kbd>F5</kbd> を押下、

[<img src="{{ thumbnail('/images/2016_0326_hgimg4_tamane_running.png', 384, 384) }}" alt="hgimg4 珠音">](/images/2016_0326_hgimg4_tamane_running.png)

おおおおー

やったね、無事に<ruby>珠音<rp>(</rp><rt>たまね</rt><rp>)</rp></ruby>ちゃんが表示されました。

## 技術的なことをすこし

今回やったことは、 OpenGL 3.1 を要求された場合に OpenGL 2.1 に強制的に変えることをしています。

いろいろ調べたところ、OS X の OpenGL サポートがちょっと残念なことになっているようで、[OS X 10.9 OpenGL Information - OpenGL - Apple Developer](https://developer.apple.com/opengl/capabilities/GLInfo_1090.html) の辺りを見ると

|Profile|Version|
|-|-|
|Legacy|2.1|
|Core|3.3 - 4.1|

となっていて、OpenGL 3.1 なんてサポートして無いよ！って怒られて実行できなかったようです。

単純に Core プロファイルで動くようにして今度はシェーダーでバージョンが違うと怒られたのでどうしたものかと悩んでいましたが、 hgimg4 の 3D エンジンであるところの [GamePlay 2D/3D](http://www.gameplay3d.io/) は OS X もサポートしているらしいのでビルドしてみて試したところ、あれ？ OpenGL 2.1 で動いているぞ！ってことで、今回の対応になったわけです。

ただ、OpenGL 3.1 で使えるシェーダーの機能を使っている場合は Windows と動きが違う可能性があるので確認は必要になると思います。

## おまけ

hgimg4 の他のサンプルや、 HSPプログラムコンテスト 2015 で hgimg4 を利用したプログラムを探し動かしてみました。

[<img src="{{ thumbnail('/images/2016_0326_hgimg4_test1.png', 256, 256) }}" alt="hgimg4 サンプル test1">](/images/2016_0326_hgimg4_test1.png)
[<img src="{{ thumbnail('/images/2016_0326_hgimg4_test2.png', 256, 256) }}" alt="hgimg4 サンプル test2">](/images/2016_0326_hgimg4_test2.png)
[<img src="{{ thumbnail('/images/2016_0326_hgimg4_test3.png', 256, 256) }}" alt="hgimg4 サンプル test3">](/images/2016_0326_hgimg4_test3.png)
[<img src="{{ thumbnail('/images/2016_0326_hgimg4_test4.png', 256, 256) }}" alt="hgimg4 サンプル test4">](/images/2016_0326_hgimg4_test4.png)
[<img src="{{ thumbnail('/images/2016_0326_hgimg4_test5.png', 256, 256) }}" alt="hgimg4 サンプル test5">](/images/2016_0326_hgimg4_test5.png)
[<img src="{{ thumbnail('/images/2016_0326_hgimg4_test6.png', 256, 256) }}" alt="hgimg4 サンプル test6">](/images/2016_0326_hgimg4_test6.png)
[<img src="{{ thumbnail('/images/2016_0326_hgimg4_test7.png', 256, 256) }}" alt="hgimg4 サンプル test7">](/images/2016_0326_hgimg4_test7.png)
[<img src="{{ thumbnail('/images/2016_0326_hgimg4_test8.png', 256, 256) }}" alt="hgimg4 サンプル test8">](/images/2016_0326_hgimg4_test8.png)
[<img src="{{ thumbnail('/images/2016_0326_hgimg4_test9.png', 256, 256) }}" alt="hgimg4 サンプル test9">](/images/2016_0326_hgimg4_test9.png)
[<img src="{{ thumbnail('/images/2016_0326_hgimg4_test10.png', 256, 256) }}" alt="hgimg4 サンプル test10">](/images/2016_0326_hgimg4_test10.png)
[<img src="{{ thumbnail('/images/2016_0326_hgimg4_test11.png', 256, 256) }}" alt="hgimg4 サンプル test11">](/images/2016_0326_hgimg4_test11.png)
[<img src="{{ thumbnail('/images/2016_0326_hgimg4_test12.png', 256, 256) }}" alt="hgimg4 サンプル test12">](/images/2016_0326_hgimg4_test12.png)
[<img src="{{ thumbnail('/images/2016_0326_hgimg4_test13.png', 256, 256) }}" alt="hgimg4 サンプル test13">](/images/2016_0326_hgimg4_test13.png)
[<img src="{{ thumbnail('/images/2016_0326_hgimg4_block3.png', 256, 256) }}" alt="hgimg4 サンプル block3">](/images/2016_0326_hgimg4_block3.png)

[ヨミチハコワイ](http://dev.onionsoft.net/seed/info.ax?id=1077)
(c) 法貴 優雅（MYAOSOFT）/ [@MYAOSOFT](https://twitter.com/MYAOSOFT)

[<img src="{{ thumbnail('/images/2016_0326_hsp_contest_2015_no1077_ss_01.png', 256, 256) }}" alt="ヨミチハコワイ 01">](/images/2016_0326_hsp_contest_2015_no1077_ss_01.png)
[<img src="{{ thumbnail('/images/2016_0326_hsp_contest_2015_no1077_ss_02.png', 256, 256) }}" alt="ヨミチハコワイ 02">](/images/2016_0326_hsp_contest_2015_no1077_ss_02.png)
[<img src="{{ thumbnail('/images/2016_0326_hsp_contest_2015_no1077_ss_03.png', 256, 256) }}" alt="ヨミチハコワイ 03">](/images/2016_0326_hsp_contest_2015_no1077_ss_03.png)

[R-sim++](http://dev.onionsoft.net/seed/info.ax?id=1084)
(c) hashikemu / [@hashikemu](https://twitter.com/kemuduino)

[<img src="{{ thumbnail('/images/2016_0326_hsp_contest_2015_no1084_ss_01.png', 256, 256) }}" alt="R-sim++ 01">](/images/2016_0326_hsp_contest_2015_no1084_ss_01.png)
[<img src="{{ thumbnail('/images/2016_0326_hsp_contest_2015_no1084_ss_02.png', 256, 256) }}" alt="R-sim++ 02">](/images/2016_0326_hsp_contest_2015_no1084_ss_02.png)
[<img src="{{ thumbnail('/images/2016_0326_hsp_contest_2015_no1084_ss_03.png', 256, 256) }}" alt="R-sim++ 03">](/images/2016_0326_hsp_contest_2015_no1084_ss_03.png)

## 参考

* [【微妙】HomebrewでWineを使う | cozy attic](https://cozyattic.wordpress.com/2015/02/16/homebrew%E3%81%A7wine%E3%82%92%E4%BD%BF%E3%81%86/)
* [Wine環境(WINEPREFIX)を分けてWindowsアプリを上手に管理する - kakurasan](http://kakurasan.blogspot.jp/2015/06/manage-winapps-using-wineprefixes.html)
* [IPAモナーフォント](http://www.geocities.jp/ipa_mona/)
* [FontSmoothing](https://technet.microsoft.com/en-us/library/cc978612.aspx)
* [Wine 1.1.12におけるフォントのサブピクセルレンダリングについて - 試験運用中なLinux備忘録](http://d.hatena.ne.jp/kakurasan/20090107/p1)
[OS X 10.9 OpenGL Information - OpenGL - Apple Developer](https://developer.apple.com/opengl/capabilities/GLInfo_1090.html)
