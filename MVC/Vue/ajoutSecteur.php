<div class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
        <?php include 'Vue/sideBarrePanel.php'; ?>

    <!-- Main Content -->
    <div class="flex flex-1 items-center justify-center">
        <form action="./?action=ajoutSecteur" method="POST" class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
            <h3 class="text-2xl font-bold text-center text-blue-600 mb-6">Ajouter un Secteur</h3>
            <div class="mb-6">
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom du Secteur</label>
                <input type="text" id="nom" name="nom" 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-300 focus:border-blue-500 transition duration-150" 
                       required>
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
