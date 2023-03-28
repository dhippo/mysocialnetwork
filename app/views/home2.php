<div class=" w-auto rounded-xl ml-80 -mt-16">

    <div class="w-11/12">

        <section class="py-8">
            <div class="custom-screen text-gray-6000">
                <div class="max-w-xl">
                    <h2 class="text-gray-800 text-3xl font-semibold sm:text-4xl">Actualité et Évènements de l'ECE</h2>
                    <p>Dans cette section vous avez accès a tous les posts public de l'ECE.
                        <!-- -->
                        <a class="text-blue-600 hover:text-blue-400 dark:hover:text-sky-600 inline-flex items-center gap-x-1 duration-150" href="/tutorials/cs50">Créer un posts <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd" d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z" clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    </p>
                </div>
                <div class="mt-12">
                    <ul class="grid gap-x-6 gap-y-12 sm:grid-cols-2 lg:grid-cols-3 text-black">
                        <?php foreach ($publicPosts as $post): ?>
                            <li class="m-4">
                                <div class="space-y-2 sm:max-w-sm">
                                    <a href="/tutorials/cs50/introduction-to-computer-science">
                                        <img src="http://localhost:8888/mysocialnetwork/public/images/ece-logo.jpg" class="rounded-lg w-full" alt="image" />
                                    </a>
                                    <div class="pt-2 text-sm flex items-center justify-between">
                                      <span class=" text-blue-600 dark:text-sky-500 font-semibold truncate ">
                                          <?php echo htmlspecialchars($post['creator_email']); ?>
                                      </span>
                                        <span class="text-sm text-gray-700 dark:text-gray-400 font-semibold "><?php echo htmlspecialchars($post['created_at']); ?></span>
                                    </div>
                                    <h3 class=" block text-gray-800 text-lg font-medium">
                                        <a href="/tutorials/cs50/introduction-to-computer-science"><?php echo htmlspecialchars($post['title']); ?></a>
                                    </h3>
                                    <p class="truncate text-sm"><?php echo htmlspecialchars($post['content']); ?></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </section>

    </div>

</div>