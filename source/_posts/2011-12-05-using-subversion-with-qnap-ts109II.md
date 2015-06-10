---
title: "QNAP TS-109II で Subversionを使う"
date: 2011-12-05 00:23:00
tags: [Subversion, QNAP, NAS, Linux, Apache]
categories: [ブログ]

---

久しぶりに、NAS(QNAP TS-109II)の環境を作り直したのでメモ。

元々はsubversionを入れたいがためにdebianを入れていたけど、どうもそんな小難しいことをしなくてもSubversionを動かせるって情報を見つけたので今の環境を破棄してまで試してみる。

結論から言うとバックアップやら何やらで時間はかかったけど問題なく動きそう。

  * [Subversion over HTTP][1]
  * [Subversion - QNAPedia][2]
  * [QNAP TS-439 Pro II+ Turbo NASにSubversionを構築 - sugarballの日記][3]

 [1]: http://forum.qnap.com/viewtopic.php?f=32&t=1779
 [2]: http://wiki.qnap.com/wiki/Subversion
 [3]: http://d.hatena.ne.jp/sugarball/20111029/1319896597

あたりを参考に、NAS(QNAP TS-109II)に、Apache+Subversionの環境を作ってみた

### Optware IPKGをインストール

ApacheやSubversionをインストールするのに必要なIPKGを追加。

[Install Optware IPKG - QNAPedia][4]を参考にインストール。

 [4]: http://wiki.qnap.com/wiki/Install_Optware_IPKG

  1. QNAPの管理画面を開く
  2. 「ホーム」→「アプリケーション」→「QPKGプラグイン」を開く
  3. 「QPKGの取得」を押下し、「Optware IPKG (Itsy Package Management System)」をダウンロード＆解凍
  4. 解凍した、"Optware_?.qpkg" を、「インストール」タブからインストール
  5. 「QPKGインストール済み」タブから、「Optware IPKG」を選び、「有効にする」を押下し有効にする

有効にした直後のみipkgコマンドへパスが通るが、リブート以降パスが通らなくなるので

<pre>export PATH=$PATH:/opt/bin:/opt/sbin
</pre>

としておく

### Apache2をインストール

ipkg install apache

すると↓のように mod\_ext\_filter.so が読み込めないとエラーが出る。

<pre>httpd: Syntax error on line 74 of /opt/etc/apache2/httpd.conf: Cannot load /opt/libexec/mod_ext_filter.so into server: /opt/libexec/mod_ext_filter.so: undefined symbol: apr_procattr_limit_set<br />httpd: Syntax error on line 74 of /opt/etc/apache2/httpd.conf: Cannot load /opt/libexec/mod_ext_filter.so into server: /opt/libexec/mod_ext_filter.so: undefined symbol: apr_procattr_limit_set
</pre>

[mod\_ext\_filter.so: undefined symbol: apr\_procattr\_limit_set][5] を参考に設定を変更。

 [5]: http://forum.synology.com/enu/viewtopic.php?f=34&t=40959

参考ページでも結局モジュールを読まないように変えるしかないようだ。

<pre>vi /opt/etc/apache2/httpd.conf
</pre>

で設定ファイルから libexec/mod\_ext\_filter.so を探しコメントアウト。

<pre>httpd: bad user name nobody
</pre>

と言われるのでユーザーを追加。

  1. QNAPの管理画面を開く
  2. 「ホーム」→「アクセス権管理」→「ユーザー」を開く
  3. 「ユーザーの追加」を押下

  * ユーザ名:nobody
  * 容量制限の設定：無効にする
  * グループ：administrators, everyone
  * 読み込みのみ：\---
  * 読み取り／書き込み：Public, Qdownload, Qmultimedia ...
  * アクセス拒否：\---

で追加

<pre>httpd: Could not reliably determine the server's fully qualified domain name, using ? for ServerName
</pre>

と言われるので設定を書き換え。

<pre>ServerName nasserver:888
</pre>

とかこんな感じ

もちろん例の場合、

<pre>Listen 888
</pre>

としておかないといけない

やることとしては、

  * mod\_ext\_filter.so の設定を、httpd.conf からコメントアウト
  * ServerName(変更するならListenも)の設定を、httpd.conf に指定
  * QNAP管理画面から、nobodyユーザーを追加。

<pre>/opt/sbin/httpd -k start
</pre>

で起動して http://nasserver:888/ などにブラウザでアクセスし、

It works!

と表示されたらOK

### Subversionをインストール

<pre>ipkg install svn
</pre>

httpd.conf に↓を追加

<pre>Include etc/apache2/conf.d/*.conf
</pre>

レポジトリは、

<pre>/share/HDA_DATA/svn
</pre> に設置

認証用のファイルは、

<pre>/share/HDA_DATA/Qweb/repos/
</pre> に置く

HDA_DATAの部分は、製品によって違うようだ

.authz や .htpasswd 

vi /opt/etc/apache2/conf.d/mod\_dav\_svn.conf に

<pre>&lt;IfModule dav_svn_module&gt;<br /> &lt;Location "/repos/"&gt;<br />  DAV svn<br />  SVNParentPath /share/HDA_DATA/svn<br />  SVNListParentPath on<br />  AuthzSVNAccessFile /share/HDA_DATA/Qweb/repos/.authz<br />  &lt;IfModule dav_svn_module&gt;<br />   AuthType Basic<br />   AuthName "Authentication"<br />   AuthUserFile /share/HDA_DATA/Qweb/repos/.htpasswd<br />   Require valid-user<br />  &lt;/IfModule&gt;<br /> &lt;/Location&gt;<br /> &lt;Directory /share/HDA_DATA/Qweb/repos&gt;<br />  AllowOverride All<br />  Options All<br />  &lt;Limit GET POST OPTIONS&gt;<br />   Order allow,deny<br />   Allow from all<br />  &lt;/Limit&gt;<br />  &lt;LimitExcept GET POST OPTIONS PROPFIND MKACTIVITY CHECKOUT MKACTIVITY DELETE PROPPATCH MKCOL MERGE REPORT PUT COPY&gt;<br />   Order deny,allow<br />   Deny from all<br />  &lt;/LimitExcept&gt;<br /> &lt;/Directory&gt;<br />&lt;/IfModule&gt;
</pre>

を追加。

<pre>mkdir /share/HDA_DATA/svn<br />cd /share/HDA_DATA/svn<br />svnadmin create test
</pre>

などしてレポジトリを作る

### Apacheの自動起動

[Running Your Own Application at Startup - QNAPedia][6]を参考に

 [6]: http://wiki.qnap.com/wiki/Autorun.sh

autorun.sh を編集

いちいちマウントするのが面倒なので、[Method 3][7] 方式で

 [7]: http://wiki.qnap.com/wiki/Autorun.sh#Method_3

/share/HDA_DATA/.qpkg/autorun/autorun.sh に

<pre>(sleep 10; /opt/sbin/httpd -k start ) &
</pre>

と追加
