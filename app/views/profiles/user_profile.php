<div class="w-auto rounded-xl ml-80 -mt-16">
    <div class="container mx-auto px-4 mt-8">

        <div class="bg-white shadow-md rounded-lg px-6 py-8 border">
            <div class="w-1/2 flex justify-between">
                <h1 class="text-4xl font-bold mb-6">Profil de <?php echo htmlspecialchars($userProfileInfo['first_name']) . " " . htmlspecialchars($userProfileInfo['last_name']); ?></h1>
                <img src="http://localhost:8888/mysocialnetwork/public/images/profile-images/<?php echo $userProfileInfo['profile_picture']  ?>" alt="Photo de profil" class="w-32 h-32 rounded-full object-cover">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <form action="?page=ask_friend" method="post" class="w-full mt-4 mb-4">
                        <?php if ($_SESSION['id_user'] == $userProfileId): ?>
                            <div class="bg-red-400 text-white font-semibold px-4 py-2 rounded-lg shadow-md flex justify-between">
                                Il s'agit de votre compte
                                <a href="?page=my_friends" class="text-red-900 hover:text-white underline">Voir mes amis</a>
                            </div>
                        <?php else: ?>
                            <input type="hidden" name="friend_email" value="<?php echo htmlspecialchars($userProfileInfo['email']); ?>">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                                Ajouter en ami
                            </button>
                        <?php endif; ?>
                    </form>
                    <h2 class="text-xl font-semibold mb-2 underline">Coordonnées</h2>
                    <ul class="text-gray-700">
                        <li class="mb-2"><strong>Email :</strong> <?php echo htmlspecialchars($userProfileInfo['email']); ?></li>
                    </ul>
                </div>
            </div>
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-2 underline">Détails du profil</h2>
                <ul class="text-gray-700">
                    <li class="mb-2"><strong>Promo :</strong> <?php echo htmlspecialchars($userProfileInfo['promo']); ?></li>
                    <li class="mb-2"><strong>Statut :</strong> <?php echo htmlspecialchars($userProfileInfo['statut']); ?></li>
                    <li class="mb-2"><strong>Bio :</strong> <?php echo htmlspecialchars($userProfileInfo['bio']); ?></li>
                    <li class="mb-2"><strong>Centres d'intérêt :</strong> <?php echo htmlspecialchars($userProfileInfo['interests']); ?></li>
                </ul>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg px-6 py-8 mt-10 border">
            <div class="flex justify-between flex-col">
                <h1 class="text-4xl font-bold mb-6">Posts de <?php echo htmlspecialchars($userProfileInfo['first_name']) . " " . htmlspecialchars($userProfileInfo['last_name']); ?></h1>

                <div id="user_posts" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mx-6">
                <?php foreach ($userPosts as $post): ?>
                    <div class="m-2">

                        <div class="post bg-gradient-to-r w-full -p-4 from-blue-400 via-blue-500 to-blue-600 p-6 rounded-xl shadow-md border border-blue-200">
                            <div class="p-2 rounded-xl bg-white h-full w-full flex flex-col justify-between">
                                <div class="bg-white rounded-xl p-2 m-2">
                                    <h3 class="text-xl font-semibold text-blue-400 mb-2 hover:underline">
                                        <a href="?page=show_post&id_post=<?php echo $post['id_post']; ?>">
                                            <?php echo htmlspecialchars($post['title']); ?>
                                        </a>
                                    </h3>
                                </div>
                                <img src="http://localhost:8888/mysocialnetwork/public/images/post-images/<?php echo $post['image']; ?>" alt="Post image" class="w-full h-32 object-cover mb-1 rounded-xl" />
                                <p class="text-black mb-4"><?php echo htmlspecialchars($post['content']); ?></p>
                                <p class="text-sm text-blue-100 mb-1"><small>Créé le: <?php echo htmlspecialchars($post['created_at']); ?></small></p>
                                <p class="text-sm text-blue-100"><small>Catégorie: <?php echo htmlspecialchars($post['category']); ?></small></p>

                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
</div>
