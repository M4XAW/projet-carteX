<?php
include_once('src/userManager.php');
include_once('src/user.php');
include_once('src/config.php');

use PHPUnit\Framework\TestCase;

class userManagerTest extends TestCase
{
    private $pdo;
    private $userManager;

    protected function setUp(): void
    {
        parent::setUp();
        $this->configureDatabase();
        $this->userManager = new userManager($this->pdo);
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

    public function testDeleteUser() {
        // Assume you have an existing user with an ID
        $userIdToDelete = 91650018; // Replace with the ID of the user you wish to delete
    
        // Ensure the user exists before attempting to delete
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userIdToDelete]);
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertNotNull($existingUser, 'User should exist before deletion');
    
        // Call the deleteUser method
        $this->userManager->deleteUser($userIdToDelete);
    
        // Ensure the user no longer exists
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userIdToDelete]);
        $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->assertNull($existingUser, 'User should not exist after deletion');
    }
}
?>