<?php

namespace Controller;

use Core\Response;
use Controller\BaseController;

class AccessDenied extends BaseController {
    public function render($request): Response {

        $response = new Response();

        $viewPath = __DIR__ . "/../View/access_denied.php";
        
        
        $response->setContent($viewPath);

        return $response;
    }
}