---
title: "じゅげむったーの開発日記 その７"
date: 2017-10-04 01:05
tags: [Qt, Twitter, OAuth, C++, cpp, 勉強会, 開発日記, じゅげむったー, 凍結]
categories: [ブログ]

---

前回に引き続き [Qt 勉強会 @ Nagoya No13 一区切り会 - connpass](https://qt-users.connpass.com/event/67390/) に参加しました。
とりあえず、今回でもくもく会は一旦一区切りとなるので、このあとはボチボチと進めていこうかなと思います。

レポジトリは ... [sharkpp/Jugemutter: 長文投稿専用クライアント「じゅげむったー」](https://github.com/sharkpp/Jugemutter) となります。

画面は、多言語対応をしたので載っけます。

![日本語版](/images/2017_0930_jugemutter_jp.png)

次はなんちゃっての英語版です。

![英語版](/images/2017_0930_jugemutter_en.png)

## Twitter API で "Could not authenticate you." が出る

Twitter API への要求で `Could not authenticate you.` とレスポンスが返ってくる件、HMACとかの計算を手動でやって検証しようかと考えたけど、そうだその前に、Qtのバグトラッカーで登録ないか、と、探して見たら...

[[QTBUG-61125] QOAuth1 creates an invalid signature for percent encoded query - Qt Bug Tracker](https://bugreports.qt.io/browse/QTBUG-61125)

まさに、ドンピシャなものが、４ヶ月も前の 5/31 に報告が上がっていました。

それでもって、修正完了の 5.9.2 でリリースらしい。

[Qt 5.9 Release - Qt Wiki](https://wiki.qt.io/Qt_5.9_Release) によると、この記事を書いている時点では `September 2017` に公開予定らしいので、もう少し待つ必要があるみたい。

まあ、今回の教訓は先にバグトラッカーを探すべきだったのかなぁと、言うこと。

## 【悲報】じゅげむったー用Twitterアカウントが凍結されてた件【いつのまに】

とりあえず、APIの要求は、Qtのバグが原因で特定文字で必ずエラーが返ってくるらしいので、とりあえず諦めて他のことを進めることにしました。

で、何をやろうかと考えたところで、せっかくマルチアカウント管理を実装したので試してみようと久しぶりにサブ垢（公式垢として利用しようと登録したもの）へログインしたところ...

![凍結済みアカウント(再現)](/images/2017_0930_twitter_frozen_acctount.png)

ん？ んん？ は？ と、凍結！？ 
※ スクショは撮り忘れたので当時の状況を可能な限り再現しています

と、言うわけで、何時のまにか今流行り（？）の凍結祭りに参加していたようです。
とりあえず、慌てて解除方法をググり、凍結の解除申請をしました。

そして、30分後...

![凍結解除](/images/2017_0930_twitter_thawed_account.png)

ほっ。

ヘッダー画像やプロフィール画像、あとは本垢への相互フォロー、そして鍵垢と、諸々設定しました。

## 多言語対応

Qt で .ts / .qm でのラベルなどの多言語対応、昔々もやった記憶があるけど、忘却の彼方に近いので、改めて調べた。

### 言語ファイルの指定

 `.pro` を開き、言語ファイルのパスを設定。パスは適時読み替えてください。
 複数言語ある場合は、、スペース区切りで後ろに追加します。

```ini
     :
TRANSLATIONS = src/i18n/ja_JP.ts
     :
```

### 翻訳ファイルの読み込み

起動時に現在のロケールを元に言語ファイルを読み込む処理を実装します。

`.qm` ファイルはアプリケーションのリソースとして埋め込み、そこから読むようにしています。

```cpp
            :
    // 翻訳
    QString locale = QLocale::system().name();
    QTranslator translator;
    translator.load(locale, ":/i18n");
    a.installTranslator(&translator);
            :
```

`locale` の値は、日本語環境だったら `ja_JP` です。

リソースへの登録はこんな感じ

![qmファイルのqrcへの登録](/images/2017_0930_qm_in_qrc.png)

### 翻訳対象の指定

まずは、翻訳したいものを [`tr(...)`](http://doc.qt.io/qt-5/qobject.html#tr) で囲います。

```diff
     if (tweetQueue.isEmpty()) {
          finishPost();
 -        QMessageBox::information(this, qAppName(), "投稿を完了しました。");
 +        QMessageBox::information(this, qAppName(), tr("Your post has been completed."));
          return;
      }
```

こんな感じ。

### 翻訳対象の抽出

QtCreator のメニューから「ツール」→「外部」と辿り「翻訳を更新(lupdate)」を実行します。

![翻訳を更新](/images/2017_0930_qtcreator_extrnal_tools_linguist.png)

すると、 先ほど、`tr(...)` で囲った部分や `.ui` ファイルから翻訳対象が抽出されファイルへ書き出されます。
ソース側の記述が変わった時は、同じように「翻訳を更新(lupdate)」を実行すると、変更が適用されます。

### 翻訳

Linguist を起動し

![Linguist](/images/2017_0930_linguist.png)

抽出された文字列を翻訳していきます。

### Qt message file format をビルド

`.ts` を `.qm` (Qt message file format)へと変換します。
GNU gettext の `.po` と `.mo` との関係と同じですね。

QtCreator のメニューから「ツール」→「外部」と辿り「翻訳をリリース(lrelease)」を実行します。
これで `.ts` から `.qm` へと変換します。

### 起動確認

実際に翻訳できているかどうかは、ロケールを切り替えると確認できます。

普通に起動すると……

![日本語版](/images/2017_0930_jugemutter_jp.png)

こう。

言語を英語にすると……

```console
# LANG=en_US.UTF-8 open ./Jugemutter.app
```

![英語版](/images/2017_0930_jugemutter_en.png)

こうなります。

## 参考

* [Twitterアカウント凍結解除方法と申請入力例](https://kazuto-yoshida.com/twitter-unfreeze-application.html)
* [[solved]How to embed qm translation files into executable | Qt Forum](https://forum.qt.io/topic/57863/solved-how-to-embed-qm-translation-files-into-executable)
* [wireshark/ui/qt at master · wireshark/wireshark](https://github.com/wireshark/wireshark/tree/master/ui/qt)
* [Hello tr() Example | Qt Linguist Manual](http://doc.qt.io/qt-5/qtlinguist-hellotr-example.html)
