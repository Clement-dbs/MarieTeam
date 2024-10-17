<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/font.css">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>MarieTeam</title>
</head>
<body>

<?php  
    include_once "../Controleur/session.php";
    include '../Vue/includes/header.php';
    include '../Vue/includes/side_bar.php';
?>

<div class="contenuPrincipale">
    <?php
        include '../Vue/includes/selectLiaison.php';
        include '../Vue/includes/afficheTraversees.php';
    ?>
</div>

<?php
    include '../Vue/includes/footer.php';
?>


    
</body>

</html>