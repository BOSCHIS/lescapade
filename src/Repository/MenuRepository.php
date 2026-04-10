<?php

namespace App\Repository;

use PDO;

class MenuRepository
{
    public function __construct(private PDO $pdo) {}

    public function findRandomCarouselItemsByCategoryIds(array $categoryIds, int $limit = 8): array
    {
        if (empty($categoryIds)) {
            return [];
        }

        $limit = max(1, (int) $limit);
        $placeholders = implode(',', array_fill(0, count($categoryIds), '?'));

        $sql = "
            SELECT
                m.id_menu,
                m.title_menu,
                m.description_menu,
                m.price_menu,
                c.id_category,
                c.name_category
            FROM menu m
            INNER JOIN category c ON c.id_category = m.category_id
            WHERE m.category_id IN ($placeholders)
              AND m.price_menu IS NOT NULL
            ORDER BY RAND()
            LIMIT $limit
        ";

        $stmt = $this->pdo->prepare($sql);

        foreach ($categoryIds as $index => $categoryId) {
            $stmt->bindValue($index + 1, (int) $categoryId, PDO::PARAM_INT);
        }

        $stmt->execute();

        return $stmt->fetchAll();
    }
}
