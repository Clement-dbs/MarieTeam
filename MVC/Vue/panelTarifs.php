<div class="flex h-screen">
        <?php include 'Vue/sideBarrePanel.php'; ?>
    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">Liste des Tarifs</h1>
        <!-- Bouton Ajouter Tarif -->
        <div class="mb-4 text-right">
            <a href="./?action=ajoutTarif" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Ajouter Tarif</a>
        </div>

        <!-- Formulaire de filtre par periode et liaison -->
        <form method="GET" class="mb-4">
            <input type="hidden" name="action" value="panelTarifs">

            <!-- Filtre par période -->
            <div class="mb-4">
                <label for="periode" class="text-gray-700 font-bold">Filtrer par période :</label>
                <select 
                    id="periode" 
                    name="periode" 
                    class="border border-gray-300 rounded-lg px-4 py-2"
                    onchange="this.form.submit()"
                >
                    <option value="">-- Toutes les périodes --</option>
                    <?php foreach ($periodes as $periode): ?>
                        <option value="<?= htmlspecialchars($periode['id']); ?>" 
                            <?= isset($_GET['periode']) && $_GET['periode'] === $periode['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($periode['nom']); ?>, <?= htmlspecialchars($periode['dateDebut']); ?> - <?= htmlspecialchars($periode['dateFin']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Filtre par liaison -->
            <div class="mb-4">
                <label for="liaison" class="text-gray-700 font-bold">Filtrer par liaison :</label>
                <select 
                    id="liaison" 
                    name="liaison" 
                    class="border border-gray-300 rounded-lg px-4 py-2"
                    onchange="this.form.submit()"
                >
                    <option value="">-- Toutes les liaisons --</option>
                    <?php foreach ($liaisons as $liaison): ?>
                        <option value="<?= htmlspecialchars($liaison['id_liaison']); ?>" 
                            <?= isset($_GET['liaison']) && $_GET['liaison'] === $liaison['id_liaison'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($liaison['port_depart'])?> - <?= htmlspecialchars($liaison['port_arrive']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <!-- Table des tarifs -->
        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Période</th>
                        <th class="py-3 px-6 text-left">Catégorie</th>
                        <th class="py-3 px-6 text-left">Liaison</th>
                        <th class="py-3 px-6 text-left">Prix</th>
                        <th class="py-3 px-6 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php foreach ($tarifs as $tarif): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <?= htmlspecialchars($tarif['periode_nom']); ?> (<?= htmlspecialchars($tarif['dateDebut']); ?> - <?= htmlspecialchars($tarif['dateFin']); ?>)
                            </td>
                            <td class="py-3 px-6 text-left">
                                <?php
                                if ($tarif['type_passager_libelle'] != null) {
                                    echo htmlspecialchars($tarif['type_passager_libelle']);
                                } else {
                                    echo htmlspecialchars($tarif['type_vehicule_libelle']);
                                }
                                ?>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <?= htmlspecialchars($tarif['port_depart']);?> - <?= htmlspecialchars($liaison['port_arrive']);?>
                            </td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($tarif['tarif'] . ' €'); ?></td>
                            <td class="py-3 px-6 text-left">
                            <form method="post" action="./?action=deleteTarif" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce tarif ?');">
                                <input type="hidden" name="id_tarif" value="<?= $tarif['id_tarif']; ?>">
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
</div>
