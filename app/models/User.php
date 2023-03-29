<?php


class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

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

    public function register($email, $first_name, $last_name, $password, $promo, $statut, $birth_date)
    {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
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

    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    public function getUserInformationById($userId) {
        $query = "SELECT * FROM users WHERE id_user = :userId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $data, $file)
    {
        // Gestion de l'image de profil
        if (!empty($file['profile_picture']['name'])) {
            $profilePicture = $this->uploadProfilePicture($file['profile_picture']);
            if (!$profilePicture) {
                return false;
            }
            $data['profile_picture'] = $profilePicture;
        }

        $query = "UPDATE users SET email = :email, first_name = :first_name, last_name = :last_name, promo = :promo, statut = :statut, bio = :bio, birth_date = :birth_date, interests = :interests";
        if (isset($data['profile_picture'])) {
            $query .= ", profile_picture = :profile_picture";
        }
        $query .= " WHERE id_user = :id_user";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindValue(':email', $data['email']);
        $stmt->bindValue(':first_name', $data['first_name']);
        $stmt->bindValue(':last_name', $data['last_name']);
        $stmt->bindValue(':promo', $data['promo']);
        $stmt->bindValue(':statut', $data['statut']);
        $stmt->bindValue(':bio', $data['bio']);
        $stmt->bindValue(':birth_date', $data['birth_date']);
        $stmt->bindValue(':interests', $data['interests']);
        if (isset($data['profile_picture'])) {
            $stmt->bindValue(':profile_picture', $data['profile_picture']);
        }
        $stmt->bindValue(':id_user', $id);

        return $stmt->execute();
    }



    public function getUserProfileByEmail($email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM users";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }




    /** FRIENDS & NOTIFICATIONS FUNCTIONS */
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
    public function getNotificationsByUserId($id_user) {
        $sql = "SELECT * FROM `notifications` WHERE `user_id` = :id_user ORDER BY `created_at` DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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



}



