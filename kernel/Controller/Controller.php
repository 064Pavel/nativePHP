<?php

namespace App\Kernel\Controller;

use App\Kernel\Http\Request;
use App\Kernel\Http\Redirect;

abstract class Controller
{
    private Request $request;
    private Redirect $redirect;

    public function request(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function setRedirect(Redirect $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function redirectTo(string $url): void
    {
        $this->redirect->to($url);
    }
}