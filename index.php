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




<?php 
// include 'header.php';
// Database connection
//$conn = new mysqli('localhost', 'root', 'Holoreed25&*', 'holoreed');
//$conn->set_charset("utf8mb4");


// // Check for form submission
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $username = $_POST['username'];
//     $password = $_POST['password']; // Remember to hash the password in real scenarios

//     // Prepare SQL statement to prevent SQL injection
//     $stmt = $conn->prepare("SELECT * FROM User WHERE Username = ? AND Password = ?");
//     $stmt->bind_param("ss", $username, $password);
//     $stmt->execute();

//     $result = $stmt->get_result();
//     if ($result->num_rows > 0) {
//         // User found, proceed to home.php
//         header("Location: home.php");
//     } else {
//         // User not found, show error
//         echo "<p>Invalid username or password</p>";
//     }

//     $stmt->close();
// }

// // Close connection
// $conn->close();
// ?>
<!-- 
// <!DOCTYPE html>
// <html lang="fr">
// <head>
//     <meta charset="UTF-8">
//     <title>Titre de la page</title>
//     <link rel="stylesheet" href="style.css">
// </head>
// <body>
//     <div id="login-container">
//         <h2>Connexion</h2>
//         <form action="index.php" method="post">
//             <div class="form-group">
//                 <label for="username">Nom d'utilisateur :</label>
//                 <input type="text" id="username" name="username" required placeholder="DrSanté">
//             </div>
//             <div class="form-group">
//                 <label for="password">Mot de passe :</label>
//                 <input type="password" id="password" name="password" required placeholder="••••••••">
//             </div>
//             <div class="form-group">
//                 <button type="submit">Se connecter</button>
//             </div>
//         </form>
//     </div>
//     <script src="login.js"></script>
// </body>
// </html> -->
