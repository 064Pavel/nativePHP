<?php

namespace App\Kernel\Contracts;

use App\Kernel\Router\Route;

interface RouterInterface
{
    public function dispatch(string $uri, string $method): void;

}