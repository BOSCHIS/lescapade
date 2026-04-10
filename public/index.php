<?php

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

use App\Controller\HomeController;

$url = parse_url($_SERVER['REQUEST_URI']);
$path = $url['path'] ?? '/';

$homeController = new HomeController();

switch ($path) {
    case '/':
    case '/lescapade/public/':
    case '/lescapade/public/index.php':
    case '/LESCAPADE/public/':
    case '/LESCAPADE/public/index.php':
        $homeController->index();
        break;

    default:
        http_response_code(404);
        echo '<h1>404 - Page non trouvée</h1>';
        echo '<p>Route reçue : ' . htmlspecialchars($path, ENT_QUOTES, 'UTF-8') . '</p>';
        break;
}
