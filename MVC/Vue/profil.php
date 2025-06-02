    <div class="max-w-4xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-800">Nom</h2>
                <p class="text-gray-600"><?= $_SESSION['utilisateur'][0]['prenom'] . ' ' . $_SESSION['utilisateur'][0]['nom']; ?></p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-800">Téléphone</h2>
                <p class="text-gray-600"><?= $_SESSION['utilisateur'][0]['telephone']; ?></p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <h2 class="text-xl font-semibold text-gray-800">Email</h2>
                <p class="text-gray-600"><?= $_SESSION['utilisateur'][0]['email'] ?></p>
            </div>
        </div>
        <div class="text-center mt-8">
            <a href="./?action=editProfil" class="bg-blue-500 text-white px-6 py-2 rounded-lg shadow-md hover:bg-blue-600">Modifier le Profil</a>
        </div>
    </div>

