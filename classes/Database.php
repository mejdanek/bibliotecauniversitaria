<?php
class Database
{
    private $conn;

    public function getConnection()
    {
        $string = file_get_contents("../config/database.json");
        $json = json_decode($string, true);

        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $json['databasehost'] . ";dbname=" . $json['databasename'] . ";charset=utf8", $json['sqlusername'], $json['sqlpassword']);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
