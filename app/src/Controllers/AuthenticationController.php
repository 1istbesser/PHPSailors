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

    public function getLogin($parameters){
        $this->setView();
        $this->renderview('login', [
        ]);
    }

    public function postLogin($parameters){
        $email = $_POST['email'];
        $password = $_POST['password'];
        $authentication_result = $this->service->login($email, $password);

        if(isset($authentication_result->response_code)){
            if(404 === (int)$authentication_result->response_code){
                $this->getLogin(['login'=>'404']);
                exit;
            } elseif(403 === (int)$authentication_result->response_code){
                $this->getLogin(['login'=>'403']);
                exit;
            } elseif(200 === (int)$authentication_result->response_code){
                $_SESSION['i_u'] = $authentication_result->id_user;
                $_SESSION['a_t'] = $authentication_result->auth_token;
                header("location: /admin");
                exit;
            }   
        } else {
            header("location: /500");
            exit;
        }
    }

}