<?php
// Connexion à la base de données
$db = new PDO('mysql:host=localhost;dbname=marieteamwebcorrection;charset=utf8', 'root', '');

$typeVoyageurs = getTypeVoyageurs();
$placeRestantes = getPlacesRestantesBateau(1);

$placesRestantesParCategorie = [
  '1' => $placeRestantes['Place Passager'],
  '2' => $placeRestantes['Place Véhicule Léger'],
  '3' => $placeRestantes['Place Véhicule Lourd']
];

include "$racine/vue/reservation.php";

?>