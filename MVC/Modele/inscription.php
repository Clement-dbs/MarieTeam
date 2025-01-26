<?php
function inscriptionUtilisateur($nom, $prenom, $email, $mdp, $telephone){
    try {
        $pdo = connexionDatabase();
        $mdpCrypte = password_hash($mdp, PASSWORD_BCRYPT);

        $sql = "INSERT INTO Utilisateur (nom, prenom, email, mdp, telephone) 
                VALUES (:nom, :prenom, :email, :mdp, :telephone)";
                
        $query = $pdo->prepare($sql);

        $query->bindParam(':nom', $nom);
        $query->bindParam(':prenom', $prenom);
        $query->bindParam(':email', $email);
        $query->bindParam(':mdp', $mdpCrypte);  
        $query->bindParam(':telephone', $telephone);

        if ($query->execute()) {
            echo "Données insérées avec succès.";
        } else {
            echo "Erreur lors de l'insertion des données.";
        }
    } catch (PDOException $e) {
        echo "Erreur de connexion ou d'exécution : " . $e->getMessage();
    }
}


?>