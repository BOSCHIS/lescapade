<?php

namespace App\Controller;

use App\Database\Mysql;
use App\Repository\MenuRepository;
use App\Repository\DayRepository;
use App\Repository\SaturdayRepository;

class HomeController
{
    public function __construct() {}

    public function index(): void
    {
        $pdo = Mysql::connectBdd();

        $menuRepository = new MenuRepository($pdo);
        $dayRepository = new DayRepository($pdo);
        $saturdayRepository = new SaturdayRepository($pdo);

        $carouselCategoryIds = [1, 2, 4, 5, 8];

        $carouselItems = $menuRepository->findRandomCarouselItemsByCategoryIds(
            $carouselCategoryIds,
            8
        );

        $today = date('Y-m-d');
        $currentDay = $dayRepository->findCurrentOrLatest($today);
        $currentSaturday = $saturdayRepository->findNearestForHome($today);

        include __DIR__ . '/../../template/template_home.php';
    }
}
