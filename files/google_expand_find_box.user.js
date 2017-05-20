// ==UserScript==
// @name        GoogleExpandFindBox
// @description Google Expand Find Box
// @namespace   http://www.sharkpp.net/
// @include     http://*.google.co.jp/*
// ==/UserScript==

(function(){
	var items = document.getElementsByName('q');
	for (i=0; i<items.length; i++){
		items[i].size = "100";
	}
})();
