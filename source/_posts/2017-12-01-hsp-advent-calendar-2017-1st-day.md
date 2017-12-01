---
title: "Google Poly で公開されている素材を HSP 3 で利用してみよう"
date: 2017-12-01 23:25:00
tags: [Advent Calendar, HSP, hgimg4, Google Poly, VR, AR]
categories: [ブログ]

---

こんにちは、こんばんは。

[Hot Soup Processor Advent Calendar 2017](http://qiita.com/advent-calendar/2017/hsp) の 初日を担当する [@sharkpp](https://twitter.com/sharkpp) です。

この記事では、Google Poly で公開されている [Wavefront .OBJ ファイル](https://ja.wikipedia.org/wiki/Wavefront_.obj%E3%83%95%E3%82%A1%E3%82%A4%E3%83%AB) を HSP の hgimg4 で利用してみる方法について書いています。

## はじめに

皆さんは、ちょうどひと月前に公開された Google の [Poly](https://poly.google.com/) というサイトをご存知でしょうか？

似てますが Google Play じゃないですよ？

このサイトは、Google が後悔した VR/AR向け素材のライブラリサイトで、クレジット（著作権表示）を行えば改変なども可能な CC BY ライセンスで数多くの素材が公開されています。

今回はこのサイトに登録されている Tilt Brush 以外で作られた OBJ をダウンロードして hgimg4 で表示して見ることにします。

あ、 HSP は 3.5 を利用しています。

## 素材の用意

とりあえず、適当に素材を選びます。

この時、Google の VR お絵かきソフトである [Tilt Brush](https://www.tiltbrush.com/) で作られた素材は、形式が OBJ ではないことが理由なのか何なのかは分からないですがダウンロードができません。
なので [Blocks](https://vr.google.com/blocks/) や、それ以外で作られた素材を探します。

ダウンロードを押下すると

> このコンテンツは CC-BY ライセンスで公開されています。著作権に関する情報を表示する必要があります。

などと、利用する場合の注意点が表示されるのでよく確認しておきましょう。

フィルタを利用すると探すのが容易になります。

![](/images/2017_1201_poly_obj_download.png)

素材によっては OBJ 形式以外にも

* 三角 OBJ ファイル
* FBX ファイル

など、別の形式が選べる場合もあります。

FBX ファイルをダウンロードして利用する場合は、次の OBJ から FBX への変換処理は必要ないので読み飛ばしてください。

## 選んだ素材

[東京タワー](https://poly.google.com/view/frPqTFGeRNM)

![東京タワー](/images/2017_1201_model_frPqTFGeRNM.png)

> &copy; [Kenta Imai (henteko)](https://poly.google.com/user/99VuVXH6oer)


[Lighthouse](https://poly.google.com/view/3gEvVZoTN7e)

![Lighthouse](/images/2017_1201_model_3gEvVZoTN7e.png)

> &copy; [Robert Mirabelle](https://poly.google.com/user/fa4m5c69h51)


[Rio de Janeiroy](https://poly.google.com/view/2binsxeOBve)

![Rio de Janeiroy](/images/2017_1201_model_2binsxeOBve.png)

> &copy; [Alan Zimmermany](https://poly.google.com/user/13QtrlRKjO-)


[McGraw Athletic Centery](https://poly.google.com/view/cINomH54DAx)

![McGraw Athletic Centery](/images/2017_1201_model_cINomH54DAx.png)

> &copy; [Jordan Van Wyky](https://poly.google.com/user/eH7rRxk0HuE)


[new growthy](https://poly.google.com/view/3vKuzmkSpdr)

![new growthy](/images/2017_1201_model_3vKuzmkSpdr.png)

> &copy; [Tanner Whytey](https://poly.google.com/user/eXRnbKFZIta)


[Bonsaiy](https://poly.google.com/view/8Jp1S6F0uzi)

![Bonsaiy](/images/2017_1201_model_8Jp1S6F0uzi.png)

&copy; [brett hursty](https://poly.google.com/user/cMk8S7aDHny)

## hgimg4 専用形式へ変換

HSP付属の；；；；は FBX からの変換のみに対応しているようなので OBJ から FBX 形式への変換処理をする必要があります。

昔は Autodesk FBX Converter がダウンロード出たようですが、今見に行くと Autodesk FBX Preview のダウンロードページへと飛ばされてしまいます。

なので、探し回ったところ、幸運なことに [Internet Archive](https://archive.org/) で保存されていた昔のページ [FBX® 2013.3 Converter](http://web.archive.org/web/20170926144107/http://usa.autodesk.com/adsk/servlet/pc/item?siteID=123112&id=22694909) からダウンロードすることができました。

|ファイル名|MD5|
|-|-|
|`fbx20133_converter_win_x64.exe`|`5435cf1371502e66b9048834b897011e`|

FBX Converter を起動すると、左側に元ファイル(`Source files`)、右側に変換後のファイル(`Destination files`) の欄が表示されます。

![FBX Converter 2013](/images/2017_1201_FBX_Converter_2013.png)

`Add...` ボタンか `.obj` ファイルをドロップすることでリストに登録できます。

右下の `Convert` で変換が出来ます。

`.FBX` 形式に変換したら hgimg4 で利用するために `.gpb` 形式に変換します。

GPB Converter というのが標準ツールとしてありますのでそれを使いますが、HSPのインストールフォルダパスにスペースが含まれているとうまく動かないようです。

もし、うまくファイルが変換できない場合は、コマンロプロンプトで `gameplay-encoder` で呼び出してみましょう。

```
> gameplay-encoder "model.fbx" "model.gpb"
Encoding file: model.fbx
Loading FBX file.
Loading Scene.
Triangulate.
Load nodes.
Load materials
Loading animations.
Optimizing GamePlay Binary.
Saving binary file: model.gpb

> gameplay-encoder -m "model.fbx" "model.material"
Encoding file: model.fbx
Loading FBX file.
Loading Scene.
Triangulate.
Load nodes.
Load materials
Loading animations.
Optimizing GamePlay Binary.
Saving binary file: model.gpb
```

## hgimg4 で読み込み

後は簡単です。

※ `sample/hgimg4/test8.hsp`

```
#include "hgimg4.as"

title "HGIMG4 Test"

	gpreset
	setcls CLSMODE_SOLID, $404040
	gpload id_model,"data/frPqTFGeRNM_9L5eUA1sj4m_obj/model"
	setpos GPOBJ_CAMERA, 0,0,5
	x=0.0:y=0.0:z=0.0

repeat
	stick key,15
	if key&128 : end

	redraw 0
	addang id_model,0,0.02
	gpdraw
	color 255,255,255
	pos 8,8:mes "HGIMG4 sample"
	redraw 1
	await 1000/60
loop
```

と、このようにモデルデータを指定し読み込むことができます。

![東京タワー](/images/2017_1201_hgimg4_frPqTFGeRNM.png)

![McGraw Athletic Centery](/images/2017_1201_hgimg4_cINomH54DAx.png)

![Lighthouse](/images/2017_1201_hgimg4_3gEvVZoTN7e.png)

何点か読み込ませてみた感じ、

* 巨大で読み込みに時間かかるモデルがある
  [new growthy](https://poly.google.com/view/3vKuzmkSpdr) とか [Bonsaiy](https://poly.google.com/view/8Jp1S6F0uzi) これ
* スケールに規格があるわけではないのでマチマチ
* テクスチャが読み込めない
* 材質？が反映できていない？

テクスチャは、パスとかファイル形式などが理由かもしれませんが未解決です。

## おわりに

パッとさわってみた限り、テクスチャの問題を除いても、そのままで HSP で利用できそうなのが少ない印象でした。
ここは、HSP専用のassetストアの解説が待たれるところです！

明日は [@y_tack](https://twitter.com/y_tack) さんの「（エターナル化してきた）OpenHSPの書写他（仮）」です。

楽しみですね。

## 参考

* [Poly](https://poly.google.com/)
* [Parking Lot - Poly](https://poly.google.com/view/4NYtgQKdVMy)

* [Online 3D Converter](http://www.greentoken.de/onlineconv/)
* [Autodesk FBX Converter について | 検索 | Autodesk Knowledge Network](https://knowledge.autodesk.com/ja/search-result/caas/sfdcarticles/sfdcarticles/kA230000000u0m3.html)
* [Autodesk - Autodesk FBX - FBX® 2013.3 Converter](http://web.archive.org/web/20170926144107/http://usa.autodesk.com/adsk/servlet/pc/item?siteID=123112&id=22694909)
* [三次元極座標についての基本的な知識 | 高校数学の美しい物語](https://mathtrain.jp/rthetaphi)
* [mousew変数 （マウスホイールの回転量取得） - Let's HSP!](http://lhsp.s206.xrea.com/command/mousew.html)
* [ラジアン(弧度法)と度(度数法)の相互変換ツールと変換計算式 - PEKO STEP](https://www.peko-step.com/tool/tfrad.html)

<hr />

この投稿は **[Hot Soup Processor Advent Calendar 2017](http://qiita.com/advent-calendar/2017/hsp)** の **1日目**の記事です。

* 2日目の記事: （エターナル化してきた）OpenHSPの書写他（仮）

<hr />