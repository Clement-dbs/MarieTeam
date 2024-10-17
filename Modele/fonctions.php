<?php

include_once "connexion_db.php";

    function getSecteurs(){
        try {

            $pdo = connexionDatabase();
            $query = $pdo->prepare("
                SELECT nomSecteur
                FROM secteur 
                ORDER BY nomSecteur ASC
            ");
    
            $query->execute();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $secteur [] = $row['nomSecteur'];
            }

            return $secteur;
        } 
        
        catch (PDOException $e) {
            die("Une erreur s'est produite lors de la récupération des secteurs : " . $e->getMessage());
        }
       
    } 

    function getLiaisons($secteur){
        try {

            $pdo = connexionDatabase();
            $query = $pdo->prepare("
                SELECT PortDepart, PortArrive, CodeLiaison
                FROM liaison 
                WHERE nomSecteur = '$secteur'
            ");
          
            $query->execute();
    
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $liaisons[] = [
                    'PortDepart' => $row['PortDepart'],
                    'PortArrive' => $row['PortArrive'],
                    'CodeLiaison' => $row['CodeLiaison']
                 ];
                  }
                
                  if(empty($liaisons)){
                    die("Aucune destination n'est proposée pour ce secteur");
                  }
                return $liaisons;
        } 

        catch (PDOException $e) {
            die("Une erreur s'est produite lors de la récupération des liaisons : " . $e->getMessage());
        }
    }

    function getTraversees($codeLiaison){
        try {

            $pdo = connexionDatabase();
            $query = $pdo->prepare("
                SELECT  Heure, Bateau, Places_A_Passager, Places_B_Veh_inf_2m, Place_C_Veh_sup_2m, traversees.CodeLiaison AS TraverseeCodeLiaison, liaison.CodeLiaison AS LiaisonCodeLiaison
                FROM traversees, liaison
                WHERE liaison.CodeLiaison = traversees.CodeLiaison AND liaison.CodeLiaison = '$codeLiaison'
            ");
      
            $query->execute();
    
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $traversees [] = [
                    'CodeLiaison' =>  $row['TraverseeCodeLiaison'],
                    'Heure' => $row['Heure'],
                    'Bateau' =>  $row['Bateau'],
                    'Places_A_Passager' => $row['Places_A_Passager'],
                    'Places_B_Veh_inf_2m' => $row['Places_B_Veh_inf_2m'],
                    'Place_C_Veh_sup_2m' =>  $row['Place_C_Veh_sup_2m']      
                ];
                  }

                  if(empty($traversees)){
                    die("Aucune traversée n'est proposée pour cette liaison");
                  }

                return $traversees;

        }  
        
        catch (PDOException $e) {
            die("Une erreur s'est produite lors de la récupération des traversees : " . $e->getMessage());
        }
    }

    function getTarif(){
        try {
            $pdo = connexionDatabase();
            $query = $pdo->prepare("
                SELECT TypeTarif, Categorie, tarif
                FROM tarif
            ");
      
            $query->execute();
    
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $tarifs [] = [
                    'TypeTarif' => $row['TypeTarif'],
                    'Tarif' => $row['tarif'],
                    'Categorie' => $row['Categorie']
                ];
                  }
    
                return $tarifs;
        } 
        catch (PDOException $e) {
            die("Une erreur s'est produite lors de la récupération des tarifs : " . $e->getMessage());
        }
    }
    
    function addClient($nom, $adresse, $codePostal, $ville) {
        try {
            $pdo = connexionDatabase();
            $query = $pdo->prepare("  
                INSERT INTO client (Nom, Adresse, CodePostal, Ville)
                VALUES (:nom, :adresse, :codePostal, :ville)
            ");
    
            $query->execute([
                ':nom' => $nom,
                ':adresse' => $adresse,
                ':codePostal' => $codePostal,
                ':ville' => $ville
            ]);
            
            $idClient = $pdo->lastInsertId(); // Récupérer l'ID du client ajouté
            echo "Le client a bien été ajouté avec l'ID : " . $idClient; // Debug
            return $idClient; // Retourne l'ID du client ajouté
        } 
        catch (PDOException $e) {
            die("Une erreur s'est produite lors de l'insertion du client: " . $e->getMessage());
        }
    }

    function addReservation($nbAdulte, $nbJunior, $nbEnfant, $nbVoiture, $nbFourgon, $nbCampingCar, $nbCamion, $idClient) {
        try {
            $pdo = connexionDatabase();
            $query = $pdo->prepare("  
                INSERT INTO reservation (idClient, Adultes, Junior, Enfant, Voiture, Fourgon, CampingCar, Camion)
                VALUES (:idClient, :nbAdulte, :nbJunior, :nbEnfant, :nbVoiture, :nbFourgon, :nbCampingCar, :nbCamion)
            ");
    
            $query->execute([
                ':idClient' => $idClient,
                ':nbAdulte' => $nbAdulte,
                ':nbJunior' => $nbJunior,
                ':nbEnfant' => $nbEnfant,
                ':nbVoiture' => $nbVoiture,
                ':nbFourgon' => $nbFourgon,
                ':nbCampingCar' => $nbCampingCar,
                ':nbCamion' => $nbCamion,
            ]);

            $lastId = $pdo->lastInsertId();
    
            echo "Réservation ajoutée avec succès.";
        } 
        catch (PDOException $e) {
            die("Une erreur s'est produite lors de l'insertion de la réservation: " . $e->getMessage());
        }
    }

?>