<?php

namespace App\Kernel\Controller;

use App\Kernel\Contracts\RedirectInterface;
use App\Kernel\Contracts\RequestInterface;
use App\Kernel\Contracts\SessionInterface;

abstract class Controller
{
    private RequestInterface $request;
    private RedirectInterface $redirect;
    private SessionInterface $session;

    public function request(): RequestInterface
    {
        return $this->request;
    }

    public function setRequest(RequestInterface $request): void
    {
        $this->request = $request;
    }

    public function setRedirect(RedirectInterface $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function setSession(SessionInterface $session): void
    {
        $this->session = $session;
    }

    public function session(): SessionInterface
    {
        return $this->session;
    }

    public function redirectTo(string $url): void
    {
        $this->redirect->to($url);
    }
}