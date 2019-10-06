<?php 
namespace PHPSailors\Controllers;
use PHPSailors\Core\Controller;
use PHPSailors\Services\MainService;

class RegisterController extends Controller{
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new MainService();
    }

    public function getRegister($parameters){

        if(isset($parameters['register']) && $parameters['register'] === '200'){
            $msg = "<p class='text-center text-success'>The account has been created successfully!</p>";
        } elseif(isset($parameters['register']) && $parameters['register'] === '409'){
            $msg = "<p class='text-center text-danger'>Failed to create the account, the email has already been registered!</p>";
        } elseif(isset($parameters['register']) && $parameters['register'] === '500'){
            header("location: /500");
            exit;
        } elseif(isset($parameters['register']) && $parameters['register'] === 'offline'){
            $msg = "<p class='text-center text-danger'>Failed to create the account, the database is unavailable.</p>";
        } else {
            $msg = "";
        }
        $this->setView();
        $this->renderview('register', [
            'msg' => $msg
        ]);
    }
    
    public function postRegister($parameters){
        $connected = $this->service->databaseConnectionEstablished();
        
        if(!$connected){
            $this->getRegister(['register'=>'offline']);
            exit;
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        $registered = $this->service->registerUser($email, $password);

        if(200 === (int)$registered){
            $this->getRegister(['register'=>'200']);
            exit;
        } elseif( 409 === (int) $registered) {
            $this->getRegister(['register'=>'409']);
            exit;
        } elseif( 500 === (int) $registered){
            $this->getRegister(['register'=>'500']);
            exit;
        }
        exit;
    }

}