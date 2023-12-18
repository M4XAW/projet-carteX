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

    public function testAddCard()
{
    // Assurez-vous que la longueur de 'Exemple Rarity Code' ne dépasse pas la limite de la colonne 'Set_Rarity_Code'
    $card = new Card(1, "Exemple Nom", "Exemple Type", "Exemple Frame Type", "Exemple Description", "Exemple Race", "Exemple Archetype", "Exemple Set Name", "Exemple Set Code", "Exemple Set Rarity", "RC", 15.99, "Exemple Image URL"); // J'ai utilisé "RC" comme un exemple court

    $lastInsertId = $this->cardManager->addCard($card);
    $this->assertNotNull($lastInsertId); // Vérifier que l'ID retourné n'est pas null

    // Ajoutez ici d'autres assertions pour vérifier les détails de la carte insérée
}

}

?>

        

?>
