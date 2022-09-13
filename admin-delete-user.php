<?php

// includi libreria per connessione a database
include_once $_SERVER["DOCUMENT_ROOT"].'/bibliotecauniversitaria/classes/Database.php';

// crea connessione
$database = new Database();
$conn = $database->getConnection();

// salva il nome utente da eliminare in una variabile
$user = $_POST['user'];

// controlla se è presente l'utente da eliminare
$sql = "SELECT matricola FROM utenti WHERE matricola='$user'";
$stmt = $conn->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() > 0) { // se ci sono righe ( ci sono utenti)
	$sql2 = "DELETE FROM utenti WHERE matricola='$user'";
	$stmt = $conn->prepare($sql2);
	$stmt->execute();
	include_once 'admin-user-deleted.html.php'; // includo la pagina di cancellazione completata
} else {
	include_once 'admin-delete-user-wrong.html.php'; // altrimenti includo la pagina di errore
}

// chiudo le variabili di connessione al database
unset($conn);
unset($database);
