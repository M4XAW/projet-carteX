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
    
    //     // Ensure the card exists before attempting to delete
    //     $stmt = $this->pdo->prepare("SELECT * FROM Cartes WHERE ID_Carte = ?");
    //     $stmt->execute([$cardIdToDelete]);
    //     $existingCard = $stmt->fetch(PDO::FETCH_ASSOC);
    //     $this->assertNotNull($existingCard, 'Card should exist before deletion');
    
    //     // Call the deleteCard method
    //     $this->cardManager->deleteCard($cardIdToDelete);
    
       
    // }


    // public function testUpdateCard() {
    //     $cardIdToUpdate = 9; // L'ID de la carte à mettre à jour

    //     try {
    //         // Récupérer les informations actuelles de la carte
    //         $stmt = $this->pdo->prepare("SELECT * FROM Cartes WHERE ID_Carte = ?");
    //         $stmt->execute([$cardIdToUpdate]);
    //         $existingCardData = $stmt->fetch(PDO::FETCH_ASSOC);

    //         if (!$existingCardData) {
    //             throw new Exception('Card not found.');
    //         }

    //         // Créer une instance de Card avec les données existantes
    //         $cardToUpdate = new Card(
    //             $existingCardData['Nom'],
    //             $existingCardData['Type'],
    //             $existingCardData['Frame_Type'],
    //             $existingCardData['Description'],
    //             $existingCardData['Race'],
    //             $existingCardData['Archetype'],
    //             $existingCardData['Set_Name'],
    //             $existingCardData['Set_Code'],
    //             $existingCardData['Set_Rarity'],
    //             $existingCardData['Set_Rarity_Code'],
    //             $existingCardData['Set_Price'],
    //             $existingCardData['Image_URL']
    //         );

    //         // Modifier les propriétés nécessaires de la carte
    //         $cardToUpdate->setNom("Nom mis à jour");
    //         // ... Mettez à jour les autres propriétés si nécessaire

    //         // Mettre à jour la carte dans la base de données
    //         $this->cardManager->updateCard($cardToUpdate);

    //         // Récupérer les données mises à jour pour vérifier
    //         $stmt->execute([$cardIdToUpdate]);
    //         $updatedCardData = $stmt->fetch(PDO::FETCH_ASSOC);

    //         // Assertions pour vérifier la mise à jour
    //         assert($updatedCardData['Nom'] === "Nom mis à jour", "Le nom de la carte doit être mis à jour");
    //         // ... Ajoutez d'autres assertions pour les autres champs

    //         echo "Test de mise à jour réussi.\n";
    //     } catch (Exception $e) {
    //         echo "Erreur lors du test de mise à jour : " . $e->getMessage() . "\n";
    //     }
    // }
    
    


    }

?>

        


