<?php

namespace App\Items;

use App\Exceptions\ItemException;

abstract class Item
{
    private $description;
    private $value;

    public function __construct($description, $value)
    {
            $this->setDescription($description);
            $this->setValue($value);
    }

    public function setDescription(string $description)
    {
        if(!$description){
            throw new ItemException("Description is invalid");
        }
        $this->description = trim($description);
    }

    public function setValue(float $value)
    {
        if(!$value and $value != 0){
            throw new ItemException("Value is invalid");
        }
        $this->value = trim($value);
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}