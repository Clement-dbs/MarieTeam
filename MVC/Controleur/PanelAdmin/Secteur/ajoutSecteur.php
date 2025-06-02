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

    $nomSecteur  = $_POST['nom'] ?? null;

    try { 
        $pdo = connexionDatabase();
        $query = $pdo->prepare("INSERT INTO secteur (nom) VALUES (:nom)");
        $query->bindParam(':nom', $nomSecteur, PDO::PARAM_STR);
        $query->execute();        
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        echo "Nouveau secteur enregistré";

        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
}
include "$racine/Vue/ajoutSecteur.php";