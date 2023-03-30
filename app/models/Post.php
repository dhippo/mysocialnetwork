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

    public function getAllPublicPostsByCategory($category)
    {
        $query = "SELECT * FROM posts WHERE visibility = 'public' AND category = :category ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['category' => $category]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllPublicPostsByCreatorEmail($email)
    {
        $query = "SELECT * FROM posts WHERE visibility = 'public' AND creator_email LIKE :email ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['email' => '%' . $email]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getFriendsPosts($friendsEmails)
    {
        // Vérifier si le tableau $friendsEmails est vide
        if (empty($friendsEmails)) {
            return [];
        }

        // Transformer le tableau en chaîne de caractères séparée par des virgules et entourée de guillemets simples
        $friendsEmailsStr = "'" . implode("','", $friendsEmails) . "'";

        // Modifier la requête SQL
        $sql = "SELECT posts.* FROM posts WHERE posts.creator_email IN ($friendsEmailsStr) ORDER BY posts.created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        // Récupérer les résultats
        $friendsPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $friendsPosts;
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
    public function deletePost($id_post)
    {
        $sql = "DELETE FROM posts WHERE id_post = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_post]);
    }


    public function addLike($id_post, $likes)
    {
        $sql = "UPDATE posts SET likes = likes + 1 WHERE id_post = :id_post";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id_post', $id_post);

        return $statement->execute();
    }
    public function addDislike($id_post, $dislikes)
    {
        $sql = "UPDATE posts SET dislikes = dislikes + 1 WHERE id_post = :id_post";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(':id_post', $id_post);
        return $statement->execute();
    }


}
