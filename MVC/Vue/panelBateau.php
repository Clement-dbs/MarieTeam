<div class="flex h-screen">
<?php include 'Vue/sideBarrePanel.php';?>
<div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">Liste des Bateaux</h1>

        <!-- Bouton Ajouter -->
    <div class="mb-4 text-right">
        <a href="./?action=ajoutBateau" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
            Ajouter un bateau
        </a>
    </div>
        
        <!-- Table des bateaux -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Nom</th>
                        <th class="py-3 px-6 text-left">Places A Max</th>
                        <th class="py-3 px-6 text-left">Places B Max</th>
                        <th class="py-3 px-6 text-left">Places C Max</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php foreach ($bateaux as $bateau): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($bateau['id']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($bateau['nom']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($bateau['place_passager_max']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($bateau['place_vehicule_leger_max']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($bateau['place_vehicule_lourd_max']); ?></td>
                            <td class="py-3 px-6 text-left">
                            <form method="post" action="./?action=deleteBateau" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce bateau ?');">
                                <input type="hidden" name="id_bateau" value="<?= $bateau['id']; ?>">
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
