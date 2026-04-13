<?php

namespace App\Controller;

use App\Database\Mysql;
use App\Repository\MenuRepository;
use App\Repository\DayRepository;

class HomeController
{
    public function __construct() {}

    public function index(): void
    {
        $pdo = Mysql::connectBdd();

        $menuRepository = new MenuRepository($pdo);
        $dayRepository = new DayRepository($pdo);

        // Catégories autorisées dans le carrousel
        // Le choix repose sur les ID techniques, pas sur l'ordre d'affichage.
        $carouselCategoryIds = [1, 2, 4, 5, 8];

        $carouselItems = $menuRepository->findRandomCarouselItemsByCategoryIds(
            $carouselCategoryIds,
            8
        );

        $today = date('Y-m-d');
        $currentDay = $dayRepository->findCurrentOrLatest($today);

        include __DIR__ . '/../../template/template_home.php';
    }
}
