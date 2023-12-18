<?php
class CardManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addCard(Card $card) {
        $stmt = $this->pdo->prepare("
            INSERT INTO Cartes (
                ID_Carte, Nom, Type, Frame_Type, Description, Race, 
                Archetype, Set_Name, Set_Code, Set_Rarity, 
                Set_Rarity_Code, Set_Price, Image_URL
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )
        ");

        $stmt->execute([
            $card->getID_Carte(),
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
}


?>


    