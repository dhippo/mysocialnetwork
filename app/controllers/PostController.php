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

    /** *********************************************************************/
    /** ******************            HOME             *********************/
    // case 'home':
    public function displayAllPublicPosts()
    {
        if (isset($_GET['category'])) {
            switch ($_GET['category']) {
                case 'event':
                    return $this->postModel->getAllPublicPostsByCategory('event');
                case 'news':
                    return $this->postModel->getAllPublicPostsByCategory('news');
                case 'other':
                    return $this->postModel->getAllPublicPostsByCategory('other');
                case 'teacher':
                    return $this->postModel->getAllPublicPostsByCreatorEmail('@omneseducation.com');
                case 'student':
                    return $this->postModel->getAllPublicPostsByCreatorEmail('@edu.ece.fr');
            }
        }
        return $this->postModel->getAllPublicPosts();
    }



    /** ***********************************************************************/
    /** ******************            PROFILE          ***********************/
    // case 'profile':
    // case 'user_profile':
    public function postsCurrentUser($id_user)
    {
        return $this->postModel->getUserPosts($id_user);
    }
    //case: feed
    public function displayFriendsPosts()
    {
        $id_user = $_SESSION['id_user'];
        $userModel = new User($this->pdo);
        $friendsIds = $userModel->getFriendsIds($id_user);

        // Récupérer les adresses e-mail des amis à partir de leurs identifiants
        $friendsEmails = array_map(function ($id) use ($userModel) {
            return $userModel->getEmailById($id);
        }, $friendsIds);

        return $this->postModel->getFriendsPosts($friendsEmails);
    }




    /** ***********************************************************************/
    /** ******************            POSTS          *************************/
    // case 'show_posts':
    //++++++++++++++++++ case 'edit_post'
    //++++++++++++++++++ case 'add_like'
    //++++++++++++++++++ case 'add_dislike'

    public function displayPostDetails($id_post)
    {
        return $this->postModel->getPostDetails($id_post);
    }
    // case 'create'
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
    //case 'edit_post'
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
    public function deletePostController($id_post)
    {
        return $this->postModel->deletePost($id_post);
    }



    /** ***********************************************************************/
    /** ******************            LIKES          *************************/
    // case 'add_like'
    public function addLikeController($id_post) {

        if (isset($_GET['id_post']) && isset($_POST['like'])) {
            $id_post = $_GET['id_post'];
            $this->postModel->addLike($id_post, 1);
            if ($this->postModel->addLike($id_post, 1) !== null) {
                header('Location: ?page=home');
            }
        }
        
    }
    // case 'add_dislike'
    public function addDislikeController($id_post) {
        //var_dump('function addDislikeControlle');
        if (isset($_GET['id_post']) && isset($_POST['dislike'])) {
            //var_dump('rentre if isset get et post');
            $id_post = $_GET['id_post'];
            $this->postModel->addDislike($id_post, 1);
            if ($this->postModel->addDislike($id_post, 1) !== null) {
                header('Location: ?page=home');
            }

        }
    }


}