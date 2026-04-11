<?php

namespace App\Utils;

class Auth
{
    public static function isAdminLogged(): bool
    {
        return !empty($_SESSION['admin']['id_administrator']);
    }

    public static function login(array $administrator): void
    {
        session_regenerate_id(true);

        $_SESSION['admin'] = [
            'id_administrator' => (int) $administrator['id_administrator'],
            'name_administrator' => $administrator['name_administrator'],
        ];
    }

    public static function logout(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();

            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                (bool) $params['secure'],
                (bool) $params['httponly']
            );
        }

        session_destroy();
    }

    public static function requireAdmin(): void
    {
        if (!self::isAdminLogged()) {
            header('Location: /admin/login');
            exit;
        }
    }
}
