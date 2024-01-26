<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Emploi du temps</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/fullcalendar@5/main.min.css' rel='stylesheet' />
    <script src='https://unpkg.com/fullcalendar@5/main.min.js'></script>
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
                eventClick: function (info) {
                    var details = 'Séance avec : ' + info.event.title + '\n' +
                        'Date : ' + info.event.start.toLocaleString() + '\n' +
                        'Description : ' + (info.event.extendedProps.description || 'Pas de description');
                    document.getElementById('eventDetails').innerText = details;
                    document.getElementById('eventModal').style.display = 'block';
                }
            });

            // Charge les séances depuis localStorage et les ajoute au calendrier
            var sceances = JSON.parse(localStorage.getItem('sceances')) || [];
            var patients = JSON.parse(localStorage.getItem('patients')) || [];

            sceances.forEach(function (sceance) {
                var patientName = patients[sceance.patient]?.nom || 'Inconnu';
                var eventTitle =  patientName+ ' - ' + sceance.time;

                calendar.addEvent({
                    title: eventTitle,
                    start: sceance.date + 'T' + sceance.time,
                    description: sceance.description
                });
            });

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
