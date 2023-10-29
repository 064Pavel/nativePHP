<?php

namespace App\Controllers;

use App\Kernel\Config\Config;
use App\Kernel\Controller\Controller;
use App\Kernel\Http\Redirect;
use App\Kernel\Http\Response;
use App\Kernel\Http\Validator;
use App\Kernel\JWT\JWT;
use App\Kernel\JWT\JWTHandler;

class PageController extends Controller
{
    public function index(): void
    {
        $jwt = new JWTHandler(new Config(), new Response());
        $token = $jwt->generateToken(["data" => "data"]);
        dump($token);
        dump($jwt->validateToken($token));

        include_once __DIR__ . '/../../views/page.php';
    }

    public function store(): void
    {


        $data = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:5']
        ]);

        // dd($this->session());

        dd($this->response()->setStatusCode(200)
        ->setJsonContent(['message' => 'Hello, REST API!'])
        ->send());

        if(!$data){
            $this->redirectTo("/");
        } 

        dd("cool");
    }
}