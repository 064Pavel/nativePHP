<?php

namespace App\Kernel\Contracts;

interface RedirectInterface
{
    public function to(string $url): void;
}