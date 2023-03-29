<?php


class Admin
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function validUserADMIN($idUser, $validate)
    {
        $query = "UPDATE users SET validated = :validate WHERE id_user = :idUser";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':validate', $validate);
        $statement->bindValue(':idUser', $idUser);
        return $statement->execute();
    }

    public function blockUserADMIN($idUser, $isBlocked)
    {
        $query = "UPDATE users SET is_blocked = :isBlocked WHERE id_user = :idUser";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':isBlocked', $isBlocked);
        $statement->bindValue(':idUser', $idUser);
        return $statement->execute();
    }

}