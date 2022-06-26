<?php

class Database
{
    
    private $host = "sql11.freesqldatabase.com";
    private $db_name = "sql11502237";
    private $username = "sql11502237";
    private $password = "XnVUZ6kNlW";
    private $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8", $this->username, $this->password);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
