<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}

function afficherSecteurs() {
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

$secteurs = afficherSecteurs();

if (isset($_POST['submit'])) {

    $nom  = $_POST['nom'] ?? null;
    $secteur  = $_POST['secteur'] ?? null;

    try { 
        $pdo = connexionDatabase();
        $query = $pdo->prepare("INSERT INTO port (nom, id_secteur) VALUES (:nom, :secteur)");
        $query->bindParam(':nom', $nom, PDO::PARAM_STR);
        $query->bindParam(':secteur', $secteur, PDO::PARAM_INT);
        $query->execute();        
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        echo "Nouveau port enregistré";

        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
}
include "$racine/Vue/ajoutPort.php";