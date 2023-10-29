<?php

namespace App\Kernel\Services;

use App\Kernel\Config\Config;
use App\Kernel\Contracts\QueryBuilderInterface;
use App\Kernel\Contracts\RedirectInterface;
use App\Kernel\Contracts\RequestInterface;
use App\Kernel\Contracts\ResponseInterface;
use App\Kernel\Contracts\RouterInterface;
use App\Kernel\Contracts\SessionInterface;
use App\Kernel\Contracts\ValidatorInterface;
use App\Kernel\Database\Database;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\Request;
use App\Kernel\Http\Response;
use App\Kernel\Http\Validator;
use App\Kernel\JWT\JWTHandler;
use App\Kernel\QueryBuilder\QueryBuilder;
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
    private QueryBuilderInterface $queryBuilder;
    private ResponseInterface $response;
    private JWTHandler $jwt;

    public function __construct()
    {
        $this->validator = new Validator();

        $this->request = Request::init();
        $this->request->setValidator($this->validator);

        $this->redirect = new Redirect();

        $this->session = new Session();

        $this->config = new Config();

        $this->database = new Database($this->config);

        $this->queryBuilder = new QueryBuilder($this->database);

        $this->response = new Response();

        $this->jwt = new JWTHandler($this->config, $this->response);

        $this->router = new Router(
                                    $this->request,
                                    $this->redirect,
                                    $this->session,
                                    $this->database,
                                    $this->queryBuilder,
                                    $this->response
            );

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
