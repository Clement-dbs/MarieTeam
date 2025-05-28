<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}
function afficherPorts() {
    try {
        $pdo = connexionDatabase();
        $query = $pdo->prepare("
        SELECT *
        FROM vue_ports
        ");
        $query->execute();
        $ports = $query->fetchAll(PDO::FETCH_ASSOC);
        return $ports;

    } catch (PDOException $e) {
        die("Une erreur s'est produite : " . $e->getMessage());
    }
}

$ports = afficherPorts();
include "$racine/Vue/panelPort.php";