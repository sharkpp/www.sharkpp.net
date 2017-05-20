// ==UserScript==
// @name        doxygen_jp_sample_redirect
// @description doxygen.jp sample redirect to doxygen.org
// @namespace   http://www.sharkpp.net/
// @include     http://www.doxygen.jp/examples/*
// @version     1.0
// ==/UserScript==

(function (){
	var href = location.href.split('/');
	href[2] = 'www.doxygen.org';
	location.href = href.join('/');
})();
