<?php

namespace App\Controller;

use App\Database\Mysql;
use App\Repository\MenuRepository;

class HomeController
{
    public function __construct() {}

    public function index(): void
    {
        $pdo = Mysql::connectBdd();

        $menuRepository = new MenuRepository($pdo);

        // Catégories autorisées dans le carrousel
        // Le choix repose sur les ID techniques, pas sur l'ordre d'affichage.
        $carouselCategoryIds = [1, 2, 4, 5, 8];

        $carouselItems = $menuRepository->findRandomCarouselItemsByCategoryIds(
            $carouselCategoryIds,
            8
        );

        include __DIR__ . '/../../template/template_home.php';
    }
}
