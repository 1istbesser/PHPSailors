<?php 
namespace PHPSailors\Controllers;
use PHPSailors\Core\Controller;
use PHPSailors\Services\MainService;

class AdminController extends Controller{
    private $service;
    const USER = "user";
    const ADMIN = "admin";

    public function __construct()
    {
        parent::__construct();
        $this->isLoggedInAs(AdminController::ADMIN);
        $this->service = new MainService();
    }

    public function getIndex($parameters){
        $this->setView();
        $this->renderview('admin/index', [
        ]);
    }

}