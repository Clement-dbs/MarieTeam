<?php

include_once "connexion_db.php";

    function getSecteurs(){
        try {
           
            $pdo = connexionDatabase();
            $query = $pdo->prepare("
                SELECT nom
                FROM secteur 
                ORDER BY nom ASC
            ");
    
            $query->execute();
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $secteur [] = $row['nom'];
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
                SELECT *
                FROM liaison
                JOIN secteur ON liaison.secteur = secteur.id
                WHERE secteur.nom = '$secteur'
            ");
          
            $query->execute();
    
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $liaisons[] = [
                    'PortDepart' => $row['port_depart'],
                    'PortArrivee' => $row['port_arrivee'],
                    'CodeLiaison' => $row['code']
                 ];
                  }
                
                if(empty($liaisons)){
                    return "";
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
            SELECT Traversee.id, Traversee.codeLiaison, Traversee.heureDepart,Traversee.heureArrivee, Traversee.jour, Traversee.bateau, Bateau.nom, Bateau.A, Bateau.B, Bateau.C, Liaison.port_depart, Liaison.port_arrivee 
            FROM Traversee 
            JOIN Liaison ON Traversee.codeLiaison = Liaison.code 
            JOIN Bateau ON Traversee.bateau = Bateau.id 
            WHERE Traversee.codeLiaison = '$codeLiaison';
       ");
      
            $query->execute();
    
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $traversees [] = [
                    'Id' =>  $row['id'],
                    'CodeLiaison' =>  $row['codeLiaison'],
                    'Depart' =>  $row['port_depart'],
                    'Arrivee' =>  $row['port_arrivee'],
                    'HeureDepart' => $row['heureDepart'],
                    'HeureArrivee' => $row['heureArrivee'],
                    'Jour' => $row['jour'],
                    'Bateau' =>  $row['nom'],   
                    'A Passager' => $row['A'],
                    'B Véh.inf.2m' => $row['B'],
                    'C Véh.sup.2m' =>  $row['C']  
                ];
                  }

                  if(empty($traversees)){
                    return $traversees [] = [];
                  } else{
                    return $traversees;
                  }
        }  
        
        catch (PDOException $e) {
            die("Une erreur s'est produite lors de la récupération des traversees : " . $e->getMessage());
        }
    }

    function getTraverseesById($id){
        try {
            $pdo = connexionDatabase();
            $query = $pdo->prepare("
            SELECT Traversee.id, Traversee.codeLiaison, Traversee.heureDepart, Traversee.heureArrivee , Traversee.jour, Traversee.bateau, Bateau.nom, Bateau.A, Bateau.B, Bateau.C, Liaison.port_depart, Liaison.port_arrivee 
            FROM Traversee 
            JOIN Liaison ON Traversee.codeLiaison = Liaison.code 
            JOIN Bateau ON Traversee.bateau = Bateau.id 
            WHERE Traversee.id = '$id';
       ");
      
            $query->execute();
    
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $traversees [] = [
                    'Id' =>  $row['id'],
                    'CodeLiaison' =>  $row['codeLiaison'],
                    'Depart' =>  $row['port_depart'],
                    'Arrivee' =>  $row['port_arrivee'],
                    'HeureDepart' => $row['heureDepart'],
                    'HeureArrivee' => $row['heureArrivee'],
                    'Jour' => $row['jour'],
                    'bateauID' =>  $row['bateau'],
                    'Bateau' =>  $row['nom'],   
                    'A Passager' => $row['A'],
                    'B Véh.inf.2m' => $row['B'],
                    'C Véh.sup.2m' =>  $row['C']  
                ];
                  }

                  if(empty($traversees)){
                    return "";
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

    /* import Bastien */

    function ajouterOccupant() {
        try {
            $pdo = connexionDatabase();

            $query = $pdo->prepare("UPDATE Bateau SET $categorie = ? WHERE lettre = ?");
            $query->bindParam(':lettre_bateau', $lettre_bateau, PDO::PARAM_STR);
            $query->execute();

        } catch (PDOException $e) {
            die("Une erreur s'est produite : " . $e->getMessage());
        }

    }

    function getPeriodes() {
        try {
            $pdo = connexionDatabase();
            $query = $pdo->prepare("
            SELECT DISTINCT debut 
            FROM tarifer 
            ORDER BY debut
            ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des periodes : " . $e->getMessage());
        }
    }

    function getTarifsByPeriode($periodeSelectionnee) {
        if (isset($_SESSION['idPeriode'])) {
            $idPeriode = $_SESSION['idPeriode'];
            try {
                $pdo = connexionDatabase();
    
                // Récupérer les informations de la periode
                $query = $pdo->prepare("SELECT debut, fin FROM periode WHERE id = :id");
                $query->bindParam(':id', $idPeriode, PDO::PARAM_INT);
                $query->execute();
                $periodeData = $query->fetch(PDO::FETCH_ASSOC);
                if ($periodeData) {
                    $periode1D = $periodeData['debut'];
                    $periode1F = $periodeData['fin'];
    
                    if ($periodeSelectionnee >= $periode1D && $periodeSelectionnee <= $periode1F) {
                        // Récupérer les tarifs
                        $query = $pdo->prepare("
                            SELECT debut, num, code, tarif
                            FROM tarifer
                            WHERE debut = :periode
                        ");
                        $query->bindParam(':periode', $periode1D, PDO::PARAM_STR);
                        $query->execute();
    
                        $labels = [
                            1 => 'Adulte',
                            2 => 'Junior 8-18 ans',
                            3 => 'Enfant 0-7 ans',
                            4 => 'Voiture longueur < 4m',
                            5 => 'Voiture longueur < 5m',
                            6 => 'Fourgon',
                            7 => 'Camping Car',
                            8 => 'Camion'
                        ];
    
                        $tarifs = [];
    
                        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            $tarifs[] = [
                                'debut' => $row['debut'] ?? null,
                                'num' => isset($row['num']) ? ($labels[$row['num']] ?? $row['num']) : 'Non défini',
                                'code' => $row['code'] ?? 'Non défini',
                                'tarif' => $row['tarif'] ?? 0.00
                            ];
                        }
                        return $tarifs;
                    } else {
                        echo "periode sélectionnée non valide.";
                    }
                } else {
                    echo "Aucune periode trouvée pour cet ID.";
                }
            } catch (PDOException $e) {
                die("Une erreur s'est produite lors de la récupération des tarifs : " . $e->getMessage());
            }
        } else {
            echo "Aucune periode sélectionnée.";
        }
    
        return [];
    }

    function ajouterOccupantsBateau($bateau_id, $zone, $occupants) {
        try {
        $pdo = connexionDatabase();
        // Définir la colonne et la capacité maximale en fonction de la zone
        switch ($zone) {
            case 'A':
                $colonneOccupants = 'A';
                $colonneMax = 'A_Max';
                break;
            case 'B':
                $colonneOccupants = 'B';
                $colonneMax = 'B_Max';
                break;
            case 'C':
                $colonneOccupants = 'C';
                $colonneMax = 'C_Max';
                break;
            default:
                return "Zone invalide"; // Si la zone n'est pas A, B ou C
        }

        // Requête pour obtenir le nombre d'occupants actuels et la capacité maximale
        $query = $pdo->prepare("SELECT $colonneOccupants, $colonneMax FROM bateau WHERE id = ?");
        $query->execute([$bateau_id]); // Bindage des paramètres avec PDO

        $result = $query->fetch(PDO::FETCH_ASSOC);
        
        if (!$result) {
            return "Bateau introuvable";
        }

        // Extraire les résultats
        $currentOccupants = $result[$colonneOccupants];
        $maxOccupants = $result[$colonneMax];

        // Vérifier si l'ajout des occupants dépasse la capacité maximale
        if ($currentOccupants + $occupants > $maxOccupants) {
            return "Capacité maximale dépassée pour la catégorie ".$colonneOccupants."<br>";
        }

        // Ajouter les occupants dans la zone
        $queryUpdate = $pdo->prepare("UPDATE bateau SET $colonneOccupants = $colonneOccupants + ? WHERE id = ?");
        $queryUpdate->execute([$occupants, $bateau_id]); // Bindage des paramètres avec PDO

        // Vérifier si la mise à jour a réussi
        if ($queryUpdate->rowCount() > 0) {
            //return "Occupants ajoutés avec succèspour la catégorie ".$colonneOccupants."<br>";
        } else {
            return "Erreur lors de l'ajout des occupants.";
        }

    } catch (PDOException $e) {
        die("Une erreur s'est produite lors de l'ajout des occupants : " . $e->getMessage());
    }
}

function afficherPlacesBateau($bateau_id) {
    try {
    $pdo = connexionDatabase();

    $query = $pdo->prepare("SELECT nom, A, B, C, A_Max, B_Max, C_Max FROM Bateau WHERE id = :id");
    $query->bindParam(':id', $bateau_id, PDO::PARAM_INT);
    $query->execute();

    if ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $nomBateau = $row['nom'];
        $placesA = $row['A_Max'] - $row['A'];
        $placesB = $row['B_Max'] - $row['B'];
        $placesC = $row['C_Max'] - $row['C'];
        
        return [
            'nomBateau' => $nomBateau,
            'placesA' => $placesA,
            'placesB' => $placesB,
            'placesC' => $placesC
        ];
}
} catch (PDOException $e) {
    die("Une erreur s'est produite : " . $e->getMessage());
}
}

    function getIdPeriodeByDateDepart($dateDepart) {
        try {
            $pdo = connexionDatabase();
        
            $query = $pdo->prepare("SELECT id FROM periode WHERE :dateDepart BETWEEN debut AND fin LIMIT 1");
            $query->bindParam(':dateDepart', $dateDepart, PDO::PARAM_STR);
            $query->execute();
        
            $result = $query->fetch(PDO::FETCH_ASSOC);
        
            if ($result) {
                return $result['id'];
            } else {
                return null; 
            }
        } catch (PDOException $e) {
            die("Une erreur s'est produite : " . $e->getMessage());
        }
    }

    function getAdminLevel() {
        if (isset($_SESSION['utilisateur'][0]['id'])) {
            try {
                $pdo = connexionDatabase();
    
                $query = $pdo->prepare("SELECT isAdmin FROM utilisateur WHERE id = :userId");
                $query->bindParam(':userId', $_SESSION['utilisateur'][0]['id'], PDO::PARAM_INT);
                $query->execute();
    
                $adminLevel = $query->fetchColumn();
    
                return $adminLevel !== false ? $adminLevel : null;
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
                return null;
            }
        } else {
            // Si l'utilisateur n'est pas connecté ou que l'ID utilisateur est manquant
            return null;
        }
    }

    function recupererPeriodes() {
        try {
            $pdo = connexionDatabase();
            $query = $pdo->prepare("
            SELECT DISTINCT debut 
            FROM tarifer
            ORDER BY debut ASC;
            ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
    
        } catch (PDOException $e) {
            die("Une erreur s'est produite : " . $e->getMessage());
        }
    }

    function recupererLiaisons() {
        try {
            $pdo = connexionDatabase();
            $query = $pdo->prepare("
            SELECT * 
            FROM liaison
            ORDER BY code ASC;
            ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
    
        } catch (PDOException $e) {
            die("Une erreur s'est produite : " . $e->getMessage());
        }
    }