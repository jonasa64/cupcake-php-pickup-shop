<?php

class Connection
{
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPass = "";
    private $dbName = "";
    private $conn = null;

    public function getConnection()
    {
        $this->conn = null;
        try {

            $this->conn = new PDO('mysql:host=' . $this->dbHost . ';dbname=' . $this->dbName, $this->dbUser, $this->dbPass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
        return $this->conn;
    }
}
