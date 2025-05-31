<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}
function afficherSecteur() {
    try {
        $pdo = connexionDatabase();
        $query = $pdo->prepare("
        SELECT *
        FROM secteur
        ");
        $query->execute();
        $secteurs = $query->fetchAll(PDO::FETCH_ASSOC);
        return $secteurs;

    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

$secteurs = afficherSecteur();
include "$racine/Vue/panelSecteur.php";