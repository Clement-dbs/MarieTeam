<?php

// Récupère les secteurs
$secteurs = getSecteurs();

// Récupère les liaisons en fonction du secteur
if(isset($_POST['secteur']) || isset($_SESSION['secteur'])){
    $liaisons = getLiaisons($_SESSION['secteur']);
}

// Récupère les traversees en fonctions des données du formulaire 
if (isset($_POST['rechercher']) && !empty($_POST['liaison']) && !empty($_POST['dateDepart'])) {
    $traversees = getTraversees($_SESSION['liaison'], $_SESSION['dateDepart']);
}


// Récupère les données de la traversee en utilisant son id
if(isset($_POST['traversee'])){
    $traversees = getTraversees($_SESSION['liaison'], $_SESSION['dateDepart']);
    $traversee = getTraverseesById($_SESSION['traversee']);
}

include "$racine/vue/accueil.php";

?>