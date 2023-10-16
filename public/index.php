<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Kernel\App;

// require_once __DIR__ . '/../app/App.php';
$app = new App();

$app->run();