// ==UserScript==
// @name        gigazine_auto_continue
// @description GIGAZINE auto continue
// @namespace   http://www.sharkpp.net/
// @include     http://gigazine.net/*
// @version     1.0
// ==/UserScript==

(function (){
	var url = location.href;
	if( -1 == url.indexOf('index.php?/news/comments/') &&
		0  <  url.indexOf('index.php?/news/') ) {
		location.href = url.replace('index.php?/news/', 'index.php?/news/comments/');
	}
})();
