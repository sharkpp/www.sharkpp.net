---
title: "QNAP TS-109? と GALAXY S(SC-02B) をOpenVPNで繋ぐ"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---

NAS(QNAP TS-109II)をゴニョゴニョやりながらなんとかOpenVPN使って、3G/WiFi経由でGALAXY S(SC-02B)と通信できたのでメモ。



  


  * [QNAPへのインターネット経由でのOpenVPNアクセス][1]
  * [Install OpenVPN on QNAP ? NAS Wiki][2]
  * [ViaPress inc. ? SC-02B OpenVPN for Android][3]
  * [beautiful-moon.net ? Blog Archive ? Xperia(Android)からOpenVPN接続][4]

 [1]: http://blog.circlea4.net/?p=406
 [2]: http://wiki.nas-portal.org/index.php/Install_OpenVPN_on_QNAP
 [3]: http://photo.viasv.com/?p=3269
 [4]: http://beautiful-moon.net/2011-03-05_android-xperia-openvpn/

あたりを参考にした。

いずれも自己責任でお願いします。

特にAndroid側はroot化が必要なので高級文鎮にならないように注意が必要です。



  


最終的に

  * QNAP TS-109?側の設定
  * GALAXY S(SC-02B)側の設定
  * LAN内部のクライアントと通信する

と、順にGALAXY S⇔QNAP⇔WindowsPCまで通信できるようになりました。







 

  


### QNAP TS-109?側の設定

Optware ipkg は、[QNAP TS-109? で Subversionを使う][5] で色々やったのでそちらを参考にしてください。

 [5]: /blog/2011/12/05/using-subversion-with-qnap-ts109II.html

#### OpenVPNをインストール

<pre># ipkg install openvpn
</pre>

<pre># openvpn
</pre>

で動けばとりあえずOK

#### ログディレクトリやtunモジュール用のディレクトリを生成

<pre># cd /opt/etc/openvpn
---
title: "mkdir log"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
---
title: "cd log"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
---
title: "touch openvpn.log"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
---
title: "touch status.log"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
---
title: "mkdir /opt/etc/openvpn/modules"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
</pre>

[Install the missing tun.ko module][6]から適切なtunモジュールをダウンロードし

 [6]: http://wiki.nas-portal.org/index.php/Install_OpenVPN_on_QNAP#Install_the_missing_tun.ko_module

<pre>/opt/etc/openvpn/modules
</pre>

に配置

起動時に、

<pre># install tun.ko
mkdir /dev/net;
mknod /dev/net/tun c 10 200;
(sleep 10; insmod /opt/etc/openvpn/modules/tun.ko)&
easy.confの内容
---
title: "exec openvpn"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
(sleep 10; /opt/sbin/openvpn /opt/etc/openvpn/easy.conf)&
</pre>

が実行されるように、autorun.shなどに書き加える

easy.confの内容

<pre># OpenVPN server configuration QNAP NAS
---
title: "basic settings"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
port 1194
proto udp
dev tun
#
---
title: "detect mtu if the connection is slow."
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
; mtu-test
#
---
title: "define mtu, if necessary"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
; tun-mtu xyz
#
---
title: "define the ip-addresses of the underlying tunnel"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
server 10.8.0.0 255.255.255.0
#
---
title: "Route"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
push "route 192.168.1.0 255.255.255.0"   #  &lt;--- LANのIPアドレスを指定
#
---
title: "certificates & keys"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
dh   /opt/etc/openvpn/keys/dh1024.pem
ca   /opt/etc/openvpn/keys/ca.crt
cert /opt/etc/openvpn/keys/server.crt
key  /opt/etc/openvpn/keys/server.key
#
---
title: "data compression"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
comp-lzo
#
---
title: "allow, that several clients with the same common name log on"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
; duplicate-cn
#
---
title: "different clients can "see" each other through the tunnel."
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
; client-to-client
#
---
title: "Keepalive"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
keepalive 15 120
#
---
title: "verbosity of status messages in the console. Activate for debugging (1-9 possible)"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
; verb 5
#
---
title: "Log files"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
status /share/HDA_DATA/system/log/openvpn-status.log
log-append /share/HDA_DATA/system/log/openvpn.log
#
---
title: "Run as daemon (activate, after everything is set up properly)"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
; daemon
#
---
title: "Management Interface. Access with "telnet localhost 7505""
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
management localhost 7505
</pre>



  


### GALAXY S(SC-02B)側の設定

#### Android Marketから必要なアプリをインストール

[BusyBox][7]、[OpenVPN Installer][8]、[OpenVPN Settings][9]をインストール

 [7]: https://market.android.com/details?id=stericson.busybox&hl=ja
 [8]: https://market.android.com/details?id=de.schaeuffelhut.android.openvpn.installer&hl=ja
 [9]: https://market.android.com/details?id=de.schaeuffelhut.android.openvpn&hl=ja

