<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Liste des patients</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Liste des patients</h1>
    <div id="patients-list">
        <table>
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>Profil</th>
                </tr>
            </thead>
            <tbody id="patients-table-body">
                <!-- Les patients seront ajoutés ici par JavaScript -->
            </tbody>
        </table>
        <div class="button-container">
            <a href="ajoutpatient.php"><button>Ajouter un patient</button></a>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const patientsTableBody = document.getElementById('patients-table-body');

            // Récupérer la liste des patients depuis localStorage
            const patients = JSON.parse(localStorage.getItem('patients')) || [];

            patients.forEach(function (patient, index) {
                const patientRow = document.createElement('tr');
                patientRow.innerHTML = `
                    <td>${patient.nom}</td>
                    <td>${patient.prenom}</td>
                    <td>${patient.date_naissance}</td>
                    <td><a href="profilepatient.php?patient_id=${index + 1}">Voir profil</a></td>
                `;
                patientsTableBody.appendChild(patientRow);
            });
        });
    </script>
</body>

</html>
