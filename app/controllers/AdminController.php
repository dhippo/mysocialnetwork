<?php

class AdminController
{
    private $adminModel;

    public function __construct($pdo)
    {
        $this->adminModel = new Admin($pdo);
    }

    public function validateUser($idUser, $action)
    {
        $validate = $action == 'validate' ? 1 : 0;
        $this->adminModel->validUserADMIN($idUser, $validate);
    }

    public function blockUser($idUser, $action)
    {
        $isBlocked = $action == 'block' ? 1 : 0;
        $this->adminModel->blockUserADMIN($idUser, $isBlocked);
    }


}