<?php

class  Base
{

    private $tableName = "";

    public function findAll()
    {
    }

    public function findOne()
    {
    }

    public  function create()
    {
    }

    public function update()
    {
    }

    public function delete(int $id): void
    {
        Writer::delete($this->tableName, "products_id = :id", ["id" => $id]);
    }
}
