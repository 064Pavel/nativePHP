<?php

namespace App\Router;

class Route
{
    private string $uri;

    private string $method;

    private $action;

    public function __construct(string $uri, string $method, callable $action)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->action = $action;
    }

    public static function get(string $uri, callable $action): static
    {
        return new static($uri, 'GET', $action);
    }

    public static function post(string $uri, callable $action): static
    {
        return new static($uri, 'POST', $action);
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getAction(): callable
    {
        return $this->action;
    }


}