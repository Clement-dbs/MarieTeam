<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../CSS/style.css">
  <title>Réservation</title>
</head>
<body>

  <?php
  include_once "../Modele/session.php";
  include_once "../Modele/function.php";
    if (isset($_POST['traversee'])) {
      $codeLiaison = $_SESSION['liaison'];
      $traversees = getTraversees($codeLiaison);
      // Sauvegarde de la traversée sélectionnée
      $_SESSION['traversee'] = $traversees[$_POST['traversee']];

      echo "<h3>Détails de la traversée sélectionnée :</h3>";
      //echo "<p>Traversée n° : " .$_SESSION['liaison'] . " à " . $traversees[$_POST['traversee']][0] . "</p>";
      echo "<h3>Saisir les informations relatives à la réservation :</h3>";
      echo "<ul class='complementaire'>
              <li>Junior : 8 à 18 ans</li>
              <li>Enfant : 0 à 7 ans</li>
              <li>Voiture : < 4m</li>
            </ul>";
    }
  ?>

  <form action="../Controleur/insertClient.php" method="POST">
    <ul>
      <li>
        <label for="nom">Nom :</label>
        <input type="text" name="nom" value=""/>
      </li>
      <li>
        <label for="adresse">Adresse :</label>
        <input type="text" name="adresse" value=""/>
      </li>
      <li>
        <label for="codePostale">Code Postal :</label>
        <input type="number" name="codePostale" value="">
      </li>
      <li>
        <label for="ville">Ville :</label>
        <input type="text" name="ville" value="">
      </li>
    </ul>

    <table>
    <?php

      $tarifs = getTarif(); 
      foreach($tarifs as $index => $tarif){
        echo "<tr>";
        echo "<td value=". $tarif['Categorie'] .">" . $tarif['TypeTarif'] . "</td>";  
        echo "<td>" . $tarif['Tarif'] . "</td>";  
        echo '<td><input type="number" name="quantite[]" value="0" min="0"></td>'; 
        echo '<input type="hidden" name="tarif[]" value="' . $tarif['Tarif'] . '">';
        echo "</tr>";
      }

    ?>
    </table>

    <input type="submit" name="btn_submit" value="Enregistrer la réservation">
  </form>

</body>
</html>
