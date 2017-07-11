---
title: "じゅげむったーの開発日記 その３"
date: 2017-06-17 22:57
update: 2017-07-11 23:43
tags: [Qt, Twitter, OAuth, C++, cpp, 勉強会, 開発日記, じゅげむったー]
categories: [ブログ]

---

さて、先月に引き続いて今月も参加した [Qt 勉強会 @ Nagoya No9(17.06) - connpass](https://qt-users.connpass.com/event/58337/) のまとめ。

つぶやきは [Qt勉強会 Tokyo #48 + @Nagoya #9 つぶやきまとめ](https://togetter.com/li/1127556) でまとめられています。

今回も長文投稿専用Twitterクライアントの開発の続きをしました。
そろそろ終わらせたいです...

レポジトリは ... [sharkpp/Jugemutter: 長文投稿専用クライアント「じゅげむったー」](https://github.com/sharkpp/Jugemutter) です。

![画面](/images/2017_0617_jugemutter1.png)

## 進捗

とりあえず、作ってた設定画面ができて、設定した内容も保存できたぞ！

![設定画面](/images/2017_0617_jugemutter1.png)

投稿画面の本文前後のテキストも表示できるようになったし、

![投稿画面](/images/2017_0617_jugemutter2.png)

インストーラ作るの？って聞かれた。
たしかに、配布どうするか、って問題はある。

[インストーラを作ろう！](https://booth.pm/ja/items/122098) を持ってたはずなので、それを参考にやってみようかとは思ってる。

## その他メモ

### データバインディングについて

データバインディングは QML の方が Widget より素直？直感的？で実装が楽、らしい。

QML は、かなり昔( [sharkpp/TaskMemGraph: sample of QtQuick2 application](https://github.com/sharkpp/TaskMemGraph) )に触ってそれっきりなので、また色々覚えないとダメかもしれないけど、 Android とか iOS のアプリ作るなら Widget よりも最近は QML っぽいので、またやってみようと思う。

そういえば、 [TaskMemGraph](https://github.com/sharkpp/TaskMemGraph) っていまビルド通るのだろうか？

### ディレクトリ構成

ファイル数増えて困る、って問題。

何かキッチリ答えがあるわけでもないけど、

* 機能ごと
* モジュールごと

みたいな感じで良いのでは、とアドバイス。

### Qt 本体について

Qt 5.9 は、ある人曰く、アップデートしても大丈夫なバージョンな気がする、とのこと。

LTS(=Long Term Support)版だけあって、最初から安定しているのかも。

### QtCretor について

QtCretor 4.3.0 はどうも動作が怪しい部分があるらしい（自分はまだ 4.2.1 なので、あくまでらしい）。

前のバージョン、 4.2.1 では大丈夫だけど、ある機能のメニューをクリックしても反応しなかったり、クラスを追加しても、プロジェクトビューに追加されなかったり（再起動すると追加されている）、など。

Qt 5.9 に付属の QtCretor 4.3.1 は大丈夫かも？と言う話。
なお QtCretor 4.3.1 はこの記事を書いている時点では、単体でのダウンロードはできないようです。

## 参考

* [Qt - Download Open Source Step 3](https://www.qt.io/download-open-source/#section-9)
