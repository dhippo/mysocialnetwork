<div class="w-auto rounded-xl ml-80 -mt-16">
    <div class="container mx-auto px-4 mt-8">
        <h1 class="text-4xl font-bold mb-6">Mes notifications</h1>
        <div class="container mx-auto mt-10">
            <div class="grid grid-cols-1 gap-8">
                <?php
                foreach ($notifications as $notification) {
                    $bgColor = $notification['is_read'] ? 'bg-white' : 'bg-green-100';
                    ?>
                    <div class="border border-gray-300 rounded p-4 <?= $bgColor ?> shadow w-full mx-auto mb-4 transform hover:scale-105 hover:border hover:border-green-500 hover:border-3 transition duration-300">
                        <p class="text-center font-semibold">
                            <?= $notification['content'] ?>
                        </p>
                        <p class="text-center text-sm text-gray-600 mt-1">
                            <?= date('d/m/Y H:i', strtotime($notification['created_at'])) ?>
                        </p>
                        <?php
                        if ($notification['type'] == 'friend_request') {
                            ?>
                            <div class="flex justify-center mt-2">
                                <a href="?page=add_friend&notif_id=<?= $notification['id_notification'] ?>" class="bg-green-500 text-white font-semibold px-4 py-2 rounded mr-2">Accepter</a>
                                <a href="?page=refuse_friend&notif_id=<?= $notification['id_notification'] ?>" class="bg-red-500 text-white font-semibold px-4 py-2 rounded ml-2">Refuser</a>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>