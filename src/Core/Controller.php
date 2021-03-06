<?php 
namespace PHPSailors\Core;

class Controller{
    private $view;

    public function __construct(){   

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

    public function isLoggedInAs($role){
        if(session_status() === PHP_SESSION_NONE){
            header("location: /log-in");
            exit;
        } else if( !isset($_SESSION['id_user']) || !isset($_SESSION['role']) || $_SESSION['role'] !== $role ){
            header("location: /log-in");
            exit;
        } 
    }

    public function isLoggedIn(){
        if(session_status() !== PHP_SESSION_NONE && isset($_SESSION['id_user']) && isset($_SESSION['role'])){
            return true;
        } else {
            return false;
        }
    }

    public function redirectUnauthenticatedUsers(){
        if(session_status() === PHP_SESSION_NONE){
            header("location: /log-in");
            exit;
        } else if( !isset($_SESSION['id_user']) || !isset($_SESSION['role']) ){
            header("location: /log-in");
            exit;
        } 
    }

}