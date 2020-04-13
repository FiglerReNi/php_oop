<?php

include(SITEROUTE . "/init/config.php");

class Database
{
    private $connection;

    public function __construct()
    {
        $this->openDBConnection();
    }

    private function openDBConnection()
    {
        $this->connection = new mysqli(HOST, USER, PASS, NAME);
        if ($this->connection->connect_errno) {
            die("Database connection failed badly" . $this->connection->error);
        }
    }

    public function query($sql)
    {
        $result = $this->connection->query($sql);
        $this->confirmQuery($result);
        return $result;
    }

    private function confirmQuery($result)
    {
        if (!$result) {
            die("Query failed" . $this->connection->error);
        }
    }

    public function escapeString($string)
    {
        $escape = $this->connection->real_escape_string($string);
        return $escape;
    }

    public function theInsertId()
    {
        return $this->connection->insert_id;
    }

    public function affectedRow()
    {
        return $this->connection->affected_rows;
    }
}

