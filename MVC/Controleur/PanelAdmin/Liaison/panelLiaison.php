<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}
function afficherLiaisons() {
    try {
        $pdo = connexionDatabase();
        $query = $pdo->prepare("
        SELECT *
        FROM vue_liaisons
        ");
        $query->execute();
        $liaisons = $query->fetchAll(PDO::FETCH_ASSOC);
        return $liaisons;

    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

$liaisons = afficherLiaisons();
include "$racine/vue/panelLiaison.php";