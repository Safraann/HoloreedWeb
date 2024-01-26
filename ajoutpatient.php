<?php include 'header.php'; ?>
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
                <label for="phone">Numéro de télephone:</label>
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
                const telephone = document.getElementById('phone').value;

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