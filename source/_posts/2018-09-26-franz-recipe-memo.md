---
layout: post
title: "Franz 5 のレシピに関するメモ"
date: 2018-09-26 0:55
tags: [Franz, Javascript]
categories: [ブログ]

---

Franz 5 用のレシピを作る際にいろいろソース読んだり調べたりしたのでそれのメモです。

現状 Franz 5 は、まだまだベータバージョンです。
なので仕様が変わることがあるため、ここに書かれている内容と違う動きをする場合もあります。

## そもそも Franz とはなんぞや？

簡単にいうと Franz は、各種 SNS をタブでまとめて管理できるデスクトップアプリです。

[Franz – a free messaging app for Slack, Facebook Messenger, WhatsApp, Telegram and more](https://meetfranz.com/) からダウンロードできますが、利用するにはアカウント登録が必要です。

特徴として

* レシピ（＝拡張）を追加することで様々な SNS などの Webサービスに対応可能
* レシピごとに複数のアカウントを割り当て可能（＝マルチアカウント対応）
* クロスプラットフォームなデスクトップアプリ

などがあります。

まあ、仕組みとしては Webで提供されているページをタブで表示しているのでブラウザで表示できるページであれば基本はなんでも表示できます。

## Recipe の作り方

レシピの作り方を超簡単、ざっくりと説明

1. Franz でサポートしたいSNS等を決める
2. [Franz Integration Documentation](https://github.com/meetfranz/plugins/tree/master/docs) をじっくりよく読む
3. 既存のレシピのソースを眺め参考にしながら対象のSNSを表示するように実装
4. デバッグは [Franz Recipe Documentation / Overview - Installation](https://github.com/meetfranz/plugins/blob/master/docs/integration.md#user-content-installation) を参考に
5. 完成したら [New Issue - meetfranz/plugins](https://github.com/meetfranz/plugins/issues/new?title=[Deploy]%20@@@@) からレシピのデプロイを要望しましょう

ほら簡単！

## webview.js の exports 関数の第２引数

`webview.js` の `module.exports` で公開する関数の引数は通常

```javascript
      :
module.exports = (Franz) => {
      :
```

と、このようになっています。

[プラグインドキュメント frontend_api.md](https://github.com/meetfranz/plugins/blob/master/docs/frontend_api.md#usage-2) でも同様です。

この定義に、第２引数を追加し

```javascript
      :
module.exports = (Franz, data) => {
      :
```

と、このようにすると

```javascript
data = {
    customUrl: "",
    hasCrashed: false,
    hasCustomUploadedIcon: false,
    iconUrl: "",                                // アカウントで設定しているアイコンを指定
    id: "0ea52f93-9c9a-4d07-a40e-876aacabce81", // サービスの識別子
    isActive: true,                             // 現在アクティブ（表示されている）か？
    isAttached: true,
    isBadgeEnabled: true,                       // 通知バッジが有効？
    isEnabled: true,                            // サービスが有効？
    isIndirectMessageBadgeEnabled: true,        // DM用のバッチが有効？
    isMuted: false,                             // オーディオでの通知が無効？
    isNotificationEnabled: true,                // 通知が有効？
    name: "hoge fuga",                          // サービスの名称（ユーザーが自由に設定）
    order: 5,                                   // 並び順
    recipe: {...},                              // サービスの元となる recipe
    team: "",                                   // チーム名
    timer: 29,
    unreadDirectMessageCount: 0,                // 未読なDMの個数
    unreadIndirectMessageCount: 0,              // 未読な返信の個数
    webview: {...}
};
```

とこのような感じで色々情報が取得できるようです。
ただ、これらはコピーされた値のようで受け取った以後は一切更新がされないようです。
ちなみに、呼び出し元は `/src/webview/plugin.js` の `initializeRecipe` イベントのリスナののようです。

## Developper Tools

Franz には、Developper Tools が `index.js` 用と `webview.js` 用の２種類あります。

それぞれの動作をまとめました。

|対象|メニュー|`Reload Franz` 時の動作|`Reload Service` 時の動作|
|-|-|-|-|
|`index.js`|`View` → `Toggle Developper Tools`|全てのServiceで共通|`Preserve log` オプションが非チェックだとログがクリアされる|影響なし|
|`webview.js`|`View` → `Toggle Service Developper Tools`|それぞれのServiceごと|ウインドウが破棄される|`Preserve log` オプションが非チェックだとログがクリアされる|

## 通知とオーディオについて

Franz自体での通知の有効と無効は

```javascript
// webview.js

const { ipcRenderer } = require('electron');

ipcRenderer.on('settings-update', (sender, settings) => {
  console.log(`isAppMuted = ${settings.isAppMuted}`);
  // isAppMuted = true  = ミュート状態
  // isAppMuted = false = ミュート解除状態
});

         :
```

と、することで確認可能。

ただし、 `Franz v5.0.0 bata 18` 以降実装が変わったのか、最初に一回呼び出されて以後一切呼ばれなくなります。なんとなくバグっぽい気もします。

Backend 側で `window.franz.stores.services` を定期的に参照し変化があった場合に Frontend 側に通知すれば自力で同様のことができるようです。

[この辺](https://github.com/sharkpp/franz-recipe-mastodon/commit/e6e3db9ab3e04aa9f35cdac59b01bba145ae3029) のソースを参考に、です。


個別のサービスの「通知を無効にする」や「オーディオの無効化」の状態は、`exports` する関数に２つ目の引数を追加することで...

```javascript
      :
module.exports = (Franz, data) => {
    console.log(`isMuted = ${data.isMuted}`);
    console.log(`isNotificationEnabled = ${data.isNotificationEnabled}`);
      :
```

どうもイベント通知で送られて来るために引数は Deep Copy された値が渡されるようです。
そのため初期状態は取得できますが、変化があっても反映されることはありません。

ちなみに `Franz.onNotify()` は、Franz自体の設定で「通知とオーディオを無効化」したり、それぞれのサービスで個別に「通知を無効にする」としても必ず呼び出されます。

## デスクトップ通知

デスクトップ通知は

```javascript
    Franz.onNotify(notification => {
        // ToDo ...
        return notification;
    });
```

で実際にデスクトップに通知する直前に情報を取得できます。

参考：[frontend_api.md#onnotifyfn](https://github.com/meetfranz/plugins/blob/master/docs/frontend_api.md#onnotifyfn)

そして `return false;` とすることで通知を握りつぶすことができます。

```javascript
    Franz.onNotify(notification => {
        // destroy the notification
        return false;
    });
```

## サービスの識別子を取得する

`webview.js` の exports 関数の二つ目の引数で取得できます。

```javascript
      :
module.exports = (Franz, data) => {
    console.log('id = "${data.id}"'); // id = "0ea52f93-9c9a-4d07-a40e-876aacabce81"
```

この値が、 recipe からインスタンスとして起動した service の識別子となります。

## Backend API で受け取れる各種イベント

イベントを受け取るためにどんなイベントを受け取るかあらかじめ定義します。

```javascript
module.exports = Franz => class HogeHoge extends Franz {

  constructor(...args) {
    let _temp;
    return _temp = super(...args), this.events = {
        // ここで受け取るイベントを定義
        'did-navigate': 'handleDidNavigate',
    }, _temp;
  }

  handleDidNavigate (event) {
      // 諸々の処理を行う
  }
                   :
};
```

受け取れる主なイベントはこんな感じ

|イベント名|概要|
|-|-|
|`before-input-event`       |  |
|`certificate-error`        |  |
|`console-message`          | `console.*` で表示する内容 |
|`context-menu`             |  |
|`crashed`                  |  |
|`cursor-changed`           |  |
|`destroyed`                |  |
|`devtools-closed`          | 開発者ツールが閉じられた |
|`devtools-focused`         | 開発者ツールがにフォーカスが当たった |
|`devtools-opened`          | 開発者ツールが表示された |
|`devtools-reload-page`     |  |
|`did-attach-webview`       |  |
|`did-change-theme-color`   |  |
|`did-fail-load`            |  |
|`did-finish-load`          |  |
|`did-frame-finish-load`    |  |
|`did-get-redirect-request` |  |
|`did-get-response-details` |  |
|`did-navigate`             |  |
|`did-navigate-in-page`     |  |
|`did-start-loading`        |  |
|`did-stop-loading`         |  |
|`dom-ready`                | コンテンツのDOMの準備ができた |
|`found-in-page`            |  |
|`login`                    |  |
|`media-paused`             |  |
|`media-started-playing`    |  |
|`new-window`               |  |
|`page-favicon-updated`     |  |
|`paint`                    |  |
|`plugin-crashed`           |  |
|`select-bluetooth-device`  |  |
|`select-client-certificate`|  |
|`update-target-url`        |  |
|`will-attach-webview`      |  |
|`will-navigate`            |  |
|`will-prevent-unload`      |  |

概要がブランクの部分はまだ調べきれていない部分です。
まあ、イベント名でなんとなく想像はできると思います。

## Backend API から Frontend API へ

Backend API (index.js) から Frontend API (webview.js) へのデータの受け渡しの方法。


送り側：

```javascript
// index.js

    // this は webview のインスタンスである必要があります。
    // コンストラクタの this では WebView のインスタンスへアクセスできないようです。
    this.send('test', { foo: 'bar' });
```

受け取り側：

```javascript
// webview.js

const { ipcRenderer } = require('electron');

ipcRenderer.on('test', (sender, data) => {
    console.log(data); // { foo: 'bar' }
});
```

## Frontend API から Backend API へ

Frontend から Backend への通知方法はまだ見つかっていません。
おそらく出来るとは思います...

## 参考

* [meetfranz/plugins: Official Franz Plugin Repository](https://github.com/meetfranz/plugins)
* [Franz Pluginを作ってみよう - Qiita](https://qiita.com/kan/items/571b2f56c54e1e3b6516)
* [recipe-rocketchat/webview.js at master · meetfranz/recipe-rocketchat](https://github.com/meetfranz/recipe-rocketchat/blob/master/webview.js)
* [franz/notifications.js at a4b665ef5f218313e524f0582d08cde6aa5d7049 · meetfranz/franz](https://github.com/meetfranz/franz/blob/a4b665ef5f218313e524f0582d08cde6aa5d7049/src/webview/notifications.js)
* [recipe-messenger/webview.js at 0df2bea55d7775a70d73a93663520d1fe8982241 · meetfranz/recipe-messenger](https://github.com/meetfranz/recipe-messenger/blob/0df2bea55d7775a70d73a93663520d1fe8982241/webview.js)
* [franz/RecipeWebview.js at a4b665ef5f218313e524f0582d08cde6aa5d7049 · meetfranz/franz](https://github.com/meetfranz/franz/blob/a4b665ef5f218313e524f0582d08cde6aa5d7049/src/webview/lib/RecipeWebview.js)
* [mastodon/notifications.js at master · tootsuite/mastodon](https://github.com/tootsuite/mastodon/blob/master/app/javascript/mastodon/actions/notifications.js)
* [mastodon-franz/index.js at master · tsadiq/mastodon-franz](https://github.com/tsadiq/mastodon-franz/blob/master/index.js)
* [franz-plugin-mastodon/webview.js at master · kan/franz-plugin-mastodon](https://github.com/kan/franz-plugin-mastodon/blob/master/webview.js)
* [electron/web-contents.md at master · electron/electron](https://github.com/electron/electron/blob/master/docs/api/web-contents.md)
* [<webview> Tag | Electron](https://electronjs.org/docs/api/webview-tag#dom-events)
