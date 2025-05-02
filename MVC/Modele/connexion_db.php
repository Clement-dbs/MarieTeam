<?php

    function connexionDatabase() {
        $login = "root";
        $mdp = "";
        $bd = "marieteamwebcorrection";
        $serveur = "localhost";

        try {
            return new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp);
        } catch (PDOException $e) {
            die("Erreur de connexion PDO : " . $e->getMessage());
        }
}
?>
