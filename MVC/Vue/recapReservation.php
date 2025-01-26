  <main class="flex-1 p-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-4">Détails de l'utilisateur</h2>

    <!-- Informations de l'utilisateur -->
    <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
      <h3 class="text-2xl font-semibold text-gray-800 mb-4">Informations Personnelles</h3>
      <p><strong>Nom :</strong> <?php echo $nom; ?></p>
      <p><strong>Prénom :</strong> <?php echo $prenom; ?></p>
      <p><strong>Email :</strong> <?php echo $email; ?></p>
      <p><strong>Téléphone :</strong> <?php echo $tel; ?></p>
    </div>

    <!-- Tarifs et quantités -->
    <div class="bg-white shadow-lg rounded-lg p-6">
      <h3 class="text-2xl font-semibold text-gray-800 mb-4">Tarifs et Quantités</h3>
      <div class="space-y-4">
        <?php 
          $types = [
            'Adulte' => $adulte,
            'Junior' => $junior,
            'Enfant' => $enfant,
            'Voiture < 4' => $voiture_4,
            'Voiture < 5' => $voiture_5,
            'Fourgon' => $fourgon,
            'Camping car' => $camping_car,
            'Camion' => $camion
          ];

          foreach ($types as $key => $value) {
            $index = array_search($key, array_keys($types)); // Trouver l'index du tarif
            if ($quantites[$index] > 0) {
              $total = $tarifs[$index] * $quantites[$index];
              echo "<div class='flex'><span class='font-semibold text-gray-700'>$key :</span><span class='font-semibold text-green-500'>$value, $total €</span></div>";
            }
          }
        ?>
        </div>
    </div>

    <!-- Prix total -->
    <div class="bg-white shadow-lg rounded-lg p-6">
      <h3 class="text-2xl font-semibold text-gray-800 mb-4">Total</h3>
      <p class="font-semibold text-xl text-gray-800">Prix total : <span class="text-green-500"><?php echo $prixTotal; ?> €</span></p>
    </div>
  </main>
</div>
