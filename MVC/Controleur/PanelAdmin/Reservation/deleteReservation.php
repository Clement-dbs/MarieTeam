<?php

if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    exit("Accès interdit.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['id_reservation'])) {
        $idReservation = intval($_POST['id_reservation']);

        try {
            $pdo = connexionDatabase();
            $query = $pdo->prepare("DELETE FROM reservation WHERE id = :id");
            $query->bindParam(':id', $idReservation, PDO::PARAM_INT);

            if ($query->execute()) {
                $_SESSION['success'] = "La réservation a bien été supprimée.";
            } else {
                $_SESSION['error'] = "Erreur lors de la suppression de la réservation.";
            }
        } catch (PDOException $e) {
            $_SESSION['error'] = "Erreur SQL : " . $e->getMessage();
        }
    } else {
        $_SESSION['error'] = "ID de réservation manquant.";
    }
} else {
    $_SESSION['error'] = "Méthode non autorisée.";
}

header("Location: ./?action=panelReservation");