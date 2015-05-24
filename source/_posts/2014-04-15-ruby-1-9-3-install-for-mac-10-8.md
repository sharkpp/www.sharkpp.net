---
title: "Mac OS X 10.8 に Ruby 1.9.3 をインストールする方法"
date: 2014-04-15 16:18:00
tags: [雑記, Mac, 環境構築, Ruby]
categories: [ブログ]

---

`gem install chef` しようとしたら `mime-types requires Ruby version >= 1.9.2.` って怒られたので Ruby 1.9.3 を Mac にインストールしたときのメモです。

もしかしたら、 make や patch が無いと怒られるかもなので、 MacPorts などでインストールしておいてください。

## rvm のインストール

`RVM is the Ruby enVironment Manager` をインストールします。

    $ curl -L https://get.rvm.io | bash -s stable
    

一旦、ターミナルを閉じで開き直さないと PATH が設定されていないので怒られてしまうので注意です！

    $ rvm -v
    
    rvm 1.25.22 (stable) by Wayne E. Seguin <wayneeseguin@gmail.com>, Michal Papis <mpapis@gmail.com> [https://rvm.io/]
    

## Ruby 1.9.3 インストール

rvm コマンドで簡単にインストールできました。 実行すると必要なコマンドやライブラリを取得してインストールしてくれます。 もしかしたら、容量とかの関係で MacPorts で事前に入れておいた方が良いかもしれませんが、、、

    $ sudo rvm install 1.9.3
    

で、

    Searching for binary rubies, this might take some time.
    No binary rubies available for: osx/10.8/x86_64/ruby-1.9.3-p545.
    Continuing with compilation. Please read 'rvm help mount' to get more information on binary rubies.
    Checking requirements for osx.
    Installing requirements for osx.
    Updating system.....
    Installing required packages: autoconf, automake, libtool, pkgconfig, apple-gcc42, libyaml, libffi, libksba..
                   :
    Install of ruby-1.9.3-p545 - #complete 
    WARNING: Please be aware that you just installed a ruby that is no longer maintained (2014-02-23), for a list of maintained rubies visit:
    
        http://bugs.ruby-lang.org/projects/ruby/wiki/ReleaseEngineering
    
    Please consider upgrading to ruby-2.1.1 which will have all of the latest security patches.
    Ruby was built without documentation, to build it run: rvm docs generate-ri
    

無事インストールできたみたいです。 が、 2.1.1 が最新なのでそっちを使えってメッセージが表示されました、、、見なかったことに、、、。

## 使用するRubyを選択

早速、バージョンを確認してみましょう。

    $ ruby -v
    ruby 1.8.7 (2012-02-08 patchlevel 358) [universal-darwin12.0]
    

、、、あれ？古いままです。 そうでした、デフォルトで使われるバージョンを変更していませんでした。

    $ rvm --default use 1.9.3
    

これで、もう一度、

    $ ruby -v
    ruby 1.9.3p545 (2014-02-24 revision 45159) [x86_64-darwin12.5.0]
    

はい、これで新しいバージョンが使えるようになりました。

## 参考

  * [How to Install Ruby 1.9.3 for Mac OSX 10.8+ with MacPorts and RVM][1]
  * [Ruby on Mac OSX via Mac Ports - Stack Overflow][2]

 [1]: http://www.curvve.com/blog/guides/2013/install-ruby-1-9-3-mac-osx-10-8-macports-rvm/
 [2]: http://stackoverflow.com/questions/3464285/ruby-on-mac-osx-via-mac-ports
