<?php 
namespace PHPSailors\Controllers;
use PHPSailors\Core\Controller;
use PHPSailors\Services\MainService;

class HomeController extends Controller{
    private $service;
    public function __construct()
    {
        parent::__construct();
        $this->service = new MainService();
    }
    public function showhomePage($parameters){
        $products = $this->service->getAllProducts();
        echo $this->getTwig()->render('index.html.twig', ['products' => $products] );
    }
}