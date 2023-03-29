<div class="w-auto rounded-xl ml-80 -mt-16">
    <div class="container mx-auto px-4 mt-8">

<!--        <h3 class="text-center text-2xl font-semibold mt-6 mb-4">Liste des utilisateurs: </h3>-->

        <h3 class="text-center text-2xl font-semibold mt-6 mb-4">Liste des utilisateurs: </h3>
        <button class="bg-gradient-to-r from-green-600 to-yellow-900 text-white font-semibold px-6 py-2 rounded-md shadow hover:shadow-lg transition-all duration-300 mb-10">
            <a href="admin.php" class="text-sm hover:text-gray-200">menu administrateur</a>
        </button>

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
                    <p class="text-center text-sm text-blue-700"><br> <?= $user['statut'] . ' - Promo ' . $user['promo'] ?></p>
                    <p class="text-center text-sm text-blue-700"><br> <?= ' bio:  ' . $user['bio'] ?></p>
                    <p class="text-center text-sm text-grey-700"><br> <?= ' birth_date:  ' . $user['birth_date'] ?></p>
                    <p class="text-center text-sm text-grey-700"><br> <?= ' profile_picture:  ' . $user['profile_picture'] ?></p>
                    <p class="text-center text-sm text-grey-700"><br> <?= ' interests:  ' . $user['interests'] ?></p>
                    <p class="text-center text-sm text-red-700"><br> <?= ' validated:  ' . $user['validated'] ?></p>
                    <p class="text-center text-sm text-red-700"><br> <?= ' is_blocked:  ' . $user['is_blocked'] ?></p>

                    <?php if ($user['validated'] == 0) { ?>
                        <button type="submit" name="valider"class="mt-2 w-full bg-gradient-to-r from-blue-700 to-blue-400 text-white py-2 px-4 rounded font-bold shadow-md hover:shadow-lg transition duration-300">
                            Valider
                        </button>
                    <?php }else{ ?>
                    <button type="submit" name="bloquer" class="mt-2 w-full bg-gradient-to-r from-red-700 to-red-400 text-white py-2 px-4 rounded font-bold shadow-md hover:shadow-lg transition duration-300">
                        Bloquer
                    </button>
                </div>

            <?php } ?>
        </div>
        <?php } ?>




    </div>
</div>