<?php

require_once(dirname(__FILE__) . '/vendor/autoload.php');

function scandir_r($path = '', &$name = array() )
{
	$path = $path == ''? dirname(__FILE__) : $path;
	$lists = @scandir($path);
	if (!empty($lists)) {
		foreach ($lists as $f) { 
			if (is_dir($path.DIRECTORY_SEPARATOR.$f) && $f != ".." && $f != ".") {
				scandir_r($path.DIRECTORY_SEPARATOR.$f, $name); 
			} else if (!is_dir($path.DIRECTORY_SEPARATOR.$f)) {
				$name[] = $path.DIRECTORY_SEPARATOR.$f;
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

$base_path = 'html';
$files = scandir_r($base_path);
foreach ($files as $path) {
	if (!preg_match('/\.html$/', $path))
		continue;

	$dpath = preg_replace('!^[^/]+/(.+)\..+$!', 'markdown/\1.md', $path);
	$dpath = str_replace('.html.md', '.md', $dpath);
	$dpath = dirname($dpath) .'/'. str_replace('_', '-', basename($dpath));
	$curpath = preg_replace('!^[^/]+/(.+)\..+$!', '\1.html', $path);
	$html = file_get_contents($path);

	// タグ取得
	$tags = array();
	if (preg_match('|<!-- tags: \[(.+?)\] -->|', $html, $m)) {
		$tags = explode(',', str_replace('rhaco rhaco2', 'Rhaco,Rhaco2', $m[1]));
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

	$categories = array();
	$tmp = explode('/', $path);
	array_shift($tmp);
	if (1 < count($tmp)) {
		$categories[] = $tmp[0];
	}

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
//		if (!preg_match('!/blog/!', $dpath)) {
//			$pub_date = sprintf('markdown/blog/%s-%s-%s-%s', $m[1], $m[2], $m[3], basename($dpath));
//		}
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

	// fix link
	$html = preg_replace('!href="http://www.sharkpp.net/blog/([0-9]{4})/([0-9]{2})/([0-9]{2})/(.+?)\.html"!', 'href="/blog/$1/$2/$3/$4.html"', $html);
	$html = preg_replace('!href="/blog/([0-9]{4})/([0-9]{2})/([0-9]{2})/(.+?)\.html"!', 'href="/blog/$1/$2/$3/$4.html"', $html);
	$html = preg_replace('!href="(/blog/.+?\.html)\.html"!', 'href="$1"', $html);
	$html = preg_replace_callback('!href="/blog/([0-9]{4})/([0-9]{2})/([0-9]{2})/(.+?)"!',
                function($m) { return 'href="/blog/'.$m[1].'/'.$m[2].'/'.$m[3].'/'.str_replace('_', '-', $m[4]).'"'; }, $html);
	$html = preg_replace('!href="http://www.sharkpp.net/(.+?)\.html"!', 'href="/$1"', $html);
	$html = preg_replace('!href="http://www.sharkpp.net/(.+?)"!', 'href="/$1"', $html);
	$html = preg_replace('!src="http://www.sharkpp.net/(.+?)"!', 'src="/$1"', $html);
	$html = preg_replace('!"(julius\.sourceforge\.jp/)"!', '"http://$1"', $html);
	$html = preg_replace('!"\[http!', '"http', $html);
	$html = preg_replace('!href="/blog/2011/10/02/(.+?)"!', 'href="/blog/2011/10/30/$1"', $html);
	$html = preg_replace('!href="/blog/2010/01/01/(.+?)"!', 'href="/blog/2011/01/01/$1"', $html);
	$html = preg_replace('!href="/blog/2012/01/01/(.+?)"!', 'href="/blog/2012/01/05/$1"', $html);

	// fix image
	$html = preg_replace('!<a +href="([^/h][^"]+)"[^>]+?title="(.+?)".*?><img src="([^/h][^"]+)"[^>]+?alt="(.+?)".*?/></a>!',
	                     '<a href="/'.dirname($curpath).'/$1"><img src="/'.dirname($curpath).'/$3" title="$4" /></a>', $html);
	$html = preg_replace('!<a +href="/([^"]+)"[^>]+?title="(.+?)".*?><img src="/([^"]+)"[^>]+?alt="(.+?)".*?/></a>!',
	                     '<a href="/$1"><img src="/$3" alt="$4" /></a>', $html);
	$html = preg_replace('!<img src="([^"]+)"[^>]+?alt="(.+?)".*?/>!',
	                     '<img src="$1" alt="$2" />', $html);
	$html = preg_replace('!http://www.sharkpp.net/image!', 'http://www.sharkpp.net/images', $html);

	$html = preg_replace('!<div class="section">(.+?)</div>!ms', '$1', $html);
	$html = preg_replace('!<div class="footnote">(.+?)</div>!ms', '$1', $html);
	$html = preg_replace('!<div>\s*<p>\s*(.+?)\s*</p>\s*</div>!ms', '<p>$1</p>', $html);
//	$html = preg_replace('!<dl class="page_history">!ms', '<dl class="dl-horizontal">', $html);

	$html = text2entities($html);
//	$md = new Markdownify\Converter(Markdownify\Converter::LINK_AFTER_PARAGRAPH);
	$md = new Markdownify\ConverterExtra(Markdownify\ConverterExtra::LINK_AFTER_PARAGRAPH);
	$markdown = $md->parseString($html.PHP_EOL);
	unset($md);

	// イメージ移動
	$markdown = preg_replace_callback('! /(.+?\.(jpg|gif|png))!', function($m) use (& $cp, $dpath, $curpath) {
			$page_date = '';
			if (preg_match('!^(.+?)/([0-9]{4})/([0-9]{2})/([0-9]{2})/[^/]+?$!', $curpath, $mm)) {
				$page_date = $mm[2].'_'.$mm[3].$mm[4].'_';
			}
			if (preg_match('!^(.+?)/([0-9]{4})_?([0-9]{2})([0-9]{2})_([^/]+)$!', $m[1], $mm)) {
				$dst = sprintf('/images/%s_%s%s_%s', $mm[2], $mm[3], $mm[4], $mm[5]);
			} else {
				$dst = sprintf('/images/%s%s', $page_date, basename($m[1]));
			}
			if (preg_match('!/blog/!', $dpath))
				$cp[] = array('from' => 'html/'.$m[1], 'to' => 'markdown'.$dst);
			return ' '.$dst;
		}, $markdown);
	$markdown = preg_replace_callback('!([ "])(image/.+?\.(jpg|gif|png))!', function($m) use (& $cp, $dpath, $curpath) {
			$dst = sprintf('/images/%s', basename($m[2]));
			$cp[] = array('from' => 'html/'.$m[2], 'to' => 'markdown'.$dst);
			return $m[1].$dst;
		}, $markdown);

	// 定義済みリストをMarkdownに変換
	$markdown = preg_replace_callback('!<dl.*?>(.+?)</dl>!ms', function($m) {
			return
				preg_replace('!\s*<dt.*?>\s*(.+?)\s*</dt>\s*<dd.*?>\s*(.+?)\s*</dd>\s*!ms', "$1\n: $2\n\n", $m[1]);
		}, $markdown);

	// タグのインデントをなくす
	$markdown = preg_replace_callback('!^(<([a-z]+).*?>)(.+?)(</\2>)!ms', function($m) {
			$a = '';
			foreach (explode("\n", $m[3]) as $l)
				if ('' != trim($l))
					$a .= ltrim($l)."\n";
			return $m[1].$a.$m[4];
		}, $markdown);

	// アノテーション追加
	$markdown = preg_replace('/^# (.+?)$/ms',
					'---' . PHP_EOL .
					(false !== strpos($dpath, 'markdown/blog/') ? '' : 'layout: default' . PHP_EOL) .
					'title: "$1"' . PHP_EOL .
					(empty($pub_date) ? '' : 'date: '.$pub_date . PHP_EOL) .
					(empty($tags) ? '' : 'tags: [' . implode(', ', $tags) . ']' . PHP_EOL) .
					(empty($categories) ? '' : 'categories: [' . implode(', ', $categories) . ']' . PHP_EOL) .
					PHP_EOL .
					'---', $markdown);

	$markdown = entities2text($markdown);
	$markdown = trim($markdown);

/*
---
title: Symfony Live Hacking Day!
tags: [sensio, symfony, symfony live]
categories: [personal]

---*/

	@mkdir(dirname($dpath), 0777, true);
	file_put_contents($dpath, $markdown);
//	file_put_contents($dpath.'.html', $html);

//	echo sprintf('conv %s -> %s', $path, $dpath).PHP_EOL;
}

@ mkdir('markdown/images');
foreach ($cp as $cp_once) {
	if (!is_dir(dirname($cp_once['to'])))
		@ mkdir(dirname($cp_once['to']));
	@ copy($cp_once['from'], $cp_once['to']);
}
