<?php

error_reporting(E_ALL^E_DEPRECATED);
ini_set('display_errors', 1);
require "../vendor/autoload.php";
use \App\Items\Chair;
use \App\Items\Tv;
use \App\Financial\Invoice;
use \App\Exceptions\ItemException;

try{
    $chair = new Chair('Chair', 50);
    $tv =  new Tv('Tv', 2500.99);
}catch (ItemException $e){
   print_r($e->getMessage());
   return;
}

$items = [
    $chair,
    $tv
];

die("<pre>" . __FILE__ . " - " . __LINE__ . "\n" . print_r(Invoice::builder()
        ->withCnpj('47.271.780/0001-78')
        ->withDescription('Invoice description')
        ->withItems($items)
        ->withDateEmission()
        ->build(), true) . "</pre>");