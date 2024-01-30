<?php
include 'header.php';

// Vérifiez si l'identifiant du patient à supprimer est passé en paramètre
if (isset($_GET['patient_id'])) {
    // Inclure le fichier de configuration de la base de données
    include 'config.php';

    // Récupérer l'identifiant du patient depuis les paramètres GET
    $patient_id = $_GET['patient_id'];

    $sql_delete_seances = "DELETE FROM seances WHERE patient_id = ?";
    $stmt_delete_seances = $pdo->prepare($sql_delete_seances);
    $stmt_delete_seances->execute([$patient_id]);
	
    // Préparer et exécuter la requête DELETE pour supprimer le patient de la base de données
    $sql_delete_patient = "DELETE FROM patients WHERE id = ?";
    $stmt_delete_patient = $pdo->prepare($sql_delete_patient);
    $stmt_delete_patient->execute([$patient_id]);

    // Rediriger vers listepatient.php après la suppression
    header("Location: listepatient.php");
    exit;
} else {
    // Si l'identifiant du patient n'est pas spécifié, rediriger vers listepatient.php
    header("Location: listepatient.php");
    exit;
}
?>
