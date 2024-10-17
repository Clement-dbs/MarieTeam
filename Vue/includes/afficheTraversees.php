<div class="afficherTraversees">

    <?php
        require_once "../Modele/fonctions.php";
        include_once "../Controleur/session.php";
   
        if (isset($_POST['liaison'])) {
            $_SESSION['liaison'] = $_POST['liaison'];
        }
     
    ?>

    <form action="../Vue/includes/reservation.php" method="POST" >
        <?php    
            if (isset($_SESSION['liaison'])){

                $codeLiaison = $_SESSION['liaison'];
       
                $traversees = getTraversees($codeLiaison);
                echo "<table>";
        
                echo "<th>N°<th>Heure</th><th>Bateau</th><th>Places Passager</th><th>Places Véhicule inf. 2m</th><th>Places Véhicule sup. 2m</th>";

                $index = 0;
                foreach ($traversees as $traversee) {
                    echo "<tr>";
                        echo "<td>" . $traversee['CodeLiaison']. "</td>";
                        echo "<td>" . $traversee['Heure']. "</td>";
                        echo "<td>" . $traversee['Bateau']. "</td>";
                        echo "<td>" . $traversee['Places_A_Passager']. "</td>";
                        echo "<td>" . $traversee['Places_B_Veh_inf_2m']. "</td>";
                        echo "<td>" . $traversee['Place_C_Veh_sup_2m']. "</td>";
                        echo '<td><input type="radio" name="traversee" value="'.$index.'"></td>'; 
                    echo "</tr>";   
                    $index++;     
                }
         
                echo "</table>";
                echo "<button type='submit'>Réserver cette traversée</button>";
            }
        ?>

    </form>

</div>


