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
            return $pdo->lastInsertId(); // Retourne l'ID de l'utilisateur inscrit
        } else {
            return false;
        }
    } catch (PDOException $e) {
        return false;
    }
}
?>
