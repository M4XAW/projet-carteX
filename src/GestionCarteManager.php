<?php

class CarteManager
{
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }


    public function getCarteById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM cards WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $carte = $stmt->fetch(PDO::FETCH_ASSOC);
        return $carte;
    }
    public function createCard($name, $description, $type, $image, $race, $setName, $cardArchetype, $setCode, $setRarity) {
        $stmt = $this->pdo->prepare("INSERT INTO cards (name, description, type, image, race, SetName, card_archetype, card_set_code, card_set_rarity) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $description, $type, $image, $race, $setName, $cardArchetype, $setCode, $setRarity]);
        
        return $this->pdo->lastInsertId();
    }

    
}

    