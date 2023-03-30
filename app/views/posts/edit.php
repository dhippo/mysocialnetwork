
<div class="w-auto rounded-xl ml-80 -mt-16">
    <div class="container mx-auto px-4 mt-8">
<form class="border border-2 border-gray_200" action="?page=edit_post&id_post=<?php echo $postInfo['id_post']; ?>" method="POST" enctype="multipart/form-data">
    <div class="bg-white shadow-md rounded-lg px-6 py-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="mb-4 md:mb-0">
                <h2 class="text-xl font-semibold mb-2">Modifier le post</h2>
                <label for="title">Titre :</label>
                <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($postInfo['title']); ?>" class="w-full mb-2">

                <label for="content">Contenu :</label>
                <textarea name="content" id="content" rows="4" class="w-full mb-2"><?php echo htmlspecialchars($postInfo['content']); ?></textarea>

                <div>
                    <label for="image">Modifier l'image de l'article :</label>
                    <input type="file" name="image" id="image" class="w-full mb-2">
                </div>

                <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Catégorie:</label>
                <select name="category" id="category" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                    <option value="event">Événement</option>
                    <option value="news">Actualité</option>
                    <option value="other">Autre</option>
                </select>


                <label for="visibility">Visibilité :</label>
                <select name="visibility" id="visibility" class="w-full mb-2">
                    <option value="public" <?php echo $postInfo['visibility'] == 'public' ? 'selected' : ''; ?>>Public</option>
                    <option value="private" <?php echo $postInfo['visibility'] == 'private' ? 'selected' : ''; ?>>Privé</option>
                </select>
            </div>
        </div>
    </div>
    <div class="w-full flex justify-center mt-4">
        <button type="submit" name="submit" class="rounded-md bg-gray-600 py-2.5 px-3.5 text-sm font-semibold text-white shadow-sm hover:p-4">Enregistrer les modifications</button>
        <button type="submit" name="delete" class="rounded-md bg-red-600 py-2.5 px-3.5 text-sm font-semibold text-white shadow-sm hover:p-4">Supprimer</button>
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