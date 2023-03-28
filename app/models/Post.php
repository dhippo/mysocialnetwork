<?php

class Post
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllPublicPosts()
    {
        $query = "SELECT * FROM posts WHERE visibility = 'public' ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($postData, $fileData, $creatorId)
    {
        $creatorEmail = $_SESSION['id_user'];
        $title = $postData['title'];
        $content = $postData['content'];
        $category = $postData['category'];
        $visibility = $postData['visibility'];
        $created_at = date('Y-m-d H:i:s');

        if (!empty($fileData['image']['name'])) {
            $image = $this->uploadImage($fileData['image']);
            if (!$image) {
                return false;
            }
        } else {
            $image = NULL;
        }

        $sql = "INSERT INTO posts (creator_email, title, image, content, category, created_at, visibility) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$creatorEmail, $title, $image, $content, $category, $created_at, $visibility]);
    }

    public function getUserPosts($user_email)
    {
        $user_email = $_SESSION['user_email'];
        $sql = "SELECT * FROM posts WHERE creator_email = ? ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_email]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPostDetails($id_post)
    {
        $sql = "SELECT * FROM posts WHERE id_post = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_post]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
