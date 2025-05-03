<?php

function routes($chemin) {
    $lesChemins = array();
    $lesChemins["connexion"] = "/Utilisateur/connexion.php";
    $lesChemins["deconnexion"] = "/Utilisateur/deconnexion.php";
    $lesChemins["inscription"] = "/Utilisateur/inscription.php";
    $lesChemins["editProfil"] = "/Utilisateur/editProfil.php";
    $lesChemins["profilReservation"] = "/Utilisateur/profilReservation.php";
    $lesChemins["profil"] = "/Utilisateur/profil.php";
    $lesChemins["dashboard"] = "/PanelAdmin/index.php";
    $lesChemins["ajoutPeriode"] = "/PanelAdmin/Periode/ajoutPeriode.php";
    $lesChemins["panelPeriode"] = "/PanelAdmin/Periode/panelPeriode.php";
    $lesChemins["panelReservation"] = "/PanelAdmin/Reservation/panelReservation.php";
    $lesChemins["gestionUtilisateurs"] = "/PanelAdmin/Utilisateur/gestionUtilisateurs.php";
    $lesChemins["panelBateau"] = "/PanelAdmin/Bateau/panelBateau.php";
    $lesChemins["ajoutBateau"] = "/PanelAdmin/Bateau/ajoutBateau.php";
    $lesChemins["panelTarifs"] = "/PanelAdmin/Tarif/panelTarifs.php";
    $lesChemins["ajoutTarif"] = "/PanelAdmin/Tarif/ajoutTarif.php";
    $lesChemins["panelLiaison"] = "/PanelAdmin/Liaison/panelLiaison.php";
    $lesChemins["ajoutLiaison"] = "/PanelAdmin/Liaison/ajoutLiaison.php";
    $lesChemins["defaut"] = "Pages/accueil.php";
    $lesChemins["reservation"] = "/Pages/reservation.php";
    $lesChemins["recapReservation"] = "/Pages/recapReservation.php";
    if (array_key_exists($chemin, $lesChemins)) {
        return $lesChemins[$chemin];
    } 
    else {
        return "/Pages/accueil.php";
    }
}

?>