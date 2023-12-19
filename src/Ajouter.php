<?php
require_once('Card.php');
require_once('CardManager.php');
require_once('config.php');


$cardManager = new CardManager($pdo); // Instanciation correcte

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $card = new Card();
        $card->setName($_POST['name']);
        $card->setType($_POST['type']);
        $card->setFrame_Type($_POST['frame_type']);
        $card->setDescription($_POST['description']);
        $card->setRace($_POST['race']);
        $card->setArchetype($_POST['archetype']);
        $card->setSet_Name($_POST['set_name']);
        $card->setSet_Code($_POST['set_code']);
        $card->setSet_Rarity($_POST['set_rarity']);
        $card->setSet_Rarity_Code($_POST['set_rarity_code']);
        $card->setSet_Price($_POST['set_price']);
        $card->setImage_URL($_POST['image_url']);

        $cardId = $cardManager->addCard($card);

        // ... (le reste de votre code)
    } catch (PDOException $e) {
        echo "Erreur PDO lors de l'ajout de la carte : " . $e->getMessage();
    } catch (Exception $e) {
        echo "Erreur lors de l'ajout de la carte : " . $e->getMessage();
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulaire d'ajout de carte</title>
</head>
<body>
    <h1>Ajouter une carte</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"><!-- Assurez-vous que l'action pointe vers le nom de ce fichier -->
        
        <label for="nom">Nom de la carte:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="type">Type de carte:</label>
        <input type="text" name="type" id="type" required><br><br>

        <label for="frame_type">Frame Type:</label>
        <input type="text" name="frame_type" id="frame_type" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" cols="50" required></textarea><br><br>

        <label for="race">Race:</label>
        <input type="text" name="race" id="race" required><br><br>

        <label for="archetype">Archetype:</label>
        <input type="text" name="archetype" id="archetype"><br><br>

        <label for="set_name">Nom de l'ensemble:</label>
        <input type="text" name="set_name" id="set_name" required><br><br>

        <label for="set_code">Code de l'ensemble:</label>
        <input type="text" name="set_code" id="set_code" required><br><br>

        <label for="set_rarity">Rareté de l'ensemble:</label>
        <input type="text" name="set_rarity" id="set_rarity" required><br><br>

        <label for="set_rarity_code">Code de la rareté de l'ensemble:</label>
        <input type="text" name="set_rarity_code" id="set_rarity_code" required><br><br>

        <label for="set_price">Prix de l'ensemble:</label>
        <input type="text" name="set_price" id="set_price" required><br><br>

        <label for="image_url">URL de l'image:</label>
        <input type="text" name="image_url" id="image_url" required><br><br>

        <input type="submit" value="Ajouter la carte">
    </form>
</body>
</html>
