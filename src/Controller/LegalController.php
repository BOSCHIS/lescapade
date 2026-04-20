<?php

namespace App\Controller;

class LegalController
{
    public function index(): void
    {
        require_once dirname(__DIR__, 2) . '/template/template_mentions_legales.php';
    }
}
