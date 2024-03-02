<?php

namespace Controller;

use Core\Response;
use Doctrine\ORM\EntityManagerInterface;
use Model\User;

class LoginController extends BaseController {
    private $entityManager;

    public function __construct() {
        global $entityManager; 
        $this->entityManager = $entityManager;
    }

    public function render($request): Response {
        // Check if the user is already logged in
        session_start();
        if(isset($_SESSION['id'])) {
            $response = new Response();
            $response->setRedirect("/");
            return $response;
        }

        // Handle form submission
        if ($request->getMethod() === 'POST' && isset($_POST['submit'])) {
            //echo "post";
            return $this->handleLogin($request);
        } elseif ($request->getMethod() === 'GET') {
            // Render the login form
            
            return $this->renderLoginForm();
        }
    }

    private function handleLogin($request): Response {
        // Retrieve form data
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the email exists
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        
       // print_r($user);
        //echo"<br>";
       // print_r(password_hash($password, PASSWORD_DEFAULT));
       // die;

        // Validate the password
        
        
        if (md5($password) === $user->getPassword()) {
            // Start the session and set user data
            session_start();
            $_SESSION['id'] = $user->getId();
            //$_SESSION['email'] = $user->getEmail();
            //$_SESSION['name'] = $user->getName();
            //$_SESSION['age'] = $user->getAge();
            // Redirect to home page
            $response = new Response();
            $response->setRedirect("/");

            return $response;
        } else {
            // Invalid credentials, display error message
            echo "<script>alert('Invalid email or password, you will be redirected to the login<br>');</script>";
            // Redirect to login page
            $response = new Response();
            $response->setRedirect("/login");

            return $response;
        }
    }

    private function renderLoginForm(): Response {
        // Render the login form
        $viewPath = __DIR__ . "/../View/login_view.php";
        
        $response = new Response();
        $response->setContent($viewPath);
        return $response;
    }
}
