<div class="w-auto rounded-xl ml-80 -mt-16">
    <div class="container mx-auto px-4 mt-8">
        <div class="container">
            <h1  class="text-4xl overflow-hidden font-semibold text-blue-500 h-12 hover:underline hover:cursor-pointer"><?php echo htmlspecialchars($postDetails['title']); ?></h1>
            <img src="http://localhost:8888/mysocialnetwork/public/images/post-images/<?php echo $postDetails['image']; ?>" alt="Post image" class="w-full h-[32rem] object-cover  mb-1 rounded-xl mr-16" />
<!--            <img src="<?php /*echo htmlspecialchars($postDetails['image']); */?>" alt="Post image" class="w-full h-80 object-cover mb-1 rounded-xl mr-16" />
-->            <p class="my-8"><?php echo htmlspecialchars($postDetails['content']); ?></p>
            <p class="flex text-gray-400 my-4">Créé par: <?php echo htmlspecialchars($postDetails['creator_email']); ?></p>
            <p class="my-4">Créé le: <?php echo htmlspecialchars($postDetails['created_at']); ?></p>
            <p>Catégorie: <?php echo htmlspecialchars($postDetails['category']); ?></p>

            <form action="?page=add_like&id_post=<?php echo $postDetails['id_post']; ?>" method="post" class="w-full mt-4 mb-4">

                <input type="hidden" name="friend_email" value="<?php echo htmlspecialchars($postDetails['id_post']); ?>">
                <button type="submit" name="like" value="1" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                    like
                </button>
                <?php echo $postDetails['likes']/2; ?>
            </form>
            <form action="?page=add_dislike&id_post=<?php echo $postDetails['id_post']; ?>" method="post" class="w-full mt-4 mb-4">
                <button type="submit" name="dislike" value="1" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                    dislike
                </button>
                <?php echo $postDetails['dislikes']/2; ?>
            </form>


        </div>
    </div>
</div>