<form method="POST" action="./?action=reservation" onsubmit="return confirm('Confirmer la réservation ?')">
<div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
    <!-- Colonne Gauche - Options -->
    <div>
    <?php 
  
    foreach($typeVoyageurs as $typeVoyageur){ 
      $categorie = $typeVoyageur['categorie'];
      $max = $placesRestantesParCategorie[$categorie] ?? 0;
      ?>
      <div class="bg-white p-4 rounded-lg shadow mb-4 flex items-center justify-between">
    <div class="flex items-center space-x-4">
      <img src="https://cdn-icons-png.flaticon.com/512/595/595884.png" alt="Bagage" class="w-10 h-10" />
      <div>
        <h2 class="font-medium">
          <?= $typeVoyageur['libelle']?>
        </h2>
      </div>
    </div>
    <div class="flex items-center space-x-2">
    <input 
              type="number" 
              name="quantites[<?= $tarif['type'] ?>][<?= $tarif['id_type_passager'] ?? $tarif['id_type_vehicule'] ?>]" 
              value="0" 
              min="0" 
              max="<?= $max?>" 
              class="w-full border px-2 py-1 rounded" 
            />
    </div>
  </div>
<?php } ?>

      <!-- Bouton -->
      <button class="mt-6 w-full bg-blue-500 text-white py-3 rounded-full font-semibold text-lg">Valider mon panier</button>
    </div>

    <!-- Colonne Droite - Récapitulatif -->
    <div class="bg-white rounded-lg shadow p-6">
      <p class="text-sm text-gray-700 mb-1">Tourcoing ➜ Paris Aéroport Roissy-CDG 2</p>

      <div class="bg-gray-100 p-4 rounded-lg mb-4">
        <div class="flex justify-between items-center mb-2">
          <span class="text-sm font-semibold">Samedi 3 Mai 2025</span>
          <a href="#" class="text-blue-600 text-sm underline">Détail du billet</a>
        </div>
        <div class="flex justify-between items-center text-sm text-gray-700">
          <div>
            <p class="font-medium">06:57</p>
            <p>Tourcoing</p>
          </div>
          <p class="text-center">1h02</p>
          <div class="text-right">
            <p class="font-medium">07:59</p>
            <p>Paris Aéroport Roissy-CDG 2</p>
          </div>
        </div>
        <p class="mt-2 text-pink-600 text-xs">Grande Vitesse | Train n°7867</p>
      </div>

      <div class="flex justify-between border-t pt-4">
        <span class="text-sm font-medium">Total</span>
        <span class="text-pink-600 font-semibold text-lg">19€</span>
      </div>
    </div>
  </div>
</form>