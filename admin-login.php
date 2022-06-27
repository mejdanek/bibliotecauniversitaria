<?php
session_start(); // inizio la sessione
include_once 'db-connect-db-close.php'; // includo il file di connessione e di chiusura del db
$conn = db_connect(); // mi connetto al db
$adminuser = mysqli_real_escape_string($conn, $_POST["adminuser"]); // prendo le variabili inserite dall'utente
$adminpwd =  mysqli_real_escape_string($conn, $_POST["adminpwd"]);
$S = "SELECT username, password FROM admin WHERE username='$adminuser' AND password='$adminpwd'"; // seleziono dalla tabella admin la colonna username e password in cui i dati corrispondono a quelli dell'utente
$risultato = mysqli_query($conn, $S); // eseguo la query
$n = mysqli_num_rows($risultato); // prendo il numero di righe del risultato della query
if ($n == 0) { // se non ci sono righe (non ci sono utenti)
	include_once 'admin-login-wrong.html'; // includo la pagina di errore
} else {
	$_SESSION["adminuser"] = $adminuser; // prendo le variabili di sessione
	$_SESSION["adminpwd"] = $adminpwd;
	include_once 'admin-home.php'; // includo il file di admin-home
}
db_close($conn); // chiudo la connesione al db
