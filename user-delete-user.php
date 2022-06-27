<?php
session_start(); // inizio la sessione
include_once 'db-connect-db-close.php'; // includo il file di connessione e di chiusura del db
$conn = db_connect(); // mi connetto al db
$pwd = $_SESSION["pwd"]; // prendo le variabili di sessione
$deletepwd = mysqli_real_escape_string($conn, $_POST["delete-pwd"]); // prendo le variabili inserite dall'utente, , eseguendo l'escape dei caratteri speciali
if ($pwd == $deletepwd) { // se la password dell'utente corrisponde alla password inserita 
	$S = "SELECT * FROM utenti WHERE password='$pwd'"; // seleziono tutte le colonne dalla tabella utenti in cui la password corrisponde alla password dell'utente
	$risultato = mysqli_query($conn, $S); // eseguo la query
	$n = mysqli_num_rows($risultato); // prendo il numero di righe del risultato della query
	if ($n == 0) { // se non ci sono righe (non ci sono utenti)
		include_once 'user-delete-wrong.php'; // includo la pagina di errore
	} else {
		$S2 = "DELETE FROM utenti WHERE password='$pwd'"; // elimino dalla tabella utenti l'utente con la password dell'utente
		mysqli_query($conn, $S2); // eseguo la query
		unset($_SESSION['user']); // resetta i valori delle variabili di sessione
		unset($_SESSION['pwd']);
		include_once 'user-delete-user.html'; // includo la pagina di cancellazzione
	}
	db_close($conn); // chiudo la connessione con il db
} else {
	include_once 'user-delete-wrong.php'; // includo la pagina di errore
}
