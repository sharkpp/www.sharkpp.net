// ==UserScript==
// @name        slashdot_jp_font_size_change
// @description slashdot jp font size change
// @namespace   http://www.sharkpp.net/
// @include     http://slashdot.jp/*
// @version     1.0
// ==/UserScript==

(function(){

	modify_item("//body", "font-size:small");
	
	//------------------------
	// function
	
	function hide_item(xpath)
	{
		modify_item(xpath, "display: none");
	}

	function modify_item(xpath, style)
	{
		var items, item;

		items = document.evaluate(
			xpath,
			document,
			null,
			XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,
			null);

		for (var i = 0; i < items.snapshotLength; i++) {
			item = items.snapshotItem(i);
			item.setAttribute("style", style);
		}
	}

})();
