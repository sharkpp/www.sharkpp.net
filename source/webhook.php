<?php

date_default_timezone_set('Asia/Tokyo');

function at($var, $key, $def = '') {
	$v = $var;
	foreach (explode('.', $key) as $k) {
		if (!isset($v[$k]))
			return $def;
		$v = $v[$k];
	}
	return $v;
}

function get_my_ini($key, $def = '') {
    static $ini_cache_ = null;
    if (null === $ini_cache_) {
        $ini_cache_ = array();
        foreach (explode("\n", str_replace("\r", "\n",
             str_replace("\r\n", "\n", @file_get_contents(dirname(__FILE__).'/../webhook.conf'))))
             as $line) {
             if (preg_match('|^\s*([^=]+?)\s*=\s*(.+?)\s*$|', $line, $m))
                 $ini_cache_[$m[1]] = $m[2];
        }
    }
    return at($ini_cache_, $key, $def);
}

$post_data = '';
if ($stream = fopen('php://input', 'r')) {
    $post_data = stream_get_contents($stream, 512*1024); // max 512KB
    fclose($stream);
}

$log_file   = get_my_ini('log_file', null);
$secret_key = get_my_ini('secret_key', null);
list($hmac_algo, $hmac_value) = explode('=', at($_SERVER, 'HTTP_X_HUB_SIGNATURE', 'sha1=*'), 2);
$payload = @ json_decode($post_data, true);

if (!empty($payload) &&
    hash_hmac($hmac_algo, $post_data, $secret_key) === $hmac_value &&
    isset($payload['ref']) &&
    'refs/heads/master' == $payload['ref'] )
{
    $git_cmd     = get_my_ini('git_cmd', 'git');
    $repos_path  = get_my_ini('repos_path', dirname(__FILE__).'/..');
    $output_path = get_my_ini('output_path', dirname(__FILE__));

    $retval = 0;
    exec('cd '.$repos_path.' ;'.
             $git_cmd.' pull origin master 2>&1 ;'.
             'GIT_RESULT=$? ;'.
             'if [ 0 -eq $GIT_RESULT ] ; then ./site generate '.$output_path.' >/dev/null 2>&1 ; fi ;'.
             'echo $GIT_RESULT',
             $result, $retval);//var_dump($result);
    $status = empty($result) ? 0 : intval(array_pop($result));
    if ($log_file) {
        file_put_contents($log_file, 
                          date("[Y-m-d H:i:s]")." ".$_SERVER['REMOTE_ADDR'].
                          " git pulled: ".$payload['head_commit']['message']."\n",
                          FILE_APPEND|LOCK_EX);
        if ($status)
            foreach ($result as $line)
                file_put_contents($log_file, 
                                  date("[Y-m-d H:i:s]")." git log \"".$line."\"\n",
                                  FILE_APPEND|LOCK_EX);
    }
} else {
    if ($log_file)
        file_put_contents($log_file,
                          date("[Y-m-d H:i:s]")." invalid access: ".$_SERVER['REMOTE_ADDR']."\n",
                          FILE_APPEND|LOCK_EX);
}