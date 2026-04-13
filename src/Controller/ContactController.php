<?php

namespace App\Controller;

class ContactController
{
    public function __construct() {}

    public function index(): void
    {
        include __DIR__ . '/../../template/template_contact.php';
    }
}
