<?php

namespace App;

class App{
    
    public function run(): void
    {
        $routes = require_once __DIR__ . '/../routes/web.php';

        $uri = $_SERVER['REQUEST_URI'];

        $routes[$uri]();
    }

}