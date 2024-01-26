<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter un patient</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="form-container">
        <h1>Ajouter un nouveau patient</h1>
        <form id="add-patient-form">
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
                <label for="telephone">Numéro de téléphone :</label>
                <input type="tel" id="telephone" name="telephone" pattern="[0-9]{10}" required>
            </div>
            <div class="form-group">
                <button type="submit">Ajouter le patient</button>
            </div>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('add-patient-form');
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Empêcher la soumission réelle du formulaire

                // Récupérer les valeurs du formulaire
                const nom = document.getElementById('nom').value;
                const prenom = document.getElementById('prenom').value;
                const date_naissance = document.getElementById('date_naissance').value;
                const adresse = document.getElementById('adresse').value;
                const condition_medical = document.getElementById('condition_medical').value;
                const telephone = document.getElementById('telephone').value;

                // Récupérer les patients existants et ajouter le nouveau
                const patients = JSON.parse(localStorage.getItem('patients')) || [];
                patients.push({ nom, prenom, date_naissance, adresse, condition_medical, telephone });
                localStorage.setItem('patients', JSON.stringify(patients));

                // Rediriger vers listepatient.php
                window.location.href = 'listepatient.php';
            });
        });
    </script>
</body>

</html>
