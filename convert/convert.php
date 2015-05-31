<?php

require_once(dirname(__FILE__) . '/vendor/autoload.php');

function scandir_r($path = '', &$name = array() )
{
	$path = $path == ''? dirname(__FILE__) : $path;
	$lists = @scandir($path);
	if (!empty($lists)) {
		foreach ($lists as $f) { 
			if (is_dir($path.'/'.$f) && $f != ".." && $f != ".") {
				scandir_r($path.'/'.$f, $name); 
			} else if (!is_dir($path.'/'.$f)) {
				$name[] = $path.'/'.$f;
			}
		}
	}
	return $name;
}

function text2entities($text)
{
	return preg_replace_callback('/./u', function($m){
				$s = $m[0];
				$len = strlen($s);
				switch ($len) {
				case 1: return $s;
				case 2: return '&#'.(((ord($s[0])&0x1F)<<6)|(ord($s[1])&0x3F)).';';
				case 3: return '&#'.(((ord($s[0])&0xF)<<12)|((ord($s[1])&0x3F)<<6)|(ord($s[2])&0x3F)).';';
				case 4: return '&#'.(((ord($s[0])&0x7)<<18)|((ord($s[1])&0x3F)<<12)|((ord($s[2])&0x3F)<<6)|(ord($s[3])&0x3F)).';';
				case 5: return '&#'.(((ord($s[0])&0x3)<<24)|((ord($s[1])&0x3F)<<18)|((ord($s[2])&0x3F)<<12)|((ord($s[3])&0x3F)<<6)|(ord($s[4])&0x3F)).';';
				case 6: return '&#'.(((ord($s[0])&0x1)<<30)|((ord($s[1])&0x3F)<<24)|((ord($s[2])&0x3F)<<18)|((ord($s[3])&0x3F)<<12)|((ord($s[4])&0x3F)<<6)|(ord($s[5])&0x3F)).';';
				}
				return $s;
			}, $text);
}

function entities2text($text)
{
	return
		preg_replace_callback('/&#([0-9]+);/u', function($m){
				$u = intval($m[1]);
				     if (0x00000000 <= $u && $u <= 0x0000007F) { return chr($u); }
				else if (0x00000080 <= $u && $u <= 0x000007FF) { return chr(0xC0|($u>>6)).chr(0x80|($u&0x3F)); }
				else if (0x00000800 <= $u && $u <= 0x0000FFFF) { return chr(0xE0|($u>>12)).chr(0x80|(($u>>6)&0x3F)).chr(0x80|($u&0x3F)); }
				else if (0x00010000 <= $u && $u <= 0x001FFFFF) { return chr(0xF0|($u>>18)).chr(0x80|(($u>>12)&0x3F)).chr(0x80|(($u>>6)&0x3F)).chr(0x80|($u&0x3F)); }
				else if (0x00200000 <= $u && $u <= 0x03FFFFFF) { return chr(0xF8|($u>>24)).chr(0x80|(($u>>18)&0x3F)).chr(0x80|(($u>>12)&0x3F)).chr(0x80|(($u>>6)&0x3F)).chr(0x80|($u&0x3F)); }
				else if (0x04000000 <= $u && $u <= 0x04000000) { return chr(0xFC|($u>>30)).chr(0x80|(($u>>24)&0x3F)).chr(0x80|(($u>>18)&0x3F)).chr(0x80|(($u>>12)&0x3F)).chr(0x80|(($u>>6)&0x3F)).chr(0x80|($u&0x3F)); }
				return $s;
			}, $text);
}

function ucwords_($string) 
{ 
	return
		mb_convert_encoding(
			ucwords(
				mb_convert_encoding($string, 'UTF-7','UTF-8')
			),
			'UTF-8', 'UTF-7'); 
} 

