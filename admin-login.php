<?php
session_start(); // inizio la sessione
include_once 'classes/Database.php';

// creo l'oggetto database e apro la connessione
$database = new Database();
$conn = $database->getConnection();

// salvo i valori inseriti nel form di login
$adminuser = $_POST['adminuser'];
$adminpwd = md5($_POST['adminpwd']); // la password viene prima crittografata

// seleziono dalla tabella admin la colonna username e password in cui i dati corrispondono a quelli dell'utente
$sql = "SELECT username, password FROM admin WHERE username='$adminuser' AND password='$adminpwd'"; 
$stmt = $conn->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() == 0) { // se non ci sono righe (non ci sono utenti)
	include_once 'admin-login-wrong.html.php'; // includo la pagina di errore
} else {
	$_SESSION["adminuser"] = $adminuser; // prendo le variabili di sessione
	$_SESSION["adminpwd"] = $adminpwd;
	include_once 'admin-page.php'; // includo il file di admin-home
}

// chiude le variabili di connessione al database
unset($conn);
unset($database);