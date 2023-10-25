<?php

namespace App\Kernel\Contracts;

interface ConfigInterface
{
    public function get(string $key, $default = null): mixed;
}