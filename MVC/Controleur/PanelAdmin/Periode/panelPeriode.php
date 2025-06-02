<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}
function afficherPeriodes() {
    try {
        $pdo = connexionDatabase();
        $query = $pdo->prepare("
        SELECT *
        FROM periode
        ");
        $query->execute();
        $periodes = $query->fetchAll(PDO::FETCH_ASSOC);
        return $periodes;

    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

$periodes = afficherPeriodes();
include "$racine/Vue/panelPeriode.php";