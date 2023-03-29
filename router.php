<?php
/** IMPORTER SESSION ET CACHES */
ob_start();
session_start();

/** IMPORTER LES FONCTIONS DES CONTROLEURS ET MODÈLES DE MON APPLICATION */
/** DATABASE */
require_once 'app/models/Database.php';
$pdo = new Database();
$pdo_connection = $pdo->getConnection();
/** MODELS */
require_once 'app/models/User.php';
require_once 'app/models/Post.php';
/** CONTROLLERS */
/* AuthController */
require_once 'app/controllers/AuthController.php';
$authController = new AuthController($pdo_connection);
/* UserController */
require_once 'app/controllers/UserController.php';
$userController = new UserController($pdo_connection);
/* PostController */
require_once 'app/controllers/PostController.php';
$postController = new PostController($pdo_connection);


$requestedPage = isset($_GET['page']) ? $_GET['page'] : 'register'; //page de base si aucun argument, si un user est connecté, il sera redirigé vers la page home

/** condition test si l'utilisateur est l'utilisateur est connecté */
if (!$authController->isLoggedIn() && !in_array($requestedPage, ['login', 'register'])) {
    /** PAS CONNECTÉ  */
    // Rediriger vers la page de connexion
    $params = array('page' => 'login');
    $queryString = http_build_query($params);
    header('Location: ' . $_SERVER['PHP_SELF'] . '?' . $queryString);
    exit;
} else {
    /** CONNECTÉ  */
    if(isset($_SESSION['id_user'])){
        $userFullName = $userController->getUserNameById($_SESSION['id_user']);
        $_SESSION['first_name'] = $userFullName['first_name'];
        $_SESSION['last_name'] = $userFullName['last_name'];
        $_SESSION['profile_picture'] = $userFullName['profile_picture'];
    }
}

/** FAIRE APPARAITRE LE HEADER (+ DASHBOARD) DANS TOUTES LES PAGES SAUF LOGIN ET REGISTER */
// condition pour afficher le header: ne pas être sur la page de connexion ou d'inscription ou $_GET['page'] non défini
if (!in_array($requestedPage, ['login', 'register'])) {
    if(isset($_GET['page'])){
       require_once 'app/views/layouts/header.php';
    }
}

/** *********/
/** ROUTER */
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
        $id_user = $_SESSION['id_user'];
        $userInfo = $userController->displayMyProfile();
        $userPosts = $postController->postsCurrentUser($id_user);

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
                $result = $postController->createPost($_POST, $_FILES, $_SESSION['id_user']);
                if ($result) {
                    header('Location: ?page=home');
                    exit();
                } else {
                    echo "<script>alert('Erreur lors de la création du post')</script>";
                }
            }
            require_once 'app/views/posts/create.php';
        } else {
            header('Location: ?page=login');
            exit();
        }
        break;
    case 'edit_post':

        if (isset($_GET['id_post']) && !empty($_GET['id_post'])) {
            $id_post = $_GET['id_post'];
            $postInfo = $postController->displayPostDetails($id_post);
            if (isset($_POST['submit'])) {
                if ($postController->updatePostController($id_post, $_POST, $_FILES)) {
                    header('Location: ?page=home');
                    exit();
                } else {
                    echo "Erreur lors de la mise à jour du post.";
                }
            }
            require_once 'app/views/posts/edit.php';
        } else {
            var_dump($_GET['id_post']);
        }
        break;
    case 'user_profile':
        if (isset($_GET['email_user_to_see']) && !empty($_GET['email_user_to_see'])) {
            $email_user_to_see = $_GET['email_user_to_see'];
            $userProfileInfo = $userController->getUserProfileByEmail($email_user_to_see);
            require_once 'app/views/profiles/user_profile.php';
        } else {
            header('Location: ?page=home');
        }
        break;
    case 'all_users':
        $allUsers = $userController->displayAllUsers();
        require_once 'app/views/relations/all_users.php';
        break;
    case 'ask_friend':
        $userController->addFriendController();
        break;
    case 'add_friend':
        if (isset($_GET['notif_id']) && !empty($_GET['notif_id'])) {
            $userController->acceptFriendRequest($_GET['notif_id']);
        } else {
            header('Location: ?page=home');
        }
        break;
    case 'refuse_friend':
        if (isset($_GET['notif_id']) && !empty($_GET['notif_id'])) {
            $userController->refuseFriendRequest($_GET['notif_id']);
        } else {
            header('Location: ?page=home');
        }
        break;
    case 'notifs':
        $notifications = $userController->displayMyNotifications();
        require_once 'app/views/notifications/my_notifs.php';
        break;

    case 'admin_validator':

        $allUsers = $userController->displayAllUsers();
        // $allUsers : résultat de "SELECT * FROM users"
//test

        require_once 'app/views/admin/admin_validator.php';
        break;

    case 'logout':
        session_destroy();
        header('Location: http://localhost:8888/mysocialnetwork/public/index.php?page=login');
        break;
    default:
        http_response_code(404);
        echo "Page non trouvée";
        break;
}
ob_end_flush();


