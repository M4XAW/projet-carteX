<?php
require_once('config.php'); //ici on fait appel au fichier config.php
require_once('userManager.php');

$userManager = new userManager($pdo);  //ici on fait appel au fichier userManager.php
$allUsers = $userManager->getAllUsers(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['deleteUserId'])) { // On vérifie que la méthode de la requête est bien POST et que l'ID de la carte à supprimer n'est pas vide
    $deleteUserId = $_POST['deleteUserId']; // On récupère l'ID de la carte à supprimer
    $userManager->deleteUser($deleteUserId); // On supprime la carte de la base de données
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des utilisateurs</title>
    <link rel="stylesheet" type="text/css" href="displayUsers.css">
</head>
<header>
    <h1>Liste des utilisateurs</h1>
    <a href="Accueil.php">
        <img src="https://as2.ftcdn.net/v2/jpg/02/38/84/13/1000_F_238841329_wWu1FSAvvtdE5GYUEEM8V7q3SqdamefY.jpg" alt="Ajouter" style="width: 40px; height: auto;">
    </a> 
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
                <th>Action</th> 
            </tr>
            <?php foreach ($allUsers as $user): ?> 
  
                <tr>
                    
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['password']); ?></td>
                    <td>
                    <!-- ici on a un bouton pour supprimer un utilisateur -->
                        <form method="POST" action="">
                            <input type="hidden" name="deleteUserId" value="<?php echo $user['id']; ?>">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" style="padding: 0; border: none; background: none;">
                                <img src="https://cdn-icons-png.flaticon.com/512/6861/6861362.png" alt="" width="20" height="20"> <!-- Adjust width and height as needed -->
                                Delete
                            </button>
                        </form>
                    </td>

                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</body>
</html>
