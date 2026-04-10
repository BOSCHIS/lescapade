<?php

namespace App\Repository;

use App\Database\Mysql;
use App\Entity\Console;
use App\Entity\Game;

class GameRepository
{
    //Attribut
    private \PDO $connect;

    //Constructeur
    public function __construct()
    {
        //Injection des dependances
        $this->connect = (new Mysql)->connectBDD();
    }

    //Méthodes

    /**
     * Méthode qui ajoute une jeu (Game) en BDD
     * @return void
     * @throws \Exception Erreurs SQL
     */
    public function saveGame(Game $game): void
    {
        //requête SQL
        $sql = "INSERT INTO video_game (title, `type`, publish_at, id_console) VALUES (:title, :type, :publish_at, :id_console)";
        // Préparation de la requête
        $stmt = $this->connect->prepare($sql);

        //Je lie les paramètres avec les valeurs de l'objet Game
        $stmt->bindValue(':title', $game->getTitle(), \PDO::PARAM_STR);
        $stmt->bindValue(':type', $game->getType(), \PDO::PARAM_STR);
        $stmt->bindValue(':publish_at', $game->getPublishAt(), \PDO::PARAM_STR);
        $stmt->bindValue(':id_console', $game->getConsole()->getId(), \PDO::PARAM_INT);

        //J'execute la requête
        $stmt->execute();
    }

    /**
     * Méthode qui retourne la liste des jeux (Game)
     * @return array<Game> Retourne le tableau des jeux (Game)
     * @throws \Exception Erreurs SQL
     */
    public function findAllGames(): array
    {
        // Requête SQL
        $sql = 'SELECT vg.title, vg.type, vg.publish_at, c.name
            FROM video_game vg
            INNER JOIN console c ON vg.id_console = c.id';

        // Préparatin de la requête
        $stmt = $this->connect->prepare($sql);

        // Exécution
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
