
<?php
require_once 'config.php';

class userManager
{
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
  
      public function DeleteUsers ($id){
    try {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id_recette', $id_recette);
        return $stmt->execute();
    } catch (PDOException $e) {
        echo "Erreur de suppression de l'utilisateur";
        return false;
    }
  }

  


}
?>



