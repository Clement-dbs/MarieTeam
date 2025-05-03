<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}
// Récupérer la liste des utilisateurs en fonction du niveau d'accès
try {
    $pdo = connexionDatabase();
    $query = $pdo->prepare("SELECT id, nom, prenom, email, telephone, isAdmin FROM utilisateur ORDER BY isAdmin DESC, nom ASC");
    $query->execute();
    $utilisateurs = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération des utilisateurs : " . $e->getMessage());
}

include "$racine/Vue/gestionUtilisateurs.php";
