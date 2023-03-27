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
    <div class="w-screen h-screen flex items-center justify-center">
        <div class="w-full max-w-xs">
            <form action="" method="post" class="bg-white rounded-3xl shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <h1 class="text-3xl">Se connecter</h1>
                <a href="?page=register" class="text-sm underline pb-8">je ne suis pas inscrit</a>
                <div class="mb-4 pt-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="email" name="email" placeholder="Email:" id="email" required>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="mdp">
                        Mot de passe
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="password" name="password" placeholder="Mot de passe:" id="password" required>
                </div>
                <div class="flex items-center justify-between  cursor-pointer">
                    <input class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer" type="submit" value="Connexion" name="boot">
                </div>
            </form>
        </div>
    </div>
</body>
</html>