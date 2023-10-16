<?php

namespace App\Kernel\Services;

use App\Kernel\Http\Request;
use App\Kernel\Router\Router;

class ServiceContainer
{
    private Request $request;
    private Router $router;

    public function __construct()
    {
        $this->request = Request::init();
        $this->router = new Router();
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getRouter(): Router
    {
        return $this->router;
    }
}
