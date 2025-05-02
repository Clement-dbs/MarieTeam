<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}
if (isset($_POST['submit'])) {

    $dateDebut  = $_POST['dateDebut'] ?? null;
    $dateFin  = $_POST['dateFin'] ?? null;
    $nom  = $_POST['nom'] ?? null;

    try { 
        $pdo = connexionDatabase();
        $query = $pdo->prepare("INSERT INTO periode (nom, dateDebut, dateFin) VALUES (:nom, :dateDebut, :dateFin)");
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':dateDebut', $dateDebut, PDO::PARAM_STR);
        $query->bindParam(':dateFin', $dateFin, PDO::PARAM_STR);
        $query->execute();        
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        echo "Nouvelle periode enregistré, ".$nom." du ".$dateDebut." au ".$dateFin;

        include "$racine/vue/ajoutPeriode.php";

        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
}
include "$racine/vue/ajoutPeriode.php";