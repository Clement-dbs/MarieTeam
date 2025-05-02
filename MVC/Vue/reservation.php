<div class="bg-white shadow-lg rounded-lg p-8 w-full max-w-4xl mx-auto">
  <!-- Informations générales -->
  <h2 class="text-lg font-bold text-gray-800">Places restantes</h2>
  <div class="grid grid-cols-1 md:grid-cols-3 gap-4 my-5">
    <div class="border rounded-lg p-4 text-center shadow hover:shadow-md transition">
      <h3 class="text-lg font-bold text-gray-800">Catégorie A </h3>
      <p class="text-sm text-gray-600 mt-1">Adulte, Junior, Enfants</p>
      <p class="font-semibold"><?= htmlspecialchars($places['placesA'])?></p>
    </div>
    <div class="border rounded-lg p-4 text-center shadow hover:shadow-md transition">
      <h3 class="text-lg font-bold text-gray-800">Catégorie B</h3>
      <p class="text-sm text-gray-600 mt-1">Voitures</p>
      <p class="font-semibold"><?= htmlspecialchars($places['placesB']) ?></p>
    </div>
    <div class="border rounded-lg p-4 text-center shadow hover:shadow-md transition">
      <h3 class="text-lg font-bold text-gray-800">Catégorie C </h3>
      <p class="text-sm text-gray-600 mt-1">Fourgon, Camping Car, Camion</p>
      <p class="font-semibold"><?= htmlspecialchars($places['placesC']) ?></p>
    </div>
  </div>

  <!-- Formulaire de réservation -->
  <form method="POST" action="./?action=reservation" onsubmit="return confirmReservation()" class="space-y-6">
    <!-- Sélection de la traversée -->
    <?php if (!empty($traversees)): ?>
      <div>
        <label for="traversee" class="block text-lg font-medium text-gray-700">Sélectionnez une traversée :</label>
        <select name="traversee" id="traversee" required class="w-full mt-2 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
          <option value="">-- Choisissez une traversée --</option>
          <?php foreach ($traversees as $traversee): ?>
            <option value="<?= htmlspecialchars($traversee['id']) ?>">
              <?= htmlspecialchars($traversee['id']) ?> - <?= htmlspecialchars($traversee['heure']) ?> (<?= htmlspecialchars($traversee['jour']) ?>)
            </option>
          <?php endforeach; ?>
        </select>
      </div>
    <?php endif; ?>

    <!-- Tableau des tarifs -->
    <?php if (!empty($tarifs)): ?>
      <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse border border-gray-200">
          <thead class="bg-gray-200">
            <tr>
              <th class="border border-gray-300 px-4 py-2">Type</th>
              <th class="border border-gray-300 px-4 py-2">Tarif (€)</th>
              <th class="border border-gray-300 px-4 py-2">Quantité</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($tarifs as $index => $tarif):?>
              
              <tr class="odd:bg-white even:bg-gray-50">
                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($tarif['type']) ?></td>
                <td class="border border-gray-300 px-4 py-2"><?= htmlspecialchars($tarif['tarif']) ?>€</td>
                <td class="border border-gray-300 px-4 py-2">
                  <?php 
                  // Empeche l'insertion au dessus des places max
                    $maxPlaces = 0;
                    switch ($tarif['type']) {
                        case 'Adulte': case 'Junior 8-18 ans': case 'Enfant 0-7 ans':
                            $maxPlaces = $places['placesA'];
                            break;
                        case 'Voiture longueur < 4m': case 'Voiture longueur < 5m': case 'Fourgon':
                            $maxPlaces = $places['placesB'];
                            break;
                        case 'Camping Car': case 'Camion':
                            $maxPlaces = $places['placesC'];
                            break;
                    }
                  ?>
                  <input type="number" name="quantite[]" value="0" min="0" max="<?= $maxPlaces ?>" required class="w-full px-3 py-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                  <input type="hidden" name="tarif[]" value="<?= htmlspecialchars($tarif['tarif']) ?>">
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>

    <!-- Bouton de soumission -->
    <div class="text-right">
      <input type="submit" name="btn_submit" value="Enregistrer la réservation" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-6 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none cursor-pointer">
    </div>
  </form>
</div>

<script>
  function confirmReservation() {
    return confirm("Êtes-vous sûr de vouloir réserver avec les quantités sélectionnées ?");
  }
</script>