$cp = array();
$redirect = array();
$redirect["pokecom/pclink.html"] = 'blog/categories/%E3%83%9D%E3%82%B1%E3%82%B3%E3%83%B3%E3%83%AA%E3%83%B3%E3%82%AF';
$redirect["junk/sakura-editor.html"] = 'blog/categories/%E3%82%B5%E3%82%AF%E3%83%A9%E3%82%A8%E3%83%87%E3%82%A3%E3%82%BF';
$redirect["pokecom/lecture.html"] = 'blog/categories/%E3%83%9D%E3%82%B1%E3%82%B3%E3%83%B3%E8%AC%9B%E5%BA%A7';
$redirect["gallery/icon.html"] = 'graffiti';
$redirect["junk/spal.html"] = 'blog/categories/SpoilerAL';
$redirect["hsp/plugin.html"] = 'blog/categories/HSP%E3%83%97%E3%83%A9%E3%82%B0%E3%82%A4%E3%83%B3';
$redirect["pokecom/program.html"] = 'blog/categories/%E3%83%9D%E3%82%B1%E3%82%B3%E3%83%B3%E7%94%A8%E3%83%97%E3%83%AD%E3%82%B0%E3%83%A9%E3%83%A0';
$redirect["pokecom.html"] = 'blog/categories/%E3%83%9D%E3%82%B1%E3%82%B3%E3%83%B3';
$redirect["php.html"] = 'blog/categories/php';
$redirect["junk/uwsc.html"] = 'blog/categories/uwsc';
$redirect["junk.html"] = 'blog/categories/%E3%81%8C%E3%82%89%E3%81%8F%E3%81%9F';
$redirect["junk/patch.html"] = 'blog/categories/%E3%83%91%E3%83%83%E3%83%81';
$redirect["junk/greasemonkey.html"] = 'blog/categories/greasemonkey';
$redirect["soft/game.html"] = 'blog/categories/%E3%82%BD%E3%83%95%E3%83%88';
$redirect["hsp/module.html"] = 'blog/categories/HSP%E3%83%A2%E3%82%B8%E3%83%A5%E3%83%BC%E3%83%AB';
$redirect["pokecom/game.html"] = 'blog/categories/%E3%83%9D%E3%82%B1%E3%82%B3%E3%83%B3%E7%94%A8%E3%82%B2%E3%83%BC%E3%83%A0';
$redirect["gallery.html"] = 'graffiti';
$redirect["gallery/graffiti.html"] = 'graffiti';
$redirect["php/frog-cms.html"] = 'blog/categories/Frog%20CMS';
$redirect["hsp.html"] = 'blog/categories/HSP';
$redirect["hsp/tool.html"] = 'blog/categories/HSP%E7%94%A8%E3%83%84%E3%83%BC%E3%83%AB';
$redirect["php/rhaco.html"] = 'blog/categories/rhaco';
$redirect["soft/tool.html"] = 'blog/categories/%E3%83%84%E3%83%BC%E3%83%AB';
$redirect["gallery/scenery.html"] = 'graffiti';
$redirect["php/library.html"] = 'blog/categories/php';
$redirect["hsp/openhsp.html"] = 'blog/categories/HSP';
$redirect["hobby.html"] = 'blog/categories';
$redirect["history.html"] = 'blog';
$redirect["history/2004.html"] = 'blog';
$redirect["history/2005.html"] = 'blog';
$redirect["history/2006.html"] = 'blog';
$redirect["history/2007.html"] = 'blog';
$redirect["history/2008.html"] = 'blog';
$redirect["history/2009.html"] = 'blog';
$redirect["history/2010.html"] = 'blog';
$redirect["history/2011.html"] = 'blog';

$path_replace = array();
$tmp = @ file_get_contents('last_htaccess.txt');
$tmp = str_replace("\r", "\n", str_replace("\r\n", "\n", $tmp));
foreach (explode("\n", $tmp) as $line) {
	if (preg_match('!Redirect permanent /([^\s]+)\s+http://[^/]+/(.+)!', $line, $m))
		$path_replace[$m[1]] = $m[2];
}

