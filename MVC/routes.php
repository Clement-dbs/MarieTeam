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
    $lesChemins["deletePeriode"] = "/PanelAdmin/Periode/deletePeriode.php";
    $lesChemins["ajoutTraversee"] = "/PanelAdmin/Traversee/ajoutTraversee.php";
    $lesChemins["panelTraversee"] = "/PanelAdmin/Traversee/panelTraversee.php";
    $lesChemins["deleteTraversee"] = "/PanelAdmin/Traversee/deleteTraversee.php";
    $lesChemins["panelReservation"] = "/PanelAdmin/Reservation/panelReservation.php";
    $lesChemins["deleteReservation"] = "/PanelAdmin/Reservation/deleteReservation.php";
    $lesChemins["gestionUtilisateurs"] = "/PanelAdmin/Utilisateur/gestionUtilisateurs.php";
    $lesChemins["deleteUtilisateur"] = "/PanelAdmin/Utilisateur/deleteUtilisateur.php";
    $lesChemins["panelBateau"] = "/PanelAdmin/Bateau/panelBateau.php";
    $lesChemins["ajoutBateau"] = "/PanelAdmin/Bateau/ajoutBateau.php";
    $lesChemins["deleteBateau"] = "/PanelAdmin/Bateau/deleteBateau.php";
    $lesChemins["panelTarifs"] = "/PanelAdmin/Tarif/panelTarifs.php";
    $lesChemins["ajoutTarif"] = "/PanelAdmin/Tarif/ajoutTarif.php";
    $lesChemins["deleteTarif"] = "/PanelAdmin/Tarif/deleteTarif.php";
    $lesChemins["panelLiaison"] = "/PanelAdmin/Liaison/panelLiaison.php";
    $lesChemins["ajoutLiaison"] = "/PanelAdmin/Liaison/ajoutLiaison.php";
    $lesChemins["deleteLiaison"] = "/PanelAdmin/Liaison/deleteLiaison.php";
    $lesChemins["panelSecteur"] = "/PanelAdmin/Secteur/panelSecteur.php";
    $lesChemins["ajoutSecteur"] = "/PanelAdmin/Secteur/ajoutSecteur.php";
    $lesChemins["deleteSecteur"] = "/PanelAdmin/Secteur/deleteSecteur.php";
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