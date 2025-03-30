<?php
include_once "Modele/inscription.php";
include_once "Modele/authentification.php"; // Pour récupérer le profil utilisateur après inscription

$message = "";

if (isset($_POST['inscription'])) {
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $email = trim($_POST['email']);
    $mdp = $_POST['mdp'];
    $confirm_mdp = $_POST['confirm_mdp'];
    $telephone = trim($_POST['telephone']);

    // Vérification de la correspondance des mots de passe
    if ($mdp !== $confirm_mdp) {
        $message = "Les mots de passe ne correspondent pas.";
    } 
    // Vérification de la politique de mot de passe
    elseif (!preg_match('/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $mdp)) {
        $message = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, un chiffre et un caractère spécial.";
    } 
    else {
        $idUtilisateur = inscriptionUtilisateur($nom, $prenom, $email, $mdp, $telephone);
        if ($idUtilisateur) {
            // Connexion automatique
            $_SESSION['utilisateur'] = profilUtilisateur($idUtilisateur);
            header('Location: ./?action=accueil'); // Redirection vers l'accueil après connexion
            exit();
        } else {
            $message = "Erreur lors de l'inscription. Veuillez réessayer.";
        }
    }
}

include "$racine/vue/inscription.php";
?>
