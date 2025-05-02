<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}
function afficherReservations() {
    try {
        $pdo = connexionDatabase();
        $query = $pdo->prepare("
        SELECT reservation.id, reservation.adulte,reservation.junior, reservation.enfant, reservation.voiture_4, reservation.voiture_5,reservation.fourgon,reservation.camping_car,reservation.camion,reservation.prix_total,reservation.utilisateur_id,reservation.id_traversee,utilisateur.nom, utilisateur.prenom,traversee.id
        FROM reservation 
        JOIN utilisateur 
        ON reservation.utilisateur_id = utilisateur.id
        JOIN traversee
        ON reservation.id_traversee = traversee.id
        ORDER BY reservation.id DESC
        ");
        $query->execute();
        $reservations = $query->fetchAll(PDO::FETCH_ASSOC);
        return $reservations;

    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

$reservations = afficherReservations();
include "$racine/vue/pannelReservation.php";