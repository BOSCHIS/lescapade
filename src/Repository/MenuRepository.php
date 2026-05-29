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

    private function getMaxOrderInCategory(int $categoryId): int
    {
        $sql = "
            SELECT MAX(order_menu) AS max_order
            FROM menu
            WHERE category_id = :category_id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch();

        return isset($result['max_order']) && $result['max_order'] !== null
            ? (int) $result['max_order']
            : 0;
    }

    private function normalizeInsertOrder(int $orderMenu, int $categoryId): int
    {
        $orderMenu = max(1, $orderMenu);
        $maxOrder = $this->getMaxOrderInCategory($categoryId);

        return min($orderMenu, $maxOrder + 1);
    }

    private function normalizeUpdateOrder(
        int $orderMenu,
        int $newCategoryId,
        int $currentCategoryId,
        int $currentOrderMenu
    ): int {
        $orderMenu = max(1, $orderMenu);
        $maxOrder = $this->getMaxOrderInCategory($newCategoryId);

        if ($newCategoryId === $currentCategoryId) {
            // Dans la même catégorie, la position max est le max existant
            // puisqu’on déplace un élément déjà présent.
            return min($orderMenu, max(1, $maxOrder));
        }

        // Dans une nouvelle catégorie, on peut aller à la fin => max + 1
        return min($orderMenu, $maxOrder + 1);
    }

    public function insert(
        string $titleMenu,
        ?string $descriptionMenu,
        ?string $extraMenu,
        float $priceMenu,
        int $orderMenu,
        int $categoryId
    ): void {
        $orderMenu = $this->normalizeInsertOrder($orderMenu, $categoryId);

        $this->pdo->beginTransaction();

        try {
            $shiftSql = "
                UPDATE menu
                SET order_menu = order_menu + 1
                WHERE category_id = :category_id
                  AND order_menu >= :order_menu
            ";

            $shiftStmt = $this->pdo->prepare($shiftSql);
            $shiftStmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
            $shiftStmt->bindValue(':order_menu', $orderMenu, PDO::PARAM_INT);
            $shiftStmt->execute();

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

            $this->pdo->commit();
        } catch (\Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
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
        $currentMenu = $this->findById($idMenu);

        if (!$currentMenu) {
            return;
        }

        $currentCategoryId = (int) $currentMenu['category_id'];
        $currentOrderMenu = (int) $currentMenu['order_menu'];

        $orderMenu = $this->normalizeUpdateOrder(
            $orderMenu,
            $categoryId,
            $currentCategoryId,
            $currentOrderMenu
        );

        $this->pdo->beginTransaction();

        try {
            if ($categoryId === $currentCategoryId) {
                if ($orderMenu < $currentOrderMenu) {
                    $sql = "
                        UPDATE menu
                        SET order_menu = order_menu + 1
                        WHERE category_id = :category_id
                          AND id_menu != :id_menu
                          AND order_menu >= :new_order
                          AND order_menu < :current_order
                    ";

                    $stmt = $this->pdo->prepare($sql);
                    $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
                    $stmt->bindValue(':id_menu', $idMenu, PDO::PARAM_INT);
                    $stmt->bindValue(':new_order', $orderMenu, PDO::PARAM_INT);
                    $stmt->bindValue(':current_order', $currentOrderMenu, PDO::PARAM_INT);
                    $stmt->execute();
                } elseif ($orderMenu > $currentOrderMenu) {
                    $sql = "
                        UPDATE menu
                        SET order_menu = order_menu - 1
                        WHERE category_id = :category_id
                          AND id_menu != :id_menu
                          AND order_menu <= :new_order
                          AND order_menu > :current_order
                    ";

                    $stmt = $this->pdo->prepare($sql);
                    $stmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
                    $stmt->bindValue(':id_menu', $idMenu, PDO::PARAM_INT);
                    $stmt->bindValue(':new_order', $orderMenu, PDO::PARAM_INT);
                    $stmt->bindValue(':current_order', $currentOrderMenu, PDO::PARAM_INT);
                    $stmt->execute();
                }
            } else {
                $closeOldSql = "
                    UPDATE menu
                    SET order_menu = order_menu - 1
                    WHERE category_id = :old_category_id
                      AND order_menu > :old_order_menu
                ";

                $closeOldStmt = $this->pdo->prepare($closeOldSql);
                $closeOldStmt->bindValue(':old_category_id', $currentCategoryId, PDO::PARAM_INT);
                $closeOldStmt->bindValue(':old_order_menu', $currentOrderMenu, PDO::PARAM_INT);
                $closeOldStmt->execute();

                $openNewSql = "
                    UPDATE menu
                    SET order_menu = order_menu + 1
                    WHERE category_id = :new_category_id
                      AND order_menu >= :new_order_menu
                ";

                $openNewStmt = $this->pdo->prepare($openNewSql);
                $openNewStmt->bindValue(':new_category_id', $categoryId, PDO::PARAM_INT);
                $openNewStmt->bindValue(':new_order_menu', $orderMenu, PDO::PARAM_INT);
                $openNewStmt->execute();
            }

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

            $this->pdo->commit();
        } catch (\Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
    }

    public function delete(int $idMenu): void
    {
        $currentMenu = $this->findById($idMenu);

        if (!$currentMenu) {
            return;
        }

        $categoryId = (int) $currentMenu['category_id'];
        $orderMenu = (int) $currentMenu['order_menu'];

        $this->pdo->beginTransaction();

        try {
            $deleteSql = "
                DELETE FROM menu
                WHERE id_menu = :id_menu
            ";

            $deleteStmt = $this->pdo->prepare($deleteSql);
            $deleteStmt->bindValue(':id_menu', $idMenu, PDO::PARAM_INT);
            $deleteStmt->execute();

            $reorderSql = "
                UPDATE menu
                SET order_menu = order_menu - 1
                WHERE category_id = :category_id
                  AND order_menu > :order_menu
            ";

            $reorderStmt = $this->pdo->prepare($reorderSql);
            $reorderStmt->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
            $reorderStmt->bindValue(':order_menu', $orderMenu, PDO::PARAM_INT);
            $reorderStmt->execute();

            $this->pdo->commit();
        } catch (\Throwable $e) {
            $this->pdo->rollBack();
            throw $e;
        }
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
