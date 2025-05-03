<?php

if (!isset($_SESSION['utilisateur']) ) {
  header("Location: ./?action=connexion");
}

// Données qu'on utilise pour le formulaire de reservation
$traverseeDetail = getTraverseesById( $_SESSION['traversee']);
$typeVoyageurs = getTypeVoyageurs();
//$getBateau = $_SESSION['';]
$placeRestantes = getPlacesRestantesBateau(1);
$tarifs = getTarifs(1, 1);

// Données qu'on envoit dans la table reservation
$traversee = $_SESSION['traversee'];
$id_utilisateur = $_SESSION['utilisateur'][0]['id'];

// Permet de définir le nombre de place restant a sa catégorie
$placesRestantesParCategorie = [
  '1' => $placeRestantes['Place Passager'],
  '2' => $placeRestantes['Place Véhicule Léger'],
  '3' => $placeRestantes['Place Véhicule Lourd']
];

include "$racine/vue/reservation.php";

if(isset($_POST['btn_submit'])){

    $total = 0;
    // Calcule du total a payer
    foreach ($_POST['quantites'] as $type => $typeData) {
        foreach ($typeData as $idType => $quantite) {
            if ($quantite > 0) {
                // Trouver le tarif correspondant
                foreach ($tarifs as $t) {
                    if (
                        ($type === 'passager' && $t['id_type_passager'] == $idType) ||
                        ($type === 'vehicule' && $t['id_type_vehicule'] == $idType)
                    ) {
                        $tarif = $t['tarif'];
                        $total += $quantite * $tarif;
                        break;
                    }
                }
            }
        }
        
    }

    $id_reservation = addReservation($total, $traversee, $id_utilisateur);

    // Réinsère les quantités dans les tables passager et vehicule
    foreach ($_POST['quantites'] as $type => $typeData) {
        foreach ($typeData as $idType => $quantite) {
            if ($quantite > 0) {
                if ($type === 'passager') {
                    addPassager($id_reservation, $idType, $quantite);
                } elseif ($type === 'vehicule') {
                    addVehicule($id_reservation, $idType, $quantite);
                }
            }
        }
    }
  }
  
?>