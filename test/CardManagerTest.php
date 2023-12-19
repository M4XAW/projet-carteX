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

    // public function testAddCard() {
    //     // Créer une carte d'exemple
    //     $card = new Card("Exemple Nom", "Exemple Type", "Exemple Frame Type", "Exemple Description", "Exemple Race", "Exemple Archetype", "Exemple Set Name", "Exemple Set Code", "Exemple Set Rarity", "RC", 15.99, "Exemple Image URL");

    //     // Insérer la carte dans la base de données
    //     $lastInsertId = $this->cardManager->addCard($card);

    //     // Vérifier que l'ID retourné n'est pas null
    //     $this->assertNotNull($lastInsertId, "L'ID inséré ne devrait pas être null");

    // }
    // public function testDeleteCard() {
    //     // Assume you have an existing card with an ID
    //     $cardIdToDelete = 8; // Replace with the ID of the card you wish to delete
    
    //     // Ensure the card exists before attempting to delete
    //     $stmt = $this->pdo->prepare("SELECT * FROM Cartes WHERE ID_Carte = ?");
    //     $stmt->execute([$cardIdToDelete]);
    //     $existingCard = $stmt->fetch(PDO::FETCH_ASSOC);
    //     $this->assertNotNull($existingCard, 'Card should exist before deletion');
    
    //     // Call the deleteCard method
    //     $this->cardManager->deleteCard($cardIdToDelete);
    
       
    // }
    public function testUpdateCard() {
        // Préparer une carte avec les informations mises à jour
        $card = new Card();
        $card->setID_Carte(9); // Utilisez l'ID de la carte que vous souhaitez mettre à jour
        $card->setNom("Nom mis à jour");
        $card->setType("Type mis à jour");
        // ... définissez les autres propriétés de la carte ...
    
        // Appeler la méthode updateCard
        $this->cardManager->updateCard($card);
    
        // Récupérer la carte mise à jour de la base de données
        $stmt = $this->pdo->prepare("SELECT * FROM Cartes WHERE ID_Carte = ?");
        $stmt->execute([$card->getID_Carte()]);
        $updatedCard = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Vérifier que la carte récupérée correspond à la carte mise à jour
        $this->assertEquals("Nom mis à jour", $updatedCard['Nom']);
        $this->assertEquals("Type mis à jour", $updatedCard['Type']);
        // ... vérifiez les autres propriétés ...
    
        // Facultatif : vérifier le nombre de lignes affectées si votre méthode updateCard retourne cette information
        // $this->assertEquals(1, $affectedRows);
    }
    
    


    }

?>

        


