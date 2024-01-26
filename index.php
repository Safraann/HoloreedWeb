<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Titre de la page</title>
    <link rel="stylesheet" href="style.css">
<head>
<body>
    <div id="login-container">
        <h2>Connexion</h2>
        <form action="acceuil.php" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required placeholder="DrSanté">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required placeholder="••••••••">
            </div>
            <div class="form-group">
            <li><button href="acceuil.php">Se connecter</button></li>
            </div>
        </form>
    </div>
    <script src="login.js"></script>
</body>
</html>