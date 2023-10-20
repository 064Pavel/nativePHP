<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\Http\Validator;

class PageController extends Controller
{
    public function index(): void
    {
        include_once __DIR__ . '/../../views/page.php';
    }

    public function store(): void
    {
        $data = $this->request()->validate([
            'name' => ['required', 'min:3', 'max:5']
        ]);

        if(!$data){
            dd($this->request()->errors());
        } 

        dd("cool");
    }
}