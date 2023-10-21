<?php

namespace App\Kernel\Contracts;

interface RequestInterface
{
    public static function init(): static;


    public function uri(): string;

    public function method(): string;


    public function input(string $key, $default = null): mixed;

    public function setValidator(ValidatorInterface $validator): void;

    public function validate(array $rules): bool;


    public function errors(): array;

}