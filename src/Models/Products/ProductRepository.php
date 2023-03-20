<?php

namespace Cupcake\Models\Products;

use Cupcake\DB\Reader;
use Cupcake\DB\Writer;

class  ProductRepository
{

    private static $tableName = "products";

    public static function findAll(): array
    {
        $products = array();
        $query = Reader::query("SELECT * FROM " . self::$tableName);
        $query->execute();
        while ($row = $query->fetch(\PDO::FETCH_ASSOC)) {
            $product = new Product;
            $product->setId($row["products_id"]);
            $product->setPrice($row["products_price"]);
            $product->setName($row["products_name"]);
            $product->setDescription("products_description");
            $product->setQuantityInStock($row["products_quantity_inStock"]);
            $product->setImageSrc($row["products_image_src"]);
            $product->setBottomFlavor($row["products_bottom_flavor"]);
            $product->setToppingFlavor($row["products_bottom_flavor"]);
            $products[] = $product;
        }
        $query = null;

        return $products;
    }

    public static function findOne(int $id): ?product
    {
        $query = Reader::prepare("SELECT * FROM " . self::$tableName . " WHERE products_id = :id");
        $query->execute(array("id" => $id));
        $product = new Product;
        $query = null;
        return $product;
    }

    public static function create(Product $product)
    {
        // TO DO IMPLEMENT WHEN DO ADMIN BACK END
    }

    public static function update()
    {
        // TO DO IMPLEMENT WHEN DO ADMIN BACK END
    }

    public static function delete(int $id): void
    {
        Writer::delete(self::$tableName, "products_id = :id", ["id" => $id]);
    }
}
