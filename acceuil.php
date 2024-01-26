<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}

include 'header.php'; // Assurez-vous que ce fichier existe et contient le code nécessaire pour l'en-tête
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Plateforme Médicale</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bienvenue sur Ma Clinique</h1>
    <div id="acceuil-container">
        <h2>Informations Générales</h2>
        <p>Bienvenue, <?php echo htmlspecialchars($_SESSION['username']); ?>! Sur votre plateforme médicale. Ici, vous pouvez trouver toutes les informations nécessaires sur vos patients, vos exercices et plus encore.</p>
    </div>
    <script src="main.js"></script>
</body>
</html>