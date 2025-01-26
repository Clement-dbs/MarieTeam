<?php
echo "<br>Nom : ".$nom;
  echo "<br>Prenom : ".$prenom;
  echo "<br>Email : ".$email;
  echo "<br>Téléphone : ".$tel;
  
  $types = [
      'Adulte' => $adulte,
      'Junior' => $junior,
      'Enfant' => $enfant,
      'Voiture < 4' => $voiture_4,
      'Voiture < 5' => $voiture_5,
      'Fourgon' => $fourgon,
      'Camping car' => $camping_car,
      'Camion' => $camion
  ];
  
  foreach ($types as $key => $value) {
      $index = array_search($key, array_keys($types)); // Trouver l'index du tarif
      if ($quantites[$index] > 0) {
          echo "<br>$key : $value, " . $tarifs[$index] * $quantites[$index] . " €";
      }
  }

  echo "<br>Prix total : ".$prixTotal." €";