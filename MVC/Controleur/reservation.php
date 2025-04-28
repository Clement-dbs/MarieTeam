<?php
 $periodeSelectionnee = $_SESSION['dateDepart'] ?? null;
 $tarifs = $periodeSelectionnee ? getTarifsByPeriode($periodeSelectionnee) : [];
 $periodes = getPeriodes();

 if (!isset($_SESSION['utilisateur'])) {
   header('Location: ./?action=connexion');
 }

if(isset($_POST['btn_submit'])){
  $pdo = connexionDatabase(); // Assurez-vous que cette fonction retourne bien un objet PDO

  // Récupérer les informations du client depuis $_POST
  $id_traversee = $_SESSION['traversee'];
  $type = $_POST['type'] ?? null; // Récupération du type si utilisé
  $idBateau = $_SESSION['bateauID'];
  $utilisateur = $_SESSION['utilisateur'];
  $utilisateur_id = $utilisateur[0]['id'];
  $nom = $utilisateur[0]['nom'];
  $prenom = $utilisateur[0]['prenom'];
  $email = $utilisateur[0]['email'];
  $tel = $utilisateur[0]['telephone'];
  
  $quantites = $_POST['quantite'] ?? []; // Quantités pour chaque type
  $tarifs = $_POST['tarif'] ?? [];      // Tarifs correspondants
  
  $prixTotal = 0;
  
  foreach ($quantites as $index => $quantite) {
      $tarif = $tarifs[$index] ?? null; // Associer chaque tarif à sa quantité
      if ($tarif !== null && is_numeric($quantite) && is_numeric($tarif)) {
          $prixTotal += $quantite * $tarif;
      }
  }
  
  
  $adulte = $quantites[0] ?? 0;
  $junior = $quantites[1] ?? 0;
  $enfant = $quantites[2] ?? 0;
  $voiture_4 = $quantites[3] ?? 0;
  $voiture_5 = $quantites[4] ?? 0;
  $fourgon = $quantites[5] ?? 0;
  $camping_car = $quantites[6] ?? 0;
  $camion = $quantites[7] ?? 0;
  
  // Vérifier que tous les champs nécessaires sont remplis
      try {
          // Requête d'insertion dans la table reservation
          $sqlReservation = "
          INSERT INTO reservation (adulte, junior, enfant, voiture_4, voiture_5, fourgon, camping_car, camion, prix_total, id_traversee, utilisateur_id)
          VALUES (:adulte, :junior, :enfant, :voiture_4, :voiture_5, :fourgon, :camping_car, :camion, :prix_total, :id_traversee, :utilisateur_id)";
          
          $stmtReservation = $pdo->prepare($sqlReservation);
          $stmtReservation->execute([            
              ':adulte' => $adulte,
              ':junior' => $junior,
              ':enfant' => $enfant,
              ':voiture_4' => $voiture_4,
              ':voiture_5' => $voiture_5,
              ':fourgon' => $fourgon,
              ':camping_car' => $camping_car,
              ':camion' => $camion,
              ':prix_total' => $prixTotal,
              ':id_traversee' => $id_traversee,
              'utilisateur_id' => $utilisateur_id
          ]);
      
          //echo "Réservation enregistrée avec succès !<br>";
  
          // Tableau associatif pour les catégories
          $categories = [
              'A' => [
                  'quantite' => $adulte + $junior + $enfant,
                  'label' => 'Adulte/Junior/Enfant'
              ],
              'B' => [
                  'quantite' => $voiture_4 + $voiture_5,
                  'label' => 'Voiture'
              ],
              'C' => [
                  'quantite' => $fourgon + $camping_car + $camion,
                  'label' => 'Véhicules lourds'
              ]
          ];
  
          // Parcourir les catégories et ajouter les occupants
          foreach ($categories as $categorie => $data) {
              if ($data['quantite'] > 0) {
                  // Appeler la fonction pour ajouter les occupants dans la zone correspondante
                  $result = ajouterOccupantsBateau($idBateau, $categorie, $data['quantite']);
                  echo $result; // Afficher le résultat de l'ajout des occupants
              }
          }
      } catch (PDOException $e) {
          echo "Erreur lors de l'enregistrement : " . $e->getMessage();
      }
      include "$racine/vue/recapReservation.php";

  } else{
    $places = afficherPlacesBateau($_SESSION['bateauID']);
    include "$racine/vue/reservation.php";
  }