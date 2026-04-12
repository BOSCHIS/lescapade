<?php

namespace App\Controller\Admin;

use App\Database\Mysql;
use App\Repository\MenuRepository;
use App\Utils\Auth;

class AdminMenuController
{
    public function __construct() {}

    public function index(): void
    {
        Auth::requireAdmin();

        $pdo = Mysql::connectBdd();
        $menuRepository = new MenuRepository($pdo);
        $menus = $menuRepository->findAllWithCategory();

        include __DIR__ . '/../../../template/admin/menu/index.php';
    }
}
