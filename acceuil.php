<?php include 'header.php'; ?>


<?php      
    include('connection.php');  
    $username = $_POST['username'];  
    $password = $_POST['password'];  
      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "select *from users where username = '$username' and password = '$password'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            echo "<h1><center> Login successful </center></h1>";  
        }  
        else{  
            echo "<h1> Login failed. Invalid username or password.</h1>";  
        }     
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

    <!-- Section Informations Générales -->
    <div id="acceuil-container">
        <h2>Informations Générales</h2>
        <p>Bienvenue sur votre plateforme médicale. Ici, vous pouvez trouver toutes les informations nécessaires sur vos patients, vos exercice et plus encore.</p>
    </div>

    

    <script src="main.js"></script>
</body>
</html>
