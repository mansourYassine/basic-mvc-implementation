<?php

declare(strict_types=1);

use App\App;
use App\Config;
use App\Controllers\HomeController;
use App\Controllers\InvoiceController;
use App\Controllers\ProductController;
use App\Exceptions\FileNotFoundException;
use App\Router;

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../helpers/functions.php";

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

session_start();

define('STORAGE_PATH', __DIR__ . '/../storage/');
define('VIEWS_PATH', __DIR__ . '/../views/');

$router = new Router();

$router->get('/', [HomeController::class, "index"])
    ->get('/products', [ProductController::class, "index"])
    ->get('/products/add', [ProductController::class, "add"])
    ->get('/products/download', [ProductController::class, "download"])
    ->post('/products/add/upload', [ProductController::class, "upload"])
    ->get('/invoices', [InvoiceController::class, "index"])
    ->get('/invoices/create', [InvoiceController::class, "create"])
    ->post('/invoices/create', [InvoiceController::class, "store"]);

(new App(
    $router, 
    ['uri' => $_SERVER["REQUEST_URI"], 'method' => $_SERVER["REQUEST_METHOD"]],
    new Config($_ENV)
))->run();