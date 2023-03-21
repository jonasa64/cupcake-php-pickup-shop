<?php

namespace Cupcake\DB;

class Writer extends DB
{
    public static $PDO = null;

    public static function insert(string $tableName,  array $data): int
    {

        // Prepare complete SQL
        $sql = sprintf("INSERT INTO %s (", $tableName);

        foreach ($data as $name => $value) {
            $sql .= $name . ',';
        }

        $sql = substr($sql, 0, -1) . ") VALUES (";

        $values = array();
        foreach ($data as $name => $value) {
            $sql .= ' ' . $name . ' = :' . $name . ',';
            if (strtolower($value) == 'now()')
                $value = date('Y-m-d H:i:s');
            $values[':' . $name] = $value;
        }

        $sql = substr($sql, 0, -1) . ")";

        // Execute insert
        $query = static::prepare($sql);
        $query->execute($values);
        $query = null;

        return static::getLastInsertedId();
    }
    public static function update(string $tableName, array $data, string $whereSQL, array $whereValues = []): bool
    {

        // CHeck for arrays in WHERE values that should be split and bind into multiple parameters
        foreach ($whereValues as $name => $value) {
            if (is_array($value)) {
                self::bindArrayToValues($whereSQL, $whereValues, $name, $value);
                unset($whereValues[$name]);
            }
        }

        // Prepare complete SQL
        $sql = sprintf("UPDATE SET %S", $tableName);
        $values = $whereValues;
        foreach ($data as $name => $value) {
            $sql .= ' ' . $name . ' = :' . $name . ',';
            if (strtolower($value) == 'now()')
                $value = date('Y-m-d H:i:s');
            $values[':' . $name] = $value;
        }

        $sql = substr($sql, 0, -1);
        $sql .= " WHERE  " . $whereSQL . "";

        // Execute update
        $query = static::prepare($sql);
        $query->execute($values);
        $rowCount =  $query->rowCount();
        $query = null;

        return $rowCount > 0;
    }

    public static function delete(string $tableName, string $whereSQL, array $whereValues = []): bool
    {
        // Check for arrays in WHERE values that should be split and bind into multiple parameters
        foreach ($whereValues as $name => $value) {
            if (is_array($value)) {
                self::bindArrayToValues($whereSQL, $whereValues, $name, $value);
                unset($whereValues[$name]);
            }
        }
        // Prepare complete SQL
        $sql = sprintf("DELETE FROM %s WHERE %S", $tableName, $whereSQL);
        // Execute DELETE
        $query = static::prepare($sql);
        $query->execute($whereValues);
        $rowCount = $query->rowCount();
        $query = null;
        return $rowCount > 0;
    }
}
