<div class="flex h-screen">
    <?php include 'Vue/sideBarrePanel.php'; ?>
<div class="container mx-auto p-4">
    <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">Liste des Traversées</h1>
    
    <!-- Bouton Ajouter -->
    <div class="mb-4 text-right">
        <a href="./?action=ajoutTraversee" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
            Ajouter une traversée
        </a>
    </div>
    
    <!-- Table des réservations -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Départ</th>
                    <th class="py-3 px-6 text-left">Arrivée</th>
                    <th class="py-3 px-6 text-left">Bateau</th>
                    <th class="py-3 px-6 text-left">Place A restante</th>
                    <th class="py-3 px-6 text-left">Place B restante</th>
                    <th class="py-3 px-6 text-left">Place C restante</th>
                    <th class="py-3 px-6 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php foreach ($traversees as $traversee): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($traversee['id_traversee']); ?></td>
                        <td class="py-3 px-6 text-left"><?= htmlspecialchars($traversee['depart']) . "<br>" . htmlspecialchars(formatDate($traversee['date_depart']))?></td>
                        <td class="py-3 px-6 text-left"><?= htmlspecialchars($traversee['arrive']) . "<br>" . htmlspecialchars(formatDate($traversee['date_arrive']))?></td>
                        <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($traversee['nom_bateau']); ?></td>
                        <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($traversee['places_passager_restantes']); ?></td>
                        <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($traversee['places_vehicule_leger_restantes']); ?></td>
                        <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($traversee['places_vehicule_lourd_restantes']); ?></td>
                        <td class="py-3 px-6 text-left">
                            <form method="post" action="./?action=deleteTraversee" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette traversee ?');">
                                <input type="hidden" name="id_traversee" value="<?= $traversee['id_traversee']; ?>">
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
