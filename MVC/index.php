
<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/output.css"> <!-- npx tailwindcss -i ./CSS/input.css -o ./CSS/output.css --watch -->
    <link rel="icon" href="../Assets/Images/logo.png" />
    <title>MarieTeam</title>
</head>

<body>
    
    <?php
        include_once "racine.php";
        include_once "routes.php";
        include_once "session.php";
        include_once "$racine/Modele/function.php";
        include 'Vue/header.php';
      
        if (isset($_GET["action"])) {
            $action = $_GET["action"];
        } 
        else {
            $action = "defaut";
        }
        
        $fichier = routes($action);
        include "$racine/Controleur/$fichier";
    ?>

</body>

</html>