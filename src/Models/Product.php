<?php

class Product
{

    private int $id;
    private string $name;
    private string $description;
    private float $price;
    private string $imageSrc;
    private int $quantityInStock;
    private string $toppingFlavor;
    private string $bottomFlavor;
    private string $tableName = "products";

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getImageSrc()
    {
        return $this->imageSrc;
    }

    public function getQuantityInStock()
    {
        return $this->quantityInStock;
    }

    public function getToppingFlavor()
    {
        return $this->toppingFlavor;
    }

    public function getBottomFlavor()
    {
        return $this->bottomFlavor;
    }
}
