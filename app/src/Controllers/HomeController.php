<?php 
namespace PHPSailors\Controllers;
use PHPSailors\Core\Controller;
use PHPSailors\Services\MainService;

class HomeController extends Controller{
    private $service;
    public function __construct()
    {
        parent::__construct();
        try{
            $this->service = new MainService();
        } catch(\Exception $e){
            error_log("Database is offline.");
            header("location: /offline");
            exit;
        }
    }
    public function showHomePage($parameters){
        $this->setView();
        $this->renderview('index', [
        ]);
    }
}