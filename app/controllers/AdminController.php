<?php

class AdminController
{
    private $adminModel;

    public function __construct($pdo)
    {
        $this->adminModel = new Admin($pdo);
    }

}