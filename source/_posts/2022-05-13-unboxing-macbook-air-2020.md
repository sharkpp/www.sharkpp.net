---
title: "MacBook Air (M1, 2020) 開封の儀"
date: 2022-05-13 21:37
tags: [雑記, 開封の儀, Mac, MacOS]
categories: [ブログ]

---

メイン機として使っている、MacBook Air (11-inch, Mid 2012) がまだ使えるけど、そろそろZoomなどストリーミング処理が辛くなってきた感じなので新しくしたいなって思ってたところ、機会があったので... ついに...

<blockquote class="twitter-tweet" data-lang="ja"><p lang="ja" dir="ltr">My New Gear <a href="https://t.co/c64XG2F565">pic.twitter.com/c64XG2F565</a></p>&mdash; さめたすたす (@sharkpp) <a href="https://twitter.com/sharkpp/status/1510520564670398465?ref_src=twsrc%5Etfw">April 3, 2022</a></blockquote>
<script async src="https//platform.twitter.com/widgets.js" charset="utf-8"></script>

買っちゃった...

## 開封の儀

MacBook Pro と迷ったけど、まあ前も Air だったから今回も Air にしてみた。

箱もシンプル、中身もシンプル。

[<img src="{{ thumbnail('/images/20220323_box1.png', 640, 640) }}" alt="化粧箱">](/images/20220323_box1.jpg) [<img src="{{ thumbnail('/images/20220323_box2.png', 640, 640) }}" alt="開封して中身確認">](/images/20220323_box2.jpg)

ディスプレイの表面は傷付かなように不織布が貼り付けられてる。前回はどうだったかな...？

[<img src="{{ thumbnail('/images/20220323_macbookair1.png', 640, 640) }}" alt="閉じた状態">](/images/20220323_macbookair1.jpg) [<img src="{{ thumbnail('/images/20220323_macbookair2.png', 640, 640) }}" alt="パカっ！">](/images/20220323_macbookair2.jpg)

いろんな国の「こんにちは」が最初に開けると次々に表示されるセットアップ画面。

[<img src="{{ thumbnail('/images/20220323_macbookair3.png', 640, 640) }}" alt="こんにちは">](/images/20220323_macbookair3.jpg)

セットアップ完了直後はこんな感じ。

[<img src="{{ thumbnail('/images/20220403_desktop1.png', 640, 640) }}" alt="インストール直後のデスクトップ">](/images/20220403_desktop1.png)

OS は Monterey 12.0.1 がインストール済みで、更新の確認をすると Monterey 12.3.1 にアップグレードできた。

[<img src="{{ thumbnail('/images/20220403_desktop2.png', 640, 640) }}" alt="OS バージョン">](/images/20220403_desktop2.png)

新旧の MacBook Air の比較

| タブ | MacBook Air (13-inch Mid 2012)  | MacBook Air (Late 2020)     |
|-|:-:|:-:|
|概要|macOS 10.14.6 (Build 18G9323)<br/>[<img src="{{ thumbnail('/images/20220507_about_oldmac_summary.png', 96, 96) }}" alt="OS バージョン">](/images/20220507_about_oldmac_summary.png)|macOS 12.3.1 (Build 21E258)<br/>[<img src="{{ thumbnail('/images/20220503_about_mac_summary.png', 96, 96) }}" alt="OS バージョン">](/images/20220503_about_mac_summary.png)|
|ディスプレイ|内臓ディスプレイ 13.3 インチ(1440 x 900)<br/>[<img src="{{ thumbnail('/images/20220507_about_oldmac_display.png', 96, 96) }}" alt="ディスプレイ">](/images/20220507_about_oldmac_display.png)|内臓Retinaディスプレイ 13.3 インチ(2560 x 1600)<br/>[<img src="{{ thumbnail('/images/20220507_about_mac_display.png', 96, 96) }}" alt="ディスプレイ">](/images/20220507_about_mac_display.png)|
|ストレージ|251 GB<br/>[<img src="{{ thumbnail('/images/20220507_about_oldmac_storage.png', 96, 96) }}" alt="OS バージョン">](/images/20220507_about_oldmac_storage.png)|500 GB<br/>[<img src="{{ thumbnail('/images/20220510_about_mac_storage.png', 96, 96) }}" alt="ストレージ">](/images/20220510_storag20220510_about_mac_storagee_using.png)|

初期インストールされたアプリ一覧。

前回一度も使わなかったアプリが今回もちらほらありそう。

[<img src="{{ thumbnail('/images/20220403_apps1.png', 640, 640) }}" alt="アプリ一覧">](/images/20220403_apps1.png) [<img src="{{ thumbnail('/images/20220403_apps2.png', 640, 640) }}" alt="アプリ一覧2">](/images/20220403_apps2.png)

アクティビティーモニタの表示。種類欄がアーキテクチャの表示っぽい。初期インストールされたものは、そりゃまぁ Apple(＝M1) で動いてるね。

