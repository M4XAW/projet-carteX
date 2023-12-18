<?php

use PHPUnit\Framework\TestCase;
require_once('src/Carte.php');
require_once('src/CarteManager.php');

class CarteManagerTest extends TestCase {
    private $pdo;
    private $carteManager;

    protected function setUp(): void {
        $this->pdo = new PDO('mysql:host=your_host;dbname=your_database', 'your_username', 'your_password');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Initialise ton objet CarteManager avec la connexion PDO
        $this->carteManager = new CarteManager($this->pdo);
    }

    public function testCreateCard(): void {
        $name = 'Nom de la carte';
        $description = 'Description de la carte';
        $type = 'Type de la carte';
        $image = 'url_de_l_image.jpg';
        $race = 'Race de la carte';
        $setName = 'Nom de l\'ensemble';
        $cardArchetype = 'Archétype de la carte';
        $setCode = 'Code de l\'ensemble';
        $setRarity = 'Rarete de l\'ensemble';

        // Exécute la méthode createCard
        $newCardId = $this->carteManager->createCard($name, $description, $type, $image, $race, $setName, $cardArchetype, $setCode, $setRarity);

        // Vérifie que l'ID retourné est un entier positif
        $this->assertGreaterThan(0, $newCardId);
    }

    protected function tearDown(): void {
        // Supprime les éventuelles données de test après chaque exécution de test
        $this->pdo = null;
        $this->carteManager = null;
    }
}

?>