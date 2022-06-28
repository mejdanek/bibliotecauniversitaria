<?php
include_once 'classes/Database.php';

$database = new Database();
$conn = $database->getConnection();

$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$genere = $_POST["gender"];
$tipo = $_POST["tipo"];
$user = $_POST["user"];
$universita = $_POST["university"];
$somma = $_POST["somma"];
$pwd = $_POST["pwd"];
if (is_numeric($nome) or is_numeric($cognome) or is_numeric($universita) or is_numeric($user)) { // se i dati sono solo numerici
	include_once 'registration-error-numeric.html'; // includo la pagina di errore
} else {
	$sql = "SELECT username FROM utenti WHERE username='$user'"; // seleziono dalla tabella utenti la colonna username in cui l'username corrisponde a quello dell'utente
	
$stmt = $conn->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() == 0) { // se non ci sono righe (non ci sono utenti)
		$sql2 = "INSERT INTO utenti(username, password, nome, cognome, genere, tipo, somma, universita)
	VALUES ('$user', '$pwd', '$nome', '$cognome', '$genere', '$tipo', '$somma', '$universita')"; // inserisco nella tabella utenti i dati inseriti dall'utente
		$stmt = $conn->prepare($sql2);
		$stmt->execute();
		include_once 'registration-complete.html'; // includo la pagina di registrazione compeltata
	} else {
		include_once 'registration-wrong.html'; // altrimenti includo la pagina di errore
	}
	
unset($conn);
unset($database);
}
