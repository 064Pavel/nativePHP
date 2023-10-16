<?php

use App\Kernel\Router\Route;
use App\Controllers\PageController;

return [
    Route::get('/page', [PageController::class, 'index']),
    Route::post('/store', [PageController::class, 'store']),
];