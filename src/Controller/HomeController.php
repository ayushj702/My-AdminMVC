<?php

namespace Controller;

use Core\Response;

class HomeController extends BaseController {
    public function render($request): Response {
        // Start session
        session_start();

        // Check if user is logged in
        if (isset($_SESSION['id'])) {
            //$userData = $this->getUserData();
            // Render home_view.php with user data
            $content = $this->renderView(__DIR__ . '/../View/home_view.php');
        } else {
            // User is not logged in, render index_view.php
            $content = $this->renderView(__DIR__ . '/../View/index_view.php');
        }
        $response = new Response();
        $response->setContent($content);
        // Return response with the rendered content
        
        return $response;
    }

    private function renderView($viewPath) {
        // Read the content of the view file
        $viewContent = $viewPath;
        
        //exception handling
        
        return $viewContent;
    }
}
