<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}
function adminNbUtilisateurs() {
    try {   
        $pdo = connexionDatabase();
        $query = $pdo->prepare("SELECT COUNT(*) AS total FROM utilisateur");
        $query->execute();        
        $result = $query->fetch(PDO::FETCH_ASSOC);

        echo$result['total'];
    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

function lastUser() {
    try {   
        $pdo = connexionDatabase();
        $query = $pdo->prepare("SELECT nom, prenom FROM utilisateur ORDER BY id DESC LIMIT 1");
        $query->execute();        
        $result = $query->fetch(PDO::FETCH_ASSOC);

        echo $result['prenom'] . ' ' . $result['nom'];
    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

function adminNbResa() {
    try {   
        $pdo = connexionDatabase();
        $query = $pdo->prepare("SELECT COUNT(*) AS total FROM reservation");
        $query->execute();        
        $result = $query->fetch(PDO::FETCH_ASSOC);

        echo$result['total'];
    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

function adminNbPeriode() {
    try {   
        $pdo = connexionDatabase();
        $query = $pdo->prepare("SELECT COUNT(*) AS total FROM periode");
        $query->execute();        
        $result = $query->fetch(PDO::FETCH_ASSOC);

        echo$result['total'];
    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

function adminNbTarif() {
    try {   
        $pdo = connexionDatabase();
        $query = $pdo->prepare("SELECT COUNT(*) AS total FROM tarif");
        $query->execute();        
        $result = $query->fetch(PDO::FETCH_ASSOC);

        echo$result['total'];
    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

function adminNbBateau() {
    try {   
        $pdo = connexionDatabase();
        $query = $pdo->prepare("SELECT COUNT(*) AS total FROM bateau");
        $query->execute();        
        $result = $query->fetch(PDO::FETCH_ASSOC);

        echo$result['total'];
    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

function adminCA() {
    try {   
        $pdo = connexionDatabase();
        $query = $pdo->prepare("SELECT SUM(prix_total) AS total FROM reservation");
        $query->execute();        
        $result = $query->fetch(PDO::FETCH_ASSOC);

        echo$result['total'];
    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

include "$racine/Vue/dashboard.php";
?>