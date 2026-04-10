<?php

namespace App\Entity;

class Console
{
    //Attributs
    private int $id;
    private string $name;
    private string $manufacturer;

    //Constructeur
    public function __construct(int $id = 0, string $name = '', string $manufacturer = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->manufacturer = $manufacturer;
    }

    //Getters et Setters
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): void
    {
        $this->manufacturer = $manufacturer;
    }
}
