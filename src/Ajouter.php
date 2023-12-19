<?php

require_once('src/Card.php');
require_once('src/CardManager.php');
require_once('src/config.php'); // Assurez-vous d'inclure correctement votre fichier de configuration de la base de données.

if (isset($_POST['submit'])) {
    // Créez une instance de la classe Card avec les données du formulaire
    $card = new Card();
    $card->setNom($_POST['nom']);
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

    // Créez une instance de la classe CardManager pour gérer les opérations de base de données
    $cardManager = new CardManager(); // Remplacez par la bonne classe de gestion des cartes

    // Appel de la méthode addCard pour ajouter la carte à la base de données
    $cardId = $cardManager->addCard($card);

    // Faites quelque chose après avoir ajouté la carte, par exemple, redirigez l'utilisateur
    if ($cardId) {
        // Redirection vers une page de confirmation ou autre
        header("Location: confirmation.php?card_id=" . $cardId);
        exit;
    } else {
        // Gestion des erreurs si l'ajout a échoué
        echo "L'ajout de la carte a échoué.";
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
    <form method="post" action="traitement.php">
        <label for="nom">Nom de la carte:</label>
        <input type="text" name="nom" id="nom" required><br><br>

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
