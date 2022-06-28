<?php
session_start(); // inizio la sessione
$user = $_SESSION["user"]; // prendo la variabile di sessione
if (empty($user)) {  // se la variabile di sessione è vuota
	header("Location:login.html.php"); // reindirizzo l'utente alla pagina di login
	exit;
} else { // altrimenti prendo i dati inseriti dall'utente
	include_once 'db-connect-db-close.php'; // includo il file di connessione e di chiusura del db
	$conn = db_connect(); // mi connetto al db
	$nome = mysqli_real_escape_string($conn, $_POST["nome"]);
	$tipo = $_POST["tipo"];
	$citta = mysqli_real_escape_string($conn, $_POST["citta"]);
	$S = "SELECT nome, tipo, citta FROM eventi WHERE nome LIKE '%$nome%' AND tipo='$tipo' AND citta LIKE '%$citta%'"; // seleziono dalla tabella eventi le colonne nome e citta in cui il nome, il tipo e la città corrispondenti alle scelte dell'utente
	$risultato = mysqli_query($conn, $S); // eseguo la query
	$n = mysqli_num_rows($risultato); // prendo il numero di righe del risultato della query
	if ($n == 0) { // se non ci sono righe (non ci sono eventi)
		include_once 'user-no-result-event.html'; // includo la pagina di errore
	} else {
		include_once 'user-event-result.html.php'; // includo la pagina degli eventi trovati
	}
	db_close($conn); // chiudo la connessione con il db
}
