<div class="flex h-screen">
    <aside class="bg-gray-800 text-white w-64 p-4">
        <?php include 'Vue/sidebarrePanel.php'; ?>
    </aside>
    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold text-center text-blue-600 mb-8">Liste des Tarifs</h1>
        <!-- Bouton Ajouter Tarif -->
        <div class="mb-4 text-right">
            <a href="./?action=ajoutTarif" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Ajouter Tarif</a>
        </div>
        
        <!-- Formulaire de filtre par periode et liaison -->
<form method="GET" class="mb-4">
    <input type="hidden" name="action" value="panelTarifs">
    
    <!-- Filtre par periode -->
    <div class="mb-4">
        <label for="periode" class="text-gray-700 font-bold">Filtrer par periode :</label>
        <select 
            id="periode" 
            name="periode" 
            class="border border-gray-300 rounded-lg px-4 py-2"
            onchange="this.form.submit()"
            >
            <option value="">-- Toutes les periodes --</option>
            <?php foreach ($periodes as $periode): ?>
                <option value="<?= htmlspecialchars($periode['debut']); ?>" 
                    <?= isset($_GET['periode']) && $_GET['periode'] === $periode['debut'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($periode['debut']); ?>
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
                <option value="<?= htmlspecialchars($liaison['code']); ?>" 
                    <?= isset($_GET['liaison']) && $_GET['liaison'] === $liaison['code'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($liaison['port_depart'] . ' - ' . $liaison['port_arrivee']); ?>
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
                        <th class="py-3 px-6 text-left">Début</th>
                        <th class="py-3 px-6 text-left">Categorie</th>
                        <th class="py-3 px-6 text-left">Liaison</th>
                        <th class="py-3 px-6 text-left">Prix</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                    <?php foreach ($tarifs as $tarif): ?>
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap"><?= htmlspecialchars($tarif['debut']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($tarif['type_libelle']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($tarif['port_depart'] . ' - ' . $tarif['port_arrivee']); ?></td>
                            <td class="py-3 px-6 text-left"><?= htmlspecialchars($tarif['tarif'].' €'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
