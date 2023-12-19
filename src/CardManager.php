<?php
class CardManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addCard(Card $card) {
        $stmt = $this->pdo->prepare("
            INSERT INTO Cards (
                Nom, Type, Frame_Type, Description, Race, 
                Archetype, Set_Name, Set_Code, Set_Rarity, 
                Set_Rarity_Code, Set_Price, Image_URL
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )
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
            $card->getImage_URL()
        ]);
    
        return $this->pdo->lastInsertId();
    }
    

    public function updateCard(Card $card) {
        $stmt = $this->pdo->prepare("
            UPDATE Cards SET
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
            WHERE id = ?
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
    }
    public function deleteCard($cardId) {
        $stmt = $this->pdo->prepare("DELETE FROM Cards WHERE id = ?");
        $stmt->execute([$cardId]);
    }
    
}


?>


    