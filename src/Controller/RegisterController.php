<?php

namespace Controller;

use Core\Response;
use Core\Request;
use Model\User;
use Doctrine\ORM\EntityManagerInterface;

class RegisterController extends BaseController {
    private $entityManager;

    public function __construct() {
        global $entityManager; 
        $this->entityManager = $entityManager;
    }

    public function render($request): Response {
        // Check if the user is already logged in
        if(isset($_SESSION['id'])) {
            $response = new Response();
            $response->setRedirect("/");
            return $response;
        }

        //$this->renderRegisterForm();

        // Handle form submission
        if ($request->getMethod() === 'POST' && isset($_POST['submit'])) {
            return $this->handleRegistration($request);
        } else {
            // Render the registration form
            return $this->renderRegisterForm();
        }
    }

    private function handleRegistration(Request $request): Response {
        // Retrieve form data
        $name = $_POST['name'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $password = $_POST['password'];

        // Check if email already exists
        $existingUser = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);
        if($existingUser) {
            $errorMessage = "This email address is already in use. Please try another.";
            $response = new Response();
            $response->setContent($this->renderRegisterForm($errorMessage));
            return $response;
        } else {
            // Insert user into database
            $user = new User();
            $user->setName($name);
            $user->setEmail($email);
            $user->setAge($age);
            $user->setPassword($password);

            $this->entityManager->persist($user);
            $this->entityManager->flush();

            $response = new Response();
            $response->setRedirect("/login");

            return $response;
        }
    }

    private function renderRegisterForm(): Response{
        
        $viewPath = __DIR__ . "/../View/register_view.php";
        $response = new Response();
        $response->setContent($viewPath);
        return $response;
    }
}
