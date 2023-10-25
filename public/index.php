<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Kernel\App;
use App\Kernel\Services\ServiceContainer;

define('APP_PATH', dirname(__DIR__));

$serviceContainer = new ServiceContainer();
$app = new App($serviceContainer);

$app->run();
