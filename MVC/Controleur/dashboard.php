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

        echo $result['nom'] . ' ' . $result['prenom'];
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
        $query = $pdo->prepare("SELECT COUNT(*) AS total FROM tarifer");
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

include "$racine/vue/dashboard.php";
?>