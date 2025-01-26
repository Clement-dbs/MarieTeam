<?php

include_once "Modele/authentification.php";

if(isset($_POST['connexion'])){
        $_SESSION['utilisateur'] = profilUtilisateur(connexionUtilisateur($_POST['email'], $_POST['mdp']));
        header('Location: ./?action=accueil');
        exit(); 
}

include "$racine/vue/connexion.php";
?>