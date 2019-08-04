<?php 
namespace PHPSailors\Controllers;
use PHPSailors\Core\Controller;
use PHPSailors\Services\MainService;

class AuthenticationController extends Controller{
    private $service;
    public function __construct()
    {
        parent::__construct();
        $this->service = new MainService();
    }

    public function getRegister($parameters){
        $this->setView();
        $this->renderview('register', [
        ]);
    }
    public function postRegister($parameters){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $registered = $this->service->registerUser($email, $password);
        if($registered){
            header("location: /register");
            exit;
        } else {
            header("location: /register");
        }

        exit;
    }

    
    public function getLogin($parameters){
        $this->setView();
        $this->renderview('login', [
        ]);
    }
    public function postLogin($parameters){
        echo "post";
        exit;
    }

}