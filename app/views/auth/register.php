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
        <h1 class="text-3xl mb-4">Inscription</h1>
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
            <label class="block text-gray-700 text-sm font-bold mb-2" for="statut">
                Statut
            </label>
            <div class="flex flex-row">
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="statut" name="statut" onchange="updatePromoField(this.value)" required>
                <option value="Etudiant">Étudiant</option>
                <option value="Enseignant">Enseignant</option>
            </select>
            <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
            </svg>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="promo" id="promo_label">
                Promo
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="promo" name="promo" type="text" placeholder="Matière" style="display: none;" >
            <div class="flex flex-row">
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="promo_select" name="promo_select" required>
                <option value="Bachelor 1ère année">Bachelor 1ère année</option>
                <option value="Bachelor 2ème année">Bachelor 2ème année</option>
                <option value="Bachelor 3ème année">Bachelor 3ème année</option>
                <option value="Master 1ère année">Master 1ère année</option>
                <option value="Master 2ème année">Master 2ème année</option>
                <option value="Ingénieur 1ère année">Ingénieur 1ère année</option>
                <option value="Ingénieur 2ème année">Ingénieur 2ème année</option>
                <option value="Ingénieur 3ème année">Ingénieur 3ème année</option>
                <option value="Ingénieur 4ème année">Ingénieur 4ème année</option>
                <option value="Ingénieur 5ème année">Ingénieur 5ème année</option>
            </select>
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="birth_date">
                Date de naissance
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="birth_date" name="birth_date" type="date" required>
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

<script>
    function updatePromoField(status) {
        const promoLabel = document.getElementById("promo_label");
        const promoField = document.getElementById("promo");
        const promoSelect = document.getElementById("promo_select");

        if (status === "Etudiant") {
            promoLabel.innerText = "Promo";
            promoField.style.display = "none";
            promoSelect.style.display = "block";
        } else if (status === "Enseignant") {
            promoLabel.innerText = "Les promos dans lesquelles vous enseignez";
            promoField.style.display = "block";
            promoSelect.style.display = "none";

        }
    }
</script>
</body>
</html>
