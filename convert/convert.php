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

$base_path = 'html';
$files = scandir_r($base_path);
foreach ($files as $path) {
	if (!preg_match('/\.html$/', $path))
		continue;

	$dpath = preg_replace('!^[^/]+/(.+)\..+$!', 'markdown/\1.md', $path);
	$curpath = preg_replace('!^[^/]+/(.+)\..+$!', '\1.html', $path);
	$html = file_get_contents($path);

//	$html = explode("\n", $html);
//	foreach ($html as & $line)
//		$line = ltrim($line, "\t");
//	$html = implode("\n", $html);
//	unset($line);

//	$keywords = array();
//	if (preg_match('|<meta name="keywords" content="(.+?)" />|', $html, $m)) {
//		$keywords = explode(',', $m[1]);
//		foreach ($keywords as & $k)
//			$k = trim($k);
//	}

	$tags = array();
	if (preg_match('|<!-- tags: \[(.+?)\] -->|', $html, $m)) {
		$tags = explode(',', $m[1]);
		foreach ($tags as & $k)
			$k = trim($k);
	}

	$categories = array();
	$tmp = explode('/', $path);
	array_shift($tmp);
	if (1 < count($tmp)) {
		$categories[] = $tmp[0];
	}

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
	$html = preg_replace('!href="http://www.sharkpp.net/blog/([0-9]{4})/([0-9]{2})/([0-9]{2})/(.+)\.html"!', 'href="/blog/$1/$2/$3/$4"', $html);
	$html = preg_replace('!href="http://www.sharkpp.net/(.+)\.html"!', 'href="/$1"', $html);
	$html = preg_replace('!href="http://www.sharkpp.net/(.+)"!', 'href="/$1"', $html);
	$html = preg_replace('!src="http://www.sharkpp.net/(.+)"!', 'src="/$1"', $html);

	// fix image
	$html = preg_replace('!<a +href="([^/][^"]+)"[^>]+?title="(.+?)".*?><img src="([^/][^"]+)"[^>]+?alt="(.+?)".*?/></a>!',
	                     '<a href="/'.dirname($curpath).'/$1"><img src="/'.dirname($curpath).'/$3" title="$4" /></a>', $html);
	$html = preg_replace('!<a +href="/([^"]+)"[^>]+?title="(.+?)".*?><img src="/([^"]+)"[^>]+?alt="(.+?)".*?/></a>!',
	                     '<a href="/$1"><img src="/$3" alt="$4" /></a>', $html);

	$html = preg_replace('!<div class="section">(.+?)</div>!ms', '$1', $html);
	$html = preg_replace('!<div class="footnote">(.+?)</div>!ms', '$1', $html);
	$html = preg_replace('!<div>\s*<p>\s*(.+?)\s*</p>\s*</div>!ms', '<p>$1</p>', $html);
//	$html = preg_replace('!<dl class="page_history">!ms', '<dl class="dl-horizontal">', $html);

	$html = text2entities($html);
//	$md = new Markdownify\Converter(Markdownify\Converter::LINK_AFTER_CONTENT);
	$md = new Markdownify\ConverterExtra(Markdownify\ConverterExtra::LINK_AFTER_PARAGRAPH);
	$markdown = $md->parseString($html.PHP_EOL);
	unset($md);

	$markdown = preg_replace('/^# (.+)/',
					'---' . PHP_EOL .
					(false !== strpos($dpath, 'markdown/blog/') ? '' : 'layout: default' . PHP_EOL) .
					'title: "$1"' . PHP_EOL .
					(empty($tags) ? '' : 'tags: [' . implode(', ', $tags) . ']' . PHP_EOL) .
					(empty($categories) ? '' : 'categories: [' . implode(', ', $categories) . ']' . PHP_EOL) .
					PHP_EOL .
					'---', $markdown);

	$markdown = preg_replace_callback('!<dl.*?>(.+?)</dl>!ms', function($m){
			return
				preg_replace('!\s*<dt.*?>\s*(.+?)\s*</dt>\s*<dd.*?>\s*(.+?)\s*</dd>\s*!ms', "$1\n: $2\n\n", $m[1]);
		}, $markdown);

	$markdown = preg_replace_callback('!^(<([a-z]+).*?>)(.+?)(</\2>)!ms', function($m){
			$a = '';
			foreach (explode("\n", $m[3]) as $l)
				if ('' != trim($l))
					$a .= ltrim($l)."\n";
			return $m[1].$a.$m[4];
		}, $markdown);

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

	echo sprintf('conv %s -> %s', $path, $dpath).PHP_EOL;
}
