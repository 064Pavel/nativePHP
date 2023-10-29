<?php

namespace App\Kernel\JWT;
use Firebase\JWT\JWT;
use App\Kernel\Config\Config;
use App\Kernel\Contracts\ResponseInterface;

class JWTHandler
{
    private string $key;

    public function __construct(Config $config, protected ResponseInterface $response)
    {
        $this->key = $config->get('jwt.key');
    }
    public function generateToken(array $data): string
    {
        try {
            $token = JWT::encode($data, $this->key, 'HS256');
            return $token;
        } catch (\Exception $e) {
            $errorMessage = "error during token generation: " . $e->getMessage();
            return $this->response
                ->sendErr($errorMessage);
        }
    }

    public function validateToken(string $token): bool|array
    {
        try {
            $data = JWT::decode($token, $this->key);
            return $data;
        } catch (\Exception $e) {
            $errorMessage = "token error: " . $e->getMessage();
            return $this->response
                ->sendErr($errorMessage);
        } 
    }

}