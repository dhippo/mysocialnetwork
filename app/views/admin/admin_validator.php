<div class="w-auto rounded-xl ml-80 -mt-16">
    <div class="container mx-auto px-4 mt-8">
        <div class="container mx-auto px-4 mt-8">
            <h3 class="text-center text-2xl font-semibold mt-6 mb-4">Liste des utilisateurs: </h3>
            <div class="mb-4 p-5 bg-blue-200 rounded-xl">
                <a href="?page=admin_all_users" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Afficher tous</a>
                <a href="?page=admin_new_users" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Nouveaux utilisateurs</a>
                <a href="?page=admin_validated_users" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Utilisateurs accordée au site</a>
                <a href="?page=admin_blocked_users" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Utilisateurs bloqués</a>
            </div>
        </div>
        <div>
            <h3 class="text-center text-2xl font-semibold mt-6 mb-4">Liste des utilisateurs: </h3>

            <div class="grid grid-cols-4 gap-4 mx-6">
                <?php
                foreach ($allUsers as $user) {
                    ?>
                    <div class="border border-gray-300 rounded p-4 bg-white shadow w-full mx-auto mb-4 transform hover:scale-105 hover:border hover:border-blue-500 hover:border-3 transition duration-300">
                        <img class="w-20 h-20 rounded-full mx-auto" src="http://localhost:8888/mysocialnetwork/public/images/profile-images/<?= $user['profile_picture'] ?>" alt="user photo">                        <h4 class="text-center mt-2 font-semibold hover:underline cursor-pointer">
                            <a href="?page=user_profile&email_user_to_see=<?php echo htmlspecialchars($user['email']); ?>">
                                <?= $user['first_name'] . ' ' . $user['last_name'] ?>
                            </a>
                        </h4>
                        <p class="text-center text-sm text-blue-700"><?= $user['statut'] . ' - Promo ' . $user['promo'] ?></p>

                        <?php if ($user['is_blocked'] == 0) { ?>
                            <?php if ($user['validated'] == 0) { ?>
                                <a href="?page=admin_validate_user&id=<?= $user['id_user'] ?>&action=validate" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mb-2 inline-block">VALIDER LE COMPTE A ECEBOOK</a>
                            <?php } else { ?>
                                <a href="?page=admin_validate_user&id=<?= $user['id_user'] ?>&action=deny" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mb-2 inline-block">INTERDIRE LE COMPTE</a>
                            <?php } ?>
                            <a href="?page=admin_block_user&id=<?= $user['id_user'] ?>&action=block" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded inline-block">BLOQUER</a>
                        <?php } else { ?>
                            <span class="bg-gray-500 text-white font-bold py-1 px-2 rounded mb-2 inline-block">VALIDER LE COMPTE A ECEBOOK</span>
                            <span class="bg-gray-500 text-white font-bold py-1 px-2 rounded inline-block">INTERDIRE LE COMPTE</span>
                        <?php } ?>
                    </div>
                    <?php
                }
                ?>
            </div>

        </div>
    </div>
</div>


