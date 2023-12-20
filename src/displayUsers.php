<?php
require_once('config.php'); // Include your database configuration file
require_once('userManager.php');

$userManager = new userManager($pdo); // Assuming you have a UserManager class
$allUsers = $userManager->getAllUsers(); // Method to get all users
?>

<!DOCTYPE html>
<html>
<head>
<title>Liste des cartes</title>
    <link rel="stylesheet" type="text/css" href="displayUsers.css">
    <title>Formulaire d'ajout de carte</title>
</head>
<header>
    <h1>Liste des utilisateur</h1>
    <a href="Ajouter.php">Ajouter</a> <!-- Link to accueil.php -->
    <a href="Acceuil.php">Acceuil</a> <!-- Link to displayUsers.php -->
</header>
<body>
    <h1>All User Information</h1>

    <?php if ($allUsers): ?>
        <h2>User Details</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>


            </tr>
            <?php foreach ($allUsers as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['password']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</body>
</html>
