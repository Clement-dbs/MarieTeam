<div class="flex h-screen">
  <aside class="bg-gray-800 text-white w-64 p-4">
    <?php include 'Vue/sidebarrePanel.php';?>
  </aside>

  <!-- Main Content -->
  <main class="flex-1 p-6">
    <h2 id="dashboard" class="text-3xl font-bold text-gray-800 mb-4">
      Bonjour <?php echo $_SESSION['utilisateur'][0]['nom'] . " " . $_SESSION['utilisateur'][0]['prenom']; ?>
    </h2>
    
    <!-- Grid layout for the cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Card 1 -->
      <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col h-full">
        <h3 class="text-xl font-semibold mb-4">Statistiques</h3>
        <p class="text-gray-600">
          Nombre d'utilisateurs : 
          <span class="text-green-500 font-bold"><?php adminNbUtilisateurs();?></span>
        </p>
        <p class="text-gray-600">
          Nombre de réservations : 
          <span class="text-green-500 font-bold"><?php adminNbResa();?></span>
        </p>
        <p class="text-gray-600">
          Nombre de périodes : 
          <span class="text-green-500 font-bold"><?php adminNbperiode();?></span>
        </p>
        <p class="text-gray-600">
          Nombre de tarifs : 
          <span class="text-green-500 font-bold"><?php adminNbTarif();?></span>
        </p>
        <p class="text-gray-600">
          Nombre de bateaux : 
          <span class="text-green-500 font-bold"><?php adminNbBateau();?></span>
        </p>
      </div>
      
      <!-- Card 2 -->
      <div class="bg-white shadow-lg rounded-lg p-6 flex flex-col h-full">
        <h3 class="text-xl font-semibold mb-4">Activité récente</h3>
        <ul class="space-y-2">
          <li class="text-gray-600">Dernier utilisateur enregistré : <span class="font-bold"><?php lastUser();?></span></li>
          <li class="text-gray-600">Mise à jour des paramètres système.</li>
        </ul>
      </div>
    </div>
  </main>
</div>
