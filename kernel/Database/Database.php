<?php

namespace App\Kernel\Database;

use App\Kernel\Config\Config;
use PDO;

class Database
{

    private PDO $pdo;

    public function __construct(
        private Config $config,
    )
    {
        $this->connect();
    }

    private function connect(): void
    {
        $driver = $this->config->get('database.driver');
        $host = $this->config->get('database.host');
        $port = $this->config->get('database.port');
        $database = $this->config->get('database.database');
        $username = $this->config->get('database.username');
        $password = $this->config->get('database.password');
        $charset = $this->config->get('database.charset');

        try {
            $this->pdo = new \PDO(
                "$driver:host=$host;port=$port;dbname=$database;charset=$charset",
                $username,
                $password
            );
        } catch (\PDOException $exception) {
            exit("Database connection failed: {$exception->getMessage()}");
        }
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}