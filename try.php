<!DOCTYPE html>
<html>
<head>
    <title>Envoi de Données à HoloLens</title>
</head>
<body>
    <h1>Envoi de données à HoloLens</h1>
    <form id="dataForm">
        <input type="text" id="dataInput" placeholder="Entrez votre message ici" />
        <button type="submit">Envoyer Données à HoloLens</button>
    </form>

    <script>
        document.getElementById('dataForm').addEventListener('submit', function (event) {
            event.preventDefault(); // Pour éviter le rechargement de la page
            var dataToSend = document.getElementById('dataInput').value;
            sendDataToHoloLens({ message: dataToSend });
        });

        function sendDataToHoloLens(data) {
            fetch('http://localhost:3000/send-to-hololens', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                console.log('Success:', data);
                // Afficher un message de succès ou réinitialiser le formulaire ici si nécessaire
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
    </script>
</body>
</html>
