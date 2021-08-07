---
title: "Synorogy DS416play の OS を DSM 7.0 へアップグレードしてみた"
date: 2021-08-07 19:35
tags: [Synorogy, NAS, DS416play, DSM]
categories: [ブログ]

---

[Synorogy DS416play](http://web.archive.org/web/20170709043315if_/https://www.synology.com/ja-jp/products/DS216play) の OS を DSM 7.0 へアップグレードした時の記録。

7月中旬に DSM 7.0 の正式リリースがでるも、しばらくは様子見にしていたけど、致命的な不具合もなさそうだし [Synorogy Photos](https://www.synology.com/ja-jp/DSM70/SynologyPhotos) を使ってみたくなったのでアップグレードしてみることとした。

# アップグレード

DSM の更新のページで、DSM 7 のアップグレードボタンをクリック。

[<img src="{{ thumbnail('/images/20210807_ds416play_01_dsm624_upgrade.png', 640, 640) }}" alt="DSM 6.2">](/images/20210807_ds416play_01_dsm624_upgrade.png) [<img src="{{ thumbnail('/images/20210807_ds416play_02_dsm624_upgrade.png', 640, 640) }}" alt="DSM 6.2">](/images/20210807_ds416play_02_dsm624_upgrade.png)

インストール中も UI が途切れることなく進めた。
通信途切れるとページが真っ白とかになるけどそういうことはなかった。

1. DSMの更新
2. 再起動
3. システムデータベースのアップデート
4. パッケージの更新

の順。

[<img src="{{ thumbnail('/images/20210807_ds416play_03_dsm7_install.png', 640, 640) }}" alt="DSMの更新中">](/images/20210807_ds416play_03_dsm7_install.png) [<img src="{{ thumbnail('/images/20210807_ds416play_04_dsm7_install.png', 640, 640) }}" alt="再起動中">](/images/20210807_ds416play_04_dsm7_install.png) [<img src="{{ thumbnail('/images/20210807_ds416play_05_dsm7_install.png', 640, 640) }}" alt="システムデータベースのアップデート">](/images/20210807_ds416play_05_dsm7_install.png) [<img src="{{ thumbnail('/images/20210807_ds416play_06_dsm7_install.png', 640, 640) }}" alt="パッケージの更新中">](/images/20210807_ds416play_06_dsm7_install.png)

ログイン画面も変わってた。

[<img src="{{ thumbnail('/images/20210807_ds416play_07_dsm7_login.png', 640, 640) }}" alt="ログイン画面">](/images/20210807_ds416play_07_dsm7_login.png)

ダッシュボードも少し変わってる。

[<img src="{{ thumbnail('/images/20210807_ds416play_08_dsm7_dashboard.png', 640, 640) }}" alt="ダッシュボード">](/images/20210807_ds416play_08_dsm7_dashboard.png)

Python3 は OS 組み込みになったようなのでアンインストール

[<img src="{{ thumbnail('/images/20210807_ds416play_09_dsm7_python3_uninstall.png', 640, 640) }}" alt="ダッシュボード">](/images/20210807_ds416play_09_dsm7_python3_uninstall.png)

Moments や Photo Station は [Synology Photos](https://www.synology.com/ja-jp/DSM70/SynologyPhotos) に自動で更新された様子。

[<img src="{{ thumbnail('/images/20210807_ds416play_10_dsm7_photos.png', 640, 640) }}" alt="Synology Photos">](/images/20210807_ds416play_10_dsm7_photos.png) [<img src="{{ thumbnail('/images/20210807_ds416play_11_dsm7_photos.png', 640, 640) }}" alt="Synology Photos">](/images/20210807_ds416play_11_dsm7_photos.png)

アップデート後の情報

[<img src="{{ thumbnail('/images/20210807_ds416play_12_dsm7.png', 640, 640) }}" alt="DSM 7.0">](/images/20210807_ds416play_12_dsm7.png)

# 現状気がついたこと

* Chromecast with Google TV 向けの Synology Photos アプリは現状なさそう。
  Photo アプリは と接続できない様子なので表示するには [Synology Knowledge Center](https://kb.synology.com/en-my/DSM/help/SynologyPhotos/Android?version=7#b_28) の To cast photos to TVs or external devices: を参考にキャストするしかなさそう

