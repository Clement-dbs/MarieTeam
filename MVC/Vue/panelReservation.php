<div class="flex h-screen">
<?php include 'Vue/sideBarrePanel.php';?>
<div class="container mx-auto p-4">
    <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">Liste des Réservations</h1>
    
    <!-- Table des réservations -->
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Utilisateur</th>
                    <th class="py-3 px-6 text-left">Prix total</th>
                    <th class="py-3 px-6 text-left">Traversée</th>
                    <th class="py-3 px-6 text-left">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php foreach ($reservations as $reservation): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['prenom'] . ' ' . $reservation['nom']); ?></td>
                        <td class="py-3 px-6 text-left"><?= htmlspecialchars(number_format($reservation['prix_total'], 2, ',', ' ') . ' €'); ?></td>
                        <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['port_depart'].' - '.$reservation['port_arrive']); ?></td>
                        <td class="py-3 px-6 text-left">
                            <form method="post" action="./?action=deleteReservation" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation ?');">
                                <input type="hidden" name="id_reservation" value="<?= $reservation['id_reservation']; ?>">
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
