<?php

$htaccess = file_get_contents('../source/htaccess.twig');
$htaccess = str_replace("\r", "\n", str_replace("\r\n", "\n", $htaccess));
$htaccess = explode("\n", $htaccess);
$htaccess = array_filter($htaccess, function($a){ return false !== strpos($a, 'Redirect permanent'); });
$htaccess = array_map(function($a){ return explode("\t", preg_replace('/Redirect permanent\s+([^\s]+)\s+([^\s]+)/', "$1\t$2", $a)); }, $htaccess);

//var_dump($htaccess);

foreach ($htaccess as $line) {
	if (preg_match('!\.html$!', $line[0]) &&
		preg_match('!/blog/([0-9]+)/([0-9]+)/([0-9]+)/(.+)\.html$!', $line[1], $m)) {
		$post_path = sprintf('../source/_posts/%s-%s-%s-%s.md', $m[1], $m[2], $m[3], $m[4]);
		$post = $post_ = @ file_get_contents($post_path);
		//$post = str_replace("\r", "\n", str_replace("\r\n", "\n", $post));
		$hasRedirectTag = preg_match('!redirect:!', $post);
		$hasRedirectUrl = preg_match('!    - '.$line[0].'!', $post);

		echo sprintf('%s %s %s %s', empty($post)?'-':' ', $hasRedirectTag?'*':' ', $hasRedirectUrl?'*':' ', $post_path).PHP_EOL;

		if (!$hasRedirectTag) {
			$post = preg_replace('/^(.*---.*?)(\s*---)(.+)$/ms', "$1\nredirect:\n---$3", $post);
			$hasRedirectTag = true;
		}

		if ($hasRedirectTag && !$hasRedirectUrl) {
			$post = preg_replace('/^(.+\nredirect:\n)((    - .+?\n)*)(.+)$/ms', "$1$2    - ".$line[0]."\n$4", $post);
			$hasRedirectUrl = true;
		}

		if ($post_ != $post) {
			file_put_contents($post_path, $post);
//exit;
		}
	}
}
