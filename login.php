<?php
session_start();
include('connection.php'); // Assurez-vous que ce fichier contient les informations de connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';  
    $password = $_POST['password'] ?? '';  

    $username = stripcslashes($username);  
    $password = stripcslashes($password);  
    $username = mysqli_real_escape_string($con, $username);  
    $password = mysqli_real_escape_string($con, $password);  

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";  
    $result = mysqli_query($con, $sql);  
    $count = mysqli_num_rows($result);  

    if ($count == 1) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: acceuil.php");
        exit();
    } else {
        $_SESSION['error'] = 'Login ou mot de passe incorrects';
        header("Location: index.php");
        exit();
    }
}
?>