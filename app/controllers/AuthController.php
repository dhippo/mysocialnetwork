<?php
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/User.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class AuthController
{
    private $userModel;
    private $adminModel;

    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
        $this->adminModel = new Admin($pdo);

    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['id_user']) || isset($_SESSION['id_admin'])) {
             return isset($_SESSION['id_user']);
        } elseif(isset($_SESSION['id_admin'])) {
            return $_SESSION['id_admin'];
        }else{
            return false;
        };

    }

    /** *********************************************************************/
    /** ******************            AUTH             *********************/
    // case 'register':
    public function registerController()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Vérifier et valider les données du formulaire
            $email = $_POST['email'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $password = $_POST['password'];
            $promo = $_POST['promo'];
            $statut = $_POST['statut'];
            $birth_date = $_POST['birth_date'];

            // Inscription de l'utilisateur
            $result = $this->userModel->register($email, $first_name, $last_name, $password, $promo, $statut, $birth_date);
            if ($result) {
                // Rediriger vers la page de connexion
                $params = array('page' => 'login');
                $queryString = http_build_query($params);
                header('Location: ' . $_SERVER['PHP_SELF'] . '?' . $queryString);
            } else {
                // Afficher un message d'erreur
                echo "Erreur lors de l'inscription.";
            }
        }
    }

    // case 'login':
    public function loginController()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->login($email, $password);

            if ($user) {
                session_start();
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['user_email'] = $user['email'];
                $params = array('page' => 'home');
                $queryString = http_build_query($params);
                header('Location: ' . $_SERVER['PHP_SELF'] . '?' . $queryString);
            } else {
                echo "Identifiants incorrects.";
            }

            // Vérifier si l'utilisateur est également un administrateur
            $admin = $this->adminModel->login($email, $password);
            if ($admin) {
                session_start();
                $_SESSION['id_admin'] = $admin['id_admin'];
                $_SESSION['admin_email'] = $admin['email'];
                $params = array('page' => 'admin_validator');
                $queryString = http_build_query($params);
                header('Location: ' . $_SERVER['PHP_SELF'] . '?' . $queryString);
            }
        }
    }




}
