<?php
include_once "Modele/authentification.php";

if (!isset($_SESSION['utilisateur'])) {
    header('Location: ./?action=connexion');
    exit();
}

$message = "";

if (isset($_POST['modifier_profil'])) {
    $id = $_SESSION['utilisateur'][0]['id'];
    $email = $_POST['email'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $mdp = $_POST['mdp'];
    $telephone = $_POST['telephone'];
    $confirm_mdp = $_POST['confirm_mdp'];

    // Vérifier si un nouveau mot de passe est entré
    if (!empty($mdp) || !empty($confirm_mdp)) {
        if ($mdp !== $confirm_mdp) {
            $message = "Les mots de passe ne correspondent pas.";
        } else {
            $mdp = password_hash($mdp, PASSWORD_DEFAULT);
        }
    } else {
        $mdp = $_SESSION['utilisateur'][0]['mdp']; // Conserver l'ancien mot de passe
    }

    // Si pas d'erreur, mise à jour du profil
    if ($message === "") {
        if (modifierProfil($id, $email, $nom, $prenom, $mdp, $telephone)) {
            $_SESSION['utilisateur'] = profilUtilisateur($id);
            $message = "Profil mis à jour avec succès !";
        } else {
            $message = "Erreur lors de la mise à jour du profil.";
        }
    }
}

// Inclure la vue
include "$racine/vue/editProfil.php";
?>
