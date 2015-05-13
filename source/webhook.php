<?php
$NOTIFY = dirname(__FILE__).'/../notify';
$SECRET_KEY = file_get_contents(dirname(__FILE__).'../webhook.key');

if (isset($_GET['key']) &&
    $_GET['key'] === $SECRET_KEY &&
    isset($_POST['payload']) ) {
    $payload = json_decode($_POST['payload'], true);
    if ($payload['ref'] === 'refs/heads/master') {
        `cd /path/to/repository; git pull origin master`;
        file_put_contents($LOG_FILE, date("[Y-m-d H:i:s]")." ".$_SERVER['REMOTE_ADDR']." git pulled: ".$payload['head_commit']['message']."\n", FILE_APPEND|LOCK_EX);
    }
} else {
    file_put_contents($LOG_FILE, date("[Y-m-d H:i:s]")." invalid access: ".$_SERVER['REMOTE_ADDR']."\n", FILE_APPEND|LOCK_EX);
}