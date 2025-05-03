<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="bg-gray-800 text-white w-64 p-4">
        <?php include 'Vue/sideBarrePanel.php'; ?>
    </aside>

    <!-- Main Content -->
    <div class="flex flex-1 items-center justify-center">
        <form action="./?action=ajoutLiaison" method="POST" class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
            <h3 class="text-2xl font-bold text-center text-blue-600 mb-6">Ajouter une liaison</h3>
            
            <!-- Champ Nom -->
            <div class="mb-6">
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Port Depart</label>
                <select name="portDepart" id="portDepart" class="border border-gray-300 rounded px-4 py-2 w-full">
                    <option value="">-- Sélectionner un port --</option>
                    <?php foreach ($ports as $port): ?>
                        <option value="<?= htmlspecialchars($port['id']); ?>"><?= htmlspecialchars($port['nom']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-6">
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Port Arrive</label>
                <select name="portArrive" id="portArrive" class="border border-gray-300 rounded px-4 py-2 w-full">
                    <option value="">-- Sélectionner un port --</option>
                    <?php foreach ($ports as $port): ?>
                        <option value="<?= htmlspecialchars($port['id']); ?>"><?= htmlspecialchars($port['nom']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-6">
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Distance</label>
                <input type="number" id="distance" name="distance" min="1" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-500 transition duration-150" 
                       required>
            </div>

            <div class="mb-6">
                <label for="dateDebut" class="block text-sm font-medium text-gray-700 mb-1">Secteur</label>
                <select name="secteur" id="secteur" class="border border-gray-300 rounded px-4 py-2 w-full">
                    <option value="">-- Sélectionner un secteur --</option>
                    <?php foreach ($secteurs as $secteur): ?>
                        <option value="<?= htmlspecialchars($secteur['id']); ?>"><?= htmlspecialchars($secteur['nom']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="text-center">
                <button type="submit" name="submit" 
                        class="w-full bg-blue-500 text-white font-semibold py-2 rounded-lg hover:bg-blue-600 transition duration-150">
                    Ajouter
                </button>
            </div>
        </form>
    </div>
</div>
