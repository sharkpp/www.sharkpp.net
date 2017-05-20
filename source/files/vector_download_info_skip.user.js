// ==UserScript==
// @name        VectorDownloadInfoSkip
// @description Vector download info skip
// @namespace   http://www.sharkpp.net/
// @include     http://www.vector.co.jp/*
// @version     1.0
// ==/UserScript==

(function(){
	var key = "vucount";
	var val = "1";
	var tmp = key + "=" + escape(val) + "; ";
	// tmp += "path=" + location.pathname + "; ";
	tmp += "expires=Tue, 31-Dec-2030 23:59:59; ";
	document.cookie = tmp;
})();
