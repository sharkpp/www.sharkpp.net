---
layout: post
title: "Reactでウェブアプリを作ってみた"
date: 2019-10-14 18:05
tags: [JavaScript, React, bootstrap, PWA, ダークモード, アクセシビリティ]
categories: [ブログ]

---

React を利用してオフラインでも簡単な画像編集をできる１画面ウェブアプリを作ってみました。

作ったものは[揺れる<ruby>※<rp>(</rp><rt>ちょめ</rt><rp>)</rp>※<rp>(</rp><rt>ちょめ</rt><rp>)</rp></ruby>画像ジェネレータ](https://sharkpp.github.io/delayedmotion/)です。
ネーミングはまあ微妙かな…(汗

それを作るなかで調べたことなどをまとめました。

![Light mode](/images/20191014_delayedmotion_lightmode.png)

## 基本の基

まずは、今回利用したツールについて。

利用したのは [create-react-app](https://github.com/facebook/create-react-app) です。

> Set up a modern web app by running one command.

とあるようにコマンド一発で

* [React](https://ja.reactjs.org/) を利用するのに最適な環境を構築
* PWA に簡単に対応できる [Service Worker](https://developer.mozilla.org/ja/docs/Web/API/Service_Worker_API) などの実装
* 開発用サーバー＆ビルド環境
* ユニットテスト

がそろったプロジェクトが設定要らずで作成できます。

## UI 周り

UI は [React Bootstrap](https://react-bootstrap.github.io/) と…

<img src="{{ thumbnail('/images/20191014_react-bootstrap.png', 640, 640) }}" alt="React Bootstrap">

ダークモードに対応するためにカスタマイズされたテーマの [bootstrap-dark](https://github.com/ForEvolve/bootstrap-dark) を…

<img src="{{ thumbnail('/images/20191014_bootstrap-dark-sample.png', 640, 640) }}" alt="bootstrap-dark">

利用しました。
ダークモードについてはこの後に記載があります。

アイコンは、React から利用できる Font Awesome である [react-fontawesome](https://fontawesome.com/how-to-use/on-the-web/using-with/react) を利用しています。

あとは、

* [react-dropzone](https://github.com/react-dropzone/react-dropzone)
* [react-stepper(react-stepper-horizontal)](https://github.com/mu29/react-stepper)
* [react-image-crop](https://github.com/DominicTobias/react-image-crop)

などを、このアプリに固有の UI を実装するため利用しています。

## アプリ固有処理

今回のアプリは、

1. 画像をアップロード
2. 画像を加工
3. 出来上がった画像をダウンロード

という感じに順次進んでいく操作が主となります。

それらの処理の実装についてさらっと記載しておきます。

### 画像をアップロード

![Light mode](/images/20191014_delayedmotion_lightmode.png)

ここでは、単なる画像のアップロードと URL を利用したとえば Public Domain な画像などを利用した加工をできるようにしてあります。

このうち画像のアップロード（といいつつサーバーにはアップロードしない）は、 react-dropzone を使ってサクッと実装してあります。

また、URL を指定しての画像編集は、 CORS などによりブロックされるので [cors-anywhere](https://github.com/Rob--W/cors-anywhere) というプロキシを Heroku にデプロイし利用しています。

### 画像を加工

![Select Page](/images/20191014_delayedmotion_select_phase.png)

画像の加工は [react-image-crop](https://github.com/DominicTobias/react-image-crop) を選択の UI に利用し、HTML5 Canvas をマスクや画像の加工に利用しています。

### 出来上がった画像をダウンロード

![Download page](/images/20191014_delayedmotion_download_phase.png)

出来上がった画像のダウンロードには [js-file-download](https://github.com/kennethjiang/js-file-download) を利用しています。

## PWA 対応

react-create-app では、標準で Service Worker の実装が含まれていますが、プロジェクトの作成直後は無効にされています。

`src/index.js` の中身を

```diff
  
- serviceWorker.unregister();
+ serviceWorker.register();
  
```

と変更すると、Service Worker でリソースのキャッシュが有効にされ、オフラインでも利用できるようになります。

ただ、ローカルでは実行されなかったり http では動作しなかったりと色々制限はあります。
もっとも、オフラインの場合に特別な処理を行うような機能はないので追加で独自に実装しています。

### オフラインモードの検出

オフラインモードの検出は

```javascript
    window.addEventListener('online',  () => console.log('change network: online mode'));
    window.addEventListener('offline', () => console.log('change network: offline mode'));
```

のような感じでできます。

また、今のモードの取得は

```javascript
> console.log(navigator.onLine);
true
```

のような感じで取得できます。

まあ、それ以外にはどうしようもないのですが…

## Lighthouse によるスコアの改善

[Lighthouse](https://chrome.google.com/webstore/detail/lighthouse/blipmdconlkpinefehnmjammfjpmpbjk?hl=ja) によるスコアの改善などもしています。

大体は指摘に沿って直していけばいいのですが、不具合らしきものを見つけました。

### [role]s are not contained by their required parent element

具体的には React Bootstrap の [Card Navigation](https://react-bootstrap.github.io/components/cards/#navigation) で `[role]s are not contained by their required parent element` (訳:[role]は必須の親要素に含まれていません) と指摘がされます。
どうやら `role` 属性が Card Navigation に対して設定できない(設定しても React で生成された要素に付加されていない)状態になるようです。

[ドキュメント](https://react-bootstrap.netlify.com/components/navs/#nav-link-props)によれば…

> ARIA role for the Nav, in the context of a TabContainer, the default will be set to "tablist", but can be overridden by the Nav when set explicitly.
> When the role is "tablist", NavLink focus is managed according to the ARIA authoring practices for tabs:  
> 訳: TabContainer のコンテキストでの Nav の ARIA ロールは、デフォルトが "tablist" に設定されますが、明示的に設定すると Nav によってオーバーライドできます。  
> ロールが「タブリスト」の場合、NavLinkフォーカスはタブの ARIA オーサリングプラクティスに従って管理されます。

 `role="tablist"` がデフォルトで設定されるようですがどうやらそれすらも無視されているようです。

しばらく悩み、最終的に Nav の親に属性を着ける事でとりあえずの対応としています。

対応方法はこんな感じ。

```javascript
  <Card>
-   <Card.Header>
+   <Card.Header role="tablist">
      <Nav variant="tabs" defaultActiveKey="#first">
        <Nav.Item>
```

## ダークモード対応

macOS や Windows 10 や Android 10 にはダークモードなる通常とは色調が反転した色合いのテーマに変更する機能があります。

|ライトモード|ダークモード|
|-|-|
|![Light mode](/images/20191014_delayedmotion_lightmode.png)|![Dark mode](/images/20191014_delayedmotion_darkmode.png)|

`ダークモード 対応` などと検索すると、画面上で切り替えスイッチを実装し、その設定を保存してテーマを切り替えるサンプルやライブラリが色々見つかりました。
とりあえず今回は CSS のメディア特性 [prefers-color-scheme](https://developer.mozilla.org/ja/docs/Web/CSS/@media/prefers-color-scheme) を利用し、システムの設定に沿って切り替わるようにしました。

現在の実装に落ち着くまで色々調べてみたのですが…

* CSS 全部に prefix をつけて JavaScript で切り替えるのは面倒(たぶん CSS をビルドすればできると思うけど…)
* `import('darkmode.css')` で読み込んで JavaScript で制御しようにもアンロードの方法が見つからない
* CSS の `@media (prefers-color-scheme: dark) { ... }` のブロック内で `@import` してもビルド対象に含まれない(外側だと埋め込まれるがそれでは意味がない…)

と、いろいろ課題があり、最終的には… `dark-theme.css` という名前の CSS を用意し、`@media (prefers-color-scheme: dark) { ... }` のブロック内に [bootstrap-dark](https://github.com/ForEvolve/bootstrap-dark) を直接埋め込む、という対応をしています。

それもこれも react-create-app で webpack のビルド設定が隠匿されているのでカスタマイズできないことが１番の要因だと思っています。

また、 react-dropzone や react-stepper-horizontal はダークモードに対応していないので追加でいい感じのスタイルを用意し、同じく `@media (prefers-color-scheme: dark)` のブロック内に追加しました。

react-dropzone 用
```css
@media (prefers-color-scheme: dark) {
  .dropzone {
    background-color: #444444;
  }
}
```

react-stepper-horizontal 用
```css
@media (prefers-color-scheme: dark) {
  .stepper > div > div > div > a {
    color: #EEEEEE !important;
  }
  .stepper > div > div > div > div > a,
  .stepper > div > div > div > div > span {
    color: #333333 !important;
  } 
}
```

## 参考

* React
  * [新しい React アプリを作る – React](https://ja.reactjs.org/docs/create-a-new-react-app.html)
  * [Code Splitting · Create React App](https://create-react-app.dev/docs/code-splitting)
  * [🎉React 16.8: 正式版となったReact Hooksを今さら総ざらいする - Qiita](https://qiita.com/uhyo/items/246fb1f30acfeb7699da#usecallback)
* アクセシビリティ
  * [role属性とaria-*属性（WAI-ARIA）について【HTML5 Advent Calendar 2012 Day 9】 - E-riverstyle Vanguard](http://blog.e-riverstyle.com/2012/12/roleariawaiariahtml5-advent-ca.html)
  * [HTML5 & CSS3 リファレンス - role属性　（要素の役割（WAI-ARIA））](https://www.osaka-kyoiku.ac.jp/~joho/html5_ref/role_attr.php?menutype=2dtaldl01l02l03A0)
  * [ARIA: tab role - Accessibility | MDN](https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/Roles/Tab_Role)
  * [WAI-ARIAを意識したタブパネルのマークアップを考えてみる【アクセシビリティ】【HTML5】 - E-riverstyle Vanguard](http://blog.e-riverstyle.com/2011/01/waiariahtml5.html)
  * [タブ切り替えを実装する時の注意点 | dkrkのブログ](https://www.dkrk-blog.net/a11y/tab)
  * [Google Lighthouseについて調べてみた vol.2 #lighthouse - ユアマイスター株式会社エンジニアブログ](https://yourmystar-engineer.hatenablog.jp/entry/2018/12/21/162529)
  * [HTML 本当は怖い target="_blank" 。rel="noopener" ってなに？ - かもメモ](https://chaika.hatenablog.com/entry/2018/12/06/110000)
* PWA
  * [create-react-appで作った雛形のコードがService Workerで何をしているのか - Qiita](https://qiita.com/pepo/items/9b25068a3123b99bcf18)
  * [Progressive Web App のデバッグ  |  Tools for Web Developers](https://developers.google.com/web/tools/chrome-devtools/progressive-web-apps?hl=ja)
  * [Build a Realtime PWA with React - Better Programming - Medium](https://medium.com/better-programming/build-a-realtime-pwa-with-react-99e7b0fd3270)
  * [React+PWAを最速で試してみた - Qiita](https://qiita.com/wktq/items/f9aa3496b57700db71eb)
  * [How to add an “Offline” notification to your PWA - Tyler Argo - Medium](https://medium.com/@tylerargo/how-to-add-an-offline-notification-to-your-pwa-c11ee640822b)
  * [Progressive Web Apps with React.js: Part 3 — Offline support and network resilience](https://medium.com/@addyosmani/progressive-web-apps-with-react-js-part-3-offline-support-and-network-resilience-c84db889162c)
  * [reactでオフラインでも実行可能なpwaの電卓を作ってみた │ どらごんテック](https://dragon-taro.com/college/post-767/)
  * [window.navigator.onLine - Web API | MDN](https://developer.mozilla.org/ja/docs/Web/API/NavigatorOnLine/onLine)
* ダークモード
  * [CSS3のメディアクエリを利用してwebサイトをダークモードに対応させる | Free Style](https://blanche-toile.com/web/dark-mode-css)
  * [Webサイトをダークモードに対応させよう | Webクリエイターボックス](https://www.webcreatorbox.com/tech/dark-mode)
  * [外部ファイルを読み込む！CSSで@importを使う方法 | TechAcademyマガジン](https://techacademy.jp/magazine/13018)
  * [Reactを使ったモジュラーCSS : CSS-in-JSとCSS Module | POSTD](https://postd.cc/modular-css-with-react/)
* その他
  * [JavaScriptでファイルダウンロード処理を実現する - Qiita](https://qiita.com/wadahiro/items/eb50ac6bbe2e18cf8813)
  * [Download JavaScript Data as Files on the Client Side | Shing's Blog](https://shinglyu.com/web/2019/02/09/js_download_as_file.html)
  * [Summary card — Twitter Developers](https://developer.twitter.com/en/docs/tweets/optimize-with-cards/overview/summary)
  * [File APIとCanvasでローカルの画像をアップロード→加工→ダウンロードする ｜ Tips Note by TAM](https://www.tam-tam.co.jp/tipsnote/javascript/post13538.html)
