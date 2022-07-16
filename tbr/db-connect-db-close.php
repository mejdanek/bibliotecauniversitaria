<?php
function db_connect()
{
	$host = "localhost";
	$hostuser = "root";
	$pass = "";
	$database = "biblioteca";

	try {
		//Mi connetto al DBMS
		$conn = mysqli_connect($host, $hostuser, $pass) or die('Errore...');
		//Mi connetto al database
		mysqli_select_db($conn, $database) or die('Errore...');
		return $conn;
	} catch (mysqli_sql_exception $e) {
		echo "<script>console.log(' . $e . ')</script>";
	}
}

function db_close($conn)
{
	mysqli_close($conn); // chiudo la connessione
}
