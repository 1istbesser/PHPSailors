<?php 
namespace PHPSailors\Controllers;
use PHPSailors\Core\Controller;

class ErrorController extends Controller{
    
    public function __construct()
    {
        parent::__construct();
    }

    public function getOfflinePage($parameters){
        $this->setView();
        $this->renderview('error/offline', [
        ]);
    }

    public function getNotFoundPage($parameters){
        $this->setView();
        $this->renderview('error/404', [
        ]);
    }

    public function getInternalErrorPage($parameters){
        $this->setView();
        $this->renderview('error/500', [
        ]);
    }

}