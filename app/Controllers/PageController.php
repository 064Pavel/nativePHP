<?php

namespace App\Controllers;

class PageController
{
    public function index(): void
    {
        include_once __DIR__ . '/../../views/page.php';
    }
}