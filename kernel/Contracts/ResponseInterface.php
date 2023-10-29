<?php

namespace App\Kernel\Contracts;

interface ResponseInterface
{
    public function setStatusCode(int $statusCode): ResponseInterface;

    public function setHeader(string $name, string $value): ResponseInterface;

    public function setContent(string $content): ResponseInterface;

    public function setJsonContent(array $data): ResponseInterface;

    public function send(): string;

    public function sendErr(string $errMessage): string;
}