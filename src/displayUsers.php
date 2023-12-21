<?php
require_once('config.php'); // Include your database configuration file
require_once('userManager.php');

$userManager = new userManager($pdo); // Assuming you have a UserManager class
$allUsers = $userManager->getAllUsers(); // Method to get all users

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['deleteUserId'])) {
    $deleteUserId = $_POST['deleteUserId'];
    $userManager->deleteUser($deleteUserId); // Delete the selected user
    // Optionally, you can add a success message here
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
        <img src="https://cdn-icons-png.flaticon.com/512/2948/2948025.png" alt="Ajouter" style="width: 40px; height: auto;">
    </a> <!-- Lien vers Ajouter.php avec image miniature -->
    <a href="Ajouter.php">
        <img src="https://www.play-in.com/images/YGO-Back-JP.png" alt="Ajouter" style="width: 40px; height: auto;">
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
                <th>Action</th> <!-- New column for the delete button -->
            </tr>
            <?php foreach ($allUsers as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['password']); ?></td>
                    <td>
                        <form method="POST" action="">
                            <input type="hidden" name="deleteUserId" value="<?php echo $user['id']; ?>">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" style="padding: 0; border: none; background: none;">
                                <img src="https://cdn-icons-png.flaticon.com/512/6861/6861362.png" alt="" width="20" height="20"> <!-- Adjust width and height as needed -->
                                Delete
                            </button>
                        </form>
                    </td>
<!-- ... -->

                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</body>
</html>
