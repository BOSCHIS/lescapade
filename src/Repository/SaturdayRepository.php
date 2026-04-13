<?php

namespace App\Repository;

use PDO;

class SaturdayRepository
{
    public function __construct(private PDO $pdo) {}

    public function findAll(): array
    {
        $sql = "
            SELECT
                id_saturday,
                date_saturday,
                image_saturday,
                title_saturday,
                description_saturday,
                price_saturday,
                administrator_id
            FROM saturday
            ORDER BY date_saturday DESC, id_saturday DESC
        ";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    public function findAllForFront(string $today): array
    {
        $sql = "
            SELECT
                id_saturday,
                date_saturday,
                image_saturday,
                title_saturday,
                description_saturday,
                price_saturday,
                administrator_id
            FROM saturday
            ORDER BY
                CASE
                    WHEN date_saturday >= :today_case THEN 0
                    ELSE 1
                END ASC,
                CASE
                    WHEN date_saturday >= :today_future THEN date_saturday
                    ELSE NULL
                END ASC,
                CASE
                    WHEN date_saturday < :today_past THEN date_saturday
                    ELSE NULL
                END DESC,
                id_saturday DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':today_case', $today, PDO::PARAM_STR);
        $stmt->bindValue(':today_future', $today, PDO::PARAM_STR);
        $stmt->bindValue(':today_past', $today, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function findNearestForHome(string $today): array|false
    {
        $sql = "
            SELECT
                id_saturday,
                date_saturday,
                image_saturday,
                title_saturday,
                description_saturday,
                price_saturday,
                administrator_id
            FROM saturday
            ORDER BY
                CASE
                    WHEN date_saturday >= :today_case THEN 0
                    ELSE 1
                END ASC,
                CASE
                    WHEN date_saturday >= :today_future THEN date_saturday
                    ELSE NULL
                END ASC,
                CASE
                    WHEN date_saturday < :today_past THEN date_saturday
                    ELSE NULL
                END DESC,
                id_saturday DESC
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':today_case', $today, PDO::PARAM_STR);
        $stmt->bindValue(':today_future', $today, PDO::PARAM_STR);
        $stmt->bindValue(':today_past', $today, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function findById(int $idSaturday): array|false
    {
        $sql = "
            SELECT
                id_saturday,
                date_saturday,
                image_saturday,
                title_saturday,
                description_saturday,
                price_saturday,
                administrator_id
            FROM saturday
            WHERE id_saturday = :id_saturday
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_saturday', $idSaturday, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function findByDate(string $dateSaturday): array|false
    {
        $sql = "
            SELECT
                id_saturday,
                date_saturday,
                image_saturday,
                title_saturday,
                description_saturday,
                price_saturday,
                administrator_id
            FROM saturday
            WHERE date_saturday = :date_saturday
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':date_saturday', $dateSaturday, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function findLatest(): array|false
    {
        $sql = "
            SELECT
                id_saturday,
                date_saturday,
                image_saturday,
                title_saturday,
                description_saturday,
                price_saturday,
                administrator_id
            FROM saturday
            ORDER BY date_saturday DESC, id_saturday DESC
            LIMIT 1
        ";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetch();
    }

    public function findCurrentOrLatest(string $dateSaturday): array|false
    {
        $item = $this->findByDate($dateSaturday);

        if ($item) {
            return $item;
        }

        return $this->findLatest();
    }

    public function insert(
        string $dateSaturday,
        ?string $imageSaturday,
        string $titleSaturday,
        ?string $descriptionSaturday,
        float $priceSaturday,
        ?int $administratorId
    ): void {
        $sql = "
            INSERT INTO saturday (
                date_saturday,
                image_saturday,
                title_saturday,
                description_saturday,
                price_saturday,
                administrator_id
            ) VALUES (
                :date_saturday,
                :image_saturday,
                :title_saturday,
                :description_saturday,
                :price_saturday,
                :administrator_id
            )
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':date_saturday', $dateSaturday, PDO::PARAM_STR);
        $stmt->bindValue(':image_saturday', $imageSaturday, $imageSaturday === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':title_saturday', $titleSaturday, PDO::PARAM_STR);
        $stmt->bindValue(':description_saturday', $descriptionSaturday, $descriptionSaturday === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':price_saturday', $priceSaturday);
        $stmt->bindValue(':administrator_id', $administratorId, $administratorId === null ? PDO::PARAM_NULL : PDO::PARAM_INT);

        $stmt->execute();
    }

    public function update(
        int $idSaturday,
        string $dateSaturday,
        ?string $imageSaturday,
        string $titleSaturday,
        ?string $descriptionSaturday,
        float $priceSaturday
    ): void {
        $sql = "
            UPDATE saturday
            SET
                date_saturday = :date_saturday,
                image_saturday = :image_saturday,
                title_saturday = :title_saturday,
                description_saturday = :description_saturday,
                price_saturday = :price_saturday
            WHERE id_saturday = :id_saturday
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id_saturday', $idSaturday, PDO::PARAM_INT);
        $stmt->bindValue(':date_saturday', $dateSaturday, PDO::PARAM_STR);
        $stmt->bindValue(':image_saturday', $imageSaturday, $imageSaturday === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':title_saturday', $titleSaturday, PDO::PARAM_STR);
        $stmt->bindValue(':description_saturday', $descriptionSaturday, $descriptionSaturday === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':price_saturday', $priceSaturday);

        $stmt->execute();
    }

    public function delete(int $idSaturday): void
    {
        $sql = "
            DELETE FROM saturday
            WHERE id_saturday = :id_saturday
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_saturday', $idSaturday, PDO::PARAM_INT);
        $stmt->execute();
    }
}
