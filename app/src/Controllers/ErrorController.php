<?php 
namespace PHPSailors\Controllers;
use PHPSailors\Core\Controller;
use PHPSailors\Services\MainService;

class ErrorController extends Controller{
    public function __construct()
    {
        parent::__construct();
    }

    public function showOfflinePage($parameters){
        $this->setView();
        $this->renderview('error/offline', [
        ]);
    }
    public function showNotFoundPage($parameters){
        $this->setView();
        $this->renderview('error/404', [
        ]);
    }
}