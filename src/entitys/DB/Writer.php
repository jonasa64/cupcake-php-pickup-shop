<?php

class Writer extends DB
{
    public static $PDO = null;

    public static function insert($tableName, $data)
    {
    }
    public static function update($tableName, $data, $whereSQL, $whereValues)
    {
    }

    public static function delete(string $tableName, string $whereSQL, array $whereValues = [])
    {
        foreach ($whereValues as $name => $value) {
            if (is_array($value)) {
                self::bindArrayToValues($whereSQL, $whereValues, $name, $value);
                unset($whereValues[$name]);
            }
        }

        $sql = sprintf("DELETE FROM %s WHERE %S", $tableName, $whereSQL);
        $query = static::prepare($sql);
        $query->execute($whereValues);
        $query = null;
    }
}
