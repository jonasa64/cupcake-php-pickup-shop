<?php

abstract class  Base
{

    public abstract function find($tableName, $whereSql, $whereVales);

    public abstract function create($tableName, $data);

    public abstract function update($tableName, $data, $whereSql, $whereVales);

    public abstract function delete($tableName, $whereSql, $whereVales);
}
