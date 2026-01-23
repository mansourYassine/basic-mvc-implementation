<?php

declare(strict_types=1);

namespace App\Classes;

class Product
{
    public function index() : string
    {
        return "Product Page";
    }

    public function add() : string
    {
        return '
            <h1>Upload Product Image</h1>
            <form action="/products/add/upload" method="post" enctype="multipart/form-data">
                <label>Image:</label>
                <input type="file" name="image">
                <input type="submit">
            </form>
        ';
    }

    public function upload()
    {
        dump($_FILES);
        $filePath = __DIR__ . "/../../storage/images/" . "product.jpg"; // this is the destination path with the future name of the file
        move_uploaded_file($_FILES["image"]["tmp_name"], $filePath);
    }
}