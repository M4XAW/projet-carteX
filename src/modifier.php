<?php
require_once('Card.php');
require_once('CardManager.php');
require_once('config.php');

$cardManager = new CardManager($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gérer la mise à jour de la carte ici
    $cardId = $_POST['cardId'];
    $card = new Card(); // Supprimez le deuxième point-virgule ici
    $card->setName($_POST['name']);
    $card->setType($_POST['type']);
    $card->setFrame_Type($_POST['frame_type']);
    $card->setDescription($_POST['description']);
    $card->setRace($_POST["race"]);
    $card->setArchetype($_POST["archetype"]);
    $card->setSet_Name($_POST["set_name"]);
    $card->setSet_Code($_POST["set_code"]);
    $card->setSet_Rarity($_POST["set_rarity"]);
    $card->setSet_Rarity_Code($_POST["set_rarity_code"]);
    $card->setSet_Price($_POST["set_price"]);
    $card->setImage_URL($_POST["image_url"]);
    $cardManager->updateCard($card);
    header('Location: accueil.php');
    exit;
} 

// Récupérer les informations de la carte pour les afficher dans le formulaire
$card = null;
if (isset($_GET['cardId'])) {
    $cardId = $_GET['cardId'];
    $card = $cardManager->getCardById($cardId);
}

if ($card instanceof Card) {
    // Afficher le formulaire avec les données de la carte
} else {
    echo "<p>Carte non trouvée.</p>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Modifier une carte</title>
    <link rel="stylesheet" type="text/css" href="modifer.css">
</head>
<body>
    <header>
        <h1>Modifier une carte</h1>
        <a href="accueil.php">Retour à la liste des cartes</a>
    </header>
    
    <?php if ($card): ?>
        <form method="post" action="modifier.php">
            <label for="name">Nom de la carte:</label>
            <input type="text" name="name" id="name" value="<?php echo $card->getName(); ?>" required><br><br>
            <input type="text" name="type" id="type" value="<?php echo $card->getType(); ?>" required><br><br>
            <input type="text" name="frame_type" id="frame_type" value="<?php echo $card->getFrame_Type(); ?>" required><br><br>
            <input type="text" name="description" id="description" value="<?php echo $card->getDescription(); ?>" required><br><br>
            <input type="text" name="race" id="race" value="<?php echo $card->getRace(); ?>" required><br><br>
            <input type="text" name="archetype" id="archetype" value="<?php echo $card->getArchetype(); ?>" required><br><br>
            <input type="text" name="set_name" id="set_name" value="<?php echo $card->getSet_Name(); ?>" required><br><br>
            <input type="text" name="set_code" id="set_code" value="<?php echo $card->getSet_Code(); ?>" required><br><br>
            <input type="text" name="set_rarity" id="set_rarity" value="<?php echo $card->getSet_Rarity(); ?>" required><br><br>
            <input type="text" name="set_rarity_code" id="set_rarity_code" value="<?php echo $card->getSet_Rarity_Code(); ?>" required><br><br>
            <input type="number" name="set_price" id="set_price" value="<?php echo $card->getSet_Price(); ?>" required><br><br>
            <input type="text" name="image_url" id="image_url" value="<?php echo $card->getImage_URL(); ?>" required><br><br>


           

            <input type="submit" value="Modifier la carte">
        </form>
    <?php else: ?>
        <p>Carte non trouvée.</p>
    <?php endif; ?>

</body>
</html>