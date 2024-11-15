
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/output.css"> <!-- npx tailwindcss -i ./CSS/input.css -o ./CSS/output.css --watch -->
    <link rel="icon" href="../Assets/Images/logo.png" />
    <title>MarieTeam</title>
</head>

<body>
    <?php
        include_once "Modele/session.php";
        include_once "Modele/function.php";
        include 'Vue/header.php';
    ?>

    <div class="flex justify-around bg-pink-500 h-40">
        <form action="" method="post" class="flex items-center">
            <?php     
                include 'Vue/secteur.php';
                include 'Vue/date.php';
                include 'Vue/liaison.php';
            ?>
        </form>
    </div>
    
    <div class="flex justify-center bg-gray-100">
        <?php 
            include 'Vue/traversees.php';
        ?>
    </div>
    
  
    <?php
        //include 'Vue/footer.php';
    ?>   
</body>

</html>