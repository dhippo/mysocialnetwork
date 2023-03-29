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

    public function create($postData, $fileName, $creatorId)
    {
        $creatorEmail = $_SESSION['user_email'];
        $title = $postData['title'];
        $content = $postData['content'];
        $category = $postData['category'];
        $visibility = $postData['visibility'];
        $created_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO posts (creator_email, title, image, content, category, created_at, visibility) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$creatorEmail, $title, $fileName, $content, $category, $created_at, $visibility]);
    }

    public function getUserPosts($id_user)
    {
        $user = new User($this->pdo);
        $user_email = $user->getEmailById($id_user);
        $sql = "SELECT * FROM posts WHERE creator_email = ? ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$user_email]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function getPostDetails($id_post)
    {
        $sql = "SELECT * FROM posts WHERE id_post = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_post]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePost($id_post, $postData, $fileName)
    {
        $title = $postData['title'];
        $content = $postData['content'];
        $category = $postData['category'];
        $visibility = $postData['visibility'];
        $updated_at = date('Y-m-d H:i:s');

        $sql = "UPDATE posts SET title = ?, image = ?, content = ?, category = ?, visibility = ?, updated_at = ? WHERE id_post = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$title, $fileName, $content, $category, $visibility, $updated_at, $id_post]);
    }



}
