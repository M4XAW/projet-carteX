<?php
class CardManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function recupererToutesLesCartes() {
        // Prépare la requête SQL
        $stmt = $this->pdo->prepare("SELECT * FROM Cards");
    
        // Exécute la requête SQL
        $stmt->execute();
    
        // Récupère toutes les lignes de la table "Cards" sous forme de tableau associatif
        $cards = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Retourne un tableau d'objets de type "Card"
        return $cards;
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
        $stmt->bindValue(':nom', $card->getname());
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
    
    

    public function deleteCard($cardId) {
        // Prépare la requête de suppression
        $stmt = $this->pdo->prepare("
            DELETE FROM Cards
            WHERE id = :id
        ");
    
        // Associe les valeurs aux paramètres dans la requête
        $stmt->bindValue(':id', $cardId);
    
        // Exécute la requête de suppression
        $stmt->execute();
    }
    public function updateCard(Card $card) {
        // Prépare la requête SQL de mise à jour
        $stmt = $this->pdo->prepare("
        UPDATE Cartes 
        SET name = :name, type = :type, description = :description, race = :race, archetype = :archetype, set_name = :set_name, set_code = :set_code, set_rarity = :set_rarity, set_rarity_code = :set_rarity_code, set_price = :set_price, image_url = :image_url
        WHERE id = :id
    ");
    $stmt->bindValue(':nom', $card->getname());
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
    
    $stmt->execute();
        $card = new Card();

    }   
  
    
    
    
}


?>