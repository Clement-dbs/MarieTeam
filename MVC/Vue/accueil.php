<div class="flex justify-around bg-cover bg-center" style="background-image: url('../Assets/Images/background.jpg'); height: 50vh;">

<form action="" method="post" class="flex items-center justify-center">
    <div class="flex justify-center bg-white p-5">
        <!-- Choix Secteur -->
        <div class="flex flex-col font-NeueMontrealRegular p-2">
            <label for="secteur" class="font-NeueMontrealBold text-xl flex items-center">
                <img src="../Assets/Icons/boussole.png" alt="" class="w-5 h-5 mr-2">
                Destination
            </label>
            <select name="secteur" onchange="this.form.submit()" 
                class="py-4 px-6 border rounded-lg text-gray-700 font-NeueMontrealRegular w-64 h-15">
                <option value="" disabled selected hidden>Sélectionner un secteur</option>
                <?php
                    foreach ($secteurs as $secteur) {
                        $selected = (isset($_SESSION['secteur']) && $_SESSION['secteur'] == $secteur['id']) ? 'selected' : '';
                        echo '<option value="' . $secteur['id'] . '" ' . $selected . '>' . $secteur['nom'] . '</option>';
                    }
                ?>
            </select>
        </div>

        <!-- Choix Liaison -->
        <div class="flex flex-col font-NeueMontrealRegular p-2">
            <label for="liaison" class="font-NeueMontrealBold text-xl flex items-center">
                <img src="../Assets/Icons/location.png" alt="" class="w-5 h-5 mr-2">
                Liaison
            </label>
            <select name="liaison" onchange="this.form.submit()"
                class="py-4 px-6 border rounded-lg text-gray-700 font-NeueMontrealRegular w-64 h-15">
                <option value="" disabled selected hidden>Sélectionner une liaison</option>
             <?php
                foreach ($liaisons as $liaison) {
                    $selected = (isset($_SESSION['liaison']) && $_SESSION['liaison'] == $liaison['id_liaison']) ? 'selected' : '';
                    echo '<option value="' . $liaison['id_liaison'] . '" ' . $selected . '>' . $liaison['PortDepart'] . ' - ' . $liaison['PortArrivee'] . '</option>';
                }
            ?>
</select>

        </div>

        <!-- Choix Date -->
        <div class="flex flex-col justify-center font-NeueMontrealRegular p-2">
            <label for="dateDepart" class="font-NeueMontrealBold text-xl flex items-center">
                <img src="../Assets/Icons/date.png" alt="" class="w-5 h-5 mr-2">
                Date Départ
            </label>
            <input type="date" name="dateDepart" 
                class="py-4 px-6 border rounded-lg text-gray-700 font-NeueMontrealRegular w-64 h-14" 
                value="<?php echo isset($_SESSION['dateDepart']) ? $_SESSION['dateDepart'] : ''; ?>">
        </div>
    

    <!-- Bouton Valider -->
    <div class="flex justify-center">
    <input type="submit" value="Rechercher" name="rechercher"
        class="bg-blue-600 text-white hover:bg-blue-700 w-40 text-center py-2 transform transition duration-300 hover:scale-110 cursor-pointer">
</div>

    </div>
</form>


</div>

