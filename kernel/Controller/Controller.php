<?php

namespace App\Kernel\Controller;

use App\Kernel\Http\Request;

abstract class Controller
{
    private Request $request;

    public function request(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }
}