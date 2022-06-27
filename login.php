<?php
session_start(); // inizio la sessione
include_once 'db-connect-db-close.php'; // includo il file di connessione e di chiusura del db
$conn = db_connect(); // mi connetto al db
$user = mysqli_real_escape_string($conn, $_POST["user"]); // prendo le variabili inserite dall'utente, eseguendo l'escape dei caratteri speciali
$pwd = mysqli_real_escape_string($conn, $_POST["pwd"]);
$S = "SELECT username,password FROM utenti WHERE username='$user' AND password='$pwd'"; // seleziono dalla tabella admin la colonna username e password in cui i dati (username e password) corrispondono a quelli dell'utente
$risultato = mysqli_query($conn, $S); // eseguo la query
$n = mysqli_num_rows($risultato); // prendo il numero di righe del risultato della query
if ($n == 0) { // se non ci sono righe (non ci sono utenti)
	include_once 'login-wrong.html'; // includo la pagina di errore
} else {
	$_SESSION["user"] = $user; // prendo le variabili di sessione
	$_SESSION["pwd"] = $pwd;
	include_once 'home.php'; // includo il file di home
}
db_close($conn); // chiudo la connesione con il db
