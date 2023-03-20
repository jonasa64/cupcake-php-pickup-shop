<?php

namespace Cupcake\DB;

class DB
{

    /**
     * Undocumented variable
     *
     * @var \PDO
     */
    public static $PDO = null;
    private static $dbHost = "localhost";
    private static $dbUser = "root";
    private static $dbPass = "";
    private static $dbName = "";


    public static function connect()
    {
        try {
            if (static::$PDO == null) {
                static::$PDO = new \PDO('mysql:host=' . self::$dbHost . ';dbname=' . self::$dbName, self::$dbUser, self::$dbPass);
                static::$PDO->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            }
        } catch (\PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function query(string $query): \PDOStatement
    {
        static::connect();

        $statement = static::$PDO->query($query);

        return $statement;
    }

    public static function prepare(string $query): \PDOStatement
    {
        static::connect();

        return static::$PDO->prepare($query);
    }

    public static function exac(string $query): int|false
    {
        static::connect();
        return static::$PDO->exec($query);
    }

    public static function getLastInsertedId(): int|false
    {
        static::connect();

        return static::$PDO->lastInsertId();
    }

    public static function bindArrayToValues(&$SQLWhere, &$SQLValues, $placeholderName, $array)
    {
        $newPlaceholders = [];

        for ($i = 1; $i <= count($array); $i++) {
            $newPlaceholders[] = ":" . $placeholderName . $i;
            $SQLValues[":" . $placeholderName . $i] = $array[$i - 1];
        }

        $SQLWhere = str_replace(":" . $placeholderName, implode(", ", $newPlaceholders), $SQLValues);
    }
}
