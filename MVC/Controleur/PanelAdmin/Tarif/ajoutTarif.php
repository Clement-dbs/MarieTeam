<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}

function afficherTypesperiodesLiaisons() {
    try {
        $pdo = connexionDatabase();

        // Récupérer tous les types
        $typesQuery = $pdo->prepare("SELECT * FROM type_passager");
        $typesQuery->execute();
        $type_passager = $typesQuery->fetchAll(PDO::FETCH_ASSOC);

        $typesQuery = $pdo->prepare("SELECT * FROM type_vehicule");
        $typesQuery->execute();
        $type_vehicule = $typesQuery->fetchAll(PDO::FETCH_ASSOC);

        // Récupérer toutes les periodes
        $periodesQuery = $pdo->prepare("SELECT * FROM periode");
        $periodesQuery->execute();
        $periodes = $periodesQuery->fetchAll(PDO::FETCH_ASSOC);

        // Récupérer toutes les liaisons
        $liaisonsQuery = $pdo->prepare("SELECT * FROM vue_liaisons");
        $liaisonsQuery->execute();
        $liaisons = $liaisonsQuery->fetchAll(PDO::FETCH_ASSOC);

        return ['type_passager' => $type_passager, 'type_vehicule' => $type_vehicule, 'debut' => $periodes, 'liaisons' => $liaisons];
    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

// Récupérer les données
$data = afficherTypesperiodesLiaisons();
$type_passager = $data['type_passager'];
$type_vehicule = $data['type_vehicule'];
$periodes = $data['debut'];
$liaisons = $data['liaisons'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = connexionDatabase();

        // Récupérer la période globale choisie
        $periodeGlobalId = $_POST['periodeGlobal'];
        if (!$periodeGlobalId) {
            throw new Exception("Veuillez sélectionner une période globale.");
        }

        // Récupérer la date de début de la période globale
        $periodeQuery = $pdo->prepare("SELECT dateDebut FROM periode WHERE id = :periodeId");
        $periodeQuery->execute([':periodeId' => $periodeGlobalId]);
        $periode = $periodeQuery->fetch(PDO::FETCH_ASSOC);
        $debutGlobal = $periode ? $periode['dateDebut'] : null;

        // Récupérer la liaison globale choisie
        $liaisonGlobalId = $_POST['liaisonGlobal'];
        if (!$liaisonGlobalId) {
            throw new Exception("Veuillez sélectionner une liaison globale.");
        }

        // Vérifier si la liaison globale existe
        $liaisonQuery = $pdo->prepare("SELECT * FROM liaison WHERE id = :id");
        $liaisonQuery->execute([':id' => $liaisonGlobalId]);
        $liaison = $liaisonQuery->fetch(PDO::FETCH_ASSOC);

        if (!$debutGlobal || !$liaison) {
            throw new Exception("Période ou liaison non valide.");
        }

        // Parcours des types et insertion des tarifs
        // Insertion des tarifs passagers
        foreach ($_POST['tarif_passager'] as $typeId => $tarif) {
            $query = $pdo->prepare("
                INSERT INTO tarif (id_liaison, id_periode, id_type_passager, tarif)
                VALUES (:id_liaison, :id_periode, :id_type, :tarif)
            ");
            $query->execute([
                ':id_liaison' => $liaisonGlobalId,
                ':id_periode' => $periodeGlobalId,
                ':id_type' => $typeId,
                ':tarif' => $tarif,
            ]);
        }

        // Insertion des tarifs véhicules
        foreach ($_POST['tarif_vehicule'] as $typeId => $tarif) {
            $query = $pdo->prepare("
                INSERT INTO tarif (id_liaison, id_periode, id_type_vehicule, tarif)
                VALUES (:id_liaison, :id_periode, :id_type, :tarif)
            ");
            $query->execute([
                ':id_liaison' => $liaisonGlobalId,
                ':id_periode' => $periodeGlobalId,
                ':id_type' => $typeId,
                ':tarif' => $tarif,
            ]);
        }

        header("Location: ./?action=panelTarifs");

    } catch (PDOException $e) {
        die("Une erreur s'est produite lors de l'ajout des tarifs : " . $e->getMessage());
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
}

// Inclure la vue
include "$racine/Vue/ajoutTarif.php";
?>
