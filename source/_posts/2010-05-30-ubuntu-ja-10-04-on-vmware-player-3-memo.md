---
title: "Ubuntu-ja-10.04をVMware Player 3で動かすときのメモ"
tags: [ubuntu, vmware-player]
categories: [blog]

---

ハードディスクも増設しUbuntu-ja-10.04も出たのでVMware Player 2.5をVMware Player 3.1にアップグレードしてインストールしてみた。

[Ubuntu-ja-8.10をVMware Player 2で動かすときのメモ][1]の続編みたいな感じ。

 [1]: /blog/2009/01/10/ubuntu-ja-8-10-on-vmware-player-2-memo

まだ、一部未解決な問題が残っていてまともに使えていない。







 

  


### Ubuntu 10.04インストール

isoを指定したらOSを認識し、簡易インストール機能が使用できました。

アカウント名などを指定したら後は自動でらくちん！

UIやキーボードなどが英語になっていたのでそれだけログイン画面で変更しました。

[![Ubuntu 10.04 インストール画面][2]][3]

 [2]: /images/2010_0530_ubuntu_10_04_install_s.jpg
 [3]: /images/2010_0530_ubuntu_10_04_install.png

[![Ubuntu 10.04 ログイン画面][4]][5]

 [4]: /images/2010_0530_ubuntu_10_04_login_s.jpg
 [5]: /images/2010_0530_ubuntu_10_04_login.png

### VMware Tools

簡易インストール時に勝手にダウンロード＆インストールされました。

Playerの設定からWindows用などダウンロードが出来て、WMware Playerのインストールフォルダに *.iso で保存されていました。

### vmnetcfg.exe

<pre>VMware-player-3.1.0-261024.exe /e hoge
</pre>

でhoge/network.cabの中にvmnetcfg.exeがある様だけどエラーが出て動かなかった。

プロシージャ エントリ ポイント ??4string@utf@@QAEAAV01@ABV01@@Z がダイナミック リンク ライブラリ vmwarestring.dll から見つかりませんでした。

[![vmnetcfg.exe実行エラー][6]][7]

 [6]: /images/2010_0530_vmnetcfg_error_s.jpg
 [7]: /images/2010_0530_vmnetcfg_error.png

### 相変わらず、OpenOffice.orgは要らないので消しました

### rootのパスワードの設定

<pre>sudo passwd root
</pre>

### 起動オプションの編集

<pre>sudo vi /etc/default/grub<br />sudo update-grub
</pre>

### ゲストOSでの時刻同期・クロックの進み

相変わらずゲストOSでクロックの進みが速い。

起動オプションを

GRUB\_CMDLINE\_LINUX="noreplace-paravirt nosmp noapic nolapic clocksource=pit"

とか

GRUB\_CMDLINE\_LINUX="noreplace-paravirt nosmp noapic nolapic clock=pit"

とかに変更しても変わらず。

Player起動時に、

[![WMware Player 通知メッセージ][8]][9]

 [8]: /images/2010_0530_vmware_player_tsc_notify_s.jpg
 [9]: /images/2010_0530_vmware_player_tsc_notify.png

こんなのが表示されたので恐らくクロックの進みが速いのと関係あると思うけど、まだ調査できていない。

### 参考

[Ubuntu日本語フォーラム / 上手に起動できません。][10]

 [10]: https://forums.ubuntulinux.jp/viewtopic.php?pid=55804#p55804

[ディストーションが栄養剤　ぺんぺねっと管理人blog | Ubuntu 10.04 の root password パスワード設定方法は？][11]

 [11]: http://blog.penpe.net/?eid=1046016

[vmnetcfg.exeのありか - 明日の備忘録（六ちゃんが綴るメモ）][12]

 [12]: http://blog.mutsuyoshi.net/index.php?itemid=869