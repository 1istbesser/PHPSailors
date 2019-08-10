<?php 
namespace PHPSailors\Controllers;
use PHPSailors\Core\Controller;
use PHPSailors\Services\MainService;

class AdminController extends Controller{
    private $service;

    public function __construct()
    {
        parent::__construct();
        $this->service = new MainService();
        $auth_token = $this->service->getAuthToken($_SESSION['i_u']);
        $this->isLoggedIn($_SESSION['a_t'], $auth_token);
    }

    public function getIndex($parameters){
        $this->setView();
        $this->renderview('admin/index', [
        ]);
    }
    
    public function doLogOut($parameters){
        $auth_token = $_SESSION['a_t'];
        $id_user = $_SESSION['i_u'];
        $this->service->logout($id_user, $auth_token);
        unset($_SERVER['a_t']);
        unset($_SERVER['i_u']);
        session_destroy();
        header("location: /log-in");
        exit;
    }

}