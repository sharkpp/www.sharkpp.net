---
title: "Ionic 5 でモバイル＆デスクトップアプリを試してみた"
date: 2021-04-30 21:35
tags: [Ionic, Javascript, React, Electron]
categories: [ブログ]

---

モバイルでもウェブでもデスクトップでも動くサービスを作る方法を調べて、とりあえず React で実装できそうな [Ionic 5](https://ionicframework.com/) を試してみることにしました。

## 準備

まず、 ionic のコンソールツールをインストールします。

```console
$ npm install -g @ionic/cli
```

ios 向けを開発する場合はさらに

```console
$ npm install -g ios-sim
$ brew install ios-deploy
```

## プロジェクトの作成

コンソールツールがインストールできたら、プロジェクトを作成します。

引数は次のような感じで指定します。

```console
$ ionic start <アプリ名> <テンプレート名> --type=react --capacitor
$ cd <アプリ名>
```

**<アプリ名>**

myApp など、プロジェクトの名前を指定

**<テンプレート名>**

`--type=react` で指定可能なテンプレート名の種類

|テンプレート名|説明|
|-|-|
|`blank`       |空白のスタータープロジェクト|
|`list`        |リスト付きの開始プロジェクト|
|`my-first-app`|ギャラリー付きのカメラを構築するサンプルアプリケーション|
|`sidemenu`    |コンテンツ領域にナビゲーションを備えたサイドメニューを備えた開始プロジェクト|
|`tabs`        |シンプルなタブ付きインターフェースを備えた開始プロジェクト|
|`conference`  |Ionicが提供するすべてを披露するキッチンシンク(ライブラリが提供する機能を網羅するサンプル)アプリケーション|

**その他**

|パラメータ|説明|
|-|-|
|`--capacitor`|Capacitor(クロスプラットフォームなネイティブランタイム)を利用するため|

## Capacitor を利用するための追加設定

### Capacitor の初期化

```console
$ npx cap init <アプリ名> <アプリId> --web-dir=build --npm-client=yarn
```

**<アプリ名>**

ionic start で指定した値と同じものを指定。

**<アプリId>**

`com.example.app` みたいな値。

**その他**

|パラメータ|説明|
|-|-|
|`--web-dir=build`|プロジェクトで作成したウェブアセットのディレクトリ|
|`--npm-client=yarn`|`npm` or `yarn` ※ npm 7 以降で互換性の問題が発生している模様なので Yarn を選択|

### Native プラットフォームの追加

```console
$ ionic build
$ npx cap add <プラットフォーム>
```

プラットフォームの追加前に `ionic build` が必要。

実行しない場合、

```console
$ npx cap add electron
[error] Capacitor could not find the web assets directory "~/test1/build".
    Please create it, and make sure it has an index.html file. You can change
    the path of this directory in capacitor.config.json.
    More info: https://capacitor.ionicframework.com/docs/basics/configuring-your-app
```

とメッセージが出ます。

**<プラットフォーム>**

指定可能な値

|プラットフォーム|説明|
|-|-|
|`android`  |Android 向けの構成|
|`ios`      |iOS 向けの構成|
|`electron` |(Electronで実装される)デスクトップ向けの構成|

### Native プラットフォームの実行

```console
$ ionic build
$ npx cap copy
$ npx cap open <プラットフォーム>
```

**<プラットフォーム>**

npx cap add で指定可能な値と同じ

### リリースビルド

**electron**

事前に electron-packager をインストール

```console
$ npm install -g electron-packager
```

パラメータを指定して実行

```console
$ electron-packager ./electron <アプリ名> --platform=<プラットフォーム> --arch=<アーキテクチャ> [オプションフラグ...]
```

**<アプリ名>**

ionic start で指定した値と同じものを指定。

**<プラットフォーム>と<アーキテクチャ>**

|プラットフォーム|アーキテクチャ|概要|
|-|-|-|
|`darwin`|`x64`|macOS|
|`win32`|`x64`|Windows 64ビット向け|

**[オプションフラグ]**

|オプションフラグ|概要|
|-|-|
|`--arch=...`|`all` 、または1つ以上：`ia32`、`x64`、`armv7l`、`arm64`、`mips64el`（複数の場合はカンマ区切り）。 デフォルトはホストのアーチです|
|`--icon=...`|アプリのアイコンとして使用するアイコンファイルへのローカルパス。注：形式はプラットフォームによって異なります。|
|`--overwrite`|プラットフォームの出力ディレクトリがすでに存在する場合は、スキップするのではなく置き換えます|
|`--platform=...`|`all` 、または1つ以上：`darwin`、`linux`、`mas`、`win32`（複数の場合はカンマ区切り）。デフォルトはホストのプラットフォームです|

その他、かなり多いので [usage.txt](https://github.com/electron/electron-packager/blob/master/usage.txt) を参考に。

## まとめ

ざっと試したところ、テンプレートの保守がされてないのか、色々躓く所があった。

特に、 Electron サポートは散々で、`blank` や `my-first-app` や `tabs` ぐらいしかまともに試せない感じ。
`my-first-app` もだいたい動くけどカメラは動作していないと思う...

|プラットフォーム|起動|ビルド|
|-|-|-|
|`ios`|`npx cap open ios`|XCodeで作業 [Deploying Capacitor Applications to iOS (Development & Distribution)](https://www.joshmorony.com/deploying-capacitor-applications-to-ios-development-distribution/) を参考|
|`android`|`npx cap open android`|[Deploying Capacitor Applications to Android (Development & Distribution)](https://www.joshmorony.com/deploying-capacitor-applications-to-android-development-distribution/) を参考|
|`electron`|`npx cap open electron`|`electron-packager ./electron <アプリ名>`|

## 参考

* [Installing Ionic - Ionic Documentation](https://ionicframework.com/docs/intro/cli)
* [Using Capacitor with Ionic - Capacitor](https://capacitorjs.com/docs/getting-started/with-ionic)
* [Tutorial/guide to build for Ionic-React-Electron app - Capacitor - Ionic Forum](https://forum.ionicframework.com/t/tutorial-guide-to-build-for-ionic-react-electron-app/176872/4)
* [Building Ionic Desktop Apps with Capacitor and Electron | Devdactic - Ionic Tutorials](https://devdactic.com/ionic-desktop-electron/)
* [My-first-app starter npm update not working - Ionic Framework - Ionic Forum](https://forum.ionicframework.com/t/my-first-app-starter-npm-update-not-working/200076/3)
* [reactjs - Ionic React, error "Argument of type is not assignable" for correct code - Stack Overflow](https://stackoverflow.com/questions/59921618/ionic-react-error-argument-of-type-is-not-assignable-for-correct-code)
* [serviceworker: Request scheme 'file' is unsupported · Issue #13740 · electron/electron · GitHub](https://github.com/electron/electron/issues/13740#issuecomment-439069134)
* [iOS Development - Ionic Documentation](https://ionicframework.com/docs/developing/ios#ios-sim-ios-deploy)
* [Deploying Capacitor Applications to iOS (Development & Distribution) | joshmorony - Learn Ionic & Build Mobile Apps with Web Tech](https://www.joshmorony.com/deploying-capacitor-applications-to-ios-development-distribution/)
* [Deploying Capacitor Applications to Android (Development & Distribution) | joshmorony - Learn Ionic & Build Mobile Apps with Web Tech](https://www.joshmorony.com/deploying-capacitor-applications-to-android-development-distribution/)
