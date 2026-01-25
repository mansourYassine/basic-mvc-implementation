<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class ProductController
{
    public function index() : View
    {
        return View::make('products/index');
    }

    public function add() : View
    {
        return View::make('products/add');
    }

    public function upload()
    {
        $filePath = STORAGE_PATH . "product.jpg"; // this is the destination path with the future name of the file
        move_uploaded_file($_FILES["image"]["tmp_name"], $filePath);
    }
}