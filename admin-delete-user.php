<?php
include_once 'db-connect-db-close.php'; // includo il file di connessione e di chiusura del db
$conn = db_connect(); // mi connetto al db
$user = mysqli_real_escape_string($conn, $_POST["user"]); // prendo la variabile inserita dall'admin, eseguendo l'escape dei caratteri speciali in una stringa
$S = "SELECT username FROM utenti WHERE username='$user'"; // selezioni dalla tabella utenti l'username che corrisponde all'username dell'utente
$risultato = mysqli_query($conn, $S); // eseguo la query
$n = mysqli_num_rows($risultato); // prendo il numero di righe del risultato della query
if ($n == 0) { // se non ci sono righe (non ci sono utenti)
	include_once 'admin-delete-user-wrong.html.php'; // includo la pagina di errore
} else {
	$S2 = "DELETE FROM utenti WHERE username='$user'"; // elimino dalla tabella utenti l'utente con username uguale a quello inserito dall'admin
	$elimina = mysqli_query($conn, $S2); // eseguo la query
	include_once 'admin-user-deleted.html.php'; // includo la pagina di cancellazione effettuata
}
db_close($conn); // chiudo la connessione con il ddb
