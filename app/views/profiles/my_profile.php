<div class="w-auto rounded-xl ml-80 -mt-16">
<div class="container mx-auto px-4 mt-8">
    <h1 class="text-4xl font-bold mb-6">Mon profil</h1>
    <div class="bg-white shadow-md rounded-lg px-6 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="mb-4 md:mb-0">
                <h2 class="text-xl font-semibold mb-2 underline">Informations personnelles</h2>
                <ul class="text-gray-700">
                    <li class="mb-2"><strong>Prénom :</strong> <?php echo htmlspecialchars($userInfo['first_name']); ?></li>
                    <li class="mb-2"><strong>Nom :</strong> <?php echo htmlspecialchars($userInfo['last_name']); ?></li>
                    <li class="mb-2"><strong>Date de naissance :</strong> <?php echo htmlspecialchars($userInfo['birth_date']); ?></li>
                </ul>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-2 underline">Coordonnées</h2>
                <ul class="text-gray-700">
                    <li class="mb-2"><strong>Email :</strong> <?php echo htmlspecialchars($userInfo['email']); ?></li>
                </ul>
            </div>
            <div>
                <h2 class="text-xl font-semibold mb-2 underline">Ma photo de profil</h2>
                <img src="http://localhost:8888/mysocialnetwork/public/images/profile-images/<?php echo $_SESSION['profile_picture']  ?>" alt="Photo de profil" class="w-32 h-32 rounded-full object-cover">
            </div>
        </div>
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-2 underline">Détails du profil</h2>
            <ul class="text-gray-700">
                <li class="mb-2"><strong>Promo :</strong> <?php echo htmlspecialchars($userInfo['promo']); ?></li>
                <li class="mb-2"><strong>Statut :</strong> <?php echo htmlspecialchars($userInfo['statut']); ?></li>
                <li class="mb-2"><strong>Bio :</strong> <?php echo htmlspecialchars($userInfo['bio']); ?></li>
                <li class="mb-2"><strong>Centres d'intérêt :</strong> <?php echo htmlspecialchars($userInfo['interests']); ?></li>
            </ul>
        </div>
    </div>
    <div class="w-full flex justify-center">
        <a href="http://localhost:8888/mysocialnetwork/public/?page=modif_profile">
            <button type="button" class="rounded-md bg-gray-600 py-2.5 px-3.5 text-sm font-semibold text-white shadow-sm hover:p-4">Modifier mon profil</button>
        </a>
    </div>

    <h1 class="text-4xl font-bold mt-10 mb-6">Mes AMIS</h1>
    <div class="grid grid-cols-4 gap-4 mx-6">
        <?php
        foreach ($myFriends as $friend) {
            ?>
            <div class="border border-gray-300 rounded p-4 bg-white shadow w-full mx-auto mb-4 transform hover:scale-105 hover:border hover:border-blue-500 hover:border-3 transition duration-300">
                <img class="w-20 h-20 rounded-full mx-auto" src="http://localhost:8888/mysocialnetwork/public/images/profile-images/<?= $friend['profile_picture'] ?>" alt="friend photo">
                <h4 class="text-center mt-2 font-semibold hover:underline cursor-pointer">
                    <a href="?page=user_profile&email_user_to_see=<?php echo htmlspecialchars($friend['email']); ?>">
                        <?= $friend['first_name'] . ' ' . $friend['last_name'] ?>
                    </a>
                </h4>
                <p class="text-center text-sm text-blue-700"><?= $friend['statut'] . ' - Promo ' . $friend['promo'] ?></p>
            </div>
            <?php
        }
        ?>
    </div>



    <h1 class="text-4xl font-bold mt-10 mb-6">Mes Posts</h1>

    <div id="user_posts" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mx-6">
        <?php foreach ($userPosts as $post): ?>
        <div class="flex justify-center m-2">

            <div class="post bg-gradient-to-r w-full -p-4 from-blue-400 via-blue-500 to-blue-600 p-6 rounded-xl shadow-md border border-blue-200">
                <div class="p-2 rounded-xl bg-white h-full w-full flex flex-col justify-between">
                    <div class="bg-white rounded-xl p-2 m-2">
                        <h3 class="text-xl font-semibold text-blue-400 mb-2"><?php echo htmlspecialchars($post['title']); ?></h3>
                    </div>
                    <img src="http://localhost:8888/mysocialnetwork/public/images/post-images/<?php echo $post['image']; ?>" alt="Post image" class="w-full h-32 object-cover mb-1 rounded-xl" />
                    <p class="text-black mb-4"><?php echo htmlspecialchars($post['content']); ?></p>
                    <p class="text-sm text-blue-400 mb-1"><small>Créé le: <?php echo htmlspecialchars($post['created_at']); ?></small></p>
                    <p class="text-sm text-blue-400"><small>Catégorie: <?php echo htmlspecialchars($post['category']); ?></small></p>
                    <div class="mt-4 flex justify-end">
                        <a href="?page=edit_post&id_post=<?php echo htmlspecialchars($post['id_post']); ?>">
                            <button class="flex flex-row bg-blue-600 text-white text-sm ml-6 rounded-xl p-2 border border-2 border-black hover:opacity-50">
                                <span class="mr-4">Modifier un post</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php endforeach; ?>
    </div>

