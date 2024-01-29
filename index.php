<?php
session_start(); // Démarrage de la session

// Vérifiez si nous avons un message d'erreur précédent à afficher
$errorMessage = isset($_SESSION['error']) ? $_SESSION['error'] : '';
unset($_SESSION['error']); // Effacez le message d'erreur pour les futures requêtes
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion à la Plateforme Médicale</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="login-container">
        <h2>Connexion</h2>
        <form action="login.php" method="post"> <!-- Le traitement se fera dans login.php -->
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required placeholder="DrSanté">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>
            <?php if ($errorMessage): ?>
                <div class="error-message" style="color: red;">
                    <?php echo $errorMessage; ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <button type="submit">Se connecter</button>
            </div>
        </form>
    </div>
    <script src="login.js"></script>
</body>
</html>