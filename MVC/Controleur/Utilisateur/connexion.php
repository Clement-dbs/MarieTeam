<?php
include_once "Modele/authentification.php";

if (isset($_POST['connexion'])) {
    $resultat = connexionUtilisateur($_POST['email'], $_POST['mdp']);

    if (is_numeric($resultat)) { 
        // Connexion réussie
        $_SESSION['utilisateur'] = profilUtilisateur($resultat);
        header('Location: ./?action=accueil');
        exit();
    } else {
        // Stocker l'erreur en session
        $_SESSION['erreur_connexion'] = "Identifiant ou mot de passe incorrect";
        header('Location: ./?action=connexion');
        exit();
    }
}

// Inclure la vue après la vérification
include "$racine/vue/connexion.php";
?>
