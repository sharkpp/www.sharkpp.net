---
title: "macOS M1 上の Visual Studio Code で Flutter の開発環境を作ってみた"
date: 2023-09-24 23:52
tags: [雑記, macos, Flutter, vscode]
categories: [ブログ]

---

Flutter を使ってみようと思い立って、macOS 上の Visual Studio Code で開発できるよう整えてみた記録。

## Flutter のインストール

[macOS install](https://docs.flutter.dev/get-started/install/macos) を参考にインストール。

使っているのは M1 の MacBook Air なので

```console
$ sudo softwareupdate --install-rosetta --agree-to-license
```

も必要

### SDK のインストール

```console
% curl -O https://storage.googleapis.com/flutter_infra_release/releases/stable/macos/flutter_macos_arm64_3.13.1-stable.zip
% unzip flutter_macos_arm64_3.13.1-stable.zip
% mv flutter_macos_arm64_3.13.1-stable /opt/flutter
% echo 'export PATH="/opt/flutter/bin:$PATH"' >> ~/.zshrc
```

### flutter doctor で環境を調査

`flutter doctor` を実行して `No issues found!` と表示されればOK

`Doctor found issues in 2 categories.` 等と表示されている場合は指示に従いパッケージなどをインストールします。

※ 不要なプラットフォームの場合は警告を無視して問題ないです

```console
% flutter doctor
Doctor summary (to see all details, run flutter doctor -v):
[✓] Flutter (Channel stable, 3.13.1, on macOS 13.4.1 22F770820d darwin-arm64, locale ja-JP)
[✓] Android toolchain - develop for Android devices (Android SDK version 34.0.0)
[✓] Xcode - develop for iOS and macOS (Xcode 14.3.1)
[✓] Chrome - develop for the web
[✓] Android Studio (version 2022.3)
[✓] VS Code (version 1.66.1)
[✓] Connected device (2 available)
[✓] Network resources

• No issues found!
```

### flutter upgrade でアップデート

`A new version of Flutter is available!` 等とメッセージが出た場合や最新版がある事がわかっている場合は次のコマンドで更新できます。

```console
% flutter upgrade
```

## 開発環境のセットアップ

[Set up an editor](https://docs.flutter.dev/get-started/editor) を参考に Visual Studio Code の環境を整えます。

[Flutter開発を高速化するVSCode拡張機能を5つ紹介🎉](https://zenn.dev/hagakun_dev/articles/2f2eb65b892bea) を参考に拡張も入れます。

* [Flutter](https://marketplace.visualstudio.com/items?itemName=Dart-Code.flutter)
* [Flutter Tree](https://marketplace.visualstudio.com/items?itemName=marcelovelasquez.flutter-tree)
* [Flutter Widget Snippets](https://marketplace.visualstudio.com/items?itemName=alexisvt.flutter-snippets)
* [Awesome Flutter Snippets](https://marketplace.visualstudio.com/items?itemName=Nash.awesome-flutter-snippets)
* [Flutter-Auto-Import](https://marketplace.visualstudio.com/items?itemName=davidwoo.flutter-auto-import)
* [Error Lens](https://marketplace.visualstudio.com/items?itemName=usernamehw.errorlens)
* [Flutter Color](https://marketplace.visualstudio.com/items?itemName=circlecodesolution.ccs-flutter-color)

## アプリを作る

[Test drive](https://docs.flutter.dev/get-started/test-drive) を参考にアプリを作ります。

* `Command + Shift + P` でコマンドパレットを呼び出し `flutter` と入力し、**Flutter: New Project** を選択します。
* **Application** を選択します。
* 新しいプロジェクト フォルダーの親ディレクトリを作成または選択します。
* プロジェクト名 (my_app など) を入力し、Enter を押します。
* プロジェクトの作成が完了し、 main.dart ファイルが表示されるまで待ちます。

## アプリの実行

[<img src="{{ thumbnail('/images/20230828-flutter-demo-select-device.png', 640, 640) }}" alt="flutter-demo-select-device">](/images/20230828-flutter-demo-select-device.png)

* **デバイス セレクター** 領域からデバイスを選択します。
* **実行** > **デバッグの開始** を呼び出すか、F5 を押します。

とりあえず macOS で確認できる全種を起動してみました。

[<img src="{{ thumbnail('/images/20230828-flutter-demo-android-sim.png', 640, 640) }}" alt="flutter-demo-android-sim">](/images/20230828-flutter-demo-android-sim.png) [<img src="{{ thumbnail('/images/20230828-flutter-demo-ios-sim.png', 640, 640) }}" alt="flutter-demo-ios-sim">](/images/20230828-flutter-demo-ios-sim.png) [<img src="{{ thumbnail('/images/20230828-flutter-demo-web.png', 640, 640) }}" alt="flutter-demo-web">](/images/20230828-flutter-demo-web.png) [<img src="{{ thumbnail('/images/20230828-flutter-demo-macos.png', 640, 640) }}" alt="flutter-demo-macos">](/images/20230828-flutter-demo-macos.png)

## 参考

* [macOS install](https://docs.flutter.dev/get-started/install/macos)
* [Flutterの環境構築(Mac編)｜Flutter基礎入門 by Flutter大学](https://zenn.dev/kboy/books/ca6a9c93fd23f3/viewer/5232dc)
* [Flutter開発を高速化するVSCode拡張機能を5つ紹介🎉](https://zenn.dev/hagakun_dev/articles/2f2eb65b892bea)
* [【Mac M1】「flutter doctor」実行時の「cmdline-tools component is missing」の解決法](https://zenn.dev/imasaka0909/articles/00ebfaf74f9cea)
