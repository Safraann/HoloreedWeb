<?php
session_start(); // Démarrer la session si ce n'est pas déjà fait
include 'header.php';
include 'config.php'; // Inclure le fichier de configuration de la base de données

// Vérifier si le médecin est connecté (vous devez remplacer 'id_medecin' par la clé utilisée pour stocker l'ID du médecin dans la session)
if (!isset($_SESSION['id_medecin'])) {
    // Rediriger vers la page de connexion ou une autre page appropriée si le médecin n'est pas connecté
    header("Location: connexion.php");
    exit;
}

$idMedecin = $_SESSION['id_medecin']; // Récupérer l'ID du médecin connecté à partir de la session

// Récupérer les séances à partir de la base de données
$sql = "SELECT date_rdv, time_rdv, description, patient_id FROM seances WHERE medecin_id = :medecin_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':medecin_id', $idMedecin, PDO::PARAM_INT);
$stmt->execute();
$seances = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Créer un tableau d'événements pour FullCalendar
$events = [];

foreach ($seances as $sceance) {
    // Récupérer le nom du patient associé
    $sqlPatient = "SELECT nom FROM patients WHERE id = :patient_id";
    $stmtPatient = $pdo->prepare($sqlPatient);
    $stmtPatient->bindParam(':patient_id', $sceance['patient_id'], PDO::PARAM_INT);
    $stmtPatient->execute();
    $patient = $stmtPatient->fetch(PDO::FETCH_ASSOC);

    // Créer un événement pour le calendrier
    $event = [
        'title' => $patient['nom'] . ' - ' . $sceance['time_rdv'],
        'start' => $sceance['date_rdv'] . 'T' . $sceance['time_rdv'],
        'description' => $sceance['description']
    ];

    $events[] = $event;
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Emploi du temps</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/fullcalendar@5/main.min.css' rel='stylesheet' />
    <script src='https://unpkg.com/fullcalendar@5/main.min.js'></script>
    <script src='https://unpkg.com/fullcalendar@5/core/locales/fr.js'></script>
</head>

<body>
    <div class="calendar-header">
        <h1>Emploi du temps du Dr. Santé</h1>
    </div>
    <div id='calendar'></div>

    <!-- Modale pour afficher les détails de l'événement -->
    <div id="eventModal" class="modal">
        <div class="modal-content">
            <span class="close-button" onclick="closeModal()">&times;</span>
            <p id="eventDetails"></p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'fr',
                initialView: 'dayGridMonth',
                customButtons: {
                    addSceanceButton: {
                        text: 'Ajouter un rendez-vous',
                        click: function () {
                            window.location.href = 'ajoutsceance.php';
                        }
                    }
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'addSceanceButton'
                },
                eventContent: function (info) {
                    var patientName = info.event.title;
                    var eventTime = info.event.start.toLocaleTimeString('fr-FR', {
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                    var parts = patientName.split(' - ');
                    if (parts.length > 1) {
                        patientName = parts[0]; // Pour obtenir uniquement le nom du patient
                    }

                    return {
                        html: '<b>' + eventTime + '</b><b><b>' + patientName + '</b> '
                    };
                },
                eventClick: function (info) {
                    var details = 'Séance avec : ' + info.event.title + '<br>' +
                        'Date : ' + info.event.start.toLocaleString() + '<br>' +
                        'Description : ' + (info.event.extendedProps.description || 'Pas de description');
                    document.getElementById('eventDetails').innerHTML = details;
                    document.getElementById('eventModal').style.display = 'block';
                }
            });

            // Charger les événements à partir de la base de données
            var events = <?php echo json_encode($events); ?>;
            calendar.addEventSource(events);

            calendar.render();
        });

        function closeModal() {
            document.getElementById('eventModal').style.display = 'none';
        }
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    </script>
</body>

</html>