<div class="flex h-screen">
    <aside class="bg-gray-800 text-white w-64 p-4">
        <?php include 'Vue/sidebarrePanel.php'; ?>
    </aside>
    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">Gestion des Tarifs</h1>

        <form method="POST" action="./?action=ajoutTarif" class="mb-4">

            <!-- Sélecteur global de periode -->
            <div class="mb-4">
                <label for="periodeGlobal" class="block mb-2">Sélectionner une periode pour tout le tableau :</label>
                <select name="periodeGlobal" id="periodeGlobal" class="border border-gray-300 rounded px-4 py-2 w-full">
                    <option value="">-- Sélectionner une periode --</option>
                    <?php foreach ($periodes as $periode): ?>
                        <option value="<?= htmlspecialchars($periode['id']); ?>"><?= htmlspecialchars($periode['nom']); ?>, <?= htmlspecialchars($periode['dateDebut']); ?> - <?= htmlspecialchars($periode['dateFin']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Sélecteur global de liaison -->
            <div class="mb-4">
                <label for="liaisonGlobal" class="block mb-2">Sélectionner une liaison pour tout le tableau :</label>
                <select name="liaisonGlobal" id="liaisonGlobal" class="border border-gray-300 rounded px-4 py-2 w-full">
                    <option value="">-- Sélectionner une liaison --</option>
                    <?php foreach ($liaisons as $liaison): ?>
                        <option value="<?= htmlspecialchars($liaison['id_liaison']); ?>"><?= htmlspecialchars($liaison['port_depart'] . ' - ' . $liaison['port_arrive']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Tableau des types -->
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="table-auto w-full border-collapse border border-gray-200">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Type</th>
                            <th class="py-3 px-6 text-left">Tarif</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        <?php foreach ($types as $type): ?>
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($type['libelle']); ?></td>

                                <!-- Input pour le tarif -->
                                <td class="py-3 px-6 text-left">
                                    <input type="number" name="tarif[<?= $type['id']; ?>]" class="border border-gray-300 rounded px-4 py-2 w-full" required>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Bouton pour soumettre -->
            <div class="text-right mt-4">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Enregistrer les Tarifs</button>
            </div>
        </form>
    </div>
</div>
