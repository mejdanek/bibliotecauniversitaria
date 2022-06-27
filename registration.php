<?php
include_once 'db-connect-db-close.php'; // includo il file di connessione e di chiusura del db
$conn = db_connect(); // mi connetto al db
$nome = mysqli_real_escape_string($conn, $_POST["nome"]); // prendo le variabili inserite dall'utente, eseguendo l'escape dei caratteri speciali
$cognome = mysqli_real_escape_string($conn, $_POST["cognome"]);
$genere = $_POST["gender"];
$tipo = $_POST["tipo"];
$user = mysqli_real_escape_string($conn, $_POST["user"]);
$universita = mysqli_real_escape_string($conn, $_POST["university"]);
$somma = $_POST["somma"];
$pwd = mysqli_real_escape_string($conn, $_POST["pwd"]);
if (is_numeric($nome) or is_numeric($cognome) or is_numeric($universita) or is_numeric($user)) { // se i dati sono solo numerici
	include_once 'registration-error-numeric.html'; // includo la pagina di errore
} else {
	$S = "SELECT username FROM utenti WHERE username='$user'"; // seleziono dalla tabella utenti la colonna username in cui l'username corrisponde a quello dell'utente
	$risultato = mysqli_query($conn, $S); // eseguo la query
	$n = mysqli_num_rows($risultato); // prendo il numero di righe del risultato della query
	if ($n == 0) { // se non ci sono righe (non ci sono utenti)
		$S2 = "INSERT INTO utenti(username, password, nome, cognome, genere, tipo, somma, universita)
	VALUES ('$user', '$pwd', '$nome', '$cognome', '$genere', '$tipo', '$somma', '$universita')"; // inserisco nella tabella utenti i dati inseriti dall'utente
		$inserisci = mysqli_query($conn, $S2); // eseguo la query
		include_once 'registration-complete.html'; // includo la pagina di registrazione compeltata
	} else {
		include_once 'registration-wrong.html'; // altrimenti includo la pagina di errore
	}
	db_close($conn); // chiudo la connessione con il db
}
