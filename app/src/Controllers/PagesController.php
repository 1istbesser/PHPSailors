<?php 
namespace PHPSailors\Controllers;
use PHPSailors\Core\Controller;

class PagesController extends Controller{

    public function __construct()
    {
        parent::__construct();
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