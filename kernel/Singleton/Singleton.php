<?php

namespace App\Kernel\Singleton;

class Singleton
{
    private static array $instances = [];

    public static function getInstances()
    {
        $subclass = static::class;

        if(!isset(self::$instances[$subclass])){
            self::$instances[$subclass] = new static();
        }

        return self::$instances[$subclass];
    }

    protected function __construct(){}

    protected function __clone(){}

    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize Singleton");
    }
}