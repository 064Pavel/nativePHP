<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class PageController extends Controller
{
    public function index(): void
    {
        include_once __DIR__ . '/../../views/page.php';
    }

    public function store(): void
    {
        dd($this->request());
    }
}