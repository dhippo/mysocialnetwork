<?php


class Admin
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function validUserADMIN($idUser, $validate) {

        $query = "UPDATE users SET valide = :validate WHERE idUser = :idUser";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':validate', $validate);
        $statement->bindValue(':idUser', $idUser);
        return $statement->execute();
    }

}