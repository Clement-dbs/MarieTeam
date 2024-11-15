<?php

if (isset($_POST['secteur'])) {
    $_SESSION['secteur'] = $_POST['secteur'];
}

$secteurs = getSecteurs();

?>
<div class="flex flex-col mx-10 font-NeueMontrealRegular space-y-2">
    <label for="secteur" class="font-NeueMontrealBold text-lg text-gray-700">Zone Géographique</label>
    <select name="secteur" onchange="this.form.submit()" class="py-2 px-5 border rounded-lg  text-gray-700 font-NeueMontrealRegular">
        <option value="">Sélectionner un secteur</option>
        <?php
        foreach ($secteurs as $secteur) {
            $selected = (isset($_SESSION['secteur']) && $_SESSION['secteur'] === $secteur) ? 'selected' : '';
            echo '<option value="' . $secteur . '" ' . $selected . '>' . $secteur . '</option>';
        }
        ?>
    </select>
</div>
