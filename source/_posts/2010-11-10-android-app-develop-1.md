---
title: "Androidアプリの開発(その1)"
date: 2010-11-10 02:05:00
tags: [Develop, Android]
categories: [blog]

---

Androidアプリ開発に必要な事柄をめもめも...

おもにGalaxyS関連が多くなります。

#### Androidエミュレータのショートカットキー一覧

[Android Emulator | Android Developers][1]

 [1]: http://developer.android.com/guide/developing/tools/emulator.html#controlling

#### Galaxy S 用USBドライバ

  1. [Support for Galaxy S SAMSUNG][2]などから、Kies_*.exe (SAMSUNG Kies,PC Sync)をDL
  2. 7-zipなどでEXEを解凍し CabFile\USB Driver\SAMSUNG\_USB\_Driver\_for\_Mobile_Phones.exe.cab を取り出し更に解凍
  3. でてきたSAMSUNG\_USB\_Driver\_for\_Mobile_Phones.exeをインストール  
    [![GalaxyS USBドライバインストール画面][3]][4]
  4. こんな感じで認識されます。  
    [![GalaxySデバイスマネージャ認識][5]][6][![GalaxyS adb認識][7]][8]

 [2]: http://www.samsung.com/uk/support/detail/supportPrdDetail.do?menu=SP01&prd_ia_cd=23020100&prd_mdl_cd=GT-I9000HKDXEU&prd_mdl_name=GT-I9000&prd_ia_sub_class_cd=P
 [3]: /images/2010_1110_galaxys_usb_driver_install.jpg
 [4]: /images/2010_1110_galaxys_usb_driver_install.png
 [5]: /images/2010_1110_galaxys_device_detected.jpg
 [6]: /images/2010_1110_galaxys_device_detected.png
 [7]: /images/2010_1110_galaxys_device_detected_adb.jpg
 [8]: /images/2010_1110_galaxys_device_detected_adb.png

※AndroidSDKでダウンロードできるUSBドライバは色々試すだけ時間の無駄、素直にメーカー製USBドライバを入れましょう

#### スクリーンショット

USBドライバをインストールしたらAndroid SDKのtools\ddms.batでスクリーンショットは取れる

GalaxyS(Android 2.2？)はさらに標準で「戻る」＋「ホーム」ボタンの同時押しでも保存できます

[![GalaxySスクリーンショット][9]][10]

 [9]: /images/2010_1110_galaxys_sc.jpg
 [10]: /images/2010_1110_galaxys_sc.png

他なんかあった気がするけど忘れた。

思い出したらまた書く予定