<?php

namespace App\Kernel;

use App\Kernel\Http\Request;
use App\Kernel\Router\Router;
use App\Kernel\Services\ServiceContainer;

class App
{
    private ServiceContainer $serviceContainer;

    public function __construct(ServiceContainer $serviceContainer)
    {
        $this->serviceContainer = $serviceContainer;
    }

    public function run(): void
    {
        $request = $this->serviceContainer->getRequest();
        $router = $this->serviceContainer->getRouter();
    
        $router->dispatch(
            $request->uri(),
            $request->method()
        );
    } 
}
