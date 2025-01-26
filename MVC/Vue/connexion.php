 <div class="flex items-center flex-col my-10">
  <h2 class="text-2xl font-semibold text-center text-gray-800 mb-6">Formulaire de connexion</h2>
  <form action="./?action=connexion" method="POST" class=" rounded-lg shadow-md p-8">
    <div class="flex flex-col">
        <div class="my-5">
        <label for="email" class="block text-sm font-medium text-gray-700">Identifiant</label>
        <input type="text" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
        </div>
    
        <div class="my-5">
        <label for="mdp" class="block text-sm font-medium text-gray-700">Mot de passe</label>
        <input type="password" id="mdp" name="mdp" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
        </div>
    </div>

    <div>
      <button type="submit" name="connexion" class="w-full py-2 px-4 bg-secondary-color text-white rounded-md shadow hover:bg-blue-600">Connexion</button>
    </div>

    
    <div class="my-5">
        <span>Pas encore membre ? <a href="./?action=inscription" class="text-blue-500">S'inscrire</a></span>
    </div>

  </form>
</div>
