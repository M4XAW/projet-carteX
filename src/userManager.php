
<?php
require_once 'config.php';

class userManager
{
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
  
 
    


    public function DeleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    } 
      
    public function getAllUsers() {
      $stmt = $this->pdo->prepare("SELECT * FROM users");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }


  


}
?>



