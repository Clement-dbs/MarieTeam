<?php

include_once "connexion_db.php";

    function getSecteurs(){
        try {
           
            $pdo = connexionDatabase();
            $query = $pdo->prepare("
                SELECT *
                FROM secteur 
            ");
    
            $query->execute();
            $secteurs = [];
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $secteurs[] = [
                    'id' => $row['id'],
                    'nom' => $row['nom']
                ];
            }
    
            return $secteurs;
        } 
        
        catch (PDOException $e) {
            die("Une erreur s'est produite lors de la récupération des secteurs : " . $e->getMessage());
        }
       
    } 

   function getLiaisons($secteur){
        try {

            $pdo = connexionDatabase();
            $query = $pdo->prepare("
                SELECT l.id AS id_liaison, p1.nom AS port_depart_nom, p2.nom AS port_arrive_nom
                FROM liaison l
                INNER JOIN port p1 ON l.port_depart = p1.id
                INNER JOIN port p2 ON l.port_arrive = p2.id
                WHERE l.id_secteur = :secteur
                ORDER BY p1.nom ASC, p2.nom ASC
            ");
          
            $query->execute(['secteur' => $secteur]);
    
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $liaisons[] = [
                    'PortDepart' => $row['port_depart_nom'],
                    'PortArrivee' => $row['port_arrive_nom'],
                    'id_liaison' => $row['id_liaison']
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

    function getTraversees($id_liaison, $dateDepart){
        try {

            $pdo = connexionDatabase();
            $query = $pdo->prepare("
                SELECT *
                FROM vue_traversee
                WHERE id_liaison = '$id_liaison'
                AND DATE(depart) = '$dateDepart'
       ");
      
            $query->execute();
    
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $traversees [] = [
                    'id' =>  $row['id_traversee'],
                    'depart' =>  $row['depart'],
                    'arrive' =>  $row['arrive'],
                    'id_liaison' => $row['id_liaison'],
                    'id_bateau' =>  $row['id_bateau'],
                    'Place Passager' =>  $row['places_passager_restantes'],
                    'Placer Véhicule Léger' =>  $row['places_vehicule_leger_restantes'],
                    'Place Véhicule Lourd' =>  $row['places_vehicule_lourd_restantes'],
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
            SELECT *
            FROM vue_traversee
            WHERE id_traversee = '$id';
       ");
      
            $query->execute();
    
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $traversees [] = [
                   'id' =>  $row['id_traversee'],
                    'depart' =>  $row['depart'],
                    'arrive' =>  $row['arrive'],
                    'id_liaison' => $row['id_liaison'],
                    'id_bateau' =>  $row['id_bateau'],
                    'Place Passager' =>  $row['places_passager_restantes'],
                    'Place Véhicule Léger' =>  $row['places_vehicule_leger_restantes'],
                    'Place Véhicule Lourd' =>  $row['places_vehicule_lourd_restantes'],
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

    function getTypeVoyageurs(){
        try{

        $pdo = connexionDatabase();
        
            // On récupère les type de passagers
            $query = $pdo->prepare("
                SELECT *
                FROM type_passager
            ");
      
            $query->execute();
    
            $typeVoyageur = [];
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $typeVoyageur [] = [
                    'id' => $row['id'],
                    'libelle' => $row['libelle'],
                    'categorie' => $row['id_categorie'],
                ];
                  }

            // On récupère les type de véhicules
                  $query = $pdo->prepare("
                  SELECT *
                  FROM type_vehicule
              ");
        
              $query->execute();
      
              while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                  $typeVoyageur [] = [
                      'id' => $row['id'],
                      'libelle' => $row['libelle'],
                      'categorie' => $row['id_categorie']
                  ];
                    }
    
                return $typeVoyageur;
        } 
        catch (PDOException $e) {
            die("Une erreur s'est produite lors de la récupération des tarifs : " . $e->getMessage());
        }
    
    }

    function getPlacesRestantesBateau($idTraversee){
        try {
            $pdo = connexionDatabase();
    
            $query = $pdo->prepare("
                SELECT 
                    vt.id_traversee,
                    b.id AS id_bateau,
                    b.place_passager_max - COALESCE(SUM(CASE WHEN c.libelle = 'A' THEN p.quantite ELSE 0 END), 0) AS places_passager_restantes,
                    b.place_vehicule_leger_max - COALESCE(SUM(CASE WHEN c.libelle = 'B' THEN v.quantite ELSE 0 END), 0) AS places_vehicule_leger_restantes,
                    b.place_vehicule_lourd_max - COALESCE(SUM(CASE WHEN c.libelle = 'C' THEN v.quantite ELSE 0 END), 0) AS places_vehicule_lourd_restantes
                FROM vue_traversee vt
                JOIN bateau b ON vt.id_bateau = b.id
                LEFT JOIN reservation r ON r.id_traversee = vt.id_traversee
                LEFT JOIN passager p ON p.id_reservation = r.id
                LEFT JOIN type_passager tp ON p.id_type_passager = tp.id
                LEFT JOIN vehicule v ON v.id_reservation = r.id
                LEFT JOIN type_vehicule tv ON v.id_type_vehicule = tv.id
                LEFT JOIN categorie c ON c.id = COALESCE(tp.id_categorie, tv.id_categorie)
                WHERE vt.id_traversee = :id
                GROUP BY 
                    vt.id_traversee, b.id, 
                    b.place_passager_max, 
                    b.place_vehicule_leger_max, 
                    b.place_vehicule_lourd_max
            ");
    
            $query->bindParam(':id', $idTraversee, PDO::PARAM_INT);
            $query->execute();
    
            $result = $query->fetch(PDO::FETCH_ASSOC);
    
            if (!$result) {
                return "";
            }
    
            return [
                'id' => $result['id_traversee'],
                'id_bateau' => $result['id_bateau'],
                'Place Passager' => $result['places_passager_restantes'],
                'Place Véhicule Léger' => $result['places_vehicule_leger_restantes'],
                'Place Véhicule Lourd' => $result['places_vehicule_lourd_restantes'],
            ];
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des places restantes : " . $e->getMessage());
        }
    }

    function getTarif(){
        try {
            $pdo = connexionDatabase();
            $query = $pdo->prepare("
                SELECT *
                FROM tarif
            ");
      
            $query->execute();
    
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $tarifs [] = [
                    'id' => $row['id'],
                    'id_liaison' => $row['id_liaison'],
                    'id_periode' => $row['id_periode'],
                    'tarif' => $row['tarif']
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

    

    /*function getPeriodes() {
        try {
            $pdo = connexionDatabase();
            $query = $pdo->prepare("
            SELECT id_periode 
            FROM tarif 
            ORDER BY id_periode
            ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des periodes : " . $e->getMessage());
        }
    }*/

    /*function getTarifsByPeriode($periodeSelectionnee) {

        if (isset($_SESSION['idPeriode'])) {
            $idPeriode = $_SESSION['idPeriode'];
            try {
                $pdo = connexionDatabase();
    
                // Récupérer les informations de la periode
                $query = $pdo->prepare("SELECT dateDebut, dateFin FROM periode WHERE id = :id");
                $query->bindParam(':id', $idPeriode, PDO::PARAM_INT);
                $query->execute();
                $periodeData = $query->fetch(PDO::FETCH_ASSOC);
                if ($periodeData) {
                    $periode1D = $periodeData['dateDebut'];
                    $periode1F = $periodeData['dateFin'];
    
                    if ($periodeSelectionnee >= $periode1D && $periodeSelectionnee <= $periode1F) {
                        // Récupérer les tarifs
                        $query = $pdo->prepare("
                            SELECT id_periode, id_type, tarif
                            FROM tarif
                            WHERE id_periode = :periode
                        ");
                        $query->bindParam(':periode', $idPeriode, PDO::PARAM_INT);
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
                                'periode' => $row['id_periode'] ?? null,
                                'type' => isset($row['id_type']) ? ($labels[$row['id_type']] ?? 'Non défini') : 'Non défini',
                                'liaison' => $row['id_liaison'] ?? 'Non défini',
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
    }*/

    function getTarifsByPeriode($date){
    try {
        $pdo = connexionDatabase();

        $stmtPeriode = $pdo->prepare("
            SELECT id
            FROM periode
            WHERE :date BETWEEN dateDebut AND dateFin
        ");
        $stmtPeriode->bindParam(':date', $date);
        $stmtPeriode->execute();

        $periode = $stmtPeriode->fetch(PDO::FETCH_ASSOC);
        if (!$periode) {
            throw new Exception("Aucune période trouvée pour cette date.");
        }

        $idPeriode = $periode['id'];

        // Récupérer tous les tarifs pour cette période, avec le nom de catégorie
        $stmtTarifs = $pdo->prepare("
            SELECT 
                tarif.id_liaison,
                tarif.tarif,
                categorie.lettre AS categorie_lettre
            FROM tarif
            JOIN categorie ON tarif.id_categorie = categorie.id
            WHERE tarif.id_periode = :id_periode
        ");
        $stmtTarifs->bindParam(':id_periode', $idPeriode, PDO::PARAM_INT);
        $stmtTarifs->execute();

        $tarifs = $stmtTarifs->fetchAll(PDO::FETCH_ASSOC);

        return $tarifs;

    } catch (PDOException $e) {
        die("Erreur de base de données : " . $e->getMessage());
    } catch (Exception $e) {
        die("Erreur : " . $e->getMessage());
    }
}


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
        
            $query = $pdo->prepare("SELECT id FROM periode WHERE :dateDepart BETWEEN dateDebut AND dateFin LIMIT 1");
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
            SELECT * 
            FROM periode
            ORDER BY dateDebut ASC;
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
            FROM vue_liaisons
            ");
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
    
        } catch (PDOException $e) {
            die("Une erreur s'est produite : " . $e->getMessage());
        }
    }

    function formatDate($date) {
        $dateTime = DateTime::createFromFormat('Y-m-d', $date);
        return $dateTime ? $dateTime->format('d/m/Y') : null;
    }
    