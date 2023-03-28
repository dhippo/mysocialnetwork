<div class="bg-gray-100 w-1/2 rounded-xl     flex justify-end ml-96 -mt-16">
<div class="container mx-auto px-4 mt-8" >
    <h1 class="text-3xl font-bold mb-6">Modifier mon profil</h1>
    <form action="?page=modif_profile" method="POST" enctype="multipart/form-data">
        <div class="bg-white shadow-md rounded-lg px-6 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="mb-4 md:mb-0">
                    <h2 class="text-xl font-semibold mb-2">Informations personnelles</h2>
                    <label for="first_name">Prénom :</label>
                    <input type="text" name="first_name" id="first_name" value="<?php echo htmlspecialchars($userInfo['first_name']); ?>" class="w-full mb-2">

                    <label for="last_name">Nom :</label>
                    <input type="text" name="last_name" id="last_name" value="<?php echo htmlspecialchars($userInfo['last_name']); ?>" class="w-full mb-2">

                    <label for="birth_date">Date de naissance :</label>
                    <input type="date" name="birth_date" id="birth_date" value="<?php echo htmlspecialchars($userInfo['birth_date']); ?>" class="w-full mb-2">
                </div>
                <div>
                    <h2 class="text-xl font-semibold mb-2">Coordonnées</h2>
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($userInfo['email']); ?>" class="w-full mb-2">
                </div>
                <div>
                    <h2 class="text-xl font-semibold mb-2">Photo de profil</h2>
                    <label for="profile_picture">Modifier la photo :</label>
                    <input type="file" name="profile_picture" id="profile_picture" class="w-full mb-2">
                </div>
            </div>
            <div class="mt-8">
                <h2 class="text-xl font-semibold mb-2">Détails du profil</h2>
                <label for="promo">Promo :</label>
                <input type="text" name="promo" id="promo" value="<?php echo htmlspecialchars($userInfo['promo']); ?>" class="w-full mb-2">

                <label for="statut">Statut :</label>
                <input type="text" name="statut" id="statut" value="<?php echo htmlspecialchars($userInfo['statut']); ?>" class="w-full mb-2">

                <label for="bio">Bio :</label>
                <textarea name="bio" id="bio" rows="4" class="w-full mb-2"><?php echo htmlspecialchars($userInfo['bio']); ?></textarea>

                <label for="interests">Centres d'intérêt :</label>
                <input type="text" name="interests" id="interests" value="<?php echo htmlspecialchars($userInfo['interests']); ?>" class="w-full mb-2">
            </div>
        </div>
        <div class="w-full flex justify-center mt-4">
            <button type="submit" name="submit" class="rounded-md bg-gray-600 py-2.5 px-3.5 text-sm font-semibold text-white shadow-sm hover:p-4">Enregistrer les modifications</button>
        </div>
    </form>
</div>
</div>
<style>
    input, textarea {
        border: 2px solid #e2e8f0;
        border-radius: 0.25rem;
        padding: 0.5rem;
    }

</style>

