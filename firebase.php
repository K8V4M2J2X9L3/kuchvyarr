<?php

$config = require __DIR__ . '/config.php';

function fb_put($path, $data) {

    global $config;

    $url = rtrim($config['firebase_url'], '/') . '/' . trim($path, '/') . '.json';

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if (!empty($config['curl_insecure'])) {

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    }

    $res = curl_exec($ch);

    curl_close($ch);

    return json_decode($res, true);

}

function fb_get($path) {

    global $config;

    $url = rtrim($config['firebase_url'], '/') . '/' . trim($path, '/') . '.json';

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if (!empty($config['curl_insecure'])) {

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    }

    $res = curl_exec($ch);

    curl_close($ch);

    return json_decode($res, true);

}

function fb_delete($path) {

    global $config;

    $url = rtrim($config['firebase_url'], '/') . '/' . trim($path, '/') . '.json';

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if (!empty($config['curl_insecure'])) {

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

    }

    $res = curl_exec($ch);

    curl_close($ch);

    return $res !== false;

}