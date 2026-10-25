---
title: "新しいNASを構築した"
date: 2026-10-25 18:50
tags: [雑記, NAS, OpemMediaVault8]
categories: [ブログ]

---

現行NAS環境も稼働が９年を超えて動きも怪しくなっていたので新調することにしました。

実は昨年の夏頃から部材は集めてたんですが、HDDだけちょっと高いなーって思ってて様子見てたらあれよあれよというまに２倍ぐらいになってしまいましたね...

SynologyのNASケースも検討したけど、高いのとHDDが限定されるのでミニPCとケースで運用してみることにしました。

![omv-dashboard](/images/20261025_omv8_dashboard.png)

## 自宅NASの歴史

|日付|機種|備考|
|-|-|-|
|2011-12-05|QNAP TS-109Ⅱ|1ベイで運用 ※運用開始はもっと前|
|2017-01-15|Synology DS416play|4ベイ|
|2026-10-10|ミニPC + OpenMediaVault 8 + UGREEN 5ベイHDDケース|5ベイ、HDDは４台換装|

## 今回使った機材

* GMKtec NucBox G3 Plus (CPU: Intel N150 / MEM: 16GB / : SSD 512GB)
* UGREEN CM646 UGREEN HDD ケース(5ベイ / RAID機能付き)
* HDD WD Red × 4
* JetKVM IP KVM
* USB メモリ 128GB
* OpenMediaVault 8

## NASの構築

### ブートメディアを作成

