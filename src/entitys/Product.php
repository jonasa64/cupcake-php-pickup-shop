<?php

class Product extends Base
{

    private string $name;
    private string $description;
    private float $price;
    private string $imageSrc;
    private int $quantityInStock;
    private string $toppingFlavor;
    private string $bottomFlavor;

    public function find($tableName, $whereSql, $whereVales)
    {
    }

    public function create($tableName, $data)
    {
    }

    public function update($tableName, $data, $whereSql, $whereVales)
    {
    }

    public function delete($tableName, $whereSql, $whereVales)
    {
    }
}
