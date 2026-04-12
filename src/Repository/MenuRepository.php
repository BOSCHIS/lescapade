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

    public function findById(int $idMenu): array|false
    {
        $sql = "
            SELECT
                id_menu,
                title_menu,
                description_menu,
                extra_menu,
                price_menu,
                order_menu,
                category_id
            FROM menu
            WHERE id_menu = :id_menu
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_menu', $idMenu, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function insert(
        string $titleMenu,
        ?string $descriptionMenu,
        ?string $extraMenu,
        float $priceMenu,
        int $orderMenu,
        int $categoryId
    ): void {
        $sql = "
            INSERT INTO menu (
                title_menu,
                description_menu,
                extra_menu,
                price_menu,
                order_menu,
                category_id
            ) VALUES (
                :title_menu,
                :description_menu,
                :extra_menu,
                :price_menu,
                :order_menu,
                :category_id
            )
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':title_menu', $titleMenu, PDO::PARAM_STR);
        $stmt->bindValue(':description_menu', $descriptionMenu, $descriptionMenu === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':extra_menu', $extraMenu, $extraMenu === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':price_menu', $priceMenu);
        $stmt->bindValue(':order_menu', $orderMenu, PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function update(
        int $idMenu,
        string $titleMenu,
        ?string $descriptionMenu,
        ?string $extraMenu,
        float $priceMenu,
        int $orderMenu,
        int $categoryId
    ): void {
        $sql = "
            UPDATE menu
            SET
                title_menu = :title_menu,
                description_menu = :description_menu,
                extra_menu = :extra_menu,
                price_menu = :price_menu,
                order_menu = :order_menu,
                category_id = :category_id
            WHERE id_menu = :id_menu
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id_menu', $idMenu, PDO::PARAM_INT);
        $stmt->bindValue(':title_menu', $titleMenu, PDO::PARAM_STR);
        $stmt->bindValue(':description_menu', $descriptionMenu, $descriptionMenu === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':extra_menu', $extraMenu, $extraMenu === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':price_menu', $priceMenu);
        $stmt->bindValue(':order_menu', $orderMenu, PDO::PARAM_INT);
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function delete(int $idMenu): void
    {
        $sql = "
            DELETE FROM menu
            WHERE id_menu = :id_menu
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_menu', $idMenu, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function findPreviousInCategory(int $categoryId, int $orderMenu, int $idMenu): array|false
    {
        $sql = "
            SELECT
                id_menu,
                order_menu,
                category_id
            FROM menu
            WHERE category_id = :category_id
              AND (
                    order_menu < :order_menu_less
                    OR (order_menu = :order_menu_equal AND id_menu < :id_menu)
              )
            ORDER BY order_menu DESC, id_menu DESC
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':order_menu_less', $orderMenu, PDO::PARAM_INT);
        $stmt->bindValue(':order_menu_equal', $orderMenu, PDO::PARAM_INT);
        $stmt->bindValue(':id_menu', $idMenu, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function findNextInCategory(int $categoryId, int $orderMenu, int $idMenu): array|false
    {
        $sql = "
            SELECT
                id_menu,
                order_menu,
                category_id
            FROM menu
            WHERE category_id = :category_id
              AND (
                    order_menu > :order_menu_greater
                    OR (order_menu = :order_menu_equal AND id_menu > :id_menu)
              )
            ORDER BY order_menu ASC, id_menu ASC
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':order_menu_greater', $orderMenu, PDO::PARAM_INT);
        $stmt->bindValue(':order_menu_equal', $orderMenu, PDO::PARAM_INT);
        $stmt->bindValue(':id_menu', $idMenu, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function swapOrder(int $firstIdMenu, int $firstOrderMenu, int $secondIdMenu, int $secondOrderMenu): void
    {
        $this->pdo->beginTransaction();

        try {
            $sql = "
                UPDATE menu
                SET order_menu = :order_menu
                WHERE id_menu = :id_menu
            ";

            $stmt = $this->pdo->prepare($sql);

            $stmt->bindValue(':order_menu', $secondOrderMenu, PDO::PARAM_INT);
            $stmt->bindValue(':id_menu', $firstIdMenu, PDO::PARAM_INT);
            $stmt->execute();

            $stmt->bindValue(':order_menu', $firstOrderMenu, PDO::PARAM_INT);
            $stmt->bindValue(':id_menu', $secondIdMenu, PDO::PARAM_INT);
            $stmt->execute();

            $this->pdo->commit();
        } catch (\Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }
}
