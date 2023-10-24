<?php

namespace App\Kernel\Router;

use App\Kernel\Contracts\RedirectInterface;
use App\Kernel\Contracts\RequestInterface;
use App\Kernel\Contracts\RouterInterface;
use App\Kernel\Contracts\SessionInterface;

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

        if(is_array($route->getAction())){

            [$controller, $action] = $route->getAction();

            $controller = new $controller();

            // $controller->$action();

            call_user_func([$controller, 'setRequest'], $this->request);
            call_user_func([$controller, 'setRedirect'], $this->redirect);
            call_user_func([$controller, 'setSession'], $this->session);

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