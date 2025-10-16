<?php

header('Content-Type: application/json');

require 'config.php';

require 'firebase.php';

require 'gplink.php';

$config = require __DIR__ . '/config.php';

function randToken($length = 12){

    $chars = 'ABCDEFGHJKMNPQRSTUVWXYZ23456789';

    $s = '';

    for($i=0;$i<$length;$i++) $s .= $chars[random_int(0,strlen($chars)-1)];

    return $s;

}

$taskId = 't_' . bin2hex(random_bytes(6));

$clientToken = randToken(10);

$code = strtoupper(substr(md5($taskId . microtime()), 0, 6));

$now = time();

$expiresAt = $now + $config['code_ttl'];

$taskData = [

    'taskId' => $taskId,

    'clientToken' => $clientToken,

    'code' => $code,

    'status' => 'pending',

    'createdAt' => $now,

    'expiresAt' => $expiresAt

];

// save task

fb_put($config['tasks_prefix'].'/'.$taskId, $taskData);

fb_put($config['codes_prefix'].'/'.$code, ['code'=>$code,'taskId'=>$taskId,'used'=>false,'createdAt'=>$now,'expiresAt'=>$expiresAt]);

// generate GPLink

$returnUrl = $config['site_url'].'/anime-watchcode/watch-return.php?task='.$taskId.'&ct='.$clientToken;

$short = createGPlink($returnUrl, $code);

echo json_encode(['ok'=>true,'taskId'=>$taskId,'short'=>$short,'code'=>$code]);