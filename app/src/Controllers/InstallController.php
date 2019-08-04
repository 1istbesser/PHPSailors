<?php 
namespace PHPSailors\Controllers;
use PHPSailors\Core\Controller;
use PHPSailors\Services\MainService;

class InstallController extends Controller{
    private $service;
    public function __construct()
    {
        parent::__construct();
        $this->service = new MainService();
    }

    public function installApp($parameters){
        $this->setView();
        $this->renderview('install', [
        ]);
    }


}