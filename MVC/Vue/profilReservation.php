<div class="flex items-center flex-col my-10">
    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Mes Réservations</h2>

    <!-- Section des réservations prévues -->
    <div class="w-full mb-6">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Réservations à venir</h3>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Identifiant réservation</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Date de la réservation</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Traversée</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Adulte</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Junior</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Enfant</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Voiture < 4m</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Voiture < 5m</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Fourgon</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Camping Car</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Camion</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Prix total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Exemple de données (remplacer par des données dynamiques depuis la base)
                foreach ($reservationsPrevues as $reservation):?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($reservation['reservation_id']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['date']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['port_depart'].' - '.$reservation['port_arrivee']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['adulte']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['junior']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['enfant']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['voiture_4']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['voiture_5']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['fourgon']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['camping_car']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['camion']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['prix_total'].' €'); ?></td>
                                                      
                        </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Section des réservations passées -->
    <div class="w-full">
        <h3 class="text-xl font-semibold text-gray-700 mb-4">Réservations passées</h3>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Identifiant réservation</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Date de la réservation</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Traversée</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Adulte</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Junior</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Enfant</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Voiture < 4m</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Voiture < 5m</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Fourgon</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Camping Car</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Camion</th>
                    <th class="px-4 py-2 text-left text-sm font-semibold text-gray-600">Prix total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Exemple de données (remplacer par des données dynamiques depuis la base)
                foreach ($reservationsPassees as $reservation):?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($reservation['reservation_id']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['date']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['port_depart'].' - '.$reservation['port_arrivee']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['adulte']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['junior']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['enfant']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['voiture_4']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['voiture_5']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['fourgon']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['camping_car']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['camion']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($reservation['prix_total'].' €'); ?></td>                                                      
                        </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
