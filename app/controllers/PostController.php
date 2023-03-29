<?php
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/User.php';



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

        if (isset($fileData['image']) && $fileData['image']['error'] == 0) {
            $uploadPath = '/Applications/MAMP/htdocs/mysocialnetwork/public/images/post-images/';
            $fileName = uniqid() . '_' . basename($fileData['image']['name']);
            $targetFilePath = $uploadPath . $fileName;

            move_uploaded_file($fileData['image']['tmp_name'], $targetFilePath);
        } else {
            $fileName = null;
        }

        $result = $this->postModel->create($postData, $fileName, $creatorId);

        return $result;
    }
    public function displayPostDetails($id_post)
    {
        return $this->postModel->getPostDetails($id_post);
    }

    public function postsCurrentUser($id_user)
    {
        return $this->postModel->getUserPosts($id_user);
    }

    public function updatePostController($id_post, $postData, $fileData)
    {
        if (isset($fileData['image']) && $fileData['image']['error'] == 0) {
            $uploadPath = '/Applications/MAMP/htdocs/mysocialnetwork/public/images/post-images/';
            $fileName = uniqid() . '_' . basename($fileData['image']['name']);
            $targetFilePath = $uploadPath . $fileName;

            move_uploaded_file($fileData['image']['tmp_name'], $targetFilePath);
        } else {
            $fileName = null;
        }

        return $this->postModel->updatePost($id_post, $postData, $fileName);
    }
}