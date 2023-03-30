<?php

class UserController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    /** *********************************************************************/
    /** ******************          for ADMIN             *********************/
    // case 'admin':
    public function displayAllUsersWithFilter($filter)
    {
        return $this->userModel->displayAllUsersWithFilter($filter);
    }


    /** ***********************************************************************/
    /** ******************      NOTIFICATION          *************************/
    // case 'notifs':
    public function displayMyNotifications() {
        $id_user = $_SESSION['id_user'];
        return $this->userModel->getNotificationsByUserId($id_user);
    }


    /** ***********************************************************************/
    /** ******************            PROFILE          ***********************/
    // case 'profile':
    public function displayMyProfile()
    {
        return $this->userModel->getUserInformationById($_SESSION['id_user']);
    }
    public function displayMyFriends()
    {
        $id_user = $_SESSION['id_user'];
        return $this->userModel->getMyFriends($id_user);
    }
    public function displayUserProfile($id_to)
    {
        return $this->userModel->getUserInformationById($id_to);
    }

    // case 'user_profile':
    public function getUserIdByEmail($email)
    {
        return $this->userModel->getIdByEmail($email);
    }
    public function getUserProfileByEmail($email)
    {
        return $this->userModel->getUserProfileByEmail($email);
    }
    public function areFriends($userId1, $userId2)
    {
        return $this->userModel->areFriends($userId1, $userId2);
    }

    // case 'update_profile':

    public function updateMyProfile($id, $data, $fileData, $old_profile_picture)
    {
        $old_email = $this->userModel->getEmailById($id);
        if (isset($fileData['profile_picture']) && $fileData['profile_picture']['error'] == 0) {
            $uploadPath = '/Applications/MAMP/htdocs/mysocialnetwork/public/images/profile-images/';
            $fileName = uniqid() . '_' . basename($fileData['profile_picture']['name']);
            $targetFilePath = $uploadPath . $fileName;

            move_uploaded_file($fileData['profile_picture']['tmp_name'], $targetFilePath);
        } else {
            $fileName = $old_profile_picture;
        }

        return $this->userModel->updateUser($id, $data, $fileName, $old_email);
    }


    /** ***********************************************************************/
    /** ******************            POSTS          *************************/

    // tout dans PostController


    /** ***********************************************************************/
    /** ******************            LIKES          *************************/

    // tout dans PostController


    /** ***********************************************************************/
    /** ******************            FRIENDS          *************************/
    // case 'ask_friend':
    public function addFriendController()
    {
        if (isset($_POST['friend_email']) && !empty($_POST['friend_email'])) {
            $friend_email = $_POST['friend_email'];
            $inviter_user_id = $_SESSION['id_user'];
            $invited_user_id = $this->userModel->getIdByEmail($friend_email);
            print('$_POST=<pre>'.print_r($_POST, true).'</pre><br><br>');
            var_dump($invited_user_id);
            if ($invited_user_id !== null) {
                if ($this->userModel->sendFriendRequest($inviter_user_id, $invited_user_id)) {
                    $content = "Vous avez reçu une demande d'ami de " . $_SESSION['first_name'] . " " . $_SESSION['last_name'];
                    $this->userModel->sendNotification($invited_user_id, $content);
                    header('Location: ?page=user_profile&email_user_to_see=' . $friend_email);
                } else {
                    echo "Erreur lors de l'envoi de la demande d'ami.";
                }
            } else {
                echo "L'utilisateur n'existe pas.";
            }
        } else {
            header('Location: ?page=home');
        }
    }
    //    case 'add_friend':
    public function acceptFriendRequest($id_notification)
    {
        $id_request = $this->userModel->getFriendRequestIdByNotificationId($id_notification);

        if ($id_request !== null) {
            $notification = $this->userModel->getNotificationById($id_notification);
            if ($this->userModel->updateFriendRequestStatus($id_request, 'accepted')) {
                $this->userModel->archiveNotification(
                    $id_notification,
                    $notification['user_id'],
                    $notification['content'],
                    $notification['created_at']
                );
                $this->userModel->deleteNotification($id_notification);
                header('Location: ?page=my_notifs');
            } else {
                echo "Erreur lors de l'acceptation de la demande d'ami.";
            }
        } else {
            echo "La demande d'ami est introuvable.";
        }
    }

    // case 'refuse_friend':
    public function refuseFriendRequest($id_notification)
    {
        $id_request = $this->userModel->getFriendRequestIdByNotificationId($id_notification);
        if ($id_request !== null) {
            $notification = $this->userModel->getNotificationById($id_notification);
            if ($this->userModel->updateFriendRequestStatus($id_request, 'refused')) {
                $this->userModel->archiveNotification(
                    $id_notification,
                    $notification['user_id'],
                    $notification['content'],
                    $notification['created_at']
                );
                $this->userModel->deleteNotification($id_notification);
                header('Location: ?page=my_notifs');
            } else {
                echo "Erreur lors du refus de la demande d'ami.";
            }
        } else {
            echo "La demande d'ami est introuvable.";
        }
    }


    /** ***********************************************************************/
    /** ******************        RELATIONS          *************************/
    // case 'all_users':
    public function displayAllUsers() {
        return $this->userModel->getAllUsers();
    }

    // case 'search_user':
