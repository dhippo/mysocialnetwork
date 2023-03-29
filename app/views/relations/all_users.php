<?php
if ($_GET['id_to'] != 'null') {
    $id_to = $_GET['id_to'];
    // Utilisez $id_to dans votre code
} else if($_GET['id_to'] == 'null'){
    // $last_msg = new Message($id_u, 2, 2, null, $pdo_connection);
    // $id_to = $last_msg->last_discu($id_u);
    $id_to = 2;

}
print('$_GET=<pre>'.print_r($_GET, true).'</pre><br><br>');

?>

<div class="w-auto rounded-xl ml-80 -mt-16">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5/ak8N2eQ2Kac6/2hQmpsZTEV3N3O3y1wKPIXg/6" crossorigin="anonymous"></script>

    <div class="container mx-auto px-4 mt-8">

        <h3 class="text-center text-2xl font-semibold mt-6 mb-4">Liste des utilisateurs: </h3>

        <form class="relative flex flex-1 h-8 m-2 -pr-2" action="">
            <label for="search-user" class="sr-only">Rechercher</label>
            <svg class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-400 " viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
            </svg>
            <input type="text" id="search-user" name="search" value=""  placeholder="Recherche..." class="block h-full w-full border-0 py-0 pl-8 pr-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm"/>
        </form>

        <?php var_dump($id_u) ?>


        <div class="p-8 m-8">
            <div id="result-search"></div>
        </div>

        <script>
            $(document).ready(function() {
                $('#search-user').keyup(function() {
                    $('#result-search').html(''); //modifie l'html pour rafraichir la recherche

                    // var utilisateur = $(this).val();

                    // // console.log(utilisateur);
                    if (utilisateur != "") {
                        console.log(1)

                        //     $.ajax({
                        //         type: 'GET',
                        //         url: 'router.php?page=search_user&userId=<?php echo$id_u ?>',
                        //         // url: '/Applications/MAMP/htdocs/projet_ECEBOOK/mysocialnetwork/app/views/messages/recherche_user_msg.php?page=message',
                        //         data: 'users=' + encodeURIComponent(utilisateur),
                        //         success: function(data) {
                        //             if (data != "") {
                        //                 $('#result-search').append(data);//data

                        //             } else {
                        //                 document.getElementById('result-search').innerHTML = "<div style='font-size: 20px; text-align: center; margin-top:10px'>Aucun utilisateur</div>";
                        //             }
                        //         }
                        //     });
                    }
                });
            });
        </script>



        <div class="grid grid-cols-4 gap-4 mx-6">
            <?php
            foreach ($allUsers as $user) {
                ?>
                <div class="border border-gray-300 rounded p-4 bg-white shadow w-full mx-auto mb-4 transform hover:scale-105 hover:border hover:border-blue-500 hover:border-3 transition duration-300">
                    <img class="w-20 h-20 rounded-full mx-auto" src="http://localhost:8888/mysocialnetwork/public/images/profile-images/<?= $user['profile_picture'] ?>" alt="user photo">
                    <h4 class="text-center mt-2 font-semibold hover:underline cursor-pointer">
                        <a href="?page=user_profile&email_user_to_see=<?php echo htmlspecialchars($user['email']); ?>">
                            <?= $user['first_name'] . ' ' . $user['last_name'] ?>
                        </a>
                    </h4>
                    <p class="text-center text-sm text-blue-700"><?= $user['statut'] . ' - Promo ' . $user['promo'] ?></p>
                </div>
                <?php
            }
            ?>
        </div>

    </div>
</div>
<script>

    /** REQUETE AJAX POUR LA RECHERCHE D'UTILISATEURS **/

</script>

