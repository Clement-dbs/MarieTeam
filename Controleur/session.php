<?php

if(!isset($_SESSION)) session_start();  

/*
 // Affiche les données de la session
 echo "<h2>Données de la session :</h2>";
 echo "<ul>";
 
 foreach ($_SESSION as $key => $value) {
     
     if (is_array($value) || is_object($value)) {
         echo "<li><strong>$key</strong> : <pre>" . print_r($value, true) . "</pre></li>";
     } else {
         echo "<li><strong>$key</strong> : $value</li>";
     }
 }
 echo "</ul>";


 if (isset($_POST['logout'])) {

         session_destroy();
         header("Location: ../Vue/index.php");
     exit();
 }

?>
   <!-- Vider la session en cours -->
   <form action="" method="POST">
        <input type="submit" name="logout" value="Se déconnecter">
    </form>*/