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

// Récupérer la liste des patients depuis la base de données
$sqlPatients = "SELECT * FROM patients";
$stmtPatients = $pdo->query($sqlPatients);
$patients = $stmtPatients->fetchAll(PDO::FETCH_ASSOC);

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les valeurs du formulaire
    $date = $_POST['date'];
    $time = $_POST['time'];
    $patientId = $_POST['patient'];
    $description = $_POST['description'];

    // Préparer et exécuter la requête INSERT pour ajouter la séance à la base de données avec l'ID du médecin
    if (!empty($date) && !empty($time) && !empty($patientId) && !empty($description)) {
        // Préparer et exécuter la requête INSERT pour ajouter la séance à la base de données avec l'ID du médecin
        $sqlInsertSession = "INSERT INTO seances (medecin_id, patient_id, date_rdv, time_rdv, description) VALUES (?, ?, ?, ?, ?)";
        var_dump($_SESSION['id_medecin']);
        var_dump($_POST['patient']);
        var_dump($_POST['date']);
        var_dump($_POST['description']);
        $stmtInsertSession = $pdo->prepare($sqlInsertSession);
        $stmtInsertSession->execute([$idMedecin, $patientId, $date, $time, $description]);

        // Rediriger vers la page de l'emploi du temps ou recharger la page du calendrier si nécessaire
        header("Location: edt.php");
        exit;
    }else {
        // Gérer le cas où des données obligatoires sont manquantes
        echo "Tous les champs du formulaire doivent être remplis.";
    }
}
?>
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
        <form id="add-session-form" method="post">
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
                    <?php foreach ($patients as $patient): ?>
                        <option value="<?= $patient['id'] ?>"><?= $patient['nom'] ?> <?= $patient['prenom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="description">Description :</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <button type="submit">Ajouter la séance</button>
        </form>
    </div>
</body>

</html>
