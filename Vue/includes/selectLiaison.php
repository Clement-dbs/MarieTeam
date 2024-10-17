<div class="selectionLiaison">
  <?php
      require_once "../Modele/fonctions.php";
      include_once "../Controleur/session.php";
   
        if(isset($_SESSION['secteur'])) $liaisons = getLiaisons($_SESSION['secteur']);  
      
        if (isset($_POST['liaison'])) {
          $_SESSION['liaison'] = $_POST['liaison'];
          header("Location: index.php");
          exit(); 
      }

  ?>

  <h2>Sélectionner la liaison, et la date souhaitée</h2>
  <form action="../Vue/index.php" method="post">
      <select name="liaison">
          <?php
              foreach ($liaisons as $liaison) {
                echo '<option value="' . $liaison['CodeLiaison'] . '">' . $liaison['PortDepart'] . ' - ' . $liaison['PortArrive'] . '</option>';
            }

           
          ?>   
      </select>

      <button type="submit" name="btn_submit" id="btn_submit">Afficher les traversées</button>
  </form>
</div>