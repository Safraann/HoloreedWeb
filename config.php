<?php
// Informations de connexion à la base de données
$host = 'localhost'; // Hôte de la base de données
$dbname = 'ping_bdd'; // Nom de la base de données
$user = 'root'; // Nom d'utilisateur de la base de données
$password = ''; // Mot de passe de la base de données

// Tentative de connexion à la base de données
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    // Activer les erreurs PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}
?>
