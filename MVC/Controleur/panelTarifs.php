<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}

function afficherTarifs($periodeSelectionnee = '', $liaisonSelectionnee = '') {
    try {
        $pdo = connexionDatabase();

        // Requête avec jointure entre 'vue_tarifs' et 'periode' (par exemple)
        $query = "SELECT vt.*, vl.*
                  FROM vue_tarifs vt
                  LEFT JOIN vue_liaisons vl ON vl.id_liaison = vl.id_liaison
                  WHERE 1"; 

        // Ajout du filtre par période si sélectionnée
        if ($periodeSelectionnee !== '') {
            $query .= " AND vt.id_periode = :periode";
        }

        // Ajout du filtre par liaison si sélectionnée
        if ($liaisonSelectionnee !== '') {
            $query .= " AND vt.id_liaison = :liaison";
        }

        // Préparation et exécution de la requête avec les paramètres
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


$periodeSelectionnee = $_GET['periode'] ?? '';  // période filtrée par l'utilisateur
$liaisonSelectionnee = $_GET['liaison'] ?? '';  // Liaison filtrée par l'utilisateur

// Récupérer les tarifs en fonction des filtres
$tarifs = afficherTarifs($periodeSelectionnee, $liaisonSelectionnee);

// Récupérer toutes les périodes et liaisons pour l'affichage dans le filtre
$periodes = recupererPeriodes();
$liaisons = recupererLiaisons();

include "$racine/vue/panelTarifs.php";
