---
title: "サクラエディタ用テキスト変換拡張パックを公開"
date: 2015-09-05 14:00
tags: [ サクラエディタ, サクラエディタ用プラグイン ]
categories: [ サクラエディタ ]

---

サクラエディタ用のプラグインとして「テキスト変換拡張パック」を作りました。

ダウンロードは [GitHub ページ](https://github.com/sharkpp/sakura-editor-plugin-text-convert-extension-pack) からできます。

このプラグインでは選択した文字列に対して

* アッパーキャメルケース(UpperCamelCase)に変換
* ローワーキャメルケース(lowerCamelCase)に変換
* スネークケース(snake_case)に変換
* チェインケース(chain-case)に変換
* 単語の頭を大文字に変換
* 頭を大文字に変換
* 頭を小文字に変換

と、このような変換を行った文字列へと置き換えることができます。

## 機能一覧

現在、このプラグインでは次のことができます。

### アッパーキャメルケース(UpperCamelCase)に変換

選択された文字列をアッパーキャメルケースに変換します。

例として `upper camel case` という文字列を選択していた場合 `UpperCamelCase` に変換されます。

### ローワーキャメルケース(lowerCamelCase)に変換

選択された文字列をローワーキャメルケースに変換します。

例として `lower camel case` という文字列を選択していた場合 `lowerCamelCase` に変換されます。

### スネークケース(snake_case)に変換

選択された文字列をスネークケースに変換します。

例として `snake case` という文字列を選択していた場合 `snake_case` と変換されます。

### チェインケース(chain-case)に変換

選択された文字列をチェインケースに変換します。

例として `chain case` という文字列を選択していた場合 `chain-case` と変換されます。

### 単語の頭を大文字に変換

選択された文字列の単語の頭を大文字に変換します。

例として `upper camel words` という文字列を選択していた場合 `Upper Camel Words` と変換されます。

### 頭を大文字に変換

選択された文字列の頭を大文字に変換します。

例として `upper camel first` という文字列を選択していた場合 `Upper camel first` と変換されます。

### 頭を小文字に変換

選択された文字列の頭を小文字に変換します。

例として `Lower Camel First` という文字列を選択していた場合 `lower Camel First` と変換されます。




