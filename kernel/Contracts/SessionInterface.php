<?php

namespace App\Kernel\Contracts;

interface SessionInterface
{
    public function set(string $key, $value): void;


    public function get(string $key, $default = null);


    public function extract(string $key, $default = null);


    public function has(string $key): bool;

    public function remove(string $key): void;


    public function destroy(): void;

}