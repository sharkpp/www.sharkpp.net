---
layout: post
title: "Hubot アダプタを TypeScript を使って作ってみた"
date: 2020-07-29 23:46
tags: [JavaScript, TypeScript, Hubot, 雑記]
categories: [ブログ]

---

## TypeScrpt で実装する Hubot アダプタ

[Development adapter | HUBOT](https://hubot.github.com/docs/adapters/development/) を参考に、起動時に bot へと生成したメッセージを受け渡すだけを行うアダプタを TypeScript で実装してみました。

この記事では次のような名称を利用しているので適時読み替えてください。

|項目|名称|
|-|-|
|アダプタプロジェクト名|`hubot-sample-adapter`|
|テスト用のHubotプロジェクト名|`hubot-test`|
|アダプタプロジェクトの親フォルダ|`~/`|

### TypeScript のインストール

まず環境を整えていきます。

```console
$ mkdir hubot-sample-adapter
$ cd hubot-sample-adapter
$ npm init -y
```

追加で、

```console
$ npm install --save --dev typescript hubot @types/hubot
$ npx tsc --init
```

として TypeScript のツール用の設定をします。

### Visual Studio Code で構文チェック

Visual Studio Code で [ESLint](https://marketplace.visualstudio.com/items?itemName=dbaeumer.vscode-eslint) を使って構文チェックをできるようにします。

```console
$ npm install --save --dev eslint prettier eslint-config-airbnb-base eslint-config-prettier eslint-plugin-prettier eslint-plugin-import
$ npm install --save --dev @typescript-eslint/parser @typescript-eslint/eslint-plugin
```

インストールを行うと `The ESLint extension will use 'node_modules/eslint' for validation, which is installed locally in 'hubot-sample-adapter'. If you trust this version of ESLint, press 'Allow', otherwise press 'Do Not Allow'. Press 'Cancel' to disable ESLint for this session.` と確認されるので `Allow` を選択します。

とりあえず、

|項目|説明など|
|-|-|
|Javascript style guide|airbnb-base|
|構文チェック|基本全てエラー|
|no-unused-vars|`_` から始まる変数以外の未使用をエラーとする。(TypeScriptの構文を優先)|

こんな感じで、設定ファイル `.eslintrc.js` は

```javascript
module.exports = {
    "env": {
        "browser": false,
        "es2020": true
    },
    "extends": [
        "airbnb-base",
        "plugin:prettier/recommended",
        "prettier/@typescript-eslint"
    ],
    "parser": "@typescript-eslint/parser",
    "parserOptions": {
        "ecmaVersion": 11,
        "sourceType": "module"
    },
    "plugins": [
        "@typescript-eslint",
        "prettier"
    ],
    "rules": {
        "prettier/prettier": "error",
        "no-unused-vars": "off",
        "@typescript-eslint/no-unused-vars": ["error", { argsIgnorePattern: "^_" }]
    }
};
```

こんな感じ。

## Visual Studio Code でデバッグを行うためのあれこれ

TypeScript のソース上でブレークポイントを設定したりデバッグ実行前にソースをコンパイルするなど、デバッグのための構成を行います。

1. デバッグ用 hubot プロジェクトの作成
2. デバッグのための構成を追加

### デバッグ用 hubot プロジェクトの作成

`yo hubot` でテスト用の hubot を作成します。
この時 `--defaults` オプションをつけることでオーナーなどの指定をよしなにしてくれます。
ここではテスト用に作るため、アダプタプロジェクトの直下に作ります。

```console
$ mkdir hubot-test
$ cd hubot-test
$ npx yo hubot --defaults
                     _____________________________  
                    /                             \ 
   //\              |      Extracting input for    |
  ////\    _____    |   self-replication process   |
 //////\  /_____\   \                             / 
 ======= |[^_/\_]|   /----------------------------  
  |   | _|___@@__|__                                
  +===+/  ///     \_\                               
   | |_\ /// HUBOT/\\                             
   |___/\//      /  \\                            
         \      /   +---+                            
          \____/    |   |                            
           | //|    +===+                            
            \//      |xx|                            

   create bin/hubot
   create bin/hubot.cmd
　　　　　　　　：
added 92 packages from 53 contributors and audited 92 packages in 13.227s
found 0 vulnerabilities

```

`npm link path/to/hubot-adapter` とコマンドを実行し、アダプタへリンクを貼り テスト用の Hubot プロジェクトからアダプタが認識できるようにします。

```console
$ pwd

$ npm link ../../hubot-sample-adapter
npm WARN hubot-sample-adapter@1.0.0 No repository field.

audited 373 packages in 3.58s

29 packages are looking for funding
  run `npm fund` for details

found 0 vulnerabilities

/usr/local/lib/node_modules/hubot-sample-adapter -> ~/hubot-sample-adapter
~/hubot-sample-adapter/hubot-test/node_modules/hubot-sample-adapter -> /usr/local/lib/node_modules/hubot-sample-adapter -> ~/hubot-sample-adapter
```

注意点として、パスの指定は相対パスで問題ないですが、指定したパスの最後の部分を利用し node_modules にフォルダを作成しているようなので、フォルダ名を指定する必要があります。

```
○ $ npm link ../../hubot-sample-adapter
× $ npm link ../
```

作成されたプロジェクトをデバッグ用にカスタマイズします。

`hubot-test/external-scripts.json` にデフォルトで設定されている外部スクリプトはデバッグの邪魔になるので除外しておきます。

```diff
 [
-  "hubot-diagnostics",
-  "hubot-help",
-  "hubot-heroku-keepalive",
-  "hubot-google-images",
-  "hubot-google-translate",
-  "hubot-pugme",
-  "hubot-maps",
-  "hubot-redis-brain",
-  "hubot-rules",
-  "hubot-shipit"
 ]
```

とりあえず、この記事で実装するアダプタは起動時にメッセージを bot へ送るので、どんな内容でも受け取ってり返答する bot を `hubot-test/scripts/echo.coffee` として追加します。

内容は適時使いやすいように書き換え可能ですが、先頭のコメント行を削除すると `using deprecated documentation syntax` と警告がログに出ます。

```coffee
# Description:
#   echo bot
#
# Commands:
#   <text> - Reply back with <text>

module.exports = (robot) ->

  robot.hear /(.*)/i, (res) ->
    res.reply "echo \"#{res.match[1]}\""
```

### デバッグのための構成を追加

Visual Studio Code で TypeScript で実装された Hubot アダプタをデバッグするため、３つのファイルでデバッグ構成を設定します。

まず、`.vscode/launch.json` にデバッグ実行のための構成を追加します。

1. 「アクティビティーバー」の「実行」を押下し、「launch.json ファイルを作成します」を選択します。
2. ドロップダウンで指定する環境は「Node.js」を選択します。
3. すると `.vscode/launch.json` にプログラムを実行するための構成ファイルが生成されます。

作成後のファイルを開き（確認のためファイルはオープンされています）次のような感じに変更します。

`"outputCapture": "std"` (もしくは、ユーザーの入力を受け取る必要があるなら `"console": "integratedTerminal"` )を設定しない場合、実行時のログを確認することができません。

```diff
 {
   "version": "0.2.0",
   "configurations": [
     {
-      "name": "プログラムの起動",
+      "name": "Debug Adapter",
       "type": "node",
       "request": "launch",
+      "preLaunchTask": "tsc: ビルド - tsconfig.json",
       "skipFiles": [
         "<node_internals>/**"
       ],
-      "program": "${workspaceFolder}/index.js"
+      "program": "${workspaceRoot}/hubot-test/node_modules/.bin/coffee",
+      "cwd": "${workspaceRoot}/hubot-test",
+      "outputCapture": "std",
+      "args": [
+        "${workspaceRoot}/hubot-test/node_modules/.bin/hubot",
+        "-a", "sample-adapter",
+      ],
+      "env": {
+        "HUBOT_LOG_LEVEL": "DEBUG"
+      }
     }
   ]
 }
```

まず、`.vscode/tasks.json` にデバッグ実行前に TypeScript でコンパイルを行うための設定をします。
デバッグ実行との関連付けはすでに `"preLaunchTask": "tsc: ビルド - tsconfig.json",` にて指定済みです。

メニューから「ターミナル」→「タスクの構成...」を選択し、ドロップダウンの選択ないから「tsc: ビルド - tsconfig.json」を選択します。

すると次のような内容が `.vscode/tasks.json` に作成されます。

```json
{
	"version": "2.0.0",
	"tasks": [
		{
			"type": "typescript",
			"tsconfig": "tsconfig.json",
			"problemMatcher": [
				"$tsc"
			],
			"group": "build",
			"label": "tsc: ビルド - tsconfig.json"
		}
	]
}
```

最後に、 `tsconfig.json` に設定することで、TypeScript のソースでブレイクポイントを設定できるようにします。

デフォルトでは、TypeScript のソースでブレークポイントを設定してもデバッグ実行時には、コンパイル後の JavaScript のソースが実行されるため指定したブレークポイントは無効にされてしまいます。

設定を追加することで TypeScript のソースのコンパイル時に同時にマップファイルが書き出されるようになり、結果としてブレイクポイントを設定できるようになります。

`tsconfig.json` を次のように変更します。

```diff
      // "declaration": true,                   /* Generates corresponding '.d.ts' file. */
      // "declarationMap": true,                /* Generates a sourcemap for each corresponding '.d.ts' file. */
-     // "sourceMap": true,                     /* Generates corresponding '.map' file. */
+     "sourceMap": true,                        /* Generates corresponding '.map' file. */
      // "outFile": "./",                       /* Concatenate and emit output to single file. */
      // "outDir": "./",                        /* Redirect output structure to the directory. */
```

## アダプタプの実装

[Development adapter | HUBOT](https://hubot.github.com/docs/adapters/development/) の `src/adapter.coffee` を参考に TypeScript で書き換え `src/adapter.ts` を作成します。

```typescript
import { Robot, Adapter, User, TextMessage } from "hubot";

class Sample extends Adapter {
  robot!: Robot<Adapter>;

  constructor(robot: Robot<Adapter>) {
    super(robot);
    this.robot.logger.info("Constructor");
  }

  send(envelope: any, ...strings: any[]) {
    this.robot.logger.info("Send");
  }

  reply(envelope: any, ...strings: any[]) {
    this.robot.logger.info("Reply");
  }

  run() {
    this.robot.logger.info("Run");
    this.emit("connected");
    const user = new User("1001", { name: "Sample User", });
    const message = new TextMessage(user, "Some Sample Message", "MSG-001");
    this.robot.receive(message);
  }
}

module.exports.use = function createSampleAdapter(
  robot: Robot<Adapter>
) {
  return new Sample(robot);
};
```

TypeScript でコンパイルすると `src/adapter.js` が作成されるので、忘れずに `package.json` に書かれているエントリポイントは `src/adapter.coffee` ではなく `src/adapter.js` にしておきましょう。

### デバッグ実行時特有の問題への対処

ここまでで、ほぼデバッグ実行ができるようになりますが、実はこのままだと Node.js のライブラリの読み込みの仕様が原因で `robot.receive()` から呼ばれるはずの bot の処理が実行されない状態になっています。

原因としてはどうやら

1. `hubot` コマンドがアダプタを読み込む。
2. アダプタが `hubot` ライブラリの読み込みを行う。
3. パスの解決の結果、 `hubot-test/node_modules/hubot` が読み込まれることを意図しているところ、 アダプタのコンパイルに必要なため `node_modules/hubot` が存在していることから、そちらが読み込まれる。

結果 `hubot` コマンド内で行われる `instanceof TextMessage` などの比較で不一致が発生し bot が処理されないようです。

現状、対処としては動的にデバッグ実行かそうでないかを判断しライブラリの読み込みパスを変更するようにすることで意図しない動きを回避しています。

```diff
-import { Robot, Adapter, User, TextMessage } from "hubot";
+import * as Hubot from "hubot";
+import { Robot, Adapter } from "hubot";
+import * as path from "path";
+
+const isTestHubot =
+  path.join(__dirname, "..") ===
+  // @ts-ignore TS2532: Object is possibly 'undefined'.
+  path.join(require.main.filename.replace(/node_modules\/.*$/, ""), ".."); // (...)/hubot-line-local-tunnel/hubot-test/node_modules/hubot/bin/hubot
+// テスト環境での実行時はテスト用の環境に含まれる Hubot パッケージを読むように指示
+const { User, TextMessage } = !isTestHubot
+  ? Hubot
+  : require(require("path").join(__dirname, "../hubot-test/node_modules/hubot")); // eslint-disable-line import/no-dynamic-require
 
 class Sample extends Adapter {
   robot!: Robot<Adapter>;
```

## 実行してみる

`hubot` プリフェックスを除いた名前で `--adapter` オプションを指定し実行します

```console
$ npx hubot -a sample-adapter
[Wed Jul 29 2020 23:44:09 GMT+0900] INFO Constructor
[Wed Jul 29 2020 23:44:09 GMT+0900] INFO Run
[Wed Jul 29 2020 23:44:09 GMT+0900] WARNING Loading scripts from hubot-scripts.json is deprecated and will be removed in 3.0 (https://github.com/github/hubot-scripts/issues/1113) in favor of packages for each script.

Your hubot-scripts.json is empty, so you just need to remove it.
[Wed Jul 29 2020 23:44:09 GMT+0900] INFO Reply
```

ログを見ると、ちゃんと `Constructor` と `Run` と `Reply` が印字されています。

## メモ

### Configuration for rule "import/no-cycle" is invalid

```console
               :
Configuration for rule "import/no-cycle" is invalid
               :
```

と表示され eslint が正常に実行されない場合があった。

[Invalid rule configurations compiled by "eslint --print-config" on eslint-config-airbnb-typescript · Issue #2227 · airbnb/javascript](https://github.com/airbnb/javascript/issues/2227) によると、どうやら 7.3.0 から 7.2.0 へダウングレードすることで回避できる様子。

```console
$ npm i eslint@7.2.0 --save-dev
```

## 参考

* [Development adapter | HUBOT](https://hubot.github.com/docs/adapters/development/)
* [Invalid rule configurations compiled by "eslint --print-config" on eslint-config-airbnb-typescript · Issue #2227 · airbnb/javascript](https://github.com/airbnb/javascript/issues/2227)
* [TypeScript の開発環境を作る。VSCode を基本に ESLint と Prettier も添えて。 - Multi Vitamin & Mineral](https://hiranoon.hatenablog.com/entry/2020/04/13/192746#%E3%81%AF%E3%81%98%E3%82%81%E3%81%AB)
* [hubot adapterの作り方 - おみブロZ](http://akiomik.hatenablog.jp/entry/2014/02/12/052703)
* [Hubot のインストール - Qiita](https://qiita.com/bouzuya/items/11c0c6da2b3ad54b827f#hubot-echo)
* [Visual Studio Code のデバッグコンソールにログが出力されない話 | 岡山のWEB制作はKOMARI](https://komari.co.jp/blog/develop/frontend/355/#i-3)
* [Hubotでusing deprecated documentation syntax - Qiita](https://qiita.com/n0bisuke/items/12ce4df55a405a62b599)
* [ESLint 最初の一歩 - Qiita](https://qiita.com/mysticatea/items/f523dab04a25f617c87d)
* [Eslintでunderscoreから始まる変数をチェックさせない設定にする - Memento memo.](https://shotat.hateblo.jp/entry/2016/10/26/000912)
* [esLint-Typescriptの「no-unused-vars」の構成-スタックオーバーフロー](https://stackoverflow.com/questions/57802057/eslint-configuring-no-unused-vars-for-typescript)
