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
use App\Controller\DayController;
use App\Controller\SaturdayController;
use App\Controller\HistoryController;
use App\Controller\ContactController;
use App\Controller\Admin\AdminAuthController;
use App\Controller\Admin\AdminDashboardController;
use App\Controller\Admin\AdminMenuController;
use App\Controller\Admin\AdminDayController;
use App\Controller\Admin\AdminSaturdayController;

$url = parse_url($_SERVER['REQUEST_URI']);
$path = $url['path'] ?? '/';

$homeController = new HomeController();
$menuController = new MenuController();
$dayController = new DayController();
$saturdayController = new SaturdayController();
$historyController = new HistoryController();
$contactController = new ContactController();
$adminAuthController = new AdminAuthController();
$adminDashboardController = new AdminDashboardController();
$adminMenuController = new AdminMenuController();
$adminDayController = new AdminDayController();
$adminSaturdayController = new AdminSaturdayController();

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

    case '/plat-du-jour':
    case '/lescapade/public/plat-du-jour':
    case '/LESCAPADE/public/plat-du-jour':
        $dayController->index();
        break;

    case '/plat-du-samedi':
    case '/lescapade/public/plat-du-samedi':
    case '/LESCAPADE/public/plat-du-samedi':
        $saturdayController->index();
        break;

    case '/histoire':
    case '/lescapade/public/histoire':
    case '/LESCAPADE/public/histoire':
        $historyController->index();
        break;

    case '/contact':
    case '/reservation':
    case '/lescapade/public/contact':
    case '/lescapade/public/reservation':
    case '/LESCAPADE/public/contact':
    case '/LESCAPADE/public/reservation':
        $contactController->index();
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

    case '/admin/menu/create':
    case '/lescapade/public/admin/menu/create':
    case '/LESCAPADE/public/admin/menu/create':
        $adminMenuController->create();
        break;

    case '/admin/menu/store':
    case '/lescapade/public/admin/menu/store':
    case '/LESCAPADE/public/admin/menu/store':
        $adminMenuController->store();
        break;

    case '/admin/menu/edit':
    case '/lescapade/public/admin/menu/edit':
    case '/LESCAPADE/public/admin/menu/edit':
        $adminMenuController->edit();
        break;

    case '/admin/menu/update':
    case '/lescapade/public/admin/menu/update':
    case '/LESCAPADE/public/admin/menu/update':
        $adminMenuController->update();
        break;

    case '/admin/menu/delete':
    case '/lescapade/public/admin/menu/delete':
    case '/LESCAPADE/public/admin/menu/delete':
        $adminMenuController->delete();
        break;

    case '/admin/menu/move-up':
    case '/lescapade/public/admin/menu/move-up':
    case '/LESCAPADE/public/admin/menu/move-up':
        $adminMenuController->moveUp();
        break;

    case '/admin/menu/move-down':
    case '/lescapade/public/admin/menu/move-down':
    case '/LESCAPADE/public/admin/menu/move-down':
        $adminMenuController->moveDown();
        break;

    case '/admin/day':
    case '/lescapade/public/admin/day':
    case '/LESCAPADE/public/admin/day':
        $adminDayController->index();
        break;

    case '/admin/day/create':
    case '/lescapade/public/admin/day/create':
    case '/LESCAPADE/public/admin/day/create':
        $adminDayController->create();
        break;

    case '/admin/day/store':
    case '/lescapade/public/admin/day/store':
    case '/LESCAPADE/public/admin/day/store':
        $adminDayController->store();
        break;

    case '/admin/day/edit':
    case '/lescapade/public/admin/day/edit':
    case '/LESCAPADE/public/admin/day/edit':
        $adminDayController->edit();
        break;

    case '/admin/day/update':
    case '/lescapade/public/admin/day/update':
    case '/LESCAPADE/public/admin/day/update':
        $adminDayController->update();
        break;

    case '/admin/day/delete':
    case '/lescapade/public/admin/day/delete':
    case '/LESCAPADE/public/admin/day/delete':
        $adminDayController->delete();
        break;

    case '/admin/saturday':
    case '/lescapade/public/admin/saturday':
    case '/LESCAPADE/public/admin/saturday':
        $adminSaturdayController->index();
        break;

    case '/admin/saturday/create':
    case '/lescapade/public/admin/saturday/create':
    case '/LESCAPADE/public/admin/saturday/create':
        $adminSaturdayController->create();
        break;

    case '/admin/saturday/store':
    case '/lescapade/public/admin/saturday/store':
    case '/LESCAPADE/public/admin/saturday/store':
        $adminSaturdayController->store();
        break;

    case '/admin/saturday/edit':
    case '/lescapade/public/admin/saturday/edit':
    case '/LESCAPADE/public/admin/saturday/edit':
        $adminSaturdayController->edit();
        break;

    case '/admin/saturday/update':
    case '/lescapade/public/admin/saturday/update':
    case '/LESCAPADE/public/admin/saturday/update':
        $adminSaturdayController->update();
        break;

    case '/admin/saturday/delete':
    case '/lescapade/public/admin/saturday/delete':
    case '/LESCAPADE/public/admin/saturday/delete':
        $adminSaturdayController->delete();
        break;

    default:
        http_response_code(404);
        echo '<h1>404 - Page non trouvée</h1>';
        echo '<p>Route reçue : ' . htmlspecialchars($path, ENT_QUOTES, 'UTF-8') . '</p>';
        break;
}
