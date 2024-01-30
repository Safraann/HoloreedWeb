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

// Vérifier si l'identifiant de la séance à supprimer est passé en paramètre
if (isset($_GET['seance_id'])) {
    $seance_id = $_GET['seance_id'];

    // Récupérer l'ID du médecin connecté à partir de la session
    $idMedecin = $_SESSION['id_medecin'];

    // Vérifier si la séance appartient au médecin connecté
    $sql_check_seance = "SELECT medecin_id FROM seances WHERE id = :seance_id";
    $stmt_check_seance = $pdo->prepare($sql_check_seance);
    $stmt_check_seance->bindParam(':seance_id', $seance_id, PDO::PARAM_INT);
    $stmt_check_seance->execute();
    $seance = $stmt_check_seance->fetch(PDO::FETCH_ASSOC);

    if ($seance && $seance['medecin_id'] == $idMedecin) {
        // La séance appartient au médecin connecté, supprimer la séance
        $sql_delete_seance = "DELETE FROM seances WHERE id = :seance_id";
        $stmt_delete_seance = $pdo->prepare($sql_delete_seance);
        $stmt_delete_seance->bindParam(':seance_id', $seance_id, PDO::PARAM_INT);
        $stmt_delete_seance->execute();

        // Rediriger vers l'emploi du temps après la suppression de la séance
        header("Location: edt.php");
        exit;
    } else {
        // Rediriger vers l'emploi du temps avec un message d'erreur si la séance n'appartient pas au médecin connecté
        header("Location: edt.php?error=1");
        exit;
    }
} else {
    // Si l'identifiant de la séance n'est pas spécifié, rediriger vers l'emploi du temps
    header("Location: edt.php");
    exit;
}
?>
