<div class="flex h-screen">
<?php include 'Vue/sideBarrePanel.php';?>
<div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">Liste des Liaisons</h1>

        <!-- Bouton Ajouter -->
    <div class="mb-4 text-right">
        <a href="./?action=ajoutLiaison" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
            Ajouter une liaison
        </a>
    </div>
        
        <!-- Table des liaisons -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-left">Liaison</th>
                        <th class="py-3 px-6 text-left">Distance</th>
                        <th class="py-3 px-6 text-left">Secteur</th>
                        <th class="py-3 px-6 text-left">Liaison</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php foreach ($liaisons as $liaison): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($liaison['id_liaison']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($liaison['port_depart']. ' - '.$liaison['port_arrive']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($liaison['distance']).' km'; ?></td> 
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($liaison['nom_secteur']); ?></td>       
                            <td class="py-3 px-6 text-left">
                            <form method="post" action="./?action=deleteLiaison" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette liaison ?');">
                                <input type="hidden" name="id_liaison" value="<?= $liaison['id_liaison']; ?>">
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