[<img src="{{ thumbnail('/images/20220403_taskmgr1.png', 640, 640) }}" alt="アクティビティーモニタ1">](/images/20220403_taskmgr1.png) [<img src="{{ thumbnail('/images/20220403_taskmgr2.png', 640, 640) }}" alt="アクティビティーモニタ2">](/images/20220403_taskmgr2.png)

初期の設定だとクリックとダブルクリックの誤操作が頻発し、操作感がイマイチだったので設定を探して変更。

「トラックパッドの設定」に該当の設定を見つけた。

* 　 調べる＆データ検出
* ✅ 副ボタンのクリック
* 　 タップでクリック

[<img src="{{ thumbnail('/images/20220411_trackpad_config.png', 640, 640) }}" alt="トラックパッド設定">](/images/20220411_trackpad_config.png)

## Geekbench で比較

[Geekbench 5 Tryout](https://www.geekbench.com/) を使ってしてスペックを比較してみる。

新旧の結果をまとめると...

|機種|Single-Core|Multi-Core|OpenCL|Metal|
|-|-:|-:|-:|-:|
|MacBook Air (13-inch Mid 2012) x86 (64-bit)|[328](https://browser.geekbench.com/v5/cpu/14758525)|[951](https://browser.geekbench.com/v5/cpu/14758525)|[929](https://browser.geekbench.com/v5/compute/4783629)|[178](https://browser.geekbench.com/v5/compute/4785033)|
|MacBook Air (Late 2020) AArch64|[1732](https://browser.geekbench.com/v5/cpu/14192043)|[7711](https://browser.geekbench.com/v5/cpu/14192043)|[18824](https://browser.geekbench.com/v5/compute/4630141)|[20872](https://browser.geekbench.com/v5/compute/4783614)|

スコアが著しくアップしていて性能の差が著しい...
特にグラフィックの性能は顕著。

参考にそれぞれのPCのスペックの比較

|                      | MacBook Air (13-inch Mid 2012)  | MacBook Air (Late 2020)     |
|-|:-:|:-:|
|**System Information**|                                 |                             |
| Operating System     | macOS 10.14.6 (Build 18G9323)   | macOS 12.3.1 (Build 21E258) |
| Model                | MacBook Air (13-inch Mid 2012)  | MacBook Air (Late 2020)     |
| Model ID             | MacBookAir5,2                   | MacBookAir10,1              |
| Motherboard          | Apple Inc. Mac MacBookAir5,2    | MacBookAir10,1              |
|**CPU Information**   |                                 |                             |
| Name                 | Intel Core i5-3427U             | Apple M1                    |
| Topology             | 1 Processor, 2 Cores, 4 Threads | 1 Processor, 8 Cores        |
| Base Frequency       | 1.80 GHz                        | 3.20 GHz                    |
| L1 Instruction Cache | 32.0 KB x 2                     | 128 KB x 1                  |
| L1 Data Cache        | 32.0 KB x 2                     | 64.0 KB x 1                 |
| L2 Cache             | 256 KB x 2                      | 4.00 MB x 1                 |
| L3 Cache             | 3.00 MB x 1                     |                             |
|**Memory Information**|                                 |                             |
| Memory               | 8.00 GB DDR3 1600 MT/s          | 8.00 GB                     |
|**Metal Information** |                                 |                             |
| Device Name          | Intel HD Graphics 4000          | Apple M1                    |
|**OpenCL Information**|                                 |                             |
| Platform Vendor      | Apple                           | Apple                       |
| Platform Name        | Apple                           | Apple                       |
| Device Vendor        | Intel                           | Apple                       |
| Device Name          | HD Graphics 4000                | Apple M1                    |
| Compute Units        | 16                              | 8                           |
| Maximum Frequency    | 1150 MHz                        | 1000 MHz                    |
| Device Memory        | 1.50 GB                         | 5.33 GB                     |

## インストールしたアプリ

とりあえず最初に入れてみたアプリはこちら。
多分大体入れた順。

|アプリ|概要|
|-|-|
|Google Chrome||
|[Visual Studio Code](https://code.visualstudio.com/)|開発環境|
|[GitHub Desktop](https://desktop.github.com/)|GitHub クライアント|
|Command Line Developer Tools|コマンドラインツールなど。touchコマンドとかこれで入る|
[Inkscape](https://inkscape.org/)|ドローソフト|
[GIMP](https://www.gimp.org/)|ペイントソフト|
[Krita](https://krita.org/)|ペイントソフト|
[Docker Desktop](https://www.docker.com/)|Docker|
|[CheatSheet](https://www.mediaatelier.com/CheatSheet/)|お試しで|
|[The Unarchiver](https://apps.apple.com/jp/app/the-unarchiver/id425424353?mt=12)|圧縮/解凍|
|[Homebrew](https://brew.sh/index_ja)|パッケージマネージャ|
|[Blender](https://www.blender.org/)|3D ソフト|
|[Clipy](https://github.com/Clipy/Clipy/releases)|クリップボードの履歴を取るソフト|

他はおいおい入れてこうかな。

## まとめ

ちょっとずつ使い始めてるけど、新しいからか圧倒的にバッテリー持ちが良くなってる。

性能もすごい良くなってるので楽しい。
