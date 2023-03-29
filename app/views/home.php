<div class=" w-auto rounded-xl ml-80 -mt-16">

    <div class="w-full">
        <div class="flex m-8">
            <h1 class="text-4xl mb-4 p-2 font-bold hover:underline hover:cursor-pointer">Actualité et Évènements de l'ECE</h1>
            <a href="?page=create">
                <button class="flex flex-row bg-white text-black text-xl ml-6 rounded-xl p-2 border border-2 border-black hover:opacity-50">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-10 h-10 mr-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <p  class="pt-1 font-bold pr-2" >Créer un post</p>

                </button>
            </a>
        </div>
        <!-- DEBUT DIV DES ANNONCES -->
        <div id="all_public_posts" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mx-6">
            <?php foreach ($publicPosts as $post): ?>
                <div class="flex justify-center m-2">
                    <div class="post bg-white p-6 rounded-xl shadow-md border border-gray-200 w-full">
                        <h3 class="text-xl overflow-hidden font-semibold text-blue-500 h-12 truncate -mb-2 hover:underline hover:cursor-pointer">
                            <a href="?page=show_post&id_post=<?php echo $post['id_post']; ?>">
                                <?php echo htmlspecialchars($post['title']); ?>
                            </a>
                        </h3>
                        <button class="flex flex-col justify-center h-6 text-white px-4 py-4 rounded-xl shadow-sm border-2 bg-gray-700 hover:opacity-100 text-sm mb-4 -ml-2 opacity-80"><a class="font-bold tracking-wider">Évennement</a></button>
                        <img src="http://localhost:8888/mysocialnetwork/public/images/post-images/<?php echo $post['image']; ?>" alt="Post image" class="w-full h-48 object-cover mb-1 rounded-xl" />
                        <div class="flex flex-col justify-between h-28">
                            <p class="text-xs text-black hover:underline hover:cursor-pointer">
                                <a href="?page=user_profile&email_user_to_see=<?php echo htmlspecialchars($post['creator_email']); ?>">
                                    <?php echo htmlspecialchars($post['creator_email']); ?>
                                </a>
                            </p>
                            <!--<div class="flex space-x-2">
                                <button class="bg-gradient-to-r w-1/3 from-blue-400 via-blue-500 to-blue-600 text-white px-4 py-2 rounded-xl shadow-xl border border-blue-200 hover:opacity-75">LIKE</button>
                                <button class="bg-white w-1/3 text-gray-700 px-4 py-2 rounded-xl shadow-md border-2 border-gray-300 hover:opacity-75">DISLIKE</button>
                            </div>-->
                            <div class="flex text-sm">
                                <p class="text-gray-400"><?php echo htmlspecialchars($post['created_at']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <!-- FIN DIV DES ANNONCES -->
    </div>

</div>