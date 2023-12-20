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

    // public function testRecupererToutesLesCartes() {
    //     // Récupérer toutes les cartes
    //     $cards = $this->cardManager->recupererToutesLesCartes();

    //     // Vérifier que le tableau retourné n'est pas vide
    //     $this->assertNotEmpty($cards, "Le tableau de cartes ne devrait pas être vide");
    // }

    // public function testAddCard() {
    //     // Créer une carte d'exemple
    //     $card = new Card("Exemple Nom", "Exemple Type", "Exemple Frame Type", "Exemple Description", "Exemple Race", "Exemple Archetype", "Exemple Set Name", "Exemple Set Code", "Exemple Set Rarity", "RC", 15.99, "Exemple Image URL");

    //     // Insérer la carte dans la base de données
    //     $lastInsertId = $this->cardManager->addCard($card);

    //     // Vérifier que l'ID retourné n'est pas null
    //     $this->assertNotNull($lastInsertId, "L'ID inséré ne devrait pas être null");

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

    public function testUpdateCard() {
        $cardToUpdateId = 100213002;

        // Récupérer les données de la carte existante
        $stmt = $this->pdo->prepare('SELECT * FROM cards WHERE id = ?');
        $stmt->execute([$cardToUpdateId]);
        $originalCardData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Créer une instance de Card avec les données récupérées
        $card = new Card();
        $card->setname($originalCardData['name']);
        $card->settype($originalCardData['type']);
        $card->setframe_type($originalCardData['frame_type']);
        $card->setdescription($originalCardData['description']);
        $card->setrace($originalCardData['race']);
        $card->setarchetype($originalCardData['archetype']);
        $card->setset_name($originalCardData['set_name']);
        $card->setset_code($originalCardData['set_code']);
        $card->setset_rarity($originalCardData['set_rarity']);
        $card->setset_rarity_code($originalCardData['set_rarity_code']);
        $card->setset_price($originalCardData['set_price']);
        $card->setimage_url($originalCardData['image_url']);


        // Modifier certaines propriétés pour la mise à jour
        $card->setname("Nouveaux Nom");
        $card->settype("Nouveaux Type");
        $card->setframe_type("Nouveaux Frame Type");
        $card->setdescription("Nouveaux Description");
        $card->setrace("Nouvelle race");
        $card->setarchetype("Nouvel Archetype");
        $card->setset_name("Nouveau Set Name");
        $card->setset_code("Nouveau Set Code");
        $card->setset_rarity("Nouveau Set Rarity");
        $card->setset_rarity_code("Nouveau Set Rarity Code");
        $card->setset_price(9.99);
        $card->setimage_url("Nouveau Image URL");



        // Mise à jour de la carte
        $this->cardManager->updateCard($card);

        // Récupérer les données mises à jour
        $stmt = $this->pdo->prepare('SELECT * FROM cards WHERE id = ?');
        $stmt->execute([$cardToUpdateId]);
        $updatedCardData = $stmt->fetch(PDO::FETCH_ASSOC);

        // Assert : Vérifiez si les données mises à jour correspondent aux attentes
        $this->assertEquals("A★Speculation", $updatedCardData['name']);
        $this->assertEquals("Fusion Monster", $updatedCardData['type']);
    }
    public function testRecupererToutesLesCartesReturnsArray() {
        $cards = $this->cardManager->recupererToutesLesCartes();
        $this->assertIsArray($cards, 'recupererToutesLesCartes devrait retourner un tableau');
    }
public function testAddCardWithNonNumericSetPrice() {
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage("Le prix de l'ensemble doit être un nombre.");

    $card = new Card("Exemple Nom", "Exemple Type", "Exemple Frame Type", "Exemple Description", "Exemple Race", "Exemple Archetype", "Exemple Set Name", "Exemple Set Code", "Exemple Set Rarity", "RC", 12.0, "Exemple Image URL");    $this->cardManager->addCard($card);
}


}
    
   
?>

        


        


