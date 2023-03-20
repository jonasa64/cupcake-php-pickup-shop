<?php

namespace Cupcake\Models\Products;

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

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function getImageSrc()
    {
        return $this->imageSrc;
    }

    public function setImageSrc(string $imageSrc)
    {
        $this->imageSrc = $imageSrc;
    }

    public function getQuantityInStock()
    {
        return $this->quantityInStock;
    }

    public function setQuantityInStock(int $quantityInStock)
    {
        return $this->quantityInStock = $quantityInStock;
    }

    public function getToppingFlavor()
    {
        return $this->toppingFlavor;
    }

    public function setToppingFlavor(string $toppingFlavor)
    {
        $this->toppingFlavor = $toppingFlavor;
    }

    public function getBottomFlavor()
    {
        return $this->bottomFlavor;
    }

    public function setBottomFlavor(string $bottomFlavor)
    {
        $this->bottomFlavor = $bottomFlavor;
    }
}
