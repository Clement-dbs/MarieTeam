<header class="flex justify-around text-center align-middle items-center NeueMontrealBold bg-blue-700 py-10 text-white">
    <a href="./?action=accueil"><h1 class="font-NeueMontrealBold text-4xl">MarieTeam</h1></a>
    <div class="NeueMontrealBold">

    <div class="flex text-left">
        <?php 
        
        if (isset($_SESSION['utilisateur']) && !empty($_SESSION['utilisateur'])) { ?>
            <div class="relative inline-block text-left">
                <div>
                    <button type="button" class="inline-flex w-full justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50" id="menu-button" aria-expanded="false" aria-haspopup="true" onclick="toggleMenu()">
                        <?php echo $_SESSION['utilisateur'][0]['prenom'] . " " . $_SESSION['utilisateur'][0]['nom']; ?>
                            <svg class="-mr-1 size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd" d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                            </svg>
                    </button>
                </div>

                <div id="dropdown-menu" class="absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none hidden" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <div class="py-1" role="none">
                            <button class="block w-full px-4 py-2 text-left text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-3">
                                <a href="./?action=profil" class="NeueMontrealBold">Profil</a>
                            </button>
                            <button class="block w-full px-4 py-2 text-left text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-3">
                                <a href="./?action=deconnexion" class="NeueMontrealBold">Déconnexion</a>
                            </button>
                            <button class="block w-full px-4 py-2 text-left text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-3">
                            <a href="#" class="NeueMontrealBold">Réservation</a>
                            </button>
                            <?php if(getAdminLevel() >= 1){?>
                            <button class="block w-full px-4 py-2 text-left text-sm text-gray-700" role="menuitem" tabindex="-1" id="menu-item-3">
                                <a href="./?action=dashboard" class="NeueMontrealBold">Admin</a>
                            </button>  
                            <?php } ?>
                </div>
            </div>
    </div>

    <?php } else { ?>

            <button type="button" class="flex w-full items-center justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                <a href="./?action=connexion" class="NeueMontrealBold">Connexion</a>
            </button>  
    
       <?php } ?>

    <script>
        function toggleMenu() {
            var menu = document.getElementById('dropdown-menu');
            var isHidden = menu.classList.contains('hidden');
        
            if (isHidden) {
                menu.classList.remove('hidden');
                menu.classList.add('block');
            } else {
                menu.classList.remove('block');
                menu.classList.add('hidden');
            }
        }
    </script>       
</header>