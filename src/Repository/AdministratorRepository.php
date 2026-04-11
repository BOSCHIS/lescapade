<?php

namespace App\Repository;

use PDO;

class AdministratorRepository
{
    public function __construct(private PDO $pdo) {}

    public function findByName(string $name): ?array
    {
        $sql = "
            SELECT
                id_administrator,
                name_administrator,
                password_administrator
            FROM administrator
            WHERE name_administrator = :name
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->execute();

        $administrator = $stmt->fetch();

        return $administrator ?: null;
    }
}
