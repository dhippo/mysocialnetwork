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