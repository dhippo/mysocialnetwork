<?php
session_start();
//print('$_SESSION=<pre>'.print_r($_SESSION, true).'</pre><br><br>');

/** DATABASE */
require_once 'app/models/Database.php';
$pdo = new Database();
$pdo_connection = $pdo->getConnection();

/** MODELS */
require_once 'app/models/UserDAO.php';
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

if (isset($_SESSION['id_user'])) {
    $userDAO = new UserDAO($pdo_connection);
    $userModel = $userDAO->getUserById($_SESSION['id_user']);
}

switch ($requestedPage) {
    case 'login':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $authController->loginController();
        } else {
            $authController->showLogin();
        }
        break;

    case 'register':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $authController->registerController();
        } else {
            $authController->showRegister();
        }
        break;

    case 'home':
        if ($authController->isAuthenticated()) {
            require_once 'app/views/layouts/header.php';
            require_once 'app/views/home.php';
        } else {
            header('Location: ' . $_SERVER['PHP_SELF'] . '?page=login');
            exit;
        }
        break;
    case 'logout':
        $authController->logout();
        header('Location: ' . $_SERVER['PHP_SELF'] . '?page=login');
        exit;

    default:
        http_response_code(404);
        echo "Page non trouvée";
        break;
}

