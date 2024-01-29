<?php
include 'header.php';
include 'config.php'; // Inclure le fichier de configuration de la base de données

// Vérifier si le paramètre de l'URL est défini et s'assurer qu'il s'agit d'un entier valide
if (isset($_GET['patient_id']) && filter_var($_GET['patient_id'], FILTER_VALIDATE_INT)) {
    // Récupérer l'ID du patient à partir de l'URL
    $patientId = $_GET['patient_id'];

    // Préparer et exécuter la requête SQL pour récupérer les détails du patient
    $sql = "SELECT * FROM patients WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$patientId]);
    $patient = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Si l'ID du patient n'est pas défini dans l'URL ou n'est pas un entier valide, rediriger vers une page d'erreur ou une autre page appropriée
    header("Location: erreur.php");
    exit;
}
?>
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
        <?php if ($patient): ?>
            <h2><?= $patient['nom'] ?> <?= $patient['prenom'] ?></h2>
            <p>Date de naissance: <?= $patient['date'] ?></p>
            <p>Adresse: <?= $patient['adresse'] ?></p>
            <p>Condition médicale: <?= $patient['conditions'] ?></p>
            <p>Téléphone: <?= $patient['telephone'] ?></p>
            <button onclick="window.location.href='listepatient.php'">Retour</button>
        <?php else: ?>
            <p>Patient non trouvé.</p>
        <?php endif; ?>
    </div>
</body>
</html>
