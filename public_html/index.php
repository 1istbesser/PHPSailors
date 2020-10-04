<?php

use PHPSailors\Application;
use Symfony\Component\Routing\Route;

/*
    Define here any global constants you may want to use throughout your application, 
    however, please limit the usage of "define" and instead use "const" to define 
    constants within classes.

    TEMPLATES -> /templates
*/

define('TEMPLATES', dirname(__DIR__) . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR);
define('ADMINISTRATOREMAIL', "tamer.altintop@gmail.com");
define('APPNAME', "PHPSailors");
define('JSVERSION', 1.0);
define('CSSVERSION', 1.0);
define('INTERNALERRORMESSAGE', "<h1>Internal Server Error</h1>
<p>The server has encountered an internal error or misconfiguration and was unable to compelte your request.</p>
<p>Please contact the server administrator and inform them of the time and URL of the occured error.</p>");


/*
    The application depends on a few components installed through Composer, therefore 
    if you didn't run "composer install" within the root directory of your project, 
    an internal error with a clear message should be the exit point. 
*/

if (file_exists('../vendor/autoload.php')) {
    require_once('../vendor/autoload.php');
} else {
    error_log("Error path: /public_html/index.php");
    error_log("/vendor/autoload.php doesn't exist. Run composer install inside root of your app.");
    http_response_code(500);
    echo INTERNALERRORMESSAGE;
    exit;
}

$app = new Application();

/* 
    Declare all routes below 

    To add a route, you must specify the route name and a route object. 
    For the route object, you have the following possible fields:
    - string $path
    -- The URI with any parameters between curly brackets,
    - array $defaults
    -- An array with the controller and the method name
    - array $requirements
    -- Depending on your number of parameters, other arrays matching the 
       parameter name to a regular expression.
    - array $options
    - string $host
    - $schemes
    - $methods
    - string $condition
 
    Example:
    $app->addRoute("routeName", new Route('/route-URI/{paramName}', 
        array('controller' => 'ControllerName', 'method' =>  'MethodName'),
        array('paramName' => '[0-9]+'),
        array(),
        '',
        array(),
        array("GET")
    ));
*/


/* 
    Routes for unauthenticated users
*/
$app->addRoute("index", new Route(
    '/',
    array('controller' => 'PagesController', 'method' => 'getIndex'),
    array(),
    array(),
    '',
    array(),
    array("GET")
));
$app->addRoute("privacyPolicy", new Route(
    '/privacy-policy',
    array('controller' => 'PagesController', 'method' => 'getPrivacyPolicy'),
    array(),
    array(),
    '',
    array(),
    array("GET")
));


/* 
    Routes for authenticated users
*/
$app->addRoute("admin", new Route(
    '/admin',
    array('controller' => 'AdminController', 'method' => 'getIndex'),
    array(),
    array(),
    '',
    array(),
    array("GET")
));
$app->addRoute("logout", new Route(
    '/log-out',
    array('controller' => 'AuthenticationController', 'method' => 'doLogOut'),
    array(),
    array(),
    '',
    array(),
    array("GET")
));


/* 
    Routes for register
*/
$app->addRoute("registerGET", new Route(
    '/register',
    array('controller' => 'RegisterController', 'method' => 'getRegister'),
    array(),
    array(),
    '',
    array(),
    array("GET")
));
$app->addRoute("registerPOST", new Route(
    '/register',
    array('controller' => 'RegisterController', 'method' => 'postRegister'),
    array(),
    array(),
    '',
    array(),
    array("POST")
));

/* 
    Routes for log in
*/
$app->addRoute("loginGET", new Route(
    '/log-in',
    array('controller' => 'AuthenticationController', 'method' => 'getLogin'),
    array(),
    array(),
    '',
    array(),
    array("GET")
));
$app->addRoute("loginPOST", new Route(
    '/log-in',
    array('controller' => 'AuthenticationController', 'method' => 'postLogin'),
    array(),
    array(),
    '',
    array(),
    array("POST")
));


/**
 * ----------------------------------------- Error pages
 */
$app->addRoute("offline", new Route(
    '/offline',
    array('controller' => 'ErrorController', 'method' => 'getOfflinePage'),
    array(),
    array(),
    '',
    array(),
    array("GET")
));

$app->addRoute("notFound", new Route(
    '/404',
    array('controller' => 'ErrorController', 'method' => 'getNotFoundPage'),
    array(),
    array(),
    '',
    array(),
    array("GET")
));

$app->addRoute("internalError", new Route(
    '/500',
    array('controller' => 'ErrorController', 'method' => 'getInternalErrorPage'),
    array(),
    array(),
    '',
    array(),
    array("GET")
));


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


$app->run();
