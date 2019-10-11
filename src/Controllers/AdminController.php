<?php 
namespace PHPSailors\Controllers;
use PHPSailors\Core\Controller;
use PHPSailors\Services\MainService;

class AdminController extends Controller{
    private $service;
    private $firstName;
    private $lastName;
    const USER = "user";
    const ADMIN = "admin";

    public function __construct(){
        parent::__construct();
        $this->redirectUnauthenticatedUsers();
        $this->service = new MainService();
        $this->firstName = $_SESSION['first_name'];
        $this->lastName = $_SESSION['last_name'];
    }

    public function getIndex($parameters){

        $this->setView();
        $this->renderview('admin/index', [
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
        ]);
    }

}