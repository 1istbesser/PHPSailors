<?php

namespace PHPSailors\Controllers;

use PHPSailors\Core\Controller;

class ErrorController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getOfflinePage($parameters)
    {
        http_response_code(503);
        $this->setView();
        $this->renderview('error/offline', []);
    }

    public function getNotFoundPage($parameters)
    {
        http_response_code(404);
        $this->setView();
        $this->renderview('error/404', []);
    }

    public function getInternalErrorPage($parameters)
    {
        http_response_code(500);
        $this->setView();
        $this->renderview('error/500', []);
    }
}
