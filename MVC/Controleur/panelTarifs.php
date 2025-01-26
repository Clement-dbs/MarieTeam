<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}

function afficherTarifs($periodeSelectionnee = '', $liaisonSelectionnee = '') {
    try {
        $pdo = connexionDatabase();

        // Préparation de la requête de base
        $query = "SELECT 
                    tarifer.*, 
                    type.libelle AS type_libelle, 
                    liaison.* 
                  FROM tarifer
                  JOIN type ON type.id = tarifer.num
                  JOIN liaison ON liaison.code = tarifer.code
                  WHERE 1";

        // Ajout du filtre par periode si sélectionnée
        if ($periodeSelectionnee !== '') {
            $query .= " AND tarifer.debut = :periode";
        }

        // Ajout du filtre par liaison si sélectionnée
        if ($liaisonSelectionnee !== '') {
            $query .= " AND tarifer.code = :liaison";
        }

        // Exécution de la requête avec les paramètres
        $stmt = $pdo->prepare($query);

        if ($periodeSelectionnee !== '') {
            $stmt->bindParam(':periode', $periodeSelectionnee);
        }

        if ($liaisonSelectionnee !== '') {
            $stmt->bindParam(':liaison', $liaisonSelectionnee);
        }

        $stmt->execute();
        $tarifs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $tarifs;

    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

$periodeSelectionnee = $_GET['periode'] ?? '';  // periode filtrée par l'utilisateur
$liaisonSelectionnee = $_GET['liaison'] ?? '';  // Liaison filtrée par l'utilisateur

// Récupérer les tarifs en fonction des filtres
$tarifs = afficherTarifs($periodeSelectionnee, $liaisonSelectionnee);

// Récupérer toutes les periodes et liaisons pour l'affichage dans le filtre
$periodes = recupererPeriodes();
$liaisons = recupererLiaisons();  // Vous devez définir cette fonction pour récupérer les liaisons.

include "$racine/vue/panelTarifs.php";
