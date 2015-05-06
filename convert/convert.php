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

//require_once(dirname(__FILE__).'/HTML_To_Markdown.php');

//require_once(dirname(__FILE__).'/Markdownify/Parser.php');
//require_once(dirname(__FILE__).'/Markdownify/Converter.php');

$base_path = 'html';
$files = scandir_r($base_path);
foreach ($files as $path) {
	if (!preg_match('/\.html$/', $path))
		continue;

	$dpath = preg_replace('!^[^/]+/(.+)\..+$!', 'markdown/\1.md', $path);
	$html = file_get_contents($path);

	if (!preg_match('|<div id="contents">(.+)<p class="info" style="margin-top: 1em">.+</div><!-- #contents end -->|ms', $html, $m))
	{
		echo sprintf('skip %s', $path).PHP_EOL;
		continue;
	}
	$html = $m[1];

	$html = preg_replace('|<div class="section">(.+?)</div>|ms', '\1', $html);
	$html = preg_replace('|<div class="footnote">(.+?)</div>|ms', '\1', $html);

$markdown = $html;
//	$md = new HTML_To_Markdown($html);
//	$markdown = $md->output();
//	unset($md);

	$html = text2entities($html);
	$md = new Markdownify\Converter;
	$markdown = $md->parseString($html.PHP_EOL);
	unset($md);
	$markdown = entities2text($markdown);

	for ($dir = dirname($dpath); '.' != $dir; $dir = dirname($dir))
		@mkdir($dir);
	file_put_contents($dpath, $markdown);

	echo sprintf('conv %s -> %s', $path, $dpath).PHP_EOL;

//	break;
}
