<div class="flex items-center flex-col my-10">
    <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Modifier votre profil</h2>

    <?php if (!empty($message)): ?>
        <p class="text-green-500 text-sm text-center"><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="./?action=editProfil" method="POST" class="rounded-lg shadow-md p-8">
        <div class="flex flex-col">
            <div class="my-5">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $_SESSION['utilisateur'][0]['email']; ?>" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            </div>

            <div class="my-5">
                <label for="nom" class="block text-sm font-medium text-gray-700">Nom</label>
                <input type="text" id="nom" name="nom" value="<?php echo $_SESSION['utilisateur'][0]['nom']; ?>" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            </div>

            <div class="my-5">
                <label for="prenom" class="block text-sm font-medium text-gray-700">Prénom</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo $_SESSION['utilisateur'][0]['prenom']; ?>" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            </div>

            <div class="my-5">
                <label for="telephone" class="block text-sm font-medium text-gray-700">Téléphone</label>
                <input type="text" id="telephone" name="telephone" value="<?php echo $_SESSION['utilisateur'][0]['telephone']; ?>" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
            </div>

            <div class="my-5">
            <label for="mdp" class="block text-sm font-medium text-gray-700">Nouveau mot de passe (laisser vide si inchangé)</label>
            <input type="password" id="mdp" name="mdp" 
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>

        <div class="my-5">
            <label for="confirm_mdp" class="block text-sm font-medium text-gray-700">Confirmer le nouveau mot de passe</label>
            <input type="password" id="confirm_mdp" name="confirm_mdp" 
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
        </div>
        <?php if (!empty($message)): ?>
            <p class="text-red-500 text-sm text-center"><?php echo $message; ?></p>
        <?php endif; ?>


        </div>

        <div>
            <button type="submit" name="modifier_profil" 
                    class="w-full py-2 px-4 bg-secondary-color text-white rounded-md shadow hover:bg-blue-600">
                Modifier le profil
            </button>
        </div>
    </form>
</div>
