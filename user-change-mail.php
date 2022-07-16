<?php

session_start();
// includi libreria connessione database
include_once 'classes/Database.php';

// crea connessione
$database = new Database();
$conn = $database->getConnection();


$matricola = $_SESSION['matricola'];
$email_old = $_POST['oldemail'];
$email_new = $_POST['newemail'];
$sql = "SELECT matricola,email FROM utenti WHERE matricola='$matricola' AND email='$email_old'"; // seleziono dalla tabella admin la colonna username e password in cui i dati (username e password) corrispondono a quelli dell'utente

$stmt = $conn->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() == 0) { // se non ci sono righe (non ci sono utenti)
	include_once 'user-email-wrong.html.php'; // includo la pagina di errore
} else {
	$sql2 = "UPDATE utenti SET email='$email_new' WHERE matricola='$matricola'"; // seleziono dalla tabella admin la colonna username e password in cui i dati (username e password) corrispondono a quelli dell'utente
    $stmt = $conn->prepare($sql2);
    $stmt->execute();
	include_once 'user-email-ok.html.php'; // includo il file di home
}

unset($conn);
unset($database);