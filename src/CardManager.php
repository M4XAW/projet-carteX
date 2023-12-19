<?php
class CardManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addCard(Card $card) {
        // Prépare la requête SQL d'insertion
        $stmt = $this->pdo->prepare("
            INSERT INTO Cards (
                name,type,frame_type,description,race, 
                archetype,set_name,set_code,set_rarity, 
                set_rarity_code,set_price,image_url
            ) VALUES (
                :nom, :type, :frame_type, :description, :race, 
                :archetype, :set_name, :set_code, :set_rarity, 
                :set_rarity_code, :set_price, :image_url
            )
        ");
    
        // Associe les valeurs aux paramètres dans la requête
        $stmt->bindValue(':nom', $card->getNom());
        $stmt->bindValue(':type', $card->getType());
        $stmt->bindValue(':frame_type', $card->getFrame_Type());
        $stmt->bindValue(':description', $card->getDescription());
        $stmt->bindValue(':race', $card->getRace());
        $stmt->bindValue(':archetype', $card->getArchetype());
        $stmt->bindValue(':set_name', $card->getSet_Name());
        $stmt->bindValue(':set_code', $card->getSet_Code());
        $stmt->bindValue(':set_rarity', $card->getSet_Rarity());
        $stmt->bindValue(':set_rarity_code', $card->getSet_Rarity_Code());
        $stmt->bindValue(':set_price', $card->getSet_Price());
        $stmt->bindValue(':image_url', $card->getImage_URL());
    
        // Exécute la requête d'insertion
        $stmt->execute();
    
        // Retourne l'ID de la carte nouvellement insérée
        return $this->pdo->lastInsertId();
    }
    
    

<<<<<<< HEAD
    public function updateCard(Card $card) {
        try {
            $stmt = $this->pdo->prepare("
                UPDATE Cartes SET
                    Nom = ?,
                    Type = ?,
                    Frame_Type = ?,
                    Description = ?,
                    Race = ?,
                    Archetype = ?,
                    Set_Name = ?,
                    Set_Code = ?,
                    Set_Rarity = ?,
                    Set_Rarity_Code = ?,
                    Set_Price = ?,
                    Image_URL = ?
                WHERE ID_Carte = ?
            ");
    
            $stmt->execute([
                $card->getNom(),
                $card->getType(),
                $card->getFrame_Type(),
                $card->getDescription(),
                $card->getRace(),
                $card->getArchetype(),
                $card->getSet_Name(),
                $card->getSet_Code(),
                $card->getSet_Rarity(),
                $card->getSet_Rarity_Code(),
                $card->getSet_Price(),
                $card->getImage_URL(),
                $card->getID_Carte()
            ]);
    
            if ($stmt->rowCount() > 0) {
                return "Mise à jour réussie.";
            } else {
                return "Aucune mise à jour n'a été effectuée.";
            }
        } catch (PDOException $e) {
            // Gestion de l'erreur
            return "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    }
    

=======
    // public function updateCard(Card $card) {
    //     $stmt = $this->pdo->prepare("
    //         UPDATE Cards SET
    //             Nom = ?,
    //             Type = ?,
    //             Frame_Type = ?,
    //             Description = ?,
    //             Race = ?,
    //             Archetype = ?,
    //             Set_Name = ?,
    //             Set_Code = ?,
    //             Set_Rarity = ?,
    //             Set_Rarity_Code = ?,
    //             Set_Price = ?,
    //             Image_URL = ?
    //         WHERE id = ?
    //     ");
    
    //     $stmt->execute([
    //         $card->getNom(),
    //         $card->getType(),
    //         $card->getFrame_Type(),
    //         $card->getDescription(),
    //         $card->getRace(),
    //         $card->getArchetype(),
    //         $card->getSet_Name(),
    //         $card->getSet_Code(),
    //         $card->getSet_Rarity(),
    //         $card->getSet_Rarity_Code(),
    //         $card->getSet_Price(),
    //         $card->getImage_URL(),
    //         $card->getID_Carte()
    //     ]);
    // }
>>>>>>> e7578934fe68109c85d78f74cee4d17bdfbfec97
    public function deleteCard($cardId) {
        $stmt = $this->pdo->prepare("DELETE FROM Cards WHERE id = ?");
        $stmt->execute([$cardId]);
    }
    
}


?>


    