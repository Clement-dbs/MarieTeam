<div class="flex h-screen">
<aside class="bg-gray-800 text-white w-64 p-4">
<?php include 'Vue/sidebarrePanel.php';?>
</aside>
<div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">Liste des Réservations</h1>
        
        <!-- Table des réservations -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Utilisateur</th>
                        <th class="py-3 px-6 text-left">Adultes</th>
                        <th class="py-3 px-6 text-left">Junior</th>
                        <th class="py-3 px-6 text-left">Enfant</th>
                        <th class="py-3 px-6 text-left">Voiture < 4m</th>
                        <th class="py-3 px-6 text-left">Voiture < 5m</th>
                        <th class="py-3 px-6 text-left">Fourgon</th>
                        <th class="py-3 px-6 text-left">Camping car</th>
                        <th class="py-3 px-6 text-left">Camion</th>
                        <th class="py-3 px-6 text-left">Prix total</th>
                        <th class="py-3 px-6 text-left">Traversé</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php foreach ($reservations as $reservation): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['prenom'] . ' ' . $reservation['nom']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['adulte']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['junior']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['enfant']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['voiture_4']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['voiture_5']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['fourgon']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['camping_car']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['camion']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars(number_format($reservation['prix_total'], 2, ',', ' ') . ' €'); ?>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['id_1']); ?></td>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
