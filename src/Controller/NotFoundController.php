<?php

namespace Controller;

use Core\Response;
use Controller\BaseController;

class NotFoundController extends BaseController {
    public function render($request): Response {

        $response = new Response();

        $viewPath = __DIR__ . "/../View/not_found_view.php";

        $response->setContent($viewPath);

        return $response;
    }
}