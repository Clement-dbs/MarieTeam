<div class="flex items-center flex-col">
  <h2 class="text-2xl font-semibold text-center text-gray-800 my-10">Formulaire d'inscription</h2>
  <form action="" method="POST" class="rounded-lg shadow-md p-8">
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 my-5">
      <div>
        <label for="nom" class="text-sm font-medium text-gray-700">Nom*</label>
        <input type="text" id="nom" name="nom" class="p-2 w-full border rounded-md shadow-sm" placeholder="Doe" required>
      </div>
      <div>
        <label for="prenom" class="text-sm font-medium text-gray-700">Prénom*</label>
        <input type="text" id="prenom" name="prenom" class="p-2 w-full border rounded-md shadow-sm" placeholder="John" required>
      </div>
      <div>
        <label for="email" class="text-sm font-medium text-gray-700">Adresse email*</label>
        <input type="email" id="email" name="email" class="p-2 w-full border rounded-md shadow-sm" placeholder="johndoe@gmail.com" required>
      </div>
      <div>
        <label for="telephone" class="text-sm font-medium text-gray-700">Téléphone</label>
        <input type="text" id="telephone" name="telephone" class="p-2 w-full border rounded-md shadow-sm" placeholder="Numéro de mobile">
      </div>
      <div>
        <label for="mdp" class="text-sm font-medium text-gray-700">Mot de passe*</label>
        <input type="password" id="mdp" name="mdp" class="p-2 w-full border rounded-md shadow-sm" required>
      </div>
      <div>
        <label for="confirm_mdp" class="text-sm font-medium text-gray-700">Confirmer le mot de passe*</label>
        <input type="password" id="confirm_mdp" name="confirm_mdp" class="p-2 w-full border rounded-md shadow-sm" required>
      </div>
    </div>
    <button type="submit" name="inscription" class="w-full py-2 px-4 bg-secondary-color text-white rounded-md shadow hover:bg-blue-600">
      S'inscrire
    </button>
  </form>
</div>
