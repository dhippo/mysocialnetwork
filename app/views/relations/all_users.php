<div class="w-auto rounded-xl ml-80 -mt-16">
    <div class="container mx-auto px-4 mt-8">

        <h3 class="text-center text-2xl font-semibold mt-6 mb-4">Liste des utilisateurs: </h3>

        <div class="grid grid-cols-4 gap-4 mx-6">
            <?php
            foreach ($allUsers as $user) {
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