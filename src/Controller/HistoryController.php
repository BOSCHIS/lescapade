<?php

namespace App\Controller;

class HistoryController
{
    public function __construct() {}

    public function index(): void
    {
        include __DIR__ . '/../../template/template_history.php';
    }
}
