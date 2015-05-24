---
title: "はじめてのChef"
date: 2014-04-18 23:15:00
tags: [Chef]
categories: [ブログ]

---

## 目標

母艦であるところの Mac から、VirtualBox で構築した VM や VPS に対して環境を構築したい。 が、最初は、 [Chef][1] で遊んでみることに。

 [1]: http://www.getchef.com/

## 準備

とりあえず、 VirtualBox で VM を立ち上げて確認してみる。

母艦であるところの Mac 側で、 Chef と knife-solo と berkshelf をインストールします。

VM 側は、後で Mac 側からインストールするので特に何もインストールする必要はないですが、SSHの設定はやっておくのが吉っぽいです。

まず始めに、

    $ gem install chef
    

したら

    You don't have write permissions into the /Library/Ruby/Gems/1.8 directory.
    

ってしばらくして怒られたので、権限を与えて実行

    $ sudo gem install chef
    

で、やっぱりしばらくしたら、

    ERROR:  Error installing chef:
    mime-types requires Ruby version >= 1.9.2.
    

って Ruby の新しいバージョンが必要だよって怒られた(´・ω・｀)

確認したら、

    $ ruby -v
    ruby 1.8.7 (2012-02-08 patchlevel 358) [universal-darwin12.0]
    

確かに古いね。

ってことで、新しいバージョンを[インストール][2]。

 [2]: /blog/2014/04/15/ruby-1-9-3-install-for-mac-10-8.html

    $ ruby -v
    ruby 1.9.3p545 (2014-02-24 revision 45159) [x86_64-darwin12.5.0]
    

で、

    $ sudo gem install chef --no-ri --no-rdoc
    Fetching: mixlib-config-2.1.0.gem (100%)
                       :
    25 gems installed
    

今度は大丈夫。

    $ chef-client -v
    Chef: 11.12.2
    

次に、 knife-solo をインストール

    $ sudo gem install knife-solo --no-ri --no-rdoc
                   :
    Successfully installed knife-solo-0.4.1
    1 gem installed
    

で、こっちはすんなりインストール

続いて、 Berkshelf をインストール

    $ sudo gem install berkshelf --no-ri --no-rdoc
    

## knife configure

    $ knife configure
    WARNING: No knife configuration file found
    Where should I put the config file? [/Users/***/.chef/knife.rb] 
    ERROR: Ohai::Exceptions::DependencyNotFound: Can not find a plugin for dependency os
    

「[Chef 11.12.2のknife configureが失敗する - Qiita][3]」によると、バグッてるので古いバージョンを使えってことのよう(´・ω・｀)

 [3]: http://qiita.com/sakatuba@github/items/1548818b02735b2047ad

とりあえず、エラー表示でググるのって大事だよねってことで。

    $ sudo gem uninstall chef ; sudo gem install chef --no-ri --no-rdoc -v 11.10.0
    

で、古いバージョンをインストール。

    $ chef-client -v
    Chef: 11.10.0
    

