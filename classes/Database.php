<?php
class Database
{
    private $conn;

    public function getConnection()
    {
        // file JSON parametri connessione database
        $string = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/bibliotecauniversitaria/config/database.json");
        $json = json_decode($string, true);

        $this->conn = null;
        try
        {
            // tenta connessione a database
            $this->conn = new PDO("mysql:host=" . $json['databasehost'] . ";dbname=" . $json['databasename'] . ";charset=utf8", $json['sqlusername'], $json['sqlpassword']);
        }
        catch (PDOException $exception)
        {
            // in caso di errore, restituisce messaggio dettagliato
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