$base_path = 'html';
$files = scandir_r($base_path);
foreach ($files as $path) {
	if (!preg_match('!\.html$!', $path))
		continue;
	if (preg_match('!index\.html!', $path) ||
		preg_match('!/history/.+$!', $path) ||
		preg_match('!/hobby\.html+$!', $path))
		continue;
	if (is_dir(str_replace('.html', '', $path))) // ディレクトリ名と同じファイル名の場合は無視する
		continue;

	$dpath = preg_replace('!^[^/]+/(.+)\..+$!', 'markdown/\1.md', $path);
	$dpath = str_replace('.html.md', '.md', $dpath);
	$dpath = dirname($dpath) .'/'. str_replace('_', '-', basename($dpath));
	$curpath = preg_replace('!^[^/]+/(.+)\..+$!', '\1.html', $path);
	$html = file_get_contents($path);

	$dpath = str_replace('openhsp/nightly','openhsp-nightly', $dpath);
	$dpath = str_replace('hsp/tool','hsp/hsptool', $dpath);
	$dpath = str_replace('php/library','php', $dpath);
	$dpath = preg_replace('!pokecom/([^/]+)/([^/]+)!','pokecom/$1/pokecom-$1-$2', $dpath);
	$dpath = preg_replace('!pokecom/([^/]+)!','pokecom/pokecom-$1', $dpath);
	$dpath = preg_replace('!pokecom-pclink!','pokecom-link', $dpath);
	$dpath = preg_replace('!junk/([^/]+)/([^/]+)$!','junk/$1/$1-$2', $dpath);
	$dpath = preg_replace('!php/([^/]+)/([^/]+)$!','php/$1/$1-$2', $dpath);
	$dpath = preg_replace('!/link/([^/]+)!','/link/link-$1', $dpath);
	$dpath = preg_replace('!soft/(susie|abc|cotton)/!','soft/$1/$1-', $dpath);
	$dpath = preg_replace('!soft/(tptool)/!','soft/$1/terapad-', $dpath);
	$dpath = preg_replace('!hsp/([^/]+)/([^/]+)$!','hsp/$1/hsp-$2', $dpath);

	$tags = array();
	$categories = array();

	// カテゴリ取得
	$tmp = explode('/', dirname($dpath));
	array_shift($tmp);
	if (1 < count($tmp) && 'blog' == $tmp[0]) {
		$categories[] = $tmp[0];
	} else {
		$categories = $tmp;
	}
	foreach ($categories as & $k) {
		if ('blog'    == $k) { $k = 'ブログ'; }
		if ('history' == $k) { $k = '更新履歴'; }
		if ('hsp'     == $k) { $k = 'HSP'; $tags[] = 'HSP'; }
		if ('tool'    == $k) { $k = 'ツール'; }
		if ('soft'    == $k) { $k = 'ソフト'; }
		if ('junk'    == $k) { $k = 'がらくた'; }
		if ('php'     == $k) { $k = 'php'; $tags[] = 'php'; }
		if ('pokecom' == $k) { $k = 'ポケコン'; $tags[] = 'ポケコン'; }
		if ('link'    == $k) { $k = 'リンク'; }
		if ('tptool'  == $k) { $k = 'TeraPad'; $tags[] = 'TeraPad'; }
		if ('sakura-editor' == $k) { $k = 'サクラエディタ'; }
		if ('frog-cms' == $k) { $k = 'Frog CMS'; $tags[] = 'Frog CMS'; }
		if ('plugin' == $k) { $k = 'HSPプラグイン'; $tags[] = 'HSP'; }
		if ('hsptool' == $k) { $k = 'HSP用ツール'; $tags[] = 'HSP'; }
		if ('module' == $k) { $k = 'HSPモジュール'; $tags[] = 'HSP'; }
		if ('pokecom-pclink' == $k) { $k = 'ポケコンリンク'; $tags[] = 'ポケコン'; }
		if ('pokecom-link' == $k) { $k = 'ポケコンリンク'; $tags[] = 'ポケコン'; }
		if ('pokecom-program' == $k) { $k = 'ポケコン用プログラム'; $tags[] = 'ポケコン'; }
		if ('pokecom-game' == $k) { $k = 'ポケコン用ゲーム'; $tags[] = 'ポケコン'; }
		if ('pokecom-lecture' == $k) { $k = 'ポケコン講座'; $tags[] = 'ポケコン'; }
		if ('spal' == $k) { $k = 'SpoilerAL'; }
		if ('patch' == $k) { $k = 'パッチ'; }
		if ('abc' == $k) { $k = 'A to B Converter'; }
		if ('susie' == $k) { $k = 'Susie'; }
		if ('rhaco' == $k) { $tags[] = 'rhaco'; }
		if ('greasemonkey' == $k) { $k = 'greasemonkey'; $tags[] = 'greasemonkey'; $tags[] = 'userscript'; }
	}

	// タグ取得
	if (preg_match('!advent-calendar-!', $dpath)) { $tags[] = 'Advent Calendar'; }
	if (preg_match('!pc-g850!', $dpath)) { $tags[] = 'ポケコン'; }
	if (preg_match('|<!-- tags: \[(.+?)\] -->|', $html, $m)) {
		$tags = array_merge($tags, explode(',', str_replace('rhaco rhaco2', 'Rhaco,Rhaco2', $m[1])));
		foreach ($tags as & $k)
			$k = trim($k);
	}
	foreach ($tags as & $k) {
		$k = ucwords_(mb_strtolower($k, 'UTF-8'));
		$k = preg_replace('/^php$/i', 'php', $k);
		$k = preg_replace('/^fuelphp$/i', 'FuelPHP', $k);
		$k = preg_replace('/^OpenHSP$/i', 'OpenHSP', $k);
		$k = preg_replace('/^Hsp(.*)$/i', 'HSP$1', $k);
		$k = preg_replace('/^Hot Soup Processor$/i', 'HSP', $k);
		$k = preg_replace('/^qtquick$/i', 'QtQuick', $k);
		$k = preg_replace('/^qml$/i', 'QML', $k);
		$k = preg_replace('/vmware/i', 'WMware', $k);
		$k = preg_replace('/^x64$/i', 'x64', $k);
		$k = preg_replace('/^Vc\+\+$/i', 'VC++', $k);
		$k = preg_replace('/^g\+\+$/i', 'g++', $k);
		$k = preg_replace('/^Cc1plus$/i', 'cc1plus', $k);
		$k = preg_replace('/^git$/i', 'git', $k);
		$k = preg_replace('/Frog/i', 'Frog', $k);
		$k = preg_replace('/^Frog$/i', 'Frog CMS', $k);
		$k = preg_replace('/cms/i', 'CMS', $k);
		$k = preg_replace('/^QNAP$/i', 'QNAP', $k);
		$k = preg_replace('/^NAS$/i', 'NAS', $k);
		$k = preg_replace('/^pcbsoft$/i', 'pcbsoft', $k);
		$k = preg_replace('/^pcbnet(.*)$/i', 'pcbnet$1', $k);
		$k = preg_replace('/^HSPsocka$/i', 'hspsockA', $k);
		$k = preg_replace('/^github$/i', 'GitHub', $k);
		$k = preg_replace('/^TeraTerm$/i', 'TeraTerm', $k);
		$k = preg_replace('/^Terapad$/i', 'TeraPad', $k);
		$k = preg_replace('/^Winscp$/i', 'WinSCP', $k);
		$k = preg_replace('/^Hsed3$/i', 'hsed3', $k);
		$k = preg_replace('/^rhaco(.*)$/i', 'rhaco$1', $k);
	}
	if (false !== strpos($dpath, 'happy-new-year-'))
		$tags[] = ucwords_(strtolower('HAPPY NEW YEAR'));
	if (false !== strpos($dpath, 'new-years-eve'))
		$tags[] = '大晦日';
	if (array_search('Greasemonkey', $tags))
		$tags[] = 'Userscript';
	$tags = array_unique($tags);

	// 公開日付を取得
	$pub_date = '';
	if (preg_match('!-- published: (.+?) --!', $html, $m)) {
		$pub_date = $m[1].':00';
		// URLと公開日が違ったら公開日にあわせる
		$tmp = str_replace('-', '/', substr($pub_date, 0, 10));
		if (preg_match('!(.+?/)([0-9]{4}/[0-9]{2}/[0-9]{2})(/.+)$!', $dpath, $m) &&
			$tmp != $m[2]) {
			$dpath = $m[1].$tmp.$m[3];
		}
		// 固定ページも日付を付ける
		if (!preg_match('!/blog/!', $dpath)) // ブログ記事以外
		{
			$dpath = sprintf('markdown/_statics/%s-%s', substr($pub_date, 0, 10), basename($dpath));
		}
	}
	
	$permalink = '';
	if (!preg_match('!(.+?/)blog/([0-9]{4}/[0-9]{2}/[0-9]{2})(/.+)$!', $dpath) &&
		preg_match('!^(.+?/)(.+)\.md$!', $dpath, $m)) {
		$permalink = $m[2] . '/index.html';
	}

	// コンテンツの中身が取り出せるか？
	if (!preg_match('|<div id="contents">(.+)<p class="info" style="margin-top: 1em">.+' .
	                 '</div><!-- #contents end -->|ms', $html, $m))
	{
		echo sprintf('skip %s', $path).PHP_EOL;
		continue;
	}
	$html = $m[1];

	// fix bloken
	$html = preg_replace('|<em>(-user\.jp.+?)</em>(-)|ms', '$1$2', $html);
	$html = preg_replace('| slt="|ms', ' alt="', $html);
	$html = preg_replace('| slt="|ms', ' alt="', $html);

	// fix link
	$html = preg_replace('!(http://www.sharkpp.net/)/!', '$1', $html);
	$html = preg_replace('!href="http://www.sharkpp.net/blog/([0-9]{4})/([0-9]{2})/([0-9]{2})/(.+?)\.html"!', 'href="/blog/$1/$2/$3/$4.html"', $html);
	$html = preg_replace('!href="/blog/([0-9]{4})/([0-9]{2})/([0-9]{2})/(.+?)\.html"!', 'href="/blog/$1/$2/$3/$4.html"', $html);
	$html = preg_replace('!href="(/blog/.+?\.html)\.html"!', 'href="$1"', $html);
	$html = preg_replace_callback('!href="/blog/([0-9]{4})/([0-9]{2})/([0-9]{2})/(.+?)"!',
                function($m) { return 'href="/blog/'.$m[1].'/'.$m[2].'/'.$m[3].'/'.str_replace('_', '-', $m[4]).'"'; }, $html);
//	$html = preg_replace('!href="http://www.sharkpp.net/(.+?)\.html"!', 'href="/$1"', $html);
	$html = preg_replace('!href="http://www.sharkpp.net/(.+?)"!', 'href="/$1"', $html);
	$html = preg_replace('!src="http://www.sharkpp.net/(.+?)"!', 'src="/$1"', $html);
	$html = preg_replace('!"(julius\.sourceforge\.jp/)"!', '"http://$1"', $html);
	$html = preg_replace('!"\[http!', '"http', $html);
	$html = preg_replace('!pokecom/program/\.\./lecture!', 'pokecom/lecture', $html);
	$html = preg_replace('!hsp/plugin/\.\./pcbsoft!', 'hsp/pcbsoft', $html);

	$html = preg_replace('!href="/blog/2011/10/02/(.+?)"!', 'href="/blog/2011/10/30/$1"', $html);
	$html = preg_replace('!href="/blog/2010/01/01/(.+?2011.+?)"!', 'href="/blog/2011/01/01/$1"', $html);
	$html = preg_replace('!href="/blog/2012/01/01/(.+?)"!', 'href="/blog/2012/01/05/$1"', $html);

	$html = preg_replace('!"/[^"]+?/([^/"]+?\.(zip|lzh|txt|h|c|hsp|as|js|reg|uws))"!ms', '"/files/$1"', $html);

	$html = str_replace('google_trands_insert_graph.png', 'google_trends_insert_graph.png', $html);

	// fix image
	$html = preg_replace('!<a +href="([^/h][^"]+)"[^>]+?title="(.+?)".*?><img src="([^/h][^"]+)"[^>]+?alt="(.+?)".*?/></a>!',
	                     '<a href="/'.dirname($curpath).'/$1"><img src="/'.dirname($curpath).'/$3" title="$4" /></a>', $html);
	$html = preg_replace('!<a +href="/([^"]+)"[^>]+?title="(.+?)".*?><img src="/([^"]+)"[^>]+?alt="(.+?)".*?/></a>!',
	                     '<a href="/$1"><img src="/$3" alt="$4" /></a>', $html);
	$html = preg_replace('!<img src="([^"]+?)".+?alt="(.+?)".*?/>!',
	                     '<img src="$1" alt="$2" />', $html);
	$html = preg_replace('!http://www.sharkpp.net/image!', 'http://www.sharkpp.net/images', $html);
	$html = preg_replace('!"(\.\./image|image)/(c|basic)\.gif"!', '"/pokecom/image/$2.gif"', $html);
	$html = preg_replace('!"(image/(banner|sougo)\.gif)"!', '"/$1"', $html);

	$html = preg_replace('!<div class="section">(.+?)</div>!ms', '$1', $html);
	$html = preg_replace('!<div class="footnote">(.+?)</div>!ms', '$1', $html);
	$html = preg_replace('!<div>\s*<p>\s*(.+?)\s*</p>\s*</div>!ms', '<p>$1</p>', $html);
//	$html = preg_replace('!<dl class="page_history">!ms', '<dl class="dl-horizontal">', $html);

	$html = preg_replace('!<img src="[^"]+?/ent\.gif".+?alt="[^"]+?" />!', 'xxxx-fa-reply-fa-flip-vertical-xxxx', $html);

	$html = text2entities($html);
//	$md = new Markdownify\Converter(Markdownify\Converter::LINK_AFTER_PARAGRAPH);
	$md = new Markdownify\ConverterExtra(Markdownify\ConverterExtra::LINK_AFTER_PARAGRAPH);
	$markdown = $md->parseString($html.PHP_EOL);
	unset($md);

	// イメージ移動
	$markdown = preg_replace_callback('!([ "])/([^"[]+?\.(jpg|gif|png))!ms', function($m) use (& $cp, $dpath, $curpath) {
			$page_date = '';
			if (preg_match('!^(.+?)/([0-9]{4})/([0-9]{2})/([0-9]{2})/[^/]+?$!', $curpath, $mm)) {
				$page_date = $mm[2].'_'.$mm[3].$mm[4].'_';
			} else if (preg_match('!^(.+?)/([0-9]{4})-([0-9]{2})-([0-9]{2})-.+?$!', $dpath, $mm)) {
				$page_date = $mm[2].'_'.$mm[3].$mm[4].'_';
			}
			if (preg_match('!^(.+?)/([0-9]{4})_?([0-9]{2})([0-9]{2})_([^/]+)$!', $m[2], $mm)) {
				$dst = sprintf('/images/%s_%s%s_%s', $mm[2], $mm[3], $mm[4], $mm[5]);
			} else if (preg_match('!link/!', $m[2])) {
				$dst = sprintf('/images/link-%s', basename($m[2]));
			} else if (preg_match('!pokecom/image/.+?\.gif!', $m[2])) {
				$dst = sprintf('/images/pokecom-%s', basename($m[2]));
			} else if (preg_match('!^image/!', $m[2])) {
				$dst = sprintf('/images/%s', basename($m[2]));
			} else {
				$dst = sprintf('/images/%s%s', $page_date, basename($m[2]));
			}
			if (preg_match('!/(blog|_statics)/!', $dpath))
				$cp[] = array('from' => 'html/'.$m[2], 'to' => 'markdown'.$dst);
			return $m[1].$dst;
		}, $markdown);

	// fix broken
	$markdown = preg_replace('!(<iframe.+?)/>!ms', '$1></iframe>', $markdown);
	$markdown = preg_replace('!\{.extlink\}!ms', '', $markdown);

	// fix link
	foreach ($path_replace as $from => $to)
		$markdown = str_replace('/'.$from, '/'.$to, $markdown);
//	$markdown = preg_replace('! /.+?/([^/]+?\.(zip|lzh|txt|h|c|hsp|as|js|reg))$!ms', ' /files/$1', $markdown);
//	$markdown = preg_replace('! /.+?/([^/]+?\.(zip|lzh|txt|hsp|as|js|reg)) !ms', ' /files/$1 ', $markdown);

	// タグのインデントをなくす
	$markdown = preg_replace_callback('!^(<([a-z]+).*?>)(.+?)(</\2>)!ms', function($m) {
			$a = '';
			foreach (explode("\n", $m[3]) as $l)
				if ('' != trim($l))
					$a .= ltrim($l)."\n";
			return $m[1].$a.$m[4];
		}, $markdown);

	$markdown = str_replace('xxxx-fa-reply-fa-flip-vertical-xxxx',
	                        '<span class="fa fa-reply fa-flip-vertical" title="RETURN"></span>', $markdown);

	// 定義済みリストをMarkdownに変換
	$markdown = preg_replace_callback('!<dl.*?>(.+?)</dl>!ms', function($m) {
			return
				preg_replace('!\s*<dt.*?>\s*(.+?)\s*</dt>\s*<dd.*?>\s*(.+?)\s*</dd>\s*!ms', "$1\n: $2\n\n", $m[1]);
		}, $markdown);

	// アノテーション追加
	$markdown = preg_replace('/^# (.+?)$/ms',
					'---' . PHP_EOL .
					(false !== strpos($dpath, 'markdown/blog/') ? '' : 'layout: default' . PHP_EOL) .
					'title: "$1"' . PHP_EOL .
//					(empty($permalink) ? '' : 'permalink: '.$permalink . PHP_EOL) .
					(empty($pub_date) ? '' : 'date: '.$pub_date . PHP_EOL) .
					(empty($tags) ? '' : 'tags: [' . implode(', ', $tags) . ']' . PHP_EOL) .
					(empty($categories) ? '' : 'categories: [' . implode(', ', $categories) . ']' . PHP_EOL) .
					PHP_EOL .
					'---', $markdown);

	$markdown = entities2text($markdown);
	$markdown = trim($markdown);

	$from = str_replace('html/', '', $path);
	$to   = preg_replace('!^markdown/(.+)\.md$!', '$1.html', $dpath);
	$to   = preg_replace('!_statics/([0-9]{4})-([0-9]{2})-([0-9]{2})-!', 'blog/$1/$2/$3/', $to);
	if ($from != $to &&
		false === array_search($from, array('about.html')))
		$redirect[$from] = $to;

	@mkdir(dirname($dpath), 0777, true);
	file_put_contents($dpath, $markdown);
//	if(preg_match('!pcbsoft!', $dpath)) file_put_contents($dpath.'.html', $html);

//	echo sprintf('conv %s -> %s', $path, $dpath).PHP_EOL;
}
//print_r($cp);
@ mkdir('markdown/images');
foreach ($cp as $cp_once) {
	if (!is_dir(dirname($cp_once['to'])))
		@ mkdir(dirname($cp_once['to']));
	@ copy($cp_once['from'], $cp_once['to']);
}

// .htaccess
$tmp = <<<EOD
---
permalink: .htaccess
---
# blogs/(tags|categories)/[0-9]+ 
<FilesMatch "^[0-9]+$">
    DefaultType text/html
</FilesMatch>

# redirect for old site url to new site url

EOD;
$fmtlen = 0;
foreach ($redirect as $from => $to)
	$fmtlen = max(strlen($from), $fmtlen);
$fmtlen = min(50, $fmtlen);
foreach ($redirect as $from => $to)
	$tmp .= sprintf('Redirect permanent /%-'.$fmtlen.'s http://www.sharkpp.net/%s'.PHP_EOL, $from, $to);
file_put_contents('markdown/htaccess.twig', $tmp);
file_put_contents('last_htaccess.txt', $tmp);
