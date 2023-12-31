<?php

namespace App\Kernel\Router;

use App\Kernel\Contracts\QueryBuilderInterface;
use App\Kernel\Contracts\RedirectInterface;
use App\Kernel\Contracts\RequestInterface;
use App\Kernel\Contracts\ResponseInterface;
use App\Kernel\Contracts\RouterInterface;
use App\Kernel\Contracts\SessionInterface;
use App\Kernel\Database\Database;
use App\Kernel\Middleware\Middleware;
use App\Kernel\Middleware\AbstractMiddleware;

class Router implements RouterInterface
{

    private $routes = [
        'GET' => [],
        'POST' => [],
    ];


    public function __construct(
        private RequestInterface $request,
        private RedirectInterface $redirect,
        private SessionInterface $session,
        private Database $database,
        private QueryBuilderInterface $queryBuilder,
        private ResponseInterface $response,
    )
    {
        $this->enable();
    }

    public function dispatch(string $uri, string $method): void
    {
        $route = $this->findRoute($uri, $method);

        if(!$route){
            $this->notFoundHandler();
        }

        if($route->hasMiddlewares()){
            foreach($route->getMiddlewares() as $middleware){

                /** @var AbstractMiddleware $middleware */

                $middleware = new $middleware($this->request, $this->redirect);

                $middleware->handle();
            }
        }

        if(is_array($route->getAction())){

            [$controller, $action] = $route->getAction();

            $controller = new $controller();

            // $controller->$action();

            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);
            call_user_func([$controller, 'setDatabase'], $this->database);
            call_user_func([$controller, 'setQueryBuilder'], $this->queryBuilder);
            call_user_func([$controller, 'setResponse'], $this->response);

            call_user_func([$controller, $action]);
        } else {
            $route->getAction()();
        }
    }

    private function enable()
    {
        $routes = $this->getRoutes();

        foreach($routes as $route){
            $this->routes[$route->getMethod()][$route->getUri()] = $route;
        }

        // dd($this->routes);
    }

    /**
     * @return Route[]
     */
    private function getRoutes(): array
    {
        return require_once __DIR__ . '/../../routes/web.php';
    }

    private function findRoute(string $uri, string $method): Route|false
    {
        if(!isset($this->routes[$method][$uri])){
            return false;
        }

        return $this->routes[$method][$uri];
    }

    private function notFoundHandler(): void
    {
        echo "404 Not Found :(";
        exit();
    }
}