<!-- Affichage des traversées -->
<?php if (isset($_SESSION['liaison']) && !empty($traversees)&& isset($_SESSION['idPeriode'])) { ?>
<div class="flex flex-col justify-center bg-container">
    <div class="flex justify-center">
        <h2 class='text-2xl font-NeueMontrealBold m-14'>Sélectionnez votre trajet</h2>
    </div>
    <div class="flex justify-center">
            <div class='flex flex-col w-1/3 mr-10 text-center'>
                <form action='' method='post' class='space-y-6'>
                    <div name='traversee'>
                        <?php 
                        if (!empty($traversees)) {
                            $premiereTraversee = $traversees[0]; 
                        }
                        foreach ($traversees as $traversee) {
                            $heureDepart = new DateTime($traversee['depart']);
                            $heureArrivee = new DateTime($traversee['arrive']);
                            $difference = $heureArrivee->diff($heureDepart);
                        ?>
                            <div class='flex flex-col bg-white mb-10 rounded-lg shadow-md hover:bg-blue-50 focus:ring focus:ring-blue-300 focus:border-blue-500 border-2'>
                                <button type='submit' name='traversee' 
                                        value="<?php echo htmlspecialchars($traversee['id'], ENT_QUOTES, 'UTF-8'); ?>" 
                                        class='w-full p-6'>
                                    <div class='flex justify-between'>
                                        <div class='flex flex-col'>
                                            <div class='text-lg font-NeueMontrealRegular'>
                                                <?php echo date('H:i', strtotime($traversee['depart']));?>
                                            </div>
                                            <div class='text-lg font-NeueMontrealRegular'>
                                                <?php echo date('H:i', strtotime($traversee['arrive'])); ?>
                                            </div>
                                        </div>
                                        <div class='flex items-center'>
                                            <span class='text-xl font-NeueMontrealBold'>
                                                <?php /*
                                                $periode = $_SESSION['dateDepart'] ?? null;
                                                $tarifs = getTarifsByPeriode($periode);

                                                $tarifAdulte = null;
                                                foreach ($tarifs as $tarif) {
                                                    if ($tarif['num'] === 'Adulte') {
                                                        $tarifAdulte = $tarif['tarif'];
                                                        break;
                                                    }
                                                }

                                                $affichageTarif = (floor($tarifAdulte) == $tarifAdulte) 
                                                    ? number_format($tarifAdulte, 0, '.', '') 
                                                    : number_format($tarifAdulte, 2, '.', '');
                                                echo "$affichageTarif €";*/
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class='flex items-center'>
                                        <span class='font-NeueMontrealRegular'><?php echo $difference->format('%h h %i'); ?></span>
                                    </div>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                </form>
            </div>

            <!-- Affichage des détails de la traversée -->
            <?php if (isset($_SESSION['traversee'])) { 
                $traversee = getTraverseesById($_SESSION['traversee']);
            ?>
                <div class="flex flex-col w-1/4 px-10 py-10 ml-10 max-h-min bg-white rounded-lg font-NeueMontrealBold text-black shadow-md border-2">
                    <form action="./?action=reservation" method="post">
                        <div class="flex justify-center pb-3 text-2xl">
                            <h2>Détails de la traversée</h2>
                        </div>

                        <div class="flex justify-between py-2">
                            <div class="border rounded-lg p-5 m-2 w-1/2">
                                <h3>Départ : <?php echo htmlspecialchars((string)$traversee[0]['depart'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                
                            </div>
                            <div class="border rounded-lg p-5 m-2 w-1/2">
                                <h3>Arrivée : <?php echo htmlspecialchars((string)$traversee[0]['arrive'], ENT_QUOTES, 'UTF-8');?></h3>
                            </div>
                        </div>

                        <div class="py-2 px-5 border rounded-lg my-5">
                            <h3>Places disponibles</h3>
                            <span>Passagers : <?php echo (int)$traversee[0]['Place Passager']; ?></span><br>
                            <span>Véhicule < 2m : <?php echo (int)$traversee[0]['Place Véhicule Léger']; ?></span><br>
                            <span>Véhicule > 2m : <?php echo (int)$traversee[0]['Place Véhicule Lourd']; ?></span>
                        </div>

                        <input type="text" hidden name="bateauID" value="<?= htmlspecialchars($traversee[0]['id_bateau'])?>">
                        <button type="submit" name="traverseeSelectionnee" value="<?php echo htmlspecialchars($traversee[0]['id_bateau'], ENT_QUOTES, 'UTF-8'); ?>" 
                                class="w-full p-6 bg-blue-600 text-white rounded-lg hover:bg-opacity-80">Acheter mon billet</button>
                    </form>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="text-center font-NeueMontrealRegular">
                <p>Aucune traversée disponible</p>
            </div>
        <?php } ?>
    </div>
</div>
=======
<div class="flex justify-around bg-cover bg-center" style="background-image: url('../Assets/Images/background.jpg'); height: 50vh;">

<form action="" method="post" class="flex items-center justify-center">
    <div class="flex justify-center bg-white p-5">
        <!-- Choix Secteur -->
        <div class="flex flex-col font-NeueMontrealRegular p-2">
            <label for="secteur" class="font-NeueMontrealBold text-xl flex items-center">
                <img src="../Assets/Icons/boussole.png" alt="" class="w-5 h-5 mr-2">
                Destination
            </label>
            <select name="secteur" onchange="this.form.submit()" 
                class="py-4 px-6 border rounded-lg text-gray-700 font-NeueMontrealRegular w-64 h-15">
                <option value="" disabled selected hidden>Sélectionner un secteur</option>
                <?php
                foreach ($secteurs as $secteur) {
                    $selected = (isset($_SESSION['secteur']) && $_SESSION['secteur'] === $nom) ? 'selected' : '';
                    echo '<option value="' . $secteur['id'] . '" ' . $selected . '>' . htmlspecialchars($secteur['nom']) . '</option>';
                }
                ?>
            </select>
        </div>

        <!-- Choix Liaison -->
        <div class="flex flex-col font-NeueMontrealRegular p-2">
            <label for="liaison" class="font-NeueMontrealBold text-xl flex items-center">
                <img src="../Assets/Icons/location.png" alt="" class="w-5 h-5 mr-2">
                Liaison
            </label>
            <select name="liaison" 
                class="py-4 px-6 border rounded-lg text-gray-700 font-NeueMontrealRegular w-64 h-15">
                <option value="" disabled selected hidden>Sélectionner une liaison</option>
                <?php
                foreach ($liaisons as $liaison) {
                    $selected = (isset($_SESSION['secteur']) && $_SESSION['liaison'] == $liaison['id_liaison']) ? 'selected' : '';
                    echo '<option value="' . $liaison['id_liaison'] . '" ' . $selected . '>' . $liaison['PortDepart'] . ' - ' . $liaison['PortArrivee'] . '</option>';
                }
                ?>
            </select>
        </div>

        <!-- Choix Date -->
        <div class="flex flex-col justify-center font-NeueMontrealRegular p-2">
            <label for="dateDepart" class="font-NeueMontrealBold text-xl flex items-center">
                <img src="../Assets/Icons/date.png" alt="" class="w-5 h-5 mr-2">
                Date Départ
            </label>
            <input type="date" name="dateDepart" 
                class="py-4 px-6 border rounded-lg text-gray-700 font-NeueMontrealRegular w-64 h-14" 
                value="<?php echo isset($_SESSION['dateDepart']) ? $_SESSION['dateDepart'] : ''; ?>">
        </div>
    

    <!-- Bouton Valider -->
    <div class="flex justify-center">
    <input type="submit" value="Rechercher" name="rechercher"
        class="bg-blue-600 text-white hover:bg-blue-700 w-40 text-center py-2 transform transition duration-300 hover:scale-110 cursor-pointer">
</div>


    </div>
</form>


</div>

<!-- Affichage des traversées -->
<?php if (isset($_SESSION['liaison']) && !empty($traversees)&& isset($_SESSION['idPeriode'])) { ?>
<div class="flex flex-col justify-center bg-container">
    <div class="flex justify-center">
        <h2 class='text-2xl font-NeueMontrealBold m-14'>Sélectionnez votre trajet</h2>
    </div>
    <div class="flex justify-center">
            <div class='flex flex-col w-1/3 mr-10 text-center'>
                <form action='' method='post' class='space-y-6'>
                    <div>
                        <?php 
                        if (!empty($traversees)) {
                            $premiereTraversee = $traversees[0]; 
                        }
                        foreach ($traversees as $traversee) {
                            $depart = new DateTime($traversee['depart']);
                            $arrive = new DateTime($traversee['arrive']);
                            $difference = $arrive->diff($depart);
                        ?>
                            <div class='flex flex-col bg-white mb-10 rounded-lg shadow-md hover:bg-blue-50 focus:ring focus:ring-blue-300 focus:border-blue-500 border-2'>
                                <button type='submit' name='traversee' 
                                        value="<?php echo htmlspecialchars($traversee['Id'], ENT_QUOTES, 'UTF-8'); ?>" 
                                        class='w-full p-6'>
                                    <div class='flex justify-between'>
                                        <div class='flex flex-col'>
                                            <div class='text-lg font-NeueMontrealRegular'>
                                                <?php echo date('H:i', strtotime($traversee['depart'])) . " " . $traversee['Depart']; ?>
                                            </div>
                                            <div class='text-lg font-NeueMontrealRegular'>
                                                <?php echo date('H:i', strtotime($traversee['arrive'])) . " " . $traversee['Arrivee']; ?>
                                            </div>
                                        </div>
                                        <div class='flex items-center'>
                                            <span class='text-xl font-NeueMontrealBold'>
                                                <?php 
                                                $periode = $_SESSION['dateDepart'] ?? null;
                                                $tarifs = getTarifsByPeriode($periode);

                                                $tarifAdulte = null;
                                                foreach ($tarifs as $tarif) {
                                                    if ($tarif['type'] === 'Adulte') {
                                                        $tarifAdulte = $tarif['tarif'];
                                                        break;
                                                    }                                                
                                                }

                                                $affichageTarif = (floor($tarifAdulte) == $tarifAdulte) 
                                                    ? number_format($tarifAdulte, 0, '.', '') 
                                                    : number_format($tarifAdulte, 2, '.', '');
                                                echo "Dès $affichageTarif €";
                                                ?>
                                            </span>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class='flex items-center'>
                                        <span class='font-NeueMontrealRegular'><?php echo $difference->format('%h h %i'); ?></span>
                                    </div>
                                </button>
                            </div>
                        <?php } ?>
                    </div>
                </form>
            </div>

            <!-- Affichage des détails de la traversée -->
            <?php
if (isset($_SESSION['traversee'])) {
    $traversee = getTraverseesById($_SESSION['traversee']);
?>
    <div class="flex flex-col w-1/4 px-10 py-10 ml-10 max-h-min bg-white rounded-lg font-NeueMontrealBold text-black shadow-md border-2">
        <form action="./?action=reservation" method="post">
            <div class="flex justify-center pb-3 text-2xl">
                <h2>Détails de la traversée</h2>
            </div>

            <div class="flex justify-between py-2">
                <div class="border rounded-lg p-5 m-2 w-1/2">
                    <h3>Départ : <?php echo htmlspecialchars((string)$traversee[0]['Depart'], ENT_QUOTES, 'UTF-8'); ?></h3>
                    <span class="opacity-50">
                        <?php echo htmlspecialchars(date('H:i', strtotime($traversee[0]['depart'])), ENT_QUOTES, 'UTF-8'); ?>
                    </span>
                </div>
                <div class="border rounded-lg p-5 m-2 w-1/2">
                    <h3>Arrivée : <?php echo htmlspecialchars((string)$traversee[0]['Arrivee'], ENT_QUOTES, 'UTF-8');?></h3>
                    <span class="opacity-50">
                        <?php echo htmlspecialchars(date('H:i', strtotime($traversee[0]['arrive'])), ENT_QUOTES, 'UTF-8'); ?>
                    </span>
                </div>
            </div>

            <div class="py-2 px-5 border rounded-lg my-5">
                <h3>Places disponibles</h3>
                <span>Passagers : <?php echo (int)$traversee[0]['A Passager']; ?></span><br>
                <span>Véhicule < 2m : <?php echo (int)$traversee[0]['B Véh.inf.2m']; ?></span><br>
                <span>Véhicule > 2m : <?php echo (int)$traversee[0]['C Véh.sup.2m']; ?></span>
            </div>

            <input type="text" hidden name="bateauID" value="<?= htmlspecialchars($traversee[0]['bateauID'])?>">
            <button type="submit" name="traverseeSelectionnee" value="<?php echo htmlspecialchars($traversee[0]['Id'], ENT_QUOTES, 'UTF-8'); ?>" 
                    class="w-full p-6 bg-blue-600 text-white rounded-lg hover:bg-opacity-80">Acheter mon billet</button>
        </form>
    </div>
<?php } else { ?>
    <div class="text-center font-NeueMontrealRegular">
        <p>Aucune traversée disponible</p>
    </div>
<?php } 
}?>
    </div>
</div>
