<?php

namespace Cupcake\Controllers\Products;

class Product
{

    public function index()
    {
        echo "Hello from product controller";
        die();
    }

    public function show(int $id)
    {
        echo "Hello from product controller " . $id;
        die();
    }

    public function edit(int $id)
    {
    }

    public function update(int $id)
    {
    }

    public function create()
    {
    }

    public function store()
    {
    }
}
