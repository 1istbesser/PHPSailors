<?php 
namespace PHPSailors\Controllers;
use PHPSailors\Core\Controller;
use PHPSailors\Services\MainService;

class PagesController extends Controller{
    private $service;
    public function __construct()
    {
        parent::__construct();
        // try{
        //     $this->service = new MainService();
        // } catch(\Exception $e){
        //     error_log("Database is offline.");
        //     header("location: /offline");
        //     exit;
        // }
    }
    public function getIndex($parameters){
        $this->setView();
        $this->renderview('index', [
        ]);
    }
    public function getRegister($parameters){
        $this->setView();
        $this->renderview('register', [
        ]);
    }
    public function getLogin($parameters){
        $this->setView();
        $this->renderview('login', [
        ]);
    }
    public function getPrivacyPolicy($parameters){
        $this->setView();
        $this->renderview('privacyPolicy', [
        ]);
    }
}