1. USB メモリを [ventoy](https://www.ventoy.net/en/) で初期化
2. OpenMediaVault 8 の ISO を [ここ](https://www.openmediavault.org/download.html) からダウンロードし、USB メモリに保存
3. （Rescuezilla の ISO を [ここ](https://rescuezilla.com/download) からダウンロードし、USB メモリに保存）

### OpenMediaVault 8 をセットアップ

ウィザードに沿って進めるだけで特に問題なく終了。
１点、GMKtec NucBox G3 Plus はすでにWindowsがインストール済みなので、そこの領域を上書きする形でインストールします。

PCのセットアップでは JetKVM を使ってキーボードとモニタを使わずにセットアップしてみた。
OMVセットアップ中、KVMのウェブ画面上でモニタの接続が切れた旨、表示されることがあった。
原因は入力がなかったので画面がスリープしていただけだったので、キー入力をしたら表示された。

なぜかNICのインターフェースがONになっていなかったので、viで設定を変えてなんとかONにした。
が、どうやら `omv-firstaid` コマンドで設定できたようだ。

#### omv-firstaid コマンドについて

![omv-firstaid](/images/20261025_omv8_firstaid.png)

ヘルプで出る利用できる機能の一覧を日本語訳

1. Configure network interface (ネットワークインターフェースの設定)
2. Configure time zone (タイムゾーンの設定)
3. Configure workbench (ワークベンチの設定)
4. Change Workbench administrator password (ワークベンチ管理者パスワードの変更)
5. Reset failed login attempt counter (ログイン失敗回数カウンターのリセット)
6. Restore configuration backup (設定バックアップの復元)
7. Check configuration status file (設定ステータスファイルの確認)
8. Check RRD database (RRDデータベースの確認)
9. Refresh APT package lists and clean caches (APTパッケージリストの更新とキャッシュのクリーンアップ)
10. Clear local upload package repository (ローカルアップロードパッケージリポジトリのクリア)

### HDD をケースに装着しPCに接続

1. HDDを順番にトレイにねじ止めし挿入する
2. dip スイッチ で RAID 5 に設定し、所定操作で反映。
3. PCにケーブルを繋ぎ、電源をON
4. OMVのウェブ画面でHDDが認識されていることを確認。DDの情報でRAID 5 となっていることを確認

OS側でソフトレイドにしないのは、パフォーマンス的なところと、PCフリーズでRAIDが壊れると困るなってところでケースのRAID機能を使うことにした。
これが吉と出るか凶と出るか... 

HDD ケースのRAIDの切り替え方法は [Amazonの販売ページ](https://www.amazon.co.jp/dp/B0H6F6473K) によると、

> RAID モードの切り替え方法：
> 電源オフの状態でRAID紹介表を参考して、 dip スイッチを利用したい RAID モードを選定。
> 針の孔のリセットボタンを長押しながら、電源ボタンを 3 秒くらい押し、ハードデスクLEDインジケーターが白く点滅してRAID設定完了。リセットボタンを離します。
> ディスク管理で新しいハードディスクをフォーマットします。[PC]> [ デバイスの管理 ]> に移動し、現在の RAID モードを確認します。

> PM 以外のモードは、モード切り替える前に dip スイッチをPM モードに戻して、RAID モードの切り替え設定する必要があります。

となっているが... 取説と記載が違うんですよね...

RAIDモードを設定して、起動するもすぐFANが止まり、初期不良か電力不足か？と色々試してたので、結局どちらが正しいか不明。
結局、原因は付属の USB Type C ↔︎ Type C / Type A の変則的なケーブルが外れてたので、PC側が電源が切れたとHDD ケースが判断しスリープになってたからのよう。
HDD ケースはアクセスがないとスリープモードになるらしいので、NASとして運用していて支障があるなら変更予定。

### HDD の S.M.A.R.T.

今回、HDDケースのRAID機能を使っているので、普通に取得すると
```console
# smartctl -a -d sat /dev/sda

smartctl 7.4 2023-08-01 r5530 [x86_64-linux-7.2.6+deb13-amd64] (local build)
Copyright (C) 2002-23, Bruce Allen, Christian Franke, www.smartmontools.org

=== START OF INFORMATION SECTION ===
Device Model:     Ugreen Raid 5
Serial Number:    6M29BNX0DYXH░░░░░░░░
Firmware Version: 1003
User Capacity:    24,004,572,217,344 bytes [24.0 TB]
Sector Size:      512 bytes logical/physical
Device is:        Not in smartctl database 7.3/6157
ATA Version is:   ATA/ATAPI-7 (minor revision not indicated)
Local Time is:    Sun Oct 11 21:49:51 2026 JST
SMART support is: Available - device has SMART capability.
SMART support is: Enabled
                     ：
```
となり、HDDそれぞれの情報が取れない。

`lsusb` を実行すると、

```console
Bus 002 Device 003: ID 174c:1153 ASMedia Technology Inc. ASM1153E Drive Dock
Bus 002 Device 004: ID 152d:0567 JMicron Technology Corp. / JMicron USA Technology Corp. JMS567
```

このように出てくる。それぞれ

| メーカー / チップ系列 | lsusb 表記・IDの傾向 | 試すべき smartctl オプション |
|-|-|-|
| ASMedia (ASM1352R等)    | `174c:...` / ASMedia | `sudo smartctl -a -d usbasm1352r,0 /dev/sdasudo smartctl -a -d usbasm1352r,1 /dev/sda` |
| JMicron (JMB39x等)      | `152d:...` / JMicron | `sudo smartctl -a -d jmb39x,0 /dev/sda`<br />`sudo smartctl -a -d jmb39x,1 /dev/sda` |
| ASMedia (NVMe/SATA複合) | `174c:...` / ASMedia | `sudo smartctl -a -d sntasmedia /dev/sda` |
| JMicron (NVMe/SATA複合) | `152d:...` / JMicron | `sudo smartctl -a -d sntjmicron /dev/sda `| 

このような感じで試してみると良さそう。

うちのは、`jmb39x`で取得できた。

```console
# smartctl -a -d jmb39x,1 /dev/sda
smartctl 7.4 2023-08-01 r5530 [x86_64-linux-7.2.6+deb13-amd64] (local build)
Copyright (C) 2002-23, Bruce Allen, Christian Franke, www.smartmontools.org

=== START OF INFORMATION SECTION ===
Model Family:     Western Digital Red Plus
Device Model:     WDC WD80EFPX-68C4ZN0
Serial Number:    WD-░░░░░░░░
LU WWN Device Id: 5 0014ee 2░░░░░░░░
Firmware Version: 81.00A81
User Capacity:    8,001,563,222,016 bytes [8.00 TB]
Sector Sizes:     512 bytes logical, 4096 bytes physical
Rotation Rate:    5640 rpm
Form Factor:      3.5 inches
Device is:        In smartctl database 7.3/6157
ATA Version is:   ACS-3 T13/2161-D revision 5
SATA Version is:  SATA 3.1, 6.0 Gb/s (current: 3.0 Gb/s)
Local Time is:    Sun Oct 11 21:49:21 2026 JST
SMART support is: Available - device has SMART capability.
SMART support is: Enabled
                     ：
```

問題は、これをそのまま標準のUIで列挙し監視することができなさそう。
どうしたものかと考え中。

## OMVの設定諸々

|NAV|||
|-|-|-|
|ダッシュボード|||
|🏠 ▶︎ システム ▶︎ 日付と時刻|NTPサーバを使用する|☑️|
|🏠 ▶︎ システム ▶︎ 日付と時刻|時刻サーバ|`pool.ntp.org`|
|🏠 ▶︎ システム ▶︎ 通知 ▶︎ 設定|有効|有効にしてgmailに送信。認証は[アプリ パスワード](https://myaccount.google.com/apppasswords)で設定|
|🏠 ▶︎ システム ▶︎ モニタリング|有効|☑️|
|🏠 ▶︎ システム ▶︎ プラグイン|||
|🏠 ▶︎ ストレージ ▶︎ S.M.A.R.T. ▶︎ 設定|有効|☑️|
|🏠 ▶︎ ストレージ ▶︎ 共有フォルダ||
|🏠 ▶︎ サービス ▶︎ SMB/CIFS ▶︎ 設定|有効|☑️|
|🏠 ▶︎ サービス ▶︎ SMB/CIFS ▶︎ 設定 §ホームディレクトリ|有効|☑️|
|🏠 ▶︎ サービス ▶︎ SMB/CIFS ▶︎ 設定 §ホームディレクトリ|ごみ箱を有効化|☑️|
|🏠 ▶︎ ユーザー ▶︎ 設定(ユーザーマネジメント) §ユーザーのホームディレクトリ|有効|☑️|
|🏠 ▶︎ ユーザー ▶︎ 設定(ユーザーマネジメント) §ユーザーのホームディレクトリ|ロケーション|`homes`|
|🏠 ▶︎ ユーザー ▶︎ ユーザー||※uidが1000以上のものが列挙されるっぽい|

### ダッシュボード

あとで編集するには、アカウントからダッシュボードを選ぶ。

![omv8 customize dashboard](/images/20261025_omv8_customize_dashboard.png)

### システム ▶︎ プラグイン

|プラグイン名|備考|
|-|-|
|[openmediavault-omvextrasorg](https://wiki.omv-extras.org/doku.php?id=omv8:omv8)||
|[openmediavault-compose](https://wiki.omv-extras.org/doku.php?id=omv8:omv8_plugins:docker_compose)|※omvextrasorgに含まれる|
|openmediavault-cterm|※自動で入っていたかも？|
|openmediavault-photoprism||
|openmediavault-sharerootfs||
|[openmediavault-tempmon](https://wiki.omv-extras.org/doku.php?id=omv8:omv8_plugins:tempmon)||

* [openmediavault-filebrowser](https://wiki.omv-extras.org/doku.php?id=omv8:omv8_plugins:filemanager) も入れてみたけど動かなかった＆どうも利用している [filebrowser/filebrowser](https://github.com/filebrowser/filebrowser)が更新停止で非推奨になったようだ。

### ストレージ ▶︎ 共有フォルダ

`Apps/{アプリケーション名}` を用意して、各アプリの設定などを保存するようにしてある。

あとは、 `public`、`videos`、`photos`、などをsamba共有用に用意。

## まとめ

一通り動かしてみた感じ、サクサク設定などできる感じで良さそう、という感想を持った。
アプリケーションは Synology と比べそこまで多くはなさそうだけど、Dockerで動かすことで拡張できるので色々試していこうと思う。

入れたアプリについては順次記事でまとめていきたい。

## 参考

* [Getting started | Upptime](https://upptime.js.org/docs/get-started#add-repository-secrets)
* [Unable to find workflow 'Graphs CI' · Issue #995 · upptime/upptime](https://  github.com/upptime/upptime/issues/995#issuecomment-2327757107)
* [OpenMediaVaultの標準/拡張プラグイン全機能(検証作業中メモ)](https://wifi-manual.net/openmediavault-extras-plugins/)

