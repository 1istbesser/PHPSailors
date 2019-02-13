<?php
namespace PHPSailors;
use PHPSailors\Controllers\HomeController;
use PHPSailors\Controllers\ProductsController;
use PHPSailors\Controllers\CategoryController;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Application{
    private $controllerNameSpace  = "PHPSailors\Controllers\\";
    private $routes;
    private $context;
    
    public function __construct(){
        $this->routes = new RouteCollection();
        $this->context = new RequestContext();
    }

    public function run(){
        try{
            
            // Init RequestContext object
            $this->context->fromRequest(Request::createFromGlobals());

            // Init UrlMatcher object
            $matcher = new UrlMatcher($this->routes, $this->context);

            // Find the current route
            $parameters = $matcher->match($this->context->getPathInfo());

            // How to generate a SEO URL
            //    $generator = new UrlGenerator($routes, $context);
            //    $url = $generator->generate('foo_placeholder_route', array(
            //        'id' => 123,
            //    ));

            //var_dump($parameters);

            try{
                if(class_exists($this->controllerNameSpace.$parameters['controller'])){
                    $controllerName= $this->controllerNameSpace.$parameters['controller'];
                    $controller = new $controllerName();
                    call_user_func_array([$controller, $parameters['method']], [$parameters]);
                }
            } catch(\Exception $e){
                error_log($e->getMessage());
            }
            exit;
        }
        catch (ResourceNotFoundException $e)
        {
            error_log($e->getMessage());
        }
    }

    public function addRoute($routeName, $routeObject){
        $this->routes->add($routeName, $routeObject);
    }
}