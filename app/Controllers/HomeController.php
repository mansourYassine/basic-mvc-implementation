<?php

declare(strict_types=1);

namespace App\Controllers;

use App\App;
use App\Models\Invoice;
use App\Models\SignUp;
use App\Models\User;
use App\View;
use PDO;
use PDOException;

class HomeController
{
    public function index(): View
    {
        $db = App::db();

        $email = 'ossama@gmail.com';
        $name = 'ossama';
        $amount = 200;
        
        $userModel = new User();
        $invoiceModel = new Invoice();

        $invoiceId = (new SignUp($userModel, $invoiceModel))->register(
            [
                'email' => $email,
                'name' => $name
            ],
            [
                'amount' => $amount
            ]
        );

        return View::make('index', ['invoice' => $invoiceModel->find($invoiceId)]);
    }
}
