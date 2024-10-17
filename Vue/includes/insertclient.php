<?php
    require_once "../../Modele/fonctions.php";
    include "../../Controleur/session.php";
    

    // Récupérer les informations du client
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $codePostale = $_POST['codePostale'];
    $ville = $_POST['ville'];

    // Insertion du client et récupération de l'ID
    $idClient = addClient($nom,$adresse,$codePostale,$ville);

    if ($idClient) {
        echo "ID Client : " . $idClient; // Affiche l'ID client
    } else {
        echo "Aucun ID client récupéré.";
    }

    // Créer la connexion PDO
    $pdo = connexionDatabase();

   
    // Multiplie la quantité par le tarif associé
    $quantites = $_POST['quantite'];
    $tarifs = getTarif();
    
    // Récupérer le prix total
    foreach ($tarifs as $index => $tarif) {
        $quantite = $quantites[$index]; 
        $prix = $tarif['Tarif']; 
        $total = $prix * $quantite; 
    
    }


        var_dump($quantites);
        $totalGlobal = 0;
        
        foreach ($quantites as $index => $quantite) {
            $tarif = $tarifs[$index]['Tarif'];
            $total = $tarif * $quantite;
            echo "Ligne " . ($index+1) . " - Quantité: $quantite, Tarif: $tarif, Total: $total €<br>";
            $totalGlobal += $total;
        }
        
        echo "Total global de la commande : $totalGlobal €";

    // Initialiser toutes les variables à zéro
    $Adultes = $Junior = $Enfant = $Voiture = $Fourgon = $CampingCar = $Camion = 0;
    $TarifTotal = 0;

    // Traiter les quantités et calculer le tarif total
    echo "<pre>";
print_r($tarifs);
echo "</pre>";

    foreach ($quantites as $index => $quantite) {
        if ($quantite > 0) {
            $typeTarif = $tarifs[$index]['Categorie'];
            $tarif = doubleval($tarifs[$index]['Tarif']);

                echo "Type de tarif pour l'index $index : $typeTarif<br>";
            switch ($tarifs[$index]['Categorie']) {
                case 'A1':
                    $Adultes += $quantite;
                    $TarifTotal += $quantite * doubleval($tarifs[$index]['Tarif']);
                    break;
                case 'A2':
                    $Junior += $quantite;
                    $TarifTotal += $quantite * doubleval($tarifs[$index]['Tarif']);
                    break;
                case 'A3':
                    $Enfant += $quantite;
                    $TarifTotal += $quantite * doubleval($tarifs[$index]['Tarif']);
                    break;
                case 'B1':
                    $Voiture += $quantite;
                    $TarifTotal += $quantite * doubleval($tarifs[$index]['Tarif']);
                    break;
                case 'C1':
                    $Fourgon += $quantite;
                    $TarifTotal += $quantite * doubleval($tarifs[$index]['Tarif']);
                    break;
                case 'C2':
                    $CampingCar += $quantite;
                    $TarifTotal += $quantite * doubleval($tarifs[$index]['Tarif']);
                    break;
                case 'C3':
                    $Camion += $quantite;
                    $TarifTotal += $quantite * doubleval($tarifs[$index]['Tarif']);
                    break;
                default:
                    echo "Type de tarif non reconnu : $typeTarif<br>";
                }
            }
        }

    // Debug : Affiche les totaux
    echo "Détails de la réservation :<br>";
    echo "Adultes : $Adultes, Junior : $Junior, Enfant : $Enfant, Voiture : $Voiture, Fourgon : $Fourgon, CampingCar : $CampingCar, Camion : $Camion<br>";
    echo "Tarif Total : $TarifTotal<br>";

    // Préparation de la requête d'insertion pour les réservations
    $sqlReservation = "
    INSERT INTO reservation (idClient, Adultes, Junior, Enfant, Voiture, Fourgon, CampingCar, Camion, TarifTotal) 
    VALUES (:idClient, :Adultes, :Junior, :Enfant, :Voiture, :Fourgon, :CampingCar, :Camion, :TarifTotal)";
    
    $stmtReservation = $pdo->prepare($sqlReservation);

    
    $stmtReservation->execute([
        ':idClient' => $idClient,
        ':Adultes' => $Adultes,
        ':Junior' => $Junior,
        ':Enfant' => $Enfant,
        ':Voiture' => $Voiture,
        ':Fourgon' => $Fourgon,
        ':CampingCar' => $CampingCar,
        ':Camion' => $Camion,
        ':TarifTotal' => $TarifTotal,
    ]);

    echo "Réservation enregistrée avec succès !";
                
?>
