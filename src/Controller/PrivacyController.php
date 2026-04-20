<?php

namespace App\Controller;

class PrivacyController
{
    public function index(): void
    {
        require_once dirname(__DIR__, 2) . '/template/template_confidentialite.php';
    }
}
