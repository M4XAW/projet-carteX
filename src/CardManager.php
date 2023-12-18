<?php
class CardManager
{
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getCardById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM Cartes WHERE id = :id");
        if ($stmt === false) {
            throw new Exception("Erreur de préparation de la requête.");
        }

        $stmt->execute([':id' => $id]);
        $card = $stmt->fetch(PDO::FETCH_ASSOC);
        return $card;
    }

    public function addCart($cartData){
        try {
            $sql = "INSERT INTO Cartes (Nom, Type, Frame_Type, Description, Race, Archetype, Set_Name, Set_Code, Set_Rarity, Set_Rarity_Code, Set_Price, Image_URL) VALUES (:Nom, :Type, :Frame_Type, :Description, :Race, :Archetype, :Set_Name, :Set_Code, :Set_Rarity, :Set_Rarity_Code, :Set_Price, :Image_URL)";
            $stmt = $this->pdo->prepare($sql);
    
            // Bind parameters
            $stmt->bindParam(':Nom', $cartData['Nom']);
            $stmt->bindParam(':Type', $cartData['Type']);
            $stmt->bindParam(':Frame_Type', $cartData['Frame_Type']);
            $stmt->bindParam(':Description', $cartData['Description']);
            $stmt->bindParam(':Race', $cartData['Race']);
            $stmt->bindParam(':Archetype', $cartData['Archetype']);
            $stmt->bindParam(':Set_Name', $cartData['Set_Name']);
            $stmt->bindParam(':Set_Code', $cartData['Set_Code']);
            $stmt->bindParam(':Set_Rarity', $cartData['Set_Rarity']);
            $stmt->bindParam(':Set_Rarity_Code', $cartData['Set_Rarity_Code']);
            $stmt->bindParam(':Set_Price', $cartData['Set_Price']);
            $stmt->bindParam(':Image_URL', $cartData['Image_URL']);
    
            // Execute the statement
            $stmt->execute();
    
            echo "New record created successfully";
        } catch(PDOException $e) {
            // Handle the error, log it, or return an appropriate response
            echo "Error: " . $e->getMessage();
        }
    }
        
}

?>


    