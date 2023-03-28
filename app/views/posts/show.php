<div class="w-auto rounded-xl ml-80 -mt-16">
    <div class="container mx-auto px-4 mt-8">
        <div class="container">
            <h1  class="text-4xl overflow-hidden font-semibold text-blue-500 h-24 hover:underline hover:cursor-pointer"><?php echo htmlspecialchars($postDetails['title']); ?></h1>
            <img src="<?php echo htmlspecialchars($postDetails['image']); ?>" alt="Post image" class="w-full h-80 object-cover mb-1 rounded-xl mr-16" />
            <p class="my-8"><?php echo htmlspecialchars($postDetails['content']); ?></p>
            <p class="flex text-gray-400 my-4">Créé par: <?php echo htmlspecialchars($postDetails['creator_email']); ?></p>
            <p class="my-4">Créé le: <?php echo htmlspecialchars($postDetails['created_at']); ?></p>
            <p>Catégorie: <?php echo htmlspecialchars($postDetails['category']); ?></p>
        </div>
    </div>
</div>