<?php

namespace App\Financial;


class Invoice
{
    public $items;
    public $total;
    public $description;
    public $dateEmission;
    public $cnpj;

    private function __construct()
    {
    }

    public static function builder()
    {
        return new InvoiceBuilder(new Invoice());
    }
}