あと、ターミナルソフト([ConnectBot][10]/[Android Terminal Emulator][11]など) or adbでも出来るかも？ も必要

 [10]: https://market.android.com/details?id=org.connectbot
 [11]: https://market.android.com/details?id=jackpal.androidterm

OpenVPN関連のインストール先は、

<pre>/system/xbin/
</pre>

ifconfig/route関連のインストール先は、

<pre>/system/xbin/bb/
</pre>

にしました。

#### ifconfig/routeの配置

<pre>su
---
title: "mount -o remount,rw /dev/block/stl9 /system"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
---
title: "mkdir /system/xbin/bb"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
---
title: "ln -s /system/xbin/busybox /system/xbin/bb/ifconfig"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
---
title: "ln -s /system/xbin/busybox /system/xbin/bb/route"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
</pre>

で一旦、GALAXY Sを再起動

/sdcard/openvpn/galaxys/

にGALAXY S用のtunドライバ(tun-I9000-JPK.zip)を配置

※[HOWTO tun.ko to run OpenVPN on Froyo xxJPK Galaxy S I9000 - xda-developers][12]からダウンロード

 [12]: http://forum.xda-developers.com/showthread.php?t=793712

OpenVPN Settingsを起動して、Advancedを開き、

  1. 「Load tun kernel module」にチェック
  2. 「TUN module settings」
  3. 　「Load modules usings」→ insmod を選択
  4. 　「Path to tun module」→ /sdcard/openvpn/galaxys/tun.ko と指定

[Key-generation][13]の手順で認証キーなどを作る

 [13]: http://wiki.nas-portal.org/index.php/Install_OpenVPN_on_QNAP#Key-generation

それぞれ、必要なファイルを指定したパス(/sdcard/openvpn/ca/)にアップ

vpn.confを配置

<pre>/sdcard/openvpn/vpn.conf
</pre>

に配置

vpn.confの内容

<pre># connect to QNAP OpenVPN Server
script-security 2
proto udp
dev tun
tls-client
remote vpn.example.net 1194  #  &lt;--- enter your dyndns-account here!
pull
---
title: "set mtu, if necessary"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
tun-mtu 1500
#
resolv-retry infinite
nobind
persist-key
persist-tun
---
title: "certificates and keys"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
---
title: "Note the double \\ in the path for a windows config"
date: 2011-12-10 16:15:00
tags: [雑記, Android, QNAP, Galaxy S]
categories: [ブログ]

---
ca   /sdcard/openvpn/ca/ca.crt
cert /sdcard/openvpn/ca/key.crt
key  /sdcard/openvpn/ca/key.key
#
comp-lzo
#status /sdcard/openvpn/status.log
#log-append /sdcard/openvpn/log.log
</pre>

設定の内容はサーバー側の設定と合わせないとうまく繋がりません。

ログを出力するようにしておくと原因の究明に役立つでしょう。

3Gだと実装で20kbpsも出ませんでしたのでまあやれることは限られていますがVPNで繋がるようになりました。



  


### LAN内部のクライアントと通信する

[OpenVPN Extras ? NAS Wiki][14]を参考

 [14]: http://wiki.nas-portal.org/index.php/OpenVPN_Extras

#### QNAP側(VPNサーバー)でipv4の転送を有効にする

下記コマンドを 起動時に実行されるようにしておく

<pre>echo "1" &gt; /proc/sys/net/ipv4/ip_forward
</pre>

#### Windows PCのファイル共有を見る

まず、クライアント側で

<pre>C:\&gt; route -p add 10.8.0.0 MASK 255.255.255.0 QNAPのアドレス
</pre>

としてパケットを送り返すことが出来るようにしておく。

ちなみに、-p を指定しておくとPCを再起動しても設定した内容を覚えておいてくれます。



  


<pre>C:\&gt; route add ほげほげ
エラー: ネットワーク データベース ファイル ﾀﾉE を開けません
エラー: ネットワーク データベース ファイル ﾀﾉE を開けません
</pre>

見たいに、エラーが出る場合は、自己の責任においてレジストリの

HKLM\SYSTEM\CurrentControlSet\Services\Tcpip\Parameters\DataBasePath

を、REG\_SZからREG\_EXPANG_SZに変えてみてください。

まえ、boost::asioでサンプルがうまく動かなかったのはこれが原因かもと今更気が付いた。



  


ここで、Windows PC⇔Galaxy S でpingの疎通確認をしておく

※Windows PC側は、pingの応答を返さないようになっていることが良くあるので設定を変更しておくこと

※ICMPの「エコー要求の着信を許可する」をONにしておくこと



  


問題なければ、ファイヤーウォールでファイル共有がローカルエリア外から接続できるかを確認

Windowsファイヤーウォールの場合

  1. 「例外」
  2. 「ファイルとプリンタの共有」
  3. 「スコープの変更」
  4. 「ユーザーのネットワークのみ」になっていたら「カスタム一覧」にして「10.8.0.0/255.255.255.0,192.168.1.0/255.255.255.0」などに変更

で、接続できると思います。

出来なかったら、Wiresharkで確認するのがイイです。
