---
title: "QNAP TS-109II への syslog-ng の導入メモ"
date: 2013-01-27 13:27:00
tags: [QNAP, Linux]
categories: [ブログ]

---

なんか今使ってるNASも古くなってきたけど、まだまだ現役です。

ってことで、ルーターのログを取るために QNAP TS-109II への syslog-ng の導入をしたときのメモです。

#### インストール

    # ipkg update
    # ipkg install syslog-ng
    

#### 設定の編集

    # vi /opt/etc/syslog-ng/syslog-ng.conf
    

とりあえず、必須の設定

下記の２行を削除して

    source src { pipe("/proc/kmsg");unix-stream("/dev/log"); internal(); };
    source net { udp(); };
    

設定を追加

    source src { file ("/proc/kmsg" log_prefix("kernel: ")); unix-stream ("/tmp/log"); internal(); };
    source net { udp(ip(0.0.0.0) port(514)); tcp(ip(0.0.0.0) port(514)); };
    

これをしないと、

    Error binding socket; addr='AF_UNIX(/dev/log)', error='Address already in use (98)'
    Error initializing source driver; source='src'
    

などと怒られる。

今回の目的、ルーターのログを保存するために、設定を追加。 これを設定してなくて、しばらく、ログが出てこないのはなぜだろうと悩んだのはここだけの秘密。

    destination router { file("/opt/var/log/router.log"); };
    filter f_router { match("APXXXXXXXXXXXX "); };
    log { source(net); filter(f_router); destination(router); };
    log { source(net); destination(messages); };
    

既存のsyslogの停止

    # /sbin/daemon_mgr qsyslogd stop /sbin/qsyslogd
    # /sbin/daemon_mgr syslogd stop /sbin/syslogd
    

syslog-ngの起動

    # syslog-ng start
    

#### スタートアップに登録

QPKGの設定に追加することで機能の有効無効がUIから操作でき、また、自動実行もされるようになる。

    # vi /etc/config/qpkg.conf
    

で下記内容を追加

    [syslog-ng]
    Name = syslog-ng
    Date = 2013-01-25
    Enable = TRUE
    Shell = /share/HDA_DATA/.scripts/syslog-ng_qpkg_start.sh
    Install_Path = /share/HDA_DATA/.qpkg/Optware/etc
    Author = me
    
    # vi /share/HDA_DATA/.scripts/syslog-ng_qpkg_start.sh
    

で下記内容を保存

    #!/bin/sh
    
    QPKG_NAME="syslog-ng"
    
    THIS_SCRIPT="[$(basename $0)]"
    LOG=echo
    OPT=/share/HDA_DATA/.qpkg/Optware
    LOG_FILE=${OPT}/var/log/scripts.log
    SLEEP=10
    
    $LOG $THIS_SCRIPT $(date "+[%Y-%m-%d %H:%M:%S]") $QPKG_NAME $1 | tee -a $LOG_FILE
    
    _exit() {
       $LOG $THIS_SCRIPT $(date "+[%Y-%m-%d %H:%M:%S]") "Error: " $* | tee -a $LOG_FILE
       exit 1
    }
    
    _log() {
       $LOG $THIS_SCRIPT $(date "+[%Y-%m-%d %H:%M:%S]") $* | tee -a $LOG_FILE
    }
    
    case "$1" in
       start)
       pidof syslog-ng && _exit "$QPKG_NAME already running. Exiting."
    
       pidof qsyslogd && _log "Found qsyslogd. Killing it." && /sbin/daemon_mgr qsyslogd stop /sbin/qsyslogd 
    
       pidof syslogd && _log "Found syslogd. Killing it." && /sbin/daemon_mgr syslogd stop /sbin/syslogd 
    
       _log "Starting $QPKG_NAME"
       /opt/sbin/syslog-ng start
       pidof $QPKG_NAME && _log "$QPKG_NAME up and running"
       ;;
    
       stop)
       killall syslog-ng
       ;;
    
       restart)
       $0 stop; $0 start
       ;;
    
       *)
       _exit "Unknown command $1. Usage: $0 {start|stop|restart}"
    esac
    exit 0
    

#### logrotateをインストール

    # ipkg update
    # ipkg install logrotate
    

#### logrotateの設定を編集

    # vi /opt/etc/logrotate.conf
    
    #rotate 5
    weekly
    missingok
    notifempty
    delaycompress
    compress
    
    /opt/var/log/*.log
    /opt/var/log/mail.*
    /opt/var/log/messages
    /opt/var/log/debug
    /opt/var/log/syslog {
       postrotate
           /share/HDA_DATA/.scripts/syslog-ng_qpkg_start.sh restart
       endscript
    }
    

#### 定期実行のためcrontabに登録

    # crontab -e
    

で下記のように編集し

    0 21 * * * /opt/sbin/logrotate /opt/etc/logrotate.conf
    

下記のコマンドで反映

    /etc/init.d/crond.sh restart
    

とりあえず、ログのローテートとはまだ未確認だけどルーターのログを保存できるようになったしよしとしよう。

### 参考

  * [QNAP NAS Community Forum ? View topic - [HOWTO] Syslog-ng- receive router logs][1]
  * [QNAP NAS Community Forum ? View topic - where to link optware auto-start][2]
  * [QNAP NAS Community Forum ? View topic - rsyslog][3]
  * [QNAPにsyslog-ng: とくさんブログ][4]
  * [syslog-ng.confの設定 : マロンくん.NET][5]
  * [＠IT：止められないUNIXサーバの管理対策 第9回][6]

 [1]: http://forum.qnap.com/viewtopic.php?f=121&t=17151
 [2]: http://forum.qnap.com/viewtopic.php?t=5379
 [3]: http://forum.qnap.com/viewtopic.php?t=11507
 [4]: http://tokusan-sk49.cocolog-nifty.com/blog/2010/05/qnapsyslog-ng-c.html
 [5]: http://www.marronkun.net/linux/other/syslogng_000047.html
 [6]: http://www.atmarkit.co.jp/fsecurity/rensai/unix_sec09/unix_sec01.html
