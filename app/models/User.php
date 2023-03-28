<?php


class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function register($email, $first_name, $last_name, $password, $promo, $statut, $bio, $birth_date, $profile_picture, $interests)
    {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $validated = 0;
        $is_blocked = 0;

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



