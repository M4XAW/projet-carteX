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

    public function testAddCard() {
        // Créer une carte d'exemple
        $card = new Card("Exemple Nom", "Exemple Type", "Exemple Frame Type", "Exemple Description", "Exemple Race", "Exemple Archetype", "Exemple Set Name", "Exemple Set Code", "Exemple Set Rarity", "RC", 15.99, "Exemple Image URL");

        // Insérer la carte dans la base de données
        $lastInsertId = $this->cardManager->addCard($card);

        // Vérifier que l'ID retourné n'est pas null
        $this->assertNotNull($lastInsertId, "L'ID inséré ne devrait pas être null");

    }


    // public function testDeleteCard() {
    //     // Assume you have an existing card with an ID
    //     $cardIdToDelete = 8; // Replace with the ID of the card you wish to delete
    
    //     Ensure the card exists before attempting to delete
    //     $stmt = $this->pdo->prepare("SELECT * FROM cards WHERE id = ?");
    //     $stmt->execute([$cardIdToDelete]);
    //     $existingCard = $stmt->fetch(PDO::FETCH_ASSOC);
    //     $this->assertNotNull($existingCard, 'Card should exist before deletion');
    
    //     // Call the deleteCard method
    //     $this->cardManager->deleteCard($cardIdToDelete);
    
       
    // }


//     public function testUpdateCard() {
//         // Supposons que vous ayez déjà une carte existante en base de données avec un ID connu.
//         $existingCardID = 1;

//         // Créez une instance de la classe Card avec les nouvelles valeurs que vous souhaitez mettre à jour.
//         $newCard = new Card();
//         $newCard->setID_Carte($existingCardID);
//         $newCard->setNom("Nouveau Nom");
//         $newCard->setType("Nouveau Type");
//         // ... (définissez d'autres propriétés)

//         // Appelez la fonction updateCard pour effectuer la mise à jour.
//         $cardManager = new CardManager($this->pdo); // Supposons que vous avez une classe CardManager pour gérer les opérations de carte.
//         $result = $cardManager->updateCard($newCard);

//         // Vérifiez le résultat de la mise à jour.
//         $this->assertStringContainsString("Mise à jour réussie.", $result); // Ou d'autres assertions appropriées.

//         // Vous pouvez également récupérer la carte mise à jour depuis la base de données et vérifier si les valeurs ont été correctement mises à jour.
//         $updatedCard = $cardManager->getCardByID($existingCardID); // Supposons que vous avez une méthode pour récupérer une carte par ID.
//         $this->assertEquals("Nouveau Nom", $updatedCard->getNom());
//         $this->assertEquals("Nouveau Type", $updatedCard->getType());
//         // ... (vérifiez d'autres propriétés)

//         // Remarque : Assurez-vous de gérer proprement la suppression ou la réinitialisation de la base de données de test après ce test.
//     }
// }
    




?>

        


