<?php

namespace App\Controller\Admin;

use App\Utils\Auth;

class AdminDashboardController
{
    public function __construct() {}

    public function index(): void
    {
        Auth::requireAdmin();

        include __DIR__ . '/../../../template/admin/dashboard.php';
    }
}
