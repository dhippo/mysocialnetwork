<?php
session_start();

/** DATABASE */

require_once 'app/models/Database.php';
$pdo = new Database();
$pdo_connection = $pdo->getConnection();

/** MODELS */

require_once 'app/models/User.php';
require_once 'app/models/Post.php';

/** CONTROLLERS */

/** AuthController */
require_once 'app/controllers/AuthController.php';
$authController = new AuthController($pdo_connection);
/** UserController */
require_once 'app/controllers/UserController.php';
$userController = new UserController($pdo_connection);
/** PostController */
require_once 'app/controllers/PostController.php';
$postController = new PostController($pdo_connection);


$requestedPage = isset($_GET['page']) ? $_GET['page'] : 'register'; //page de base si aucun argument

if (!$authController->isLoggedIn() && !in_array($requestedPage, ['login', 'register'])) {
    // Rediriger vers la page de connexion
    $params = array('page' => 'login');
    $queryString = http_build_query($params);
    header('Location: ' . $_SERVER['PHP_SELF'] . '?' . $queryString);
    exit;
} else {
    $userFullName = $userController->getUserNameById($_SESSION['id_user']);
    $_SESSION['first_name'] = $userFullName['first_name'];
    $_SESSION['last_name'] = $userFullName['last_name'];
    $_SESSION['profile_picture'] = $userFullName['profile_picture'];
}

// condition pour afficher le header: ne pas être sur la page de connexion ou d'inscription ou $_GET['page'] non défini
if (!in_array($requestedPage, ['login', 'register'])) {
    if(isset($_GET['page'])){
       require_once 'app/views/layouts/header.php';
    }
}

switch ($requestedPage) {
    case 'login':
        $authController->loginController();
        require_once 'app/views/auth/login.php';
        break;
    case 'register':
        $authController->registerController();
        require_once 'app/views/auth/register.php';
        break;
    case 'home':
        $publicPosts = $postController->displayAllPublicPosts();
        require_once 'app/views/home.php';
        break;
    case 'home2':
        $publicPosts = $postController->displayAllPublicPosts();
        require_once 'app/views/home2.php';
        break;
    case 'profile':
        $user_id = $_SESSION['id_user'];
        $userInfo = $userController->displayMyProfile();
        require_once 'app/views/profiles/my_profile.php';
        break;
    case 'modif_profile':
        $user_id = $_SESSION['id_user'];
        $userInfo = $userController->displayMyProfile($user_id);
        if (isset($_POST['submit'])) {
            if ($userController->updateMyProfile($user_id, $_POST, $_FILES)) {
                header('Location: ?page=profile');
                exit();
            } else {
                echo "Erreur lors de la mise à jour du profil.";
            }
        }
        require_once 'app/views/profiles/modif_profile.php';
        break;
    case 'show_post':
        if (isset($_GET['id_post']) && !empty($_GET['id_post'])) {
            $id_post = $_GET['id_post'];
            $postDetails = $postController->displayPostDetails($id_post);
            require_once 'app/views/posts/show.php';
        } else {
            header('Location: ?page=home');
        }
        break;
    case 'create':
        if ($authController->isLoggedIn()) {
            if (isset($_POST['submit'])) {
                var_dump("test");
                $postController->createPost($_POST, $_FILES, $_SESSION['id_user']);

            }
            $usersPosts = $postController->postsCurrentUser($_SESSION['id_user']);
            require_once 'app/views/posts/create.php';
        } else {
            header('Location: ?page=login');
            exit();
        }
        break;


    default:
        http_response_code(404);
        echo "Page non trouvée";
        break;
}


