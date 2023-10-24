<?php

namespace App\Kernel\Services;

use App\Kernel\Config\Config;
use App\Kernel\Contracts\RedirectInterface;
use App\Kernel\Contracts\RequestInterface;
use App\Kernel\Contracts\RouterInterface;
use App\Kernel\Contracts\SessionInterface;
use App\Kernel\Contracts\ValidatorInterface;
use App\Kernel\Database\Database;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\Request;
use App\Kernel\Http\Validator;
use App\Kernel\Router\Router;
use App\Kernel\Session\Session;

class ServiceContainer
{
    private RequestInterface $request;
    private RouterInterface $router;
    private ValidatorInterface $validator;
    private RedirectInterface $redirect;
    private SessionInterface $session;
    private Config $config;
    private Database $database;

    public function __construct()
    {
        $this->validator = new Validator();

        $this->request = Request::init();
        $this->request->setValidator($this->validator);

        $this->redirect = new Redirect();

        $this->session = new Session();

        $this->router = new Router($this->request, $this->redirect, $this->session);

        $this->config = new Config();

        $this->database = new Database($this->config);

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
