<?php

namespace App\Database;

use PDO;
use PDOException;

class Mysql
{
    public static function connectBdd(): PDO
    {
        try {
            return new PDO(
                'mysql:host=' . $_ENV['DATABASE_HOST'] .
                    ';dbname=' . $_ENV['DATABASE_NAME'] .
                    ';charset=utf8mb4',
                $_ENV['DATABASE_USERNAME'],
                $_ENV['DATABASE_PASSWORD'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }
}
