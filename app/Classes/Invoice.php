<?php

declare(strict_types=1);

namespace App\Classes;

class Invoice
{
    public function index() : string
    {
        return "Invoice Page";
    }

    public function create() : string
    {
        return '
            <h1>Create New Invoice</h1>
            <form action="/invoices/create" method="post">
                <label>Amount:</label>
                <input type="number" name="amount">
                <input type="submit">
            </form>
        ';
    }

    public function store()
    {
        $amount = $_POST['amount'];
        var_dump($amount);
    }
}