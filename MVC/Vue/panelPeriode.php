<div class="flex h-screen">
    <?php include 'Vue/sidebarrePanel.php'; ?>
<div class="container mx-auto p-4">
    <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">Liste des Périodes</h1>
    
    <!-- Bouton Ajouter -->
    <div class="mb-4 text-right">
        <a href="./?action=ajoutPeriode" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
            Ajouter une période
        </a>
    </div>
    
    <!-- Table des réservations -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Nom</th>
                    <th class="py-3 px-6 text-left">Début</th>
                    <th class="py-3 px-6 text-left">Fin</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php foreach ($periodes as $periode): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($periode['id']); ?></td>
                        <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($periode['nom']); ?></td>
                        <td class="py-3 px-6 text-left"><?= htmlspecialchars(formatDate($periode['dateDebut'])); ?></td>
                        <td class="py-3 px-6 text-left"><?= htmlspecialchars(formatDate($periode['dateFin'])); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
