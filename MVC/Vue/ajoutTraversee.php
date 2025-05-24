<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="bg-gray-800 text-white w-64 p-4">
        <?php include 'Vue/sideBarrePanel.php'; ?>
    </aside>

    <!-- Main Content -->
    <div class="flex flex-1 items-center justify-center">
        <form action="./?action=ajoutTraversee" method="POST" class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
            <h3 class="text-2xl font-bold text-center text-blue-600 mb-6">Ajouter une traversée</h3>

            <div class="mb-6">
                <label for="dateDepart" class="block text-sm font-medium text-gray-700 mb-1">Date de départ</label>
                <input type="datetime-local" id="dateDepart" name="dateDepart" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-500 transition duration-150" 
                       required>
            </div>
            <div class="mb-6">
                <label for="DateArrivee" class="block text-sm font-medium text-gray-700 mb-1">Date d'arrivée</label>
                <input type="datetime-local" id="dateArrivee" name="dateArrivee" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-500 transition duration-150" 
                       required>
            </div>
            <div class="mb-6">
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Liaison</label>
                <select name="liaison" id="liaison" class="border border-gray-300 rounded px-4 py-2 w-full">
                    <option value="">-- Sélectionner une liaison --</option>
                    <?php foreach ($liaisons as $liaison): ?>
                        <option value="<?= htmlspecialchars($liaison['id_liaison']); ?>"><?= htmlspecialchars($liaison['port_depart']." - ". $liaison['port_arrive']); ?></option>
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
