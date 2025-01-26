<?php
    include_once "Modele/inscription.php";

    if(isset($_POST['inscription'])){

        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $telephone = $_POST['telephone'];
    
        inscriptionUtilisateur($nom,$prenom,$email,$mdp,$telephone);
        header('Location: ./?action=connexion');
        exit(); 
    }
    include "$racine/vue/inscription.php";
?>