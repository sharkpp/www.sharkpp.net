// ==UserScript==
// @name        Add_backup_link_For_Pukiwiki
// @description Add backup link For Pukiwiki
// @namespace   http://www.sharkpp.net/
// @include     http://*.land.to/*
// @include     http://hspdev-wiki.net/*
// @include     http://*.wikiwiki.jp/*
// @include     http://wikiwiki.jp/*
// @version     1.0
// ==/UserScript==

(function(){

	items = document.evaluate(
		"//span[@class='noexists']",
		document,
		null,
		XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,
		null);

	for (var i = 0; i < items.snapshotLength; i++) {
		item = items.snapshotItem(i);

		var url = item.lastChild.getAttribute('href').replace('?cmd=edit', '?cmd=backup');
		var olink = document.createElement('a');
		olink.setAttribute("href", url);
		olink.setAttribute("title", "backup");
		olink.appendChild(document.createTextNode("B"));
		item.appendChild(document.createTextNode(" "));
		item.appendChild(olink);
	}

})();
