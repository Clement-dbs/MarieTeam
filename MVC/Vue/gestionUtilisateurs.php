<div class="flex h-screen">
    <!-- Sidebar -->
        <?php include 'Vue/sideBarrePanel.php'; ?>

    <!-- Main Content -->
    <main class="flex-1 p-6 bg-gray-100">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Gestion des utilisateurs</h1>

        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead>
                <tr class="bg-gray-800 text-white">
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Prenom</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Nom</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Email</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Téléphone</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Admin</th>
                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $utilisateur): ?>
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-3 px-4"><?= htmlspecialchars($utilisateur['prenom']); ?></td>
                        <td class="py-3 px-4"><?= htmlspecialchars($utilisateur['nom']); ?></td>
                        <td class="py-3 px-4"><?= htmlspecialchars($utilisateur['email']); ?></td>
                        <td class="py-3 px-4"><?= htmlspecialchars($utilisateur['telephone']); ?></td>
                        <td class="py-3 px-4"><?= htmlspecialchars($utilisateur['isAdmin']); ?></td>
                        <td class="py-3 px-6 text-left">
                            <form method="post" action="./?action=deleteUtilisateur" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                <input type="hidden" name="id_utilisateur" value="<?= $utilisateur['id']; ?>">
                                <button type="submit" class="bg-red-500 text-white py-1 px-3 rounded hover:bg-red-600">
                                    Supprimer
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</div>
