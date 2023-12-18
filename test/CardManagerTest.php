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
        // Créer une instance fictive de PDO pour les tests
        $this->pdo = $this->createMock(PDO::class);
        $this->cardManager = new CardManager($this->pdo);
    }

    public function configureDatabase(): void
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


        public function testAddCart()
        {
            $cartData = [
                'Nom' => 'Test Name',
                'Type' => 'Test Type',
                'Frame_Type' => 'Test Frame Type',
                'Description' => 'Test Description',
                'Race' => 'Test Race',
                'Archetype' => 'Test Archetype',
                'Set_Name' => 'Test Set Name',
                'Set_Code' => 'Test Set Code',
                'Set_Rarity' => 'Test Set Rarity',
                'Set_Rarity_Code' => 'Test Set Rarity Code',
                'Set_Price' => 'Test Set Price',
                'Image_URL' => 'Test Image URL'
                
            ];
    
            $this->cardManager->addCart($cartData);
    
            $stmt = $this->getPdo()->query('SELECT * FROM Cartes WHERE Nom = "Test Name"');
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            $this->assertEquals($cartData['Nom'], $result['Nom']);
            $this->assertEquals($cartData['Type'], $result['Type']);
            $this->assertEquals($cartData['Frame_Type'], $result['Frame_Type']);
            $this->assertEquals($cartData['Description'], $result['Description']);
            $this->assertEquals($cartData['Race'], $result['Race']);
            $this->assertEquals($cartData['Archetype'], $result['Archetype']);

            $this->cardManager->addCart($cartData);

        $this->pdo->expects($this->once())
                  ->method('execute');
           
        } 
        
        
    }


?>
