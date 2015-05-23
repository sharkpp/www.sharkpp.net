---
title: "Titanium Mobileのメモ(その１)"
date: 2012-09-30 23:05:00
tags: [Develop, Android, Titanium Mobile]
categories: [blog]

---

とある理由で急遽Androidのアプリを作る必要に迫られ前から興味があっTItanium Mobileに手を出した次第。

作る過程で調べたことを色々メモ。

  * Android/iOS で修正無しに移植できるわけじゃない模様、そんなのがやりたければPhoneGapを使えばいいよってことのようだ。
  * iOSで使えてAndroidで使えないUIの部品やその逆が結構ある
  * .jss (.jsの.css的なもの)は腐ってる
  * プロパティーに指定できる値とかはリファレンスを見よう [Appcelerator Titanium Mobile][1]
  * Ti.UI.createLabel() のオプションに em などを単位として使うとエラーになる、そしていきなり落ちる。
  * Ti.App.Properties.setInt() と Ti.UI.Android.openPreferences() はあわせて使えない、設定画面では文字列のみが扱える。で使うとエラーになりやっぱりいきなり落ちる。
  * Androidでは、Ti.UI.Button などの上に 別のオブジェクトを重ねられない。

 [1]: http://docs.appcelerator.com/titanium/2.1/index.html

などなど、とりあえずざっと覚えているのはこんな感じ。