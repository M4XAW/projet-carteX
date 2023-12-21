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



$cardDeleted = false; // Flag to track if a card was deleted

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardId = $_POST['cardId'];
    $cardManager = new CardManager($pdo);

    try {
        $cardManager->deleteCard($cardId);
        $cardDeleted = true; // Set flag to true if card is deleted successfully
    } catch (PDOException $e) {
        echo "Erreur PDO lors de la suppression de la carte : " . $e->getMessage();
    } catch (Exception $e) {
        echo "Erreur lors de la suppression de la carte : " . $e->getMessage();
    }
} 
?>

<!DOCTYPE html>
<html>
    
<head>
    <title>Liste des cartes</title>
    <link rel="stylesheet" type="text/css" href="Accueil.css">
    <script>
    // JavaScript to display alert if a card is deleted
    window.onload = function() {
        <?php if ($cardDeleted) : ?>
            alert('Card deleted successfully');
        <?php endif; ?>
    };
    </script>
</head>

<body>
<header>
<img src="https://upload.wikimedia.org/wikipedia/fr/a/a5/Yu-Gi-Oh_Logo.JPG" alt="Logo" class="logo">
<nav>
    <a href="Ajouter.php">
        <img src="https://www.play-in.com/images/YGO-Back-JP.png" alt="Ajouter" style="width: 40px; height: auto;">
    </a> <!-- Lien vers Ajouter.php avec image miniature -->
    <a href="displayUsers.php">
        <img src="https://previews.123rf.com/images/graphicstudiomh/graphicstudiomh2012/graphicstudiomh201200090/160799586-ic%C3%B4ne-ou-logo-de-signe-de-gestion-des-utilisateurs-concept-de-param%C3%A8tres-de-compte-illustration-de.jpg" alt="Liste des utilisateurs" style="width: 40px; height: auto;">
    </a> <!-- Lien vers displayUsers.php avec image miniature -->
</nav>


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
            <th>Action</th> 
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
                    <a href="modifier.php?cardId=' . $card['id'] . '">
                    <img src="https://cdn-icons-png.flaticon.com/512/84/84380.png" alt="Modifier" style="width: 40px; height: auto;">
                    </a>
                        <form method="POST" action="" style="display:inline;">
                        <input type="hidden" name="cardId" value="' . $card['id'] . '">
                        <button type="submit">
                        <img src="https://cdn-icons-png.flaticon.com/512/6861/6861362.png" alt="" style="width: 40px; height: auto;">
                        </button>
                    </form>
                  </td>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>
</body>
</html>
