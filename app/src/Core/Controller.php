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

    public function isLoggedIn($auth_token, $auth_token_db_obj){
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
        if( !isset($auth_token) || empty($auth_token) || !isset($auth_token_db_obj) || empty($auth_token_db_obj->auth_token_db) || ($auth_token !== $auth_token_db_obj->auth_token_db)  ){
            header("location: /log-in");
            exit;
        } 
    }

}