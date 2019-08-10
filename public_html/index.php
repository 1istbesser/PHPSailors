<?php 
use PHPSailors\Application;
use Symfony\Component\Routing\Route;

/*
    Define here any global constants you may want to use throughout your application, 
    however, please limit the usage of "define" and instead use "const" to define 
    constants within classes.

    TEMPLATES -> /templates
*/
define('TEMPLATES', dirname(__DIR__).DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR);
define('ADMINISTRATOREMAIL', "tamer.altintop@gmail.com");


/*
    The application depends on a few components installed through Composer, therefore 
    if you didn't run "composer install" within the /app directory of your project, 
    an internal error with a clear message should be the exit point. 
*/
$internalServerErrorTemplate = "
<h1>Internal Server Error</h1>
<p>The server has encountered an internal error or misconfiguration and was unable to compelte your request.</p>
<p>Please contact the server administrator at ". ADMINISTRATOREMAIL. " and inform them of the time and URL of the occured error.</p>
";


if(file_exists('../app/vendor/autoload.php')){
    require_once('../app/vendor/autoload.php');
} else {
    error_log("Error path: /public_html/index.php");
    error_log("/app/vendor/autoload.php doesn't exist. Run composer install inside root/app of your app.");
    echo $internalServerErrorTemplate;
    http_response_code(500);
    exit;
}


$app = new Application();


/* 
    Declare all routes below 

    Inside the Route object, you must specify the following:
    - The route name,
    - The URI with any parameters between curly brackets,
    - An array with the controller and the method name,
    - Depending on your number of parameters, other arrays matching the 
    parameter name to a regular expression.

    Example:
    $app->addRoute("routeName", new Route('/route-URI/{paramName}', 
        array('controller' => 'ControllerName', 'method' =>  'MethodName'),
        array('paramName' => '[0-9]+')
    ));
*/


/* 
    Pages for unauthenticated users
*/
$app->addRoute("index", new Route(
    '/',
    array('controller' => 'PagesController', 'method'=>'getIndex')
));
$app->addRoute("install", new Route(
    '/install',
    array('controller' => 'InstallController', 'method'=>'installApp')
));
$app->addRoute("privacyPolicy", new Route(
    '/privacy-policy',
    array('controller' => 'PagesController', 'method'=>'getPrivacyPolicy')
));


/* 
    Pages for authenticated users
*/
$app->addRoute("admin", new Route(
    '/admin',
    array('controller' => 'AdminController', 'method'=>'getIndex')
));
$app->addRoute("logout", new Route(
    '/log-out',
    array('controller' => 'AdminController', 'method'=>'doLogOut')
));


/* 
    Register
*/
$app->addRoute("registerGET", new Route(
    '/register',
    array('controller' => 'RegisterController', 'method'=>'getRegister'),
    array(),
    array(),
    '',
    array(),
    array("GET")
));
$app->addRoute("registerPOST", new Route(
    '/register',
    array('controller' => 'RegisterController', 'method'=>'postRegister'),
    array(),
    array(),
    '',
    array(),
    array("POST")
));

/* 
    Log in
*/
$app->addRoute("loginGET", new Route(
    '/log-in',
    array('controller' => 'AuthenticationController', 'method'=>'getLogin'),
    array(),
    array(),
    '',
    array(),
    array("GET")
));
$app->addRoute("loginPOST", new Route(
    '/log-in',
    array('controller' => 'AuthenticationController', 'method'=>'postLogin'),
    array(),
    array(),
    '',
    array(),
    array("POST")
));


/* 
    Error handling pages
*/
$app->addRoute("offline", new Route(
    '/offline',
    array('controller' => 'ErrorController', 'method'=>'getOfflinePage')
));

$app->addRoute("notFound", new Route(
    '/404',
    array('controller' => 'ErrorController', 'method'=>'getNotFoundPage')
));

$app->addRoute("internalError", new Route(
    '/500',
    array('controller' => 'ErrorController', 'method'=>'getInternalErrorPage')
));


if(session_status() === PHP_SESSION_NONE){
    session_start();
}


$app->run();