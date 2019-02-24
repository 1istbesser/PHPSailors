<?php 
use PHPSailors\Application;
use Symfony\Component\Routing\Route;
require_once('../app/vendor/autoload.php');

define('TEMPLATES', dirname(__DIR__).DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR);

$app = new Application();

 // Init basic route
$home = new Route(
    '/',
    array('controller' => 'HomeController', 'method'=>'showHomePage')
);
$offline = new Route(
    '/offline',
    array('controller' => 'ErrorController', 'method'=>'showOfflinePage')
);
$notFound = new Route(
    '/404',
    array('controller' => 'ErrorController', 'method'=>'showNotFoundPage')
);
// Init route with dynamic placeholders examples
// $categoryByID = new Route(
//     '/category/{id}',
//     array('controller' => 'CategoryController', 'method'=>'getCategoryByID'),
//     array('id' => '[0-9]+')
// );
// $productsByCategoryID = new Route(
//     '/category/{id}/products',
//     array('controller' => 'CategoryController', 'method'=>'getProductsByCategoryID'),
//     array('id' => '[0-9]+')
// );
// $productByIDFromCategory = new Route(
//     '/category/{id}/products/{id_product}',
//     array('controller' => 'CategoryController', 'method'=>'getProductByIdFromCategory'),
//     array('id' => '[0-9]+')
// );

// Add Route object(s) to RouteCollection object      
$app->addRoute('home', $home);
$app->addRoute('offline', $offline);
$app->addRoute('notFound', $notFound);

if(session_status() === PHP_SESSION_NONE){
    session_start();
}

$app->run();