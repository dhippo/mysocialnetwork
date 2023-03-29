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

    public function updatePostController($id_post, $postData, $fileData, $old_image)
    {

        if (isset($fileData['image']) && $fileData['image']['error'] == 0) {
            $uploadPath = '/Applications/MAMP/htdocs/mysocialnetwork/public/images/post-images/';
            $fileName = uniqid() . '_' . basename($fileData['image']['name']);
            $targetFilePath = $uploadPath . $fileName;

            move_uploaded_file($fileData['image']['tmp_name'], $targetFilePath);
        } else {
            $fileName = $old_image;
        }

        return $this->postModel->updatePost($id_post, $postData, $fileName);
    }

    public function addLikeController($id_post) {

        if (isset($_GET['id_post']) && isset($_POST['like'])) {
            $id_post = $_GET['id_post'];
            $this->postModel->addLike($id_post, 1);
        }
    }
    public function addDislikeController($id_post) {
        //var_dump('function addDislikeControlle');
        if (isset($_GET['id_post']) && isset($_POST['dislike'])) {
            //var_dump('rentre if isset get et post');
            $id_post = $_GET['id_post'];

            $this->postModel->addDislike($id_post, 1);

        }
    }

}