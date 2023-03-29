<div class="w-auto rounded-xl ml-80 -mt-16">
    <div class="container mx-auto px-4 mt-8">



        <div class="bg-white shadow-md rounded-lg px-6 py-8">
            <div class="w-1/2 flex justify-between">
                <h1 class="text-4xl font-bold mb-6">Profil de <?php echo htmlspecialchars($userProfileInfo['first_name']) . " " . htmlspecialchars($userProfileInfo['last_name']); ?></h1>
                <img src="http://localhost:8888/mysocialnetwork/public/images/profile-images/<?php echo $userProfileInfo['profile_picture']  ?>" alt="Photo de profil" class="w-32 h-32 rounded-full object-cover">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <form action="?page=ask_friend" method="post" class="w-full mt-4 mb-4">
                        <input type="hidden" name="friend_email" value="<?php echo htmlspecialchars($userProfileInfo['email']); ?>">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                            Ajouter en ami
                        </button>
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
    </div>
</div>