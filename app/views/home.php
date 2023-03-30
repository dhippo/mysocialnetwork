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
        <div class="w-full mb-8 ml-4 rounded-xl bg-gray-100 p-4">
            <h1 class="text-4xl font-bold hover:underline hover:cursor-pointer mb-1 ml-6">Filtres</h1>
            <p class="mb-2 ml-6">choisir des posts uniquement de la catégorie: </p>
            <div class="flex mb-2">
                <a href="?page=home&category=event">
                    <button class="flex flex-row bg-white text-black text-xl ml-6 rounded-xl p-2 border border-2 border-black hover:opacity-50">
                        <span class="font-bold pr-2">ÉVÈNEMENTS</span>
                    </button>
                </a>
                <a href="?page=home&category=news">
                    <button class="flex flex-row bg-white text-black text-xl ml-6 rounded-xl p-2 border border-2 border-black hover:opacity-50">
                        <span class="font-bold pr-2">ACTUALITÉS</span>
                    </button>
                </a>
                <a href="?page=home&category=other">
                    <button class="flex flex-row bg-white text-black text-xl ml-6 rounded-xl p-2 border border-2 border-black hover:opacity-50">
                        <span class="font-bold pr-2">GÉNÉRAL</span>
                    </button>
                </a>
                <a href="?page=home&category=teacher">
                    <button class="flex flex-row bg-white text-black text-xl ml-6 rounded-xl p-2 border border-2 border-black hover:opacity-50">
                        <span class="font-bold pr-2">ENSEIGNANT</span>
                    </button>
                </a>
                <a href="?page=home&category=student">
                    <button class="flex flex-row bg-white text-black text-xl ml-6 rounded-xl p-2 border border-2 border-black hover:opacity-50">
                        <span class="font-bold pr-2">ÉLÈVE</span>
                    </button>
                </a>
            </div>
        </div>
        <!-- DEBUT DIV DES ANNONCES -->
        <div id="all_public_posts" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mx-6">
            <?php foreach ($publicPosts as $post): ?>

                <div class="flex justify-center m-2">
                    <div class="post bg-white p-4 rounded-xl shadow-md border border-gray-200 w-full">
                        <h3 class="text-xl overflow-hidden font-semibold text-blue-500 h-12 truncate -mb-2 hover:underline hover:cursor-pointer">
                            <a href="?page=show_post&id_post=<?php echo $post['id_post']; ?>">
                                <?php echo htmlspecialchars($post['title']); ?>
                            </a>
                        </h3>
                        <?php if ($post['category'] == 'event'): ?>
                            <button class="flex flex-col justify-center h-6 text-white px-4 py-4 rounded-xl shadow-sm border-2 bg-blue-900 hover:opacity-100 text-sm mb-4">
                                <a class="font-bold tracking-wider">Évènement</a>
                            </button>
                        <?php elseif ($post['category'] == 'news'): ?>
                            <button class="flex flex-col justify-center h-6 px-4 py-4 rounded-xl shadow-sm border border-2 border-blue-900 bg-white text-blue-900 hover:opacity-100 text-sm mb-4">
                                <a class="font-bold tracking-wider">Actualité</a>
                            </button>
                        <?php else: ?>
                            <button class="flex flex-col justify-center h-6 text-white px-4 py-4 rounded-xl shadow-sm border-2 border-gray-700 bg-gray-700 hover:opacity-100 text-sm mb-4 ">
                                <a class="font-bold tracking-wider">Général</a>
                            </button>
                        <?php endif; ?>
                        <img src="http://localhost:8888/mysocialnetwork/public/images/post-images/<?php echo $post['image']; ?>" alt="Post image" class="w-full h-52 object-cover mb-1 rounded-xl" />
                        <div class="flex flex-col justify-between h-32">
                            <p class="text-xs text-black hover:underline hover:cursor-pointer my-2">
                                <a href="?page=user_profile&email_user_to_see=<?php echo htmlspecialchars($post['creator_email']); ?>">
                                    <?php echo htmlspecialchars($post['creator_email']); ?>
                                </a>
                            </p>
                            <!--<p class="text-sm text-gray-500 overflow-hidden h-16 truncate my-2">
                                <?php /*echo htmlspecialchars($post['content']); */?>
                            </p>
                            <p class="text-sm text-gray-500 overflow-hidden h-16 truncate my-2">
                                <a href="?page=show_post&id_post=<?php /*echo $post['id_post']; */?>">
                                    Voir plus
                                </a>
                            </p>-->
                            <div class="flex justify-between items-center mt-4 my-2">
                                <div class="text-xl text-gray-500">
                                    <span class="mr-2"><?php echo $post['likes']/2; ?> likes</span>
                                    <span><?php echo $post['dislikes']/2; ?> dislikes</span>
                                </div>
                            </div>
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