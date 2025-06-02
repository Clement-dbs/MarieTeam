<div class="flex h-screen">
<?php include 'Vue/sideBarrePanel.php';?>
<div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">Liste des ports</h1>

        <!-- Bouton Ajouter -->
    <div class="mb-4 text-right">
        <a href="./?action=ajoutPort" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
            Ajouter un port
        </a>
    </div>
        
        <!-- Table des ports -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Port</th>
                        <th class="py-3 px-6 text-left">Secteur</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php foreach ($ports as $port): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($port['nom_port']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($port['nom_secteur']); ?></td>      
                            <td class="py-3 px-6 text-left">
                            <form method="post" action="./?action=deletePort" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette port ?');">
                                <input type="hidden" name="id_port" value="<?= $port['id_port']; ?>">
                                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">
                                    Supprimer
                                </button>
                            </form>
                        </td>                                               
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
