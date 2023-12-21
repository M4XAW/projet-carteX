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
        $card->setDescription($_POST['description']);
        $card->setRace($_POST['race']);
        $card->setArchetype($_POST['archetype']);
        $card->setSet_Name($_POST['set_name']);
        $card->setSet_Rarity($_POST['set_rarity']);
        $card->setSet_Price($_POST['set_price']);
        $card->setImage_URL($_POST['image_url']);

        $existingCard = $cardManager->getCardByName($card->getName());

        if ($existingCard) {
            echo "La carte existe déjà dans la base de données.";
        } else {
            $cardId = $cardManager->addCard($card);
            if ($cardId) {
                echo "La carte a été ajoutée avec succès, ID: " . $cardId;
            } else {
                echo "Erreur lors de l'ajout de la carte.";
            }
        }
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
<title>Liste des cartes</title>
    <link rel="stylesheet" type="text/css" href="Ajouter.css">
    <title>Formulaire d'ajout de carte</title>
</head>
<body>
<header>
<a href="Accueil.php">
        <img src="https://e7.pngegg.com/pngimages/703/597/png-clipart-logo-house-home-house-angle-building-thumbnail.png" alt="Ajouter" style="width: 40px; height: auto;">
    </a> <!-- Lien vers Ajouter.php avec image miniature -->
    <a href="displayUsers.php">
        <img src="https://previews.123rf.com/images/graphicstudiomh/graphicstudiomh2012/graphicstudiomh201200090/160799586-ic%C3%B4ne-ou-logo-de-signe-de-gestion-des-utilisateurs-concept-de-param%C3%A8tres-de-compte-illustration-de.jpg" alt="Liste des utilisateurs" style="width: 40px; height: auto;">
    </a> <!-- Lien vers displayUsers.php avec image miniature -->
    <h1>Ajouter une carte</h1>

    </header>
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"><!-- Assurez-vous que l'action pointe vers le nom de ce fichier -->
        
        <label for="name">Nom de la carte:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="type">Type de carte:
            <select>  
                <option value="Monstre">Monstre</option>  
                <option value="Magie">Magie</option>  
                <option value="Piège">Piège</option>
                <option value="Monstre Rituel">Monstre Rituel</option>
                <option value="Monstre Fusion">Monstre Fusion</option>
                <option value="Monstre Synchro">Monstre Synchro</option>
                <option value="Monstre Xyz">Monstre Xyz</option>
                </select>
            </label>
        <input type="text" name="type" id="type" required><br><br>

        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" cols="50" required></textarea><br><br>

        <label for="race">Race: 
            <select>
                <option value="Bête">Bête</option>
                <option value="Bête Ailée">Bête Ailée</option>
                <option value="Bête-Divine">Bête-Divine</option>
                <option value="Bête-Guerrier">Bête-Guerrier</option>
                <option value="Cyberse">Cyberse</option>
                <option value="Démon">Démon</option>
                <option value="Dinosaure">Dinosaure</option>
                <option value="Dragon">Dragon</option>
                <option value="Elfe">Elfe</option>
                <option value="Guerrier">Guerrier</option>
                <option value="Machine">Machine</option>
                <option value="Magicien">Magicien</option>
                <option value="Plante">Plante</option>
                <option value="Poisson">Poisson</option>
                <option value="Psychique">Psychique</option>
                <option value="Pyro">Pyro</option>
                <option value="Rocher">Rocher</option>
                <option value="Reptile">Reptile</option>
                <option value="Serpent de Mer">Serpent de Mer</option>
                <option value="Tonnerre">Tonnerre</option>
                <option value="Wyrm">Wyrm</option>
                <option value="Zombie">Zombie</option>
                </select>

        </label>
        <input type="text" name="race" id="race" required><br><br>

        <label for="archetype">Archetype:</label>
        <input type="text" name="archetype" id="archetype"><br><br>

        <label for="set_name">Nom de l'ensemble:</label>
        <input type="text" name="set_name" id="set_name" required><br><br>


        <label for="set_rarity">Rareté de l'ensemble:</label>
        <input type="text" name="set_rarity" id="set_rarity" required><br><br>

        <label for="set_price">Prix de l'ensemble:</label>
        
        <input type="number" name="set_price" id="set_price" required><br><br>

        <label for="image_url">URL de l'image:</label>
        <input type="text" name="image_url" id="image_url" required><br><br>
        <h3>Aide pour l'image  : <a href="https://www.yugiohcardmaker.net/"><img src="https://e7.pngegg.com/pngimages/684/303/png-clipart-computer-icons-chain-hyperlink-symbol-connect-text-technic.png" alt="Ajouter" style="width: 40px; height: 20px;"></a></h2>
        <br><br>

        <input type="submit" value="Ajouter la carte">
    </form>
</body>
</html>