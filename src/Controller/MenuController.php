<?php

namespace App\Controller;

use App\Database\Mysql;
use App\Repository\MenuRepository;

class MenuController
{
    public function __construct() {}

    public function index(): void
    {
        $pdo = Mysql::connectBdd();
        $menuRepository = new MenuRepository($pdo);

        $menuByCategory = $menuRepository->findAllMenuGroupedByCategory();

        $heroImage = '/assets/images/header/carte_header.webp';
        $heroHeight = '520px';
        $heroObjectPosition = 'center center';
        $heroTitle = '';
        $heroSubtitle = '';

        include __DIR__ . '/../../template/template_menu.php';
    }
}
