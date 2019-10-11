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
        $loggedIn = $this->isLoggedIn();
        if($loggedIn){
            header("location: /admin");
            exit;
        }

        $msg = "";

        if(isset($parameters['login']) && $parameters['login'] === 'offline'){
            $msg = "offline";
        } 

        if(isset($parameters['login']) && $parameters['login'] === '404'){
            $msg = '404';
        } elseif(isset($parameters['login']) && $parameters['login'] === '403'){
            $msg = '403';
        }

        $this->setView();
        $this->renderview('login', [
            'msg' => $msg
        ]);
    }

    public function postLogin($parameters){
        $connected = $this->service->databaseConnectionEstablished();

        if(!$connected){
            $this->getLogin(['login'=>'offline']);
            exit;
        }


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
                $_SESSION['id_user'] = $authentication_result->id_user;
                $_SESSION['role'] = $authentication_result->role;
                $_SESSION['first_name'] = $authentication_result->first_name;
                $_SESSION['last_name'] = $authentication_result->last_name;
                header("location: /admin");
                exit;
            }   
        } else {
            header("location: /500");
            exit;
        }
    }

    public function doLogOut($parameters){
        unset($_SERVER['id_user']);
        unset($_SERVER['role']);
        session_destroy();
        header("location: /log-in");
        exit;
    }

}