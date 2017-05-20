---
title: "じゅげむったーの開発日記 その２"
date: 2017-05-20 17:04
tags: [Qt, Twitter, OAuth, C++, cpp, 勉強会, 開発日記, じゅげむったー]
categories: [ブログ]

---

さて、先月に引き続いて今月も参加した [Qt 勉強会 @ Nagoya No8(17.05) - connpass](https://qt-users.connpass.com/event/57080/) のまとめ。

{#
つぶやきは [Qt勉強会 Tokyo #46 + Nagoya # 7 つぶやきまとめ - Togetterまとめ](https://togetter.com/li/1101299) でまとめられています。
#}

今月も、長文投稿専用Twitterクライアントの開発の続きをしました。

レポジトリは ... [sharkpp/Jugemutter: 長文投稿専用クライアント「じゅげむったー」](https://github.com/sharkpp/Jugemutter) です。

## はじめに

今日は、会場にほぼ時間ぴったりで到着(どうやら参加者中、最後だった模様)。

反時計回りで、本日のやることを宣言。

自分は、「じゅげむったー」の続き。

## やったこと

アカウント周りの管理処理の実装を組んだ。

とりあえず、アカウントの管理がUIが主だったのを別のクラスで管理するようにして、それの変更でUIが変わるように変更をした。

いつのまにか、投稿ができなくなってたので、ソースを追ったら、今表示しているビューに対してドキュメントが設定されてなかった様子。

なので、ビューにドキュメントを設定する処理を実装するが、完了にはもう少し時間が足らなかった。

暗号化処理、Qt標準でないのでどうしたものか？
[roop/qblowfish](https://github.com/roop/qblowfish) とか [xcoder123/QBlowfish](https://github.com/xcoder123/QBlowfish) とか使おうかな？
でも、[Twofish](https://ja.wikipedia.org/wiki/Twofish) よりも設計年代が古いので Twofish のラッパーを作ったほうがいいのかも？

## 参考
* [roop/qblowfish: An implementation of the Blowfish encryption algorithm in Qt.](https://github.com/roop/qblowfish)
* [xcoder123/QBlowfish: Simple blowfish encryption implementation in Qt with QByteArray support](https://github.com/xcoder123/QBlowfish)
* [Twofish - Wikipedia](https://ja.wikipedia.org/wiki/Twofish)
