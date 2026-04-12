<?php

namespace App\Repository;

use PDO;

class DayRepository
{
    public function __construct(private PDO $pdo) {}

    public function findAll(): array
    {
        $sql = "
            SELECT
                id_day,
                date_day,
                image_day,
                title_day,
                description_day,
                price_day,
                administrator_id
            FROM day
            ORDER BY date_day DESC, id_day DESC
        ";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll();
    }

    public function findById(int $idDay): array|false
    {
        $sql = "
            SELECT
                id_day,
                date_day,
                image_day,
                title_day,
                description_day,
                price_day,
                administrator_id
            FROM day
            WHERE id_day = :id_day
            LIMIT 1
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_day', $idDay, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function insert(
        string $dateDay,
        ?string $imageDay,
        string $titleDay,
        ?string $descriptionDay,
        float $priceDay,
        ?int $administratorId
    ): void {
        $sql = "
            INSERT INTO day (
                date_day,
                image_day,
                title_day,
                description_day,
                price_day,
                administrator_id
            ) VALUES (
                :date_day,
                :image_day,
                :title_day,
                :description_day,
                :price_day,
                :administrator_id
            )
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':date_day', $dateDay, PDO::PARAM_STR);
        $stmt->bindValue(':image_day', $imageDay, $imageDay === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':title_day', $titleDay, PDO::PARAM_STR);
        $stmt->bindValue(':description_day', $descriptionDay, $descriptionDay === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':price_day', $priceDay);
        $stmt->bindValue(':administrator_id', $administratorId, $administratorId === null ? PDO::PARAM_NULL : PDO::PARAM_INT);

        $stmt->execute();
    }

    public function update(
        int $idDay,
        string $dateDay,
        ?string $imageDay,
        string $titleDay,
        ?string $descriptionDay,
        float $priceDay
    ): void {
        $sql = "
            UPDATE day
            SET
                date_day = :date_day,
                image_day = :image_day,
                title_day = :title_day,
                description_day = :description_day,
                price_day = :price_day
            WHERE id_day = :id_day
        ";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':id_day', $idDay, PDO::PARAM_INT);
        $stmt->bindValue(':date_day', $dateDay, PDO::PARAM_STR);
        $stmt->bindValue(':image_day', $imageDay, $imageDay === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':title_day', $titleDay, PDO::PARAM_STR);
        $stmt->bindValue(':description_day', $descriptionDay, $descriptionDay === null ? PDO::PARAM_NULL : PDO::PARAM_STR);
        $stmt->bindValue(':price_day', $priceDay);

        $stmt->execute();
    }

    public function delete(int $idDay): void
    {
        $sql = "
            DELETE FROM day
            WHERE id_day = :id_day
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id_day', $idDay, PDO::PARAM_INT);
        $stmt->execute();
    }
}
