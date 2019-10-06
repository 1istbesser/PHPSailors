<?php
namespace PHPSailors;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;
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

            // Define the full namespaced controller name and try to reach it
            $controllerName= $this->controllerNameSpace.$parameters['controller'];
            $controller = new $controllerName();

            if(method_exists($controller, $parameters['method'])){
                call_user_func_array([$controller, $parameters['method']], [$parameters]);
            } else {
                throw new \Exception("Method " . $parameters['method'] . " doesn't exist in controller " .$controllerName);
            }

        } catch (ResourceNotFoundException $e){
            error_log($e);
            header("location: /404");
            exit;
        } catch(\Exception $e){
            error_log("Exception path: /app/src/Application.php");
            error_log($e);
            header("location: /500");
            exit;
        }catch(\Error $e){
            error_log("Error path: /app/src/Application.php");
            error_log($e);
            header("location: /500");
            exit;
        }
    }

    public function addRoute($routeName, $routeObject){
        $this->routes->add($routeName, $routeObject);
    }
}