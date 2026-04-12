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
                m.extra_menu,
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

    public function findAllMenuGroupedByCategory(): array
    {
        $sql = "
            SELECT
                c.id_category,
                c.name_category,
                c.order_category,
                m.id_menu,
                m.title_menu,
                m.description_menu,
                m.extra_menu,
                m.price_menu,
                m.order_menu
            FROM category c
            LEFT JOIN menu m ON m.category_id = c.id_category
            ORDER BY c.order_category ASC, m.order_menu ASC, m.id_menu ASC
        ";

        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();

        $menuByCategory = [];

        foreach ($rows as $row) {
            $categoryName = $row['name_category'];

            if (!isset($menuByCategory[$categoryName])) {
                $menuByCategory[$categoryName] = [];
            }

            if (!empty($row['id_menu'])) {
                $menuByCategory[$categoryName][] = [
                    'id_menu' => $row['id_menu'],
                    'title_menu' => $row['title_menu'],
                    'description_menu' => $row['description_menu'],
                    'extra_menu' => $row['extra_menu'],
                    'price_menu' => $row['price_menu'],
                    'order_menu' => $row['order_menu'],
                ];
            }
        }

        return $menuByCategory;
    }

    public function findAllWithCategory(): array
    {
        $sql = "
            SELECT
                m.id_menu,
                m.title_menu,
                m.description_menu,
                m.extra_menu,
                m.price_menu,
                m.order_menu,
                m.category_id,
                c.name_category
            FROM menu m
            INNER JOIN category c ON c.id_category = m.category_id
            ORDER BY c.order_category ASC, m.order_menu ASC, m.id_menu ASC
        ";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }
}
