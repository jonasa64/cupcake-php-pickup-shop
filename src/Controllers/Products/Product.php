<?php

namespace Cupcake\Controllers\Products;

use Cupcake\Controllers\Controller;
use Cupcake\Models\Products\ProductRepository;

class Product extends Controller
{

    public function index()
    {
        $products = ProductRepository::findAll();
        $this->renderView("Products/index.php", $products);
    }

    public function show(int $id)
    {
        $product = ProductRepository::findOne($id);
        if ($product)
            $this->renderView("Products/show.php", [$product]);
        else
            $this->renderView("Errors/404.php");
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
