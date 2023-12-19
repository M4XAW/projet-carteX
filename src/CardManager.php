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
        $stmt->bindValue(':race', $card->getrace());
        $stmt->bindValue(':archetype', $card->getarchetype());
        $stmt->bindValue(':set_name', $card->getset_name());
        $stmt->bindValue(':set_code', $card->getset_code());
        $stmt->bindValue(':set_rarity', $card->getset_rarity());
        $stmt->bindValue(':set_rarity_code', $card->getset_rarity_code());
        $stmt->bindValue(':set_price', $card->getset_price());
        $stmt->bindValue(':image_url', $card->getimage_url());
    
        // Exécute la requête d'insertion
        $stmt->execute();
    
        // Retourne l'ID de la carte nouvellement insérée
        return $this->pdo->lastInsertId();
    }
    
    

    public function updateCard(Card $card) {
        try {
            $stmt = $this->pdo->prepare("
                UPDATE Cartes SET
                   name = ?,
                   type = ?,
                   frame_type = ?,
                   description= ?,
                    race = ?,
                    archetype = ?,
                    set_name = ?,
                    set_code = ?,
                    set_rarity = ?,
                    set_rarity_code = ?,
                    set_price = ?,
                    image_url = ?
                WHERE id = ?
            ");
    
            $stmt->execute([
                $card->getNom(),
                $card->getType(),
                $card->getFrame_Type(),
                $card->getDescription(),
                $card->getrace(),
                $card->getarchetype(),
                $card->getset_name(),
                $card->getset_code(),
                $card->getset_rarity(),
                $card->getset_rarity_code(),
                $card->getset_price(),
                $card->getimage_url(),
                $card->getid()
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
    

    public function deleteCard($cardId) {
        $stmt = $this->pdo->prepare("DELETE FROM Cards WHERE id = ?");
        $stmt->execute([$cardId]);
    }
    
}


?>