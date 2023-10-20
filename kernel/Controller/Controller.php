<?php

namespace App\Kernel\Controller;

use App\Kernel\Http\Request;
use App\Kernel\Http\Redirect;
use App\Kernel\Session\Session;

abstract class Controller
{
    private Request $request;
    private Redirect $redirect;
    private Session $session;

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

    public function setSession(Session $session): void
    {
        $this->session = $session;
    }

    public function session(): Session
    {
        return $this->session;
    }

    public function redirectTo(string $url): void
    {
        $this->redirect->to($url);
    }
}