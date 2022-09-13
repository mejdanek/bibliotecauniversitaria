<?php
session_start(); // inizio la sessione

include_once 'classes/Database.php';

$database = new Database();
$conn = $database->getConnection();

$matricola = $_POST['matricola'];
$password = md5($_POST['password']);
$sql = "SELECT matricola,password FROM utenti WHERE matricola='$matricola' AND password='$password'"; 

// seleziono dalla tabella admin la colonna username e password in cui i dati (username e password)
// corrispondono a quelli dell'utente

$stmt = $conn->prepare($sql);
$stmt->execute();


if ($stmt->rowCount() == 0) { // se non ci sono righe (non ci sono utenti)
	include_once 'login-wrong.html.php'; // includo la pagina di errore
} else {
	$_SESSION["matricola"] = $matricola; // prendo le variabili di sessione
	$_SESSION["password"] = $password;
	include_once 'user-page.php'; // includo il file di home
}

unset($conn);
unset($database);