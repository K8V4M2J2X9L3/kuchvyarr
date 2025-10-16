<?php

$config = require __DIR__ . '/config.php';

function createGPlink($url, $alias = null) {

    global $config;

    $api_url = 'https://api.gplinks.com/api?api=' . urlencode($config['gplink_token']) .

               '&url=' . urlencode($url) .

               ($alias ? '&alias=' . urlencode($alias) : '') .

               '&format=json';

    $ch = curl_init($api_url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if (!empty($config['curl_insecure'])) {

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    }

    $res = curl_exec($ch);

    curl_close($ch);

    $json = json_decode($res, true);

    return $json['shortenedUrl'] ?? $url;

}