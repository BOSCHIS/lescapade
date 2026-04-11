<?php

namespace App\Controller\Admin;

use App\Database\Mysql;
use App\Repository\AdministratorRepository;
use App\Utils\Auth;
use App\Utils\Csrf;

class AdminAuthController
{
    public function __construct() {}

    public function login(): void
    {
        if (Auth::isAdminLogged()) {
            header('Location: /admin');
            exit;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $csrfToken = $_POST['_csrf_token'] ?? null;

            if (!Csrf::validate($csrfToken)) {
                $error = 'La session du formulaire a expiré. Veuillez réessayer.';
            } else {
                $name = trim($_POST['name_administrator'] ?? '');
                $password = $_POST['password_administrator'] ?? '';

                if ($name === '' || $password === '') {
                    $error = 'Veuillez remplir tous les champs.';
                } else {
                    $pdo = Mysql::connectBdd();
                    $administratorRepository = new AdministratorRepository($pdo);

                    $administrator = $administratorRepository->findByName($name);

                    if ($administrator && password_verify($password, $administrator['password_administrator'])) {
                        Auth::login($administrator);
                        header('Location: /admin');
                        exit;
                    }

                    $error = 'Identifiants incorrects.';
                }
            }
        }

        include __DIR__ . '/../../../template/admin/login.php';
    }

    public function logout(): void
    {
        Auth::logout();
        header('Location: /admin/login');
        exit;
    }
}
