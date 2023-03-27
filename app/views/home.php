<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src='https://cdn.tailwindcss.com'></script>
</head>

<body class="bg-white">


<!-- DEBUT DIV DES ANNONCES -->
<div id="all_public_posts" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mx-6">
    <?php foreach ($publicPosts as $post): ?>
    <div class="flex justify-center p-4 m-2">
        <div class="post bg-gradient-to-r w-4/5 p-2 from-blue-400 via-blue-500 to-blue-600 p-6 rounded-xl shadow-md border border-blue-200">
            <div class="bg-white rounded-xl p-2 m-2">
                <h3 class="text-xl font-semibold text-blue-400 mb-2"><?php echo htmlspecialchars($post['title']); ?></h3>
            </div>
            <p class="text-white mb-4"><?php echo htmlspecialchars($post['content']); ?></p>
            <p class="text-sm text-blue-100 mb-1"><small>Créé par: <?php echo htmlspecialchars($post['creator_email']); ?></small></p>
            <p class="text-sm text-blue-100 mb-1"><small>Créé le: <?php echo htmlspecialchars($post['created_at']); ?></small></p>
            <p class="text-sm text-blue-100"><small>Catégorie: <?php echo htmlspecialchars($post['category']); ?></small></p>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- FIN DIV DES ANNONCES -->

</body>

</html>
