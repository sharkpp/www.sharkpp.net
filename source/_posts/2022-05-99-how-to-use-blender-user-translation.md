---
title: "Blender の User Translate を MacOS で使ってみた"
date: 2022-05-01 11:00
tags: [Mac, MacOS, Blender, 翻訳, i18n]
categories: [ブログ]

---

新しい Mac book Air を手に入れたので、以前のだとスペック不足で使いずらかった [Blender](https://www.blender.org/) を入れて、環境を整えてみた。

とりあえず Blender 自体、日本語の表示に対応しているみたいだけど、アドオンを日本語にできる [User Translate](https://blendermarket.com/products/user-translate) アドオンを Mac OS で使ってみました。

1. Blender のインストールと日本語表示の設定を行う
2. CAD Sketcher のインストールと、非公式アドオンのインストールの仕方の説明
3. User Translate のインストールと CAD Sketcher の日本語表示の仕方の説明

をこの記事では扱っています。

## Blender のインストールとUIを日本語化

インストールは[公式ページ](https://www.blender.org/)からダウンロード。
最近、メジャーなソフトだとUAとかみて自動で最適なインストーラやパッケージを選んでくれるサイトが多い印象。

![Blender公式サイト](/images/202205xx_blender_site.png)

そしてインストールするだけ。簡単。

![Blenderインストール](/images/202205xx_blender_install.png)

日本語のメニューにするには...

「Edit」→「Preferences」をメニューから選んで...

![Blenderの設定](/images/202205xx_blender_preference.png)

「Intaface」→「Translation」から「日本語(Japanese)」を選ぶだけ

![Blenderの翻訳設定](/images/202205xx_blender_translation.png)

## CAD Sketcher をインストール

[CAD Sketcher](https://makertales.gumroad.com/l/CADsketcher) から指示に従ってインストールします。

ZIPアーカイブをダウンロードします（ダウンロード後に解凍しないでください）

Blenderを開き、「編集」→「設定」→「アドオン」→「インストール...」ボタンを押します。

![Blenderのアドオンのインストール](/images/202205xx_blender_addon_install.png)

ダウンロードした `main.zip` を参照して選択し、[アドオンのインストール]を押します。

![Blenderのアドオンの選択](/images/202205xx_blender_addon_select.png)

チェックボックスを押してアドオンを有効にします。

![Blenderのアドオンの有効化](/images/202205xx_blender_addon_enable.png)

CAD Sketcher は [solvespace python module](https://pypi.org/project/py-slvs/) が必要となるため、アドオンの設定内で、"Solver Module" タブをチェックして、モジュールがすでに使用可能かどうかを確認します。

`Module isn't Registered` と表示が出ている場合は "Install from PIP" ボタンを押してインストールします。

![CAD Sketcherの画面](/images/202205xx_cad_sketcher_ui.png)

## User Translation をインストール

[User Translate](https://bookyakuno.gumroad.com/l/user-translate) からアドオンのZIPファイルをダウンロードしてインストール。

手順は先ほどと同じ。

翻訳するためのテーブルは `/Users/{ユーザー名}/Library/Application Support/Blender/{Blenderバージョン}/scripts/addons/user_translate/user_files` (以下 `user_files`) に存在します。現状、「フォルダーを開く」が効かなかった...

パスの一部は環境によって違うので

|変数|概要|
|-|-|
|`{ユーザー名}`|コンピュータを使用中のユーザー名|
|`{Blenderバージョン}`|インストールした Blender のバージョン。 `3.1` など|

それぞれ自分の環境に置き換えてください。

`user_files` フォルダへのアクセスは、Finder で `Command` + `Shift` + `G` を入力し「フォルダへ移動」を表示し上記のパスを入力します。

![フォルダへ移動](/images/202205xx_move_to_user_translate_addon_folder.png)

デフォルトでは `sample.csv` のみ存在します。

![デフォルトの中身](/images/202205xx_default_user_translate_addon_folder.png)

## CAD Sketcher を翻訳してみる

[日本語化【CAD_Sketcher】翻訳ファイル - Studio GAMMA - BOOTH](https://studiogamma.booth.pm/items/2966402) から `CAD_Sketcher_v0.20.0用_v1.01.zip` をダウンロードします。

ZIPファイルを展開し、`CAD_Sketcher_v0.20.0.csv` を取り出し、`user_files` に設置します。

設置すると自動的に翻訳が適用されます。

![CAD Sketcherの画面(日本語)](/images/202205xx_cad_sketcher_ui_ja.png)

## 参考

* [【User Translate / 英語のアドオンを日本語化】半自動・手動でユーザー翻訳辞書が作れるアドオン【Blenderアドオン】 – 忘却まとめ](https://bookyakuno.com/user-translate/)
* [CAD Sketcher [ Blender Addon ]](https://makertales.gumroad.com/l/CADsketcher)
* [CAD SketcherブレンダーでCADと似たように数値入力してモデリング出来る無料アドオン - 3DCG最新情報サイト MODELING HAPPY](https://modelinghappy.com/archives/43418)