気を取り直して、

    $ knife configure
    WARNING: No knife configuration file found
    Where should I put the config file? [/Users/***/.chef/knife.rb] 
    Please enter the chef server URL: [https://****:443] 
                        :
    Configuration file written to /Users/***/.chef/knife.rb
    $
    

今度はうまく行きました。

## レポジトリの作成

chef-repo って名前でレポジトリを作成します。

    $ knife solo init chef-repo
    Creating kitchen...
    Creating knife.rb in kitchen...
    Creating cupboards...
    Setting up Berkshelf...
    $ cd chef-repo
    

この時、 Berkshelf がインストール済みだと、一緒に Berksfile ファイルも作ってくれます。 とりあえず、 nginx を Berkshelf を使いインストールしてみます。

    $ echo cookbook 'yum'>>Berkshelf
    $ echo cookbook 'nginx'>>Berkshelf
    $ berks install
    

で、VM 側に Chef をインストール。

    $ knife solo prepare root@192.168.56.102
    

SSH鍵を使う場合は

    $ knife solo prepare -i path/to/key_file root@192.168.56.102
    

ってするようです。

「[Chef Soloの正しい始め方 | tsuchikazu blog][4]」に書いてあるように、

 [4]: http://tsuchikazu.net/chef_solo_start/

    {"run_list":[
      "yum::epel", 
      "nginx"
    ]}
    

として、

    $ knife solo cook root@192.168.56.102
    

実行すると、

    could not find recipe epel for cookbook yum
    

ってエラーが出るので、

    {"run_list":[
      "yum", 
      "nginx"
    ]}
    

と、書き換えて、

    $ knife cookbook create base -o site-cookbooks/
    $ open -e site-cookbooks/base/recipesdefault.rb
    

として、「[サードパーティ製chefレシピ使ってたの忘れてた - わすれっぽいきみえ][5]」を参考に追加。

 [5]: http://kimikimi714.hatenablog.com/entry/2014/01/13/%E3%82%B5%E3%83%BC%E3%83%89%E3%83%91%E3%83%BC%E3%83%86%E3%82%A3%E8%A3%BDchef%E3%83%AC%E3%82%B7%E3%83%94%E4%BD%BF%E3%81%A3%E3%81%A6%E3%81%9F%E3%81%AE%E5%BF%98%E3%82%8C%E3%81%A6%E3%81%9F

    # add the EPEL repo
    yum_repository 'epel' do
      description 'Extra Packages for Enterprise Linux'
      mirrorlist 'http://mirrors.fedoraproject.org/mirrorlist?repo=epel-6&arch=$basearch'
      fastestmirror_enabled true
      gpgkey 'http://dl.fedoraproject.org/pub/epel/RPM-GPG-KEY-EPEL-6'
      action :create
    end
    
    # add the Remi repo
    yum_repository 'remi' do
      description 'Les RPM de Remi - Repository'
      baseurl 'http://rpms.famillecollet.com/enterprise/6/remi/x86_64/'
      gpgkey 'http://rpms.famillecollet.com/RPM-GPG-KEY-remi'
      fastestmirror_enabled true
      action :create
    end
    

で、

    $ knife solo cook root@192.168.56.102
    

を実行し、しばらくすると、完了します。

ブラウザでアクセスすると、、、、見えませんでした。 少し考えて、 VM 側に SSH で入り

    # netstat -apn|grep "LISTEN "
    tcp        0      0 0.0.0.0:80                  0.0.0.0:*                   LISTEN      2124/nginx          
    tcp        0      0 0.0.0.0:22                  0.0.0.0:*                   LISTEN      987/sshd            
    tcp        0      0 127.0.0.1:25                0.0.0.0:*                   LISTEN      1063/master         
    tcp        0      0 :::22                       :::*                        LISTEN      987/sshd            
    tcp        0      0 ::1:25                      :::*                        LISTEN      1063/master         
    

確認したところ、LISTENは出来てる所が確認できたところで、FWでブロックされていることに気が付きました。

ってところで、以下次回？

## 参考

  * [特集 DevOps時代の必須知識：インフラストラクチャ自動化フレームワーク「Chef」の基本 (1/2) - ＠IT][6]
  * [Install Chef 11.x on a Workstation ? Chef Docs][7]
  * [http://qiita.com/takeshi\_ok\_desu/items/936ee44b712c37d25a0e][8]
  * [Chef Soloの正しい始め方 | tsuchikazu blog][4]
  * [Chef 11.12.2のknife configureが失敗する - Qiita][3]
  * [サードパーティ製chefレシピ使ってたの忘れてた - わすれっぽいきみえ][5]

 [6]: http://www.atmarkit.co.jp/ait/articles/1305/24/news003.html
 [7]: http://docs.opscode.com/install_workstation.html#run-the-omnibus-installer
 [8]: http://qiita.com/takeshi_ok_desu/items/936ee44b712c37d25a0e
