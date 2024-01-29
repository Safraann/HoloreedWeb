<?php
include 'header.php';
include 'config.php'; // Inclure le fichier de configuration de la base de données

// Récupérer la liste des patients depuis la base de données
$sql = "SELECT * FROM patients";
$stmt = $pdo->query($sql);
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
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
                <?php foreach ($patients as $patient): ?>
                    <tr>
                        <td><?= $patient['nom'] ?></td>
                        <td><?= $patient['prenom'] ?></td>
                        <td><?= $patient['date'] ?></td>
                        <td><a href="profilepatient.php?patient_id=<?= $patient['id'] ?>">Voir profil</a></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="button-container">
            <a href="ajoutpatient.php"><button>Ajouter un patient</button></a>
        </div>
    </div>
</body>

</html>
