<?php

function routes($chemin) {
    $lesChemins = array();
    $lesChemins["defaut"] = "accueil.php";
    $lesChemins["connexion"] = "connexion.php";
    $lesChemins["deconnexion"] = "deconnexion.php";
    $lesChemins["inscription"] = "inscription.php";
    $lesChemins["profil"] = "profil.php";
    $lesChemins["reservation"] = "reservation.php";
    $lesChemins["recapReservation"] = "recapReservation.php";
    $lesChemins["insertClient"] = "insertClient.php";
    $lesChemins["dashboard"] = "dashboard.php";
    $lesChemins["ajoutPeriode"] = "ajoutPeriode.php";
    $lesChemins["pannelReservation"] = "pannelReservation.php";
    $lesChemins["gestionUtilisateurs"] = "gestionUtilisateurs.php";
    $lesChemins["panelPeriode"] = "panelPeriode.php";
    $lesChemins["panelBateau"] = "panelBateau.php";
    $lesChemins["ajoutBateau"] = "ajoutBateau.php";
    $lesChemins["panelTarifs"] = "panelTarifs.php";
    $lesChemins["ajoutTarif"] = "ajoutTarif.php";
    $lesChemins["editProfil"] = "editProfil.php";
    if (array_key_exists($chemin, $lesChemins)) {
        return $lesChemins[$chemin];
    } 
    else {
        return "accueil.php";
    }
}

?>