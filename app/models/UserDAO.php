<?php

class UserDAO
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function register($email, $first_name, $last_name, $password, $promo, $statut, $bio, $birth_date, $profile_picture, $interests)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
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

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data && password_verify($password, $data['password'])) {
            return new User($data);
        } else {
            return false;
        }
    }
}