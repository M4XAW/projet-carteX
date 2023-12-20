<?php
require_once('Card.php');
require_once('CardManager.php');
require_once('config.php');

$cardManager = new CardManager($pdo); // Correct instantiation

try {
    $cards = $cardManager->recupererToutesLesCartes(); // Fetch all cards

} catch (PDOException $e) {
    echo "Erreur PDO lors de l'affichage des cartes : " . $e->getMessage();
} catch (Exception $e) {
    echo "Erreur lors de l'affichage des cartes : " . $e->getMessage();
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardId = $_POST['cardId'];
    $cardManager = new CardManager($pdo);

    try {
        $cardManager->deleteCard($cardId);
        echo "Card deleted successfully";
    } catch (PDOException $e) {
        echo "Erreur PDO lors de la suppression de la carte : " . $e->getMessage();
    } catch (Exception $e) {
        echo "Erreur lors de la suppression de la carte : " . $e->getMessage();
    }
} else {
    echo "Invalid request method";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des cartes</title>
    <link rel="stylesheet" type="text/css" href="Accueil.css">
</head>

<body>
<header>
    <h1>Ajouter une carte</h1>
    <a href="Ajouter.php">Ajouter</a> <!-- Link to accueil.php -->
</header>
<h1>Liste des cartes</h1>
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Type</th>
            <th>Frame Type</th>
            <th>Description</th>
            <th>Race</th>
            <th>Archetype</th>
            <th>Nom de l'ensemble</th>
            <th>Code de l'ensemble</th>
            <th>Rareté de l'ensemble</th>
            <th>Code de la rareté</th>
            <th>Prix de l'ensemble</th>
            <th>Image</th>
            <th>Action</th> <!-- Add a new column for the delete buttons -->
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($cards as $card) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($card['name']) . '</td>';
            echo '<td>' . htmlspecialchars($card['type']) . '</td>';
            echo '<td>' . htmlspecialchars($card['frame_type']) . '</td>';
            echo '<td>' . htmlspecialchars($card['description']) . '</td>';
            echo '<td>' . htmlspecialchars($card['race']) . '</td>';
            echo '<td>' . htmlspecialchars($card['archetype']) . '</td>';
            echo '<td>' . htmlspecialchars($card['set_name']) . '</td>';
            echo '<td>' . htmlspecialchars($card['set_code']) . '</td>';
            echo '<td>' . htmlspecialchars($card['set_rarity']) . '</td>';
            echo '<td>' . htmlspecialchars($card['set_rarity_code']) . '</td>';
            echo '<td>' . htmlspecialchars($card['set_price']) . '</td>';
            echo '<td><img src="' . htmlspecialchars($card['image_url']) . '" alt="Card Image" width="100"></td>';
            echo '<td>
                    <form method="POST" action="">
                        <input type="hidden" name="cardId" value="' . $card['id'] . '">
                        <button type="submit">Supprimer</button>
                    </form>
                  </td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
</body>
</html>
