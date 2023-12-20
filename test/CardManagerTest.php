<?php

include_once('src/CardManager.php');
include_once('src/Card.php');
include_once('src/config.php');

use PHPUnit\Framework\TestCase;

class CardManagerTest extends TestCase
{
    private $pdo;
    private $cardManager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->configureDatabase();
        $this->cardManager = new CardManager($this->pdo);
    }

    private function configureDatabase(): void
    {
        $this->pdo = new PDO(
            sprintf(
                'mysql:host=%s;port=%s;dbname=%s',
                getenv('DB_HOST'),
                getenv('DB_PORT'),
                getenv('DB_DATABASE')
            ),
            getenv('DB_USERNAME'),
            getenv('DB_PASSWORD')
        );

        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function testRecupererToutesLesCartes() {
        // Récupérer toutes les cartes
        $cards = $this->cardManager->recupererToutesLesCartes();

        // Vérifier que le tableau retourné n'est pas vide
        $this->assertNotEmpty($cards, "Le tableau de cartes ne devrait pas être vide");
    }

    // public function testAddCard() {
    //     // Créer une carte d'exemple
    //     $card = new Card("Exemple Nom", "Exemple Type", "Exemple Frame Type", "Exemple Description", "Exemple Race", "Exemple Archetype", "Exemple Set Name", "Exemple Set Code", "Exemple Set Rarity", "RC", 15.99, "Exemple Image URL");

    //     // Insérer la carte dans la base de données
    //     $lastInsertId = $this->cardManager->addCard($card);

    //     // Vérifier que l'ID retourné n'est pas null
    //     $this->assertNotNull($lastInsertId, "L'ID inséré ne devrait pas être null");

    // }
    // public function testAddExistingCard() {
    //     // Assumer qu'une carte avec ce nom existe déjà dans la base de données
    //     $card = new Card("Nom Existant", "Type", "Frame Type", "Description", "Race", "Archetype", "Set Name", "Set Code", "Set Rarity", "RC", 15.99, "Image URL");
    
    //     // Tenter d'insérer la carte existante dans la base de données
    //     $result = $this->cardManager->addCard($card);
    
    //     // Vérifier que la méthode retourne false
    //     $this->assertFalse($result, "La méthode devrait retourner false pour une carte existante");
    // }
    


    // public function testDeleteCard() {
    // //     // Assume you have an existing card with an ID
    //     $cardIdToDelete = 8; // Replace with the ID of the card you wish to delete
    
    //     // Ensure the card exists before attempting to delete
    //     $stmt = $this->pdo->prepare("SELECT * FROM cards WHERE id = ?");
    //     $stmt->execute([$cardIdToDelete]);
    //     $existingCard = $stmt->fetch(PDO::FETCH_ASSOC);
    //     $this->assertNotNull($existingCard, 'Card should exist before deletion');
    
    //     // Call the deleteCard method
    //     $this->cardManager->deleteCard($cardIdToDelete);
    
       
    // }


    
    }
?>

        


        


