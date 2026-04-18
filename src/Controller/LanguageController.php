<?php

namespace App\Controller;

use App\Utils\Lang;

class LanguageController
{
    public function __construct() {}

    public function switch(): void
    {
        $locale = $_GET['locale'] ?? 'fr';
        Lang::setLocale($locale);

        $redirect = $_SERVER['HTTP_REFERER'] ?? '/';

        $parsedUrl = parse_url($redirect);
        $path = $parsedUrl['path'] ?? '/';
        $query = isset($parsedUrl['query']) ? '?' . $parsedUrl['query'] : '';

        header('Location: ' . $path . $query);
        exit;
    }
}
