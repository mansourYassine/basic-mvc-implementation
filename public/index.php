<?php

declare(strict_types=1);

use App\Exceptions\RouteNotFoundException;
use App\Router;

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../helpers/functions.php";

session_start();

$router = new Router();

$router->register('/', function () {echo "Home Page";})
        ->register('/products', function () {echo "Products Page";})
        ->register('/invoices', function () {echo "Invoices Page";});

try {
    $router->resolve($_SERVER["REQUEST_URI"]);
} catch (RouteNotFoundException $e) {
    echo $e->getMessage();
}