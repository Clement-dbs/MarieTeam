<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}

function afficherTypesperiodesLiaisons() {
    try {
        $pdo = connexionDatabase();

        // Récupérer tous les types
        $typesQuery = $pdo->prepare("SELECT * FROM type");
        $typesQuery->execute();
        $types = $typesQuery->fetchAll(PDO::FETCH_ASSOC);

        // Récupérer toutes les periodes
        $periodesQuery = $pdo->prepare("SELECT * FROM periode");
        $periodesQuery->execute();
        $periodes = $periodesQuery->fetchAll(PDO::FETCH_ASSOC);

        // Récupérer toutes les liaisons
        $liaisonsQuery = $pdo->prepare("SELECT * FROM liaison");
        $liaisonsQuery->execute();
        $liaisons = $liaisonsQuery->fetchAll(PDO::FETCH_ASSOC);

        return ['types' => $types, 'debut' => $periodes, 'liaisons' => $liaisons];
    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

// Récupérer les données
$data = afficherTypesperiodesLiaisons();
$types = $data['types'];
$periodes = $data['debut'];
$liaisons = $data['liaisons'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = connexionDatabase();

        // Récupérer la periode globale choisie
        $periodeGlobalId = $_POST['periodeGlobal'];
        if (!$periodeGlobalId) {
            throw new Exception("Veuillez sélectionner une periode globale.");
        }

        // Récupérer la date de début de la periode globale
        $periodeQuery = $pdo->prepare("SELECT debut FROM periode WHERE id = :periodeId");
        $periodeQuery->execute([':periodeId' => $periodeGlobalId]);
        $periode = $periodeQuery->fetch(PDO::FETCH_ASSOC);
        $debutGlobal = $periode ? $periode['debut'] : null;

        // Récupérer la liaison globale choisie
        $liaisonGlobalCode = $_POST['liaisonGlobal'];
        if (!$liaisonGlobalCode) {
            throw new Exception("Veuillez sélectionner une liaison globale.");
        }

        // Vérifier si la liaison globale existe
        $liaisonQuery = $pdo->prepare("SELECT * FROM liaison WHERE code = :code");
        $liaisonQuery->execute([':code' => $liaisonGlobalCode]);
        $liaison = $liaisonQuery->fetch(PDO::FETCH_ASSOC);

        if (!$debutGlobal || !$liaison) {
            throw new Exception("periode ou liaison non valide.");
        }

        // Parcours des types et insertion des tarifs
        foreach ($_POST['tarif'] as $typeId => $tarif) {
            // Insertion du tarif avec la periode et la liaison globale
            $query = $pdo->prepare("
                INSERT INTO tarifer (debut, num, code, tarif)
                VALUES (:debut, :num, :code, :tarif)
            ");
            $query->execute([
                ':debut' => $debutGlobal,
                ':num' => $typeId,
                ':code' => $liaisonGlobalCode,
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
include "$racine/vue/ajoutTarif.php";
