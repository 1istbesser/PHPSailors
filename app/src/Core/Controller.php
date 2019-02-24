<?php 
namespace PHPSailors\Core;

class Controller{
    private $view;

    public function __construct()
    {   

    }
    public function setView():void{
        $this->view = new View();
    }

    public function renderView($view_file_name, $view_data):void{
        $this->view->renderView($view_file_name, $view_data);
    }

    public function getView():View{
        return $this->view;
    }

    public function isLoggedIn(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if( !isset($_SESSION['user']) || empty($_SESSION['user']) ){
            header("location: /login");
            exit;
        }
    }

    public function isAuthorisedToConfigure(){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if($_SESSION['group'] === "admin"){
            return true;
        } else {
            return false;
        }
    }
}