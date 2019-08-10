<?php 
namespace PHPSailors\Controllers;
use PHPSailors\Core\Controller;
use PHPSailors\Services\InstallService;

class InstallController extends Controller{
    private $service;
    
    public function __construct()
    {
        parent::__construct();
        $this->service = new InstallService();
    }

    public function installApp($parameters){
        $this->service->createTables();
        $this->service->createUserRoles();
        $account = $this->service->registerAdmin();
        if(!is_object($account) && 409 === (int)$account){
            echo "The installation has already been done.";
            exit;
        } else {
            echo "The tables, user roles and an admin account have been created for you.";
            echo "<br/>";
            echo "Email: " . $account->email;
            echo "<br/>";
            echo "Password: " . $account->password;
            exit;
        }
    }

}