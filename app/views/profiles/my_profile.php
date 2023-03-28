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


    <h1 class="text-4xl font-bold mt-10 mb-6">Mes Posts</h1>

    <div id="user_posts" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mx-6">
        <?php foreach ($userPosts as $post): ?>
        <div class="flex justify-center m-2">

            <div class="post bg-gradient-to-r w-full -p-4 from-blue-400 via-blue-500 to-blue-600 p-6 rounded-xl shadow-md border border-blue-200">
                <div class="p-2 rounded-xl bg-white h-full w-full">
                    <div class="bg-white rounded-xl p-2 m-2">
                        <h3 class="text-xl font-semibold text-blue-400 mb-2"><?php echo htmlspecialchars($post['title']); ?></h3>
                    </div>
                    <p class="text-black mb-4"><?php echo htmlspecialchars($post['content']); ?></p>
                    <p class="text-sm text-blue-100 mb-1"><small>Créé le: <?php echo htmlspecialchars($post['created_at']); ?></small></p>
                    <p class="text-sm text-blue-100"><small>Catégorie: <?php echo htmlspecialchars($post['category']); ?></small></p>
                    <div class="mt-4 flex justify-end">
                        <a href="?page=edit_post&id=<?php echo htmlspecialchars($post['id_post']); ?>">
                            <button class="bg-yellow-400 text-white text-3xl p-2 rounded-xl border border-2 border-black hover:opacity-50">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-6 h-6">
                                    <path d="M16.2996 1.79981C16.8082 2.30839 16.9996 2.99984 16.9996 3.74984C16.9996 4.49984 16.8082 5.19129 16.2996 5.69987L5.49961 16.4999L1.99961 17.9999L3.49961 14.4999L14.2996 3.69987C14.8082 3.19129 15.4996 2.99984 16.2496 2.99984C16.9996 2.99984 17.6911 3.19129 18.1996 3.69987C19.3162 4.81653 19.3162 6.68323 18.1996 7.79989L7.39961 18.5999C7.61615 18.8164 7.83318 19.0334 8.04973 19.2499C9.29961 20.4998 11.2496 20.4998 12.4996 19.2499L19.2496 12.4999C20.4996 11.2499 20.4996 9.29987 19.2496 8.04987L11.4996 0.29987C10.2496 -0.950117 8.29961 -0.950117 7.04961 0.29987C6.83307 0.516421 6.61653 0.733464 6.39961 0.949873L17.1996 1.74984L16.2996 1.79981Z"></path>
                                </svg>
                            </button>
                            <button class="flex flex-row bg-blue-600 text-white text-3xl ml-6 rounded-xl p-2 border border-2 border-black hover:opacity-50">
                                <span class="mr-4">Modifier un post</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php endforeach; ?>
    </div>
