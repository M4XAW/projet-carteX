<?php 
    try {
        $host = "localhost";
        $user = "root";
        $password = "ilyass";
        $database = "yugioh";

        $pdo= new PDO("mysql:host=$host;dbname=$database", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connexion à la base de données";
        die();
    }
?>