<?php

ini_set('display_errors', 1);

// define('DSN', 'mysql:dbhost=localhost;dbname=line_guide');
define('DSN', 'mysql:host=us-cdbr-iron-east-03.cleardb.net;dbname=heroku_2bc58d930f89601;charset=utf8');
// define('DB_USERNAME', 'b964721f74c983');
define('DB_USERNAME', 'b964721f74c983');
define('DB_PASSWORD', '92fe3ff7');

define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

require_once(__DIR__ . '/../lib/functions.php');
require_once(__DIR__ . '/autoload.php');

session_start();
