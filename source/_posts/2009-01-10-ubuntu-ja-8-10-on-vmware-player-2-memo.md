---
title: "Ubuntu-ja-8.10をVMware Player 2で動かすときのメモ"
tags: [ubuntu, vmware-player, g++, cc1plus]
categories: [blog]

---

Ubuntu-ja-8.10 on VMware Player 2 で色々はまったのでメモ

### OpenOffice.orgは要らないので消しました

### Subversion

  * 入っていないので sudo apt-get install subversion でインストール
  * エラーが出たらアップデート・マネージャでアップデートしたらうまくいくかも

### 音を鳴らしたい場合は

<pre>sound.present = "TRUE"
sound.startConnected = "TRUE"
sound.virtualDev = "es1371"
sound.fileName = "-1"
sound.autodetect = "TRUE"
sound.pciSlotNumber = 18
</pre>

ここでのポイントはデバイスを"es1371"にすること

### ネットワークはNATモードにしました

<pre>ethernet0.connectionType = "nat"
</pre>

### BEEP音がうるさい場合は

<pre>mks.noBeep = "TRUE"を*.vmxに追加
</pre>

<http://www.networld.co.jp/vmware/tech/vid022.htm>

### ソースのコンパイル中にcannot exec \`cc1plus'とか言われたら

  * Synaoticパッケージ・マネージャーでg++をインストール
  * VMWare Tools
  * [VMware Server][1]のlinux版(tar)をダウンロード＆解凍しlinux.isoを探してマウント
  * インストールは
  * CDの中のVMwareTools-?.tar.gzを

<pre>/var/tmp/に解凍
cd vmware-tools-distrib
sudu ./vmware-install.pl
</pre>

で質問は取り敢えず全部EnterでOK

[Ubuntu日本語フォーラム / vmware toolのインストール方法:][2]

[VMware PlayerにDebian lennyをインストールしたメモ - www tools][3]

### その他

[時刻同期メモ][4]

 [1]: http://www.vmware.com/jp/products/server/
 [2]: http://forums.ubuntulinux.jp/viewtopic.php?pid=1913
 [3]: http://d.hatena.ne.jp/giant_penguin/20081124/1227485111
 [4]: http://d.hatena.ne.jp/prokion/20080312/1223800954