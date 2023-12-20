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

    public function getCardByName($name) {
        $stmt = $this->pdo->prepare("SELECT * FROM Cards WHERE name = :name");
        $stmt->bindValue(':name', $name);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addCard(Card $card) {
        // Vérifie si la carte existe déjà
        $stmt = $this->pdo->prepare("SELECT * FROM Cards WHERE name = :name");
        $stmt->bindValue(':name', $card->getName());
        $stmt->execute();

        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            // La carte existe déjà
            return false;
        }

    
        // Si la carte n'existe pas, procéder à l'insertion
        $stmt = $this->pdo->prepare("
            INSERT INTO Cards (
                name, type, frame_type, description, race, 
                archetype, set_name, set_code, set_rarity, 
                set_rarity_code, set_price, image_url
            ) VALUES (
                :nom, :type, :frame_type, :description, :race, 
                :archetype, :set_name, :set_code, :set_rarity, 
                :set_rarity_code, :set_price, :image_url
            )
        ");
    
        // Associer les valeurs aux paramètres dans la requête
        // ...
    
        // Exécuter la requête d'insertion
        $stmt->execute();
    
        // Retourner l'ID de la carte nouvellement insérée
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

    public function updatecards($name, $type, $frame_type, $description, $race, $archetype, $set_name, $set_code, $set_rarity, $set_rarity_code, $set_price, $image_url) {
        try {
            $stmt = $this->pdo->prepare("UPDATE Cartes SET name = ?, type = ?, frame_type = ?, description = ?, race = ?, archetype = ?, set_name = ?, set_code = ?, set_rarity = ?, set_rarity_code = ?, set_price = ?, image_url = ? WHERE id = ?");

    
            $stmt->execute([
                $name,
                $type,
                $frame_type,
                $description,
                $race,
                $archetype,
                $set_name,
                $set_code,
                $set_rarity,
                $set_rarity_code,
                $set_price,
                $image_url,
                $id
            ]);
    
            if ($stmt->rowCount() > 0) {
                return "Mise à jour réussie.";
            } else {
                return "Aucune mise à jour n'a été effectuée.";
            }
        } catch (PDOException $e) {
            // Gérer l'erreur
            return "Erreur lors de la mise à jour : " . $e->getMessage();
        }

    }
    
    
}


?>