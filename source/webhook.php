<?php

date_default_timezone_set('Asia/Tokyo');

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
    if (isset($ini_cache_[$key]))
        return $ini_cache_[$key];
    return $def;
}

$log_file   = get_my_ini('log_file', null);
$secret_key = get_my_ini('secret_key', null);≈

if (isset($_GET['key']) &&
    $_GET['key'] === $secret_key &&
    isset($_POST['payload']) )
{
    $git_cmd     = get_my_ini('git_cmd', 'git');
    $repos_path  = get_my_ini('repos_path', dirname(__FILE__).'/..');
    $output_path = get_my_ini('output_path', dirname(__FILE__));

    $payload = @ json_decode($_POST['payload'], true);
    if ($payload['ref'] === 'refs/heads/master') {
        exec('cd '.$repos_path.' ;'.
             $git_cmd.' pull origin master ;'.
             './site generate '.$output_path);
        if ($log_file)
            file_put_contents($log_file, 
                              date("[Y-m-d H:i:s]")." ".$_SERVER['REMOTE_ADDR'].
                              " git pulled: ".$payload['head_commit']['message']."\n",
                              FILE_APPEND|LOCK_EX);
    }
} else {
    if ($log_file)
        file_put_contents($log_file,
                          date("[Y-m-d H:i:s]")." invalid access: ".$_SERVER['REMOTE_ADDR']."\n",
                          FILE_APPEND|LOCK_EX);
}