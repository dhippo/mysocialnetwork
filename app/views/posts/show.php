<div class="w-auto rounded-xl ml-80 -mt-16">
    <div class="container mx-auto px-4 mt-8">
        <div class="container">
            <h1  class="text-4xl overflow-hidden font-semibold text-blue-500 h-24 hover:underline hover:cursor-pointer"><?php echo htmlspecialchars($postDetails['title']); ?></h1>
            <img src="http://localhost:8888/mysocialnetwork/public/images/post-images/<?php echo $postDetails['image']; ?>" alt="Post image" class="w-full h-[32rem] object-cover  mb-1 rounded-xl mr-16" />
<!--            <img src="<?php /*echo htmlspecialchars($postDetails['image']); */?>" alt="Post image" class="w-full h-80 object-cover mb-1 rounded-xl mr-16" />
-->            <p class="my-8"><?php echo htmlspecialchars($postDetails['content']); ?></p>
            <p class="flex text-gray-400 my-4">Créé par: <?php echo htmlspecialchars($postDetails['creator_email']); ?></p>
            <p class="my-4">Créé le: <?php echo htmlspecialchars($postDetails['created_at']); ?></p>
            <p>Catégorie: <?php echo htmlspecialchars($postDetails['category']); ?></p>


                <input type="hidden" name="friend_email" value="<?php echo htmlspecialchars($postDetails['id_post']); ?>">
                <button type="submit" name="like" value="1" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                    like
                </button>
                <?php echo $postDetails['likes']; ?>
            </form>
            <form action="?page=add_dislike&id_post=<?php echo $postDetails['id_post']; ?>" method="post" class="w-full mt-4 mb-4">
                <button type="submit" name="dislike" value="1" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                    dislike
                </button>
                <?php echo $postDetails['dislikes']; ?>
            </form>
            <!--<div class="flex flex-row p-4 w-1/3">
            <div class="bg-blue-200 text-white m-2 p-4 w-1/3">
                <form action="?page=add_like&id_post=<?php /*echo $postDetails['id_post']; */?>" method="post" class="w-full mt-4 mb-4">
                <button type="button"  name="like" value="1" onclick="window.location.href='?page=add_like&id_post=<?php /*echo $postDetails['id_post']; */?>'"  class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">Like</button>
                <span></span>
                </form>
            </div>
            <div class="bg-red-200 text-whitem-2 m-2 p-4 pr-4 w-1/3" >
                <form action="?page=add_dislike&id_post=<?php /*echo $postDetails['id_post']; */?>" method="post" class="w-full mt-4 mb-4">
                <button type="button" name="dislike" value="1" onclick="window.location.href='?page=add_dislike&id_post=<?php /*echo $postDetails['id_post']; */?>'" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">Dislike</button>
                <span><?php /*echo $postDetails['dislikes']; */?></span>
                </form>
            </div>
            </div>-->

        </div>
    </div>
</div>