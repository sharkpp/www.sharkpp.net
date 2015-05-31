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
$secret_key = get_my_ini('secret_key', null);
//$_POST['payload']='{"ref":"refs/heads/master","head_commit":{"message":"xxx"}}';
$payload = isset($_POST['payload'])
               ? @ json_decode($_POST['payload'], true)
               : array();

if (!empty($payload) &&
    isset($payload['config']['secret']) &&
    $secret_key === $payload['config']['secret'] &&
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