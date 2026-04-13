<?php

namespace App\Controller;

use App\Database\Mysql;
use App\Repository\SaturdayRepository;

class SaturdayController
{
    public function __construct() {}

    public function index(): void
    {
        $pdo = Mysql::connectBdd();
        $repository = new SaturdayRepository($pdo);

        $today = date('Y-m-d');
        $saturdays = $repository->findAllForFront($today);

        include __DIR__ . '/../../template/template_saturday.php';
    }
}
