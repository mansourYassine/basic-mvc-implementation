<?php

declare(strict_types=1);

use App\Classes\Home;
use App\Classes\Invoice;
use App\Classes\Product;
use App\Exceptions\RouteNotFoundException;
use App\Router;

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../helpers/functions.php";

session_start();

$router = new Router();

$router->register('/', [Home::class, "index"])
        ->register('/invoices', [Invoice::class, "index"])
        ->register('/invoices/create', [Invoice::class, "create"])
        ->register('/products', [Product::class, "index"]);

try {
    echo $router->resolve($_SERVER["REQUEST_URI"]);
} catch (RouteNotFoundException $e) {
    echo $e->getMessage();
}