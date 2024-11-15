<?php
  if (isset($_POST['liaison'])) {

    $_SESSION['liaison'] = $_POST['liaison'];
   

  }

  $liaisons = getLiaisons($_SESSION['secteur']);
?>

<div class="flex flex-col mx-10 font-NeueMontrealRegular">
<label for="liaison" class="font-NeueMontrealBold text-lg text-gray-700">Liaison</label>
    <select name="liaison" onchange="this.form.submit()" class="py-2 px-5 border rounded-lg  text-gray-700 font-NeueMontrealRegular">
      <option value="">Sélectionner une liaison</option>
        <?php
            foreach ($liaisons as $liaison) {
              echo '<option value="' . $liaison['CodeLiaison'] . '">' . $liaison['PortDepart'] . ' - ' . $liaison['PortArrivee'] . '</option>';
            }
        ?>
      </select>
</div>
    



