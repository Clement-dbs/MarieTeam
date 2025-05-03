<div class="flex h-screen">
<?php include 'Vue/sidebarrePanel.php';?>
<div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">Liste des Réservations</h1>
        
        <!-- Table des réservations -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Utilisateur</th>
                        <th class="py-3 px-6 text-left">Prix total</th>
                        <th class="py-3 px-6 text-left">Traversé</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php foreach ($reservations as $reservation): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['prenom'] . ' ' . $reservation['nom']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars(number_format($reservation['prix_total'], 2, ',', ' ') . ' €'); ?>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['port_depart'].' - '.$reservation['port_arrive']); ?></td>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
