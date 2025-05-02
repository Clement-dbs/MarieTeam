<?php
$userId = $_SESSION['utilisateur'][0]['id'];

function getReservations($userId, $type) {
    try {
        $pdo = connexionDatabase();
        $sql = "";

        if ($type == 'future') {
            $sql = "SELECT * FROM vue_reservation
                    WHERE id_utilisateur = :userId AND date >= CURDATE()";
        } elseif ($type == 'past') {
            $sql = "SELECT * FROM vue_reservation
                    WHERE id_utilisateur = :userId AND date < CURDATE()";
        }

        $query = $pdo->prepare($sql);
        $query->bindParam(':userId', $userId);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération des réservations : " . $e->getMessage();
    }
}

// Récupération des réservations à venir
$reservationsPrevues = getReservations($userId, 'future'); // future pour réservations à venir
$reservationsPassees = getReservations($userId, 'past'); // past pour réservations passées

include "$racine/vue/profilReservation.php";