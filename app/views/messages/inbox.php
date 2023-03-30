<?php

//recuperer les class
// require '../../models/Message.php';
// require_once '../../models/Message.php';
$id_u = $_SESSION['id_user'];


if ($_GET['id_to'] != 'null') {
    $id_to = $_GET['id_to'];
    // Utilisez $id_to dans votre code
} else if($_GET['id_to'] == 'null'){
    $last_msg = new Message($id_u, 2, 2, null, $pdo_connection);
    $id_to = $last_msg->last_discu($id_u);
    //var_dump($id_to);
    //$id_to=2;
}

//on stock dans les variables toutes les infpo utiles du user
$user_Info = $userController->displayMyProfile();
$avatar_u = $user_Info['profile_picture'];
$avatar_u = '<img src="http://localhost:8888/mysocialnetwork/public/images/profile-images/'.$avatar_u.'" alt="'.$avatar_u.'">';
$nom_u = $user_Info['last_name'];
$prenom_u = $user_Info['first_name'];
$promo_u = $user_Info['promo'];

//on stock dans dautres variable toutes les info de l'autre user
//qui vont etre utiliser en haut la discussion actuel
$user_to= $userController->displayUserProfile($id_to);
$avatar_to = $user_to['profile_picture'];
$avatar_to = '<img src="http://localhost:8888/mysocialnetwork/public/images/profile-images/'.$avatar_to.'" alt="'.$avatar_to.'">';
$nom_to = $user_to['last_name'];
$prenom_to = $user_to['first_name'];
$promo_to = $user_to['promo'];
$email_to = $user_to['email'];


//quand il clic sur le bouton envoyer un msg
if (isset($_POST['boot'])) {
    extract($_POST);

    //permet de ne pas inserer de html
    $msg = htmlspecialchars(strip_tags($message));

    //on creer un nvx msg
    $new_msg = new Message($id_u, $id_to, $msg, NULL, $pdo_connection);

    //on l'envoie
    $send_msg = $new_msg->send_msg($id_u, $id_to, $msg);

    // header('Location:?page=message&id='.$id_to.'> ');
    header('Location: ?page=message&id_to='.$id_to.'');
    // exit;

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title>Messagerie</title>
</head>

<body>

<div class="messagerie">

    <div class="discussions">

        <div class="recherche">
            <!-- barre de recherche AJAX -->
            <form action="">
                <input type="text" id="search-user-f" value="" placeholder="Recherche..." />
            </form>
            <div style="margin-top: 20px;">
                <div id="result-search-f"></div>
            </div>
        </div>

        <div class="contacts">
            <?php
            //on recupere les discussion precedente
            $msg = new Message($id_u, $id_to, null, null, $pdo_connection);
            $contacts = $msg->all_discu($id_u,);
            //on affiche les differentes discu
            foreach ($contacts as $contact) {
                echo '<div class ="contact" >';
                $id = $contact['id'];
                //pour chaque discu on recupere les infos de la personne

                $user_id = $userController->displayUserProfile($id);
                $avatar_id = $user_id['profile_picture'];
                $avatar_id = '<img src="http://localhost:8888/mysocialnetwork/public/images/profile-images/' . $avatar_id . '" alt="' . $avatar_id . '">';
                $nom_id = $user_id['last_name'];
                $prenom_id = $user_id['first_name'];
                $promo_id = $user_id['promo'];

                //affichage de chaque contacts avec qui il a une discussions
                echo '  <div class="avatar_id">' . $avatar_id . '</div>
        
                            <div class="nom_id">'; ?>

                <a href="?page=message&id_to=<?php echo $id?>">
                    <?php echo $nom_id . ' ' . $prenom_id; ?></a>

                <?php echo '</div>
                        </div>';
            }

            ?>
        </div>


    </div>
    <!-- $_SESSION['id_to'] = $id; -->
    <!-- infos du contact actuel en haut des msgs -->
    <div class="discussion">
        <div class="info_contact">
            <?php echo $avatar_to; ?>
            <div class="nom">
                <a href="?page=user_profile&email_user_to_see=<?php echo$email_to ?>">
                    <?php echo $nom_to . ' ' . $prenom_to; ?>
                </a>
            </div>
            <div class="promo"><?php echo $promo_to ?></div>
        </div>
        <div class="messages" id="messages">
            <!-- messages en direct avec AJAX -->
        </div>

        <!-- ecrire un nvx msg -->
        <div class="nvx_message">

            <form method="POST" action="router.php?page=message&id_to=<?php echo$id_to ?>">
                <textarea name="message" cols="40" rows="2" placeholder="Votre message..."></textarea>
                <input type="submit" name="boot" value="Envoyer" class="text-white mr-8 w-16"/>
            </form>
        </div>

    </div>
</div>

</body>
<script type="text/javascript">
    function scrollbas() {
        var msg = document.getElementById('messages');
        msg.scrollTop = msg.scrollHeight;
    }
    setTimeout(scrollbas, 10);




    $(document).ready(function() {
        $('#search-user-f').keyup(function() {
            $('#result-search-f').html(''); //modifie l'html pour rafraichir la recherche

            var utilisateur = $(this).val();

            // // console.log(utilisateur);
            if (utilisateur != "") {

                $.ajax({
                    type: 'GET',
                    url: 'router.php?page=search_user_frends&userId=<?php echo$id_u ?>',
                    // url: '/Applications/MAMP/htdocs/mysocialnetwork/app/views/messages/recherche_user_msg.php?page=message',
                    data: 'users=' + encodeURIComponent(utilisateur),
                    success: function(data) {
                        if (data != "") {
                            $('#result-search-f').append(data);//data

                        } else {
                            document.getElementById('result-search-f').innerHTML = "<div style='font-size: 20px; text-align: center; margin-top:10px'>Aucun utilisateur</div>";
                        }
                    }
                });
            }
        });
    });

    //     $(document).ready(function() {
    //     $('#search-user-f').keyup(function() {
    //         $('#result-search-f').html('');

    //         var utilisateur = $(this).val();

    //         if (utilisateur != "") {
    //             $.ajax({
    //                 type: 'GET',
    //                 url: 'recherche_user_msg.php', // URL relative
    //                 data: 'users=' + encodeURIComponent(utilisateur) + '&page=message',
    //                 success: function(data) {
    //                     if (data != "") {
    //                         $('#result-search-f').append(data);
    //                     } else {
    //                         document.getElementById('result-search-f').innerHTML = "<div style='font-size: 20px; text-align: center; margin-top:10px'>Aucun utilisateur</div>";
    //                     }
    //                 }
    //             });
    //         }
    //     });
    // });


    function msg_live() {
        // Créer une instance XMLHttpRequest
        var xhr = new XMLHttpRequest();

        // Définir la fonction de rappel à appeler lorsqu'on obtient une réponse du serveur
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Si la requête réussit, mettre à jour la div "messages" avec le contenu reçu
                    document.getElementById("messages").innerHTML = xhr.responseText;
                }
            }
        };

        // Envoyer une requête GET à "discu_live.php"

        xhr.open("GET", "router.php?page=discu_user&id_to=<?php echo$id_to ?>", true);

        xhr.send();
        // scrollbas();

        // Actualiser la page toutes les secondes
        setTimeout(msg_live, 500);
    }

    // Appeler la fonction pour la première fois pour démarrer l'actualisation
    msg_live();
