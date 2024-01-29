<?php
include 'header.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Inclure le fichier de configuration de la base de données
    include 'config.php';

    // Préparer et exécuter la requête INSERT
    $sql = "INSERT INTO patients (nom, prenom, date, adresse, conditions, telephone) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['adresse'], $_POST['condition_medical'], $_POST['phone']]);
    // Rediriger vers listepatient.php
    header("Location: listepatient.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un patient</title>
    <link rel="stylesheet" href="style.css">
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<body>
    <div id="form-container">
        <h1>Ajouter un nouveau patient</h1>
        <form id="add-patient-form" method="post">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="date_naissance">Date de naissance :</label>
                <input type="date" id="date_naissance" name="date_naissance" required>
            </div>
            <div class="form-group">
                <label for="adresse">Adresse :</label>
                <input type="text" id="adresse" name="adresse" required>
            </div>
            <div class="form-group">
                <label for="condition_medical">Condition médicale :</label>
                <input type="text" id="condition_medical" name="condition_medical">
            </div>

            <div class="form-group">
                <label for="phone">Numéro de téléphone:</label>
                <input type="tel" id="phone" name="phone">
            </div>

            <div class="form-group">
                <button type="submit">Ajouter le patient</button>
            </div>
        </form>
    </div>
    <script>
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            initialCountry: "fr",
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"
        });
    </script>
</body>
</html>
