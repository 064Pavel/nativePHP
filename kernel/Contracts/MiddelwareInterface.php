<?php

namespace App\Kernel\Contracts;

interface MiddlewareInterface
{
    public function check(array $middlewares = []): void;
}