</script>

</html>

<style>

    .messagerie {
        border: 1px solid blue;
        border-radius: 20px;
        border-top-left-radius: 0;
        margin-left: 30%;
        width: 50%;
        /* overflow: hidden; */
        min-height: 50%;
        min-width: 40%;
        max-height: 60%;
        max-width: 50%;
    }

    .contacts{
        /* border: 1px solid rgb(230, 89, 255); */
        /* margin-top: 10%; */
        overflow-y: scroll;
        border-bottom-left-radius: 20px;
        height: 90%;
        padding-top: 2%;


    }

    .discussions {
        /* border: 1px solid green; */
        border-right: 2px solid blue;
        width: 100%;
        float: left;
        /* min-height: 50%; */
        /* display: flex; */
        flex-direction: column;
        height: 60%;
        max-width: 30%;

    }

    .recherche {
        /* border: 1px solid rgb(255, 49, 49); */
        height: 8%;

    }

    .recherche input[type="text"] {
        /* border: 1px solid rgb(255, 49, 49); */
        margin-top: 3%;
        width: 80%;

    }

    .recherche form{
        border: 1px solid black;
        margin: 2px;
        PADDING-left: 6%;
        border-radius: 20px;
        width: 100%;
        height: 100%;

    }

    .resul_search_f{
        position: relative;
        z-index: 2;
        /* border: 1px solid rgb(255, 24, 24);
        background-color: grey;
        display: flex;
        max-width: 100%;
        padding: 2%; */
        margin-bottom: 3px;
        background-color: #5079a2;
        display: flex;
        max-width: 100%;
        padding: 2%;
    }

    .nom_search_f{
        float: right;
        font-size: 1em;
        width: 80%;
        padding-left: 4%;
        padding-top: 5%;
    }

    .avatar_search_f{
        width: 20%;
    }


    .avatar_search_f img{
        border-radius: 28px;
        border: 1px solid black;
        max-width: 100%;
    }

    .nom_search_f a{
        text-decoration: none;
        color:#102136
    }

    .nom_search_f a:hover{
        text-decoration: none;
        color: #ffffff;


    }

    /*
      .recherche input[type="text"] {
        font-size: 16px;
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        flex: 1;
      }

      .recherche input[type="text"]:focus {
        outline: none;
        border: 1px solid #007bff;
      }
       */

    .contact {
        /* border-radius: 30px; */
        margin-bottom: 3px;
        background-color: #c1ccd3;
        display: flex;
        max-width: 100%;
        padding: 2%;

    }

    .contact img{
        border-radius: 28px;
        border: 1px solid black;
        max-width:100%;
    }

    .nom_id{
        float: right;
        font-size:1em;
        width: 80%;
        padding-left: 4%;
        padding-top: 5%;

    }

    .nom_id a{
        text-decoration:none;
        color:#102136

    }

    .nom_id a:hover{
        color: #ffffff;
    }

    .avatar_id{
        width: 20%;
    }


    .discussion {
        display: flex;
        flex-direction: column;
        margin-left: 30%;
        min-height: 60%;
        min-width: 60%;
        max-height: 60%;
        max-width: 70%;

    }

    .info_contact {
        border: 1px solid blue;
        /* border-top-left-radius: 20px; */
        border-top-right-radius: 20px;
        background-color: white;
        display: flex;
        padding: 2%;

    }

    .info_contact img {
        border-radius: 48%;
        border: 1px solid black;
        width: 13%;
        height: 12%;
    }

    .nom {
        float: right;
        font-size:1.5em;
        margin-top:3%;
        margin-left: 3%;
        width: 45%;
    }

    .nom a{
        text-decoration: none;
        color:#102136
    }


    .nom a:hover{
        color:#102136
    }

    .promo {
        float: right;
        font-size:1em;
        background-color: #c1ccd3;
        padding:2%;
        border-radius: 10px;
        /* margin-right: 15%; */

    }

    .messages {
        flex: 1;
        border: 1px solid blue;
        overflow-y: scroll;
        padding: 1%;
    }

    .message_envoye {
        margin-bottom: 1%;
        clear: both;
        float: right;
        max-width: 60%;
    }

    .avatar_msg {
        border: 1px solid black;
        border-radius: 20px;
        float: right;
        width: 8%;
    }

    .avatar_msg img {
        max-width: 100%;
        border-radius: 20px;

    }

    .contenu_msg {
        background-color: #0c14147a;
        border: 1px solid black;
        color: white;
        margin-right: 2%;
        float: right;
        margin-bottom: 4px;
        border-radius: 15px;
        padding: 2%;
        max-width: 80%;
    }

    .message_recu {
        margin-bottom: 1%;
        clear: both;
        float: left;
        max-width: 60%;
    }

    .avatar_msg_r {
        border: 1px solid black;
        border-radius: 20px;
        float: left;
        width: 8%;
    }

    .avatar_msg_r img {
        max-width: 100%;
        border-radius: 20px;

    }

    .contenu_msg_r {
        background-color: #778d93;
        border: 1px solid black;
        color: white;
        margin-left: 2%;
        float: left;
        margin-bottom: 4px;
        border-radius: 15px;
        padding: 2%;
        max-width: 80%;
    }

    .nvx_message {
        border: 1px solid blue;
        /* border-bottom-left-radius: 20px; */
        border-bottom-right-radius: 20px;
        background-color: white;
        padding-top: 1%;

    }

    textarea {
        border-radius: 5px;
        color: white;
        border: 0;
        background-color: #102136;
        border-radius: 10px;
        resize: none;
        font-family: serif;
        font-size: 1.2em;
        margin-left: 1%;
        padding-top: 2%;
        width: 70%;
    }

    .nvx_message form {
        border: 1px solid black;
        display: flex;
        width: 90%;
        margin-left: 5%;
        background-color: #102136;
        border-radius: 20px;

    }

    input[type="submit"] {
        background-image: url('MAMP/htdocs/mysocialnetwork/public/image/avatar/logo_envoie.png');
        background-repeat: no-repeat;
        background-position: center center;
        max-width: 100%;
        background-color: #102136;
        border: none;
        cursor: pointer;
        overflow: right;
        border-radius: 34px;
        width: 12%;
        background-size: 39%;
        margin-left: 15%;
    }

    input[type="submit"]:hover {
        background-color: #3787dc;
    }

    textarea:focus {
        outline: none;
    }


    /* @media screen and (min-width: 768px) {
        .messages {
            max-height: 300px;
        }

        .message-envoye,
        .message-recu {
            max-width: 50%;
        }
    } */

</style>