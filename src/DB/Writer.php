<?php

class Writer extends DB
{
    public static $PDO = null;

    public static function insert(string $tableName,  array $data): int
    {
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

        $query = static::prepare($sql);
        $query->execute($values);
        $query = null;

        return static::getLastInsertedId();
    }
    public static function update(string $tableName, array $data, string $whereSQL, array $whereValues = [])
    {

        foreach ($whereValues as $name => $value) {
            if (is_array($value)) {
                self::bindArrayToValues($whereSQL, $whereValues, $name, $value);
                unset($whereValues[$name]);
            }
        }

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

        $query = static::prepare($sql);
        $query->execute($values);
        $query = null;
    }

    public static function delete(string $tableName, string $whereSQL, array $whereValues = []): void
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
