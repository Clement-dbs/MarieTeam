<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}

function afficherReservations() {
    try {
        $pdo = connexionDatabase();
        $query = $pdo->prepare("
        SELECT 
            vr.id_reservation,
            vr.date,
            vr.prix_total,
            u.nom,
            u.prenom,
            vr.port_depart,
            vr.port_arrive,
            SUM(vr.quantite_passager) AS total_passagers,
            SUM(vr.quantite_vehicule) AS total_vehicules
        FROM vue_reservation vr
        JOIN utilisateur u ON vr.id_utilisateur = u.id
        GROUP BY 
            vr.id_reservation,
            vr.date,
            vr.prix_total,
            u.nom,
            u.prenom,
            vr.port_depart,
            vr.port_arrive
        ORDER BY vr.id_reservation DESC;

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