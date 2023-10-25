<?php

namespace App\Kernel\Middleware;

use App\Kernel\Contracts\RedirectInterface;
use App\Kernel\Contracts\RequestInterface;

abstract class AbstractMiddleware
{
    public function __construct(
        protected RequestInterface $request,
        protected RedirectInterface $redirect,
    )
    {}

    abstract public function handle(): void;
}