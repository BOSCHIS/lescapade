<?php

namespace App\Controller;

class MenuController
{
    public function __construct() {}

    public function index(): void
    {
        $menuByCategory = [];

        include __DIR__ . '/../../template/template_menu.php';
    }
}
