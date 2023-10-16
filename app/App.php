<?php

namespace App;

use App\Http\Request;
use App\Router\Router;

class App
{ 
    public function run(): void
    {

        $router = new Router();

        $request = Request::init();

        $router->dispatch($request->uri(), $request->method());

    }

}