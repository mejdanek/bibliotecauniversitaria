<?php
session_start(); // inizio la sessione

include_once 'classes/Database.php';

$database = new Database();
$conn = $database->getConnection();

$adminuser = $_POST['user'];
$adminpwd = $_POST['pwd'];

$sql = "SELECT username,password FROM utenti WHERE username='$user' AND password='$pwd'"; // seleziono dalla tabella admin la colonna username e password in cui i dati (username e password) corrispondono a quelli dell'utente

$stmt = $conn->prepare($sql);
$stmt->execute();


if ($stmt->rowCount() == 0) { // se non ci sono righe (non ci sono utenti)
	include_once 'login-wrong.html'; // includo la pagina di errore
} else {
	$_SESSION["user"] = $user; // prendo le variabili di sessione
	$_SESSION["pwd"] = $pwd;
	include_once 'home.php'; // includo il file di home
}

unset($conn);
unset($database);