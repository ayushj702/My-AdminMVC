<?php

namespace Controller;

use Core\Response;

abstract class BaseController {
    abstract public function render($request): Response;

    
}

//use this class for methods which are to be used in other controllers frequently