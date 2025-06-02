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
                AND DATE(date_depart) = '$dateDepart'
       ");
      
            $query->execute();
    
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $traversees [] = [
                    'id' =>  $row['id_traversee'],
                    'dateDepart' =>  $row['date_depart'],
                    'dateArrive' =>  $row['date_arrive'],
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
                    'dateDepart' =>  $row['date_depart'],
                    'dateArrive' =>  $row['date_arrive'],
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

    function getTarifs($idLiaison, $idPeriode) {
        try {
            $pdo = connexionDatabase();
            $query = $pdo->prepare("
                SELECT 
                    t.tarif,
                    t.id_liaison,
                    t.id_periode,
                    t.id_type_passager,
                    t.id_type_vehicule,
                    tp.libelle AS libelle_passager,
                    tv.libelle AS libelle_vehicule,
                    c.libelle AS categorie
                FROM tarif t
                LEFT JOIN type_passager tp ON t.id_type_passager = tp.id
                LEFT JOIN type_vehicule tv ON t.id_type_vehicule = tv.id
                LEFT JOIN categorie c ON 
                    (tp.id_categorie = c.id OR tv.id_categorie = c.id)
                WHERE t.id_liaison = :idLiaison AND t.id_periode = :idPeriode
            ");
            $query->execute([
                'idLiaison' => $idLiaison,
                'idPeriode' => $idPeriode
            ]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des tarifs : " . $e->getMessage());
        }
    }
    
    function addReservation($prix, $id_traversee, $id_utilisateur) {
        try {
            $pdo = connexionDatabase();
            $query = $pdo->prepare("  
                INSERT INTO reservation (prix_total, id_traversee, id_utilisateur)
                VALUES (:prix_total, :id_traversee, :id_utilisateur)
            ");
    
            $query->execute([
                ':prix_total' => $prix,
                ':id_traversee' => $id_traversee,
                ':id_utilisateur' => $id_utilisateur
            ]);

            return $pdo->lastInsertId();
            
        } 
        catch (PDOException $e) {
            die("Une erreur s'est produite lors de l'insertion du client: " . $e->getMessage());
        }
    }

    function addPassager($id_reservation, $id_type_passager, $quantite) {
        try {
            $pdo = connexionDatabase();
            $query = $pdo->prepare("  
                INSERT INTO passager (id_reservation, id_type_passager, quantite)
                VALUES (:id_reservation, :id_type_passager, :quantite)
            ");
    
            $query->execute([
                ':id_reservation' => $id_reservation,
                ':id_type_passager' => $id_type_passager,
                ':quantite' => $quantite
            ]);
        } catch (PDOException $e) {
            die("Erreur insertion passager : " . $e->getMessage());
        }
    }
    
    function addVehicule($id_reservation, $id_type_vehicule, $quantite) {
        try {
            $pdo = connexionDatabase();
            $query = $pdo->prepare("  
                INSERT INTO vehicule (id_reservation, id_type_vehicule, quantite)
                VALUES (:id_reservation, :id_type_vehicule, :quantite)
            ");
    
            $query->execute([
                ':id_reservation' => $id_reservation,
                ':id_type_vehicule' => $id_type_vehicule,
                ':quantite' => $quantite
            ]);
        } catch (PDOException $e) {
            die("Erreur insertion véhicule : " . $e->getMessage());
        }
    }

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
                categorie.libelle
            FROM tarif
            JOIN categorie ON tarif.id_type_passager = categorie.id
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
        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $date);
        
        if ($dateTime) {
            return $dateTime->format('d/m/Y H:i');
        }

        $dateTime = DateTime::createFromFormat('Y-m-d', $date);
        
        return $dateTime ? $dateTime->format('d/m/Y') : null;
    }
    
    