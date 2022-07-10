<?php
include_once $_SERVER["DOCUMENT_ROOT"].'/bibliotecauniversitaria/classes/Database.php';

$database = new Database();
$conn = $database->getConnection();

$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$matricola = $_POST['matricola']; // primary key
$genere = $_POST["genere"];
$email = $_POST["email"]; 
$password = $_POST["password"];


if (is_numeric($nome) or is_numeric($cognome) or !is_numeric($matricola) or is_numeric($email)) { 
	include_once 'registration-error-numeric.html'; // includo la pagina di errore
} else {
	$sql = "SELECT matricola FROM utenti WHERE matricola='$matricola'"; // seleziono dalla tabella utenti la colonna username in cui l'username corrisponde a quello dell'utente
	
$stmt = $conn->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() == 0) { // se non ci sono righe (non ci sono utenti)
		$sql2 = "INSERT INTO utenti(matricola, email, password, nome, cognome, genere)
	VALUES ('$matricola', '$email', '$password', '$nome', '$cognome', '$genere')"; // inserisco nella tabella utenti i dati inseriti dall'utente
		$stmt = $conn->prepare($sql2);
		$stmt->execute();
		include_once 'registration-ok.html.php'; // includo la pagina di registrazione compeltata
	} else {
		include_once 'registration-wrong.html.php'; // altrimenti includo la pagina di errore
	}
	
unset($conn);
unset($database);
}
