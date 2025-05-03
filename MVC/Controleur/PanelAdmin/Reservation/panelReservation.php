<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}

function afficherReservations() {
    try {
        $pdo = connexionDatabase();
        $query = $pdo->prepare("
        SELECT *
        FROM vue_reservation 
        JOIN utilisateur 
        ON vue_reservation.id_utilisateur = utilisateur.id
        JOIN traversee
        ON vue_reservation.id_traversee = traversee.id
        ORDER BY vue_reservation.id_reservation DESC
        ");
        $query->execute();
        $reservations = $query->fetchAll(PDO::FETCH_ASSOC);
        return $reservations;

    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

$reservations = afficherReservations();
include "$racine/Vue/panelReservation.php";