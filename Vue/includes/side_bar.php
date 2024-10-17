<div class="side-bar">
  <?php
    require_once "../Modele/fonctions.php";
    include_once "../Controleur/session.php";

      if (isset($_POST['secteur'])) {
        $_SESSION['secteur'] = $_POST['secteur'];
        header("Location: index.php");
        exit(); 
    }
  ?>
   
      <form action="../Vue/index.php" method="POST" >
          <?php
            $secteurs = getSecteurs();
            foreach($secteurs as $secteur){
              echo '<p><input type="submit" name="secteur" id="secteur" value="'.$secteur.'"></p>';
            }     
          ?>
      </form>
</div>

