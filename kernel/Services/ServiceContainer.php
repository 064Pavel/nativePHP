<?php

namespace App\Kernel\Services;

use App\Kernel\Http\Request;
use App\Kernel\Http\Validator;
use App\Kernel\Router\Router;

class ServiceContainer
{
    private Request $request;
    private Router $router;
    private Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator();

        $this->request = Request::init();
        $this->request->setValidator($this->validator);

        $this->router = new Router($this->request);
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
