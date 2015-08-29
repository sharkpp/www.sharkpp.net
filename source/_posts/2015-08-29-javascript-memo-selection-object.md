---
title: "JavaScript の選択範囲関連のメモ"
date: 2015-08-29 23:00
tags: [メモ,JavaScript,Userscript]
categories: [ブログ]

---

以前に作った [calculation of selection length](https://greasyfork.org/ja/scripts/9647-calculation-of-selection-length) (ソースは[GitHub](https://github.com/sharkpp-userscripts/calculation-of-selection-length)) を作る時に内容は選択された文字列の扱い関連について調べたことをメモメモです。
Chrome でのみ確認している。

## 選択文字数を取得

選択範囲は `document.getSelection()` または `window.getSelection()` で取得できる。

取得できるのは `Selection` オブジェクトなので、

```bash
var selectionLen = String(document.getSelection()).length;
```

の用な感じで `String` に変換してから取得する。

## 選択の変更をイベントで取得

どうやら標準ではないっぽいけど `onselectionchange` というイベントがあるみたい。

```bash
document.addEventListener("selectionchange", function(e){ console.log(e); }, false);
```

## 選択範囲の絶対位置を取得

絶対位置を取得は、

```bash
var getSelectionBoundingRect = function() {
  var rect = { left: 0, top: 0, right: 0, bottom: 0 };
  var selAll = document.getSelection();
  for (var i = 0; i < selAll.rangeCount; ++i) {
    var rect_ = selAll.getRangeAt(i).getBoundingClientRect();
    if (rect_.left  < rect.left)    rect.left   = rect_.left;
    if (rect_.top   < rect.top)     rect.top    = rect_.top;
    if (rect.right  < rect_.right)  rect.right  = rect_.right;
    if (rect.bottom < rect_.bottom) rect.bottom = rect_.bottom;
  }
  rect.width  = rect.right - rect.left;
  rect.height = rect.bottom - rect.top;
  rect.left  += window.pageXOffset;
  rect.top   += window.pageYOffset;
  rect.right += window.pageXOffset;
  rect.bottom+= window.pageYOffset;
  return selAll.rangeCount ? rect : null;
};
```

こんな感じ。

## 参考

* [範囲選択されている文字列を得る - JavaScript TIPSふぁくとりー](http://www.nishishi.com/javascript/2013/get-selection-length.html)
* [selection - Web API インターフェイス | MDN](https://developer.mozilla.org/ja/docs/Web/API/Selection)
* [onselectionchange event | selectionchange event JavaScript](http://help.dottoro.com/ljixpxji.php)
* [TextNodeにも使えるgetBoundingClientRect - gifnksmの雑多なメモ](http://gifnksm.hatenablog.jp/entry/20101007/1286419969)
