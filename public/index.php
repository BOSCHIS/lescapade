<?php

$secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => $secure,
    'httponly' => true,
    'samesite' => 'Lax',
]);

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use App\Controller\HomeController;
use App\Controller\MenuController;
use App\Controller\Admin\AdminAuthController;
use App\Controller\Admin\AdminDashboardController;
use App\Controller\Admin\AdminMenuController;

$url = parse_url($_SERVER['REQUEST_URI']);
$path = $url['path'] ?? '/';

$homeController = new HomeController();
$menuController = new MenuController();
$adminAuthController = new AdminAuthController();
$adminDashboardController = new AdminDashboardController();
$adminMenuController = new AdminMenuController();

switch ($path) {
    case '/':
    case '/lescapade/public/':
    case '/lescapade/public/index.php':
    case '/LESCAPADE/public/':
    case '/LESCAPADE/public/index.php':
        $homeController->index();
        break;

    case '/menu':
    case '/lescapade/public/menu':
    case '/LESCAPADE/public/menu':
        $menuController->index();
        break;

    case '/admin':
    case '/lescapade/public/admin':
    case '/LESCAPADE/public/admin':
        $adminDashboardController->index();
        break;

    case '/admin/login':
    case '/lescapade/public/admin/login':
    case '/LESCAPADE/public/admin/login':
        $adminAuthController->login();
        break;

    case '/admin/logout':
    case '/lescapade/public/admin/logout':
    case '/LESCAPADE/public/admin/logout':
        $adminAuthController->logout();
        break;

    case '/admin/menu':
    case '/lescapade/public/admin/menu':
    case '/LESCAPADE/public/admin/menu':
        $adminMenuController->index();
        break;

    default:
        http_response_code(404);
        echo '<h1>404 - Page non trouvée</h1>';
        echo '<p>Route reçue : ' . htmlspecialchars($path, ENT_QUOTES, 'UTF-8') . '</p>';
        break;
}
