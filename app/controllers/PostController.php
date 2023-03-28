<?php
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/User.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class PostController
{
    private $postModel;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->postModel = new Post($pdo);
    }

    public function displayAllPublicPosts()
    {
        return $this->postModel->getAllPublicPosts();
    }

    public function createPost($postData, $fileData, $creatorId)
    {
        $result = $this->postModel->create($postData, $fileData, $creatorId);

        if ($result) {
            $params = array('page' => 'home');
            $queryString = http_build_query($params);
            header('Location: ' . $_SERVER['PHP_SELF'] . '?' . $queryString);
            exit;
        } else {
            echo "Erreur lors de la création du post.";
        }
    }
    public function displayPostDetails($id_post)
    {
        return $this->postModel->getPostDetails($id_post);
    }

    public function postsCurrentUser()
    {

        return $this->postModel->getUserPosts($_SESSION['user_email']);;
    }
}