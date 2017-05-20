// ==UserScript==
// @name        GoogleEnlargeResult
// @description Google enlarge result
// @namespace   http://www.sharkpp.net/
// @include     http://www.google.*/search*
// @version     1.0
// ==/UserScript==

(function(){
	var items, item;

	items = document.evaluate(
		"//td[@class='j']",
		document,
		null,
		XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,
		null);

	for (var i = 0; ( item = items.snapshotItem(i) ); i++) {
		item.setAttribute("style", "width: 50em"); // 34em -> 
	}
	
})();
