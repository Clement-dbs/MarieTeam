<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}
function afficherTraversees() {
    try {
        $pdo = connexionDatabase();
        $query = $pdo->prepare("
        SELECT *
        FROM vue_traversee
        ORDER BY id_traversee
        ");
        $query->execute();
        $traversees = $query->fetchAll(PDO::FETCH_ASSOC);
        return $traversees;

    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

$traversees = afficherTraversees();
include "$racine/Vue/panelTraversee.php";