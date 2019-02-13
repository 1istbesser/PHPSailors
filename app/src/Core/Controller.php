<?php 
namespace PHPSailors\Core;

class Controller{
    private $loader;
    private $twig;

    public function __construct()
    {   
        // Specify our Twig templates location
        $this->loader = new \Twig_Loader_Filesystem(TEMPLATES);

        // Instantiate our Twig
        $this->twig = new \Twig_Environment($this->loader);
    }
    public function getLoader(){
        return $this->loader;
    }
    public function getTwig(){
        return $this->twig;
    }
}