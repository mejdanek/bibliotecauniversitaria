<?php
include_once 'db-connect-db-close.php'; // includo il file di connessione e di chiusura del db
$conn = db_connect(); // mi connetto al db
$olduser = mysqli_real_escape_string($conn, $_POST["olduser"]); // prendo le variabili inserite dall'utente, eseguendo l'escape dei caratteri speciali
$newuser = mysqli_real_escape_string($conn, $_POST["newuser"]);
$S = "SELECT username FROM utenti WHERE username='$olduser'"; // seleziono dalla tabella utenti la colonna username in cui l'username corrisponde a quello inserito dall'admin
$risultato = mysqli_query($conn, $S); // eseguo la query
$n = mysqli_num_rows($risultato); // prendo il numero di righe del risultato della query
if ($n == 0) { // se non ci sono righe
	include_once 'admin-update-user-wrong.html.php'; // includo la pagina di errore
} else {
	$S = "UPDATE utenti SET username='$newuser' WHERE username='$olduser'"; // aggiorno la tabella utenti in cui l'username corrisponde al vecchio username impostando come username il nuovo username
	mysqli_query($conn, $S); // eseguo la query
	include_once 'admin-update-user.html'; // includo la pagina dell'aggiornamento effettuato
}
db_close($conn); // chiudo la connessione al db
