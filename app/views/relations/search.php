<div class="w-auto rounded-xl ml-80 -mt-16">
    <div class="container mx-auto px-4 mt-8">

        <h3 class="text-center text-2xl font-semibold mt-6 mb-4">Liste des utilisateurs: </h3>

        <form class="relative flex flex-1 h-8 m-2 -pr-2" action="#" method="GET">
            <label for="search-user" class="sr-only">Rechercher</label>
            <svg class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-400 " viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
            </svg>
            <input type="search" id="search-user" name="search" value="" placeholder="Recherche..." class="block h-full w-full border-0 py-0 pl-8 pr-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm"/>
        </form>

        <div class="grid grid-cols-4 gap-4 mx-6">
            <?php
            foreach ($filteredUsers as $user) {
                ?>
                <div class="border border-gray-300 rounded p-4 bg-white shadow w-full mx-auto mb-4 transform hover:scale-105 hover:border hover:border-blue-500 hover:border-3 transition duration-300">
                    <img class="w-20 h-20 rounded-full mx-auto" src="http://localhost:8888/mysocialnetwork/public/images/profile-images/<?= $user['profile_picture'] ?>" alt="user photo">
                    <h4 class="text-center mt-2 font-semibold hover:underline cursor-pointer">
                        <a href="?page=user_profile&email_user_to_see=<?php echo htmlspecialchars($user['email']); ?>">
                            <?= $user['first_name'] . ' ' . $user['last_name'] ?>
                        </a>
                    </h4>
                    <p class="text-center text-sm text-blue-700"><?= $user['statut'] . ' - Promo ' . $user['promo'] ?></p>
                </div>
                <?php
            }
            ?>
        </div>

    </div>
</div>