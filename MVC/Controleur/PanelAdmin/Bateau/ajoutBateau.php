<?php
if (!isset($_SESSION['utilisateur']) || getAdminLevel() < 1) {
    header("Location: ./?action=defaut");
    exit("Accès interdit.");
}
if (isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $longueur = htmlspecialchars($_POST['longueur']);
    $largeur = htmlspecialchars($_POST['largeur']);
    $placeA = floatval($_POST['placeA']);
    $placeB = floatval($_POST['placeB']);
    $placeC = floatval($_POST['placeC']);

        try {

            $pdo = connexionDatabase();

            // Requête d'insertion
            $query = $pdo->prepare("INSERT INTO bateau (nom, longueur, largeur, A_Max, B_Max, C_Max) VALUES (:nom, :longueur, :largeur, :placeA, :placeB, :placeC)");
            $query->bindParam(':nom', $nom);
            $query->bindParam(':longueur', $longueur);
            $query->bindParam(':largeur', $largeur);
            $query->bindParam(':placeA', $placeA);
            $query->bindParam(':placeB', $placeB);
            $query->bindParam(':placeC', $placeC);

            if ($query->execute()) {
                // Redirection ou message de succès
                header('Location: ./?action=bateau');
                exit;
            } else {
                echo "Une erreur est survenue lors de l'ajout du bateau.";
            }
            include "$racine/vue/ajoutBateau.php";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
}
include "$racine/vue/ajoutBateau.php";
?>
