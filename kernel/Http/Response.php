<?php

namespace App\Kernel\Http;

use App\Kernel\Contracts\ResponseInterface;

class Response implements ResponseInterface
{
    protected int $statusCode = 200;
    protected array $headers = [];
    protected string $content = '';

    public function setStatusCode(int $statusCode): ResponseInterface
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function setHeader(string $name, string $value): ResponseInterface
    {
        $this->headers[$name] = $value;
        return $this;
    }

    public function setContent(string $content): ResponseInterface
    {
        $this->content = $content;
        return $this;
    }

    public function setJsonContent(array $data): ResponseInterface
    {
        $jsonContent = json_encode($data);
        $this->setHeader('Content-Type', 'application/json');
        $this->content = $jsonContent;
        return $this;
    }

    public function send(): string
    {
        http_response_code($this->statusCode);

        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        return $this->content;
    }

    public function sendErr(string $errMessage): string
    {
        http_response_code($this->statusCode = 500);

        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        return $errMessage;
    }
}