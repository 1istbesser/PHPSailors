<?php

namespace PHPSailors;

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Symfony\Component\Routing\Exception\NoConfigurationException;

class Application
{
    private $controllerNameSpace  = "PHPSailors\Controllers\\";
    private $routes;
    private $context;

    public function __construct()
    {
        $this->routes = new RouteCollection();
        $this->context = new RequestContext();
    }

    public function run()
    {
        /**
         * This exception handler catches any exceptions that 
         * haven't been caught in the application and renders 
         * an internal error page message directly, without 
         * calling any other components. 
         */
        set_exception_handler(function ($exception) {
            error_log($exception);
            http_response_code(500);
            echo INTERNALERRORMESSAGE;
            exit;
        });

        /**
         * Init RequestContext object
         * Meaning it populates fields like baseURL, pathInfo, 
         * method, host, schema, httpPort, queryString etc... 
         * for the context object overriding the default ones.
         */
        $this->context->fromRequest(Request::createFromGlobals());

        /**
         * Init UrlMatcher object
         */
        $matcher = new UrlMatcher($this->routes, $this->context);

        /**
         * Try to match the route against our list of routes
         */
        try {
            $parameters = $matcher->match($this->context->getPathInfo());
        } catch (ResourceNotFoundException $exception) {
            $parameters['controller'] = 'ErrorController';
            $parameters['method'] = 'getNotFoundPage';
        } catch (MethodNotAllowedException $exception) {
            $parameters['controller'] = 'ErrorController';
            $parameters['method'] = 'getNotFoundPage';
        } catch (NoConfigurationException $exception) {
            $parameters['controller'] = 'ErrorController';
            $parameters['method'] = 'getInternalErrorPage';
        }

        /**
         * Define the full namespaced controller name and 
         * check to see if the class exists.
         */
        $controllerName = $this->controllerNameSpace . $parameters['controller'];

        if (!class_exists($controllerName)) {
            error_log("The controller class {$controllerName} does not exist.");
            $parameters['controller'] = 'ErrorController';
            $parameters['method'] = 'getInternalErrorPage';
        };

        /** 
         * Create the controller object
         */
        $controller = new $controllerName();

        /**
         * If the controller's method defined within the route exists, 
         * call it to handle the request further.
         */
        if (!method_exists($controller, $parameters['method'])) {
            error_log("The method {$parameters['method']} doesn't exist in controller {$controllerName}.");
            $parameters['controller'] = 'ErrorController';
            $parameters['method'] = 'getInternalErrorPage';
        }

        call_user_func_array([$controller, $parameters['method']], [$parameters]);
    }

    public function addRoute($routeName, $routeObject)
    {
        $this->routes->add($routeName, $routeObject);
    }
}
