<?php

use App\Core\Application;

require __DIR__.'/../vendor/autoload.php';
$config = require __DIR__.'/../config/main.php';

if (!empty($config['isDebug'])) {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
}

(new Application($config))->run();