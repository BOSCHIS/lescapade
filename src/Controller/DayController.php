<?php

namespace App\Controller;

use App\Database\Mysql;
use App\Repository\DayRepository;

class DayController
{
    public function __construct() {}

    public function index(): void
    {
        $pdo = Mysql::connectBdd();
        $dayRepository = new DayRepository($pdo);

        $today = date('Y-m-d');
        $days = $dayRepository->findAllForFront($today);

        include __DIR__ . '/../../template/template_day.php';
    }
}
