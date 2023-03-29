<?php

class UserController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function displayMyProfile()
    {
        return $this->userModel->getUserInformationById($_SESSION['id_user']);
    }

    public function updateMyProfile($id, $data, $file)
    {
        return $this->userModel->updateUser($id, $data, $file);
    }
    public function displayAllUsersWithFilter($filter)
    {
        return $this->userModel->displayAllUsersWithFilter($filter);
    }
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


    public function getUserNameById($userId)
    {

        $userInfo = $this->userModel->getUserInformationById($userId);

        return [
            'first_name' => $userInfo['first_name'],
            'last_name' => $userInfo['last_name'],
            'profile_picture' => $userInfo['profile_picture'],
        ];
    }
    public function displayUserProfile($id_to)
    {
        return $this->userModel->getUserInformationById($id_to);
    }
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

    public function getUserIdByEmail($email)
    {
        return $this->userModel->getIdByEmail($email);
    }
    public function getUserProfileByEmail($email)
    {
        return $this->userModel->getUserProfileByEmail($email);
    }


    public function displayAllUsers() {
        return $this->userModel->getAllUsers();
    }
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
    public function displayMyNotifications() {
        $id_user = $_SESSION['id_user'];
        return $this->userModel->getNotificationsByUserId($id_user);
    }

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



}