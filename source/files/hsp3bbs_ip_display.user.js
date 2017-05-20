// ==UserScript==
// @name        HSP3_BBS_IP_address_display
// @description HSP3 BBS IP address display
// @namespace   http://www.sharkpp.net/
// @include     http://hsp.tv/play/pforum.php*
// @include     http://hsptv.sakura.ne.jp/play/pforum.php*
// @version     1.0
// ==/UserScript==

(function(){
	var items, item;

	str = document.body.innerHTML;

    ip_comment = str.match(/<!--[^-]+--><br><br>/g);

	items = document.evaluate(
		"//div[@*='info']",
		document,
		null,
		XPathResult.UNORDERED_NODE_SNAPSHOT_TYPE,
		null);

	for (var i = 0; i < items.snapshotLength; i++) {
		item = items.snapshotItem(i);
		// IP抜き出し
		ip = ip_comment[i].match(/[0-9.]+/g);
		// IPを表示する場所の項目を取得
		ii = item.getElementsByTagName("table");
		parent = ii[0].firstChild;
		// IP表示する項目を作成
		var oIP = document.createElement("tr");
		oIP.appendChild( document.createElement("td") );
		oIP.firstChild.setAttribute("width",	"130");
		oIP.firstChild.setAttribute("valign",	"middle");
		oIP.firstChild.setAttribute("bgcolor",	"white");
		oIP.firstChild.setAttribute("align",	"center");
		oIP.firstChild.appendChild( document.createElement("p") );
		oIP.firstChild.firstChild.appendChild( document.createTextNode( ip[0] ) );
		// 追加
		parent.appendChild( oIP );
	}

})();