/*    public function searchUserController() {
        if (isset($_GET['users'])) {
            $users = (string) trim($_GET['users']); //trim pour enlever espace avant et apres
            $userId=$_GET['userId'];
            //   $userId=24;
            $pdo = new Database();
            $pdo_connection = $pdo->getConnection();

            $req = $pdo_connection->query("SELECT * FROM users WHERE (last_name LIKE '$users%' OR first_name LIKE '$users%')  AND id_user != '$userId' LIMIT 5;"); //limit de 5 nom
            $result = $req->fetchAll();

            foreach ($result as $r) {
                $id_s = $r['id_user'];
                //pour chaque discu on recupere les infos de la personne

                $userController = new UserController($pdo_connection);

                $user_s = $userController->displayUserProfile($id_s);
                $avatar_s = $user_s['profile_picture'];
                $avatar_s = '<img src="http://localhost:8888/mysocialnetwork/public/images/profile-images/' . $avatar_s . '" alt="' . $avatar_s . '">';
                $nom_s = $user_s['last_name'];
                $prenom_s = $user_s['first_name'];

                echo '<div class="resul_search">';
                echo '<div class="avatar_search">' . $avatar_s . '</div>';
                echo '<div class="nom_search">';
                echo '<a href="router.php?page=message&id_to=' . $id_s . '">' . $nom_s . ' ' . $prenom_s . '</a>';
                echo '</div>';
                echo '</div>';
            }
        }
    }*/
    // non utilisées
    public function displayAllUsers_SEACRH($filter)
    {
        return $this->userModel->displayAllUsers_SEACRH($filter);
    }
    public function displayFilteredUsers($search)
    {
        if (!empty($search)) {
            return $this->userModel->displayAllUsers_SEACRH($search);
        }
        return [];
    }


    /** *********************************************************************/
    /** ******************            HOME             *********************/
    // case 'home':



    /** *********************************************************************/
    /** ******************            MESSAGE             *********************/
    public function searchUserController() {

        if (isset($_GET['users'])) {
            $users = (string) trim($_GET['users']); //trim pour enlever espace avant et apres
            $userId=$_GET['userId'];
            //   $userId=24;


            $pdo = new Database();
            $pdo_connection = $pdo->getConnection();

            $req = $pdo_connection->query("SELECT * FROM users WHERE (last_name LIKE '$users%' OR first_name LIKE '$users%')  AND id_user != '$userId' LIMIT 5;"); //limit de 5 nom
            $result = $req->fetchAll();

            foreach ($result as $r) {
                $id_s = $r['id_user'];
                //pour chaque discu on recupere les infos de la personne

                $userController = new UserController($pdo_connection);

                $user_s = $userController->displayUserProfile($id_s);
                $avatar_s = $user_s['profile_picture'];
                $avatar_s = '<img src="http://localhost:8888/mysocialnetwork/public/images/profile-images/' . $avatar_s . '" alt="' . $avatar_s . '">';
                $nom_s = $user_s['last_name'];
                $prenom_s = $user_s['first_name'];

                echo '<div class="resul_search">';
                echo '<div class="avatar_search">' . $avatar_s . '</div>';
                echo '<div class="nom_search">';
                echo '<a href="router.php?page=message&id_to=' . $id_s . '">' . $nom_s . ' ' . $prenom_s . '</a>';
                echo '</div>';
                echo '</div>';
            }
        }
    }

    public function searchUserFrendsController() {
        if (isset($_GET['users'])) {
            $users = (string) trim($_GET['users']); //trim pour enlever espace avant et apres
            $userId=$_GET['userId'];
            //   $userId=24;


            $pdo = new Database();
            $pdo_connection = $pdo->getConnection();

            $req = $pdo_connection->query("SELECT * FROM users WHERE (last_name LIKE '$users%' OR first_name LIKE '$users%')  AND id_user != '$userId' LIMIT 5;"); //limit de 5 nom
            $result = $req->fetchAll();

            foreach ($result as $r) {
                $id_s = $r['id_user'];
                //pour chaque discu on recupere les infos de la personne

                $userController = new UserController($pdo_connection);

                $user_s = $userController->displayUserProfile($id_s);
                $avatar_s = $user_s['profile_picture'];
                $avatar_s = '<img src="http://localhost:8888/mysocialnetwork/public/images/profile-images/' . $avatar_s . '" alt="' . $avatar_s . '">';
                $nom_s = $user_s['last_name'];
                $prenom_s = $user_s['first_name'];

                echo '<div class="resul_search_f">';
                echo '<div class="avatar_search_f">' . $avatar_s . '</div>';
                echo '<div class="nom_search_f">';
                echo '<a href="router.php?page=message&id_to=' . $id_s . '">' . $nom_s . ' ' . $prenom_s . '</a>';
                echo '</div>';
                echo '</div>';
            }
        }
    }
    public function discu_live(){
        {
            $pdo = new Database();
            $pdo_connection = $pdo->getConnection();
            $userController = new UserController($pdo_connection);

            $id_u = $_SESSION['id_user'];
            $id_to = $_GET['id_to'];

            $user_u = $userController->displayMyProfile();
            $avatar_u = $user_u['profile_picture'];
            $avatar_u = '<img src="http://localhost:8888/mysocialnetwork/public/images/profile-images/' . $avatar_u . '" alt="' . $avatar_u . '">';


            $user_to = $userController->displayUserProfile($id_to);
            $avatar_to = $user_to['profile_picture'];
            $avatar_to = '<img src="http://localhost:8888/mysocialnetwork/public/images/profile-images/' . $avatar_to . '" alt="' . $avatar_to . '">';


            $msg = new Message($id_u, $id_to, null, null, $pdo_connection);
            $anciens_msg = $msg->get_messages($id_u, $id_to);

            //affichage de msg Ã  partir du tableau
            foreach ($anciens_msg as $message) {
                if ($message['sender_id'] == $id_u) {

                    echo '<div class="message_envoye">
        
                    <div class="avatar_msg">
                    ' . $avatar_u . '
        
                  </div>
                    <div class="contenu_msg" >
                    ' . $message['content'] . '
        
                    </div>
        
                    </div>';
                } else {

                    echo '<div class="message_recu">
        
                    <div class="avatar_msg_r">
                    ' . $avatar_to . '
        
                  </div>
        
                    <div class="contenu_msg_r" >
                    ' . $message['content'] . '
        
                    </div>
        
                    </div>';
                }
            }
        }
    }




    // pour le routeur
    public function getUserNameById($userId)
    {

        $userInfo = $this->userModel->getUserInformationById($userId);

        return [
            'first_name' => $userInfo['first_name'],
            'last_name' => $userInfo['last_name'],
            'profile_picture' => $userInfo['profile_picture'],
        ];
    }

}