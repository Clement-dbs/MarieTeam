<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}
function afficherPorts() {
    try {
        $pdo = connexionDatabase();
        $query = $pdo->prepare("
        SELECT *
        FROM port
        ");
        $query->execute();
        $ports = $query->fetchAll(PDO::FETCH_ASSOC);
        return $ports;

    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

$ports = afficherPorts();

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

    $portDepart  = $_POST['portDepart'] ?? null;
    $portArrive  = $_POST['portArrive'] ?? null;
    $distance  = $_POST['distance'] ?? null;
    $secteur  = $_POST['secteur'] ?? null;
    $bateau  = $_POST['bateau'] ?? null;

    try { 
        $pdo = connexionDatabase();
        $query = $pdo->prepare("INSERT INTO liaison (distance, port_arrive, port_depart, id_secteur, id_bateau) VALUES (:distance, :portDepart, :portArrive, :secteur, :bateau)");
        $query->bindParam(':distance', $distance, PDO::PARAM_INT);
        $query->bindParam(':portDepart', $portDepart, PDO::PARAM_INT);
        $query->bindParam(':portArrive', $portArrive, PDO::PARAM_INT);
        $query->bindParam(':secteur', $secteur, PDO::PARAM_INT);
        $query->bindParam(':bateau', $bateau, PDO::PARAM_INT);
        $query->execute();        
        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        echo "Nouvelle liaison enregistré";

        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
}
include "$racine/Vue/ajoutLiaison.php";