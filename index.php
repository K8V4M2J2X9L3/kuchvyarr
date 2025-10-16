<?php

$config = require __DIR__ . '/config.php';

$cookie_name = 'awc_watch_unlock';

$unlocked = isset($_COOKIE[$cookie_name]) && intval($_COOKIE[$cookie_name]) > time();

?>

<!DOCTYPE html>

<html>

<head>

<meta charset="utf-8">

<title>Anime Watch Page</title>

<link rel="stylesheet" href="assets/style.css">

<script>const ajaxUrl='generate.php';</script>

</head>

<body>

<?php if(!$unlocked): ?>

<div id="locked">

<h2>🔒 Locked — Complete the GP Task</h2>

<button id="genBtn">Generate Task</button>

<p id="linkArea"></p>

</div>

<?php else: ?>

<div id="content">

<h1>✅ Unlocked! Enjoy anime</h1>

<p>Video player here.</p>

</div>

<?php endif; ?>

<script src="assets/script.js"></script>

</body>

</html>