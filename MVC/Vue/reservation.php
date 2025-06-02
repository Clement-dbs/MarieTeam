<form method="POST" action="./?action=reservation" onsubmit="return confirm('Confirmer la réservation ?')">
  <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
    
    <div>
      <?php 
        foreach($typeVoyageurs as $typeVoyageur) {
          $categorie = $typeVoyageur['categorie'];
          $max = $placesRestantesParCategorie[$categorie] ?? 0;

          // Trouver le tarif correspondant
          $tarifAssocie = null;
          foreach ($tarifs as $t) {
            if ($t['id_type_passager'] == $typeVoyageur['id']) {
              $tarifAssocie = $t;
              $tarifAssocie['type'] = 'passager';
              break;
            }
            if ($t['id_type_vehicule'] == $typeVoyageur['id']) {
              $tarifAssocie = $t;
              $tarifAssocie['type'] = 'vehicule';
              break;
            }
          }
      ?>
        <div class="bg-white p-4 rounded-lg shadow mb-4 flex items-center justify-between">
          <div class="flex items-center space-x-4">
            <div>
              <h2 class="font-medium"><?= $typeVoyageur['libelle'] ?></h2>
              <p class="text-sm text-gray-500">
                <?= $tarifAssocie ? $tarifAssocie['tarif'] . " €" : "Tarif indisponible" ?>
              </p>
            </div>
          </div>
          <div class="flex items-center space-x-2">
            <input 
              type="number" 
              name="quantites[<?= $tarifAssocie['type'] ?>][<?= $typeVoyageur['id'] ?>]"
              value="0" 
              min="0" 
              max="<?= $max ?>" 
              class="w-full border px-2 py-1 rounded" 
            />
          </div>
        </div>
      <?php } ?>

      <button 
        name="btn_submit" 
        class="mt-6 w-full bg-blue-500 text-white py-3 rounded-full font-semibold text-lg">
        Valider mon panier
      </button>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
      <p class="text-sm text-gray-700 mb-1">
        <?= $traverseeDetail['0']['depart'] ?> ➜ <?= $traverseeDetail['0']['arrive'] ?>
      </p>

      <div class="bg-gray-100 p-4 rounded-lg mb-4">
        <div class="flex justify-between items-center text-sm text-gray-700">
          <div>
            <p class="font-medium">
              <?php echo date('H:i', strtotime($traverseeDetail[0]['dateDepart']));?>
            </p>
            <p><?= $traverseeDetail['0']['depart'] ?></p>
          </div>

          <p class="text-center">
            <?php
              $heureDepart = new DateTime($traverseeDetail[0]['dateDepart']);
              $heureArrivee = new DateTime($traverseeDetail[0]['dateArrive']);
              $difference = $heureArrivee->diff($heureDepart);
              echo $difference->format('%h h %i');
            ?>
          </p>

          <div class="text-right">
            <p class="font-medium">
              <?php echo date('H:i', strtotime($traverseeDetail[0]['dateArrive']));?>
            </p>
            <p><?= $traverseeDetail['0']['arrive'] ?></p>
          </div>
        </div>
      </div>
    </div>

  </div>
</form>
