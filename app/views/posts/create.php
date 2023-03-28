<div class="w-auto rounded-xl ml-80 -mt-16">
    <div class="container mx-auto px-4 mt-8">
        <div class="container mx-auto mt-10">
            <h1 class="text-center text-3xl mb-5">Créer un nouveau post</h1>
            <form action="?page=create" method="post" enctype="multipart/form-data" class="w-full max-w-lg mx-auto">
                <div class="py-2">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Titre:</label>
                    <input type="text" name="title" id="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="py-2">
                    <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Contenu:</label>
                    <textarea name="content" id="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-56" required></textarea>
                </div>
                <div class="py-2">
                    <label for="image" class="block text-gray-700 text-sm font-bold mb-2">Image (optionnel):</label>
                    <input type="file" name="image" id="image" class="text-gray-700">
                </div>
                <div class="py-2">
                    <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Catégorie:</label>
                    <select name="category" id="category" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="event">Événement</option>
                        <option value="news">Nouvelles</option>
                        <option value="other">Autre</option>
                    </select>
                </div>
                <div class="py-2">
                    <label for="visibility" class="block text-gray-700 text-sm font-bold mb-2">Visibilité:</label>
                    <select name="visibility" id="visibility" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                        <option value="public">Public</option>
                        <option value="private">Privé</option>
                    </select>
                </div>
                <div class="flex items-center justify-between">
                    <input type="submit" name="submit" value="Créer" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 px-4 rounded focus:outline-none focus:shadow-outline cursor-pointer">
                </div>
            </form>
        </div>
    </div>
</div>

