<?php

namespace App\Repository;

use PDO;

class CategoryRepository
{
    public function __construct(private PDO $pdo) {}

    public function findAll(): array
    {
        $sql = "
            SELECT
                id_category,
                name_category,
                order_category
            FROM category
            ORDER BY order_category ASC, id_category ASC
        ";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }
}
