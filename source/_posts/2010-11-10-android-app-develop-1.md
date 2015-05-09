---
title: "Androidアプリの開発(その1)"
tags: [develop, Android]
categories: [blog]

---

Androidアプリ開発に必要な事柄をめもめも...

おもにGalaxyS関連が多くなります。

#### Androidエミュレータのショートカットキー一覧

[Android Emulator | Android Developers][1]

#### Galaxy S 用USBドライバ

  1. [Support for Galaxy S SAMSUNG][2]などから、Kies_*.exe (SAMSUNG Kies,PC Sync)をDL
  2. 7-zipなどでEXEを解凍し CabFile\USB Driver\SAMSUNG\_USB\_Driver\_for\_Mobile_Phones.exe.cab を取り出し更に解凍
  3. でてきたSAMSUNG\_USB\_Driver\_for\_Mobile_Phones.exeをインストール  
    <a href="/public/images/2010_1110_galaxys_usb_driver_install.png" rel="lytebox[x2010_1110_galaxys]" title="GalaxyS USBドライバインストール画面"><img src="/public/images/2010_1110_galaxys_usb_driver_install.jpg" alt="GalaxyS USBドライバインストール画面" /></a>
  4. こんな感じで認識されます。  
    <a href="/public/images/2010_1110_galaxys_device_detected.png" rel="lytebox[x2010_1110_galaxys]" title="GalaxySデバイスマネージャ認識"><img src="/public/images/2010_1110_galaxys_device_detected.jpg" alt="GalaxySデバイスマネージャ認識" /></a><a href="/public/images/2010_1110_galaxys_device_detected_adb.png" rel="lytebox[x2010_1110_galaxys]" title="GalaxyS adb認識"><img src="/public/images/2010_1110_galaxys_device_detected_adb.jpg" alt="GalaxyS adb認識" /></a>

※AndroidSDKでダウンロードできるUSBドライバは色々試すだけ時間の無駄、素直にメーカー製USBドライバを入れましょう

#### スクリーンショット

USBドライバをインストールしたらAndroid SDKのtools\ddms.batでスクリーンショットは取れる

GalaxyS(Android 2.2？)はさらに標準で「戻る」＋「ホーム」ボタンの同時押しでも保存できます

<a href="/public/images/2010_1110_galaxys_sc.png" rel="lytebox[x2010_1110_galaxys]" title="スクリーンショット"><img src="/public/images/2010_1110_galaxys_sc.jpg" alt="GalaxySスクリーンショット" /></a>

他なんかあった気がするけど忘れた。

思い出したらまた書く予定

 [1]: http://developer.android.com/guide/developing/tools/emulator.html#controlling
 [2]: http://www.samsung.com/uk/support/detail/supportPrdDetail.do?menu=SP01&prd_ia_cd=23020100&prd_mdl_cd=GT-I9000HKDXEU&prd_mdl_name=GT-I9000&prd_ia_sub_class_cd=P