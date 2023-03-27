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
require_once 'app/controllers/AuthController.php';
$authController = new AuthController($pdo_connection);

require_once 'app/controllers/PostController.php';
$postController = new PostController($pdo_connection);


$requestedPage = isset($_GET['page']) ? $_GET['page'] : 'register'; //page de base si aucun argument

if (!$authController->isLoggedIn() && !in_array($requestedPage, ['login', 'register'])) {
    // Rediriger vers la page de connexion
    $params = array('page' => 'login');
    $queryString = http_build_query($params);
    header('Location: ' . $_SERVER['PHP_SELF'] . '?' . $queryString);
    exit;
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


    default:
        http_response_code(404);
        echo "Page non trouvée";
        break;
}


