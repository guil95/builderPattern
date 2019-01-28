<?php

namespace App\Financial;


use App\Items\Item;

class InvoiceBuilder
{
    private $invoice;
    private $items;
    private $total;
    private $description;
    private $dateEmission;
    private $cnpj;

    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice;
    }

    public function build(): Invoice
    {
        $this->invoice->items = $this->items;
        $this->invoice->description = $this->description;
        $this->invoice->total = $this->total;
        $this->invoice->dateEmission = $this->dateEmission;
        $this->invoice->cnpj = $this->cnpj;

        return $this->invoice;
    }

    public function withItems(array $items)
    {
        foreach ($items as $item){
            $this->addItem($item);
        }

        return $this;
    }

    public function withCnpj(string $cnpj)
    {
        $this->cnpj = preg_replace('/[^0-9]+/', '', $cnpj);
        return $this;
    }

    public function withDescription(string $description)
    {
        $this->description = trim($description);
        return $this;
    }

    public function withDateEmission()
    {
        $this->dateEmission = new \DateTime('now');
        return $this;
    }

    private function setTotal(float $value)
    {
        $this->total += $value;
    }

    private function addItem(Item $item)
    {
        if($item instanceof Item){
            $this->items[] = [
                'description' => $item->getDescription(),
                'value' => $item->getValue()
            ];

            $this->setTotal($item->getValue());
        }
    }


}