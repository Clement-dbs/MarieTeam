<?php      
    if (isset($_SESSION['liaison'])){

        $_SESSION['liaison'] = $_POST['liaison'];
        
        $codeLiaison = $_SESSION['liaison'];
        $traversees = getTraversees($codeLiaison);

        echo "<div class='flex flex-col space-y-6 w-1/3 p-4 text-center'>";

            echo "<h2 class='text-2xl font-NeueMontrealBold mb-4'>Sélectionnez votre trajet</h2>";

            foreach ($traversees as $traversee) {
                
                echo "<div role='button' class='flex flex-col bg-white p-6 rounded-lg shadow-md hover:bg-blue-50'>";  
                    echo "<div class='flex justify-between'>";  
                        echo "<div class='flex flex-col'>";
                            echo "<div class='text-lg font-NeueMontrealRegular'>";
                                echo $traversee['Heure']." ";
                                echo $traversee['Depart'] ;
                            echo "</div>";
                            echo "<div class='text-lg font-NeueMontrealRegular'>";
                                echo $traversee['Heure']." ";
                                echo $traversee['Arrivee'];
                            echo "</div>";
                        echo "</div>";
        
                    echo "<div class='flex items-center'>";  
                        echo "<span class='text-xl font-NeueMontrealBold'>19€</span>";
                    echo "</div>";
                    echo "</div>";
                    echo "<hr>";
                    echo "<div class='flex items-center'>";  
                        echo "<span class='font-NeueMontrealRegular'>Durée : 1h15</span>";
                    echo "</div>";
                echo "</div>";
            }
            echo "</div>";
    }
?>

