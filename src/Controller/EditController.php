<?php

namespace Controller;

use Core\Response;
use Doctrine\ORM\EntityManagerInterface;
use Model\User;

class EditController {
    private $entityManager;

    public function __construct() {
        global $entityManager; 
        $this->entityManager = $entityManager;
    }

    public function render($request): Response {
        // Authentication
        session_start();
        if (!isset($_SESSION['id'])) {
            $response = new Response();
            $response->setRedirect("/denied");
            return $response;
        }

        if ($request->getMethod() === 'POST' && isset($_POST['submit'])) {
            return $this->handleEditProfile();
        } else {
            // Render the edit profile form
            return $this->generateEditForm();
        }
    }

    private function handleEditProfile(): Response {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $age = $_POST['age'];
        $id = $_SESSION['id'];

        // Validating form data
        if (empty($name) || empty($email) || empty($age) || empty($id)) {
            $errorMessage = "Please fill all fields.";

            $response = new Response();
            $response = $this->generateEditForm($errorMessage);
            return $response;
        }

        // Retrieve user entity
        $userRepo = $this->entityManager->getRepository(User::class);
        $user = $userRepo->find($id);

        if (!$user) {
            // Handle user not found
            $errorMessage = "User not found.";
            $response = new Response();
            $response = $this->generateEditForm($errorMessage);
            return $response;
        }

        // Update user data
        $user->setName($name);
        $user->setEmail($email);
        $user->setAge($age);

        // Persist changes to database
        $this->entityManager->flush();

        $_SESSION['name'] = $name;
        $_SESSION['email'] = $email;
        $_SESSION['age'] = $age;

        // Redirect to home page
        $response = new Response();
            $response->setRedirect("/");
            return $response;
    }

    private function generateEditForm($errorMessage = ""): Response {

        $viewPath = __DIR__ . "/../View/edit_view.php";
        $response = new Response();
        $response->setContent($viewPath);
        return $response;
 
    }
}
