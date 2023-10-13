<?php

use App\Router\Route;

return [
    Route::get('/page', function(){
        include_once __DIR__ . '/../views/page.php';
    })
];