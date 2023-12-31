<?php
class CardManager {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getCardById($id) {
        // Prépare la requête SQL pour obtenir une carte spécifique par son ID
        $stmt = $this->pdo->prepare("SELECT * FROM Cards WHERE id = :id");
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    
        // Exécute la requête
        $stmt->execute();
    
        // Récupère la carte sous forme de tableau associatif
        $cardArray = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($cardArray) {
            // Crée un nouvel objet Card et le remplit avec les données récupérées
            $card = new Card();
            $card->setName($cardArray['name']);
            $card->setType($cardArray['type']);
            $card->setDescription($cardArray['description']);
            $card->setRace($cardArray['race']);
            $card->setArchetype($cardArray['archetype']);
            $card->setSet_Name($cardArray['set_name']);
            $card->setSet_Rarity($cardArray['set_rarity']);
            $card->setSet_Price($cardArray['set_price']);
            $card->setImage_URL($cardArray['image_url']);
    
            return $card;
        } else {
            return null;
        }
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
        // Vérifier si la carte existe déjà dans la base de données
        if (!is_numeric($card->getset_price())) {
            throw new InvalidArgumentException("Le prix de l'ensemble doit être un nombre.");
        }
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
                name, type, description, race, 
                archetype, set_name, set_rarity, set_price, image_url
            ) VALUES (
                :name, :type, :description, :race, 
                :archetype, :set_name, :set_rarity, 
                :set_price, :image_url
            )
        ");
    // Associer les valeurs aux paramètres dans la requête
        $stmt->bindValue(':name', $card->getName());
        $stmt->bindValue(':type', $card->getType());
        $stmt->bindValue(':description', $card->getDescription());
        $stmt->bindValue(':race', $card->getRace());
        $stmt->bindValue(':archetype', $card->getArchetype());
        $stmt->bindValue(':set_name', $card->getSet_Name());
        $stmt->bindValue(':set_rarity', $card->getSet_Rarity());
        $stmt->bindValue(':set_price', $card->getSet_Price());
        $stmt->bindValue(':image_url', $card->getImage_URL());
    
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


    public function updateCard(Card $card) {
        // Prépare la requête SQL de mise à jour
        $stmt = $this->pdo->prepare("
            UPDATE Cards 
            SET name = :name, type = :type, description = :description, race = :race, archetype = :archetype, set_name = :set_name, set_rarity = :set_rarity, set_price = :set_price, image_url = :image_url
            WHERE name = :oldName
        ");
    
        // Associe les valeurs aux paramètres dans la requête
        $stmt->bindValue(':oldName', $card->getname());  // Ancien nom pour identifier la carte
        $stmt->bindValue(':name', $card->getname());
        $stmt->bindValue(':type', $card->getType());
        $stmt->bindValue(':description', $card->getDescription());
        $stmt->bindValue(':race', $card->getrace());
        $stmt->bindValue(':archetype', $card->getarchetype());
        $stmt->bindValue(':set_name', $card->getset_name());
        $stmt->bindValue(':set_rarity', $card->getset_rarity());
        $stmt->bindValue(':set_price', $card->getset_price());
        $stmt->bindValue(':image_url', $card->getimage_url());
    
        // Exécute la requête de mise à jour
        $stmt->execute();
    }
    
    
    
    
    
}


?>