<?php

use App\Kernel\Router\Route;
use App\Controllers\PageController;
use App\Middleware\TestMiddleware;

return [
    Route::get('/page', [PageController::class, 'index'], [TestMiddleware::class]),
    Route::post('/store', [PageController::class, 'store'], [TestMiddleware::class]),
];