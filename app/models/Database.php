<?php

class Database
{
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $charset;

    public function __construct()
    {
        $this->host = "localhost";
        $this->db_name = "mysocialnetwork";
        $this->username = "root";
        $this->password = "root";
        $this->charset = "utf8mb4";
    }

    public function getConnection()
    {
        try {
            $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            $pdo = new PDO($dsn, $this->username, $this->password, $options);
            return $pdo;
        } catch (PDOException $e) {
            // Gestion des erreurs de connexion
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
