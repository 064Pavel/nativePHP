<?php

namespace App\Kernel\Controller;

use App\Kernel\Contracts\QueryBuilderInterface;
use App\Kernel\Contracts\RedirectInterface;
use App\Kernel\Contracts\RequestInterface;
use App\Kernel\Contracts\ResponseInterface;
use App\Kernel\Contracts\SessionInterface;
use App\Kernel\Database\Database;
use App\Kernel\QueryBuilder\QueryBuilder;

abstract class Controller
{
    private RequestInterface $request;
    private RedirectInterface $redirect;
    private SessionInterface $session;
    private Database $database;
    private QueryBuilderInterface $queryBuilder;
    private ResponseInterface $response;

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

    public function database(): Database
    {
        return $this->database;
    }

    public function setDatabase(Database $database): void
    {
        $this->database = $database;
    }

    public function query(): QueryBuilderInterface
    {
        return $this->queryBuilder;
    }

    public function setQueryBuilder(QueryBuilderInterface $queryBuilder): void
    {
        $this->queryBuilder = $queryBuilder;
    }

    public function response(): ResponseInterface
    {
        return $this->response;
    }

    public function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }
}