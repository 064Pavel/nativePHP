<?php

namespace App\Kernel\Middleware;

use App\Kernel\Contracts\MiddlewareInterface;

class Middleware implements MiddlewareInterface
{
    public function check(array $middlewares = []): void
    {
        
    }
}