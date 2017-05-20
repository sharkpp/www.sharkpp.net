// ==UserScript==
// @name           HSPプログラムコンテスト2008ロゴ差し替え
// @namespace      http://www.sharkpp.net/
// @include        http://hsp.tv/contest2008/*
// ==/UserScript==



(function(){

	items = document.evaluate(
		"//img[@src='../images/contest2008/top_img.jpg']",
		document,
		null,
		XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,
		null);

	for (var i = 0; i < items.snapshotLength; i++) {
		var item = items.snapshotItem(i);

		item.setAttribute("src", "http://hsp.tv/images/contest2008/bana_l.jpg");
	}

})();

