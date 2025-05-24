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

if (isset($_POST['submit'])) {

    $dateDepart  = $_POST['dateDepart'] ?? null;
    $dateArrivee  = $_POST['dateArrivee'] ?? null;
    $liaison  = $_POST['liaison'] ?? null;

    try { 
        $pdo = connexionDatabase();

        $query = $pdo->prepare("
            INSERT INTO traversee (depart, arrive, id_liaison) 
            VALUES (:depart, :arrive, :id_liaison)
        ");

        $query->bindParam(':depart', $dateDepart, PDO::PARAM_STR);
        $query->bindParam(':arrive', $dateArrivee, PDO::PARAM_STR);
        $query->bindParam(':id_liaison', $liaison, PDO::PARAM_INT);
        $query->execute();

        echo "Nouvelle traversée enregistrée : départ le " . htmlspecialchars($dateDepart) . 
             ", arrivée le " . htmlspecialchars($dateArrivee) . 
             ", liaison ID " . htmlspecialchars($liaison) . ".";

        include "$racine/Vue/ajoutTraversee.php";

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}

include "$racine/Vue/ajoutTraversee.php";