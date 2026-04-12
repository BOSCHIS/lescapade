<?php

namespace App\Controller\Admin;

use App\Database\Mysql;
use App\Repository\CategoryRepository;
use App\Repository\MenuRepository;
use App\Utils\Auth;
use App\Utils\Csrf;

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

    public function create(): void
    {
        Auth::requireAdmin();

        $pdo = Mysql::connectBdd();
        $categoryRepository = new CategoryRepository($pdo);
        $categories = $categoryRepository->findAll();

        $errors = [];
        $old = [
            'title_menu' => '',
            'description_menu' => '',
            'extra_menu' => '',
            'price_menu' => '',
            'order_menu' => '',
            'category_id' => '',
        ];

        include __DIR__ . '/../../../template/admin/menu/create.php';
    }

    public function store(): void
    {
        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/menu/create');
            exit;
        }

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            http_response_code(403);
            die('Token CSRF invalide.');
        }

        $titleMenu = trim($_POST['title_menu'] ?? '');
        $descriptionMenu = trim($_POST['description_menu'] ?? '');
        $extraMenu = trim($_POST['extra_menu'] ?? '');
        $priceMenu = trim($_POST['price_menu'] ?? '');
        $orderMenu = trim($_POST['order_menu'] ?? '');
        $categoryId = (int) ($_POST['category_id'] ?? 0);

        $errors = [];
        $old = [
            'title_menu' => $titleMenu,
            'description_menu' => $descriptionMenu,
            'extra_menu' => $extraMenu,
            'price_menu' => $priceMenu,
            'order_menu' => $orderMenu,
            'category_id' => $categoryId,
        ];

        if ($titleMenu === '') {
            $errors[] = 'Le titre du plat est obligatoire.';
        }

        if ($priceMenu === '' || !is_numeric($priceMenu)) {
            $errors[] = 'Le prix doit être un nombre valide.';
        }

        if ($orderMenu === '' || filter_var($orderMenu, FILTER_VALIDATE_INT) === false) {
            $errors[] = 'L’ordre doit être un nombre entier.';
        }

        if ($categoryId <= 0) {
            $errors[] = 'La catégorie est obligatoire.';
        }

        $pdo = Mysql::connectBdd();
        $categoryRepository = new CategoryRepository($pdo);
        $categories = $categoryRepository->findAll();

        if (!empty($errors)) {
            include __DIR__ . '/../../../template/admin/menu/create.php';
            return;
        }

        $menuRepository = new MenuRepository($pdo);
        $menuRepository->insert(
            $titleMenu,
            $descriptionMenu !== '' ? $descriptionMenu : null,
            $extraMenu !== '' ? $extraMenu : null,
            (float) $priceMenu,
            (int) $orderMenu,
            $categoryId
        );

        header('Location: /admin/menu');
        exit;
    }

    public function edit(): void
    {
        Auth::requireAdmin();

        $idMenu = (int) ($_GET['id'] ?? 0);

        if ($idMenu <= 0) {
            header('Location: /admin/menu');
            exit;
        }

        $pdo = Mysql::connectBdd();

        $menuRepository = new MenuRepository($pdo);
        $categoryRepository = new CategoryRepository($pdo);

        $menu = $menuRepository->findById($idMenu);

        if (!$menu) {
            header('Location: /admin/menu');
            exit;
        }

        $categories = $categoryRepository->findAll();
        $errors = [];
        $old = [
            'id_menu' => $menu['id_menu'],
            'title_menu' => $menu['title_menu'] ?? '',
            'description_menu' => $menu['description_menu'] ?? '',
            'extra_menu' => $menu['extra_menu'] ?? '',
            'price_menu' => $menu['price_menu'] ?? '',
            'order_menu' => $menu['order_menu'] ?? '',
            'category_id' => $menu['category_id'] ?? '',
        ];

        include __DIR__ . '/../../../template/admin/menu/edit.php';
    }

    public function update(): void
    {
        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/menu');
            exit;
        }

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            http_response_code(403);
            die('Token CSRF invalide.');
        }

        $idMenu = (int) ($_POST['id_menu'] ?? 0);
        $titleMenu = trim($_POST['title_menu'] ?? '');
        $descriptionMenu = trim($_POST['description_menu'] ?? '');
        $extraMenu = trim($_POST['extra_menu'] ?? '');
        $priceMenu = trim($_POST['price_menu'] ?? '');
        $orderMenu = trim($_POST['order_menu'] ?? '');
        $categoryId = (int) ($_POST['category_id'] ?? 0);

        if ($idMenu <= 0) {
            header('Location: /admin/menu');
            exit;
        }

        $errors = [];
        $old = [
            'id_menu' => $idMenu,
            'title_menu' => $titleMenu,
            'description_menu' => $descriptionMenu,
            'extra_menu' => $extraMenu,
            'price_menu' => $priceMenu,
            'order_menu' => $orderMenu,
            'category_id' => $categoryId,
        ];

        if ($titleMenu === '') {
            $errors[] = 'Le titre du plat est obligatoire.';
        }

        if ($priceMenu === '' || !is_numeric($priceMenu)) {
            $errors[] = 'Le prix doit être un nombre valide.';
        }

        if ($orderMenu === '' || filter_var($orderMenu, FILTER_VALIDATE_INT) === false) {
            $errors[] = 'L’ordre doit être un nombre entier.';
        }

        if ($categoryId <= 0) {
            $errors[] = 'La catégorie est obligatoire.';
        }

        $pdo = Mysql::connectBdd();
        $menuRepository = new MenuRepository($pdo);
        $categoryRepository = new CategoryRepository($pdo);

        $menu = $menuRepository->findById($idMenu);

        if (!$menu) {
            header('Location: /admin/menu');
            exit;
        }

        $categories = $categoryRepository->findAll();

        if (!empty($errors)) {
            include __DIR__ . '/../../../template/admin/menu/edit.php';
            return;
        }

        $menuRepository->update(
            $idMenu,
            $titleMenu,
            $descriptionMenu !== '' ? $descriptionMenu : null,
            $extraMenu !== '' ? $extraMenu : null,
            (float) $priceMenu,
            (int) $orderMenu,
            $categoryId
        );

        header('Location: /admin/menu');
        exit;
    }

    public function delete(): void
    {
        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/menu');
            exit;
        }

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            http_response_code(403);
            die('Token CSRF invalide.');
        }

        $idMenu = (int) ($_POST['id_menu'] ?? 0);

        if ($idMenu <= 0) {
            header('Location: /admin/menu');
            exit;
        }

        $pdo = Mysql::connectBdd();
        $menuRepository = new MenuRepository($pdo);

        $menu = $menuRepository->findById($idMenu);

        if ($menu) {
            $menuRepository->delete($idMenu);
        }

        header('Location: /admin/menu');
        exit;
    }

    public function moveUp(): void
    {
        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/menu');
            exit;
        }

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            http_response_code(403);
            die('Token CSRF invalide.');
        }

        $idMenu = (int) ($_POST['id_menu'] ?? 0);

        if ($idMenu <= 0) {
            header('Location: /admin/menu');
            exit;
        }

        $pdo = Mysql::connectBdd();
        $menuRepository = new MenuRepository($pdo);

        $currentMenu = $menuRepository->findById($idMenu);

        if (!$currentMenu) {
            header('Location: /admin/menu');
            exit;
        }

        $previousMenu = $menuRepository->findPreviousInCategory(
            (int) $currentMenu['category_id'],
            (int) $currentMenu['order_menu'],
            (int) $currentMenu['id_menu']
        );

        if ($previousMenu) {
            $menuRepository->swapOrder(
                (int) $currentMenu['id_menu'],
                (int) $currentMenu['order_menu'],
                (int) $previousMenu['id_menu'],
                (int) $previousMenu['order_menu']
            );
        }

        header('Location: /admin/menu');
        exit;
    }

    public function moveDown(): void
    {
        Auth::requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /admin/menu');
            exit;
        }

        if (!Csrf::validate($_POST['_csrf_token'] ?? null)) {
            http_response_code(403);
            die('Token CSRF invalide.');
        }

        $idMenu = (int) ($_POST['id_menu'] ?? 0);

        if ($idMenu <= 0) {
            header('Location: /admin/menu');
            exit;
        }

        $pdo = Mysql::connectBdd();
        $menuRepository = new MenuRepository($pdo);

        $currentMenu = $menuRepository->findById($idMenu);

        if (!$currentMenu) {
            header('Location: /admin/menu');
            exit;
        }

        $nextMenu = $menuRepository->findNextInCategory(
            (int) $currentMenu['category_id'],
            (int) $currentMenu['order_menu'],
            (int) $currentMenu['id_menu']
        );

        if ($nextMenu) {
            $menuRepository->swapOrder(
                (int) $currentMenu['id_menu'],
                (int) $currentMenu['order_menu'],
                (int) $nextMenu['id_menu'],
                (int) $nextMenu['order_menu']
            );
        }

        header('Location: /admin/menu');
        exit;
    }
}
