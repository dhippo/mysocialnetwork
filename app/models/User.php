<?php


class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    /** *********************************************************************/
    /** ******************            ADMIN             *********************/
    // case 'admin':
    // UserController
    public function displayAllUsersWithFilter($filter)
    {
        $sql = "SELECT * FROM users";
        if ($filter) {
            $sql .= " WHERE " . $filter;
        }
        $statement = $this->pdo->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /** *********************************************************************/
    /** ******************            AUTH             *********************/
    // case 'register':
    // AuthController
    public function register($email, $first_name, $last_name, $password, $promo, $statut, $birth_date)
    {
        $password = hash('sha256', $_POST['password']);
        $validated = 0;
        $is_blocked = 0;
        $bio = "";
        $interests = "";
        $profile_picture = "";

        $sql = "INSERT INTO users (email, first_name, last_name, password, promo, statut, bio, birth_date, profile_picture, interests, validated, is_blocked)
                VALUES (:email, :first_name, :last_name, :password, :promo, :statut, :bio, :birth_date, :profile_picture, :interests, :validated, :is_blocked)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':promo', $promo);
        $stmt->bindParam(':statut', $statut);
        $stmt->bindParam(':bio', $bio);
        $stmt->bindParam(':birth_date', $birth_date);
        $stmt->bindParam(':profile_picture', $profile_picture);
        $stmt->bindParam(':interests', $interests);
        $stmt->bindParam(':validated', $validated, PDO::PARAM_INT);
        $stmt->bindParam(':is_blocked', $is_blocked, PDO::PARAM_INT);

        return $stmt->execute();
    }
    // case 'login':
    // AuthController
    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && hash('sha256', $password) === $user['password']) {
            return $user;
        } else {
            return false;
        }
    }



    /** ***********************************************************************/
    /** ******************      NOTIFICATION          *************************/
    // case 'notifs':
    public function getNotificationsByUserId($id_user) {
        $sql = "SELECT * FROM `notifications` WHERE `user_id` = :id_user ORDER BY `created_at` DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /** ***********************************************************************/
    /** ******************            PROFILE          ***********************/
    // case 'profile':
    public function getUserInformationById($userId) {
        $query = "SELECT * FROM users WHERE id_user = :userId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getMyFriends($userId)
    {
        $query = "SELECT users.*
              FROM users
              JOIN friend_requests ON (users.id_user = friend_requests.inviter_user_id OR users.id_user = friend_requests.invited_user_id)
              WHERE (friend_requests.inviter_user_id = :userId1 OR friend_requests.invited_user_id = :userId2) AND friend_requests.status = 'accepted' AND users.id_user != :userId3";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':userId1', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':userId2', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':userId3', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // case 'user_profile':
    //////////////////////// case 'ask_friend':
    public function getIdByEmail($friend_email) {
        $sql = "SELECT `id_user` FROM `users` WHERE `email` = :friend_email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':friend_email', $friend_email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['id_user'];
        } else {
            return null;
        }
    }
    public function getUserProfileByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function areFriends($id_user1, $id_user2)
    {

        $sql = "SELECT * FROM friend_requests
            WHERE (inviter_user_id = :id_user1a AND invited_user_id = :id_user2a) OR
                  (inviter_user_id = :id_user2b AND invited_user_id = :id_user1b) AND
                  status = 'accepted'";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_user1a', $id_user1, PDO::PARAM_INT);
        $stmt->bindParam(':id_user2a', $id_user2, PDO::PARAM_INT);
        $stmt->bindParam(':id_user1b', $id_user1, PDO::PARAM_INT);
        $stmt->bindParam(':id_user2b', $id_user2, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0;
    }




    // case 'update_profile':
    public function updateUser($id, $data, $profile_picture)
    {
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $birth_date = $data['birth_date'];
        $email = $data['email'];
        $promo = $data['promo'];
        $statut = $data['statut'];
        $bio = $data['bio'];
        $interests = $data['interests'];

        $sql = "UPDATE users SET first_name = ?, last_name = ?, birth_date = ?, email = ?, promo = ?, statut = ?, bio = ?, interests = ?, profile_picture = ? WHERE id_user = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$first_name, $last_name, $birth_date, $email, $promo, $statut, $bio, $interests, $profile_picture, $id]);
    }


    private function uploadProfilePicture($file)
    {
        // Vérifier si le fichier a été téléchargé sans erreur
        if ($file['error'] != 0) {
            return false;
        }

        // Vérifier la taille du fichier
        if ($file['size'] > 5000000) {
            return false;
        }

        // Vérifier le type du fichier
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file['type'], $allowedMimeTypes)) {
            return false;
        }

        // Générer un nom de fichier unique
        $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $uniqueFileName = uniqid() . '.' . $fileExtension;


        // Déplacer le fichier téléchargé vers le dossier /public/images/profile-images
        $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/public/images/profile-images/' . $uniqueFileName;

        move_uploaded_file($file['tmp_name'], $destinationPath);

        // Retourner le chemin relatif vers l'image pour l'enregistrer dans la base de données
        return 'images/profile-images/' . $uniqueFileName;
    }


    /** ***********************************************************************/
    /** ******************            POSTS          *************************/
    // case: feed
    public function getFriendsIds($userId)
    {
        $query = "SELECT users.id_user
          FROM users
          JOIN friend_requests ON (users.id_user = friend_requests.inviter_user_id OR users.id_user = friend_requests.invited_user_id)
          WHERE (friend_requests.inviter_user_id = :userId1 OR friend_requests.invited_user_id = :userId2) AND friend_requests.status = 'accepted' AND users.id_user != :userId3";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':userId1', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':userId2', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':userId3', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }



    /** ***********************************************************************/
    /** ******************            LIKES          *************************/


    /** ***********************************************************************/
    /** ******************            FRIENDS          *************************/
    // case 'ask_friend':
    public function sendFriendRequest($inviter_user_id, $invited_user_id)
    {
        $sql = "INSERT INTO friend_requests (request_date, status, inviter_user_id, invited_user_id)
            VALUES (NOW(), 'pending', :inviter_user_id, :invited_user_id)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':inviter_user_id', $inviter_user_id, PDO::PARAM_INT);
        $stmt->bindParam(':invited_user_id', $invited_user_id, PDO::PARAM_INT);

        return $stmt->execute();
    }
    public function sendNotification($user_id, $content)
    {
        $sql = "INSERT INTO notifications (user_id, content, created_at, is_read, type)
            VALUES (:user_id, :content, NOW(), 0, 'friend_request')";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':content', $content);

        return $stmt->execute();
    }
    // case 'add_friend':
    // case 'refuse_friend':
    public function getFriendRequestIdByNotificationId($id_notification)
    {
        var_dump("id_notification = ". $id_notification);
        $sql = "SELECT id_request FROM friend_requests WHERE request_date = (SELECT created_at FROM notifications WHERE id_notification = :id_notification)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':id_notification', $id_notification);
        var_dump("SAUT<br><br><br>");
        var_dump($stmt->execute());
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump("<br><br></br>row['id_request'] = ", $row['id_request']);
            return $row['id_request'];
        } else {
            return null;
        }

    }
    public function getNotificationById($id_notification)
    {
        $sql = "SELECT * FROM `notifications` WHERE `id_notification` = :id_notification";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_notification', $id_notification, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return null;
        }
    }
    public function updateFriendRequestStatus($id_request, $status)
    {
        $sql = "UPDATE friend_requests SET status = :status WHERE id_request = :id_request";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':id_request', $id_request, PDO::PARAM_INT);
        return $stmt->execute();
    }
    public function archiveNotification($id_notification, $user_id, $content, $created_at)
    {
        $sql = "INSERT INTO archived_notifications (id_archived_notification, user_id, content, created_at)
            VALUES (:id_notification, :user_id, :content, :created_at)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_notification', $id_notification, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':created_at', $created_at);
        return $stmt->execute();
    }
    public function deleteNotification($id_notification)
    {
        $sql = "DELETE FROM notifications WHERE id_notification = :id_notification";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_notification', $id_notification, PDO::PARAM_INT);
        return $stmt->execute();
    }


    /** ***********************************************************************/
    /** ******************        RELATIONS          *************************/
    // case 'all_users':
    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //case 'search':
    public function displayAllUsers_SEACRH($filter)
    {
        $sql = "SELECT * FROM users WHERE CONCAT(first_name, ' ', last_name) LIKE :filter";
        $stmt = $this->pdo->prepare($sql);
        $filter = '%' . $filter . '%';
        $stmt->bindParam(':filter', $filter, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function searchUsers($search)
    {
        $search = '%' . $search . '%';
        $sql = "SELECT * FROM users WHERE CONCAT(first_name, ' ', last_name) LIKE ? OR email LIKE ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$search, $search]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /** *********************************************************************/
    /** ******************            HOME             *********************/


    public function getEmailById($id_user) {
        $sql = "SELECT `email` FROM `users` WHERE `id_user` = :id_user";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['email'];
        } else {
            return null;
        }
    }


    /** FRIENDS & NOTIFICATIONS FUNCTIONS */





}



