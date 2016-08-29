---
title: "JSDoc 3 用のプラグインをまとめてみた"
date: 2016-08-30 01:00
tags: [JSDoc, JavaScript]
categories: [まとめ]

---

世の中には「ソースコードが仕様書」という話を聞いたりします。

まあ、ソースコードと仕様書を同期して更新するなんて大変ですよね。

そこで、誰が考えたのか、まさにソースコードから仕様書を作るツールが [Doxygen](http://www.stack.nl/~dimitri/doxygen/) や [JSDoc](http://usejsdoc.org/) などになります。

先に上がった JSDoc は JavaScript 専用のドキュメント生成ツールですが、どうやらプラグイン機能があるとのことで、標準添付のプラグインの情報すら日本語のものはなさそうだったので簡単に調べてまとめてみました。

## プラグインの使い方

基本的には [Use JSDoc: About JSDoc plugins](http://usejsdoc.org/about-plugins.html) に書かれているように、JSDoc の設定ファイル `jsdoc.json` に

```JSON
{
    "plugins": ["plugins/shout"]
}
```

みたいな感じに書けば利用可能となるようです。

自分で作りたい場合は、同じく  [Use JSDoc: About JSDoc plugins](http://usejsdoc.org/about-plugins.html) の **Event Handlers** や **Tag Definitions** などを見ながら作ればいいのではないかと思います。

## 標準添付(非実用プラグイン)

標準添付されているプラグインの中には、サンプルや開発用のプラグインも含まれています。

### commentConvert.js

beforeParse イベントのサンプルプラグイン。

これは、非実用的なプラグインのようです。

### shout.js

newDoclet イベントのサンプルプラグイン。

これは、非実用的なプラグインのようです。

### eventDumper.js

コンソールにパーサーイベントに関する情報をダンプするプラグイン。

これは、開発に利用するための非実用的なプラグインのようです。

## 標準添付(実用プラグイン)

標準添付された様々な機能を持つプラグイン

### commentsOnly.js

JavaScript 以外の言語で書かれたソースに含まれる JSDoc 形式のコメント以外を削除することで、ドキュメント化することができるようになるプラグイン。

### escapeHtml.js

ドキュメント中に含まれる HTML タグをエスケープするプラグイン。

### markdown.js

Markdown 記法で書かれたコメント内のテキストを HTML に変換できるようにするプラグイン。

[Use JSDoc: Using the Markdown plugin](http://usejsdoc.org/plugins-markdown.html) に使い方が載っています。

### overloadHelper.js

自動的にオーバーロード関数やメソッドの長い名前に署名のような文字列を追加するプラグイン。

### partial.js

`@partial FILENAME` とすることで、`FILENAME` をそこに読み込むプラグイン。

### railsTemplate.js

.erb ファイル (Rails の HTML テンプレートファイル) から Rails のテンプレートタグを除去するプラグイン。

### sourcetag.js

`@source { "filename": "sourcetag.js", "lineno": 13 }` のような感じで、ファイルの現在位置に関するメタ情報を更新できるプラグイン。

### summarize.js

説明が不足している場合に要約を自動生成するプラグイン。

### underscore.js

`_` から始まる JSDoc コメントの全ての属性を private に変更するプラグイン。

## npm に登録されているもの

### ub-jsdoc

npm ページ：[ub-jsdoc](https://www.npmjs.com/package/ub-jsdoc)

godoc にインスパアされたテーマ＆プラグイン。

### jsdoc-codesnippet

npm ページ：[jsdoc-codesnippet](https://www.npmjs.com/package/jsdoc-codesnippet)

名前をつけたコードスニペットをドキュメントに含めることができるようになるプラグイン。

### jsdoc-vue

npm ページ：[jsdoc-vue](https://www.npmjs.com/package/jsdoc-vue)

`*.vue` ファイル (Vueify 用のファイル) を解析できるようにするプラグイン。

### jsdoc-plugins

npm ページ：[jsdoc-plugins](https://www.npmjs.com/package/jsdoc-plugins)

いろんなタグを実装したプラグイン。

### jsdoc-babel

npm ページ：[jsdoc-babel](https://www.npmjs.com/package/jsdoc-babel)

JavaScript ファイルの解析前に [Babel](https://babeljs.io/) で事前処理を行うプラグイン。

### jsdoc-riot

npm ページ：[jsdoc-riot](https://www.npmjs.com/package/jsdoc-riot)

Riot タグファイルのサポートを追加するプラグイン。

### jsdoc-ignore-future

npm ページ：[jsdoc-ignore-future](https://www.npmjs.com/package/jsdoc-ignore-future)

### jsdoc-escape-at

npm ページ：[jsdoc-escape-at](https://www.npmjs.com/package/jsdoc-escape-at)

コメント中の @ をエスケープするプラグイン？

### jsdoc-plugin-named-defaults

npm ページ：[jsdoc-plugin-named-defaults](https://www.npmjs.com/package/jsdoc-plugin-named-defaults)

引数のデフォルト値をコード中から拾ってくるプラグイン？

### jsdoc-jsx

npm ページ：[jsdoc-jsx](https://www.npmjs.com/package/jsdoc-jsx)

(Facebook の) JSX ファイルのサポートを追加するプラグイン。

### jsdoc-plugin-strip-outer-iife

npm ページ：[jsdoc-plugin-strip-outer-iife](https://www.npmjs.com/package/jsdoc-plugin-strip-outer-iife)

一番外側の IIFE (Immediately-invoked function expression：即時実行関数式) を除去するプラグイン。

### jsdoc-bem

npm ページ：[jsdoc-bem](https://www.npmjs.com/package/jsdoc-bem)

[BEM](https://en.bem.info/methodology/js/) の要素のサポートを追加するプラグイン？

### bouquet

npm ページ：[bouquet](https://www.npmjs.com/package/bouquet)

有用なプラグインを集めたプラグイン。

## 参考

* [Use JSDoc: About JSDoc plugins](http://usejsdoc.org/about-plugins.html)
* [results for jsdoc](https://www.npmjs.com/search?q=jsdoc)
