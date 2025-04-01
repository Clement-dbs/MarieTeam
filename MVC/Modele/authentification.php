<?php

function connexionUtilisateur($email, $mdp){
    try {
     
        $pdo = connexionDatabase();

        $sql = "SELECT id, mdp FROM Utilisateur WHERE email = :email";
        $query = $pdo->prepare($sql);
        $query->bindParam(':email', $email);
        $query->execute();

        $utilisateur = $query->fetch(PDO::FETCH_ASSOC);

        if ($utilisateur != NULL) {
        
            if (password_verify($mdp, $utilisateur['mdp'])) {
                return $utilisateur['id'];
            } else {
                return "Identifiant ou mot de passe incorrect";
            }
        } else {
            return "Identifiant ou mot de passe incorrect";
        }

    } catch (PDOException $e) {
        echo "Erreur de connexion ou d'exécution : " . $e->getMessage();
    }
}


    function profilUtilisateur($idUtilisateur){
        if($idUtilisateur != NULL){

        try {

            $pdo = connexionDatabase();
            $sql = "SELECT * FROM utilisateur WHERE id = :id";
                    
            $query = $pdo->prepare($sql);

            $query->bindParam(':id', $idUtilisateur);

            $query->execute();

            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $profil [] = [
                    'id' =>  $row['id'],
                    'nom' =>  $row['nom'],
                    'prenom' =>  $row['prenom'],
                    'email' =>  $row['email'],
                    'mdp' =>  $row['mdp'],
                    'telephone' =>  $row['telephone']
                ];
            }

            if (!empty($profil)) {
                return $profil;
            } else {
                return "Erreur lors de la récupération des données utilisateurs";
            }
        } catch (PDOException $e) {
            echo "Erreur de connexion ou d'exécution : " . $e->getMessage();
        }
        }
    } 

    function modifierProfil($id, $email, $nom, $prenom, $mdp, $telephone) {
        try {
            $pdo = connexionDatabase();
            $sql = "UPDATE Utilisateur SET email = :email, nom = :nom, prenom = :prenom, mdp = :mdp, telephone = :telephone WHERE id = :id";
            $query = $pdo->prepare($sql);
            $query->bindParam(':id', $id);
            $query->bindParam(':email', $email);
            $query->bindParam(':nom', $nom);
            $query->bindParam(':prenom', $prenom);
            $query->bindParam(':mdp', $mdp);
            $query->bindParam(':telephone', $telephone);
    
            return $query->execute(); // Retourne true si la requête réussit
        } catch (PDOException $e) {
            return false;
        }
    }
    

?>