<?php

namespace App\Repository;

use App\Database\Mysql;
use App\Entity\Console;

class ConsoleRepository
{
    //Attribut
    private \PDO $connect;

    //Constructeur
    public function __construct()
    {
        //Injection des dependances
        $this->connect = (new Mysql)->connectBdd();
    }

    //Méthodes
    /**
     * Méthode qui retourne la liste des consoles (Console)
     * @return array<Console> Retourne le tableau des consoles (Console)
     * @throws \Exception Erreurs SQL
     */
    public function findAllConsoles(): array
    {
        //requête SQL
        $sql = "SELECT id, name, manufacturer FROM console";
        // Préparation de la requête
        $stmt = $this->connect->prepare($sql);

        //Je l'execute 
        $stmt->execute();

        //rETURN EN FETCH ALL ASSOC
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
