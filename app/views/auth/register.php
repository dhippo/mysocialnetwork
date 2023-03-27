<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription à ECEBOOK</title>
    <script src='https://cdn.tailwindcss.com'></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<div class="w-full max-w-sm mx-auto mt-20">
    <form action="?page=register" method="POST" class="bg-white shadow-md rounded-3xl px-8 pt-6 pb-8 mb-4" enctype="multipart/form-data">
        <h1 class="text-3xl mb-8">Inscription</h1>
        <input type="hidden" name="action" value="register">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                Email
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" type="email" placeholder="Email" required>
        </div>

        <div class="flex flex-row">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="first_name">
                Prénom
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="first_name" name="first_name" type="text" placeholder="Prénom" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="last_name">
                Nom
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="last_name" name="last_name" type="text" placeholder="Nom" required>
        </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                Mot de passe
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" name="password" placeholder="Mot de passe:" id="password" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm_password">
                Confirmer le mot de passe
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" name="confirm_password" placeholder="Confirmer le mot de passe:" id="confirm_password" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="promo">
                Promo
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="promo" name="promo" type="text" placeholder="Promo" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="statut">
                Statut
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="statut" name="statut" type="text" placeholder="Statut" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="birth_date">
                Date de naissance
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="birth_date" name="birth_date" type="date" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="avatar_selection">
                Choisir un avatar
            </label>
            <div class="flex items-center space-x-4 h-32 w-32 -ml-16">
                <label class="flex items-center h-32 w-32 flex-column">
                    <input type="radio" class="form-radio ml-16 " name="avatar_selection" value="buste-femme.png" checked>F
                    <img class="h-32 w-32 rounded-full ml-8 object-cover" src="http://localhost:8888/mysocialnetwork/public/images/avatars/buste-femme.png" alt="Avatar femme">
                </label>
                <label class="flex items-center h-32 w-32 flex-row">
                    <input type="radio" class="form-radio ml-16" name="avatar_selection" value="buste-homme.png">H
                    <img class="h-32 w-32 rounded-full ml-8 object-cover" src="http://localhost:8888/mysocialnetwork/public/images/avatars/buste-homme.png" alt="Avatar homme">
                </label>
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="profile_picture">
                Ou déposez votre propre image
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="profile_picture" name="profile_picture" type="file">
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                S'inscrire
            </button>
            <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="?page=login">
                Se connecter
            </a>
        </div>
    </form>
</div>
</body>
</html>
