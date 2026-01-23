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

$router->get('/', [Home::class, "index"])
        ->get('/products', [Product::class, "index"])
        ->get('/invoices', [Invoice::class, "index"])
        ->get('/invoices/create', [Invoice::class, "create"])
        ->post('/invoices/create', [Invoice::class, "store"]);

try {
    echo $router->resolve($_SERVER["REQUEST_URI"], strtolower($_SERVER["REQUEST_METHOD"]));
} catch (RouteNotFoundException $e) {
    echo $e->getMessage();
}