<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Profil du patient</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Profil du patient</h1>
    <div id="patient-profile">
        <!-- Les détails du patient seront ajoutés ici par JavaScript -->
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const patients = JSON.parse(localStorage.getItem('patients')) || [];
            const urlParams = new URLSearchParams(window.location.search);
            const patientId = urlParams.get('patient_id') - 1; // L'index dans le tableau commence à 0

            if (patients[patientId]) {
                const patient = patients[patientId];
                const patientProfile = document.getElementById('patient-profile');
                patientProfile.innerHTML = `
                    <h2>${patient.nom}   ${patient.prenom}</h2>
                    <p>Date de naissance: ${patient.date_naissance}</p>
                    <p>Adresse: ${patient.adresse}</p>
                    <p>Condition médicale: ${patient.condition_medical}</p>
                    <p>Téléphone: ${patient.telephone}</p>
                    <button onclick="window.location.href='listepatient.php'">Retour</button>

                `;
            } else {
                document.getElementById('patient-profile').innerText = 'Patient non trouvé.';
            }
        });
    </script>
</body>
</html>
