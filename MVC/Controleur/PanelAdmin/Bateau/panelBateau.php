<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}
function afficherBateaux() {
    try {
        $pdo = connexionDatabase();
        $query = $pdo->prepare("
        SELECT *
        FROM bateau
        ");
        $query->execute();
        $bateaux = $query->fetchAll(PDO::FETCH_ASSOC);
        return $bateaux;

    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

$bateaux = afficherBateaux();
include "$racine/vue/panelBateau.php";