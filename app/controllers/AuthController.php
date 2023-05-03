<?php
require_once __DIR__ . '/../models/Database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/UserDAO.php';

class AuthController
{
    private $userDAO;

    public function __construct($pdo)
    {
        $this->userDAO = new UserDAO($pdo);
    }

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
            $bio = 'vie nulle';
            $birth_date = $_POST['birth_date'];
            $profile_picture = 'photo nulle';
            $interests = 'interets nuls';

            // Inscription de l'utilisateur
            $result = $this->userDAO->register($email, $first_name, $last_name, $password, $promo, $statut, $bio, $birth_date, $profile_picture, $interests);
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

    public function loginController()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userModel = $this->userDAO->login($email, $password);

            if ($userModel){
                // Créer une session
                $_SESSION['id_user'] = $userModel->getId();
                //Rediriger vers la page de home
                $params = array('page' => 'home');
                $queryString = http_build_query($params);
                header('Location: ' . $_SERVER['PHP_SELF'] . '?' . $queryString);
            } else {
                echo "Identifiants incorrects.";
            }
        }
    }
    public function showLogin()
    {
        require_once 'app/views/auth/login.php';
    }

    public function showRegister()
    {
        require_once 'app/views/auth/register.php';
    }

    public function isAuthenticated()
    {
        return isset($_SESSION['id_user']);
    }

    public function logout()
    {
        session_unset();
        session_destroy();
    }


    public function isLoggedIn()
    {
        return isset($_SESSION['id_user']);
    }

}