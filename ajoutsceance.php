<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Ajouter une séance</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Ajouter une séance à l'emploi du temps</h1>
    <div id="schedule-add">
        <form id="add-session-form">
            <div class="form-group">
                <label for="date">Date de la séance :</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Heure de la séance :</label>
                <input type="time" id="time" name="time" required>
            </div>
            <div class="form-group">
                <label for="patient">Nom du patient :</label>
                <select id="patient" name="patient" required>
                    <option value="">--Sélectionnez un patient--</option>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <button type="submit">Ajouter la séance</button>
        </form>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('add-session-form');
            form.addEventListener('submit', function (event) {
                event.preventDefault(); // Empêcher la soumission réelle du formulaire

                // Récupérer les valeurs du formulaire
                const date = document.getElementById('date').value;
                const time = document.getElementById('time').value;
                const patient = document.getElementById('patient').value;
                const description = document.getElementById('description').value;

                // Construire l'objet séance
                const newSceance = { date, time, patient, description };

                // Récupérer les séances existantes et ajouter la nouvelle
                const sceances = JSON.parse(localStorage.getItem('sceances')) || [];
                sceances.push(newSceance);
                localStorage.setItem('sceances', JSON.stringify(sceances));

                // Rediriger vers edt.php ou recharger la page du calendrier
                window.location.href = 'edt.php';
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const patientSelect = document.getElementById('patient');
            const patients = JSON.parse(localStorage.getItem('patients')) || [];

            patients.forEach(function (patient, index) {
                const option = document.createElement('option');
                option.value = index; // ou une autre clé unique pour le patient
                option.textContent = `${patient.nom} ${patient.prenom}`;
                patientSelect.appendChild(option);
            });

            // Gestionnaire de soumission du formulaire existant
            const form = document.getElementById('add-session-form');
            form.addEventListener('submit', function (event) {
                // ... Code existant ...
            });
        });
    </script>

</body>

</html>